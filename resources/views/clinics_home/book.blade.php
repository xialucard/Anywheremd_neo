
<datalist id="patientNameList"></datalist>

<div class="container">
  <div class="row">
    <div class="col-lg-4 mb-3">
      <div class="card mb-3">
        <div class="card-header">Booking Info</div>
        <div class="card-body">
          <div class="form-floating mb-3">
            <input class="form-control" type="date" name="{{ $viewFolder }}[bookingDate]" id="{{ $viewFolder }}_bookingDate" value="{{ $dateBooking }}" placeholder="" required readonly>
            <label for="{{ $viewFolder }}_bookingDate" class="form-label">Booking Date</label>
            <small id="help_{{ $viewFolder }}_bookingDate" class="text-muted"></small>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control" list="patientNameList" id="{{ $viewFolder }}_name" value="{{ isset($datum->patient->name) ? $datum->patient->name : '' }}" placeholder="" autocomplete="off" {{ isset($datum->id) ? 'disabled' : '' }}>
            <input type="hidden" class="form-control" id="{{ $viewFolder }}_patient_id" name="{{ $viewFolder }}[patient_id]" value="{{ !empty($datum->patient_id) ? $datum->patient_id : '' }}">
            <label for="{{ $viewFolder }}_name" class="form-label">Patient's Name</label>
            <small id="help_{{ $viewFolder }}_name" class="text-muted">Please leave this blank if the patient's name is not in the list.</small>
          </div>
          <div class="form-floating mb-3">
            <select class="form-select" name="{{ $viewFolder }}[booking_type]" id="{{ $viewFolder }}_booking_type" placeholder="" onchange="
                if($(this).val() != ''){
                  $('#{{ $viewFolder }}_procedure_details').prop('disabled', false);
                  $('#{{ $viewFolder }}_procedure_details').prop('required', true);
                }else{
                  $('#{{ $viewFolder }}_procedure_details').prop('disabled', true);
                  $('#{{ $viewFolder }}_procedure_details').prop('required', false);
                }
              @if(isset($datum->id))
                if($(this).val() == 'Dialysis'){
                  $('#{{ $viewFolder }}_post_weight').prop('disabled', false);
                  $('#{{ $viewFolder }}_post_weight').prop('required', true);
                }else{
                  $('#{{ $viewFolder }}_post_weight').prop('disabled', true);
                  $('#{{ $viewFolder }}_post_weight').prop('required', false);
                }
              @endif
              " {{ isset($referal_conso) ? 'disabled' : '' }}>
              @php
                if(isset($referal_conso)){
                  $origBookingType = $datum->booking_type;
                  $datum->booking_type = $referal_conso->booking_type;
                  $datum->procedure_details = $referal_conso->procedure_details;
                }
                  
              @endphp
              <option value="" {{ isset($datum->booking_type) && $datum->booking_type == '' ? 'selected' : '' }}>Consultation</option>
              <optgroup label="Procedure">
                <option value="Diagnostics" {{ isset($datum->booking_type) && $datum->booking_type == 'Diagnostics' ? 'selected' : '' }}>Diagnostics</option>
                <option value="Dialysis" {{ isset($datum->booking_type) && $datum->booking_type == 'Dialysis' ? 'selected' : '' }}>Dialysis</option>
                <option value="Laboratory" {{ isset($datum->booking_type) && $datum->booking_type == 'Laboratory' ? 'selected' : '' }}>Laboratory</option>
                <option value="Laser" {{ isset($datum->booking_type) && $datum->booking_type == 'Laser' ? 'selected' : '' }}>Laser</option>
                <option value="Surgery" {{ isset($datum->booking_type) && $datum->booking_type == 'Surgery' ? 'selected' : '' }}>Surgery</option>
              </optgroup>
            </select>
            @if(isset($referal_conso))
              <input type="hidden" class="form-control" name="{{ $viewFolder }}[booking_type]" value="{{ !empty($origBookingType) ? $origBookingType : '' }}">
              <input type="hidden" class="form-control" name="{{ $viewFolder }}[referral_id]" value="{{ $referal_conso->id }}">
            @endif
            <label for="{{ $viewFolder }}_booking_type">Booking Type</label>
            <small id="help_{{ $viewFolder }}_booking_type" class="text-muted"></small>
          </div>
          <div class="form-floating mb-3">
            <textarea class="form-control" name="{{ $viewFolder }}[procedure_details]" id="{{ $viewFolder }}_procedure_details" rows=3 {{ (isset($datum->booking_type) && $datum->booking_type == '' || !isset($datum->booking_type)) ? 'disabled' : '' }}>{{ !empty($datum->procedure_details) ? $datum->procedure_details : '' }}</textarea>
            <label for="{{ $viewFolder }}_procedure_details" class="form-label">Procedure Details</label>
            <small id="help_{{ $viewFolder }}_procedure_details" class="text-muted"></small>
          </div>
          <div class="form-floating mb-3">
            <textarea class="form-control" name="{{ $viewFolder }}[complain]" id="{{ $viewFolder }}" rows=3 id="{{ $viewFolder }}_complain" required>{{ !empty($datum->complain) ? $datum->complain : '' }}</textarea>
            <label for="{{ $viewFolder }}_complain" class="form-label">Chief Complaint</label>
            <small id="help_{{ $viewFolder }}_complain" class="text-muted"></small>
          </div>
          <div class="input-group mb-3">
            <div class="form-floating">
              <input class="form-control" type="text" name="{{ $viewFolder }}[duration]" id="{{ $viewFolder }}_duration" placeholder="" value="{{ !empty($datum->duration) ? $datum->duration : '' }}" required>
              <label for="{{ $viewFolder }}_duration" class="form-label">Duration of Complaint</label>
              <small id="help_{{ $viewFolder }}_duration" class="text-muted"></small>
            </div>
            {{-- <span class="input-group-text">day/s</span> --}}
          </div>
          <div class="form-floating mb-3">
            <textarea class="form-control" name="{{ $viewFolder }}[others]" id="{{ $viewFolder }}" rows=3 id="{{ $viewFolder }}_others" required>{{ !empty($datum->others) ? $datum->others : '' }}</textarea>
            <label for="{{ $viewFolder }}_others" class="form-label">Remarks</label>
            <small id="help_{{ $viewFolder }}_others" class="text-muted"></small>
          </div>
          <div class="form-floating mb-3">
            <select class="form-select" name="{{ $viewFolder }}[payment_mode]" id="{{ $viewFolder }}_payment_mode" placeholder="" required onchange="
                if($(this).val() == 'Both' || $(this).val() == 'Both Cash'){
                  $('#{{ $viewFolder }}_phil_num').prop('disabled', false);
                  $('#{{ $viewFolder }}_phil_num').prop('required', true);
                  $('#{{ $viewFolder }}_hmo').prop('disabled', false);
                  $('#{{ $viewFolder }}_hmo').prop('required', true);
                  $('#{{ $viewFolder }}_hmo_num').prop('disabled', false);
                  $('#{{ $viewFolder }}_hmo_num').prop('required', true);
                }else if($(this).val() == 'Philhealth'){
                  $('#{{ $viewFolder }}_phil_num').prop('disabled', false);
                  $('#{{ $viewFolder }}_phil_num').prop('required', true);
                  $('#{{ $viewFolder }}_hmo').prop('disabled', true);
                  $('#{{ $viewFolder }}_hmo').prop('required', false);
                  $('#{{ $viewFolder }}_hmo_num').prop('disabled', true);
                  $('#{{ $viewFolder }}_hmo_num').prop('required', false);
                }else if($(this).val() == 'HMO'){
                  $('#{{ $viewFolder }}_phil_num').prop('disabled', true);
                  $('#{{ $viewFolder }}_phil_num').prop('required', false);
                  $('#{{ $viewFolder }}_hmo').prop('disabled', false);
                  $('#{{ $viewFolder }}_hmo').prop('required', true);
                  $('#{{ $viewFolder }}_hmo_num').prop('disabled', false);
                  $('#{{ $viewFolder }}_hmo_num').prop('required', true);
                }else{
                  $('#{{ $viewFolder }}_phil_num').prop('disabled', true);
                  $('#{{ $viewFolder }}_phil_num').prop('required', false);
                  $('#{{ $viewFolder }}_hmo').prop('disabled', true);
                  $('#{{ $viewFolder }}_hmo').prop('required', false);
                  $('#{{ $viewFolder }}_hmo_num').prop('disabled', true);
                  $('#{{ $viewFolder }}_hmo_num').prop('required', false);
                }
              ">
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
      </div>
      @if(isset($datum->id) && !isset($datum->consultation_parent_id) && !isset($referal_conso))
      @php
        unset($referedDoctorArr);
        foreach($datum->consultation_referals as $consultation_referal){
          $bookingType = $consultation_referal->booking_type;
          if($consultation_referal->booking_type == '')
            $bookingType = 'Consultations';
          $referedDoctorArr[$consultation_referal->id] = $bookingType . ' - ' . $consultation_referal->bookingDate . ' | ' . $consultation_referal->clinic_id . ' - ' . $consultation_referal->clinic->name . ' | ' . $consultation_referal->doctor_id . ' - ' . $consultation_referal->doctor->name;
        }
      @endphp
      <div class="card">
        <div class="card-header">Refer a Doctor</div>
        <div class="card-body">
          <input class="form-control" id="{{ $viewFolder }}_referal" name="{{ $viewFolder }}[referal]" value="{{ isset($referedDoctorArr) ? implode(',', $referedDoctorArr) : '' }}" {{ isset($referedDoctorArr) ? 'disabled' : '' }} autocomplete="off">
          <small class="text-muted">Please type doctor's name then select the booking type, date and clinic in the option that will appear.</small>
        </div>
      </div>
      @endif
    </div>
    <div class="col-lg-8">
      <ul class="nav nav-tabs">
        @if(isset($datum->id))
        <li class="nav-item">
          <a class="nav-link {{ !isset($datum->id) ? '' : 'active' }}"  href="#" id="patBookChartLink" onclick="
            $('#consoDocDiv').hide();  
            $('#consoPatientDiv').hide();
            $('#consoPatUploadDiv').hide();
            $('#consoNurseUploadDiv').hide();
            $('#consoPatBookChartDiv').show();
            $(this).addClass('active');
            $('#docInfoLink').removeClass('active');
            $('#patInfoLink').removeClass('active');
            $('#patUploadLink').removeClass('active');
            $('#nurseUploadLink').removeClass('active');
          ">Patient's Booking Chart</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="#" id="patUploadLink" onclick="
            $('#consoDocDiv').hide();  
            $('#consoPatientDiv').hide();
            $('#consoPatBookChartDiv').hide();
            $('#consoPatUploadDiv').show();
            $('#consoNurseUploadDiv').hide();
            $(this).addClass('active');
            $('#docInfoLink').removeClass('active');
            $('#patInfoLink').removeClass('active');
            $('#patBookChartLink').removeClass('active');
            $('#nurseUploadLink').removeClass('active');
          ">File Uploads</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="#" id="nurseUploadLink" onclick="
            $('#consoDocDiv').hide();  
            $('#consoPatientDiv').hide();
            $('#consoPatBookChartDiv').hide();
            $('#consoPatUploadDiv').hide();
            $('#consoNurseUploadDiv').show();
            $(this).addClass('active');
            $('#docInfoLink').removeClass('active');
            $('#patInfoLink').removeClass('active');
            $('#patBookChartLink').removeClass('active');
            $('#patUploadLink').removeClass('active');
          ">Nurse's File Uploads</a>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link"  href="#" id="patInfoLink" onclick="
            $('#consoDocDiv').hide();  
            $('#consoPatBookChartDiv').hide();  
            $('#consoPatUploadDiv').hide();
            $('#consoNurseUploadDiv').hide();
            $('#consoPatientDiv').show();
            $(this).addClass('active');
            $('#docInfoLink').removeClass('active');
            $('#patBookChartLink').removeClass('active');
            $('#patUploadLink').removeClass('active');
            $('#nurseUploadLink').removeClass('active');
          ">Patient's Info</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ !isset($datum->id) ? 'active' : '' }}" id="docInfoLink" href="#" onclick="
          $('#consoPatientDiv').hide();  
          $('#consoPatBookChartDiv').hide(); 
          $('#consoPatUploadDiv').hide();
          $('#consoNurseUploadDiv').hide();
          $('#consoDocDiv').show();  
          $(this).addClass('active');
          $('#patInfoLink').removeClass('active');
          $('#patBookChartLink').removeClass('active');
          $('#patUploadLink').removeClass('active');
          $('#nurseUploadLink').removeClass('active');
        ">Doctor's Info</a>
        </li>
      </ul>
      <div id="consoPatUploadDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
        <div class="mb-3">
          <label for="formFileMultiple" class="form-label">File Upload/s</label>
          <input class="form-control" type="file" id="{{ $viewFolder }}_files" name="{{ $viewFolder }}[ConsultationFile][files][]" accept="image/*, .pdf" multiple>
        </div>
        <div class="row" id="image_preview_saved">
          @if(isset($datum->consultation_files))
            @foreach($datum->consultation_files as $ind => $file)
            @php
              $exAr = explode('/', $file->file_link);
            @endphp
          <div class='img-div' id='img-div-save{{ $ind }}'><img src='{{ asset($file->file_link) }}' class='img-thumbnail' title='{{ $exAr[sizeof($exAr)-1] }}'><div class='middle'><button id='action-icon' value='img-div-save{{ $ind }}' class='btn btn-danger' role='{{ $exAr[sizeof($exAr)-1] }}' saved='{{ $file->id }}'><i class='bi bi-trash'></i></button></div></div>
            @endforeach
          @endif
        </div>
        <div class="row" id="image_preview"></div>
      </div>
      <div id="consoNurseUploadDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
        <div class="mb-3">
          <label for="formFileMultiple" class="form-label">Nurse File Upload/s</label>
          <input class="form-control" type="file" id="{{ $viewFolder }}_nurse_files" name="{{ $viewFolder }}[NurseFile][files][]" accept="image/*, .pdf" multiple>
        </div>
        <div class="row" id="image_preview_saved_nurse">
          @if(isset($datum->nurse_files))
            @foreach($datum->nurse_files as $ind => $file)
            @php
              $exAr = explode('/', $file->file_link);
            @endphp
          <div class='img-div' id='img-div-nurse-save{{ $ind }}'><img src='{{ asset($file->file_link) }}' class='img-thumbnail' title='{{ $exAr[sizeof($exAr)-1] }}'><div class='middle'><button id='action-icon-nurse' value='img-div-nurse-save{{ $ind }}' class='btn btn-danger' role='{{ $exAr[sizeof($exAr)-1] }}' saved='{{ $file->id }}'><i class='bi bi-trash'></i></button></div></div>
            @endforeach
          @endif
        </div>
        <div class="row" id="image_preview_nurse"></div>
      </div>
      <div id="consoPatBookChartDiv" style="{{ !isset($datum->id) ? 'display:none' : '' }}" class="container border border-1 border-top-0 mb-3 p-3">
        @if(isset($datum->booking_type) && $datum->booking_type == 'Dialysis1')
        <div class="row">
          <div class="col-lg-4">
            <div class="input-group mb-3">
              <div class="form-floating">
                <input class="form-control" type="text" name="{{ $viewFolder }}[id]" id="{{ $viewFolder }}_id" value="{{ isset($datum->id) ? $datum->id : '' }}" placeholder="" readonly>
                <label for="{{ $viewFolder }}_id" class="form-label">Treatment Number</label>
                <small id="help_{{ $viewFolder }}_id" class="text-muted"></small>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="input-group mb-3">
              <div class="form-floating">
                <input class="form-control" type="time" name="{{ $viewFolder }}[time_started]" id="{{ $viewFolder }}_time_started" value="" placeholder="">
                <label for="{{ $viewFolder }}_time_started" class="form-label">Time Started</label>
                <small id="help_{{ $viewFolder }}_time_started" class="text-muted"></small>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="input-group mb-3">
              <div class="form-floating">
                <input class="form-control" type="time" name="{{ $viewFolder }}[time_ended]" id="{{ $viewFolder }}_time_ended" value="" placeholder="">
                <label for="{{ $viewFolder }}_time_ended" class="form-label">Time Ended</label>
                <small id="help_{{ $viewFolder }}_time_ended" class="text-muted"></small>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-header">Machine Details</div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-3">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="text" name="{{ $viewFolder }}[machine_number]" id="{{ $viewFolder }}_machine_number" value="" placeholder="">
                    <label for="{{ $viewFolder }}_machine_number" class="form-label">Machine Number</label>
                    <small id="help_{{ $viewFolder }}_machine_number" class="text-muted"></small>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="text" name="{{ $viewFolder }}[dialyzer]" id="{{ $viewFolder }}_dialyzer" value="" placeholder="">
                    <label for="{{ $viewFolder }}_dialyzer" class="form-label">Dialyzer</label>
                    <small id="help_{{ $viewFolder }}_dialyzer" class="text-muted"></small>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="text" name="{{ $viewFolder }}[use]" id="{{ $viewFolder }}_use" value="" placeholder="">
                    <label for="{{ $viewFolder }}_use" class="form-label">Use</label>
                    <small id="help_{{ $viewFolder }}_use" class="text-muted"></small>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="text" name="{{ $viewFolder }}[acid]" id="{{ $viewFolder }}_acid" value="" placeholder="">
                    <label for="{{ $viewFolder }}_acid" class="form-label">Acid</label>
                    <small id="help_{{ $viewFolder }}_acid" class="text-muted"></small>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="text" name="{{ $viewFolder }}[add]" id="{{ $viewFolder }}_add" value="" placeholder="">
                    <label for="{{ $viewFolder }}_add" class="form-label">Add</label>
                    <small id="help_{{ $viewFolder }}_add" class="text-muted"></small>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="text" name="{{ $viewFolder }}[bfr]" id="{{ $viewFolder }}_bfr" value="" placeholder="">
                    <label for="{{ $viewFolder }}_bfr" class="form-label">BRF</label>
                    <small id="help_{{ $viewFolder }}_bfr" class="text-muted"></small>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="text" name="{{ $viewFolder }}[dfr]" id="{{ $viewFolder }}_dfr" value="" placeholder="">
                    <label for="{{ $viewFolder }}_dfr" class="form-label">DFR</label>
                    <small id="help_{{ $viewFolder }}_dfr" class="text-muted"></small>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="text" name="{{ $viewFolder }}[setup_prime]" id="{{ $viewFolder }}_setup_prime" value="" placeholder="">
                    <label for="{{ $viewFolder }}_setup_prime" class="form-label">Setup Prime</label>
                    <small id="help_{{ $viewFolder }}_setup_prime" class="text-muted"></small>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <textarea class="form-control" name="{{ $viewFolder }}[safety_check]" id="{{ $viewFolder }}_safety_check" rows=3></textarea>
                    <label for="{{ $viewFolder }}_safety_check" class="form-label">Safety Check</label>
                    <small id="help_{{ $viewFolder }}_safety_check" class="text-muted"></small>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <textarea class="form-control" name="{{ $viewFolder }}[residual_test]" id="{{ $viewFolder }}_residual_test" rows=3></textarea>
                    <label for="{{ $viewFolder }}_residual_test" class="form-label">Residual Test</label>
                    <small id="help_{{ $viewFolder }}_residual_test" class="text-muted"></small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-header">Treatment Plan</div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="number" name="{{ $viewFolder }}[dry_weight]" min=1 step=.1 id="{{ $viewFolder }}_dry_weight" value="" placeholder="">
                    <label for="{{ $viewFolder }}_dry_weight" class="form-label">Estimate Dry Weight</label>
                    <small id="help_{{ $viewFolder }}_dry_weight" class="text-muted"></small>
                  </div>
                  <span class="input-group-text">kg</span>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="number" name="{{ $viewFolder }}[prev_post_hd_weight]" min=1 step=.1 id="{{ $viewFolder }}_prev_post_hd_weight" value="" placeholder="">
                    <label for="{{ $viewFolder }}_prev_post_hd_weight" class="form-label">Prev. Post HD Weight</label>
                    <small id="help_{{ $viewFolder }}_prev_post_hd_weight" class="text-muted"></small>
                  </div>
                  <span class="input-group-text">kg</span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="number" name="{{ $viewFolder }}[pre_hd_weight]" min=1 step=.1 id="{{ $viewFolder }}_pre_hd_weight" value="" placeholder="">
                    <label for="{{ $viewFolder }}_pre_hd_weight" class="form-label">Pre HD Weight</label>
                    <small id="help_{{ $viewFolder }}_pre_hd_weight" class="text-muted"></small>
                  </div>
                  <span class="input-group-text">kg</span>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="number" name="{{ $viewFolder }}[post_hd_weight]" min=1 step=.1 id="{{ $viewFolder }}_post_hd_weight" value="" placeholder="">
                    <label for="{{ $viewFolder }}_post_hd_weight" class="form-label">Post HD Weight</label>
                    <small id="help_{{ $viewFolder }}_post_hd_weight" class="text-muted"></small>
                  </div>
                  <span class="input-group-text">kg</span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="text" name="{{ $viewFolder }}[ktv]" id="{{ $viewFolder }}_ktv" value="" placeholder="">
                    <label for="{{ $viewFolder }}_ktv" class="form-label">KT/V</label>
                    <small id="help_{{ $viewFolder }}_ktv" class="text-muted"></small>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="text" name="{{ $viewFolder }}[net_uf]" id="{{ $viewFolder }}_net_uf" value="" placeholder="">
                    <label for="{{ $viewFolder }}_net_uf" class="form-label">Net UF</label>
                    <small id="help_{{ $viewFolder }}_net_uf" class="text-muted"></small>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="number" name="{{ $viewFolder }}[hd_duration]" min=1 step=.1 id="{{ $viewFolder }}_hd_duration" value="" placeholder="">
                    <label for="{{ $viewFolder }}_hd_duration" class="form-label">Duration</label>
                    <small id="help_{{ $viewFolder }}_hd_duration" class="text-muted"></small>
                  </div>
                  <span class="input-group-text">hr/s</span>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="number" name="{{ $viewFolder }}[frequency]" min=1 step=.1 id="{{ $viewFolder }}_frequency" value="" placeholder="">
                    <label for="{{ $viewFolder }}_frequency" class="form-label">Frequency</label>
                    <small id="help_{{ $viewFolder }}_frequency" class="text-muted"></small>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="text" name="{{ $viewFolder }}[prime]" id="{{ $viewFolder }}_prime" value="" placeholder="">
                    <label for="{{ $viewFolder }}_prime" class="form-label">Prime/Rinse</label>
                    <small id="help_{{ $viewFolder }}_prime" class="text-muted"></small>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="text" name="{{ $viewFolder }}[other_fluids]" id="{{ $viewFolder }}_other_fluids" value="" placeholder="">
                    <label for="{{ $viewFolder }}_other_fluids" class="form-label">Duration</label>
                    <small id="help_{{ $viewFolder }}_other_fluids" class="text-muted"></small>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="text" name="{{ $viewFolder }}[total_uf_goal]" id="{{ $viewFolder }}_total_uf_goal" value="" placeholder="">
                    <label for="{{ $viewFolder }}_total_uf_goal" class="form-label">Total UF Goal</label>
                    <small id="help_{{ $viewFolder }}_total_uf_goal" class="text-muted"></small>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="text" name="{{ $viewFolder }}[weight_loss]" id="{{ $viewFolder }}_weight_loss" value="" placeholder="">
                    <label for="{{ $viewFolder }}_weight_loss" class="form-label">Weight Loss</label>
                    <small id="help_{{ $viewFolder }}_weight_loss" class="text-muted"></small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-header">Anticoagulant</div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="text" name="{{ $viewFolder }}[brand]" id="{{ $viewFolder }}_brand" value="" placeholder="">
                    <label for="{{ $viewFolder }}_brand" class="form-label">Brand Name</label>
                    <small id="help_{{ $viewFolder }}_brand" class="text-muted"></small>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="text" name="{{ $viewFolder }}[dose]" id="{{ $viewFolder }}_dose" value="" placeholder="">
                    <label for="{{ $viewFolder }}_dose" class="form-label">Dose</label>
                    <small id="help_{{ $viewFolder }}_dose" class="text-muted"></small>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="text" name="{{ $viewFolder }}[regular_dose]" id="{{ $viewFolder }}_regular_dose" value="" placeholder="">
                    <label for="{{ $viewFolder }}_regular_dose" class="form-label">Regular Dose</label>
                    <small id="help_{{ $viewFolder }}_regular_dose" class="text-muted"></small>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="text" name="{{ $viewFolder }}[low_dose]" id="{{ $viewFolder }}_low_dose" value="" placeholder="">
                    <label for="{{ $viewFolder }}_low_dose" class="form-label">Low Dose</label>
                    <small id="help_{{ $viewFolder }}_low_dose" class="text-muted"></small>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="text" name="{{ $viewFolder }}[lmwh]" id="{{ $viewFolder }}_lmwh" value="" placeholder="">
                    <label for="{{ $viewFolder }}_lmwh" class="form-label">LMWH</label>
                    <small id="help_{{ $viewFolder }}_lmwh" class="text-muted"></small>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="text" name="{{ $viewFolder }}[flushing]" id="{{ $viewFolder }}_flushing" value="" placeholder="">
                    <label for="{{ $viewFolder }}_flushing" class="form-label">NSS Flushing</label>
                    <small id="help_{{ $viewFolder }}_flushing" class="text-muted"></small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
        <div class="row">
          <div class="col-lg-{{ stristr($doctor->specialty, 'Ophtha') && (isset($datum->booking_type) && $datum->booking_type != 'Dialysis') ? 4 : (isset($datum->booking_type) && $datum->booking_type == 'Dialysis' ? 12 : 12) }}">
            <div class="card mb-3">
              <div class="card-header">{{ isset($datum->booking_type) && $datum->booking_type == 'Dialysis1' ? 'Pre-HD ' : '' }}Vitals</div>
              <div class="card-body">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="number" name="{{ $viewFolder }}[temp]" min=30 step=.1 id="{{ $viewFolder }}_temp" value="{{ isset($datum->temp) ? $datum->temp : ''}}" placeholder="" {{ isset($datum->id) ? '' : '' }}>
                    <label for="{{ $viewFolder }}_temp" class="form-label">Temperature</label>
                    <small id="help_{{ $viewFolder }}_temp" class="text-muted"></small>
                  </div>
                  <span class="input-group-text">C</span>
                </div>
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="number" name="{{ $viewFolder }}[height]" min=1 step=.1 id="{{ $viewFolder }}_height" value="{{ isset($datum->height) ? $datum->height : '' }}" placeholder="" {{ isset($datum->id) ? '' : '' }} onblur="
                        if($(this).val() != '' && $('#{{ $viewFolder }}_weight').val() != ''){
                          $('#{{ $viewFolder }}_bmi').val($('#{{ $viewFolder }}_weight').val()/(($(this).val()/100)*($(this).val()/100)));
                        }else{
                          $('#{{ $viewFolder }}_bmi').val('');
                        }
                      ">
                    <label for="{{ $viewFolder }}_height" class="form-label">Height</label>
                    <small id="help_{{ $viewFolder }}_height" class="text-muted"></small>
                  </div>
                  <span class="input-group-text">cm</span>
                </div>
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="number" name="{{ $viewFolder }}[weight]" min=1 step=.1 id="{{ $viewFolder }}_weight" value="{{ isset($datum->weight) ? $datum->weight : '' }}" placeholder="" {{ isset($datum->id) ? '' : '' }} onblur="
                      if($(this).val() != '' && $('#{{ $viewFolder }}_height').val() != ''){
                        $('#{{ $viewFolder }}_bmi').val($(this).val()/(($('#{{ $viewFolder }}_height').val()/100)*($('#{{ $viewFolder }}_height').val()/100)));
                      }else{
                        $('#{{ $viewFolder }}_bmi').val('');
                      }
                    ">
                    <label for="{{ $viewFolder }}_weight" class="form-label">(Pre HD)/Weight</label>
                    <small id="help_{{ $viewFolder }}_weight" class="text-muted"></small>
                  </div>
                  <span class="input-group-text">kg</span>
                </div>
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="number" name="{{ $viewFolder }}[post_weight]" min=1 step=.1 id="{{ $viewFolder }}_post_weight" value="{{ isset($datum->post_weight) ? $datum->post_weight : '' }}" placeholder="" {{ isset($datum->booking_type) && $datum->booking_type != 'Dialysis' ? 'disabled' : ''}}>
                    <label for="{{ $viewFolder }}_post_weight" class="form-label">(Post HD)/Weight</label>
                    <small id="help_{{ $viewFolder }}_post_weight" class="text-muted"></small>
                  </div>
                  <span class="input-group-text">kg</span>
                </div>
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="number" name="{{ $viewFolder }}[bmi]" min=1 id="{{ $viewFolder }}_bmi" value="{{ !empty($datum->height) ? (int)$datum->weight/(((int)$datum->height/100)*((int)$datum->height/100)) : '' }}" placeholder="" disabled>
                    <label for="{{ $viewFolder }}_bmi" class="form-label">BMI</label>
                    <small id="help_{{ $viewFolder }}_bmi" class="text-muted"></small>
                  </div>
                </div>
                <label for="{{ $viewFolder }}_bpS" class="form-label">BP</label>
                <div class="input-group mb-3">
                  <input class="form-control" type="number" name="{{ $viewFolder }}[bpS]" min=50 max=250 step=1 id="{{ $viewFolder }}_bpS" value="{{ isset($datum->bpS) ? $datum->bpS : '' }}" placeholder="Systolic" {{ isset($datum->id) ? '' : '' }}>
                  <span class="input-group-text">/</span>
                  <input class="form-control" type="number" name="{{ $viewFolder }}[bpD]" min=30 max=150 step=1 id="{{ $viewFolder }}_bpD" value="{{ isset($datum->bpD) ? $datum->bpD : '' }}" placeholder="Diastolic" {{ isset($datum->id) ? '' : '' }}>
                </div>
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="number" name="{{ $viewFolder }}[o2]" min=1 id="{{ $viewFolder }}_o2" value="{{ isset($datum->o2) ? $datum->o2 : '' }}" placeholder="" {{ isset($datum->id) ? '' : '' }}>
                    <label for="{{ $viewFolder }}_o2" class="form-label">O2 Sat</label>
                    <small id="help_{{ $viewFolder }}_o2" class="text-muted"></small>
                  </div>
                  <span class="input-group-text">%</span>
                </div>
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="number" name="{{ $viewFolder }}[heart]" min=1 id="{{ $viewFolder }}_heart" value="{{ isset($datum->heart) ? $datum->heart : '' }}" placeholder="" {{ isset($datum->id) ? '' : '' }}>
                    <label for="{{ $viewFolder }}_heart" class="form-label">Heart/Pulse Rate</label>
                    <small id="help_{{ $viewFolder }}_heart" class="text-muted"></small>
                  </div>
                  <span class="input-group-text">BPM</span>
                </div>
              </div>
            </div>
          </div>
          @if(isset($datum->booking_type) && $datum->booking_type == 'Dialysis1')
          <div class="col-lg-6">
            <div class="card mb-3">
              <div class="card-header">Post-HD Vitals</div>
              <div class="card-body">
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="number" name="{{ $viewFolder }}[temp]" min=30 step=.1 id="{{ $viewFolder }}_temp" value="{{ isset($datum->temp) ? $datum->temp : ''}}" placeholder="" {{ isset($datum->id) ? '' : '' }}>
                    <label for="{{ $viewFolder }}_temp" class="form-label">Temperature</label>
                    <small id="help_{{ $viewFolder }}_temp" class="text-muted"></small>
                  </div>
                  <span class="input-group-text">C</span>
                </div>
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="number" name="{{ $viewFolder }}[height]" min=1 step=.1 id="{{ $viewFolder }}_height" value="{{ isset($datum->height) ? $datum->height : '' }}" placeholder="" {{ isset($datum->id) ? '' : '' }} onblur="
                        if($(this).val() != '' && $('#{{ $viewFolder }}_weight').val() != ''){
                          $('#{{ $viewFolder }}_bmi').val($('#{{ $viewFolder }}_weight').val()/(($(this).val()/100)*($(this).val()/100)));
                        }else{
                          $('#{{ $viewFolder }}_bmi').val('');
                        }
                      ">
                    <label for="{{ $viewFolder }}_height" class="form-label">Height</label>
                    <small id="help_{{ $viewFolder }}_height" class="text-muted"></small>
                  </div>
                  <span class="input-group-text">cm</span>
                </div>
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="number" name="{{ $viewFolder }}[weight]" min=1 step=.1 id="{{ $viewFolder }}_weight" value="{{ isset($datum->weight) ? $datum->weight : '' }}" placeholder="" {{ isset($datum->id) ? '' : '' }} onblur="
                      if($(this).val() != '' && $('#{{ $viewFolder }}_height').val() != ''){
                        $('#{{ $viewFolder }}_bmi').val($(this).val()/(($('#{{ $viewFolder }}_height').val()/100)*($('#{{ $viewFolder }}_height').val()/100)));
                      }else{
                        $('#{{ $viewFolder }}_bmi').val('');
                      }
                    ">
                    <label for="{{ $viewFolder }}_weight" class="form-label">Weight</label>
                    <small id="help_{{ $viewFolder }}_weight" class="text-muted"></small>
                  </div>
                  <span class="input-group-text">kg</span>
                </div>
                {{-- <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="number" name="{{ $viewFolder }}[post_weight]" min=1 step=.1 id="{{ $viewFolder }}_post_weight" value="{{ isset($datum->post_weight) ? $datum->post_weight : '' }}" placeholder="" {{ isset($datum->booking_type) && $datum->booking_type != 'Dialysis' ? 'disabled' : ''}}>
                    <label for="{{ $viewFolder }}_post_weight" class="form-label">(Post HD)/Weight</label>
                    <small id="help_{{ $viewFolder }}_post_weight" class="text-muted"></small>
                  </div>
                  <span class="input-group-text">kg</span>
                </div> --}}
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="number" name="{{ $viewFolder }}[bmi]" min=1 id="{{ $viewFolder }}_bmi" value="{{ !empty($datum->height) ? (int)$datum->weight/(((int)$datum->height/100)*((int)$datum->height/100)) : '' }}" placeholder="" disabled>
                    <label for="{{ $viewFolder }}_bmi" class="form-label">BMI</label>
                    <small id="help_{{ $viewFolder }}_bmi" class="text-muted"></small>
                  </div>
                </div>
                <label for="{{ $viewFolder }}_bpS" class="form-label">BP</label>
                <div class="input-group mb-3">
                  <input class="form-control" type="number" name="{{ $viewFolder }}[bpS]" min=50 max=250 step=1 id="{{ $viewFolder }}_bpS" value="{{ isset($datum->bpS) ? $datum->bpS : '' }}" placeholder="Systolic" {{ isset($datum->id) ? '' : '' }}>
                  <span class="input-group-text">/</span>
                  <input class="form-control" type="number" name="{{ $viewFolder }}[bpD]" min=30 max=150 step=1 id="{{ $viewFolder }}_bpD" value="{{ isset($datum->bpD) ? $datum->bpD : '' }}" placeholder="Diastolic" {{ isset($datum->id) ? '' : '' }}>
                </div>
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="number" name="{{ $viewFolder }}[o2]" min=1 id="{{ $viewFolder }}_o2" value="{{ isset($datum->o2) ? $datum->o2 : '' }}" placeholder="" {{ isset($datum->id) ? '' : '' }}>
                    <label for="{{ $viewFolder }}_o2" class="form-label">O2 Sat</label>
                    <small id="help_{{ $viewFolder }}_o2" class="text-muted"></small>
                  </div>
                  <span class="input-group-text">%</span>
                </div>
                <div class="input-group mb-3">
                  <div class="form-floating">
                    <input class="form-control" type="number" name="{{ $viewFolder }}[heart]" min=1 id="{{ $viewFolder }}_heart" value="{{ isset($datum->heart) ? $datum->heart : '' }}" placeholder="" {{ isset($datum->id) ? '' : '' }}>
                    <label for="{{ $viewFolder }}_heart" class="form-label">Heart/Pulse Rate</label>
                    <small id="help_{{ $viewFolder }}_heart" class="text-muted"></small>
                  </div>
                  <span class="input-group-text">BPM</span>
                </div>
              </div>
            </div>
          </div>
          @endif
          @if(stristr($doctor->specialty, 'Ophtha') && (isset($datum->booking_type) && $datum->booking_type != 'Dialysis'))
          <div class="col-lg-8">
            <div class="card mb-3">
              <div class="card-header">Eye Examination Information</div>
              <div class="card-body">
                <label for="{{ $viewFolder }}_arod_sphere">AR OD</label>
                <div class="input-group mb-3 flex-nowrap">
                  <select class="form-select" name="{{ $viewFolder }}[arod_sphere]" size="1" id="{{ $viewFolder }}_arod_sphere" placeholder="" onchange="
                      if($(this).val() == 'No Target'){
                        $('#{{ $viewFolder }}_arod_cylinder').prop('disabled', true);
                        $('#{{ $viewFolder }}_arod_axis').prop('disabled', true);
                      }else{
                        $('#{{ $viewFolder }}_arod_cylinder').prop('disabled', false);
                        $('#{{ $viewFolder }}_arod_axis').prop('disabled', false);
                      }
                    ">
                    <option value="" {{ isset($datum->id) && $datum->arod_sphere == '' ? 'selected' : ''  }}>-</option>
                    @for($i = -20; $i<=20; $i+=.25)
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->arod_sphere == $i ? 'selected' : ''  }}>{{ ( $i>0 ? '+' : '') . number_format($i, 2) }}</option>
                    @endfor
                    <option value="No Target" {{ isset($datum->id) && $datum->arod_sphere == 'No Target' ? 'selected' : ''  }}>No Refraction Possible</option>
                  </select>
                  <span class="input-group-text">-</span>
                  <select class="form-select" name="{{ $viewFolder }}[arod_cylinder]" id="{{ $viewFolder }}_arod_cylinder" placeholder=""  {{ isset($datum->id) && $datum->arod_sphere == 'No Target' ? 'disabled' : ''  }}>
                    <option value="" {{ isset($datum->id) && $datum->arod_cylinder == null ? 'selected' : ''  }}>-</option>
                    @for($i = -15; $i<=15; $i+=.25)
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->arod_cylinder == $i ? 'selected' : ''  }}>{{ ( $i>0 ? '+' : '') . number_format($i, 2) }}</option>
                    @endfor
                  </select>
                  <span class="input-group-text">x</span>
                  <select class="form-select" name="{{ $viewFolder }}[arod_axis]" id="{{ $viewFolder }}_arod_axis" placeholder="" {{ isset($datum->id) && $datum->arod_sphere == 'No Target' ? 'disabled' : ''  }}>
                    <option value="" {{ isset($datum->id) && $datum->arod_axis == '' ? 'selected' : ''  }}>-</option>
                    @for($i = 0; $i<=180; $i++)
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->arod_axis == $i ? 'selected' : ''  }}>{{ $i }}</option>
                    @endfor
                  </select>
                </div>
                <label for="{{ $viewFolder }}_aros_sphere">AR OS</label>
                <div class="input-group mb-3 flex-nowrap">
                  <select class="form-select" name="{{ $viewFolder }}[aros_sphere]" id="{{ $viewFolder }}_aros_sphere" placeholder="" onchange="
                    if($(this).val() == 'No Target'){
                      $('#{{ $viewFolder }}_aros_cylinder').prop('disabled', true);
                      $('#{{ $viewFolder }}_aros_axis').prop('disabled', true);
                    }else{
                      $('#{{ $viewFolder }}_aros_cylinder').prop('disabled', false);
                      $('#{{ $viewFolder }}_aros_axis').prop('disabled', false);
                    }
                  ">
                    <option value="" {{ isset($datum->id) && $datum->aros_sphere == '' ? 'selected' : '' }}>-</option>
                    @for($i = -20; $i<=20; $i+=.25)
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->aros_sphere == $i ? 'selected' : '' }}>{{ ( $i>0 ? '+' : '') . number_format($i, 2) }}</option>
                    @endfor
                    <option value="No Target" {{ isset($datum->id) && $datum->aros_sphere == 'No Target' ? 'selected' : '' }}>No Refraction Possible</option>
                  </select>
                  <span class="input-group-text">-</span>
                  <select class="form-select" name="{{ $viewFolder }}[aros_cylinder]" id="{{ $viewFolder }}_aros_cylinder" placeholder=""  {{ isset($datum->id) && $datum->aros_sphere == 'No Target' ? 'disabled' : '' }}>
                    <option value=""  {{ isset($datum->id) && $datum->aros_cylinder == '' ? 'selected' : '' }}>-</option>
                    @for($i = -15; $i<=15; $i+=.25)
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->aros_cylinder == $i ? 'selected' : '' }}>{{ ( $i>0 ? '+' : '') . number_format($i, 2) }}</option>
                    @endfor
                  </select>
                  <span class="input-group-text">x</span>
                  <select class="form-select" name="{{ $viewFolder }}[aros_axis]" id="{{ $viewFolder }}_aros_axis" placeholder="" {{ isset($datum->id) && $datum->aros_sphere == 'No Target' ? 'disabled' : '' }}>
                    <option value="" {{ isset($datum->id) && $datum->aros_axis == '' ? 'selected' : '' }}>-</option>
                    @for($i = 0; $i<=180; $i++)
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->aros_axis == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                  </select>
                </div>
                <label for="{{ $viewFolder }}_vaod_num">UCVA OD</label>
                <div class="input-group mb-3 flex-nowrap">
                  <select class="form-select" name="{{ $viewFolder }}[vaod_num]" id="{{ $viewFolder }}_vaod_num" placeholder="" onchange="
                    if($(this).val() == 'CF' || $(this).val() == 'HM' || $(this).val() == 'GLP' || $(this).val() == 'PLP' || $(this).val() == 'NLP' || $(this).val() == 'NA'){
                      $('#{{ $viewFolder }}_vaod_den').prop('disabled', true);
                    }else{
                      $('#{{ $viewFolder }}_vaod_den').prop('disabled', false);
                    }
                  ">
                    <option value="" {{ isset($datum->id) && $datum->vaod_num == '' ? 'selected' : '' }}>-</option>
                    @for($i = 5; $i<=20; $i++)
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->vaod_num == $i ? 'selected' : '' }}>{{ number_format($i, 0) }}</option>
                    @endfor
                    <option value="CF" {{ isset($datum->id) && $datum->vaod_num == 'CF' ? 'selected' : '' }}>CF</option>
                    <option value="HM" {{ isset($datum->id) && $datum->vaod_num == 'HM' ? 'selected' : '' }}>HM</option>
                    <option value="GLP" {{ isset($datum->id) && $datum->vaod_num == 'GLP' ? 'selected' : '' }}>GLP</option>
                    <option value="PLP" {{ isset($datum->id) && $datum->vaod_num == 'PLP' ? 'selected' : '' }}>PLP</option>
                    <option value="NLP" {{ isset($datum->id) && $datum->vaod_num == 'NLP' ? 'selected' : '' }}>NLP</option>
                    <option value="NA" {{ isset($datum->id) && $datum->vaod_num == 'NA' ? 'selected' : '' }}>NA</option>
                  </select>
                  <span class="input-group-text">/</span>
                  <select class="form-select" name="{{ $viewFolder }}[vaod_den]" id="{{ $viewFolder }}_vaod_den" placeholder="" {{ isset($datum->id) && ($datum->vaod_num == 'CF' || $datum->vaod_num == 'HM' || $datum->vaod_num == 'GLP' || $datum->vaod_num == 'PLP' || $datum->vaod_num == 'NLP' || $datum->vaod_num == 'NA') ? 'disabled' : '' }}>
                    <option value="" {{ isset($datum->id) && $datum->vaod_den == '' ? 'selected' : '' }}>-</option>
                    @php
                      $limit = 30;
                      $incr = 5;
                    @endphp
                    @for($i = 15; $i<=$limit; $i+=$incr)
                    @php
                      if($i == 30){
                        $limit = 80;
                        $incr = 10;
                      }elseif($i == 80){
                        $limit = 100;
                        $incr = 20;
                      }elseif($i == 100){
                        $limit = 200;
                        $incr = 50;
                      }elseif($i == 200){
                        $limit = 400;
                        $incr = 200;
                      }
                    @endphp
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->vaod_den == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                  </select>
                </div>
                <label for="{{ $viewFolder }}_vaodcor_num">UCVA OD Present Correction</label>
                <div class="input-group mb-3 flex-nowrap">
                  <select class="form-select" name="{{ $viewFolder }}[vaodcor_num]" id="{{ $viewFolder }}_vaodcor_num" placeholder="" onchange="
                    if($(this).val() == 'CF' || $(this).val() == 'HM' || $(this).val() == 'GLP' || $(this).val() == 'PLP' || $(this).val() == 'NLP' || $(this).val() == 'NA'){
                      $('#{{ $viewFolder }}_vaodcor_den').prop('disabled', true);
                    }else{
                      $('#{{ $viewFolder }}_vaodcor_den').prop('disabled', false);
                    }
                  ">
                    <option value="" {{ isset($datum->id) && $datum->vaodcor_num == '' ? 'selected' : '' }}>-</option>
                    @for($i = 5; $i<=20; $i++)
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->vaodcor_num == $i ? 'selected' : '' }}>{{ number_format($i, 0) }}</option>
                    @endfor
                    <option value="CF" {{ isset($datum->id) && $datum->vaodcor_num == 'CF' ? 'selected' : '' }}>CF</option>
                    <option value="HM" {{ isset($datum->id) && $datum->vaodcor_num == 'HM' ? 'selected' : '' }}>HM</option>
                    <option value="GLP" {{ isset($datum->id) && $datum->vaodcor_num == 'GLP' ? 'selected' : '' }}>GLP</option>
                    <option value="PLP" {{ isset($datum->id) && $datum->vaodcor_num == 'PLP' ? 'selected' : '' }}>PLP</option>
                    <option value="NLP" {{ isset($datum->id) && $datum->vaodcor_num == 'NLP' ? 'selected' : '' }}>NLP</option>
                    <option value="NA" {{ isset($datum->id) && $datum->vaodcor_num == 'NA' ? 'selected' : '' }}>NA</option>
                  </select>
                  <span class="input-group-text">/</span>
                  <select class="form-select" name="{{ $viewFolder }}[vaodcor_den]" id="{{ $viewFolder }}_vaodcor_den" placeholder="" {{ isset($datum->id) && ($datum->vaodcor_num == 'CF' || $datum->vaodcor_num == 'HM' || $datum->vaodcor_num == 'GLP' || $datum->vaodcor_num == 'PLP' || $datum->vaodcor_num == 'NLP' || $datum->vaodcor_num == 'NA') ? 'disabled' : '' }}>
                    <option value="" {{ isset($datum->id) && $datum->vaodcor_den == '' ? 'selected' : '' }}>-</option>
                    @php
                      $limit = 30;
                      $incr = 5;
                    @endphp
                    @for($i = 15; $i<=$limit; $i+=$incr)
                    @php
                      if($i == 30){
                        $limit = 80;
                        $incr = 10;
                      }elseif($i == 80){
                        $limit = 100;
                        $incr = 20;
                      }elseif($i == 100){
                        $limit = 200;
                        $incr = 50;
                      }elseif($i == 200){
                        $limit = 400;
                        $incr = 200;
                      }
                    @endphp
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->vaodcor_den == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                  </select>
                </div>
                <label for="{{ $viewFolder }}_vaos_num">UCVA OS</label>
                <div class="input-group mb-3 flex-nowrap">
                  <select class="form-select" name="{{ $viewFolder }}[vaos_num]" id="{{ $viewFolder }}_vaos_num" placeholder="" onchange="
                    if($(this).val() == 'CF' || $(this).val() == 'HM' || $(this).val() == 'GLP' || $(this).val() == 'PLP' || $(this).val() == 'NLP' || $(this).val() == 'NA'){
                      $('#{{ $viewFolder }}_vaos_den').prop('disabled', true);
                    }else{
                      $('#{{ $viewFolder }}_vaos_den').prop('disabled', false);
                    }
                  ">
                    <option value="" {{ isset($datum->id) && $datum->vaos_num == '' ? 'selected' : '' }}>-</option>
                    @for($i = 5; $i<=20; $i++)
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->vaos_num == $i ? 'selected' : '' }}>{{ number_format($i, 0) }}</option>
                    @endfor
                    <option value="CF" {{ isset($datum->id) && $datum->vaos_num == 'CF' ? 'selected' : '' }}>CF</option>
                    <option value="HM" {{ isset($datum->id) && $datum->vaos_num == 'HM' ? 'selected' : '' }}>HM</option>
                    <option value="GLP" {{ isset($datum->id) && $datum->vaos_num == 'GLP' ? 'selected' : '' }}>GLP</option>
                    <option value="PLP" {{ isset($datum->id) && $datum->vaos_num == 'PLP' ? 'selected' : '' }}>PLP</option>
                    <option value="NLP" {{ isset($datum->id) && $datum->vaos_num == 'NLP' ? 'selected' : '' }}>NLP</option>
                    <option value="NA" {{ isset($datum->id) && $datum->vaos_num == 'NA' ? 'selected' : '' }}>NA</option>
                  </select>
                  <span class="input-group-text">/</span>
                  <select class="form-select" name="{{ $viewFolder }}[vaos_den]" id="{{ $viewFolder }}_vaos_den" placeholder=""  {{ isset($datum->id) && ($datum->vaos_num == 'CF' || $datum->vaos_num == 'HM' || $datum->vaos_num == 'GLP' || $datum->vaos_num == 'PLP' || $datum->vaos_num == 'NLP' || $datum->vaos_num == 'NA') ? 'disabled' : '' }}>
                    <option value="" {{ isset($datum->id) && $datum->vaos_den == '' ? 'selected' : '' }}>-</option>
                    @php
                      $limit = 30;
                      $incr = 5;
                    @endphp
                    @for($i = 15; $i<=$limit; $i+=$incr)
                    @php
                      if($i == 30){
                        $limit = 80;
                        $incr = 10;
                      }elseif($i == 80){
                        $limit = 100;
                        $incr = 20;
                      }elseif($i == 100){
                        $limit = 200;
                        $incr = 50;
                      }elseif($i == 200){
                        $limit = 400;
                        $incr = 200;
                      }
                    @endphp
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->vaos_den == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                  </select>
                </div>
                <label for="{{ $viewFolder }}_vaoscor_num">UCVA OS Present Correction</label>
                <div class="input-group mb-3 flex-nowrap">
                  <select class="form-select" name="{{ $viewFolder }}[vaoscor_num]" id="{{ $viewFolder }}_vaoscor_num" placeholder="" onchange="
                    if($(this).val() == 'CF' || $(this).val() == 'HM' || $(this).val() == 'GLP' || $(this).val() == 'PLP' || $(this).val() == 'NLP' || $(this).val() == 'NA'){
                      $('#{{ $viewFolder }}_vaoscor_den').prop('disabled', true);
                    }else{
                      $('#{{ $viewFolder }}_vaoscor_den').prop('disabled', false);
                    }
                  ">
                    <option value="" {{ isset($datum->id) && $datum->vaoscor_num == '' ? 'selected' : '' }}>-</option>
                    @for($i = 5; $i<=20; $i++)
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->vaoscor_num == $i ? 'selected' : '' }}>{{ number_format($i, 0) }}</option>
                    @endfor
                    <option value="CF" {{ isset($datum->id) && $datum->vaoscor_num == 'CF' ? 'selected' : '' }}>CF</option>
                    <option value="HM" {{ isset($datum->id) && $datum->vaoscor_num == 'HM' ? 'selected' : '' }}>HM</option>
                    <option value="GLP" {{ isset($datum->id) && $datum->vaoscor_num == 'GLP' ? 'selected' : '' }}>GLP</option>
                    <option value="PLP" {{ isset($datum->id) && $datum->vaoscor_num == 'PLP' ? 'selected' : '' }}>PLP</option>
                    <option value="NLP" {{ isset($datum->id) && $datum->vaoscor_num == 'NLP' ? 'selected' : '' }}>NLP</option>
                    <option value="NA" {{ isset($datum->id) && $datum->vaoscor_num == 'NA' ? 'selected' : '' }}>NA</option>
                  </select>
                  <span class="input-group-text">/</span>
                  <select class="form-select" name="{{ $viewFolder }}[vaoscor_den]" id="{{ $viewFolder }}_vaoscor_den" placeholder="" {{ isset($datum->id) && ($datum->vaoscor_num == 'CF' || $datum->vaoscor_num == 'HM' || $datum->vaoscor_num == 'GLP' || $datum->vaoscor_num == 'PLP' || $datum->vaoscor_num == 'NLP' || $datum->vaoscor_num == 'NA') ? 'disabled' : '' }}>
                    <option value="" {{ isset($datum->id) && $datum->vaoscor_den == '' ? 'selected' : '' }}>-</option>
                    @php
                      $limit = 30;
                      $incr = 5;
                    @endphp
                    @for($i = 15; $i<=$limit; $i+=$incr)
                    @php
                      if($i == 30){
                        $limit = 80;
                        $incr = 10;
                      }elseif($i == 80){
                        $limit = 100;
                        $incr = 20;
                      }elseif($i == 100){
                        $limit = 200;
                        $incr = 50;
                      }elseif($i == 200){
                        $limit = 400;
                        $incr = 200;
                      }
                    @endphp
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->vaoscor_den == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                  </select>
                </div>
                <label for="{{ $viewFolder }}_pinod_num">VA OD Pinhole</label>
                <div class="input-group mb-3 flex-nowrap">
                  <select class="form-select" name="{{ $viewFolder }}[pinod_num]" id="{{ $viewFolder }}_pinod_num" placeholder="" onchange="
                    if($(this).val() == 'CF' || $(this).val() == 'HM' || $(this).val() == 'GLP' || $(this).val() == 'PLP' || $(this).val() == 'NLP' || $(this).val() == 'NA'){
                      $('#{{ $viewFolder }}_pinod_den').prop('disabled', true);
                    }else{
                      $('#{{ $viewFolder }}_pinod_den').prop('disabled', false);
                    }
                  ">
                    <option value="" {{ isset($datum->id) && $datum->pinod_num == '' ? 'selected' : '' }}>-</option>
                    @for($i = 5; $i<=20; $i++)
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->pinod_num == $i ? 'selected' : '' }}>{{ number_format($i, 0) }}</option>
                    @endfor
                    <option value="CF" {{ isset($datum->id) && $datum->pinod_num == 'CF' ? 'selected' : '' }}>CF</option>
                    <option value="HM" {{ isset($datum->id) && $datum->pinod_num == 'HM' ? 'selected' : '' }}>HM</option>
                    <option value="GLP" {{ isset($datum->id) && $datum->pinod_num == 'GLP' ? 'selected' : '' }}>GLP</option>
                    <option value="PLP" {{ isset($datum->id) && $datum->pinod_num == 'PLP' ? 'selected' : '' }}>PLP</option>
                    <option value="NLP" {{ isset($datum->id) && $datum->pinod_num == 'NLP' ? 'selected' : '' }}>NLP</option>
                    <option value="NA" {{ isset($datum->id) && $datum->pinod_num == 'NA' ? 'selected' : '' }}>NA</option>
                    {{-- <option value="NIWPH">NIWPH</option>
                    <option value="NA">NA</option> --}}
                  </select>
                  <span class="input-group-text">/</span>
                  <select class="form-select" name="{{ $viewFolder }}[pinod_den]" id="{{ $viewFolder }}_pinod_den" placeholder="" {{ isset($datum->id) && ($datum->pinod_num == 'CF' || $datum->pinod_num == 'HM' || $datum->pinod_num == 'GLP' || $datum->pinod_num == 'PLP' || $datum->pinod_num == 'NLP' || $datum->pinod_num == 'NA') ? 'disabled' : '' }}>
                    <option value="" {{ isset($datum->id) && $datum->pinod_den == '' ? 'selected' : '' }}>-</option>
                    @php
                      $limit = 30;
                      $incr = 5;
                    @endphp
                    @for($i = 15; $i<=$limit; $i+=$incr)
                    @php
                      if($i == 30){
                        $limit = 80;
                        $incr = 10;
                      }elseif($i == 80){
                        $limit = 100;
                        $incr = 20;
                      }elseif($i == 100){
                        $limit = 200;
                        $incr = 50;
                      }elseif($i == 200){
                        $limit = 400;
                        $incr = 200;
                      }
                    @endphp
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->pinod_den == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                  </select>
                </div>
                <label for="{{ $viewFolder }}_pinodcor_num">BCVA OD</label>
                <div class="input-group mb-3 flex-nowrap">
                  <select class="form-select" name="{{ $viewFolder }}[pinodcor_num]" id="{{ $viewFolder }}_pinodcor_num" placeholder="" onchange="
                    if($(this).val() == 'CF' || $(this).val() == 'HM' || $(this).val() == 'GLP' || $(this).val() == 'PLP' || $(this).val() == 'NLP' || $(this).val() == 'NA'){
                      $('#{{ $viewFolder }}_pinodcor_den').prop('disabled', true);
                    }else{
                      $('#{{ $viewFolder }}_pinodcor_den').prop('disabled', false);
                    }
                  ">
                    <option value="" {{ isset($datum->id) && $datum->pinodcor_num == '' ? 'selected' : '' }}>-</option>
                    @for($i = 5; $i<=20; $i++)
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->pinodcor_num == $i ? 'selected' : '' }}>{{ number_format($i, 0) }}</option>
                    @endfor
                    <option value="CF" {{ isset($datum->id) && $datum->pinodcor_num == 'CF' ? 'selected' : '' }}>CF</option>
                    <option value="HM" {{ isset($datum->id) && $datum->pinodcor_num == 'HM' ? 'selected' : '' }}>HM</option>
                    <option value="GLP" {{ isset($datum->id) && $datum->pinodcor_num == 'GLP' ? 'selected' : '' }}>GLP</option>
                    <option value="PLP" {{ isset($datum->id) && $datum->pinodcor_num == 'PLP' ? 'selected' : '' }}>PLP</option>
                    <option value="NLP" {{ isset($datum->id) && $datum->pinodcor_num == 'NLP' ? 'selected' : '' }}>NLP</option>
                    <option value="NA" {{ isset($datum->id) && $datum->pinodcor_num == 'NA' ? 'selected' : '' }}>NA</option>
                    {{-- <option value="NIWPH">NIWPH</option>
                    <option value="NA">NA</option> --}}
                  </select>
                  <span class="input-group-text">/</span>
                  <select class="form-select" name="{{ $viewFolder }}[pinodcor_den]" id="{{ $viewFolder }}_pinodcor_den" placeholder="" {{ isset($datum->id) && ($datum->pinodcor_num == 'CF' || $datum->pinodcor_num == 'HM' || $datum->pinodcor_num == 'GLP' || $datum->pinodcor_num == 'PLP' || $datum->pinodcor_num == 'NLP' || $datum->pinodcor_num == 'NA') ? 'disabled' : '' }}>
                    <option value="" {{ isset($datum->id) && $datum->pinodcor_den == '' ? 'selected' : '' }}>-</option>
                    @php
                      $limit = 30;
                      $incr = 5;
                    @endphp
                    @for($i = 15; $i<=$limit; $i+=$incr)
                    @php
                      if($i == 30){
                        $limit = 80;
                        $incr = 10;
                      }elseif($i == 80){
                        $limit = 100;
                        $incr = 20;
                      }elseif($i == 100){
                        $limit = 200;
                        $incr = 50;
                      }elseif($i == 200){
                        $limit = 400;
                        $incr = 200;
                      }
                    @endphp
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->pinodcor_den == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                  </select>
                </div>
                <label for="{{ $viewFolder }}_pinos_num">VA OS Pinhole</label>
                <div class="input-group mb-3 flex-nowrap">
                  <select class="form-select" name="{{ $viewFolder }}[pinos_num]" id="{{ $viewFolder }}_pinos_num" placeholder="" onchange="
                    if($(this).val() == 'CF' || $(this).val() == 'HM' || $(this).val() == 'GLP' || $(this).val() == 'PLP' || $(this).val() == 'NLP' || $(this).val() == 'NA'){
                      $('#{{ $viewFolder }}_pinos_den').prop('disabled', true);
                    }else{
                      $('#{{ $viewFolder }}_pinos_den').prop('disabled', false);
                    }
                  ">
                    <option value="" {{ isset($datum->id) && $datum->pinos_num == '' ? 'selected' : '' }}>-</option>
                    @for($i = 5; $i<=20; $i++)
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->pinos_num == $i ? 'selected' : '' }}>{{ number_format($i, 0) }}</option>
                    @endfor
                    <option value="CF" {{ isset($datum->id) && $datum->pinos_num == 'CF' ? 'selected' : '' }}>CF</option>
                    <option value="HM" {{ isset($datum->id) && $datum->pinos_num == 'HM' ? 'selected' : '' }}>HM</option>
                    <option value="GLP" {{ isset($datum->id) && $datum->pinos_num == 'GLP' ? 'selected' : '' }}>GLP</option>
                    <option value="PLP" {{ isset($datum->id) && $datum->pinos_num == 'PLP' ? 'selected' : '' }}>PLP</option>
                    <option value="NLP" {{ isset($datum->id) && $datum->pinos_num == 'NLP' ? 'selected' : '' }}>NLP</option>
                    <option value="NA" {{ isset($datum->id) && $datum->pinos_num == 'NA' ? 'selected' : '' }}>NA</option>
                    {{-- <option value="NIWPH">NIWPH</option>
                    <option value="NA">NA</option> --}}
                  </select>
                  <span class="input-group-text">/</span>
                  <select class="form-select" name="{{ $viewFolder }}[pinos_den]" id="{{ $viewFolder }}_pinos_den" placeholder="" {{ isset($datum->id) && ($datum->pinos_num == 'CF' || $datum->pinos_num == 'HM' || $datum->pinos_num == 'GLP' || $datum->pinos_num == 'PLP' || $datum->pinos_num == 'NLP' || $datum->pinos_num == 'NA') ? 'disabled' : '' }}>
                    <option value="" {{ isset($datum->id) && $datum->pinos_den == '' ? 'selected' : '' }}>-</option>
                    @php
                      $limit = 30;
                      $incr = 5;
                    @endphp
                    @for($i = 15; $i<=$limit; $i+=$incr)
                    @php
                      if($i == 30){
                        $limit = 80;
                        $incr = 10;
                      }elseif($i == 80){
                        $limit = 100;
                        $incr = 20;
                      }elseif($i == 100){
                        $limit = 200;
                        $incr = 50;
                      }elseif($i == 200){
                        $limit = 400;
                        $incr = 200;
                      }
                    @endphp
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->pinos_den == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                  </select>
                </div>
                <label for="{{ $viewFolder }}_pinoscor_num">BCVA OS</label>
                <div class="input-group mb-3 flex-nowrap">
                  <select class="form-select" name="{{ $viewFolder }}[pinoscor_num]" id="{{ $viewFolder }}_pinoscor_num" placeholder="" onchange="
                    if($(this).val() == 'CF' || $(this).val() == 'HM' || $(this).val() == 'GLP' || $(this).val() == 'PLP' || $(this).val() == 'NLP' || $(this).val() == 'NA'){
                      $('#{{ $viewFolder }}_pinoscor_den').prop('disabled', true);
                    }else{
                      $('#{{ $viewFolder }}_pinoscor_den').prop('disabled', false);
                    }
                  ">
                    <option value="" {{ isset($datum->id) && $datum->pinoscor_num == '' ? 'selected' : '' }}>-</option>
                    @for($i = 5; $i<=20; $i++)
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->pinoscor_num == $i ? 'selected' : '' }}>{{ number_format($i, 0) }}</option>
                    @endfor
                    <option value="CF" {{ isset($datum->id) && $datum->pinoscor_num == 'CF' ? 'selected' : '' }}>CF</option>
                    <option value="HM" {{ isset($datum->id) && $datum->pinoscor_num == 'HM' ? 'selected' : '' }}>HM</option>
                    <option value="GLP" {{ isset($datum->id) && $datum->pinoscor_num == 'GLP' ? 'selected' : '' }}>GLP</option>
                    <option value="PLP" {{ isset($datum->id) && $datum->pinoscor_num == 'PLP' ? 'selected' : '' }}>PLP</option>
                    <option value="NLP" {{ isset($datum->id) && $datum->pinoscor_num == 'NLP' ? 'selected' : '' }}>NLP</option>
                    <option value="NA" {{ isset($datum->id) && $datum->pinoscor_num == 'NA' ? 'selected' : '' }}>NA</option>
                    {{-- <option value="NIWPH">NIWPH</option>
                    <option value="NA">NA</option> --}}
                  </select>
                  <span class="input-group-text">/</span>
                  <select class="form-select" name="{{ $viewFolder }}[pinoscor_den]" id="{{ $viewFolder }}_pinoscor_den" placeholder="" {{ isset($datum->id) &&  ($datum->pinoscor_num == 'CF' || $datum->pinoscor_num == 'HM' || $datum->pinoscor_num == 'GLP' || $datum->pinoscor_num == 'PLP' || $datum->pinoscor_num == 'NLP' || $datum->pinoscor_num == 'NA') ? 'disabled' : '' }}>
                    <option value="" {{ isset($datum->id) && $datum->pinoscor_den == '' ? 'selected' : '' }}>-</option>
                    @php
                      $limit = 30;
                      $incr = 5;
                    @endphp
                    @for($i = 15; $i<=$limit; $i+=$incr)
                    @php
                      if($i == 30){
                        $limit = 80;
                        $incr = 10;
                      }elseif($i == 80){
                        $limit = 100;
                        $incr = 20;
                      }elseif($i == 100){
                        $limit = 200;
                        $incr = 50;
                      }elseif($i == 200){
                        $limit = 400;
                        $incr = 200;
                      }
                    @endphp
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->pinoscor_den == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                  </select>
                </div>
                <label for="{{ $viewFolder }}_jae_ou">Jaeger OU</label>
                <div class="input-group mb-3 flex-nowrap">
                  <select class="form-select" name="{{ $viewFolder }}[jae_ou]" id="{{ $viewFolder }}_jae_ou" placeholder="">
                    <option value="" {{ isset($datum->id) && $datum->jae_ou == '' ? 'selected' : '' }}>-</option>
                    @for($i = 1; $i<=12; $i++)
                    <option value="J{{ $i }}" {{ isset($datum->id) && $datum->jae_ou == 'J' . $i ? 'selected' : '' }}>J{{ $i }}</option>
                    @endfor
                    <option value=">J12" {{ isset($datum->id) && $datum->jae_ou == '>J12' ? 'selected' : '' }}>J{{ $i }}>>J12</option>
                    <option value="NA" {{ isset($datum->id) && $datum->jae_ou == 'NA' ? 'selected' : '' }}>NA</option>
                  </select>
                </div>
                <label for="{{ $viewFolder }}_jae_od">Jaeger OD</label>
                <div class="input-group mb-3 flex-nowrap">
                  <select class="form-select" name="{{ $viewFolder }}[jae_od]" id="{{ $viewFolder }}_jae_od" placeholder="">
                    <option value="">-</option>
                    @for($i = 1; $i<=12; $i++)
                    <option value="J{{ $i }}" {{ isset($datum->id) && $datum->jae_od == 'J' . $i ? 'selected' : '' }}>J{{ $i }}</option>
                    @endfor
                    <option value=">J12" {{ isset($datum->id) && $datum->jae_od == '>J12' ? 'selected' : '' }}>>J12</option>
                    <option value="NA" {{ isset($datum->id) && $datum->jae_od == 'NA' ? 'selected' : '' }}>NA</option>
                  </select>
                </div>
                <label for="{{ $viewFolder }}_jae_os">Jaeger OS</label>
                <div class="input-group mb-3 flex-nowrap">
                  <select class="form-select" name="{{ $viewFolder }}[jae_os]" id="{{ $viewFolder }}_jae_os" placeholder="">
                    <option value="" {{ isset($datum->id) && $datum->jae_os == '' ? 'selected' : '' }}>-</option>
                    @for($i = 1; $i<=12; $i++)
                    <option value="J{{ $i }}" {{ isset($datum->id) && $datum->jae_os == 'J' . $i ? 'selected' : '' }}>J{{ $i }}</option>
                    @endfor
                    <option value=">J12" {{ isset($datum->id) && $datum->jae_os == '>J12'? 'selected' : '' }}>>J12</option>
                    <option value="NA" {{ isset($datum->id) && $datum->jae_os == 'NA'? 'selected' : '' }}>NA</option>
                  </select>
                </div>
                <label for="{{ $viewFolder }}_iopod">IOP OD</label>
                <div class="input-group mb-3 flex-nowrap">
                  <select class="form-select" name="{{ $viewFolder }}[iopod]" id="{{ $viewFolder }}_iopod" placeholder="">
                    <option value="" {{ isset($datum->id) && $datum->iopod == ''? 'selected' : '' }}>-</option>
                    <option value="<5" {{ isset($datum->id) && $datum->iopod == '<5' ? 'selected' : '' }}><5</option>
                    @for($i = 5; $i<=60; $i++)
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->iopod == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                    <option value=">60" {{ isset($datum->id) && $datum->iopod == '>60' ? 'selected' : '' }}>>60</option>
                  </select>
                  <span class="input-group-text">mmHG</span>
                </div>
                <label for="{{ $viewFolder }}_iopos">IOP OS</label>
                <div class="input-group mb-3 flex-nowrap">
                  <select class="form-select" name="{{ $viewFolder }}[iopos]" id="{{ $viewFolder }}_iopos" placeholder="">
                    <option value="" {{ isset($datum->id) && $datum->iopos == '' ? 'selected' : '' }}>-</option>
                    <option value="<5" {{ isset($datum->id) && $datum->iopos == '<5' ? 'selected' : '' }}><5</option>
                    @for($i = 5; $i<=60; $i++)
                    <option value="{{ $i }}" {{ isset($datum->id) && $datum->iopos == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                    <option value=">60" {{ isset($datum->id) && $datum->iopos == '>60' ? 'selected' : '' }}>>60</option>
                  </select>
                  <span class="input-group-text">mmHG</span>
                </div>
              </div>
            </div>
          </div>
          @endif
        </div>
        @if(isset($datum->booking_type) && $datum->booking_type == 'Dialysis1')
        <div class="row">
          <div class="col-lg-6">
            <div class="card mb-3">
              <div class="card-header">Pre-HD Assessment</div>
              <div class="card-body">
                <label>Mental Status</label>
                <div class="container ml-5 mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $viewFolder }}[mental_status]" value="awake" id="{{ $viewFolder }}_mental_status_awake">
                    <label class="form-check-label" for="{{ $viewFolder }}_mental_status_awake">awake</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $viewFolder }}[mental_status]" value="oriented" id="{{ $viewFolder }}_mental_status_oriented">
                    <label class="form-check-label" for="{{ $viewFolder }}_mental_status_oriented">oriented</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $viewFolder }}[mental_status]" value="drowsy" id="{{ $viewFolder }}_mental_status_drowsy">
                    <label class="form-check-label" for="{{ $viewFolder }}_mental_status_drowsy">drowsy</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $viewFolder }}[mental_status]" value="disoriented" id="{{ $viewFolder }}_mental_status_disoriented">
                    <label class="form-check-label" for="{{ $viewFolder }}_mental_status_disoriented">disoriented</label>
                  </div>
                </div>
                <label>Ambulation Status</label>
                <div class="container ml-5 mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $viewFolder }}[ambulation_status]" value="ambulatory" id="{{ $viewFolder }}_mental_status_ambulatory">
                    <label class="form-check-label" for="{{ $viewFolder }}_mental_status_ambulatory">ambulatory</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $viewFolder }}[ambulation_status]" value="w/ assistance" id="{{ $viewFolder }}_mental_status_assistance">
                    <label class="form-check-label" for="{{ $viewFolder }}_mental_status_assistance">w/ assistance</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $viewFolder }}[ambulation_status]" value="wheelchair" id="{{ $viewFolder }}_mental_status_wheelchair">
                    <label class="form-check-label" for="{{ $viewFolder }}_mental_status_wheelchair">wheelchair</label>
                  </div>
                </div>
                <label>Subjective Complaints</label>
                <div class="container ml-5 mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $viewFolder }}[subjective_complaints]" value="none" id="{{ $viewFolder }}_subjective_complaints_none" onchange="
                        if(!$(this).prop('checked')){
                          $('#{{ $viewFolder }}_subjective_complaints_text').prop('disabled', false);
                          $('#{{ $viewFolder }}_subjective_complaints_text').prop('required', true);
                        }else{
                          $('#{{ $viewFolder }}_subjective_complaints_text').prop('disabled', true);
                          $('#{{ $viewFolder }}_subjective_complaints_text').prop('required', false);
                          $('#{{ $viewFolder }}_subjective_complaints_text').val('');
                        }
                      ">
                    <label class="form-check-label" for="{{ $viewFolder }}_subjective_complaints_none">none</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $viewFolder }}[subjective_complaints]" value="yes" id="{{ $viewFolder }}_subjective_complaints_yes" onchange="
                        if($(this).prop('checked')){
                          $('#{{ $viewFolder }}_subjective_complaints_text').prop('disabled', false);
                          $('#{{ $viewFolder }}_subjective_complaints_text').prop('required', true);
                        }else{
                          $('#{{ $viewFolder }}_subjective_complaints_text').prop('disabled', true);
                          $('#{{ $viewFolder }}_subjective_complaints_text').prop('required', false);
                          $('#{{ $viewFolder }}_subjective_complaints_text').val('');
                        }
                      ">
                    <label class="form-check-label" for="{{ $viewFolder }}_subjective_complaints_yes">yes</label>
                  </div>
                  <textarea class="form-control" name="{{ $viewFolder }}[subjective_complaints_text]" id="{{ $viewFolder }}_subjective_complaints_text" rows=3 disabled></textarea>
                </div>
                <label>Significant PE Findings</label>
                <div class="container ml-5 mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Pallor" id="{{ $viewFolder }}_pe_findings_pallor">
                    <label class="form-check-label" for="{{ $viewFolder }}_pe_findings_pallor">Pallor</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Distended Neck Vein" id="{{ $viewFolder }}_pe_findings_neck_vein">
                    <label class="form-check-label" for="{{ $viewFolder }}_pe_findings_neck_vein">Distended Neck Vein</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Abnormal Rhythm/Rate" id="{{ $viewFolder }}_pe_findings_rhythm">
                    <label class="form-check-label" for="{{ $viewFolder }}_pe_findings_rhythm">Abnormal Rhythm/Rate</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Rales" id="{{ $viewFolder }}_pe_findings_rales">
                    <label class="form-check-label" for="{{ $viewFolder }}_pe_findings_rales">Rales</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Wheezing" id="{{ $viewFolder }}_pe_findings_wheezing">
                    <label class="form-check-label" for="{{ $viewFolder }}_pe_findings_wheezing">Wheezing</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Decreased Breath Sounds" id="{{ $viewFolder }}_pe_findings_breath_sounds">
                    <label class="form-check-label" for="{{ $viewFolder }}_pe_findings_breath_sounds">Decreased Breath Sounds</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Ascites - Abdominal Girth" id="{{ $viewFolder }}_pe_findings_ascites" onchange="
                        if($(this).prop('checked')){
                          $('#{{ $viewFolder }}_pe_findings_ascites_text').prop('disabled', false);
                          $('#{{ $viewFolder }}_pe_findings_ascites_text').prop('required', true);
                        }else{
                          $('#{{ $viewFolder }}_pe_findings_ascites_text').prop('disabled', true);
                          $('#{{ $viewFolder }}_pe_findings_ascites_text').prop('required', false);
                          $('#{{ $viewFolder }}_pe_findings_ascites_text').val('');
                        }
                      "
                    >
                    <label class="form-check-label" for="{{ $viewFolder }}_pe_findings_ascites">Ascites - Abdominal Girth:</label>
                  </div>
                  <textarea class="form-control" name="{{ $viewFolder }}[pe_findings_ascites_text]" id="{{ $viewFolder }}_pe_findings_ascites_text" rows=3 disabled></textarea>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Decreased Breath Sounds" id="{{ $viewFolder }}_pe_findings_breath_sounds">
                    <label class="form-check-label" for="{{ $viewFolder }}_pe_findings_breath_sounds">Decreased Breath Sounds</label>
                  </div>
                  
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Edema Grade" id="{{ $viewFolder }}_pe_findings_edema" onchange="
                        if($(this).prop('checked')){
                          $('#{{ $viewFolder }}_pe_findings_edema_text').prop('disabled', false);
                          $('#{{ $viewFolder }}_pe_findings_edema_text').prop('required', true);
                        }else{
                          $('#{{ $viewFolder }}_pe_findings_edema_text').prop('disabled', true);
                          $('#{{ $viewFolder }}_pe_findings_edema_text').prop('required', false);
                          $('#{{ $viewFolder }}_pe_findings_edema_text').val('');
                        }
                      "
                    >
                    <label class="form-check-label" for="{{ $viewFolder }}_pe_findings_edema">Edema Grade:</label>
                  </div>
                  <textarea class="form-control" name="{{ $viewFolder }}[pe_findings_edema_text]" id="{{ $viewFolder }}_pe_findings_edema_text" rows=3 disabled></textarea>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Bleeding" id="{{ $viewFolder }}_pe_findings_bleeding">
                    <label class="form-check-label" for="{{ $viewFolder }}_pe_findings_bleeding">Bleeding</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Others" id="{{ $viewFolder }}_pe_findings_others" onchange="
                        if($(this).prop('checked')){
                          $('#{{ $viewFolder }}_pe_findings_others_text').prop('disabled', false);
                          $('#{{ $viewFolder }}_pe_findings_others_text').prop('required', true);
                        }else{
                          $('#{{ $viewFolder }}_pe_findings_others_text').prop('disabled', true);
                          $('#{{ $viewFolder }}_pe_findings_others_text').prop('required', false);
                          $('#{{ $viewFolder }}_pe_findings_others_text').val('');
                        }
                      "
                    >
                    <label class="form-check-label" for="{{ $viewFolder }}_pe_findings_others">Others:</label>
                  </div>
                  <textarea class="form-control" name="{{ $viewFolder }}[pe_findings_others_text]" id="{{ $viewFolder }}_pe_findings_others_text" rows=3 disabled></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card mb-3">
              <div class="card-header">Post-HD Assessment</div>
              <div class="card-body">
                <label>Mental Status</label>
                <div class="container ml-5 mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $viewFolder }}[post_mental_status]" value="awake" id="{{ $viewFolder }}_post_mental_status_awake">
                    <label class="form-check-label" for="{{ $viewFolder }}_post_mental_status_awake">awake</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $viewFolder }}[post_mental_status]" value="oriented" id="{{ $viewFolder }}_post_mental_status_oriented">
                    <label class="form-check-label" for="{{ $viewFolder }}_post_mental_status_oriented">oriented</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $viewFolder }}[post_mental_status]" value="drowsy" id="{{ $viewFolder }}_post_mental_status_drowsy">
                    <label class="form-check-label" for="{{ $viewFolder }}_post_mental_status_drowsy">drowsy</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $viewFolder }}[post_mental_status]" value="disoriented" id="{{ $viewFolder }}_post_mental_status_disoriented">
                    <label class="form-check-label" for="{{ $viewFolder }}_post_mental_status_disoriented">disoriented</label>
                  </div>
                </div>
                <label>Ambulation Status</label>
                <div class="container ml-5 mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $viewFolder }}[post_ambulation_status]" value="ambulatory" id="{{ $viewFolder }}_post_mental_status_ambulatory">
                    <label class="form-check-label" for="{{ $viewFolder }}_post_mental_status_ambulatory">ambulatory</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $viewFolder }}[post_ambulation_status]" value="w/ assistance" id="{{ $viewFolder }}_post_mental_status_assistance">
                    <label class="form-check-label" for="{{ $viewFolder }}_post_mental_status_assistance">w/ assistance</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $viewFolder }}[post_ambulation_status]" value="wheelchair" id="{{ $viewFolder }}_post_mental_status_wheelchair">
                    <label class="form-check-label" for="{{ $viewFolder }}_post_mental_status_wheelchair">wheelchair</label>
                  </div>
                </div>
                <label>Subjective Complaints</label>
                <div class="container ml-5 mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $viewFolder }}[post_subjective_complaints]" value="none" id="{{ $viewFolder }}_post_subjective_complaints_none" onchange="
                        if(!$(this).prop('checked')){
                          $('#{{ $viewFolder }}_post_subjective_complaints_text').prop('disabled', false);
                          $('#{{ $viewFolder }}_post_subjective_complaints_text').prop('required', true);
                        }else{
                          $('#{{ $viewFolder }}_post_subjective_complaints_text').prop('disabled', true);
                          $('#{{ $viewFolder }}_post_subjective_complaints_text').prop('required', false);
                          $('#{{ $viewFolder }}_post_subjective_complaints_text').val('');
                        }
                      ">
                    <label class="form-check-label" for="{{ $viewFolder }}_post_subjective_complaints_none">none</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $viewFolder }}[post_subjective_complaints]" value="yes" id="{{ $viewFolder }}_post_subjective_complaints_yes" onchange="
                        if($(this).prop('checked')){
                          $('#{{ $viewFolder }}_post_subjective_complaints_text').prop('disabled', false);
                          $('#{{ $viewFolder }}_post_subjective_complaints_text').prop('required', true);
                        }else{
                          $('#{{ $viewFolder }}_post_subjective_complaints_text').prop('disabled', true);
                          $('#{{ $viewFolder }}_post_subjective_complaints_text').prop('required', false);
                          $('#{{ $viewFolder }}_post_subjective_complaints_text').val('');
                        }
                      ">
                    <label class="form-check-label" for="{{ $viewFolder }}_post_subjective_complaints_yes">yes</label>
                  </div>
                  <textarea class="form-control" name="{{ $viewFolder }}[post_subjective_complaints_text]" id="{{ $viewFolder }}_post_subjective_complaints_text" rows=3 disabled></textarea>
                </div>
                <label>Significant PE Findings</label>
                <div class="container ml-5 mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Pallor" id="{{ $viewFolder }}_post_pe_findings_pallor">
                    <label class="form-check-label" for="{{ $viewFolder }}_post_pe_findings_pallor">Pallor</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Distended Neck Vein" id="{{ $viewFolder }}_post_pe_findings_neck_vein">
                    <label class="form-check-label" for="{{ $viewFolder }}_post_pe_findings_neck_vein">Distended Neck Vein</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Abnormal Rhythm/Rate" id="{{ $viewFolder }}_post_pe_findings_rhythm">
                    <label class="form-check-label" for="{{ $viewFolder }}_post_pe_findings_rhythm">Abnormal Rhythm/Rate</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Rales" id="{{ $viewFolder }}_post_pe_findings_rales">
                    <label class="form-check-label" for="{{ $viewFolder }}_post_pe_findings_rales">Rales</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Wheezing" id="{{ $viewFolder }}_post_pe_findings_wheezing">
                    <label class="form-check-label" for="{{ $viewFolder }}_post_pe_findings_wheezing">Wheezing</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Decreased Breath Sounds" id="{{ $viewFolder }}_post_pe_findings_breath_sounds">
                    <label class="form-check-label" for="{{ $viewFolder }}_post_pe_findings_breath_sounds">Decreased Breath Sounds</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Ascites - Abdominal Girth" id="{{ $viewFolder }}_post_pe_findings_ascites" onchange="
                        if($(this).prop('checked')){
                          $('#{{ $viewFolder }}_post_pe_findings_ascites_text').prop('disabled', false);
                          $('#{{ $viewFolder }}_post_pe_findings_ascites_text').prop('required', true);
                        }else{
                          $('#{{ $viewFolder }}_post_pe_findings_ascites_text').prop('disabled', true);
                          $('#{{ $viewFolder }}_post_pe_findings_ascites_text').prop('required', false);
                          $('#{{ $viewFolder }}_post_pe_findings_ascites_text').val('');
                        }
                      "
                    >
                    <label class="form-check-label" for="{{ $viewFolder }}_post_pe_findings_ascites">Ascites - Abdominal Girth:</label>
                  </div>
                  <textarea class="form-control" name="{{ $viewFolder }}[post_pe_findings_ascites_text]" id="{{ $viewFolder }}_post_pe_findings_ascites_text" rows=3 disabled></textarea>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Decreased Breath Sounds" id="{{ $viewFolder }}_post_pe_findings_breath_sounds">
                    <label class="form-check-label" for="{{ $viewFolder }}_post_pe_findings_breath_sounds">Decreased Breath Sounds</label>
                  </div>
                  
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Edema Grade" id="{{ $viewFolder }}_post_pe_findings_edema" onchange="
                        if($(this).prop('checked')){
                          $('#{{ $viewFolder }}_post_pe_findings_edema_text').prop('disabled', false);
                          $('#{{ $viewFolder }}_post_pe_findings_edema_text').prop('required', true);
                        }else{
                          $('#{{ $viewFolder }}_post_pe_findings_edema_text').prop('disabled', true);
                          $('#{{ $viewFolder }}_post_pe_findings_edema_text').prop('required', false);
                          $('#{{ $viewFolder }}_post_pe_findings_edema_text').val('');
                        }
                      "
                    >
                    <label class="form-check-label" for="{{ $viewFolder }}_post_pe_findings_edema">Edema Grade:</label>
                  </div>
                  <textarea class="form-control" name="{{ $viewFolder }}[post_pe_findings_edema_text]" id="{{ $viewFolder }}_post_pe_findings_edema_text" rows=3 disabled></textarea>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Bleeding" id="{{ $viewFolder }}_post_pe_findings_bleeding">
                    <label class="form-check-label" for="{{ $viewFolder }}_post_pe_findings_bleeding">Bleeding</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Others" id="{{ $viewFolder }}_post_pe_findings_others" onchange="
                        if($(this).prop('checked')){
                          $('#{{ $viewFolder }}_post_pe_findings_others_text').prop('disabled', false);
                          $('#{{ $viewFolder }}_post_pe_findings_others_text').prop('required', true);
                        }else{
                          $('#{{ $viewFolder }}_post_pe_findings_others_text').prop('disabled', true);
                          $('#{{ $viewFolder }}_post_pe_findings_others_text').prop('required', false);
                          $('#{{ $viewFolder }}_post_pe_findings_others_text').val('');
                        }
                      "
                    >
                    <label class="form-check-label" for="{{ $viewFolder }}_post_pe_findings_others">Others:</label>
                  </div>
                  <textarea class="form-control" name="{{ $viewFolder }}[post_pe_findings_others_text]" id="{{ $viewFolder }}_post_pe_findings_others_text" rows=3 disabled></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
      <div id="consoDocDiv" style="{{ isset($datum->id) ? 'display:none' : '' }}" class="container border border-1 border-top-0 mb-3 p-3">
        {{-- <div class="card-header">Doctor's Info</div> --}}
        <div class="card-body">
          <div class="card mb-3">
            <div class="card-header">Basic Info</div>
            <div class="card-body">
              {{-- @php
                if(isset($referal_conso))
                  $datum->clinic_id = $referal_conso->clinic_id
              @endphp --}}
              <input type="hidden" class="form-control" name="{{ $viewFolder }}[doctor_id]" value="{{ !empty($doctor->id) ? $doctor->id : '' }}">
              <input type="hidden" class="form-control" name="{{ $viewFolder }}[clinic_id]" value="{{ !empty($datum->clinic_id) ? $datum->clinic_id : $user->clinic->id }}">
              <img src="{{ !empty($doctor->profile_pic) ? (stristr($doctor->profile_pic, 'uploads') ? asset('storage/' . $doctor->profile_pic) : asset('storage/doctor_files/' . $doctor->profile_pic)) : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" class="img-thumbnail float-start w-25 h-25 m-2" alt="">
              <p>
                <strong>Name:</strong> Dr. {{ $doctor->name }}<br>
                <strong>Age:</strong> {{ floor((strtotime(date('Y-m-d')) - strtotime($doctor->dob))/(60*60*24*365.25)) }}<br>
                <strong>Med School:</strong> {{ $doctor->medSchool }}<br>
                <strong>Year Graduated in Med School:</strong> {{ date('Y', strtotime($doctor->medgraddate)) }}<br>
                <strong>Residency:</strong> {{ $doctor->residencySchool }}<br>
                <strong>Specialty:</strong> {{ $doctor->specialty }}<br>
                <strong>Sub Specialty:</strong> {{ $doctor->specialty }}<br>
                <strong>Hospital Affiliation:</strong> {{ $doctor->hAffiliation }}<br>
                <strong>Fee:</strong> P{{ isset($datum->fee) ? number_format($datum->fee, 2) : number_format($doctor->fee, 2) }}<br>
              </p>  
            </div>
          </div>
          <div class="card mb-3">
            <div class="card-header">Clinic Schedule</div>
            <div class="card-body">
              <div class="table-responsive h-100">
                <table class="table table-bordered table-striped table-hover table-sm">
                  <thead class="table-{{ $bgColor }}">
                    <tr>
                      <th>Clinic</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Days</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($doctor->scheduleConsos as $sc)
                    <tr>
                        <td>{{ $sc->clinic->name }}</td>
                        <td>{{ $sc->date_from . ' - ' . $sc->date_to }}</td>
                        <td>{{ $sc->time_from . ' - ' . $sc->time_to }}</td>
                        <td>{{ $sc->days }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="consoPatientDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
        <div class="row">
          <div class="col-lg-6"> 
            <div class="card mb-3">
              <div class="card-header">Basic Info</div>
              <div class="card-body">
                <div class="mb-4 d-flex justify-content-center">
                  <img id="{{ $viewFolder }}_profileImage" src="{{ !empty($datum->patient->profile_pic) ? (stristr($datum->patient->profile_pic, 'uploads') ? asset('storage/' . $datum->patient->profile_pic) : asset('storage/px_files/' . $datum->patient->profile_pic)) : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" alt="example placeholder" style="width: 300px;" />
                </div>
                <div class="d-flex justify-content-center mb-3">
                  <div class="btn btn-{{ $bgColor }} btn-rounded">
                    <label class="form-label text-white m-1" for="{{ $viewFolder }}_profile_pic">Profile Pic</label>
                    <input type="file" class="form-control d-none" name="{{ $viewFolder }}[Patient][profile_pic]" id="{{ $viewFolder }}_profile_pic" onchange="displaySelectedImage(event, '{{ $viewFolder }}_profileImage')">
                  </div>
                </div>
                <div class="form-floating mb-3">
                  <input class="form-control" type="text" name="{{ $viewFolder }}[Patient][f_name]" id="{{ $viewFolder }}_f_name" placeholder="" value="{{ !empty($datum->patient->f_name) ? $datum->patient->f_name : '' }}" required>
                  <label for="{{ $viewFolder }}_f_name" class="form-label">First Name</label>
                  <small id="help_{{ $viewFolder }}_f_name" class="text-muted"></small>
                </div>
                <div class="form-floating mb-3">
                  <input class="form-control" type="text" name="{{ $viewFolder }}[Patient][m_name]" id="{{ $viewFolder }}_m_name" placeholder="" value="{{ !empty($datum->patient->m_name) ? $datum->patient->m_name : '' }}" required>
                  <label for="{{ $viewFolder }}_m_name" class="form-label">Middle Name</label>
                  <small id="help_{{ $viewFolder }}_m_name" class="text-muted"></small>
                </div>
                <div class="form-floating mb-3">
                  <input class="form-control" type="text" name="{{ $viewFolder }}[Patient][l_name]" id="{{ $viewFolder }}_l_name" placeholder="" value="{{ !empty($datum->patient->l_name) ? $datum->patient->l_name : '' }}" required>
                  <label for="{{ $viewFolder }}_l_name" class="form-label">Last Name</label>
                  <small id="help_{{ $viewFolder }}_l_name" class="text-muted"></small>
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">Gender</span>
                  <div class="input-group-text">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="{{ $viewFolder }}[Patient][gender]" value="male" id="{{ $viewFolder }}_gender_male" {{ isset($datum->patient->gender) && $datum->patient->gender == 'male' ? 'checked' : '' }}>
                      <label class="form-check-label" for="{{ $viewFolder }}_gender_male">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="{{ $viewFolder }}[Patient][gender]" value="female" id="{{ $viewFolder }}_gender_female" {{ isset($datum->patient->gender) && $datum->patient->gender == 'female' ? 'checked' : '' }}>
                      <label class="form-check-label" for="{{ $viewFolder }}_gender_female">Female</label>
                    </div>
                  </div>
                </div>
                <div class="form-floating mb-3">
                  <input class="form-control" type="date" name="{{ $viewFolder }}[Patient][birthdate]" id="{{ $viewFolder }}_birthdate" placeholder="" value="{{ !empty($datum->patient->birthdate) ? $datum->patient->birthdate : '' }}" required>
                  <label for="{{ $viewFolder }}_birthdate" class="form-label">Birth Date</label>
                  <small id="help_{{ $viewFolder }}_birthdate" class="text-muted"></small>
                </div>
                <div class="form-floating mb-3">
                  <input class="form-control" type="text" name="{{ $viewFolder }}[Patient][phil_num]" id="{{ $viewFolder }}_phil_num" placeholder="" value="{{ !empty($datum->patient->phil_num) ? $datum->patient->phil_num : '' }}" {{ isset($datum->payment_mode) && ($datum->payment_mode == 'Both' || $datum->payment_mode == 'Both Cash' || $datum->payment_mode == 'Philhealth') ? '' : 'disabled' }}>
                  <label for="{{ $viewFolder }}_phil_num" class="form-label">Philhealth #</label>
                  <small id="help_{{ $viewFolder }}_phil_num" class="text-muted"></small>
                </div>
                <div class="form-floating mb-3">
                  <select class="form-select" name="{{ $viewFolder }}[Patient][hmo]" id="{{ $viewFolder }}_hmo" placeholder="" {{ isset($datum->payment_mode) && ($datum->payment_mode == 'Both' || $datum->payment_mode == 'Both Cash' || $datum->payment_mode == 'HMO') ? '' : 'disabled' }}>
                    <option value=""></option>
                  @foreach($selectItems['hmos'] as $hmo)
                    <option value="{{ $hmo->id }}" {{ !empty($datum->patient->hmo) && $hmo->id == $datum->patient->hmo ? 'selected' : '' }}>{{ $hmo->name }}</option>
                  @endforeach
                  </select>
                  <label for="{{ $viewFolder }}_hmo">HMO</label>
                  <small id="help_{{ $viewFolder }}_hmo" class="text-muted"></small>
                </div>
                <div class="form-floating mb-3">
                  <input class="form-control" type="text" name="{{ $viewFolder }}[Patient][hmo_num]" id="{{ $viewFolder }}_hmo_num" placeholder="" value="{{ !empty($datum->patient->hmo_num) ? $datum->patient->hmo_num : '' }}" {{ isset($datum->payment_mode) && ($datum->payment_mode == 'Both' || $datum->payment_mode == 'Both Cash' || $datum->payment_mode == 'HMO') ? '' : 'disabled' }}>
                  <label for="{{ $viewFolder }}_hmo_num" class="form-label">HMO #</label>
                  <small id="help_{{ $viewFolder }}_hmo_num" class="text-muted"></small>
                </div>
                <div class="form-floating mb-3">
                  <textarea class="form-control" name="{{ $viewFolder }}[Patient][address]" id="{{ $viewFolder }}_address" rows=3 required>{{ !empty($datum->patient->address) ? $datum->patient->address : '' }}</textarea>
                  <label for="{{ $viewFolder }}_address" class="form-label">Address</label>
                  <small id="help_{{ $viewFolder }}_address" class="text-muted"></small>
                </div>
                <div class="form-floating mb-3">
                  <input class="form-control" type="email" name="{{ $viewFolder }}[Patient][email]" id="{{ $viewFolder }}_email" placeholder="" value="{{ !empty($datum->patient->email) ? $datum->patient->email : '' }}">
                  <label for="{{ $viewFolder }}_email" class="form-label">Email</label>
                  <small id="help_{{ $viewFolder }}_email" class="text-muted"></small>
                </div>
                <div class="form-floating mb-3">
                  <input class="form-control" type="tel" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" name="{{ $viewFolder }}[Patient][mobile_no]" id="{{ $viewFolder }}_mobile_no" placeholder="0900-000-0000" value="{{ !empty($datum->patient->mobile_no) ? $datum->patient->mobile_no : '' }}" required>
                  <label for="{{ $viewFolder }}_mobile_no" class="form-label">Mobile #</label>
                  <small id="help_{{ $viewFolder }}_mobile_no" class="text-muted">Format: 0900-000-0000</small>
                </div>
                <div class="input-group mb-3 flex-nowrap">
                  <span class="input-group-text">Patient Type</span>
                  <div class="input-group-text">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="{{ $viewFolder }}[Patient][patient_type]" value="Private" id="{{ $viewFolder }}_patient_type_private" {{ isset($datum->patient->patient_type) && $datum->patient->patient_type == 'Private' ? 'checked' : '' }}>
                      <label class="form-check-label" for="{{ $viewFolder }}_patient_type_private">Private</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="{{ $viewFolder }}[Patient][patient_type]" value="In House" id="{{ $viewFolder }}_patient_type_in_house" {{ isset($datum->patient->patient_type) && $datum->patient->patient_type == 'In House' ? 'checked' : '' }}>
                      <label class="form-check-label" for="{{ $viewFolder }}_patient_type_in_house">In House</label>
                    </div>
                  </div>
                </div>
                <label for="{{ $viewFolder }}_patient_sub_type">Patient Sub Type</label>
                <div class="input-group mb-3 flex-nowrap">
                  <select class="form-select" name="{{ $viewFolder }}[Patient][patient_sub_type]" id="{{ $viewFolder }}_patient_sub_type" placeholder="" required onchange="
                      if($(this).val() == 'Walk-in Referral From'){
                        $('#{{ $viewFolder }}_referral_from').prop('disabled', false);
                        $('#{{ $viewFolder }}_referral_from').prop('required', true);
                      }else{
                        $('#{{ $viewFolder }}_referral_from').prop('disabled', true);
                        $('#{{ $viewFolder }}_referral_from').prop('required', false);
                        $('#{{ $viewFolder }}_referral_from').val('');
                      }
                    ">
                    <option value="Non Walk-in" {{ isset($datum->patient->patient_sub_type) && $datum->patient->patient_sub_type == 'Non Walk-in' ? 'selected' : '' }}>Non Walk-in</option>
                    <optgroup label="Walk-in">
                      <option value="Walk-in Social Media" {{ isset($datum->patient->patient_sub_type) && $datum->patient->patient_sub_type == 'Walk-in Social Media' ? 'selected' : '' }}>Social Media</option>
                      <option value="Walk-in Mainstream Media" {{ isset($datum->patient->patient_sub_type) && $datum->patient->patient_sub_type == 'Walk-in Mainstream Media' ? 'selected' : '' }}>Mainstream Media</option>
                      <option value="Walk-in Signage" {{ isset($datum->patient->patient_sub_type) && $datum->patient->patient_sub_type == 'Walk-in Signage' ? 'selected' : '' }}>Signage</option>
                      <option value="Walk-in Referral From" {{ isset($datum->patient->patient_sub_type) && $datum->patient->patient_sub_type == 'Walk-in Referral From' ? 'selected' : '' }}>Referral From</option>
                    </optgroup>
                  </select>
                  <select class="form-select" name="{{ $viewFolder }}[Patient][referral_from]" id="{{ $viewFolder }}_referral_from" placeholder="" {{ isset($datum->patient->referral_from) && $datum->patient->patient_sub_type == 'Walk-in Referral From' ? '' : 'disabled' }}>
                    <option {{ isset($datum->patient->referral_from) && $datum->patient->referral_from == '' ? 'selected' : '' }}></option>
                    <option value="Friend or Relative" {{ isset($datum->patient->referral_from) && $datum->patient->referral_from == 'Friend or Relative' ? 'selected' : '' }}>Friend or Relative</option>
                    <option value="Doctor" {{ isset($datum->patient->referral_from) && $datum->patient->referral_from == 'Doctor' ? 'selected' : '' }}>Doctor</option>
                    <option value="Private Institution/Corporation" {{ isset($datum->patient->referral_from) && $datum->patient->referral_from == 'Private Institution/Corporation' ? 'selected' : '' }}>Private Institution/Corporation</option>
                    <option value="Government Institution" {{ isset($datum->patient->referral_from) && $datum->patient->referral_from == 'Government Institution' ? 'selected' : '' }}>Government Institution</option>
                    <option value="HMO" {{ isset($datum->patient->referral_from) && $datum->patient->referral_from == 'HMO' ? 'selected' : '' }}>HMO</option>
                    <option value="Charity Institution" {{ isset($datum->patient->referral_from) && $datum->patient->referral_from == 'Charity Institution' ? 'selected' : '' }}>Charity Institution</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card mb-3">
              <div class="card-header">Medical History</div>
              <div class="card-body">
                <label>Past Medical History</label>
                <div class="container ml-5 mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[Patient][pastMedicalHistory][]" value="Diabetes" id="{{ $viewFolder }}_past_med_history_diabetes" {{ (isset($datum->patient->pastMedicalHistory) && is_array(json_decode($datum->patient->pastMedicalHistory)) && in_array('Diabetes', json_decode($datum->patient->pastMedicalHistory))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $viewFolder }}_past_med_history_diabetes">Diabetes</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[Patient][pastMedicalHistory][]" value="Hypertension" id="{{ $viewFolder }}_past_med_history_hypertension" {{ (isset($datum->patient->pastMedicalHistory) && is_array(json_decode($datum->patient->pastMedicalHistory)) && in_array('Hypertension', json_decode($datum->patient->pastMedicalHistory))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $viewFolder }}_past_med_history_hypertension">Hypertension</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[Patient][pastMedicalHistory][]" value="Heart Disease" id="{{ $viewFolder }}_past_med_history_heart" {{ (isset($datum->patient->pastMedicalHistory) && is_array(json_decode($datum->patient->pastMedicalHistory)) && in_array('Heart Disease', json_decode($datum->patient->pastMedicalHistory))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $viewFolder }}_past_med_history_heart">Heart Disease</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[Patient][pastMedicalHistory][]" value="Thyroid Disease" id="{{ $viewFolder }}_past_med_history_thyroid" {{ (isset($datum->patient->pastMedicalHistory) && is_array(json_decode($datum->patient->pastMedicalHistory)) && in_array('Thyroid Disease', json_decode($datum->patient->pastMedicalHistory))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $viewFolder }}_past_med_history_thyroid">Thyroid Disease</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[Patient][pastMedicalHistory][]" value="Trauma, Accident" id="{{ $viewFolder }}_past_med_history_trauma" {{ (isset($datum->patient->pastMedicalHistory) && is_array(json_decode($datum->patient->pastMedicalHistory)) && in_array('Trauma, Accident', json_decode($datum->patient->pastMedicalHistory))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $viewFolder }}_past_med_history_trauma">Trauma, Accident</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[Patient][pastMedicalHistory][]" value="Asthma" id="{{ $viewFolder }}_past_med_history_asthma" {{ (isset($datum->patient->pastMedicalHistory) && is_array(json_decode($datum->patient->pastMedicalHistory)) && in_array('Asthma', json_decode($datum->patient->pastMedicalHistory))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $viewFolder }}_past_med_history_asthma">Asthma</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[Patient][pastMedicalHistory][]" value="Cancer" id="{{ $viewFolder }}_past_med_history_cancer" {{ (isset($datum->patient->pastMedicalHistory) && is_array(json_decode($datum->patient->pastMedicalHistory)) && in_array('Cancer', json_decode($datum->patient->pastMedicalHistory))) ? 'checked' : '' }} onchange="
                        if($(this).prop('checked')){
                          $('#{{ $viewFolder }}_past_med_history_cancer_text').prop('disabled', false);
                          $('#{{ $viewFolder }}_past_med_history_cancer_text').prop('required', true);
                        }else{
                          $('#{{ $viewFolder }}_past_med_history_cancer_text').prop('disabled', true);
                          $('#{{ $viewFolder }}_past_med_history_cancer_text').prop('required', false);
                          $('#{{ $viewFolder }}_past_med_history_cancer_text').val('');
                        }
                      ">
                    <label class="form-check-label" for="{{ $viewFolder }}_past_med_history_cancer">Cancer</label>
                  </div>
                  <textarea class="form-control" name="{{ $viewFolder }}[Patient][pastMedicalHistoryCancer]" id="{{ $viewFolder }}_past_med_history_cancer_text" rows=3 {{ (isset($datum->patient->pastMedicalHistory) && is_array(json_decode($datum->patient->pastMedicalHistory)) && in_array('Cancer', json_decode($datum->patient->pastMedicalHistory))) ? '' : 'diasabled' }}>{{ isset($datum->patient->pastMedicalHistoryCancer) ? $datum->patient->pastMedicalHistoryCancer : '' }}</textarea>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[Patient][pastMedicalHistory][]" value="Others" id="{{ $viewFolder }}_past_med_history_other" {{ (isset($datum->patient->pastMedicalHistory) && is_array(json_decode($datum->patient->pastMedicalHistory)) && in_array('Others', json_decode($datum->patient->pastMedicalHistory))) ? 'checked' : '' }} onchange="
                    if($(this).prop('checked')){
                      $('#{{ $viewFolder }}_past_med_history_other_text').prop('disabled', false);
                      $('#{{ $viewFolder }}_past_med_history_other_text').prop('required', true);
                    }else{
                      $('#{{ $viewFolder }}_past_med_history_other_text').prop('disabled', true);
                      $('#{{ $viewFolder }}_past_med_history_other_text').prop('required', false);
                      $('#{{ $viewFolder }}_past_med_history_other_text').val('');
                    }
                  ">
                    <label class="form-check-label" for="{{ $viewFolder }}_past_med_history_other">Others</label>
                  </div>
                  <textarea class="form-control" name="{{ $viewFolder }}[Patient][pastMedicalHistoryOthers]" id="{{ $viewFolder }}_past_med_history_other_text" rows=3 {{ (isset($datum->patient->pastMedicalHistory) && is_array(json_decode($datum->patient->pastMedicalHistory)) && in_array('Others', json_decode($datum->patient->pastMedicalHistory))) ? '' : 'disabled' }}>{{ isset($datum->patient->pastMedicalHistoryOthers) ? $datum->patient->pastMedicalHistoryOthers : '' }}</textarea>
                </div>
                <div class="form-floating mb-3">
                  <textarea class="form-control" name="{{ $viewFolder }}[Patient][pastSurgicalHistory]" id="{{ $viewFolder }}_pastSurgicalHistory" rows=3>{{ isset($datum->patient->pastSurgicalHistory) ? $datum->patient->pastSurgicalHistory : '' }}</textarea>
                  <label for="{{ $viewFolder }}_pastSurgicalHistory" class="form-label">Past surgical History and Date</label>
                  <small id="help_{{ $viewFolder }}_pastSurgicalHistory" class="text-muted"></small>
                </div>
                <label>Family History</label>
                <div class="container ml-5 mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[Patient][pastFamilyHistory][]" value="Diabetes" id="{{ $viewFolder }}_past_family_history_diabetes" {{ (isset($datum->patient->pastFamilyHistory) && is_array(json_decode($datum->patient->pastFamilyHistory)) && in_array('Diabetes', json_decode($datum->patient->pastFamilyHistory))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $viewFolder }}_past_family_history_diabetes">Diabetes</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[Patient][pastFamilyHistory][]" value="Hypertension" id="{{ $viewFolder }}_past_family_history_hypertension" {{ (isset($datum->patient->pastFamilyHistory) && is_array(json_decode($datum->patient->pastFamilyHistory)) && in_array('Hypertension', json_decode($datum->patient->pastFamilyHistory))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $viewFolder }}_past_family_history_hypertension">Hypertension</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[Patient][pastFamilyHistory][]" value="Heart Disease" id="{{ $viewFolder }}_past_family_history_heart" {{ (isset($datum->patient->pastFamilyHistory) && is_array(json_decode($datum->patient->pastFamilyHistory)) && in_array('Heart Disease', json_decode($datum->patient->pastFamilyHistory))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $viewFolder }}_past_family_history_heart">Heart Disease</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[Patient][pastFamilyHistory][]" value="Thyroid Disease" id="{{ $viewFolder }}_past_family_history_thyroid" {{ (isset($datum->patient->pastFamilyHistory) && is_array(json_decode($datum->patient->pastFamilyHistory)) && in_array('Thyroid Disease', json_decode($datum->patient->pastFamilyHistory))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $viewFolder }}_past_family_history_thyroid">Thyroid Disease</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[Patient][pastFamilyHistory][]" value="Trauma, Accident" id="{{ $viewFolder }}_past_family_history_trauma" {{ (isset($datum->patient->pastFamilyHistory) && is_array(json_decode($datum->patient->pastFamilyHistory)) && in_array('Trauma, Accident', json_decode($datum->patient->pastFamilyHistory))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $viewFolder }}_past_family_history_trauma">Trauma, Accident</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[Patient][pastFamilyHistory][]" value="Asthma" id="{{ $viewFolder }}_past_family_history_asthma" {{ (isset($datum->patient->pastFamilyHistory) && is_array(json_decode($datum->patient->pastFamilyHistory)) && in_array('Asthma', json_decode($datum->patient->pastFamilyHistory))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $viewFolder }}_past_family_history_asthma">Asthma</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[Patient][pastFamilyHistory][]" value="Cancer" id="{{ $viewFolder }}_past_family_history_cancer" {{ (isset($datum->patient->pastFamilyHistory) && is_array(json_decode($datum->patient->pastFamilyHistory)) && in_array('Cancer', json_decode($datum->patient->pastFamilyHistory))) ? 'checked' : '' }} onchange="
                    if($(this).prop('checked')){
                      $('#{{ $viewFolder }}_past_family_history_cancer_text').prop('disabled', false);
                      $('#{{ $viewFolder }}_past_family_history_cancer_text').prop('required', true);
                    }else{
                      $('#{{ $viewFolder }}_past_family_history_cancer_text').prop('disabled', true);
                      $('#{{ $viewFolder }}_past_family_history_cancer_text').prop('required', false);
                      $('#{{ $viewFolder }}_past_family_history_cancer_text').val('');
                    }
                  ">
                    <label class="form-check-label" for="{{ $viewFolder }}_past_family_history_cancer">Cancer</label>
                  </div>
                  <textarea class="form-control" name="{{ $viewFolder }}[Patient][pastFamilyHistoryCancer]" id="{{ $viewFolder }}_past_family_history_cancer_text" rows=3 {{ (isset($datum->patient->pastFamilyHistory) && is_array(json_decode($datum->patient->pastFamilyHistory)) && in_array('Cancer', json_decode($datum->patient->pastFamilyHistory))) ? '' : 'disabled' }}>{{ isset($datum->patient->pastFamilyHistoryCancer) ? $datum->patient->pastFamilyHistoryCancer : '' }}</textarea>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[Patient][pastFamilyHistory][]" value="Others" id="{{ $viewFolder }}_past_family_history_other" {{ (isset($datum->patient->pastFamilyHistory) && is_array(json_decode($datum->patient->pastFamilyHistory)) && in_array('Others', json_decode($datum->patient->pastFamilyHistory))) ? 'checked' : '' }} onchange="
                    if($(this).prop('checked')){
                      $('#{{ $viewFolder }}_past_family_history_other_text').prop('disabled', false);
                      $('#{{ $viewFolder }}_past_family_history_other_text').prop('required', true);
                    }else{
                      $('#{{ $viewFolder }}_past_family_history_other_text').prop('disabled', true);
                      $('#{{ $viewFolder }}_past_family_history_other_text').prop('required', false);
                      $('#{{ $viewFolder }}_past_family_history_other_text').val('');
                    }
                  ">
                    <label class="form-check-label" for="{{ $viewFolder }}_past_family_history_other">Others</label>
                  </div>
                  <textarea class="form-control" name="{{ $viewFolder }}[Patient][pastFamilyHistoryOthers]" id="{{ $viewFolder }}_past_family_history_other_text" rows=3 {{ (isset($datum->patient->pastFamilyHistory) && is_array(json_decode($datum->patient->pastFamilyHistory)) && in_array('Others', json_decode($datum->patient->pastFamilyHistory))) ? '' : 'disabled' }}>{{ isset($datum->patient->pastFamilyHistoryOthers) ? $datum->patient->pastFamilyHistoryOthers : '' }}</textarea>
                </div>
                <div class="form-floating mb-3">
                  <textarea class="form-control" name="{{ $viewFolder }}[Patient][pastMedication]" id="{{ $viewFolder }}_pastMedication" rows=3>{{ isset($datum->patient->pastMedication) ? $datum->patient->pastMedication : '' }}</textarea>
                  <label for="{{ $viewFolder }}_pastMedication" class="form-label">Past Medication</label>
                  <small id="help_{{ $viewFolder }}_pastMedication" class="text-muted"></small>
                </div>
                <div class="form-floating mb-3">
                  <textarea class="form-control" name="{{ $viewFolder }}[Patient][presentMedication]" id="{{ $viewFolder }}_presentMedication" rows=3>{{ isset($datum->patient->presentMedication) ? $datum->patient->presentMedication : ''}}</textarea>
                  <label for="{{ $viewFolder }}_presentMedication" class="form-label">Present Medication</label>
                  <small id="help_{{ $viewFolder }}_presentMedication" class="text-muted"></small>
                </div>
                <label>Allergies</label>
                <div class="container ml-5 mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[Patient][allergies][]" value="Food" id="{{ $viewFolder }}_allergies_food" {{ (isset($datum->patient->allergies) && is_array(json_decode($datum->patient->allergies)) && in_array('Food', json_decode($datum->patient->allergies))) ? 'checked' : '' }} onchange="
                    if($(this).prop('checked')){
                      $('#{{ $viewFolder }}_allergies_food_text').prop('disabled', false);
                      $('#{{ $viewFolder }}_allergies_food_text').prop('required', true);
                    }else{
                      $('#{{ $viewFolder }}_allergies_food_text').prop('disabled', true);
                      $('#{{ $viewFolder }}_allergies_food_text').prop('required', false);
                      $('#{{ $viewFolder }}_allergies_food_text').val('');
                    }
                  ">
                    <label class="form-check-label" for="{{ $viewFolder }}_allergies_food">Food</label>
                  </div>
                  <textarea class="form-control" name="{{ $viewFolder }}[Patient][allergiesFood]" id="{{ $viewFolder }}_allergies_food_text" rows=3 {{ (isset($datum->patient->allergies) && is_array(json_decode($datum->patient->allergies)) && in_array('Food', json_decode($datum->patient->allergies))) ? '' : 'disabled' }}>{{ isset($datum->patient->allergiesFood) ? $datum->patient->allergiesFood : '' }}</textarea>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[Patient][allergies][]" value="Medicine" id="{{ $viewFolder }}_allergies_medicine" {{ (isset($datum->patient->allergies) && is_array(json_decode($datum->patient->allergies)) && in_array('Medicine', json_decode($datum->patient->allergies))) ? 'checked' : '' }} onchange="
                    if($(this).prop('checked')){
                      $('#{{ $viewFolder }}_allergies_medicine_text').prop('disabled', false);
                      $('#{{ $viewFolder }}_allergies_medicine_text').prop('required', true);
                    }else{
                      $('#{{ $viewFolder }}_allergies_medicine_text').prop('disabled', true);
                      $('#{{ $viewFolder }}_allergies_medicine_text').prop('required', false);
                      $('#{{ $viewFolder }}_allergies_medicine_text').val('');
                    }
                  ">
                    <label class="form-check-label" for="{{ $viewFolder }}_allergies_medicine">Medicine</label>
                  </div>
                  <textarea class="form-control" name="{{ $viewFolder }}[Patient][allergiesMedicine]" id="{{ $viewFolder }}_allergies_medicine_text" rows=3 {{ (isset($datum->patient->allergies) && is_array(json_decode($datum->patient->allergies)) && in_array('Medicine', json_decode($datum->patient->allergies))) ? '' : 'disabled' }}>{{ isset($datum->patient->allergiesMedicine) ? $datum->patient->allergiesMedicine : '' }}</textarea>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[Patient][allergies][]" value="Others" id="{{ $viewFolder }}_allergies_others" {{ (isset($datum->patient->allergies) && is_array(json_decode($datum->patient->allergies)) && in_array('Others', json_decode($datum->patient->allergies))) ? 'checked' : '' }} onchange="
                    if($(this).prop('checked')){
                      $('#{{ $viewFolder }}_allergies_others_text').prop('disabled', false);
                      $('#{{ $viewFolder }}_allergies_others_text').prop('required', true);
                    }else{
                      $('#{{ $viewFolder }}_allergies_others_text').prop('disabled', true);
                      $('#{{ $viewFolder }}_allergies_others_text').prop('required', false);
                      $('#{{ $viewFolder }}_allergies_others_text').val('');
                    }
                  ">
                    <label class="form-check-label" for="{{ $viewFolder }}_allergies_others">Others</label>
                  </div>
                  <textarea class="form-control" name="{{ $viewFolder }}[Patient][allergiesOthers]" id="{{ $viewFolder }}_allergies_others_text" rows=3 {{ (isset($datum->patient->allergies) && is_array(json_decode($datum->patient->allergies)) && in_array('Others', json_decode($datum->patient->allergies))) ? '' : 'disabled' }}>{{ isset($datum->patient->allergiesOthers) ? $datum->patient->allergiesOthers : '' }}</textarea>
                </div>
                <div class="form-floating mb-3">
                  <textarea class="form-control" name="{{ $viewFolder }}[Patient][vaccination]" id="{{ $viewFolder }}_vaccination" rows=3>{{ isset($datum->patient->vaccination) ? $datum->patient->vaccination : '' }}</textarea>
                  <label for="{{ $viewFolder }}_vaccination" class="form-label">Vaccination History</label>
                  <small id="help_{{ $viewFolder }}_vaccination" class="text-muted"></small>
                </div>
                <div class="form-floating mb-3">
                  <textarea class="form-control" name="{{ $viewFolder }}[Patient][medHistoryOthers]" id="{{ $viewFolder }}_medHistoryOthers" rows=3>{{ isset($datum->patient->medHistoryOthers) ? $datum->patient->medHistoryOthers : '' }}</textarea>
                  <label for="{{ $viewFolder }}_medHistoryOthers" class="form-label">Other Information</label>
                  <small id="help_{{ $viewFolder }}_medHistoryOthers" class="text-muted"></small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function displaySelectedImage(event, elementId) {
    const selectedImage = document.getElementById(elementId);
    const fileInput = event.target;

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            selectedImage.src = e.target.result;
        };

        reader.readAsDataURL(fileInput.files[0]);
    }
  }

  function FileListItem(file) {
    file = [].slice.call(Array.isArray(file) ? file : arguments)
    for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
    if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
    for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
    return b.files
  }

  $(document).ready(function() {
    var fileArr = [];
    $("#{{ $viewFolder }}_files").change(function(){
        // check if fileArr length is greater than 0
        if (fileArr.length > 0) fileArr = [];
      
          $('#image_preview').html("");
          var total_file = document.getElementById("{{ $viewFolder }}_files").files;
          if (!total_file.length) return;
          for (var i = 0; i < total_file.length; i++) {
            if (total_file[i].size > 1048576) {
              return false;
            } else {
              fileArr.push(total_file[i]);
              $('#image_preview').append("<div class='img-div' id='img-div"+i+"'><img src='"+URL.createObjectURL(event.target.files[i])+"' class='img-thumbnail' title='"+total_file[i].name+"'><div class='middle'><button id='action-icon' value='img-div"+i+"' class='btn btn-danger' role='"+total_file[i].name+"'><i class='bi bi-trash'></i></button></div></div>");
            }
          }
    });

    $("#{{ $viewFolder }}_nurse_files").change(function(){
        // check if fileArr length is greater than 0
        if (fileArr.length > 0) fileArr = [];
      
          $('#image_preview_nurse').html("");
          var total_file = document.getElementById("{{ $viewFolder }}_nurse_files").files;
          if (!total_file.length) return;
          for (var i = 0; i < total_file.length; i++) {
            if (total_file[i].size > 1048576) {
              return false;
            } else {

              fileArr.push(total_file[i]);
              $('#image_preview_nurse').append("<div class='img-div' id='img-div-nurse"+i+"'><img src='"+URL.createObjectURL(event.target.files[i])+"' class='img-thumbnail' title='"+total_file[i].name+"'><div class='middle'><button id='action-icon-nurse' value='img-div-nurse"+i+"' class='btn btn-danger' role='"+total_file[i].name+"'><i class='bi bi-trash'></i></button></div></div>");
            }
          }
    });

    $("#{{ $viewFolder }}_name").on("input", function () {
      val = $(this).val();
      if(val.length >= 3){
        $.ajax({
          type: 'GET',
          url: '{{ Route::has($viewFolder . '.getPatientList') ? route($viewFolder . '.getPatientList') : ''}}/' + val,
          success: function(data){
            patientsObj = jQuery.parseJSON(data);
            var options = "";
            patientsObj.forEach(function (item, index){
                options  += '<option patient_id="' + item.id + '" value="' + item.name + '">' + item.name + ' - ' + item.consoCount + '</option>';
            });
            $("#patientNameList").html(options);
          }
        });
      }
    });

    $("#{{ $viewFolder }}_name").on("change", function () {
      
      if($(this).val() == ''){
        $('#consoDocDiv').show();  
        $('#consoPatientDiv').hide();  
        $('#patInfoLink').removeClass('active');
        $('#docInfoLink').addClass('active');
        $('#bookMod').trigger('reset');
        $('#{{ $viewFolder }}_profileImage').attr('src', 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg');
      }else{
        $('#consoDocDiv').hide();  
        $('#consoPatientDiv').show();
        $('#patInfoLink').addClass('active');
        $('#docInfoLink').removeClass('active');
      }
      var val = $(this).val();
      var list_patient_id = $('#patientNameList option').filter(function() {
          return $(this).val() == val;
      }).attr('patient_id');
      $.ajax({
        type: 'GET',
        url: '{{ Route::has($viewFolder . '.getPatientInfo') ? route($viewFolder . '.getPatientInfo') : ''}}/' + list_patient_id,
        success:
          function(data, status){
            patientObj = jQuery.parseJSON(data);
            if(patientObj.profile_pic !== null){
              if(patientObj.profile_pic.includes('uploads'))
                $('#{{ $viewFolder }}_profileImage').attr('src', '{{ asset('storage/')}}/' + patientObj.profile_pic);
              else
                $('#{{ $viewFolder }}_profileImage').attr('src', '{{ asset('storage/px_files/')}}/' + patientObj.profile_pic);
            }else{
              $('#{{ $viewFolder }}_profileImage').attr('src', 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg');
            }
            $('#{{ $viewFolder }}_patient_id').val(patientObj.id);
            $('#{{ $viewFolder }}_f_name').val(patientObj.f_name);
            $('#{{ $viewFolder }}_m_name').val(patientObj.m_name);
            $('#{{ $viewFolder }}_l_name').val(patientObj.l_name);
            if(patientObj.gender == 'male'){
              $('#{{ $viewFolder }}_gender_male').prop('checked', true);
              $('#{{ $viewFolder }}_gender_female').prop('checked', false);
            }
            if(patientObj.gender == 'female'){
              $('#{{ $viewFolder }}_gender_male').prop('checked', false);
              $('#{{ $viewFolder }}_gender_female').prop('checked', true);
            }
            $('#{{ $viewFolder }}_birthdate').val(patientObj.birthdate);
            $('#{{ $viewFolder }}_phil_num').val(patientObj.phil_num);
            $('#{{ $viewFolder }}_hmo_num').val(patientObj.hmo_num);
            $('#{{ $viewFolder }}_address').val(patientObj.address);
            $('#{{ $viewFolder }}_email').val(patientObj.email);
            $('#{{ $viewFolder }}_mobile_no').val(patientObj.mobile_no);
            if(patientObj.patient_type == 'Private'){
              $('#{{ $viewFolder }}_patient_type_private').prop('checked', true);
              $('#{{ $viewFolder }}_patient_type_in_house').prop('checked', false);
            }
            if(patientObj.patient_type == 'In House'){
              $('#{{ $viewFolder }}_patient_type_private').prop('checked', false);
              $('#{{ $viewFolder }}_patient_type_in_house').prop('checked', true);
            }
            
            
            $('#{{ $viewFolder }}_patient_sub_type').val(patientObj.patient_sub_type).change();

            if(patientObj.patient_sub_type == 'Walk-in Referral From'){
              $('#{{ $viewFolder }}_referral_from').prop('disabled', false);
            }else{
              $('#{{ $viewFolder }}_referral_from').prop('disabled', true);
            }
            $('#{{ $viewFolder }}_referral_from').val(patientObj.referral_from).change();

            if(jQuery.inArray('Diabetes', JSON.parse(patientObj.pastMedicalHistory)) !== -1){
              $('#{{ $viewFolder }}_past_med_history_diabetes').prop('checked', true);
            }else{
              $('#{{ $viewFolder }}_past_med_history_diabetes').prop('checked', false);
            }
            if(jQuery.inArray('Hypertension', JSON.parse(patientObj.pastMedicalHistory)) !== -1){
              $('#{{ $viewFolder }}_past_med_history_hypertension').prop('checked', true);
            }else{
              $('#{{ $viewFolder }}_past_med_history_hypertension').prop('checked', false);
            }
            if(jQuery.inArray('Heart Disease', JSON.parse(patientObj.pastMedicalHistory)) !== -1){
              $('#{{ $viewFolder }}_past_med_history_heart').prop('checked', true);
            }else{
              $('#{{ $viewFolder }}_past_med_history_heart').prop('checked', false);
            }
            if(jQuery.inArray('Thyroid Disease', JSON.parse(patientObj.pastMedicalHistory)) !== -1){
              $('#{{ $viewFolder }}_past_med_history_thyroid').prop('checked', true);
            }else{
              $('#{{ $viewFolder }}_past_med_history_thyroid').prop('checked', false);
            }
            if(jQuery.inArray('Trauma, Accident', JSON.parse(patientObj.pastMedicalHistory)) !== -1){
              $('#{{ $viewFolder }}_past_med_history_trauma').prop('checked', true);
            }else{
              $('#{{ $viewFolder }}_past_med_history_trauma').prop('checked', false);
            }
            if(jQuery.inArray('Asthma', JSON.parse(patientObj.pastMedicalHistory)) !== -1){
              $('#{{ $viewFolder }}_past_med_history_asthma').prop('checked', true);
            }else{
              $('#{{ $viewFolder }}_past_med_history_asthma').prop('checked', false);
            }
            if(jQuery.inArray('Cancer', JSON.parse(patientObj.pastMedicalHistory)) !== -1){
              $('#{{ $viewFolder }}_past_med_history_cancer').prop('checked', true);
              $('#{{ $viewFolder }}_past_med_history_cancer_text').prop('disabled', false);
              $('#{{ $viewFolder }}_past_med_history_cancer_text').val(patientObj.pastMedicalHistoryCancer);
            }else{
              $('#{{ $viewFolder }}_past_med_history_cancer').prop('checked', false);
              $('#{{ $viewFolder }}_past_med_history_cancer_text').prop('disabled', true);
                $('#{{ $viewFolder }}_past_med_history_cancer_text').val('');
            }
            if(jQuery.inArray('Others', JSON.parse(patientObj.pastMedicalHistory)) !== -1){
              $('#{{ $viewFolder }}_past_med_history_other').prop('checked', true);
              $('#{{ $viewFolder }}_past_med_history_other_text').prop('disabled', false);
              $('#{{ $viewFolder }}_past_med_history_other_text').val(patientObj.pastMedicalHistoryOthers);
            }else{
              $('#{{ $viewFolder }}_past_med_history_other').prop('checked', false);
              $('#{{ $viewFolder }}_past_med_history_other_text').prop('disabled', true);
                $('#{{ $viewFolder }}_past_med_history_other_text').val('');
            }
            $('#{{ $viewFolder }}_pastSurgicalHistory').val(patientObj.pastSurgicalHistory);
            if(jQuery.inArray('Diabetes', JSON.parse(patientObj.pastFamilyHistory)) !== -1){
              $('#{{ $viewFolder }}_past_family_history_diabetes').prop('checked', true);
            }else{
              $('#{{ $viewFolder }}_past_family_history_diabetes').prop('checked', false);
            }
            if(jQuery.inArray('Hypertension', JSON.parse(patientObj.pastFamilyHistory)) !== -1){
              $('#{{ $viewFolder }}_past_family_history_hypertension').prop('checked', true);
            }else{
              $('#{{ $viewFolder }}_past_family_history_hypertension').prop('checked', false);
            }
            if(jQuery.inArray('Heart Disease', JSON.parse(patientObj.pastFamilyHistory)) !== -1){
              $('#{{ $viewFolder }}_past_family_history_heart').prop('checked', true);
            }else{
              $('#{{ $viewFolder }}_past_family_history_heart').prop('checked', false);
            }
            if(jQuery.inArray('Thyroid Disease', JSON.parse(patientObj.pastFamilyHistory)) !== -1){
              $('#{{ $viewFolder }}_past_family_history_thyroid').prop('checked', true);
            }else{
              $('#{{ $viewFolder }}_past_family_history_thyroid').prop('checked', false);
            }
            if(jQuery.inArray('Trauma, Accident', JSON.parse(patientObj.pastFamilyHistory)) !== -1){
              $('#{{ $viewFolder }}_past_family_history_trauma').prop('checked', true);
            }else{
              $('#{{ $viewFolder }}_past_family_history_trauma').prop('checked', false);
            }
            if(jQuery.inArray('Asthma', JSON.parse(patientObj.pastFamilyHistory)) !== -1){
              $('#{{ $viewFolder }}_past_family_history_asthma').prop('checked', true);
            }else{
              $('#{{ $viewFolder }}_past_family_history_asthma').prop('checked', false);
            }
            if(jQuery.inArray('Cancer', JSON.parse(patientObj.pastFamilyHistory)) !== -1){
              $('#{{ $viewFolder }}_past_family_history_cancer').prop('checked', true);
              $('#{{ $viewFolder }}_past_family_history_cancer_text').prop('disabled', false);
              $('#{{ $viewFolder }}_past_family_history_cancer_text').val(patientObj.pastFamilyHistoryCancer);
            }else{
              $('#{{ $viewFolder }}_past_family_history_cancer').prop('checked', false);
              $('#{{ $viewFolder }}_past_family_history_cancer_text').prop('disabled', true);
                $('#{{ $viewFolder }}_past_family_history_cancer_text').val('');
            }
            if(jQuery.inArray('Others', JSON.parse(patientObj.pastFamilyHistory)) !== -1){
              $('#{{ $viewFolder }}_past_family_history_other').prop('checked', true);
              $('#{{ $viewFolder }}_past_family_history_other_text').prop('disabled', false);
              $('#{{ $viewFolder }}_past_family_history_other_text').val(patientObj.pastFamilyHistoryOthers);
            }else{
              $('#{{ $viewFolder }}_past_family_history_other').prop('checked', false);
              $('#{{ $viewFolder }}_past_family_history_other_text').prop('disabled', true);
                $('#{{ $viewFolder }}_past_family_history_other_text').val('');
            }
            $('#{{ $viewFolder }}_pastMedication').val(patientObj.pastMedication);
            $('#{{ $viewFolder }}_presentMedication').val(patientObj.presentMedication);
            if(jQuery.inArray('Food', JSON.parse(patientObj.allergies)) !== -1){
              $('#{{ $viewFolder }}_allergies_food').prop('checked', true);
              $('#{{ $viewFolder }}_allergies_food_text').prop('disabled', false);
              $('#{{ $viewFolder }}_allergies_food_text').val(patientObj.pastFamilyHistoryCancer);
            }else{
              $('#{{ $viewFolder }}_allergies_food').prop('checked', false);
              $('#{{ $viewFolder }}_allergies_food_text').prop('disabled', true);
              $('#{{ $viewFolder }}_allergies_food_text').val('');
            }
            if(jQuery.inArray('Medicine', JSON.parse(patientObj.allergies)) !== -1){
              $('#{{ $viewFolder }}_allergies_medicine').prop('checked', true);
              $('#{{ $viewFolder }}_allergies_medicine_text').prop('disabled', false);
              $('#{{ $viewFolder }}_allergies_medicine_text').val(patientObj.pastFamilyHistoryCancer);
            }else{
              $('#{{ $viewFolder }}_allergies_medicine').prop('checked', false);
              $('#{{ $viewFolder }}_allergies_medicine_text').prop('disabled', true);
              $('#{{ $viewFolder }}_allergies_medicine_text').val('');
            }
            if(jQuery.inArray('Others', JSON.parse(patientObj.allergies)) !== -1){
              $('#{{ $viewFolder }}_allergies_others').prop('checked', true);
              $('#{{ $viewFolder }}_allergies_others_text').prop('disabled', false);
              $('#{{ $viewFolder }}_allergies_others_text').val(patientObj.pastFamilyHistoryCancer);
            }else{
              $('#{{ $viewFolder }}_allergies_others').prop('checked', false);
              $('#{{ $viewFolder }}_allergies_others_text').prop('disabled', true);
              $('#{{ $viewFolder }}_allergies_others_text').val('');
            }
            $('#{{ $viewFolder }}_vaccination').val(patientObj.vaccination);
            $('#{{ $viewFolder }}_medHistoryOthers').val(patientObj.medHistoryOthers);
          }
      });
    });
    
    $('body').on('click', '#action-icon', function(evt){
        var divName = this.value;
        var fileName = $(this).attr('role');
        if($(this).attr('saved') != ''){
          $.ajax({
            type: 'GET',
            url: '{{ Route::has($viewFolder . '.deleteUploadedFile') ? route($viewFolder . '.deleteUploadedFile') : ''}}/' + $(this).attr('saved')
          });
        }
          
        $(`#${divName}`).remove();
      
        for (var i = 0; i < fileArr.length; i++) {
          if (fileArr[i].name === fileName) {
            fileArr.splice(i, 1);
          }
        }
      document.getElementById('{{ $viewFolder }}_files').files = FileListItem(fileArr);
        evt.preventDefault();
    });

    $('body').on('click', '#action-icon-nurse', function(evt){
        var divName = this.value;
        var fileName = $(this).attr('role');
        if($(this).attr('saved') != ''){
          $.ajax({
            type: 'GET',
            url: '{{ Route::has($viewFolder . '.deleteUploadedNurseFile') ? route($viewFolder . '.deleteUploadedNurseFile') : ''}}/' + $(this).attr('saved')
          });
        }
          
        $(`#${divName}`).remove();
      
        for (var i = 0; i < fileArr.length; i++) {
          if (fileArr[i].name === fileName) {
            fileArr.splice(i, 1);
          }
        }
      document.getElementById('{{ $viewFolder }}_nurse_files').files = FileListItem(fileArr);
        evt.preventDefault();
    });
    
    
  });
  
  @if(isset($datum->id) && !isset($datum->consultation_parent_id) && !isset($referal_conso))
  $('#{{ $viewFolder }}_referal').flexdatalist({
    url:'{{ Route::has($viewFolder . '.getReferralList') ? route($viewFolder . '.getReferralList', [$dateBooking, $doctor->id, ($datum->booking_type == "" ? "Consultation" : $datum->booking_type)]) : ''}}/',
    data: {},
    selectionRequired: 1,
    searchContain:true,
    multiple:true,
    minLength: 3,
    maxShownResults: 1000000,
    searchIn: 'name',
    requestType: 'get',
    dataType: 'json'
  });
  @else
  $('.flexdatalist').flexdatalist({
      selectionRequired: 1,
      searchContain:true,
      multiple:true,
      minLength: 3
  });
  @endif
  

  </script>




