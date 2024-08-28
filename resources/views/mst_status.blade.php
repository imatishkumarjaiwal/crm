@extends('layout')
@section('page-title', 'MstStatus')
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
                <h5 class="modal-title text-white" id="myExtraLargeModalLabel">Add / Update mst_status</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_update_form" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <label for="status_name" class="form-label">Status Title<span class="required-field">*</span></label>
                            <input type="text" class="form-control" id="status_name" name="status_name" placeholder="Enter mst_status Title">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="status_desc" class="form-label">Status Description</label>
                            <textarea class="form-control" id="status_desc" name="status_desc" placeholder="Enter mst_status Description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="status_id" name="status_id">
                    <input type="submit" class="btn btn-success save_data" value="Save data">
                    <a href="javascript:void(0)" class="btn btn-danger" data-bs-dismiss="modal">Cancel</a>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="form-head d-flex mb-sm-4 mb-3">
    <div class="me-auto">
        <h2 class="text-black font-w600">Status</h2>
        <p class="mb-0">View / Add / Update / Delete Status </p>
    </div>
    <div>
        <a href="javascript:void(0)" class="btn btn-danger me-2 disabled" id="delete_button" onClick="open_delete_modal()"><i class="bx bx-trash"></i> Delete</a>
        <a href="javascript:void(0)" class="btn btn-primary me-3" id="openModal"><i class='bx bx-plus-circle' ></i> New
            mst_status</a>
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
                            <th>Status Title</th>
                            <th>Status Description</th>
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
    ajax: "{{ route('mst_status.getMstStatusRecords') }}",
    columns: [
        {data: 'action', name: 'action', orderable: false, searchable: false},
        {data: 'status_name', name: 'status_name'},
        {data: 'status_desc', name: 'status_desc'},
        {data: 'status_updatedon', name: 'status_updatedon'}
    ]
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
    var url = "{{ route('mst_status.getMstStatus', ':id') }}";
    url = url.replace(':id', id);

    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            console.log(response);
            $('#add_update_modal').modal('show');
            $('#add_update_modal #status_name').val(response.data.status_name);
            $('#add_update_modal #status_desc').val(response.data.status_desc);
            $('#add_update_modal #status_id').val(response.data.status_id);
        },
        error: function(xhr) {
            if (xhr.mst_status === 404) {
                var response = xhr.responseJSON;
                toastr.error(response.message);
            } else {
                toastr.error('Failed to retrieve staff details.');
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
        url: "{{ route('mst_status.save') }}",
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
            if (xhr.mst_status === 422) {
                var errors = xhr.responseJSON.errors;
                $.each(errors, function(key, value) {
                    var fieldSelector = '#' + key;
                    validateField(fieldSelector, value[0]);
                });
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
    var url = "{{ route('mst_status.delete') }}";
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
