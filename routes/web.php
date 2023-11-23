<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Modul_ownerController;
use App\Http\Controllers\SupervisorController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
//student group middleware
Route::middleware(['auth','role:student'])->group(function(){
    Route::get('/student/dashboard', [StudentController::class, 'StudentDashboard'])-> name('student.dashboard');
    Route::get('/student/logout', [StudentController::class, 'StudentLogout'])->name('student.logout');
    Route::get('/student/profile', [StudentController::class, 'StudentProfile'])-> name('student.profile');
    Route::post('/student/profile/store', [StudentController::class, 'StudentProfileStore'])-> name('student.profile.store');
    Route::get('/student/change/password', [StudentController::class, 'StudentChangePassword'])-> name('student.change.password');
    Route::post('/student/update/password', [StudentController::class, 'StudentUpdatePassword'])-> name('student.update.password');
    Route::get('/student/topicList', [StudentController::class, 'StudentTopicList'])->name('student.topicList'); 
    Route::get('/student/uploadTopic', [StudentController::class, 'studentUploadTopic'])->name('student.uploadTopic');
    Route::post('/student/selectTopic', [StudentController::class, 'studentSelectTopic'])->name('student.selectTopic');
    Route::get('/student/get-project-id', [StudentController::class, 'getProjectId']);
    Route::get('/student/reviewSelectList', [StudentController::class, 'studentReviewSelectList'])->name('student.reviewSelectList');
    Route::post('/student/update-project-id', [StudentController::class, 'studentUpdateProjectID'])->name('student.updateProjectID');
    Route::get('/student/viewAllocationResult', [StudentController::class, 'viewAllocationResult'])->name('student.viewAllocationResult'); 
    




});
//end group student middleware

//module owner group middleware
Route::middleware(['auth','role:modul_owner'])->group(function(){
    Route::get('/modul_owner/dashboard', [Modul_ownerController::class, 'Modul_ownerDashboard'])->name('modul_owner.dashboard');
    Route::get('/modul_owner/logout', [Modul_ownerController::class, 'Modul_ownerLogout'])->name('modul_owner.logout');
    Route::get('/modul_owner/upload', [Modul_ownerController::class, 'upload'])->name('modul_owner.upload');
    Route::get('/modul_owner/preview', [Modul_ownerController::class, 'showPreview'])->name('modul_owner.preview'); 
    Route::post('/modul_owner/topicStore', [Modul_ownerController::class,'topicStore'])->name('modul_owner.topicStore'); 
    Route::delete('/modul_owner/topicDelete/{project_id}', [Modul_ownerController::class, 'topicDelete'])->name('modul_owner.topicDelete');
    Route::get('/modul_owner/allocationList', [Modul_ownerController::class, 'allocationList'])->name('modul_owner.allocationList'); 
    Route::get('/modul_owner/processAllocate/{projectID}', [Modul_ownerController::class, 'processAllocate'])->name('modul_owner.processAllocate');
    Route::post('/modul_owner/allocationResult', [Modul_ownerController::class, 'allocationResult'])->name('modul_owner.allocationResult');
    Route::get('/modul_owner/viewAllocationResult', [Modul_ownerController::class, 'viewAllocationResult'])->name('modul_owner.viewAllocationResult');
    Route::delete('/modul_owner/unallocateProject/{id}/{Project_ID}', [Modul_ownerController::class, 'projectUnallocate'])->name('modul_owner.projectUnallocate');
    Route::get('/modul_owner/uploadUserTable', [Modul_ownerController::class, 'uploadUserTable'])->name('modul_owner.uploadUserTable');
    Route::post('/modul_owner/userStore', [Modul_ownerController::class,'userStore'])->name('modul_owner.userStore');
    Route::get('/modul_owner/showUserList', [Modul_ownerController::class, 'showUserList'])->name('modul_owner.showUserList'); 
    Route::delete('/modul_owner/userDelete/{id}', [Modul_ownerController::class, 'userDelete'])->name('modul_owner.userDelete');
    //Route::get('/modul_owner/quickAlloacte/{rank}', [Modul_ownerController::class, 'quickAlloacte'])->name('modul_owner.quickAlloacte');
    Route::get('/modul_owner/showUserList', [Modul_ownerController::class, 'showUserList'])->name('modul_owner.showUserList'); 
    Route::get('/modul_owner/showQuickAllocate', [Modul_ownerController::class, 'showQuickAllocate'])->name('modul_owner.showQuickAllocate');
    Route::post('/modul_owner/quickAlloacte', [Modul_ownerController::class, 'quickAlloacte'])->name('modul_owner.quickAlloacte');


});

//end group modul_owner middleware





Route::middleware(['auth','role:supervisor'])->group(function(){
    Route::get('/supervisor/dashboard', [SupervisorController::class, 'SupervisorDashboard'])-> name('supervisor.dashboard'); 
    Route::get('/supervisor/supervisor_logout', [SupervisorController::class, 'supervisor_logout'])->name('supervisor.supervisor_logout');
    Route::get('/supervisor/supervisor_preview', [SupervisorController::class, 'supervisorPreview'])->name('supervisor.supervisor_preview');
    Route::get('/supervisor/supervisor_upload', [SupervisorController::class, 'supervisor_upload'])->name('supervisor.supervisor_upload');
    Route::post('/supervisor/supervisor_topicStore', [SupervisorController::class,'supervisor_topicStore'])->name('supervisor.supervisor_topicStore'); 
    Route::delete('/supervisor/topicDelete/{project_id}', [SupervisorController::class, 'topicDelete'])->name('supervisor.topicDelete');
    Route::get('/supervisor/supervisor_allocationList', [SupervisorController::class, 'supervisor_allocationList'])->name('supervisor.supervisor_allocationList'); 
    Route::get('/supervisor/supervisor_processAllocate/{projectID}', [SupervisorController::class, 'supervisor_processAllocate'])->name('supervisor.supervisor_processAllocate');
    Route::post('/supervisor/supervisor_allocationResult', [SupervisorController::class, 'supervisor_allocationResult'])->name('supervisor.supervisor_allocationResult');
    Route::get('/supervisor/supervisor_viewAllocationResult', [SupervisorController::class, 'supervisor_viewAllocationResult'])->name('supervisor.supervisor_viewAllocationResult');
    Route::delete('/supervisor/supervisor_unallocateProject/{id}/{Project_ID}', [SupervisorController::class, 'supervisor_projectUnallocate'])->name('supervisor.supervisor_projectUnallocate');
    Route::post('/supervisor/supervisor_hideProjectID', [SupervisorController::class, 'supervisor_hideProjectID'])->name('supervisor.supervisor_hideProjectID');
    Route::post('/supervisor/supervisor_unhideProjectID', [SupervisorController::class, 'supervisor_unhideProjectID'])->name('supervisor.supervisor_unhideProjectID');
    




});//end group supervisor middleware

Route::get('/student/login', [StudentController::class, 'StudentLogin'])->name('student.login');
Route::get('/modul_owner/modul_ownerLogin', [Modul_ownerController::class, 'modul_ownerLogin'])->name('module_owner.modul_ownerLogin');
Route::get('/supervisor/supervisor_login', [SupervisorController::class, 'supervisor_login'])->name('supervisor.supervisor_login');



