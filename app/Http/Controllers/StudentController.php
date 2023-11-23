<?php

namespace App\Http\Controllers;

use App\Models\AllocationResult;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\TopicData;
use App\Models\TopicSelection;
use App\Models\User;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Stmt\Else_;
use Termwind\Components\Dd;

class StudentController extends Controller
{
    public function StudentDashboard(){


        $totalProjects = TopicData::where('hide', false)->count();

        $totalAllocatedProjects = TopicData::where('Allocated', true) ->where('hide', false)->count();

        $data = [
            'totalProjects' => $totalProjects,
            'totalAllocatedProjects' => $totalAllocatedProjects,
        ];

        return view('student.index',$data);

    }// end method 
    
    public function StudentLogout(Request $request){

    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/student/login');
    }// end method

    public function StudentLogin(){
        return view('student.student_login');
    }// end method

    public function StudentProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('student.student_profile_view', compact('profileData'));
    }// end method

    public function StudentProfileStore(Request $request) {
        $id = Auth::user() -> id;
        $data = User::find($id);
        $data -> name = $request -> name;
        $data -> email = $request -> email;
        $data -> phone = $request -> phone;
        $data -> address = $request -> address;
        
        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/student_image/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();// get unique id 23232.aaryian.png
            $file->move(public_path('upload/student_images/'),$filename);
            $data['photo'] = $filename;
        }

        $data -> save();

        $notification = array(
            'message' => 'Student Profile Update Successfully',
            'alert-type' => 'success'
        );

        return redirect() -> back() -> with($notification);

    }

    public function StudentChangePassword() {
        $id = Auth::user() -> id;
        $profileData = User::find($id);
        return view('student.student_change_password',compact('profileData'));
    }

    public function StudentUpdatePassword(Request $request){
        //validation
        $request -> validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);
        // match the old password
        if(!Hash::check($request->old_password, auth::user()->password)){
            $notification = array(
                'message' => 'Old Password Does Not Match!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        } 
        // update the new password
        user::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function StudentTopicList()
{
    $data = TopicData::where('hide',false)->where('Quota', '<>', 'Allocated')->get();

    return view('student.student_topicList', ['data' => $data]);
}

public function studentUploadTopic()
{
    return view('student.student_topic_selection');
}

public function studentSelectTopic(Request $request)
{

    $currentUserId = auth()->user()->id;
    $topics = $request->input('Project_ID');
    $ranks = $request->input('Rank');
    $contacted = $request->input('Contacted');

    TopicSelection::where('id', $currentUserId)->delete(); //Delete the final version table
    $userName = auth()->user()->name;
    foreach ($topics as $key => $topicId) {
    $rank = isset($ranks[$key]) ? $ranks[$key] : null;
       $contactedBoolValues = array_map(function ($value) {
            return (bool) $value;
        }, $contacted);
        //dd($contactedBoolValues);
        

        $topicData = TopicData::where('Project_ID', $topicId)->first(); //get extend values from topic_data table
        $projectName = $topicData ? $topicData->Project_Name : null;
        $csAcdamic = $topicData ? $topicData->CS_Academic : null;
        $Contact = $topicData ? $topicData->Contact : null;
        $Quota = $topicData ? $topicData->Quota : null;

        TopicSelection::create([
            'id' => $currentUserId,
            'Name' => $userName,
            'Project_ID' => $topicId,
            'Project_Name' => $projectName,
            'CS_Academic' => $csAcdamic, 
            'Contact_email' => $Contact,
            'Rank' => $rank,
            'Quota' => $Quota,
            'Contacted_with_supervisor' => $contactedBoolValues[$key],
        ]);
    }

    $notification = [
        'message' => 'Topic Selection Successfully',
        'alert-type' => 'success'
    ];
    return redirect()->back()->with($notification);
}



public function getProjectId(Request $request)
{
    $search = $request->input('search');
    
    $projects = TopicData::where('Project_ID', 'LIKE', "%$search%")->get();
    
    $matchingIds = $projects->pluck('Project_ID')->toArray();

    return response()->json($matchingIds);
}


public function studentReviewSelectList()
{
    $currentUserId = Auth::id();
    $data = TopicSelection::where('id', $currentUserId)->get();
    $projectIDs = TopicSelection::pluck('Project_ID')->toArray();

    //dd($projectIDs);

    return view('student.student_review_select_list', [
    'data' => $data,
    'projectIDs' => $projectIDs,]);
}


public function studentUpdateProjectID(Request $request)
{
    $newProjectID = $request->input('newProject_ID');
    $currentUserId = auth()->user()->id;

    $existingRecord = TopicSelection::where('Project_ID', $newProjectID)->first(); // check have same Project_ID records

    if ($existingRecord && $existingRecord->id == $currentUserId) { // if Project_ID already exists
    
        
        $notification = [
            'message' => "Project ID [$newProjectID] Already Exists",
            'alert-type' => 'error'
        ];

        return redirect()->back()->with($notification);
    } 

    
    $topicData = TopicData::where('Project_ID', $newProjectID)->first(); //get extend values from topic_data table
    $projectName = $topicData ? $topicData->Project_Name : null;
    $csAcademic = $topicData ? $topicData->CS_Academic : null;
    $Contact = $topicData ? $topicData->Contact : null;
    $Quota = $topicData ? $topicData->Quota : null;

    TopicSelection::where('id', $currentUserId)
        ->where('Project_ID', $request->input('currentProjectID'))
        ->update([
            'Project_ID' => $newProjectID,
            'Project_Name' => $projectName, 
            'CS_Academic' => $csAcademic, 
            'Contact_email' => $Contact,
            'Quota' => $Quota,
        ]);

    $notification = [
        'message' => 'Project ID Updated Successfully',
        'alert-type' => 'success'
    ];

    return redirect()->back()->with($notification);
}

    public function viewAllocationResult()
    {
        $currentUserId = Auth::id();
        $data = AllocationResult::where('id', $currentUserId)->get();

        //dd($projectIDs);

        return view('student.student_viewAllocationResult', ['data' => $data]);
    }

     



}
