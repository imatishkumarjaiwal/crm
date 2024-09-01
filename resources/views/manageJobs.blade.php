@extends('layout')
@section('page-title', 'Manage Job')
@section('page-content')

<div class="form-head d-flex mb-sm-4 mb-3">
    <div class="me-auto">
        <h2 class="text-black font-w600">Manage Job</h2>
        <p class="mb-0">Manage Job</p>
    </div>
    <div>
        <a href="{{ route('trn_jobs.index') }}" class="btn btn-danger">Back</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form id="jobForm">
                    <h4><u>Job Details</u></h4>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="job_date" class="form-label">Date<span class="required-field">*</span></label>
                            <input name="job_date" type="date" placeholder="Date" class="form-control" value="{{ $jobs ? $jobs['job_date'] : date('Y-m-d') }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="job_received_from" class="form-label">Received from</label>
                            <input name="job_received_from" id="job_received_from" type="text" placeholder="Job received from" class="form-control" value="{{ $jobs ? $jobs['job_received_from'] : '' }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="job_file_type" class="form-label">File Type<span class="required-field">*</span></label>
                            <select name="job_file_type" id="job_file_type" class="form-select">
                                <option value="" {{ $jobs && $jobs['job_file_type'] == '' ? 'selected' : '' }}>Select File Type</option>
                                <option value="Office" {{ $jobs && $jobs['job_file_type'] == 'Office' ? 'selected' : '' }}>Office</option>
                                <option value="Client" {{ $jobs && $jobs['job_file_type'] == 'Client' ? 'selected' : '' }}>Client</option>
                                <option value="Court" {{ $jobs && $jobs['job_file_type'] == 'Court' ? 'selected' : '' }}>Court</option>
                                <option value="NoFile" {{ $jobs && $jobs['job_file_type'] == 'NoFile' ? 'selected' : '' }}>NoFile</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="job_fileno" class="form-label">File No</label>
                            <input name="job_fileno" id="job_fileno_d" readonly type="text" class="form-control" placeholder="File No." value="{{ $jobs ? $jobs['job_fileno'] : '' }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="job_ref_fileno" class="form-label">Linked File No. (if any)</label>
                            <input name="job_ref_fileno" type="number" placeholder="Reference File No." class="form-control" value="{{ $jobs ? $jobs['job_ref_fileno'] : '' }}">
                        </div>
                    </div>

                    <h4 class="mt-3"><u>Ownership Details</u></h4>
                    <div class="row mt-3">
                        <div class="col-md-3 mb-3">
                            <label for="job_staff_id" class="form-label">Job Incharge<span class="required-field">*</span></label>
                            <select name="job_staff_id" id="job_staff_id" class="form-select">
                                <option value="">-- Select Job Incharge --</option>
                                @foreach($staffs as $staff)
                                    <option value="{{ $staff->staff_id }}" {{ $jobs && $jobs['job_staff_id'] == $staff->staff_id ? 'selected' : '' }}>
                                        {{ $staff->staff_salutation ? $staff->staff_salutation.'.' : '' }} {{ $staff->staff_first_name ?? '' }} {{ $staff->staff_middle_name ?? '' }}{{ $staff->staff_last_name ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="job_client_id" class="form-label">Select Client<span class="required-field">*</span></label>
                            <select name="job_client_id" id="job_client_id" class="form-control select2">
                                <option value="">-- Select Client --</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->client_id }}" {{ $jobs && $jobs['job_client_id'] == $client->client_id ? 'selected' : '' }}>
                                        {{ $client->client_salutation ? $client->client_salutation.'.' : '' }} {{ $client->client_first_name ?? '' }} {{ $client->client_middle_name ?? '' }}{{ $client->client_last_name ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                            <a href="{{ route('mst_clients.add') }}" target="_blank" class="d-block mt-2">Add new Client</a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="job_client_contact_person" class="form-label">Client Contact Person</label>
                            <select name="job_client_contact_person" id="job_client_contact_person" class="form-select">
                                <option value="">-- Client Contact Person --</option>
                            </select>
                        </div>
                    </div>

                    <h4 class="mt-3"><u>Cost Estimate</u></h4>
                    <div class="row mt-3">
                        <div class="col-md-3 mb-3">
                            <label for="job_advocate_fee" class="form-label">Advocate Fee</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input name="job_advocate_fee" id="job_advocate_fee" type="number" placeholder="Enter Advocate Fee" class="form-control" onkeyup="calculateAmount();" value="{{ $jobs ? $jobs['job_advocate_fee'] : '' }}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="job_stamp_reg_court_fee" class="form-label">Stamp/Registration/Court Fee</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input name="job_stamp_reg_court_fee" id="job_stamp_reg_court_fee" type="number" placeholder="Enter Stamp/Registration/Court Fee" class="form-control" onkeyup="calculateAmount();" value="{{ $jobs ? $jobs['job_stamp_reg_court_fee'] : '' }}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="job_misc_expenses" class="form-label">Miscellaneous Expenses</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input name="job_misc_expenses" id="job_misc_expenses" type="number" placeholder="Enter Miscellaneous Expenses" class="form-control" onkeyup="calculateAmount();" value="{{ $jobs ? $jobs['job_misc_expenses'] : '' }}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="job_total_amount" class="form-label">Total Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input name="job_total_amount" id="job_total_amount" type="number" placeholder="Enter Total Amount" class="form-control" readonly value="{{ $jobs ? $jobs['job_total_amount'] : '' }}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="job_total_receipt" class="form-label">Total Receipt</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input name="job_total_receipt" id="job_total_receipt" type="number" placeholder="Enter Total Receipt" class="form-control" readonly value="{{ $jobs ? $jobs['job_total_receipt'] : '' }}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="job_discount" class="form-label">Discount</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input name="job_discount" id="job_discount" type="number" placeholder="Enter Discount" class="form-control" onkeyup="calculateAmount();" value="{{ $jobs ? $jobs['job_discount'] : '' }}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="job_balance_amount" class="form-label">Balance Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input name="job_balance_amount" id="job_balance_amount" type="number" placeholder="Enter Balance Amount" class="form-control" readonly value="0" value="{{ $jobs ? $jobs['job_balance_amount'] : '' }}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="job_settled_amount" class="form-label">Settled Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input name="job_settled_amount" id="job_settled_amount" type="number" placeholder="Enter Settled Amount" class="form-control" value="{{ $jobs ? $jobs['job_settled_amount'] : '' }}">
                            </div>
                        </div>
                    </div>

                    <h4 class="mt-3"><u>Other Details</u></h4>
                    <div class="row mt-3">
                        <div class="col-md-6 mb-3">
                            <label for="job_property_details" class="caption">Property Details</label>
                            <textarea name="job_property_details" placeholder="Enter Property Details" class="form-control">{{ $jobs ? $jobs['job_property_details'] : '' }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="job_instructions" class="caption">Instructions</label>
                            <textarea name="job_instructions" placeholder="Enter Instructions" class="form-control">{{ $jobs ? $jobs['job_instructions'] : '' }}</textarea>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-lg-12 text-center">
                            <input type="hidden" name="job_id" value="{{ $jobs ? $jobs['job_id'] : '' }}">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{ route('trn_jobs.index') }}" class="btn btn-danger">Back</a>
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
    $("#job_client_id, #job_staff_id").select2();
    $('#jobForm').on('submit', function(e) {
        e.preventDefault();
        var actionUrl = "{{ $jobs && $jobs->job_id ? route('trn_jobs.update') : route('trn_jobs.insert') }}";
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
                        window.location.href = '{{ route("trn_jobs.index") }}';
                    }, 1000);
                } else {
                    toastr.error('An unexpected error occurred. Please try again.');
                }
            },
            error: function(xhr, status, error) {
                $('html, body').animate({ scrollTop: 0 }, 'slow');
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
    
    function validateField(selector, message) {
        $(selector).addClass('is-invalid');
        $(selector).after(`<div class="invalid-feedback">${message}</div>`);
    }
});

function calculateAmount()
{
    let job_advocate_fee = parseInt($('#job_advocate_fee').val()) || 0;
    let job_stamp_reg_court_fee = parseInt($('#job_stamp_reg_court_fee').val()) || 0;
    let job_misc_expenses = parseInt($('#job_misc_expenses').val()) || 0;

    let job_discount = parseInt($('#job_discount').val()) || 0;

    let totalAmount = job_advocate_fee + job_stamp_reg_court_fee + job_misc_expenses;
    $('#job_total_amount').val(totalAmount);

    let job_total_receipt = parseInt($('#job_total_receipt').val()) || 0;
    let job_balance_amount_total = (totalAmount - job_total_receipt) - job_discount
    $('#job_balance_amount').val(job_balance_amount_total);
}


</script>
@endsection