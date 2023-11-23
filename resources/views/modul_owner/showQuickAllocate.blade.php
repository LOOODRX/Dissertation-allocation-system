<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<style>
    /* Apply custom styles to your table to control its layout */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: left;
    }
</style>

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
                            <div class="mb-3">
                                <label  class="form-label">Select Choice Rank:</label>
                                <select class="form-select" id="rankSelect" name="rankSelect" required>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>                          
                    </div>
                    <form id="allocation-form" method="POST" action="{{ route('modul_owner.quickAlloacte') }}">
                        
                        @csrf
                    <table >
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <button type="submit" name="Allocate_project" class="btn btn-primary edit-btn" onclick="allocateStudents()">Allocate</button>
                            <input type="hidden" id="selected-data" name="selected_data" value="[]">
                            <div>
                                <button type="button" class="btn btn-primary" id="selectAll" name="selectAll">Select All</button>
                                <button type="button" class="btn btn-secondary" id="undoSelectAll" name="undoSelectAll">Undo Select All</button>
                            </div>
                        </div>
                        <thead>
                            <tr>
                                <th style="max-width: 50px; white-space: normal">Student ID</th>
                                <th style="max-width: 50px; white-space: normal">Student Name</th>
                                <th style="max-width: 120px; white-space: normal">Project ID</th>
                                <th style="max-width: 200px; white-space: normal">Project Name</th>
                                <th style="max-width: 50px; white-space: normal">CS Academic</th>
                                <th style="max-width: 100px; white-space: normal">Quota</th>
                                <th style="max-width: 100px; white-space: normal">Rank</th>
                                <th style="max-width: 100px; white-space: normal">Allocate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                            <tr class="student-row" data-rank="{{ $student->Rank }}">
                                <td>{{ $id = $student->id;}}</td>
                                <td>{{ $name = $student->Name; }}</td>
                                <td>{{ $projectID = $student->Project_ID; }}</td>
                                <td>{{ $projectName = $student->Project_Name; }}</td>
                                <td>{{ $CS_Academic = $student->CS_Academic; }}</td>
                                <td>{{ $Quota = $student->Quota; }}</td>
                                <td>{{ $Rank = $student->Rank;}}</td>
                                <td>
                                    <input type="checkbox" name="student_ids[]" class="student-checkbox" data-student-id="{{ $student->id }}" data-project-id="{{ $projectID }}" data-rank="{{ $Rank }}" data-project-quota="{{ $Quota }}">
                                </td>
                            </tr>
                            @endforeach
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



$(document).ready(function() {

    $('#selectAll').on('click', selectAll);

    $('#undoSelectAll').on('click', undoSelectAll);
    
    $('#rankSelect').on('change', filterByRank);// Bind the event listener after the document is fully loaded
    
    filterByRank(); // Call filterByRank initially to ensure the correct rows are displayed
});

function filterByRank() {
    var selectedRank = $('#rankSelect').val();
    currentSelectedRank = selectedRank; // 
    
    $('.student-row').hide(); 
    $('.student-row[data-rank="' + selectedRank + '"]').show(); 
}

function undoSelectAll() {
    // Uncheck all the checkboxes with the class 'student-checkbox' and the current selected rank
    $('.student-row[data-rank="' + currentSelectedRank + '"] .student-checkbox').prop('checked', false);
}

function selectAll() {
    var selectedRank = $('#rankSelect').val();
    var projectQuotas = {}; // Object to store project quotas
    var selectedProjectIds = {}; // Object to store selected project IDs and their counts

    // Iterate through the checkboxes and count selected project IDs
    $('.student-row[data-rank="' + selectedRank + '"] .student-checkbox').each(function() {
        var projectId = $(this).data('project-id');
        var projectQuota = $(this).data('project-quota');

        // Initialize the count if the project is not in the object
        if (!(projectId in selectedProjectIds)) {
            selectedProjectIds[projectId] = 0;
        }

        // Check if selecting this checkbox would exceed the quota
        if (selectedProjectIds[projectId] >= projectQuota) {
            // Uncheck all checkboxes with the same project ID
            $('.student-checkbox[data-project-id="' + projectId + '"]').prop('checked', false);
        } else {
            // Allow selection and increment the count
            $(this).prop('checked', true);
            selectedProjectIds[projectId]++;
        }
    });
}


function allocateStudents() {
    var selectedData = [];

    $('.student-checkbox:checked').each(function() {
        var studentId = $(this).data('student-id');
        var projectId = $(this).data('project-id');
        var quota = $(this).data('project-quota');

        selectedData.push({
            studentId: studentId,
            projectId: projectId,
            quota: quota
        });
    });

    $('#selected-data').val(JSON.stringify(selectedData));

    $('#allocation-form').submit();
}

    
    
</script>