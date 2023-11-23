
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

@extends('modul_owner.modul_ownerDashboard')
@section('modul_owner')

<div class="page-content">
    
    <div class="col-md-12 col-xl-12 middle-wrapper">
        
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="quick-allocate-button">
                        <a href="{{ route('modul_owner.showQuickAllocate') }}"  class="btn btn-primary edit-btn ">Quick Allocate</a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10%">Project ID</th>
                                <th style="width: 50%">Project Name</th>
                                <th style="width: 10%">CS Academic</th>
                                <th style="width: 10%">Contact email</th>
                                <th style="width: 10%">Number of selections</th>
                                <th style="width: 10%">Allocate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projectData as $row)
                                <tr>
                                    <td> {{ $row['Project_ID'] }}</td>
                                    <td style="white-space: normal;"> {{ $row['Project_Name'] }}</td>
                                    <td style="white-space: normal;"> {{ $row['CS_Academic'] }}</td>
                                    <td> {{ $row['Contact_email'] }}</td>
                                    <td> {{ $row['selection_count'] }}</td>
                                    <td>
                                        <button type="submit" name="projectID" class="btn btn-primary edit-btn " data-project-id="{{ $row['Project_ID'] }}" >Allocate</button>

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


@endsection

<script>
$(document).ready(function () {
    $('.edit-btn').on('click', function () {
        var projectID = $(this).data('project-id');
        window.location.href = "{{ route('modul_owner.processAllocate', '') }}/" + projectID; //jump to the new view page
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