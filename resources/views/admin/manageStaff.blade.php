@extends('admin.layout')
@section('page-title', 'Manage Staff')
@section('page-content')

<div class="form-head d-flex mb-sm-4 mb-3">
    <div class="me-auto">
        <h2 class="text-black font-w600">Manage Staff</h2>
        <p class="mb-0">Staff Details</p>
    </div>
    <div>
        <a href="{{ route('admin.staff.index') }}" class="btn btn-danger">Back</a>
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
                            <label for="photo">Upload Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo" placeholder="Choose Photo File">
                            @if($staff && $staff->photo)
                                <img src="{{ asset('storage/' . $staff->photo) }}" alt="Current Photo" style="max-width: 100px; margin-top: 10px;">
                            @endif
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="salutation">Salutation</label>
                            <select class="form-select" id="salutation" name="salutation" aria-label="Floating label select example">
                                <option value="Mr" {{ $staff && $staff->salutation == 'Mr' ? 'selected' : '' }}>Mr</option>
                                <option value="Mrs" {{ $staff && $staff->salutation == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                                <option value="Ms" {{ $staff && $staff->salutation == 'Ms' ? 'selected' : '' }}>Ms</option>
                                <option value="Master" {{ $staff && $staff->salutation == 'Master' ? 'selected' : '' }}>Master</option>
                                <option value="Dr" {{ $staff && $staff->salutation == 'Dr' ? 'selected' : '' }}>Dr</option>
                                <option value="Adv" {{ $staff && $staff->salutation == 'Adv' ? 'selected' : '' }}>Adv</option>
                                <option value="Miss" {{ $staff && $staff->salutation == 'Miss' ? 'selected' : '' }}>Miss</option>
                            </select>
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="first_name">First Name<span class="required-field">*</span></label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" value="{{ $staff ? $staff->first_name : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Enter Middle Name" value="{{ $staff ? $staff->middle_name : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="last_name">Last Name<span class="required-field">*</span></label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" value="{{ $staff ? $staff->last_name : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="date_of_birth">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Enter Date of Birth" value="{{ $staff ? $staff->date_of_birth : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="mobile_number">Mobile Number (Username)<span class="required-field">*</span></label>
                            <input type="number" class="form-control" id="mobile_number" name="mobile_number" placeholder="Enter Mobile Number" value="{{ $staff ? $staff->mobile_number : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="email">Email<span class="required-field">*</span></label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ $staff ? $staff->email : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" value="{{ $staff ? $staff->city : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="pincode">Pincode</label>
                            <input type="number" class="form-control" id="pincode" name="pincode" placeholder="Enter Pincode" value="{{ $staff ? $staff->pincode : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" name="state" placeholder="Enter State" value="{{ $staff ? $staff->state : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country" value="{{ $staff ? $staff->country : '' }}">
                        </div>
                    
                        <div class="col-lg-6 mb-3">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" name="address" placeholder="Enter Address" style="height: 100px;">{{ $staff ? $staff->address : '' }}</textarea>
                        </div>
                    </div>
                    
                    

                    <h4><u>Identity Details</u></h4>
                    <div class="row mt-3">
                        <div class="col-lg-3 mb-3">
                            <label for="aadhar_number">Aadhar Number</label>
                            <input type="number" class="form-control" id="aadhar_number" name="aadhar_number" placeholder="Enter Aadhar Number" value="{{ $staff ? $staff->aadhar_number : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="aadhar_file">Aadhar File</label>
                            <input type="file" class="form-control" id="aadhar_file" name="aadhar_file" placeholder="Choose Aadhar File">
                            @if($staff && $staff->aadhar_file)
                                <a href="{{ asset('storage/' . $staff->aadhar_file) }}" target="_blank">Current Aadhar File</a>
                            @endif
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="pan_number">PAN Number</label>
                            <input type="number" class="form-control" id="pan_number" name="pan_number" placeholder="Enter PAN Number" value="{{ $staff ? $staff->pan_number : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="pan_file">PAN File</label>
                            <input type="file" class="form-control" id="pan_file" name="pan_file" placeholder="Choose PAN File">
                            @if($staff && $staff->pan_file)
                                <a href="{{ asset('storage/' . $staff->pan_file) }}" target="_blank">Current PAN File</a>
                            @endif
                        </div>
                    </div>
                    
                    

                    <h4><u>Employment / Bank Details</u></h4>
                    <div class="row mt-3">
                        <div class="col-lg-3 mb-3">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter Designation" value="{{ $staff ? $staff->designation : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="date_of_joining">Date of Joining</label>
                            <input type="date" class="form-control" id="date_of_joining" name="date_of_joining" placeholder="Enter Date of Joining" value="{{ $staff ? $staff->date_of_joining : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="date_of_leaving">Date of Leaving</label>
                            <input type="date" class="form-control" id="date_of_leaving" name="date_of_leaving" placeholder="Enter Date of Leaving" value="{{ $staff && $staff->date_of_leaving ? $staff->date_of_leaving : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="salary">Salary Per Month</label>
                            <input type="number" class="form-control" id="salary" name="salary" placeholder="Enter Salary" value="{{ $staff ? $staff->salary : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="salary_increment_note">Salary Increment Note</label>
                            <input type="text" class="form-control" id="salary_increment_note" name="salary_increment_note" placeholder="Enter Salary Increment Note" value="{{ $staff ? $staff->salary_increment_note : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="bank_name">Bank Name</label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Enter Bank Name" value="{{ $staff ? $staff->bank_name : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="account_number">Account Number</label>
                            <input type="number" class="form-control" id="account_number" name="account_number" placeholder="Enter Account Number" value="{{ $staff ? $staff->account_number : '' }}">
                        </div>
                    
                        <div class="col-lg-3 mb-3">
                            <label for="ifsc_code">IFSC Code</label>
                            <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" placeholder="Enter IFSC Code" value="{{ $staff ? $staff->ifsc_code : '' }}">
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
                                                    <input type="hidden" name="references[{{ $index + 1 }}][reference_id]" value="{{ $reference->id }}">
                                                    <input type="text" class="form-control reference-name" name="references[{{ $index + 1 }}][name]" id="name{{ $index + 1 }}" placeholder="Enter Reference Full Name" value="{{ $reference->name }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control reference-relationship" name="references[{{ $index + 1 }}][relationship]" id="relationship{{ $index + 1 }}" placeholder="Enter Reference Relationship" value="{{ $reference->relationship }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control reference-mobile" name="references[{{ $index + 1 }}][mobile]" id="mobile{{ $index + 1 }}" placeholder="Enter Reference Mobile Number" value="{{ $reference->mobile }}">
                                                </td>
                                                <td class="align-middle">
                                                    <a href="javascript:void(0)" data-index="{{ $index + 1 }}" data-delete-id="{{ $reference->id }}" class="btn btn-danger remove-reference"><i class='bx bx-x-circle'></i></a>
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
                            <input type="hidden" name="staff_id" value="{{ $staff ? $staff->id : '' }}">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{ route('admin.staff.index') }}" class="btn btn-danger">Back</a>
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
        var actionUrl = "{{ $staff && $staff->id ? route('admin.staff.update') : route('admin.staff.insert') }}";
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
                        window.location.href = '{{ route("admin.staff.index") }}';
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