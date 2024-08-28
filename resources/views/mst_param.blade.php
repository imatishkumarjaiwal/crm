@extends('layout')
@section('page-title', 'Site Setting')
@section('page-content')
<div class="form-head d-flex mb-sm-4 mb-3">
    <div class="me-auto">
        <h2 class="text-black font-w600">Site Setting</h2>
        <p class="mb-0">View / Update Site Setting</p>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form id="add_update_form" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="site_name" class="form-label">Site Name</label>
                            <input type="text" class="form-control" id="site_name" name="site_name" value="{{ $setting->site_name ?? '' }}" required>
                        </div>
            
                        <div class="col-md-4 mb-3">
                            <label for="site_currency_id" class="form-label">Site Currency</label>
                            <select class="form-select" id="site_currency_id" name="site_currency_id" required>
                                <option value="1" {{ $setting->site_currency_id == 1 ? 'selected' : '' }}>Indian Rupee INR ₹</option>
                            </select>
                        </div>
            
                        <div class="col-md-4 mb-3">
                            <label for="site_email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="site_email" name="site_email" value="{{ $setting->site_email ?? '' }}" required>
                        </div>
            
                        <div class="col-md-4 mb-3">
                            <label for="site_phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="site_phone" name="site_phone" value="{{ $setting->site_phone ?? '' }}" required>
                        </div>
            
                        <div class="col-md-4 mb-3">
                            <label for="site_fax" class="form-label">Fax</label>
                            <input type="text" class="form-control" id="site_fax" name="site_fax" value="{{ $setting->site_fax ?? '' }}">
                        </div>
            
                        <div class="col-md-4 mb-3">
                            <label for="site_url" class="form-label">URL</label>
                            <input type="url" class="form-control" id="site_url" name="site_url" value="{{ $setting->site_url ?? '' }}" required>
                        </div>
            
                        <div class="col-md-4 mb-3">
                            <label for="site_incharge" class="form-label">In-charge</label>
                            <input type="text" class="form-control" id="site_incharge" name="site_incharge" value="{{ $setting->site_incharge ?? '' }}" required>
                        </div>
            
                        <div class="col-md-4 mb-3">
                            <label for="site_tax_rate" class="form-label">Tax Rate</label>
                            <div class="input-group">
                                <span class="input-group-text">@</span>
                                <input type="text" class="form-control" id="site_tax_rate" name="site_tax_rate" value="{{ $setting->site_tax_rate ?? '' }}">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
            
                        <div class="col-md-4 mb-3">
                            <label for="site_add_time_hh_mm" class="form-label">Time Difference (Hours:Minutes)</label>
                            <input type="text" class="form-control" id="site_add_time_hh_mm" name="site_add_time_hh_mm" value="{{ $setting->site_add_time_hh_mm ?? '' }}">
                        </div>
            
                        <div class="col-md-4 mb-3">
                            <label for="site_logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="site_logo" name="site_logo" accept=".jpg, .jpeg, .png">
                            @if($setting && $setting->site_logo)
                                <input name="old_site_logo" type="hidden" value="{{ $setting->site_logo }}">
                                <a href="{{ asset('storage/' . $setting->site_logo) }}" target="_blank" class="d-block mt-2">View Current Logo</a>
                            @endif
                            <div class="upload-instructions mt-3">
                                <p>Please follow the instructions below to upload your logo:</p>
                                <ul>
                                    <li>**File Format**: The logo must be in one of the following formats: <span style="color: red;">`.jpg`, `.jpeg`, `.png`.</span></li>
                                    <li>**File Size**: Ensure the image size is less than <span style="color: red;">2MB</span>  for optimal loading speed.</li>
                                    <li>**Dimensions**: The recommended size is <span style="color: red;">200x200</span> pixels. Larger images will be automatically resized.</li>
                                    <li>**Background**: Preferably, use a transparent background (for PNG) or a plain white background.</li>
                                </ul>
                            </div>
                        </div>
            
                        <div class="col-md-8 mb-3">
                            <label for="site_address" class="form-label">Address</label>
                            <textarea class="form-control" id="site_address" name="site_address" required>{{ $setting->site_address ?? '' }}</textarea>
                        </div>
                    </div>
            
                    <div class="d-flex justify-content-center">
                        <button type="submit" id="submit_btn" class="btn btn-primary me-2">Update</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Exit</a>
                    </div>
                </form>
            </div>
            
            <!-- end card-body -->
        </div>
        <!-- end card -->
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection
@section('footer')
<script>
    $("#add_update_form").submit(function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    $.ajax({
        url: "{{ route('mst_param.update') }}",
        type: 'POST',
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        data: formData,
        success: function(response) {
            toastr.success(response.message);
            $('#submit_btn').attr("disabled", true);
            setTimeout(function() {
                location.reload();
            }, 2000);
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

function validateField(field, message) {
    var $field = $(field);
    $field.addClass("is-invalid").removeClass("is-valid");
    if ($field.siblings(".invalid-feedback").length === 0) {
        $field.after('<div class="invalid-feedback">' + message + '</div>');
    } else {
        $field.siblings(".invalid-feedback").text(message).show();
    }
}

</script>
@endsection

