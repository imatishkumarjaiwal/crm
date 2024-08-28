@extends('layout')
@section('page-title', 'Manage Client')
@section('page-content')

<div class="form-head d-flex mb-sm-4 mb-3">
    <div class="me-auto">
        <h2 class="text-black font-w600">Manage Clients</h2>
        <p class="mb-0">Clients Details</p>
    </div>
    <div>
        <a href="{{ route('mst_clients.index') }}" class="btn btn-danger">Back</a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form id="ClientsForm">
                    <h4><u>Personal Details</u></h4>
                    <div class="row">
                        
                    
                        <div class="col-lg-3 mb-3">
                            <label for="client_salutation">Salutation</label>
                            <select class="form-select" id="client_salutation" name="client_salutation" aria-label="Floating label select example">
                                <option value="Mr" {{ $mst_clients && $mst_clients->client_salutation == 'Mr' ? 'selected' : '' }}>Mr</option>
                                <option value="Mrs" {{ $mst_clients && $mst_clients->client_salutation == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                                <option value="Ms" {{ $mst_clients && $mst_clients->client_salutation == 'Ms' ? 'selected' : '' }}>Ms</option>
                                <option value="Master" {{ $mst_clients && $mst_clients->client_salutation == 'Master' ? 'selected' : '' }}>Master</option>
                                <option value="Dr" {{ $mst_clients && $mst_clients->client_salutation == 'Dr' ? 'selected' : '' }}>Dr</option>
                                <option value="Adv" {{ $mst_clients && $mst_clients->client_salutation == 'Adv' ? 'selected' : '' }}>Adv</option>
                                <option value="Miss" {{ $mst_clients && $mst_clients->client_salutation == 'Miss' ? 'selected' : '' }}>Miss</option>
                            </select>
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="client_first_name">First Name<span class="required-field">*</span></label>
                            <input type="text" class="form-control" id="client_first_name" name="client_first_name" placeholder="Enter First Name" value="{{ $mst_clients ? $mst_clients->client_first_name : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="client_middle_name">Middle Name</label>
                            <input type="text" class="form-control" id="client_middle_name" name="client_middle_name" placeholder="Enter Middle Name" value="{{ $mst_clients ? $mst_clients->client_middle_name : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="client_last_name">Last Name<span class="required-field">*</span></label>
                            <input type="text" class="form-control" id="client_last_name" name="client_last_name" placeholder="Enter Last Name" value="{{ $mst_clients ? $mst_clients->client_last_name : '' }}">
                        </div>

                        <div class="col-lg-3 mb-3">
                            <label for="client_firm_name">Name of the Firm</label>
                            <input type="text" class="form-control" id="client_firm_name" name="client_firm_name" placeholder="Enter Aadhar Number" value="{{ $mst_clients ? $mst_clients->client_firm_name : '' }}">
                        </div>

                     
                    
                        <div class="col-lg-3 mb-3">
                            <label for="client_mobile">Mobile Number (Username)<span class="required-field">*</span></label>
                            <input type="number" class="form-control" id="client_mobile" name="client_mobile" placeholder="Enter Mobile Number" value="{{ $mst_clients ? $mst_clients->client_mobile : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="client_email">Email<span class="required-field">*</span></label>
                            <input type="text" class="form-control" id="client_email" name="client_email" placeholder="Enter Email" value="{{ $mst_clients ? $mst_clients->client_email : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="client_city">City</label>
                            <input type="text" class="form-control" id="client_city" name="client_city" placeholder="Enter City" value="{{ $mst_clients ? $mst_clients->client_city : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="client_pin">Pincode</label>
                            <input type="number" class="form-control" id="client_pin" name="client_pin" placeholder="Enter Pincode" value="{{ $mst_clients ? $mst_clients->client_pin : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="client_state">State</label>
                            <input type="text" class="form-control" id="client_state" name="client_state" placeholder="Enter State" value="{{ $mst_clients ? $mst_clients->client_state : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="client_country">Country</label>
                            <input type="text" class="form-control" id="client_country" name="client_country" placeholder="Enter Country" value="{{ $mst_clients ? $mst_clients->client_country : '' }}">
                        </div>
                    
                        <div class="col-lg-6 mb-3">
                            <label for="client_address">Address</label>
                            <textarea class="form-control" id="client_address" name="client_address" placeholder="Enter Address" style="height: 100px;">{{ $mst_clients ? $mst_clients->client_address : '' }}</textarea>
                        </div>
</div>
<div class="row">

                        <div class="col-lg-3 mb-3">
                            <label for="client_refer_by">Referred By:                                </label>
                            <input type="text" class="form-control" id="client_refer_by" name="client_refer_by" placeholder="Enter" value="{{ $mst_clients ? $mst_clients->client_refer_by : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="client_sugg_for_prev_client">Suggestion of previous client</label>
                            <input type="text" class="form-control" id="client_sugg_for_prev_client" name="client_sugg_for_prev_client" placeholder="Enter" value="{{ $mst_clients ? $mst_clients->client_sugg_for_prev_client : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="client_start_date">Association Start Date:
                                </label>
                            <input type="date" class="form-control" id="client_start_date" name="client_start_date" placeholder="Enter" value="{{ $mst_clients ? $mst_clients->client_start_date : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="client_status">Status</label>
                            <input type="text" class="form-control" id="client_status" name="client_status" placeholder="Enter" value="{{ $mst_clients ? $mst_clients->client_status : '' }}">
                        </div>
                            
                        <div class="col-lg-6 mb-3">
                            <label for="client_remark">Remark</label>
                            <textarea class="form-control" id="client_remark" name="client_remark" placeholder="Enter remark" style="height: 100px;">{{ $mst_clients ? $mst_clients->client_remark : '' }}</textarea>

                        </div>
                    </div>
                    
                
                   
                    
                    <div class="row mt-4">
                        <div class="col-lg-12 text-center">
                            <input type="hidden" name="client_id" value="{{ $mst_clients ? $mst_clients->client_id : '' }}">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{ route('mst_clients.index') }}" class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end card-body -->
        </div>
        <!-- end card -->
    </div> <!-- end col -->
</div>


<!-- end row-->
@endsection
@section('footer')
<script type="text/javascript">
$(document).ready(function() {
    $('#ClientsForm').on('submit', function(e) {
        e.preventDefault();
        var actionUrl = "{{ $mst_clients && $mst_clients->client_id ? route('mst_clients.update') : route('mst_clients.insert') }}";
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        let formData = new FormData(this);

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.status === 'success') {
                    toastr.success(response.message);
                    setTimeout(function() {
                        window.location.href = '{{ route("mst_clients.index") }}';
                    }, 1000);
                } else {
                    toastr.error('An unexpected error occurred. Please try again.');
                }
            },
            error: function(xhr, status, error) {
                $('html, body').animate({ scrollTop: 0 }, 'slow');
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(field, messages) {
                        let fieldSelector = getFieldSelector(field);
                        addValidationError(fieldSelector, messages[0]);
                    });
                    toastr.error('Please correct the errors and try again.');
                } else {
                    toastr.error('An error occurred: ' + xhr.responseJSON.message);
                }
            }
        });

    });
    
    function addValidationError(selector, message) {
        $(selector).addClass('is-invalid');
        $(selector).after(`<div class="invalid-feedback">${message}</div>`);
    }

    function getFieldSelector(fieldName) {
        if (fieldName.includes('.')) {
            let parts = fieldName.split('.');
            let baseField = parts[0];
            let index = parts[1].replace(/\D/g, '');
            let id = parts[2];
            return `#${id}${index}`;
        } else {
            return `#${fieldName}`;
        }
    }
});


var referenceCount = $('#references-table tbody tr').length;

$('#add-reference').on('click', function() {
    referenceCount++;
    var newReferenceRow = `
        <tr class="reference-row">
            <td>
                <input type="text" class="form-control reference-name" name="references[${referenceCount}][name]" id="name${referenceCount}" placeholder="Enter Reference Full Name">
            </td>
            <td>
                <input type="text" class="form-control reference-relationship" name="references[${referenceCount}][relationship]" id="relationship${referenceCount}" placeholder="Enter Reference Relationship">
            </td>
            <td>
                <input type="text" class="form-control reference-mobile" name="references[${referenceCount}][mobile]" id="mobile${referenceCount}" placeholder="Enter Reference Mobile Number">
            </td>
            <td class="align-middle">
                <a href="javascript:void(0)" class="btn btn-danger remove-reference"><i class='bx bx-x-circle'></i></a>
            </td>
        </tr>`;
    $('#references-container').append(newReferenceRow);
});

function addValidationError(selector, message) {
    $(selector).addClass('is-invalid');
    $(selector).after(`<div class="invalid-feedback">${message}</div>`);
}

$(document).on('input', '.form-control', function() {
    $(this).removeClass('is-invalid');
    $(this).next('.invalid-feedback').remove();
});

var reference_delete_ids = [];
$(document).on('click', '.remove-reference', function() {
    var deleteId = $(this).data('delete-id');
    reference_delete_ids.push(deleteId);
    $('#reference_delete_ids').val(reference_delete_ids);
    $(this).closest('.reference-row').remove();
});
</script>
@endsection