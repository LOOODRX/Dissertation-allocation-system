<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@extends('student.student_dashboard')
@section('student')
<div class="page-content">
    <div class="col-md-12 col-xl-12 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <form id="topic-form" method="POST" action="{{ route('student.selectTopic') }}">
                        @csrf 

                        <table class="table" style="width: 41cm">
                            <thead>
                                <tr>
                                    <th style="width: 40%">Topic ID</th>
                                    <th style="width: 40%">Rank</th>
                                    <th style="width: 20%">Contacted with Supervisor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 1; $i <= 10; $i++)
                                <tr>
                                    <td>
                                        <input type="text" name="Project_ID[]" class="form-control topic-id">
                                        <div class="id-autocomplete-list"></div>
                                        <span class="error-label" style="color: red;"></span>
                                    </td>
                                    <td>
                                        <input type="text" name="Rank[]" value="{{ $i }}" class="form-control" readonly="readonly">
                                    </td>
                                    <td>
                                        <select name="Contacted[]" class="dropdown-item py-2">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>                                        
                                    </td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                    </form>                     
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('.topic-id').on('input', function() {
    var projectId = $(this).val();
    var autocompleteList = $(this).closest('tr').find('.id-autocomplete-list');
    var currentInput = $(this);
    var errorLabel = $(this).closest('tr').find('.error-label'); // add a lable to show error

    if (projectId.length >= 1) {
        $.get('/student/get-project-id', { search: projectId })
            .done(function(data) {
                autocompleteList.html('');
                data.forEach(function(item) {
                    autocompleteList.append('<div class="autocomplete-item">' + item + '</div>');
                });

                autocompleteList.show();
                errorLabel.hide(); 

                autocompleteList.on('click', '.autocomplete-item', function() {
                    var selectedProjectId = $(this).text();
                    var isDuplicate = false;

                   
                    $('.topic-id').not(currentInput).each(function() {   // Check for duplicate input values
                        if ($(this).val() === selectedProjectId) {
                            isDuplicate = true;
                            $(this).css('border-color', 'red'); // Marked with a red border
                            errorLabel.text('Duplicate Project ID').css('color', 'red').show(); // Display error notification messages
                            currentInput.val(''); // clean input box
                            return false; // end the loop
                        }
                    });

                    if (!isDuplicate) {
                        $(this).closest('tr').find('.topic-id').val(selectedProjectId);
                        $('.topic-id').css('border-color', ''); // clean red border
                        errorLabel.hide(); // hide the notification messages
                    }

                    autocompleteList.hide();
                });
            })
            .fail(function() {
                autocompleteList.html('');
            });
    } else {
        autocompleteList.html('');
        autocompleteList.hide();
    }
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
   
</style>



@endsection
