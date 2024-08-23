@extends('admin.layout')
@section('page-title', 'Holidays')
@section('page-content')

<!--  Delete Modal -->
<div class="modal fade delete_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white delete_modal_text"></h5>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="delete_ids">
                <a href="javascript:void(0)" class="btn btn-danger delete_records">Yes</a>
                <a href="javascript:void(0)" class="btn btn-primary" data-bs-dismiss="modal">No</a>
            </div>
        </div>
    </div>
</div>

<!--  Add / Update Modal -->
<div class="modal fade bs-example-modal-xl" id="add_update_modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="myExtraLargeModalLabel">Add / Update Holiday</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_update_form" method="POST">
                <div class="modal-body">
                    <div class="row mb-3" id="holiday_type">
                        <label for="inputEmail3" class="col-sm-2 col-4 col-form-label">Holiday Type</label>
                        <div class="col-sm-10 col-8 mt-1">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="single" value="Single" checked="">
                                <label class="form-check-label" for="single"> &nbsp; Holiday (Single)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="single" value="Multiple">
                                <label class="form-check-label" for="single"> &nbsp; Weekly Off (Multiple)</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <label for="title" class="form-label">Holiday Title<span class="required-field">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Work Title">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="from_date" class="form-label">Holiday From Date<span class="required-field">*</span></label>
                            <input type="date" class="form-control" id="from_date" name="from_date">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="to_date" class="form-label">Holiday To Date<span class="required-field">*</span></label>
                            <input type="date" class="form-control" id="to_date" name="to_date" readonly>
                        </div>
                    </div>
                    <div id="multiple" style="display: none;">
                        <label class="form-label">Weekly Off:<span class="required-field">*</span></label>
                        &nbsp;
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="monday" name="days[]" value="1">
                            <label class="form-check-label" for="monday">&nbsp;Mon</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="tuesday" name="days[]" value="2">
                            <label class="form-check-label" for="tuesday">&nbsp;Tue</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="wednesday" name="days[]" value="3">
                            <label class="form-check-label" for="wednesday">&nbsp;Wed</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="thursday" name="days[]" value="4">
                            <label class="form-check-label" for="thursday">&nbsp;Thu</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="friday" name="days[]" value="5">
                            <label class="form-check-label" for="friday">&nbsp;Fri</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="saturday" name="days[]" value="6">
                            <label class="form-check-label" for="saturday">&nbsp;Sat</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="sunday" name="days[]" value="7">
                            <label class="form-check-label" for="sunday">&nbsp;Sun</label>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="holiday_id" name="holiday_id">
                    <input type="submit" class="btn btn-success save_data" value="Save data">
                    <a href="javascript:void(0)" class="btn btn-danger" data-bs-dismiss="modal">Cancel</a>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="form-head d-flex mb-sm-4 mb-3">
    <div class="me-auto">
        <h2 class="text-black font-w600">Holidays</h2>
        <p class="mb-0">View / Add / Update / Delete Holidays</p>
    </div>
    <div>
        <a href="javascript:void(0)" class="btn btn-danger me-2 disabled" id="delete_button" onClick="open_delete_modal()"><i class="bx bx-trash"></i> Delete</a>
        <a href="javascript:void(0)" class="btn btn-primary me-3" id="openModal"><i class='bx bx-plus-circle' ></i> New
            Holiday</a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered" id="datatable">
                    <thead>
                        <tr>
                            <th><input class="form-check-input select_checkbox_all" type="checkbox"> &nbsp; Action</th>
                            <th>Holiday Name</th>
                            <th>Holiday Date</th>
                            <th>Holiday Day</th>
                            <th>Updated On</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- end card-body -->
        </div>
        <!-- end card -->
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection
@section('footer')
<script type="text/javascript">
var delete_selected_id_array = [];
var table = $('#datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('admin.holiday.getHolidays') }}",
    columns: [
        {data: 'action', name: 'action', orderable: false, searchable: false},
        {data: 'title', name: 'title'},
        {data: 'date', name: 'date'},
        {data: 'day', name: 'day'},
        {data: 'last_updated', name: 'last_updated'}
    ]
});

$('input[name="type"]').change(function() {
    var selectedValue = $(this).val();
    if (selectedValue === 'Multiple') {
        $('#to_date').removeAttr('readonly');
        $('#multiple').show();
    } else {
        $('#to_date').attr('readonly', true);
        $('#multiple').hide();
    }
    $('#title, #to_date, #from_date').val('');
});

$('#from_date').change(function () {
    var type = $('input[name="type"]:checked').val(); 
    if (type === 'Single') {
        var from_date = $(this).val();
        $('#to_date').val(from_date);
    }else{
        $('#to_date').val('');
    }
});

function clearForm(formId) {
    var form = $('#' + formId);
    form[0].reset();
    form.find('.is-invalid').removeClass('is-invalid');
    form.find('.is-valid').removeClass('is-valid');
    form.find('.invalid-feedback').remove();
    form.find('input[type="hidden"]').val('');
}

$('#openModal').on('click', function (event) {
    clearForm('add_update_form');
    var type = $('input[name="type"]:checked').val(); 
    if (type === 'Single') {
        $('#to_date').attr('readonly', true);
        $('#multiple').hide();
    }
    $('#add_update_modal').modal('show');
});

function validateField(field, message) {
    var $field = $(field);
    $field.addClass("is-invalid").removeClass("is-valid");
    if ($field.siblings(".invalid-feedback").length === 0) {
        $field.after('<div class="invalid-feedback">' + message + '</div>');
    } else {
        $field.siblings(".invalid-feedback").text(message).show();
    }
}

$('#datatable').on('click', '.edit', function() {
    var id = $(this).data('id');
    clearForm('add_update_form');
    var url = "{{ route('admin.holiday.getHoliday', ':id') }}";
    url = url.replace(':id', id);
    $('#holiday_type').hide();
    $('#add_update_modal').modal('show');
    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            console.log(response);
            $('#add_update_modal').modal('show');
            $('#add_update_modal #title').val(response.data.title);
            $('#add_update_modal #from_date').val(response.data.date);
            $('#add_update_modal #to_date').val(response.data.date);
            $('#add_update_modal #holiday_id').val(response.data.id);
        },
        error: function(xhr) {
            if (xhr.status === 404) {
                var response = xhr.responseJSON;
                toastr.error(response.message);
            } else {
                toastr.error('Failed to retrieve holiday details.');
            }
        }
    });
});


$('#add_update_form .form-control').on('input', function() {
    var fieldId = '#' + $(this).attr('id');
    if ($(this).val()) {
        $(this).removeClass("is-invalid");
        $(this).siblings(".invalid-feedback").remove();
    }
});

$("#add_update_form").submit(function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    $.ajax({
        url: "{{ route('admin.holiday.save') }}",
        type: 'POST',
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        data: formData,
        success: function(response) {
            toastr.success(response.message);
            clearForm('add_update_form');
            $('#add_update_form .form-control').addClass("is-valid");
            $('.bs-example-modal-xl').modal('hide');
            $('#datatable').DataTable().ajax.reload(null, false);
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                $.each(errors, function(key, value) {
                    var fieldSelector = '#' + key;
                    validateField(fieldSelector, value[0]);
                });
            } else if (xhr.status === 400) {
                toastr.error(xhr.responseJSON.error);
            } else {
                toastr.error('An error occurred. Please try again.');
            }
        }
    });
    
});

function open_delete_modal() {
    $('.delete_modal').modal('show');
    $('.delete_modal_text').empty().text('Are you sure you want to delete the selected records ? This action cannot be undone.');
    $('#delete_ids').empty().val(delete_selected_id_array);
}

$(document).on('click', '.delete_records', function () {
    var deleteIds = $('#delete_ids').val();
    var url = "{{ route('admin.holiday.delete') }}";
    $.ajax({
        url: url,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
        },
        data: {
            ids: deleteIds
        },
        success: function(response) {
            if (response.message) {
                toastr.success(response.message);
                $('#datatable').DataTable().ajax.reload(null, false);
                $('.select_checkbox_all').prop('checked', false);
                $('.delete_modal').modal('hide');
            } else if (response.error) {
                toastr.error(response.error);
            } else {
                toastr.error('Unexpected response format.');
            }
        },
        error: function(xhr) {
            toastr.error('An error occurred while trying to delete the record.');
        }
    });
});

$(document).on('click', '.select_checkbox', function () {
    var $checkbox = $(this);
    var id = $checkbox.data('id');
    var rowCount = table.rows().count();
    if ($checkbox.is(':checked')) {
        if (!delete_selected_id_array.includes(id)) {
            delete_selected_id_array.push(id);
        }
        $checkbox.closest('tr').css('background-color', '#ffc7c7');
        $('#delete_button').removeClass('disabled');
        $('.single_delete_button').addClass('disabled');
    } else {
        delete_selected_id_array = delete_selected_id_array.filter(function(value) {
            return value !== id;
        });
        $checkbox.closest('tr').css('background-color', '');
        
        if (delete_selected_id_array.length === 0) {
            $('#delete_button').addClass('disabled');
            $('.single_delete_button').removeClass('disabled');
        }
    }
    $('.select_checkbox_all').prop('checked', rowCount === delete_selected_id_array.length);

});

$(document).on('click', '.select_checkbox_all', function () {
    var isChecked = $(this).is(':checked');
    var selectedCheckboxes = $('.select_checkbox');
    if (!isChecked) {
        delete_selected_id_array = [];
    }
    selectedCheckboxes.each(function() {
        this.checked = isChecked;
        var id = $(this).data('id');
        if (isChecked) {
            if (!delete_selected_id_array.includes(id)) {
                delete_selected_id_array.push(id);
            }
            $(this).parents('tr').css('background-color', '#ffc7c7');
        } else {
            $(this).parents('tr').css('background-color', 'initial');
        }
    });
    $('#delete_button').toggleClass('disabled', !isChecked);
});

</script>
@endsection