<div class="container">
    <div class="row">
        <div class="col-lg-4 mb-3">
            <div class="card mb-3">
                <div class="card-header">Forms</div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active">General Consent</a>
                        <a href="#" class="list-group-item list-group-item-action">Data Privacy Consent</a>
                        <a href="#" class="list-group-item list-group-item-action">Discharge Summary</a>
                        <a href="#" class="list-group-item list-group-item-action">Nurse Notes</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 mb-3">
            <div class="card mb-3">
                <div class="card-header">Form Details</div>
                <div class="card-body">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="{{ $viewFolder }}[clinic]" id="{{ $viewFolder }}_clinic" placeholder="" value="{{ !empty($datum->clinic->name) ? $datum->clinic->name : ''  }}" disabled>
                        <label for="{{ $viewFolder }}_clinic" class="form-label">Clinic Name</label>
                        <small id="help_{{ $viewFolder }}_clinic" class="text-muted"></small>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="date" name="{{ $viewFolder }}[booking_date]" id="{{ $viewFolder }}_booking_date" placeholder="" value="{{ !empty($datum->bookingDate) ? $datum->bookingDate : ''  }}" disabled>
                        <label for="{{ $viewFolder }}_booking_date" class="form-label">Date</label>
                        <small id="help_{{ $viewFolder }}_booking_date" class="text-muted"></small>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="{{ $viewFolder }}[name]" id="{{ $viewFolder }}_name" placeholder="" value="{{ !empty($datum->patient->name) ? $datum->patient->name : ''  }}" disabled>
                        <label for="{{ $viewFolder }}_name" class="form-label">Patient Name</label>
                        <small id="help_{{ $viewFolder }}_name" class="text-muted"></small>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="number" name="{{ $viewFolder }}[age]" id="{{ $viewFolder }}_age" placeholder="" value="{{ !empty($datum->patient->birthdate) ? floor((strtotime($datum->bookingDate) - strtotime($datum->patient->birthdate))/(60*60*24*365.25)) : ''  }}" disabled>
                        <label for="{{ $viewFolder }}_age" class="form-label">Age</label>
                        <small id="help_{{ $viewFolder }}_age" class="text-muted"></small>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="{{ $viewFolder }}[gender]" id="{{ $viewFolder }}_gender" placeholder="" value="{{ !empty($datum->patient->gender) ? $datum->patient->gender : ''  }}" disabled>
                        <label for="{{ $viewFolder }}_gender" class="form-label">Gender</label>
                        <small id="help_{{ $viewFolder }}_gender" class="text-muted"></small>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="{{ $viewFolder }}[[address]" id="{{ $viewFolder }}_address" rows=3 disabled>{{ !empty($datum->patient->address) ? $datum->patient->address : '' }}</textarea>
                        <label for="{{ $viewFolder }}_address" class="form-label">Address</label>
                        <small id="help_{{ $viewFolder }}_address" class="text-muted"></small>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="{{ $viewFolder }}[[diagnosis]" id="{{ $viewFolder }}_diagnosis" rows=3 disabled>{{ !empty($datum->assessment) ? $datum->assessment : '' }}</textarea>
                        <label for="{{ $viewFolder }}_diagnosis" class="form-label">Secondary Diagnosis</label>
                        <small id="help_{{ $viewFolder }}_diagnosis" class="text-muted"></small>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="{{ $viewFolder }}[payment_mode]" id="{{ $viewFolder }}_payment_mode" placeholder="" disabled>
                            <option value="Both" {{ isset($datum->payment_mode) && $datum->payment_mode == 'Both' ? 'selected' : '' }}>Both Philhealth and HMO</option>
                            <option value="Both Cash" {{ isset($datum->payment_mode) && $datum->payment_mode == 'Both Cash' ? 'selected' : '' }}>Both Philhealth, HMO and Cash</option>
                            <option value="Philhealth" {{ isset($datum->payment_mode) && $datum->payment_mode == 'Philhealth' ? 'selected' : '' }}>Philhealth</option>
                            <option value="HMO" {{ isset($datum->payment_mode) && $datum->payment_mode == 'HMO' ? 'selected' : '' }}>HMO</option>
                            <option value="Charity" {{ isset($datum->payment_mode) && $datum->payment_mode == 'Charity' ? 'selected' : '' }}>Charity</option>
                            <option value="Cash" {{ (isset($datum->payment_mode) && $datum->payment_mode == 'Cash') || !isset($datum->payment_mode) ? 'selected' : '' }}>Cash</option>
                        </select>
                        <label for="{{ $viewFolder }}_payment_mode">Payment Mode</label>
                        <small id="help_{{ $viewFolder }}_payment_mode" class="text-muted"></small>
                    </div>
                </div>
                <div class="card-footer">
                    <button id="createPDFButMedCert{{ $datum->id }}" type="button" class="createPDFButMedCert btn btn-{{ $bgColor }} btn-sm" {{ ($datum->findings == '' || $datum->diagnosis == '' || $datum->recommendations == '') ? 'disabled' : '' }}>Create PDF</button>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">Form Preview</div>
                <div class="card-body">
                    <iframe id="iframeDynaForm" src="{{ file_exists(public_path('storage/med_cert_files/' . $datum->id . '_' . $datum->patient->l_name . '.pdf')) ? asset('storage/med_cert_files/' . $datum->id . '_' . $datum->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" width="100%" height="300" style="border:1"></iframe>
                    <small class="form-text text-muted">To print or download check the upper right part</small>
                </div>
            </div>
        </div>
    </div>
</div>