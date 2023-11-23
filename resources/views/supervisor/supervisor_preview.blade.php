<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

@extends('supervisor.supervisor_dashboard')

@section('supervisor')

<div class="page-content">
    <div class="col-md-12 col-xl-12 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10%">CS Academic/Project ID</th>
                                <th style="width: 60%">Research Area(s)/Interest(s)/Project Detail</th>
                                <th style="width: 10%">Additional Resource</th>
                                <th style="width: 5%">Contact</th>
                                <th style="width: 5%">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $row->CS_Academic }}<br>
                                        {{ $row->Project_ID}}
                                    </td>
                                    <td style="max-width: 200px; white-space: normal">
                                        {{ $row->Research_Area }}<br><p> </p><br>
                                        <strong>{{  $row->Project_Name}}</strong><br><p> </p><br>
                                        {{  $row->Project_Detail  }} <br><p> </p><br>
                                        <strong>Associate Supervisor(s): </strong> {{  $row->Associate_Supervisor  }} <br><p> </p><br>
                                        <strong>Prerequisite:</strong> {{ $row->Prerequisite }} <br><p> </p><br>
                                        <strong>Suitable For:</strong> {{ $row->Suitable_for }} <br><p> </p><br>
                                        <strong>Quota:</strong> {{ $row->Quota }} <br><p> </p><br>
                                        <strong>References (if any):</strong> {{ $row->References }}
                                    </td>
                                    <td>{{ $row->Additional_Resource }}</td>
                                    <td>{{ $row->Contact }}</td>
                                    <td>
                                        @if ($row->hide)
                                            <i class="fas fa-eye" style="color: yellow;"></i> <!-- Yellow icon for true -->
                                        @else
                                            <i class="fas fa-eye" style="color: green;"></i> <!-- Green icon for false -->
                                        @endif
                                        <button type="button" class="btn btn-warning hide-btn" data-toggle="modal" data-target="#hideModal{{ $row->Project_ID }}" data-status="{{ $row->hide ? 'hidden' : 'visible' }}">
                                            @if ($row->hide)
                                                Hide
                                            @else
                                                Unhide
                                            @endif
                                        </button>

                                        <button type="button" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#deleteModal{{ $row->Project_ID }}">Delete</button>
                                    </td>
                                </tr>
                                <!-- Modal for Delete Confirmation -->
                                <div class="modal fade" id="deleteModal{{ $row->Project_ID}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this record?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('supervisor.topicDelete', $row->Project_ID)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Modal -->
                                <!-- Modal for Hide Confirmation -->
                                <div class="modal fade" id="hideModal{{ $row->Project_ID }}" tabindex="-1" role="dialog" aria-labelledby="hideModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="hideModalLabel">Confirm Hide</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to hide this record?
                                            </div>
                                            <div class="modal-footer">
                                                <form id="hideForm" method="POST" action="{{ route('supervisor.supervisor_unhideProjectID', $row->Project_ID)}}">
                                                    @csrf
                                                    <input type="hidden" name="project_id" id="project_id" value="{{ $row->Project_ID }}">
                                                    <button type="submit" class="btn btn-success">Unhide</button>
                                                </form>
                                                <form id="hideForm" method="POST" action="{{ route('supervisor.supervisor_hideProjectID', $row->Project_ID)}}">
                                                    @csrf
                                                    <input type="hidden" name="project_id" id="project_id" value="{{ $row->Project_ID }}">
                                                    <button type="submit" class="btn btn-warning">Hide</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Bootstrap and jQuery scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<script>
    $(document).ready(function() {

        $('.hide-btn').on('click', function() {
            var button = $(this); // 

            var modal = $(button.data('target'));
            modal.modal('show');

            modal.find('.hide-confirm-btn').on('click', function() {
                var status = button.data('status'); 

                if (status === 'hidden') {
                    button.text('Hide');
                    button.data('status', 'visible');
                    button.removeClass('btn-success').addClass('btn-warning');
                } else {
                    button.text('Unhide');
                    button.data('status', 'hidden');
                    button.removeClass('btn-warning').addClass('btn-success');
                }


                modal.modal('hide');
            });
        });
    });
</script>






