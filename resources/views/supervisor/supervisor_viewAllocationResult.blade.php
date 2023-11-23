
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

@extends('supervisor.supervisor_dashboard')

@section('supervisor')

<div class="page-content">
    <div class="col-md-12 col-xl-12 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr><th style="width: 5%">Student ID</th>
                                <th style="width: 10%">Student Name</th>
                                <th style="width: 5%">Project ID</th>
                                <th style="width: 40%">Project Name</th>
                                <th style="width: 10%">CS Academic</th>
                                <th style="width: 10%">Contact email</th>
                                <th style="width: 10%">Allocation Operator Id</th>
                                <th style="width: 10%">Allocation Operator Name</th>
                                <th style="width: 10%">Edit</th>
                            </tr>
                        </thead> 
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td> {{ $row->id }}</td>
                                    <td style="white-space: normal;"> {{ $row['Name'] }}</td>
                                    <td> {{ $row['Project_ID'] }}</td>
                                    <td style="white-space: normal;"> {{ $row['Project_Name'] }}</td>
                                    <td style="white-space: normal;"> {{ $row['CS_Academic'] }}</td>
                                    <td> {{ $row['Contact_email'] }}</td>
                                    <td> {{ $row['Allocation_Operator_Id'] }}</td>
                                    <td> {{ $row['Allocation_Operator_Name'] }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#deleteModal{{ $row->id }}" data-project-id="{{ $row->Project_ID}} ">Unallocate</button>

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

@foreach ($data as $row)
    <!-- Modal for Delete Confirmation -->
    <div class="modal fade" id="deleteModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Unallocate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to Unallocate this project?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('supervisor.supervisor_projectUnallocate', ['id' => $row->id, 'Project_ID' => $row->Project_ID]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="project_id" name="project_id" value="{{ $row->Project_ID }}">
                        <button type="submit" class="btn btn-danger">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal -->
@endforeach



@endsection
