<?php

namespace App\Http\Controllers;

use App\Models\TopicData;
use League\Csv\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Bus;
use App\Models\TopicSelection;
use App\Models\AllocationResult;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class Modul_ownerController extends Controller
{
    protected $table = 'topic_data';

    public function Modul_ownerDashboard(){

        $totalStudents = User::where('role', 'student')->count();

        $totalAllocatedStudents = User::where('role', 'student')->where('Allocated', true)->count();

        $totalProjects = TopicData::count();

        $totalAllocatedProjects = TopicData::where('Allocated', true)->count();

        $data = [
            'totalStudents' => $totalStudents,
            'totalAllocatedStudents' => $totalAllocatedStudents,
            'totalProjects' => $totalProjects,
            'totalAllocatedProjects' => $totalAllocatedProjects,
        ];
    
        return view('modul_owner.index', $data);
    }
    public function upload()
    {
        return view('modul_owner.upload');
    }

    public function topicStore(Request $request)
    {
        if ($request->hasFile('csv')) {
            $csvFile = $request->file('csv');
            $csv = Reader::createFromPath($csvFile->getPathname(), 'r');
            $csv->setHeaderOffset(0);
    
            $successCount = 0;
    
            foreach ($csv->getRecords() as $record) {
                $sellData = array_map('trim', $record);
                $existingRecord = TopicData::where('Project_ID', $sellData['Project_ID'])->first(); // Check if a record with the same Project_ID exists
                
                //dd($sellData); check the update value

                if ($existingRecord) {
                    $existingRecord->update($sellData); // Update the existing record
                } else {
                    TopicData::create($sellData); // Insert a new record
                }
    
                $successCount++;
                
            }
           
    
            $notification = [
                'message' => $successCount . ' records uploaded successfully',
                'alert-type' => 'success'
            ];
            return back()->with($notification);
        }
    
        $notification = [
            'message' => 'CSV Upload error',
            'alert-type' => 'error'
        ];
        return back()->with($notification);
    }

    public function topicDelete($Project_ID)
    {
        
        $topicData = TopicData::where('Project_ID', $Project_ID)->first(); // Find the record to be deleted based on the project_id
        
        if ($topicData) { // Check if the record exists

            $topicData->delete();

            $notification = [
                'message' => 'Record deleted successfully',
                'alert-type' => 'success'
            ];
        } else {
            $notification = [
                'message' => 'Record not found or already deleted',
                'alert-type' => 'error'
            ];
        }
        return back()->with($notification);
    }  

    public function showPreview()
    {
        $data = TopicData::all(); 

        return view('modul_owner.preview', ['data' => $data]);
    }


    public function allocationList()

    {    
        $projectData = DB::table('topic_selections')
        ->select(
            'Project_ID',
            'Project_Name',
            'CS_Academic',
            'Contact_email',
            'Quota',
            'Allocated',
            DB::raw('count(*) as selection_count')
        )
        ->whereRaw('Quota > Allocated')

        ->groupBy('Project_ID', 'Project_Name', 'CS_Academic', 'Contact_email','Quota','Allocated')
        
        ->get();
        

        $result = [];
        foreach ($projectData as $row) {
                if ($row->Quota > $row->Allocated) {
                    $result[] = [
                        'Project_ID' => $row->Project_ID, 
                        'Project_Name' => $row->Project_Name, 
                        'CS_Academic' => $row->CS_Academic, 
                        'Contact_email' => $row->Contact_email, 
                        'selection_count' => $row->selection_count,
                    ];
                }
    }

        return view('modul_owner.allocationList', [
            'projectData' => $result
        ]);
            
        }

    public function processAllocate($projectID)
    {
        
        $students = DB::table('topic_selections')
        ->where('Project_ID', $projectID)
        ->where('Allocated', false)  // Checks Allocated is false before return values.
        ->get()
        ->toArray();

        $Quota = DB::table('topic_data')
        ->where('Project_ID', $projectID)
        ->where('Quota', '<>', 'Allocated')
        ->value('Quota');

        usort($students, function ($a, $b) {
            return $a->Rank - $b->Rank;
        });

    //dd($students);

    return view('modul_owner.processAlloate', ['students' => $students, 'projectID' => $projectID, 'Quota' => $Quota]);
    }



    public function allocationResult(Request $request)
{

    $studentIds = $request->input('student_ids'); //get check box values (arry)
    $projectID = $request->input('project_id'); // single values
    $operatorId = auth()->user()->id; // single values
    //dd($studentIds);

    $topicData = TopicData::where('Project_ID', $projectID)->first();
    $projectName = $topicData ? $topicData->Project_Name : null;
    $CsAcademic = $topicData ? $topicData->CS_Academic : null;
    $ContactEmail = $topicData ? $topicData->Contact : null;

    $userData = User::where('id', $operatorId)->first();
    $operatorName = $userData ? $userData->name : null;

    foreach ($studentIds as $studentId) {
       
        $userData = User::where('id', $studentId)->first(); //get single student id
        $studentName = $userData ? $userData->name : null;

        
        if ($topicData && $topicData->Quota - $topicData->Allocated > 0) {
    
            AllocationResult::create([
                'id' => $studentId, 
                'Name' => $studentName,
                'Project_ID' => $projectID,
                'Project_Name' => $projectName,
                'CS_Academic' => $CsAcademic,
                'Contact_Email' => $ContactEmail,
                'Allocation_Operator_Id' => $operatorId,
                'Allocation_Operator_Name' => $operatorName,
                'Allocated' => true
            ]);
    

            TopicSelection::whereIn('id', [$studentId])->update(['Allocated' => true]);
            User::whereIn('id', [$studentId])->update(['Allocated' => true]);
            $topicData->update(['Allocated' => $topicData->Allocated + 1]);
    
        $notification = [
            'message' => 'Project Allocation Successfully',
            'alert-type' => 'success'
        ];
    }else{
        $notification = [
            'message' => 'Insufficient Project Quotas',
            'alert-type' => 'error'
        ];
        continue;
    }
}

    return redirect()->route('modul_owner.allocationList')->with($notification);

    }

    public function viewAllocationResult()
    {
        $data = AllocationResult::all(); 

        return view('modul_owner.viewAllocationResult', ['data' => $data]);
    }

    public function projectUnallocate($id,$Project_ID)
    {
        
        $studentID = AllocationResult::where('id', $id)->first(); // Find the record to be deleted based on the project_id
        
        
        if ($studentID) { // Check if the record exists

            $studentID->delete();

            TopicData::where('Project_ID', $Project_ID)->decrement('Allocated');

            TopicSelection::where('id', $id)->update(['Allocated' => false]);

            User::where('id', $id)->update(['Allocated' => false]);

            $notification = [
                'message' => 'Record unallocate successfully',
                'alert-type' => 'success'
            ];
        } else {
            $notification = [
                'message' => 'Record not found or already deleted',
                'alert-type' => 'error'
            ];
        }
        return back()->with($notification);
    }

    public function uploadUserTable()
    {
        return view('modul_owner.uploadUserTable');
    }


    public function userStore(Request $request)
    {
        if ($request->hasFile('csv')) {
            $csvFile = $request->file('csv');
            $csv = Reader::createFromPath($csvFile->getPathname(), 'r');
            $csv->setHeaderOffset(0);
    
            $successCount = 0;
    
            foreach ($csv->getRecords() as $record) {
                $sellData = array_map('trim', $record);
                $existingRecord = User::where('name', $sellData['name'])->first(); // Check if a record with the same Project_ID exists
                
                //dd($sellData); check the update value

                if ($existingRecord) {
                    
                    $existingRecord->name = $sellData['name'];
                    $existingRecord->email = $sellData['email'];
                    //dd($sellData['role']);
                
                    $existingRecord->role = 'supervisor';
                    $existingRecord->password = Hash::make($sellData['password']);
                
                    $existingRecord->save(); 
                } else {
                    
                    $sellData['password'] = Hash::make($sellData['password']);
                    User::create($sellData);
                }
    
                $successCount++;
                
            }
           
    
            $notification = [
                'message' => $successCount . ' records uploaded successfully',
                'alert-type' => 'success'
            ];
            return back()->with($notification);
        }
    
        $notification = [
            'message' => 'CSV Upload error',
            'alert-type' => 'error'
        ];
        return back()->with($notification);
    }

    public function userDelete($Project_ID)
    {
        
        $UserData = User::where('id', $Project_ID)->first(); // Find the record to be deleted based on the project_id
        
        if ($UserData) { // Check if the record exists

            $UserData->delete();

            $notification = [
                'message' => 'Record deleted successfully',
                'alert-type' => 'success'
            ];
        } else {
            $notification = [
                'message' => 'Record not found or already deleted',
                'alert-type' => 'error'
            ];
        }
        return back()->with($notification);
    }  

    public function showUserList()
    {
        $data = User::all(); 

        return view('modul_owner.showUserList', ['data' => $data]);
    }

    public function showQuickAllocate()
    {
        $students = DB::table('topic_selections')
        ->where('Allocated', false)  // Checks Allocated is false before return values.
        ->get()
        ->toArray();


        usort($students, function ($a, $b) {
            return $a->Rank - $b->Rank;
        });

    //dd($students);

    return view('modul_owner.showQuickAllocate', ['students' => $students]);
    }


    public function quickAlloacte(Request $request)
    {
        $operatorId = auth()->user()->id;
        $selectedData = json_decode($request->input('selected_data'));
    
        foreach ($selectedData as $data) {
            $studentId = $data->studentId;
            $projectId = $data->projectId;
    
            
            $userData = User::where('id', $studentId)->first();
            $studentName = $userData ? $userData->name : null;
    
            
            $topicData = TopicData::where('Project_ID', $projectId)->first();
            $projectName = $topicData ? $topicData->Project_Name : null;
            $CsAcademic = $topicData ? $topicData->CS_Academic : null;
            $ContactEmail = $topicData ? $topicData->Contact : null;
    
            $userData = User::where('id', $operatorId)->first();
            $operatorName = $userData ? $userData->name : null;

            if ($topicData && $topicData->Quota - $topicData->Allocated > 0) {
    
            AllocationResult::create([
                'id' => $studentId, 
                'Name' => $studentName,
                'Project_ID' => $projectId,
                'Project_Name' => $projectName,
                'CS_Academic' => $CsAcademic,
                'Contact_Email' => $ContactEmail,
                'Allocation_Operator_Id' => $operatorId,
                'Allocation_Operator_Name' => $operatorName,
                'Allocated' => true
            ]);
    

            TopicSelection::whereIn('id', [$studentId])->update(['Allocated' => true]);
            User::whereIn('id', [$studentId])->update(['Allocated' => true]);
            $topicData->update(['Allocated' => $topicData->Allocated + 1]);
    
        $notification = [
            'message' => 'Project Allocation Successfully',
            'alert-type' => 'success'
        ];
    }else{
        $notification = [
            'message' => 'Insufficient Project Quotas',
            'alert-type' => 'error'
        ];
        continue;
    }
}
    
        return redirect()->route('modul_owner.allocationList')->with($notification);
    }
    





















    public function Modul_ownerLogout(Request $request){

        Auth::guard('web')->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/modul_owner/modul_ownerLogin');
        }// end method



        public function modul_ownerLogin(){
            return view('modul_owner.modul_ownerLogin');
        }// end method





}