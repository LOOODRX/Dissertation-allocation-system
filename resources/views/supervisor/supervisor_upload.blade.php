@extends('supervisor.supervisor_dashboard')

@section('supervisor')


<div class="page-content">
<div class="col-md-12 col-xl-10 middle-wrapper">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Upload CSV File</h6>
                <form action="{{ route('supervisor.supervisor_topicStore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="file" name="csv" class="form-control" id="exampleInputUsername1">
                        <br>
                        <button type="submit" class="btn btn-primary me-2">Upload</button>
                    </div>
                </form>
            </div>       
          </div>
    </div>
</div>
</div>


@endsection