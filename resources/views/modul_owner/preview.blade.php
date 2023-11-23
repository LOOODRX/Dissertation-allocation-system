<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@extends('modul_owner.modul_ownerDashboard')

@section('modul_owner')


<div class="page-content">
    <div class="col-md-12 col-xl-12 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div>
                        <button type="button" class="btn btn-primary filter-btn" data-filter="Applied AI">Applied AI</button>
                        <button type="button" class="btn btn-primary filter-btn" data-filter="AI">AI</button>                        
                        <button type="button" class="btn btn-primary filter-btn" data-filter="AIBS">AIBS</button>
                        <button type="button" class="btn btn-primary filter-btn" data-filter="CS">CS</button>
                        <button type="button" class="btn btn-primary filter-btn" data-filter="Show All">Show All Project</button>
                    </div>
                    <div class="table-responsive">
                    <table class="table" style="max-width: 600px;">
                        <thead>
                            <tr>
                                <th style="width: 10%">CS Academic/Project ID</th>
                                <th style="width: 70%">Research Area(s)/Interest(s)/Project Detail</th>
                                <th style="width: 10%">Additional Resource</th>
                                <th style="width: 5%">Contact</th>
                                <th style="width: 5%">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $row->CS_Academic }}<br>
                                        {{ $row->Project_ID}}
                                    </td>
                                    <td style="max-width: 200px; white-space: normal" class="project-details" data-suitable-for="{{ $row->Suitable_for }}">
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
                                                <form action="{{ route('modul_owner.topicDelete', $row->Project_ID)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




<style>
    /* Add CSS for the table container */
    .table-container {
        overflow-x: auto;
        max-width: 100%; /* Optional: Set a maximum width for the scrollable container */
    }
</style>

<script>
    $(document).ready(function() {
        // Listen for click events on filter buttons
        $('.filter-btn').on('click', function() {
            var filterValue = $(this).data('filter'); // Get the data-filter attribute value of the button
            filterProjects(filterValue); // Call the filtering function
        });

        // Initially display all projects
        filterProjects('Show All');
    });

    function filterProjects(filterValue) {
        // Iterate through project rows
        $('.table tbody tr').each(function() {
            var row = $(this);
            var suitableFor = row.find('.project-details').data('suitable-for'); // Get the value of the custom attribute

            // Split the Suitable For value into a string array
            var suitableForArray = suitableFor.split(',').map(function(item) {
                return item.trim(); // Remove leading and trailing whitespace from each value
            });

            // If the filter value is "Show All" or a match is found in the Suitable For array, display the project row; otherwise, hide it
            if (filterValue === 'Show All' || suitableForArray.includes(filterValue)) {
                row.show();
            } else {
                row.hide();
            }
        });
    }

</script>