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
use Illuminate\Support\Facades\DB;

class SupervisorController extends Controller
{
    public function SupervisorDashboard(){

        $currentUserName = auth()->user()->name;

        $totalProjects = TopicData::where('CS_Academic', $currentUserName)->count();        

        $totalAllocatedProjects = TopicData::where('CS_Academic', $currentUserName)-> where('Allocated', true)->count();

        $totalStudents = TopicSelection::where('CS_Academic', $currentUserName)->distinct('id') ->count();

        $totalAllocatedStudents = TopicSelection::where('CS_Academic', $currentUserName) -> where('Allocated', true)->distinct('id') ->count();

        $data = [
            'totalProjects' => $totalProjects,
            'totalAllocatedProjects' => $totalAllocatedProjects,
            'totalStudents' => $totalStudents,
            'totalAllocatedStudents' => $totalAllocatedStudents,
        ];


        return view('supervisor.supervisor_index',$data);
    }

    

    public function supervisorPreview()
    {
        $currentUserName = auth()->user()->name;
        $data = TopicData::where('CS_Academic', $currentUserName)
        ->where('Quota', '<>', 'Allocated')
        ->get();


        return view('supervisor.supervisor_preview', ['data' => $data]);
    }

    public function supervisor_upload()
    {
        return view('supervisor.supervisor_upload');
    }

    public function supervisor_topicStore(Request $request)
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

    public function supervisor_allocationList()

    {   $currentUserName = auth()->user()->name;
        
        $projectData = DB::table('topic_selections')
        ->select(
            'Project_ID',
            'Project_Name',
            'CS_Academic',
            'Contact_email',
            DB::raw('count(*) as selection_count')
        )
        ->where('CS_Academic', $currentUserName)
        ->where('Allocated', false)  // Checks Allocated is false before return values.
        ->groupBy('Project_ID', 'Project_Name', 'CS_Academic', 'Contact_email')
        ->get();

        $result = [];
        foreach ($projectData as $row) {
            $result[] = [
            'Project_ID' => $row->Project_ID , 
            'Project_Name' => $row->Project_Name , 
            'CS_Academic' => $row->CS_Academic , 
            'Contact_email' => $row->Contact_email , 
            'selection_count' => $row->selection_count ,
        ];
    }

        return view('supervisor.supervisor_allocationList', [
            'projectData' => $result
        ]);
            
        }

    public function supervisor_processAllocate($projectID)
    {
        $students = DB::table('topic_selections')
        ->where('Project_ID', $projectID)
        ->where('Allocated', false)  // Checks Allocated is false before return values.
        ->get()
        ->toArray();

        $Quota = DB::table('topic_data')
        ->where('Project_ID', $projectID)
        ->where('Allocated', false)  // Checks Allocated is false before return values.
        ->value('Quota');

        usort($students, function ($a, $b) {
            return $a->Rank - $b->Rank;
        });

    //dd($students);

    return view('supervisor.supervisor_processAlloate', ['students' => $students, 'projectID' => $projectID, 'Quota' => $Quota]);
    }

    public function supervisor_allocationResult(Request $request)
    {
    
        $studentIds = $request->input('student_ids'); //get check box values (arry)
        $projectID = $request->input('project_id'); // single values
        $operatorId = auth()->user()->id; // single values
    
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
    
        return redirect()->route('supervisor.supervisor_allocationList')->with($notification);
    
        }
    
        public function supervisor_viewAllocationResult()
        {
            $currentUserName = auth()->user()->name;
            $data = AllocationResult::where('CS_Academic', $currentUserName)->get();
    
            return view('supervisor.supervisor_viewAllocationResult', ['data' => $data]);
        }
    
        public function supervisor_projectUnallocate($id,$Project_ID)
        {
            
            $studentID = AllocationResult::where('id', $id)->first(); // Find the record to be deleted based on the project_id
            
            
            if ($studentID) { // Check if the record exists
    
                $studentID->delete();
    
                TopicData::where('Project_ID', $Project_ID)->decrement('Allocated');
    
                TopicSelection::where('id', $id)->update(['Allocated' => false]);
    
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

        public function supervisor_hideProjectID(Request $request){            

            $projectID = $request->input('project_id');  

    
            $topicData = TopicData::where('Project_ID', $projectID)->first();

            if ($topicData) {
            // Record found, update the Allocated column to true                    
            $topicData->update(['hide' => true]);                    
                    
            $notification = [                        
                    
            'message' => 'Record hide successfully',
            'alert-type' => 'success'
                    ];
                } 
                
            else {

            $notification = [
                                            
            'message' => 'Record not found or already hide',
                        'alert-type' => 'error'
                    ];
                }

                return back()->with($notification);
            }
            
            public function supervisor_unhideProjectID(Request $request){            

                $projectID = $request->input('project_id');  
    
        
                $topicData = TopicData::where('Project_ID', $projectID)->first();
    
                if ($topicData) {
                // Record found, update the Allocated column to true                    
                $topicData->update(['hide' => false]);                    
                        
                $notification = [                        
                        
                'message' => 'Record unhide successfully',
                'alert-type' => 'success'
                        ];
                    } 
                    
                else {
    
                $notification = [
                                                
                'message' => 'Record not found or already hide',
                            'alert-type' => 'error'
                        ];
                    }
    
                    return back()->with($notification);
                }












    public function supervisor_logout(Request $request){

        Auth::guard('web')->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/supervisor/supervisor_login');
        }// end method



        public function supervisor_login(){
            return view('supervisor.supervisor_login');
        }// end method



}
