@extends('admin.layout')
@section('page-title', 'Staffs')
@section('page-content')

<!--  Extra Large modal example -->
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
                            <label for="password" class="form-label">Password<span class="required-field">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" placeholder="Enter Address"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="staff_id" name="staff_id">
                    <input type="submit" class="btn btn-success" value="Save data">
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
        <a href="javascript:void(0)" class="btn btn-danger me-2 disabled" id="delete_button" data-bs-toggle="modal"
            data-bs-target=".bd-example-modal-lg"><i class="bx bx-trash"></i> Delete</a>
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
var table = $('#datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('admin.staff.getStaffs') }}",
    columns: [
        {data: 'action', name: 'action', orderable: false, searchable: false},
        {data: 'first_name', name: 'first_name'},
        {data: 'last_name', name: 'last_name'},
        {data: 'email', name: 'email'},
        {data: 'mobile_number', name: 'mobile_number'}
    ]
});

function clearForm(formId) {
    $('#' + formId)[0].reset();
    $('#' + formId).find('.is-invalid').removeClass('is-invalid');
    $('#' + formId).find('.is-valid').removeClass('is-valid');
    $('#' + formId).find('.invalid-feedback').remove();
}

$('#openModal').on('click', function (event) {
    const id = 'add_update_modal';
    clearForm('add_update_form');
    $('#'+id).modal('show');
});

function validateField1(field, message) {
    $(field).css("border-color", "red");
    $('#error_message').empty().append(message);
    setTimeout(function(){
        $('#error_message').empty();
        $(field).css("border-color", "#e9ecef");
    }, 3000);
}

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
    var staffId = $(this).data('id');
    clearForm('add_update_form');
    var url = "{{ route('admin.staff.getStaffDataForEdit', ':id') }}";
    url = url.replace(':id', staffId);

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
    $.ajax({
        url: "{{ route('admin.staff.saveStaff') }}",
        type: 'POST',
        processData: false, // Prevent jQuery from automatically transforming the data into a query string
        contentType: false, // Set contentType to false, as jQuery will tell the server it's a query string request
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        data: formData,
        success: function(response) {
            toastr.success(response.message);
            clearForm('add_update_form');
            $('#add_update_form .form-control').addClass("is-valid");
            $('.bs-example-modal-xl').modal('hide');
            $('#staff-table').DataTable().ajax.reload(null, false);
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
</script>
@endsection