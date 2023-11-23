<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@extends('student.student_dashboard')
@section('student')
<div class="page-content">
    <div class="col-md-12 col-xl-12 middle-wrapper">
        <div class="row">
            <div class="card">
                <div>
                    <button type="button" class="btn btn-primary filter-btn" data-filter="Applied AI">Applied AI</button>
                    <button type="button" class="btn btn-primary filter-btn" data-filter="AI">AI</button>                    
                    <button type="button" class="btn btn-primary filter-btn" data-filter="AIBS">AIBS</button>
                    <button type="button" class="btn btn-primary filter-btn" data-filter="CS">CS</button>
                    <button type="button" class="btn btn-primary filter-btn" data-filter="Show All">Show All Project</button>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10%">CS Academic/Project ID</th>
                                <th style="width: 70%">Research Area(s)/Interest(s)/Project Detail</th>
                                <th style="width: 10%">Additional Resource</th>
                                <th style="width: 10%">Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $row->CS_Academic }}<br>
                                        {{ $row->Project_ID }}
                                    </td>
                                    <td style="max-width: 200px; white-space: normal" class="project-details" data-suitable-for="{{ $row->Suitable_for }}">
                                        {{ $row->Research_Area }}<br><p> </p><br>
                                        <strong>{{  $row->Project_Name  }}</strong><br><p> </p><br>
                                        {{  $row->Project_Detail  }} <br><p> </p><br>
                                        <strong>Associate Supervisor(s): </strong> {{  $row->Associate_Supervisor  }} <br><p> </p><br>
                                        <strong>Prerequisite:</strong> {{ $row->Prerequisite }} <br><p> </p><br>
                                        <strong>Suitable For:</strong> {{ $row->Suitable_for }} <br><p> </p><br>
                                        <strong>Quota:</strong> {{ $row->Quota }} <br><p> </p><br>
                                        <strong>References (if any):</strong> {{ $row->References }}
                                    </td>
                                    <td>{{ $row->Additional_Resource }}</td>
                                    <td>{{ $row->Contact }}</td>
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