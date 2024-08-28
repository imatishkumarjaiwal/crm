@extends('layout')
@section('page-title', 'MstClients')
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

<div class="form-head d-flex mb-sm-4 mb-3">
    <div class="me-auto">
        <h2 class="text-black font-w600">Clients</h2>
        <p class="mb-0">View / Add / Update / Delete Clients </p>
    </div>
    <div>
        <a href="javascript:void(0)" class="btn btn-danger me-2 disabled" id="delete_button" onClick="open_delete_modal()"><i class="bx bx-trash"></i> Delete</a>
        <a href="{{ route('mst_clients.add') }}" class="btn btn-primary me-3"><i class='bx bx-plus-circle' ></i> New
            Client</a>
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
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Created On</th>
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
    ajax: "{{ route('mst_clients.getClients') }}",
    columns: [
        {data: 'action', name: 'action', orderable: false, searchable: false},
        {data: 'client_first_name', name: 'client_first_name'},
        {data: 'client_last_name', name: 'client_last_name'},
        {data: 'client_email', name: 'client_email'},
        {data: 'client_mobile', name: 'client_mobile'},
        {data: 'client_createdon', name: 'client_createdon'}
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


$('#add_update_form .form-control').on('input', function() {
    var fieldId = '#' + $(this).attr('id');
    if ($(this).val()) {
        $(this).addClass("is-valid").removeClass("is-invalid");
        $(this).siblings(".invalid-feedback").remove();
    }
});

function open_delete_modal() {
    $('.delete_modal').modal('show');
    $('.delete_modal_text').empty().text('Are you sure you want to delete the selected records ? This action cannot be undone.');
    $('#delete_ids').empty().val(delete_selected_id_array);
}

$(document).on('click', '.delete_records', function () {
    var deleteIds = $('#delete_ids').val();
    var url = "{{ route('mst_clients.deleteStaff') }}";
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



