@extends('modul_owner.modul_ownerDashboard')
@section('modul_owner')

<div class="page-content">
    <div class="col-md-12 col-xl-12 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <a href="{{ route('modul_owner.allocationList') }}" class="btn btn-secondary">Back</a>
                        </div>
                        <div class="col-4 text-right">
                            <p>Project ID: {{ $projectID }}</p>
                            <p>Quota: {{ $Quota }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('modul_owner.allocationResult') }}">
                        @csrf
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10%">Student ID</th>
                                <th style="width: 50%">Student Name</th>
                                <th style="width: 10%">Student email</th>
                                <th style="width: 10%">Rank</th>
                                <th style="width: 10%">Allocate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $id = $student->id;}}</td>
                                    <td>{{ $name = $student->Name; }}</td>
                                    <td>{{ $projectID = $student->Project_ID; }}</td>
                                    <td>{{ $Rank = $student->Rank;}}</td>
                                    <td>
                                        <input type="checkbox" name="student_ids[]" class="student-checkbox" value="{{ $student->id }}" data-project-id="{{ $projectID }}">
                                    </td>
                                </tr>
                                
                            @endforeach
                            <tr>
                                <td>
                                    <div>
                                        <input type="hidden" name="project_id" id="project_id" value="{{ $projectID }}">
                                        <button type="button" name="Allocate_project" class="btn btn-primary edit-btn" onclick="allocateStudents()">Allocate</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function allocateStudents() {
    var studentIds = [];
    var projectId = '{{ $projectID }}';
    

    $('.student-checkbox:checked').each(function() {  // Traverse the checked student checkboxes
        studentIds.push($(this).val());
        console.log(studentIds);
    });

    if (studentIds.length === 0) {
        alert('Please select at least 1 student to allocate.');
        return;
    }

    var quota = '{{ $Quota }}';  // Check whether the number of students is less than or equal to quota
    if (studentIds.length > quota) {
        alert('You can allocate a maximum of ' + quota + ' students for this project.');
        return;
    }

    $('#student-ids').val(studentIds.join(',')); //Set the value of the hidden field to the checked student ID

    $('#project-id').val(projectId);

    $('form').submit();
    }
</script>
    