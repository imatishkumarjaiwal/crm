@extends('layout')
@section('page-title', 'Manage Staff')
@section('page-content')

<div class="form-head d-flex mb-sm-4 mb-3">
    <div class="me-auto">
        <h2 class="text-black font-w600">Manage Staff</h2>
        <p class="mb-0">Staff Details</p>
    </div>
    <div>
        <a href="{{ route('mst_staff.index') }}" class="btn btn-danger">Back</a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form id="staffForm">
                    <h4><u>Personal Details</u></h4>
                    <div class="row">
                        <div class="col-lg-3 mb-3">
                            <label for="staff_photo">Upload Photo</label>
                            <input type="file" class="form-control" id="staff_photo" name="staff_photo" placeholder="Choose Photo File">
                            @if($mst_staff && $mst_staff->staff_photo)
                                <img src="{{ asset('storage/' . $mst_staff->staff_photo) }}" alt="Current Photo" style="max-width: 100px; margin-top: 10px;">
                            @endif
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="staff_salutation">Salutation</label>
                            <select class="form-select" id="staff_salutation" name="staff_salutation" aria-label="Floating label select example">
                                <option value="Mr" {{ $mst_staff && $mst_staff->staff_salutation == 'Mr' ? 'selected' : '' }}>Mr</option>
                                <option value="Mrs" {{ $mst_staff && $mst_staff->staff_salutation == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                                <option value="Ms" {{ $mst_staff && $mst_staff->staff_salutation == 'Ms' ? 'selected' : '' }}>Ms</option>
                                <option value="Master" {{ $mst_staff && $mst_staff->staff_salutation == 'Master' ? 'selected' : '' }}>Master</option>
                                <option value="Dr" {{ $mst_staff && $mst_staff->staff_salutation == 'Dr' ? 'selected' : '' }}>Dr</option>
                                <option value="Adv" {{ $mst_staff && $mst_staff->staff_salutation == 'Adv' ? 'selected' : '' }}>Adv</option>
                                <option value="Miss" {{ $mst_staff && $mst_staff->staff_salutation == 'Miss' ? 'selected' : '' }}>Miss</option>
                            </select>
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="staff_first_name">First Name<span class="required-field">*</span></label>
                            <input type="text" class="form-control" id="staff_first_name" name="staff_first_name" placeholder="Enter First Name" value="{{ $mst_staff ? $mst_staff->staff_first_name : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="staff_middle_name">Middle Name</label>
                            <input type="text" class="form-control" id="staff_middle_name" name="staff_middle_name" placeholder="Enter Middle Name" value="{{ $mst_staff ? $mst_staff->staff_middle_name : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="staff_last_name">Last Name<span class="required-field">*</span></label>
                            <input type="text" class="form-control" id="staff_last_name" name="staff_last_name" placeholder="Enter Last Name" value="{{ $mst_staff ? $mst_staff->staff_last_name : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="staff_dob">Date of Birth</label>
                            <input type="date" class="form-control" id="staff_dob" name="staff_dob" placeholder="Enter Date of Birth" value="{{ $mst_staff ? $mst_staff->staff_dob : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="staff_mobile">Mobile Number (Username)<span class="required-field">*</span></label>
                            <input type="number" class="form-control" id="staff_mobile" name="staff_mobile" placeholder="Enter Mobile Number" value="{{ $mst_staff ? $mst_staff->staff_mobile : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="staff_email">Email<span class="required-field">*</span></label>
                            <input type="text" class="form-control" id="staff_email" name="staff_email" placeholder="Enter Email" value="{{ $mst_staff ? $mst_staff->staff_email : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="staff_city">City</label>
                            <input type="text" class="form-control" id="staff_city" name="staff_city" placeholder="Enter City" value="{{ $mst_staff ? $mst_staff->staff_city : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="staff_pin">Pincode</label>
                            <input type="number" class="form-control" id="staff_pin" name="staff_pin" placeholder="Enter Pincode" value="{{ $mst_staff ? $mst_staff->staff_pin : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="staff_state">State</label>
                            <input type="text" class="form-control" id="staff_state" name="staff_state" placeholder="Enter State" value="{{ $mst_staff ? $mst_staff->staff_state : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="staff_country">Country</label>
                            <input type="text" class="form-control" id="staff_country" name="staff_country" placeholder="Enter Country" value="{{ $mst_staff ? $mst_staff->staff_country : '' }}">
                        </div>
                    
                        <div class="col-lg-6 mb-3">
                            <label for="staff_address">Address</label>
                            <textarea class="form-control" id="staff_address" name="staff_address" placeholder="Enter Address" style="height: 100px;">{{ $mst_staff ? $mst_staff->staff_address : '' }}</textarea>
                        </div>
                    </div>
                    
                    

                    <h4><u>Identity Details</u></h4>
                    <div class="row mt-3">
                        <div class="col-lg-3 mb-3">
                            <label for="staff_aadhar">Aadhar Number</label>
                            <input type="number" class="form-control" id="staff_aadhar" name="staff_aadhar" placeholder="Enter Aadhar Number" value="{{ $mst_staff ? $mst_staff->staff_aadhar : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="staff_aadhar_file">Aadhar File</label>
                            <input type="file" class="form-control" id="staff_aadhar_file" name="staff_aadhar_file" placeholder="Choose Aadhar File">
                            @if($mst_staff && $mst_staff->staff_aadhar_file)
                                <a href="{{ asset('storage/' . $mst_staff->staff_aadhar_file) }}" target="_blank">Current Aadhar File</a>
                            @endif
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="staff_pan">PAN Number</label>
                            <input type="number" class="form-control" id="staff_pan" name="staff_pan" placeholder="Enter PAN Number" value="{{ $mst_staff ? $mst_staff->staff_pan : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="staff_pan_file">PAN File</label>
                            <input type="file" class="form-control" id="staff_pan_file" name="staff_pan_file" placeholder="Choose PAN File">
                            @if($mst_staff && $mst_staff->staff_pan_file)
                                <a href="{{ asset('storage/' . $mst_staff->staff_pan_file) }}" target="_blank">Current PAN File</a>
                            @endif
                        </div>
                    </div>
                    
                    

                    <h4><u>Employment / Bank Details</u></h4>
                    <div class="row mt-3">
                        <div class="col-lg-3 mb-3">
                            <label for="staff_designation">Designation</label>
                            <input type="text" class="form-control" id="staff_designation" name="staff_designation" placeholder="Enter Designation" value="{{ $mst_staff ? $mst_staff->staff_designation : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="staff_doj">Date of Joining</label>
                            <input type="date" class="form-control" id="staff_doj" name="staff_doj" placeholder="Enter Date of Joining" value="{{ $mst_staff ? $mst_staff->staff_doj : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="staff_dol">Date of Leaving</label>
                            <input type="date" class="form-control" id="staff_dol" name="staff_dol" placeholder="Enter Date of Leaving" value="{{ $mst_staff && $mst_staff->staff_dol ? $mst_staff->staff_dol : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="staff_salary">Salary Per Month</label>
                            <input type="number" class="form-control" id="staff_salary" name="staff_salary" placeholder="Enter Salary" value="{{ $mst_staff ? $mst_staff->staff_salary : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="staff_salary_increment_note">Salary Increment Note</label>
                            <input type="text" class="form-control" id="staff_salary_increment_note" name="staff_salary_increment_note" placeholder="Enter Salary Increment Note" value="{{ $mst_staff ? $mst_staff->staff_salary_increment_note : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="staff_bank">Bank Name</label>
                            <input type="text" class="form-control" id="staff_bank" name="staff_bank" placeholder="Enter Bank Name" value="{{ $mst_staff ? $mst_staff->staff_bank : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="staff_account_number">Account Number</label>
                            <input type="number" class="form-control" id="staff_account_number" name="staff_account_number" placeholder="Enter Account Number" value="{{ $mst_staff ? $mst_staff->staff_account_number : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="staff_ifsc_code">IFSC Code</label>
                            <input type="text" class="form-control" id="staff_ifsc_code" name="staff_ifsc_code" placeholder="Enter IFSC Code" value="{{ $mst_staff ? $mst_staff->staff_ifsc_code : '' }}">
                        </div>
                    </div>
                    
                    

                    <div class="d-flex mt-4">
                        <div class="me-auto">
                            <h4><u>References</u></h4>
                        </div>
                        <div>
                            <button type="button" id="add-reference" class="btn btn-primary mb-3"><i class="bx bx-plus-circle"></i> Add New Reference</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered" id="references-table">
                                <thead>
                                    <tr>
                                        <th>Full Name of Reference</th>
                                        <th>Relationship with Staff</th>
                                        <th>Mobile Number</th>
                                        <th style="width: 5%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="references-container">
                                    <input type="hidden" id="reference_delete_ids" name="reference_delete_ids" value="">
                                    @if ($references && $references->isNotEmpty())
                                        @foreach($references as $index => $reference)
                                            <tr class="reference-row">
                                                <td>
                                                    <input type="hidden" name="references[{{ $index + 1 }}][reference_id]" value="{{ $reference->staff_id }}">
                                                    <input type="text" class="form-control reference-name" name="references[{{ $index + 1 }}][name]" id="name{{ $index + 1 }}" placeholder="Enter Reference Full Name" value="{{ $reference->name }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control reference-relationship" name="references[{{ $index + 1 }}][relationship]" id="relationship{{ $index + 1 }}" placeholder="Enter Reference Relationship" value="{{ $reference->relationship }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control reference-mobile" name="references[{{ $index + 1 }}][mobile]" id="mobile{{ $index + 1 }}" placeholder="Enter Reference Mobile Number" value="{{ $reference->mobile }}">
                                                </td>
                                                <td class="align-middle">
                                                    <a href="javascript:void(0)" data-index="{{ $index + 1 }}" data-delete-id="{{ $reference->staff_id }}" class="btn btn-danger remove-reference"><i class='bx bx-x-circle'></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="reference-row">
                                            <input type="hidden" name="references[1][reference_id]" value="">
                                            <td>
                                                <input type="text" class="form-control reference-name" name="references[1][name]" id="name1" placeholder="Enter Reference Full Name">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control reference-relationship" name="references[1][relationship]" id="relationship1" placeholder="Enter Reference Relationship">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control reference-mobile" name="references[1][mobile]" id="mobile1" placeholder="Enter Reference Mobile Number">
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-lg-12 text-center">
                            <input type="hidden" name="staff_id" value="{{ $mst_staff ? $mst_staff->staff_id : '' }}">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{ route('mst_staff.index') }}" class="btn btn-danger">Back</a>
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
    $('#staffForm').on('submit', function(e) {
        e.preventDefault();
        var actionUrl = "{{ $mst_staff && $mst_staff->staff_id ? route('mst_staff.update') : route('mst_staff.insert') }}";
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
                        window.location.href = '{{ route("mst_staff.index") }}';
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