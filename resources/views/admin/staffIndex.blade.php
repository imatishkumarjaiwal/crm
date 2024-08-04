@extends('admin.layout')
@section('page-title', 'Staffs')
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
                <h5 class="modal-title text-white" id="myExtraLargeModalLabel">Add / Update Staff</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_update_form" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <label for="first_name" class="form-label">First Name<span class="required-field">*</span></label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Enter Middle Name">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="last_name" class="form-label">Last Name<span class="required-field">*</span></label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="mobile_number" class="form-label">Mobile Number(Username)<span class="required-field">*</span></label>
                            <input type="number" class="form-control" id="mobile_number" name="mobile_number" placeholder="Enter Mobile Number">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="email" class="form-label">Email<span class="required-field">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" placeholder="Enter Address"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="staff_id" name="staff_id">
                    <input type="submit" class="btn btn-success save_data" value="Save data">
                    <a href="javascript:void(0)" class="btn btn-danger" data-bs-dismiss="modal">Cancel</a>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="form-head d-flex mb-sm-4 mb-3">
    <div class="me-auto">
        <h2 class="text-black font-w600">Staffs</h2>
        <p class="mb-0">View / Add / Update / Delete Staffs </p>
    </div>
    <div>
        <a href="javascript:void(0)" class="btn btn-danger me-2 disabled" id="delete_button" onClick="open_delete_modal('multiple')"><i class="bx bx-trash"></i> Delete</a>
        <a href="#" class="btn btn-primary me-3" id="openModal"><i class='bx bx-plus-circle' ></i> New
            Staff</a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered" id="datatable">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
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
    ajax: "{{ route('admin.staff.getStaffs') }}",
    columns: [
        {data: 'action', name: 'action', orderable: false, searchable: false},
        {data: 'first_name', name: 'first_name'},
        {data: 'last_name', name: 'last_name'},
        {data: 'email', name: 'email'},
        {data: 'mobile_number', name: 'mobile_number'},
        {data: 'updated_on', name: 'updated_on'}
    ]
});

function clearForm(formId) {
    $('#' + formId)[0].reset();
    $('#' + formId).find('.is-invalid').removeClass('is-invalid');
    $('#' + formId).find('.is-valid').removeClass('is-valid');
    $('#' + formId).find('.invalid-feedback').remove();
    $('.save_data').prop('disabled', false);
}

$('#openModal').on('click', function (event) {
    const id = 'add_update_modal';
    clearForm('add_update_form');
    $('#'+id).modal('show');
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
    var url = "{{ route('admin.staff.getStaffDataForEdit', ':id') }}";
    url = url.replace(':id', id);

    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            console.log(response);
            $('#add_update_modal').modal('show');
            $('#add_update_modal #first_name').val(response.data.first_name);
            $('#add_update_modal #last_name').val(response.data.last_name);
            $('#add_update_modal #email').val(response.data.email);
            $('#add_update_modal #mobile_number').val(response.data.mobile_number);
            $('#add_update_modal #address').val(response.data.address);
            $('#add_update_modal #staff_id').val(response.data.id);
        },
        error: function(xhr) {
            if (xhr.status === 404) {
                var response = xhr.responseJSON;
                toastr.error(response.message);
            } else {
                toastr.error('Failed to retrieve staff details.');
            }
        }
    });
});

$("#add_update_form").submit(function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    $('.save_data').prop('disabled', true);
    $.ajax({
        url: "{{ route('admin.staff.saveStaff') }}",
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
            } else {
                toastr.error('An error occurred. Please try again.');
            }
        }
    });
    
});

$('#add_update_form .form-control').on('input', function() {
    var fieldId = '#' + $(this).attr('id');
    if ($(this).val()) {
        $(this).addClass("is-valid").removeClass("is-invalid");
        $(this).siblings(".invalid-feedback").remove();
    }
});

function open_delete_modal(isMultiple) {
    $('.delete_modal').modal('show');
    var message = '';
    var delete_ids;
    if (isMultiple == 'multiple') {
        delete_ids = delete_selected_id_array;
        message = 'Are you sure you want to delete the selected records? This action cannot be undone.';
    } else {
        delete_ids = event.currentTarget.getAttribute('data-id');
        message = 'Are you sure you want to delete this record? This action cannot be undone.';
    }

    $('.delete_modal_text').empty().text(message);
    $('#delete_ids').empty().val(delete_ids);
}

$(document).on('click', '.delete_records', function () {
    var deleteIds = $('#delete_ids').val();
    var url = "{{ route('admin.staff.deleteStaff') }}";
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
});

function select_all_records_for_delete(e) {
    if ($(e).is(':checked')) {
        $('.select_checkbox').each(function() {
            this.checked = true;
            delete_selected_id_array.push($(this).attr('id'));
            $(this).parents('tr').css('background-color', '#ffc7c7');
            $('#delete_button').removeClass('disabled');
        });
    } else {
        $('.select_checkbox').each(function() {
            this.checked = false;
            delete_selected_id_array = [];
            $(this).parents('tr').css('background-color', 'initial');
            $('#delete_button').addClass('disabled');
        });
    }
}
</script>
@endsection