
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
                            <tr><th style="width: 5%">Student ID</th>
                                <th style="width: 10%">Student Name</th>
                                <th style="width: 5%">Project ID</th>
                                <th style="width: 40%">Project Name</th>
                                <th style="width: 10%">CS Academic</th>
                                <th style="width: 10%">Contact email</th>
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
