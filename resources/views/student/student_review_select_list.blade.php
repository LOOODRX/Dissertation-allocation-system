
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

@extends('student.student_dashboard')
@section('student')
<div class="page-content">
    <div class="col-md-12 col-xl-12 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10%">Project_ID</th>
                                <th style="width: 50%">Project_Name</th>
                                <th style="width: 10%">CS_Academic</th>
                                <th style="width: 10%">Rank</th>
                                <th style="width: 10%">Contacted_with_supervisor</th>
                                <th style="width: 10%">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $row->Project_ID }}</td>
                                    <td>{{ $row->Project_Name }}</td>
                                    <td>{{ $row->CS_Academic }}</td>
                                    <td>{{ $row->Rank }}</td>
                                    <td>@if ($row->Contacted_with_supervisor)
                                        Yes
                                    @else
                                        No
                                    @endif</td>
                                    <td>
                                        <button class="btn btn-primary edit-btn" data-project-id="{{ $row->Project_ID }}">Edit</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editProjectForm" form id="topic-form" method="POST" action="{{ route('student.updateProjectID') }}">
                @csrf 
            <div class="modal-header">
                <h5 class="modal-title" id="editProjectModalLabel">Edit Project ID</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="currentProjectID" class="form-label">Current Project ID:</label>
                    <input type="text" name="currentProjectID" id="currentProjectID" class="form-control current-project-id readonly-input" readonly>
                </div>                
                
                    <div class="mb-3">
                        <label for="newProjectID" class="form-label">New Project ID:</label>
                        <input type="text" name="newProject_ID" class="form-control new-project-id">
                        <div class="id-autocomplete-list"></div>
                        <div class="error-label"></div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="saveProjectID">Save</button>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection

<script>
$(document).ready(function () {
    
    $('.edit-btn').on('click', function () {
        var projectID = $(this).data('project-id');
        $('.new-project-id').val(projectID);
        // set currentProjectID value as projectID
        $('#currentProjectID').val(projectID);
        $('#editProjectModal').modal('show');
    });

    $('.new-project-id').on('input', function () {
        var projectId = $(this).val();
        var autocompleteList = $(this).closest('form').find('.id-autocomplete-list');
        var currentInput = $(this);
        var errorLabel = $(this).closest('form').find('.error-label');
        

        if (projectId.length >= 1) {
            $.get('/student/get-project-id', { search: projectId })
                .done(function (data) {
                    autocompleteList.html('');
                    data.forEach(function (item) {
                        autocompleteList.append('<div class="autocomplete-item">' + item + '</div>');
                    });

                    autocompleteList.show();
                    errorLabel.hide();

                    autocompleteList.on('click', '.autocomplete-item', function () {
                        var selectedProjectId = $(this).text();
                        var isDuplicate = false;

                        $('.new-project-id').not(currentInput).each(function () {
                            if ($(this).val() === selectedProjectId) {
                                isDuplicate = true;
                                $(this).css('border-color', 'red');
                                errorLabel.text('Duplicate Project ID').css('color', 'red').show();
                                currentInput.val('');
                                return false;
                            }
                        });

                        if (!isDuplicate) {
                            currentInput.val(selectedProjectId);
                            $('.new-project-id').css('border-color', '');
                            errorLabel.hide();
                        }

                        autocompleteList.hide();
                    });
                })
                .fail(function () {
                    autocompleteList.html('');
                });
        } else {
            autocompleteList.html('');
            autocompleteList.hide();
        }
    });
    


});
</script>
<style>
    .id-autocomplete-list {
    background-color: #f7f8f8; 
    border: 1px solid #0a0a00; 
    color: #0e0a0a; 
    border-radius: 5px;
    max-height: 200px;
    overflow-y: auto;
    display: none;
}


.id-autocomplete-list .autocomplete-item:hover {
    background-color: #a5a2a2; 
    cursor: pointer;
}



.id-autocomplete-list .autocomplete-item {
    padding: 10px; 
    border-bottom: 1px solid #ccc; 
}


.id-autocomplete-list .autocomplete-item:last-child {
    border-bottom: none;
}

.readonly-input {
        background-color: #f2f2f2; 
        color: #333; 
        border: 1px solid #ccc; 
        padding: 5px; 
}
   
</style>