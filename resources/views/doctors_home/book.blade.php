@php
  // unset($referal_conso);
  // $clinicDat = $datum->clinic->id;
  // $doctorDat = $datum->doctor->id;
  // $key = false;
  // if(isset($datum->parent_consultation)){
  //   $referal_conso = $datum;
  //   $datum = $datum->parent_consultation;
  //   $key = true;
  // }
  
    
  // print($clinicDat) . '<br>';
  // print($datum->doctor_id) . '<br>';
  // print($user->id);
@endphp

<datalist id="icdCodeList"></datalist>

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-lg-6"> 
          <div class="card mb-3">
            <div class="card-header">Basic Information</div>
            <div class="card-body">
              <img src="{{ !empty($datum->patient->profile_pic) ? (stristr($datum->patient->profile_pic, 'uploads') ? asset('storage/' . $datum->patient->profile_pic) : asset('storage/px_files/' . $datum->patient->profile_pic)) : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" class="img-thumbnail float-start w-25 h-25 m-2" alt="">
              <p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <strong>Name:</strong> {{ $datum->patient->name }} | 
                <strong>Age:</strong> {{ floor((strtotime($datum->bookingDate) - strtotime($datum->patient->birthdate))/(60*60*24*365.25)) }} | 
                <strong>Birthday:</strong> {{ $datum->patient->birthdate }} | 
                <strong>Gender:</strong> {{ $datum->patient->gender }}<br>
                <strong>Address:</strong> {{ $datum->patient->address }}<br>
                <strong>Email:</strong> {{ $datum->patient->email }} | 
                <strong>Mobile #:</strong> {{ $datum->patient->mobile_no }}<br>
                <strong>Patient Type:</strong> {{ $datum->patient->patient_type }} | 
                <strong>Patient Sub Type: </strong>{{ $datum->patient->patient_sub_type . ' ' . $datum->patient->referral_from }}<br>
                <strong>Philhealth #: </strong>{{ $datum->patient->phil_num }}<br>
                <strong>HMO:</strong> {{ $datum->patient->hmo }} | 
                <strong>HMO #:</strong> {{ $datum->patient->hmo_num }}<br>
              </p>
              <div class="form-floating mb-3">
                <textarea class="form-control" name="{{ $viewFolder }}[Patient][notes]" id="{{ $viewFolder }}_notes" rows=3>{{ !empty($datum->patient->notes) ? $datum->patient->notes : '' }}</textarea>
                <label for="{{ $viewFolder }}_notes" class="form-label">Notes</label>
                <small id="help_{{ $viewFolder }}_notes" class="text-muted">Add notes following this format: yyyy-mm-dd - details. The latest on the top.</small>
              </div>
            </div>
          </div>
          <div class="card mb-3 d-none d-lg-block">
            <div class="card-header">Booking History</div>
            <div class="card-body table-responsive" style="max-height: 300px">
              <table class="table table-bordered table-striped table-hover table-sm">
                <thead class="table-{{ $bgColor }}">
                    <tr>
                        <th class=""><i class="bi bi-gear"></i></th>
                        <th>Date</th>
                        <th>Booking Type</th>
                        <th>Procedure Details</th>
                    </tr>
                </thead>
                <tbody>
                  @php
                    $bookings = $datum->patient->consultations()->where('doctor_id', $user->id)->where('bookingDate', '<', $datum->bookingDate)->orderByDesc('bookingDate')->get();
                    // print "<pre>";
                    // print_r($bookings->icd_code_obj->icd_code);
                    // print "</pre>";  
                  @endphp
                  @foreach($bookings as $ind=>$dat)
                    <tr>
                      <td>
                        <div class="d-sm-flex flex-sm-row">
                          <div class="m-1"><a class="btn btn-{{ $bgColor }} btn-sm w-100" href="#" title="View" role="button" onclick="loadPrevBooking({{ $dat->id }}, {{ $ind }})"><i class="bi bi-binoculars"></i><span class="ps-1 d-sm-none">View</span></a></div>
                        </div>
                      </td>
                      <td>{{ $dat->bookingDate }}</td>
                      <td>{{ $dat->booking_type == '' ? 'Consultation' : $dat->booking_type }}</td>
                      {{-- <td>{{ $dat->patient->name }}</td> --}}
                      <td>{{ $dat->procedure_details }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          {{-- <div class="card mb-3">
            <div class="card-header">Patient's Basic Info</div>
            <div class="card-body">
              <div class="mb-4 d-flex justify-content-center">
                <img id="{{ $viewFolder }}_profileImage" src="{{ !empty($datum->patient->profile_pic) ? (stristr($datum->patient->profile_pic, 'uploads') ? asset('storage/' . $datum->patient->profile_pic) : asset('storage/px_files/' . $datum->patient->profile_pic)) : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" alt="example placeholder" class="img-thumbnail w-25 h-25 m-2" />
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
                <input class="form-control" type="date" name="{{ $viewFolder }}[Patient][birthdate]" id="{{ $viewFolder }}_birthdate" placeholder="" value="{{ !empty($datum->patient->birthdate) ? $datum->patient->birthdate : '' }}" required onchange="
                    $('{{ $viewFolder }}_age').val()
                  "">
                <label for="{{ $viewFolder }}_birthdate" class="form-label">Birth Date</label>
                <small id="help_{{ $viewFolder }}_birthdate" class="text-muted"></small>
              </div>
              <div class="form-floating mb-3">
                <input class="form-control" type="text" name="{{ $viewFolder }}[Patient][age]" id="{{ $viewFolder }}_age" placeholder="" value="{{ floor((strtotime($datum->bookingDate) - strtotime($datum->patient->birthdate))/(60*60*24*365.25)) }}" disabled>
                <label for="{{ $viewFolder }}_age" class="form-label">Age</label>
                <small id="help_{{ $viewFolder }}_age" class="text-muted"></small>
              </div>
              <div class="form-floating mb-3">
                <input class="form-control" type="text" name="{{ $viewFolder }}[Patient][phil_num]" id="{{ $viewFolder }}_phil_num" placeholder="" value="{{ !empty($datum->patient->phil_num) ? $datum->patient->phil_num : '' }}" {{ isset($datum->payment_mode) && ($datum->payment_mode == 'Both' || $datum->payment_mode == 'Both Cash' || $datum->payment_mode == 'Philhealth') ? '' : '' }}>
                <label for="{{ $viewFolder }}_phil_num" class="form-label">Philhealth #</label>
                <small id="help_{{ $viewFolder }}_phil_num" class="text-muted"></small>
              </div>
              <div class="form-floating mb-3">
                <select class="form-select" name="{{ $viewFolder }}[Patient][hmo]" id="{{ $viewFolder }}_hmo" placeholder="" {{ isset($datum->payment_mode) && ($datum->payment_mode == 'Both' || $datum->payment_mode == 'Both Cash' || $datum->payment_mode == 'HMO') ? '' : '' }}>
                  <option value=""></option>
                @foreach($selectItems['hmos'] as $hmo)
                  <option value="{{ $hmo->id }}" {{ !empty($datum->patient->hmo) && $hmo->id == $datum->patient->hmo ? 'selected' : '' }}>{{ $hmo->name }}</option>
                @endforeach
                </select>
                <label for="{{ $viewFolder }}_hmo">HMO</label>
                <small id="help_{{ $viewFolder }}_hmo" class="text-muted"></small>
              </div>
              <div class="form-floating mb-3">
                <input class="form-control" type="text" name="{{ $viewFolder }}[Patient][hmo_num]" id="{{ $viewFolder }}_hmo_num" placeholder="" value="{{ !empty($datum->patient->hmo_num) ? $datum->patient->hmo_num : '' }}" {{ isset($datum->payment_mode) && ($datum->payment_mode == 'Both' || $datum->payment_mode == 'Both Cash' || $datum->payment_mode == 'HMO') ? '' : '' }}>
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
              <div class="form-floating mb-3">
                <textarea class="form-control" name="{{ $viewFolder }}[Patient][notes]" id="{{ $viewFolder }}_notes" rows=3>{{ !empty($datum->patient->notes) ? $datum->patient->notes : '' }}</textarea>
                <label for="{{ $viewFolder }}_notes" class="form-label">Notes</label>
                <small id="help_{{ $viewFolder }}_notes" class="text-muted">Add notes following this format: yyyy-mm-dd - details. The latest on the top.</small>
              </div>
            </div>
          </div> --}}
        </div>
        <div class="col-lg-6">
          <div class="card mb-3">
            <div class="card-header">Patient's Medical History</div>
            <div class="card-body table-responsive" style="max-height: 760px">
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
  <div class="row">
    <div class="col-lg-12 d-none d-md-block">
      
    </div>
    {{-- <div class="col-lg-6">
      <div class="card mb-3">
        <div class="card-header">Medical History</div>
        <div class="card-body">
          <p>
            <strong>Past Medical History:</strong> {{ $datum->patient->pastMedicalHistory }}<br>
            @if(is_array(json_decode($datum->patient->pastMedicalHistory)) && in_array('Cancer', json_decode($datum->patient->pastMedicalHistory)))
            <strong>Cancer Details:</strong> {{ $datum->patient->pastMedicalHistoryCancer }}<br>
            @endif
            @if(is_array(json_decode($datum->patient->pastMedicalHistory)) && in_array('Others', json_decode($datum->patient->pastMedicalHistory)))
            <strong>Others Details:</strong> {{ $datum->patient->pastMedicalHistoryOthers }}<br>
            @endif
            <strong>Past Surgical History and Date:</strong> {{ $datum->patient->pastSurgicalHistory }}<br>
            <strong>Family History:</strong> {{ $datum->patient->pastFamilyHistory }}<br>
            @if(is_array(json_decode($datum->patient->pastFamilyHistory)) && in_array('Cancer', json_decode($datum->patient->pastFamilyHistory)))
            <strong>Cancer Details:</strong> {{ $datum->patient->pastFamilyHistoryCancer }}<br>
            @endif
            @if(is_array(json_decode($datum->patient->pastFamilyHistory)) && in_array('Others', json_decode($datum->patient->pastFamilyHistory)))
            <strong>Others Details:</strong> {{ $datum->patient->pastFamilyHistoryOthers }}<br>
            @endif
            <strong>Past Medication:</strong> {{ $datum->patient->pastMedication }}<br>
            <strong>Present Medication:</strong> {{ $datum->patient->presentMedication }}<br>
            <strong>Allergies:</strong> {{ $datum->patient->allergies }}<br>
            @if(isset($datum->patient->allergies) && is_array(json_decode($datum->patient->allergies)) && in_array('Food', json_decode($datum->patient->allergies)))
            <strong>Food Allergies:</strong> {{ $datum->patient->allergiesFood }}<br>
            @endif
            @if(isset($datum->patient->allergies) && is_array(json_decode($datum->patient->allergies)) && in_array('Medicine', json_decode($datum->patient->allergies)))
            <strong>Medicine Allergies:</strong> {{ $datum->patient->allergiesMedicine }}<br>
            @endif
            @if(isset($datum->patient->allergies) && is_array(json_decode($datum->patient->allergies)) && in_array('Others', json_decode($datum->patient->allergies)))
            <strong>Other Allergies:</strong> {{ $datum->patient->allergiesOthers }}<br>
            @endif
          </p>
        </div>
      </div>
    </div> --}}
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="card mb-3 d-xs-block d-lg-none">
        <div class="card-header">Booking History</div>
        <div class="card-body table-responsive" style="max-height: 300px">
          <table class="table table-bordered table-striped table-hover table-sm">
            <thead class="table-{{ $bgColor }}">
                <tr>
                    <th class=""><i class="bi bi-gear"></i></th>
                    <th>Date</th>
                    <th>Booking Type</th>
                    <th>Procedure Details</th>
                </tr>
            </thead>
            <tbody>
              @php
                $bookings = $datum->patient->consultations()->where('doctor_id', $user->id)->where('bookingDate', '<', $datum->bookingDate)->orderByDesc('bookingDate')->get();
                // print "<pre>";
                // print_r($bookings->icd_code_obj->icd_code);
                // print "</pre>";  
              @endphp
              @foreach($bookings as $ind=>$dat)
                <tr>
                  <td>
                    <div class="d-sm-flex flex-sm-row">
                      <div class="m-1"><a class="btn btn-{{ $bgColor }} btn-sm w-100" href="#" title="View" role="button" onclick="loadPrevBooking({{ $dat->id }}, {{ $ind }})"><i class="bi bi-binoculars"></i><span class="ps-1 d-sm-none">View</span></a></div>
                    </div>
                  </td>
                  <td>{{ $dat->bookingDate }}</td>
                  <td>{{ $dat->booking_type == '' ? 'Consultation' : $dat->booking_type }}</td>
                  {{-- <td>{{ $dat->patient->name }}</td> --}}
                  <td>{{ $dat->procedure_details }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <ul class="nav nav-pills mb-3 d-xs-block d-lg-none">
        <li class="nav-item">
          <a class="nav-link chartTab" href="#" onclick="
            $('.chartTab').each(function(){
              $(this).removeClass('active');
            });
            $(this).addClass('active');
            $('#pastChart').show();
            $('#pastChart').removeClass('d-none');
            $('#pastChart').removeClass('d-lg-block');
            $('#curChart').hide();
          ">Previous Patient's Chart</a>
        </li>
        <li class="nav-item">
          <a class="nav-link chartTab active" href="#" onclick="
            $('.chartTab').each(function(){
              $(this).removeClass('active');
            });
            $(this).addClass('active');
            $('#pastChart').hide();
            $('#pastChart').addClass('d-none');
            $('#pastChart').addClass('d-lg-block');
            $('#curChart').show();
          ">Current Patient's Chart</a>
        </li>
      </ul>
      @if(isset($bookings[0]))
      <div id="pastChart" class="card mb-3 d-none d-lg-block">
        <div class="card-header">Past Patient's Chart (<span id="prevBookingDater">{{ $bookings[0]->bookingDate }}</span>)</div>
        <div class="card-body">
          <div class="card mb-3">
            <div class="card-header">Vitals</div>
            <div class="card-body">
              <p id="prevVitaler">
                <strong>Temp:</strong> <span class="text-primary">{{ $bookings[0]->temp }}C</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>Height:</strong> <span class="text-primary">{{ $bookings[0]->height }}cm</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>Weight:</strong> <span class="text-primary">{{ $bookings[0]->weight }}kg</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>BMI:</strong> <span class="text-primary">{{ (isset($bookings[0]->height) && (int)$bookings[0]->height != 0) ? number_format((int)$bookings[0]->weight/(((int)$bookings[0]->height/100)*((int)$bookings[0]->height/100)), 0) : '' }}</span><br>
                <strong>BP:</strong> <span class="text-primary">{{ $bookings[0]->bpS }}/{{ $bookings[0]->bpD }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>O2 Sat:</strong> <span class="text-primary">{{ $bookings[0]->o2 }}%</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>Heart Rate:</strong> <span class="text-primary">{{ $bookings[0]->heart }}beats/min</span>
              </p>
            </div>
          </div>
          <ul class="nav nav-pills mb-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">{{ $user->name == $bookings[0]->doctor->name ? 'Yours' : 'Dr. ' . Str::substr($bookings[0]->doctor->f_name, 0, 1) . '. ' . $bookings[0]->doctor->l_name }}</a>
            </li>
          </ul>
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" id="sumPrevLink" href="#" onclick="
                $('#sumPrevLink').addClass('active');  
                $('#soapPrevLink').removeClass('active');  
                $('#labPrevLink').removeClass('active');  
                $('#presPrevLink').removeClass('active');  
                $('#medPrevLink').removeClass('active');  
                $('#admitPrevLink').removeClass('active');
                $('#sumPrevDiv').show();  
                $('#soapPrevDiv').hide();  
                $('#labPrevDiv').hide();  
                $('#presPrevDiv').hide();  
                $('#medPrevDiv').hide();  
                $('#admitPrevDiv').hide();
                $('#sumCurLink').addClass('active');  
                $('#soapCurLink').removeClass('active');  
                $('#labCurLink').removeClass('active');  
                $('#presCurLink').removeClass('active');  
                $('#medCurLink').removeClass('active');  
                $('#admitCurLink').removeClass('active');
                $('#sumCurDiv').show();  
                $('#soapCurDiv').hide();  
                $('#labCurDiv').hide();  
                $('#presCurDiv').hide();  
                $('#medCurDiv').hide();  
                $('#admitCurDiv').hide();
              ">Summary</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="soapPrevLink" href="#" onclick="
                $('#soapPrevLink').addClass('active');  
                $('#sumPrevLink').removeClass('active');  
                $('#labPrevLink').removeClass('active');  
                $('#presPrevLink').removeClass('active');  
                $('#medPrevLink').removeClass('active');  
                $('#admitPrevLink').removeClass('active');
                $('#soapPrevDiv').show();  
                $('#sumPrevDiv').hide();  
                $('#labPrevDiv').hide();  
                $('#presPrevDiv').hide();  
                $('#medPrevDiv').hide();  
                $('#admitPrevDiv').hide();
                $('#soapCurLink').addClass('active');  
                $('#sumCurLink').removeClass('active');  
                $('#labCurLink').removeClass('active');  
                $('#presCurLink').removeClass('active');  
                $('#medCurLink').removeClass('active');  
                $('#admitCurLink').removeClass('active');
                $('#soapCurDiv').show();  
                $('#sumCurDiv').hide();  
                $('#labCurDiv').hide();  
                $('#presCurDiv').hide();  
                $('#medCurDiv').hide();  
                $('#admitCurDiv').hide();
              ">SOAP</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="labPrevLink" href="#" onclick="
                $('#sumPrevLink').removeClass('active');
                $('#soapPrevLink').removeClass('active');
                $('#labPrevLink').addClass('active');  
                $('#presPrevLink').removeClass('active');  
                $('#medPrevLink').removeClass('active');  
                $('#admitPrevLink').removeClass('active');
                $('#sumPrevDiv').hide();  
                $('#soapPrevDiv').hide();  
                $('#labPrevDiv').show();  
                $('#presPrevDiv').hide();  
                $('#medPrevDiv').hide();  
                $('#admitPrevDiv').hide();
                $('#sumCurLink').removeClass('active');
                $('#soapCurLink').removeClass('active');
                $('#labCurLink').addClass('active');  
                $('#presCurLink').removeClass('active');  
                $('#medPCurLink').removeClass('active');  
                $('#admitCurLink').removeClass('active');
                $('#sumCurDiv').hide();  
                $('#soapCurDiv').hide();  
                $('#labCurDiv').show();  
                $('#presCurDiv').hide();  
                $('#medCurDiv').hide();  
                $('#admitCurDiv').hide();
              ">File Uploads</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="presPrevLink" href="#" onclick="
                $('#sumPrevLink').removeClass('active');
                $('#soapPrevLink').removeClass('active');
                $('#labPrevLink').removeClass('active');  
                $('#presPrevLink').addClass('active');  
                $('#medPrevLink').removeClass('active');  
                $('#admitPrevLink').removeClass('active');
                $('#sumPrevDiv').hide();  
                $('#soapPrevDiv').hide();  
                $('#labPrevDiv').hide();  
                $('#presPrevDiv').show();  
                $('#medPrevDiv').hide();  
                $('#admitPrevDiv').hide();
                $('#sumCurLink').removeClass('active');
                $('#soapCurLink').removeClass('active');
                $('#labCurLink').removeClass('active');  
                $('#presCurLink').addClass('active');  
                $('#medCurLink').removeClass('active');  
                $('#admitCurLink').removeClass('active');
                $('#sumCurDiv').hide();  
                $('#soapCurDiv').hide();  
                $('#labCurDiv').hide();  
                $('#presCurDiv').show();  
                $('#medCurDiv').hide();  
                $('#admitCurDiv').hide();
              ">E-Prescription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="medPrevLink" href="#" onclick="
                $('#sumPrevLink').removeClass('active');
                $('#soapPrevLink').removeClass('active');
                $('#labPrevLink').removeClass('active');  
                $('#presPrevLink').removeClass('active');  
                $('#medPrevLink').addClass('active');  
                $('#admitPrevLink').removeClass('active');
                $('#sumPrevDiv').hide();  
                $('#soapPrevDiv').hide();  
                $('#labPrevDiv').hide();  
                $('#presPrevDiv').hide();  
                $('#medPrevDiv').show();  
                $('#admitPrevDiv').hide();
                $('#sumCurLink').removeClass('active');
                $('#soapCurLink').removeClass('active');
                $('#labCurLink').removeClass('active');  
                $('#presCurLink').removeClass('active');  
                $('#medCurLink').addClass('active');  
                $('#admitCurLink').removeClass('active');
                $('#sumCurDiv').hide();  
                $('#soapCurDiv').hide();  
                $('#labCurDiv').hide();  
                $('#presCurDiv').hide();  
                $('#medCurDiv').show();  
                $('#admitCurDiv').hide();
              ">Med Cert</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="admitPrevLink" href="#" onclick="
                $('#sumPrevLink').removeClass('active');
                $('#soapPrevLink').removeClass('active');
                $('#labPrevLink').removeClass('active');  
                $('#presPrevLink').removeClass('active');  
                $('#medPrevLink').removeClass('active');
                $('#admitPrevLink').addClass('active'); 
                $('#sumPrevDiv').hide();  
                $('#soapPrevDiv').hide();  
                $('#labPrevDiv').hide();  
                $('#presPrevDiv').hide();  
                $('#medPrevDiv').hide(); 
                $('#admitPrevDiv').show();  
                $('#sumCurLink').removeClass('active');
                $('#soapCurLink').removeClass('active');
                $('#labCurLink').removeClass('active');  
                $('#presCurLink').removeClass('active');  
                $('#medCurLink').removeClass('active');
                $('#admitCurLink').addClass('active'); 
                $('#sumCurDiv').hide();  
                $('#soapCurDiv').hide();  
                $('#labCurDiv').hide();  
                $('#presCurDiv').hide();  
                $('#medCurDiv').hide(); 
                $('#admitCurDiv').show();  
              ">Admitting Orders</a>
            </li>
          </ul>
          <div id="sumPrevDiv" class="container border border-1 border-top-0 mb-3 p-3">
            <div class="card mb-3">
              <div class="card-header">Scheduled Procedure</div>
              <div class="card-body" style="height: 1in; max-height: 1in">
                <p id="prevSumProcDet">{{ $bookings[0]->procedure_details }}</p>
              </div>
            </div>
            <div class="card mb-3">
              <div class="card-header">Patient's Complaint</div>
              <div class="card-body" style="height: 1in; max-height: 1in">
                <p id="prevSumPatComp">{{ $bookings[0]->complain }}</p>
                <small id="prevSumPatCompDur" class="text-muted">{{ $bookings[0]->duration }}</small>
              </div>
            </div>
            @if(stristr($datum->doctor->specialty, 'Ophtha'))
            <div class="card mb-3">
              <div class="card-header">Eye Examination Information</div>
              <div class="card-body">
                <p id="prevEyerSum">
                  <strong>AR OD:</strong> <span class="text-primary">{{ $bookings[0]->arod_sphere != 'No Target' ? ($bookings[0]->arod_sphere) . ' - ' . ($bookings[0]->arod_cylinder) . ' x ' . $bookings[0]->arod_axis : 'No Refraction Possible' }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                  <strong>AR OS:</strong> <span class="text-primary">{{ $bookings[0]->aros_sphere != 'No Target' ? ($bookings[0]->aros_sphere) . ' - ' . ($bookings[0]->aros_cylinder) . ' x ' . $bookings[0]->aros_axis : 'No Refraction Possible' }}</span><br>
                  <strong>UCVA OD:</strong> <span class="text-primary">{{ $bookings[0]->vaod_den != '' ? $bookings[0]->vaod_num . ' / ' . $bookings[0]->vaod_den : $bookings[0]->vaod_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                  <strong>UCVA OD Present Correction:</strong> <span class="text-primary">{{ $bookings[0]->vaodcor_den != '' ? $bookings[0]->vaodcor_num . ' / ' . $bookings[0]->vaodcor_den : $bookings[0]->vaodcor_num }}</span><br>
                  <strong>UCVA OS:</strong> <span class="text-primary">{{ $bookings[0]->vaos_den != '' ? $bookings[0]->vaos_num . ' / ' . $bookings[0]->vaos_den : $bookings[0]->vaos_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                  <strong>UCVA OS Present Correction:</strong> <span class="text-primary">{{ $bookings[0]->vaoscor_den != '' ? $bookings[0]->vaoscor_num . ' / ' . $bookings[0]->vaoscor_den : $bookings[0]->vaoscor_num }}</span><br>
                  <strong>VA OD Pinhole:</strong> <span class="text-primary">{{ $bookings[0]->pinod_den != '' ? $bookings[0]->pinod_num . ' / ' . $bookings[0]->pinod_den : $bookings[0]->pinod_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                  <strong>BCVA OD:</strong> <span class="text-primary">{{ $bookings[0]->pinodcor_den != '' ? $bookings[0]->pinodcor_num . ' / ' . $bookings[0]->pinodcor_den : $bookings[0]->pinodcor_num }}</span><br>
                  <strong>VA OS Pinhole:</strong> <span class="text-primary">{{ $bookings[0]->pinos_den != '' ? $bookings[0]->pinos_num . ' / ' . $bookings[0]->pinos_den : $bookings[0]->pinos_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                  <strong>BCVA OS:</strong> <span class="text-primary">{{ $bookings[0]->pinoscor_den != '' ? $bookings[0]->pinoscor_num . ' / ' . $bookings[0]->pinoscor_den : $bookings[0]->pinoscor_num }}</span><br>
                  <strong>Jaeger OU:</strong> <span class="text-primary">{{ $bookings[0]->jae_ou }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                  <strong>Jaeger OD:</strong> <span class="text-primary">{{ $bookings[0]->jae_od }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                  <strong>Jaeger OS:</strong> <span class="text-primary">{{ $bookings[0]->jae_os }}</span><br>
                  <strong>IOP OD:</strong> <span class="text-primary">{{ $bookings[0]->iopod }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                  <strong>IOP OS:</strong> <span class="text-primary">{{ $bookings[0]->iopos }}</span>
                </p>
              </div>
            </div>
            @endif
            <div class="card mb-3">
              <div class="card-header">Doctor's Notes</div>
              <div class="card-body table-responsive" style="height:300px; max-height: 300px">
                <p>
                  <strong>History of Present Illness:</strong><div class="m-3" id="{{ $viewFolder }}_prev_sum_docNotesHPI">{!! nl2br(isset($bookings[0]->docNotesHPI) ? $bookings[0]->docNotesHPI : '') !!}</div><br>
                  <strong>Subjective Complaints:</strong><br><div class="m-3" id="{{ $viewFolder }}_prev_sum_docNotesSubject">{!! nl2br(isset($bookings[0]->docNotesSubject) ? $bookings[0]->docNotesSubject : '') !!}</div><br>
                  <strong>Objective Findings:</strong><br><div class="m-3" id="{{ $viewFolder }}_prev_sum_docNotes">{!! nl2br(isset($bookings[0]->docNotes) ? $bookings[0]->docNotes : '') !!}</div><br>
                </p>
              </div>
            </div>
            <div class="card mb-3">
              <div class="card-header">Assessment</div>
              <div class="card-body table-responsive" style="height:300px; max-height: 300px">
                <p>
                  <strong>Primary Diagnosis:</strong> <span id="{{ $viewFolder }}_prev_sum_icd_code">{!! nl2br(isset($bookings[0]->icd_code_obj) ? $bookings[0]->icd_code_obj->icd_code . ' - ' . $bookings[0]->icd_code_obj->details : '') !!}</span><br>
                  <strong>Secondary Diagnosis:</strong><br><div class="m-3" id="{{ $viewFolder }}_prev_sum_assessment">{!! nl2br(isset($bookings[0]->assessment) ? $bookings[0]->assessment : '') !!}</div><br>
                </p>
              </div>
            </div>
            <div class="card mb-3">
              <div class="card-header">Plan</div>
              <div class="card-body table-responsive" style="height:300px; max-height: 300px">
                <p>
                  <strong>Medical Therapeutics:</strong><br><div class="m-3" id="{{ $viewFolder }}_prev_sum_planMed">{!! nl2br(isset($bookings[0]->planMed) ? $bookings[0]->planMed : '') !!}</div><br>
                  <strong>Diagnostics and Surgery:</strong><br><div class="m-3" id="{{ $viewFolder }}_prev_sum_plan">{!! nl2br(isset($bookings[0]->plan) ? $bookings[0]->plan : '') !!}</div><br>
                  <strong>Remarks:</strong><br><div class="m-3" id="{{ $viewFolder }}_prev_sum_planRem">{!! nl2br(isset($bookings[0]->planRem) ? $bookings[0]->planRem : '') !!}</div><br>
                </p>
              </div>
            </div>
          </div>
          <div id="soapPrevDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            <div class="card mb-3">
              <div class="card-header">Previous Scheduled Procedure</div>
              <div class="card-body" style="height: 1in; max-height: 1in">
                <p id="prevProcDet">{{ $bookings[0]->procedure_details }}</p>
              </div>
            </div>
            <div class="card mb-3">
              <div class="card-header">Previous Patient's Complaint</div>
              <div class="card-body" style="height: 1in; max-height: 1in">
                <p id="prevPatComp">{{ $bookings[0]->complain }}</p>
                <small class="text-muted" id="prevPatCompDur">{{ $bookings[0]->duration }}</small>
              </div>
            </div>
            
            <div class="card mb-3">
              <div class="card-header">Previous Doctor's Notes</div>
              <div class="card-body">
                {{-- @if(sizeof($bookings) == 1) --}}
                <div class="card mb-3">
                  <div class="card-header">History of Present Illness</div>
                  <div class="card-body">
                    <small class="text-muted">Helper</small>
                    <div class="input-group input-group-small flex-nowrap">
                      <select class="form-select" placeholder="" disabled>
                        <option value=""></option>
                      </select>
                      <button class="btn btn-outline-secondary" type="button" id="button-addon2" disabled>Delete Helper</button>
                    </div>
                    <small class="text-muted">Content</small>
                    <textarea class="form-control" name="{{ $viewFolder }}[docNotesHPI]" id="{{ $viewFolder }}_prev_docNotesHPI" rows=3 disabled>{{ $bookings[0]->docNotesHPI }}</textarea>
                    <small class="text-muted">Helper Save/Edit</small>
                    <div class="input-group input-group-small mb-3 flex-nowrap">
                      <div class="input-group-text">
                        <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                      </div>
                      <input type="text" class="form-control" id="{{ $viewFolder }}_docNotesHPITitle" name="{{ $viewFolder }}[docNotesHPITitle]" disabled>
                      <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                    </div>
                    <textarea class="form-control mb-2" name="{{ $viewFolder }}[docNotesHPIEdit]" id="{{ $viewFolder }}_docNotesHPIEdit" rows=3 disabled></textarea>
                  </div>
                </div>
                {{-- @else --}}
                <div class="card mb-3">
                  <div class="card-header">Previous Subjective Complaints</div>
                  <div class="card-body">
                    <small class="text-muted">Helper</small>
                    <div class="input-group input-group-small flex-nowrap">
                      <select class="form-select" placeholder="" disabled>
                        <option value=""></option>
                      </select>
                      <button class="btn btn-outline-secondary" type="button" id="button-addon2" disabled>Delete Helper</button>
                    </div>
                    <small class="text-muted">Content</small>
                    <textarea class="form-control" name="{{ $viewFolder }}[docNotesSubject]" id="{{ $viewFolder }}_prev_docNotesSubject" rows=3 disabled>{{ $bookings[0]->docNotesSubject }}</textarea>
                    <small class="text-muted">Helper Save/Edit</small>
                    <div class="input-group input-group-small mb-3 flex-nowrap">
                      <div class="input-group-text">
                        <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                      </div>
                      <input type="text" class="form-control" id="{{ $viewFolder }}_docNotesSubjectTitle" name="{{ $viewFolder }}[docNotesSubjectTitle]" disabled>
                      <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                    </div>
                    <textarea class="form-control mb-2" name="{{ $viewFolder }}[ddocNotesSubjectEdit]" id="{{ $viewFolder }}_docNotesSubjectEdit" rows=3 disabled></textarea>
                  </div>
                </div>
                {{-- @endif --}}
                <div class="card mb-3">
                  <div class="card-header">Previous Objective Findings</div>
                  <div class="card-body">
                    @if(stristr($datum->doctor->specialty, 'Ophtha'))
                    <div class="card mb-3">
                      <div class="card-header">Eye Examination Information</div>
                      <div class="card-body">
                        <p id="prevEyer">
                          <strong>AR OD:</strong> <span class="text-primary">{{ $bookings[0]->arod_sphere != 'No Target' ? ($bookings[0]->arod_sphere) . ' - ' . ($bookings[0]->arod_cylinder) . ' x ' . $bookings[0]->arod_axis : 'No Refraction Possible' }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                          <strong>AR OS:</strong> <span class="text-primary">{{ $bookings[0]->aros_sphere != 'No Target' ? ($bookings[0]->aros_sphere) . ' - ' . ($bookings[0]->aros_cylinder) . ' x ' . $bookings[0]->aros_axis : 'No Refraction Possible' }}</span><br>
                          <strong>UCVA OD:</strong> <span class="text-primary">{{ $bookings[0]->vaod_den != '' ? $bookings[0]->vaod_num . ' / ' . $bookings[0]->vaod_den : $bookings[0]->vaod_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                          <strong>UCVA OD Present Correction:</strong> <span class="text-primary">{{ $bookings[0]->vaodcor_den != '' ? $bookings[0]->vaodcor_num . ' / ' . $bookings[0]->vaodcor_den : $bookings[0]->vaodcor_num }}</span><br>
                          <strong>UCVA OS:</strong> <span class="text-primary">{{ $bookings[0]->vaos_den != '' ? $bookings[0]->vaos_num . ' / ' . $bookings[0]->vaos_den : $bookings[0]->vaos_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                          <strong>UCVA OS Present Correction:</strong> <span class="text-primary">{{ $bookings[0]->vaoscor_den != '' ? $bookings[0]->vaoscor_num . ' / ' . $bookings[0]->vaoscor_den : $bookings[0]->vaoscor_num }}</span><br>
                          <strong>VA OD Pinhole:</strong> <span class="text-primary">{{ $bookings[0]->pinod_den != '' ? $bookings[0]->pinod_num . ' / ' . $bookings[0]->pinod_den : $bookings[0]->pinod_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                          <strong>BCVA OD:</strong> <span class="text-primary">{{ $bookings[0]->pinodcor_den != '' ? $bookings[0]->pinodcor_num . ' / ' . $bookings[0]->pinodcor_den : $bookings[0]->pinodcor_num }}</span><br>
                          <strong>VA OS Pinhole:</strong> <span class="text-primary">{{ $bookings[0]->pinos_den != '' ? $bookings[0]->pinos_num . ' / ' . $bookings[0]->pinos_den : $bookings[0]->pinos_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                          <strong>BCVA OS:</strong> <span class="text-primary">{{ $bookings[0]->pinoscor_den != '' ? $bookings[0]->pinoscor_num . ' / ' . $bookings[0]->pinoscor_den : $bookings[0]->pinoscor_num }}</span><br>
                          <strong>Jaeger OU:</strong> <span class="text-primary">{{ $bookings[0]->jae_ou }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                          <strong>Jaeger OD:</strong> <span class="text-primary">{{ $bookings[0]->jae_od }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                          <strong>Jaeger OS:</strong> <span class="text-primary">{{ $bookings[0]->jae_os }}</span><br>
                          <strong>IOP OD:</strong> <span class="text-primary">{{ $bookings[0]->iopod }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                          <strong>IOP OS:</strong> <span class="text-primary">{{ $bookings[0]->iopos }}</span>
                        </p>
                      </div>
                    </div>
                    @endif
                    <small class="text-muted">Helper</small>
                    <div class="input-group input-group-small flex-nowrap">
                      <select class="form-select" placeholder="" disabled>
                        <option value=""></option>
                      </select>
                      <button class="btn btn-outline-secondary" type="button" id="button-addon2" disabled>Delete Helper</button>
                    </div>
                    <small class="text-muted">Content</small>
                    <textarea class="form-control" name="{{ $viewFolder }}[docNotes]" id="{{ $viewFolder }}_prev_docNotes" rows=3 disabled>{{ $bookings[0]->docNotes }}</textarea>
                    <small class="text-muted">Helper Save/Edit</small>
                    <div class="input-group input-group-small mb-3 flex-nowrap">
                      <div class="input-group-text">
                        <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                      </div>
                      <input type="text" class="form-control" id="{{ $viewFolder }}_docNotesTitle" name="{{ $viewFolder }}[docNotesTitle]" disabled>
                      <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                    </div>
                    <textarea class="form-control mb-2" name="{{ $viewFolder }}[_docNotesEdit]" id="{{ $viewFolder }}_docNotesEdit" rows=3 disabled></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="card mb-3">
              <div class="card-header">Previous Assessment</div>
              <div class="card-body">
                <div class="form-floating mb-3">
                  {{-- <select class="form-select" name="{{ $viewFolder }}[icd_code]" id="{{ $viewFolder }}_icd_code" placeholder="" disabled>
                    <option value=""></option>
                  </select> --}}
                  <input class="form-control" list="icdCodeList" id="{{ $viewFolder }}_prev_icd_code" name="{{ $viewFolder }}[icd_code]" value="{{ isset($bookings[0]->icd_code_obj) ? $bookings[0]->icd_code_obj->icd_code . ' - ' . $bookings[0]->icd_code_obj->details : '' }}" autocomplete="off" disabled>
                  <label for="{{ $viewFolder }}_icd_code">Previous Primary Diagnosis</label>
                  <small id="help_{{ $viewFolder }}_icd_code" class="text-muted"></small>
                </div>
                <div class="card mb-3">
                  <div class="card-header">Previous Secondary Diagnosis</div>
                  <div class="card-body">
                    <small class="text-muted">Helper</small>
                    <div class="input-group input-group-small flex-nowrap">
                      <select class="form-select" placeholder="" disabled>
                        <option value=""></option>
                      </select>
                      <button class="btn btn-outline-secondary" type="button" id="button-addon2" disabled>Delete Helper</button>
                    </div>
                    <small class="text-muted">Content</small>
                    <textarea class="form-control" name="{{ $viewFolder }}[assessment]" id="{{ $viewFolder }}_prev_assessment" rows=3 disabled>{{ $bookings[0]->assessment }}</textarea>
                    <small class="text-muted">Helper Save/Edit</small>
                    <div class="input-group input-group-small mb-3 flex-nowrap">
                      <div class="input-group-text">
                        <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                      </div>
                      <input type="text" class="form-control" id="{{ $viewFolder }}_assessmentTitle" name="{{ $viewFolder }}[assessmentTitle]" disabled>
                      <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                    </div>
                    <textarea class="form-control mb-2" name="{{ $viewFolder }}[_assessmentEdit]" id="{{ $viewFolder }}_assessmentEdit" rows=3 disabled></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="card mb-3">
              <div class="card-header">Previous Plan</div>
              <div class="card-body">
                <div class="card mb-3">
                  <div class="card-header">Previous Medical Therapeutics</div>
                  <div class="card-body">
                    <small class="text-muted">Helper</small>
                    <div class="input-group input-group-small flex-nowrap">
                      <select class="form-select" placeholder="" disabled>
                        <option value=""></option>
                      </select>
                      <button class="btn btn-outline-secondary" type="button" id="button-addon2" disabled>Delete Helper</button>
                    </div>
                    <small class="text-muted">Content</small>
                    <textarea class="form-control" name="{{ $viewFolder }}[planMed]" id="{{ $viewFolder }}_prev_planMed" rows=3 disabled>{{ $bookings[0]->planMed }}</textarea>
                    <small class="text-muted">Helper Save/Edit</small>
                    <div class="input-group input-group-small mb-3 flex-nowrap">
                      <div class="input-group-text">
                        <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                      </div>
                      <input type="text" class="form-control" id="{{ $viewFolder }}_planMedTitle" name="{{ $viewFolder }}[planMedTitle]" disabled>
                      <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                    </div>
                    <textarea class="form-control mb-2" name="{{ $viewFolder }}[_planMedEdit]" id="{{ $viewFolder }}_planMedEdit" rows=3 disabled></textarea>
                  </div>
                </div>
                <div class="card mb-3">
                  <div class="card-header">Previous Diagnostics and Surgery</div>
                  <div class="card-body">
                    <small class="text-muted">Helper</small>
                    <div class="input-group input-group-small flex-nowrap">
                      <select class="form-select" placeholder="" disabled>
                        <option value=""></option>
                      </select>
                      <button class="btn btn-outline-secondary" type="button" id="button-addon2" disabled>Delete Helper</button>
                    </div>
                    <small class="text-muted">Content</small>
                    <textarea class="form-control" name="{{ $viewFolder }}[plan]" id="{{ $viewFolder }}_prev_plan" rows=3 disabled>{{ $bookings[0]->plan }}</textarea>
                    <small class="text-muted">Helper Save/Edit</small>
                    <div class="input-group input-group-small mb-3 flex-nowrap">
                      <div class="input-group-text">
                        <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                      </div>
                      <input type="text" class="form-control" id="{{ $viewFolder }}_planTitle" name="{{ $viewFolder }}[planTitle]" disabled>
                      <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                    </div>
                    <textarea class="form-control mb-2" name="{{ $viewFolder }}[_planEdit]" id="{{ $viewFolder }}_planEdit" rows=3 disabled></textarea>
                  </div>
                </div>
                <div class="card mb-3">
                  <div class="card-header">Previous Remarks</div>
                  <div class="card-body">
                    <small class="text-muted">Helper</small>
                    <div class="input-group input-group-small flex-nowrap">
                      <select class="form-select" placeholder="" disabled>
                        <option value=""></option>
                      </select>
                      <button class="btn btn-outline-secondary" type="button" id="button-addon2" disabled>Delete Helper</button>
                    </div>
                    <small class="text-muted">Content</small>
                    <textarea class="form-control" name="{{ $viewFolder }}[planRem]" id="{{ $viewFolder }}_prev_planRem" rows=3 disabled>{{ $bookings[0]->planRem }}</textarea>
                    <small class="text-muted">Helper Save/Edit</small>
                    <div class="input-group input-group-small mb-3 flex-nowrap">
                      <div class="input-group-text">
                        <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                      </div>
                      <input type="text" class="form-control" id="{{ $viewFolder }}_planRemTitle" name="{{ $viewFolder }}[planRemTitle]" disabled>
                      <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                    </div>
                    <textarea class="form-control mb-2" name="{{ $viewFolder }}[_planRemEdit]" id="{{ $viewFolder }}_planRemEdit" rows=3 disabled></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="labPrevDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            <h5>Image Viewer</h5>
            <div id="carouselPrev" class="carousel carousel-dark slide" data-bs-interval="false">
              <div class="carousel-indicators" id="labPrevCarouselInd">
                @php
                  $key = false;
                @endphp
                @if(!empty($bookings[0]->consultation_files[0]->file_link))
                  @foreach($bookings[0]->consultation_files as $ind=>$file)
                  @php
                    $key = true;
                  @endphp
                <button type="button" data-bs-target="#carouselPrev" data-bs-slide-to="{{ $ind }}" {{ $ind == 0 ? 'class=active aria-current=true' : '' }} aria-label="Slide {{ $ind+1 }}"></button>
                  @endforeach
                @endif
                @if(!empty($bookings[0]->anesthesia_files[0]->file_link))
                  @foreach($bookings[0]->anesthesia_files as $file)
                  @php
                    $ind++;
                    $key = true;
                  @endphp
                <button type="button" data-bs-target="#carouselPrev" data-bs-slide-to="{{ $ind }}" {{ $ind == 0 ? 'class=active aria-current=true' : '' }} aria-label="Slide {{ $ind+1 }}"></button>
                  @endforeach
                @endif
                @if(!empty($bookings[0]->doctor_files[0]->file_link))
                  @foreach($bookings[0]->doctor_files as $file)
                  @php
                    $ind++;
                    $key = true;
                  @endphp
                <button type="button" data-bs-target="#carouselPrev" data-bs-slide-to="{{ $ind }}" {{ $ind == 0 ? 'class=active aria-current=true' : '' }} aria-label="Slide {{ $ind+1 }}"></button>
                  @endforeach
                @endif
                @if(!empty($bookings[0]->prescription_files[0]->file_link))
                  @foreach($bookings[0]->prescription_files as $file)
                  @php
                    $ind++;
                    $key = true;
                  @endphp
                <button type="button" data-bs-target="#carouselPrev" data-bs-slide-to="{{ $ind }}" {{ $ind == 0 ? 'class=active aria-current=true' : '' }} aria-label="Slide {{ $ind+1 }}"></button>
                  @endforeach
                @endif
                @if(!$key)
                <button type="button" data-bs-target="#carouselPrev" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                @endif
              </div>
              <div class="carousel-inner" id="labPrevCarouselInner">
                @php
                  $key = false;
                @endphp
                @if(!empty($bookings[0]->consultation_files[0]->file_link))
                  @foreach($bookings[0]->consultation_files as $ind=>$file)
                  @php
                    $key = true;
                  @endphp
                <div class="carousel-item {{ $ind == 0 ? 'active' : '' }}">
                  @if($file->file_type == 'application/pdf')
                  <iframe src="{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" width="100%" height="373" style="border:1"></iframe>
                  @else
                  <img src="{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" class="d-block w-100" alt="">
                  @endif
                </div>
                  @endforeach
                @endif
                @if(!empty($bookings[0]->anesthesia_files[0]->file_link))
                  @foreach($bookings[0]->anesthesia_files as $file)
                  @php
                    $ind++;
                    $key = true;
                  @endphp
                <div class="carousel-item {{ $ind == 0 ? 'active' : '' }}">
                  @if($file->file_type == 'application/pdf')
                  <iframe src="{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" width="100%" height="373" style="border:1"></iframe>
                  @else
                  <img src="{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" class="d-block w-100" alt="">
                  @endif
                </div>
                  @endforeach
                @endif
                @if(!empty($bookings[0]->doctor_files[0]->file_link))
                  @foreach($bookings[0]->doctor_files as $file)
                  @php
                    $ind++;
                    $key = true;
                  @endphp
                <div class="carousel-item {{ $ind == 0 ? 'active' : '' }}">
                  @if($file->file_type == 'application/pdf')
                  <iframe src="{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" width="100%" height="373" style="border:1"></iframe>
                  @else
                  <img src="{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" class="d-block w-100" alt="">
                  @endif
                </div>
                  @endforeach
                @endif
                @if(!empty($bookings[0]->prescription_files[0]->file_link))
                  @foreach($bookings[0]->prescription_files as $file)
                  @php
                    $ind++;
                    $key = true;
                  @endphp
                <div class="carousel-item {{ $ind == 0 ? 'active' : '' }}">
                  @if($file->file_type == 'application/pdf')
                  <iframe src="{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" width="100%" height="373" style="border:1"></iframe>
                  @else
                  <img src="{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" class="d-block w-100" alt="">
                  @endif
                </div>
                  @endforeach
                @endif
                @if(!$key)
                <div class="carousel-item active">
                  <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" class="d-block w-100" alt="">
                </div>
                @endif
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselPrev" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselPrev" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
            <div class="my-3">
              <label for="formFileMultiple" class="form-label">Uploaded Images/Files</label>
              <input class="form-control" type="file" id="{{ $viewFolder }}_prev_files" name="{{ $viewFolder }}[ConsultationFile][files][]" accept="image/png, image/gif, image/jpeg" multiple disabled>
            </div>
            <div class="row overflow-auto" id="image_preview_prev_saved" style="max-height:500px">
              @php
                $ind = 0;
              @endphp
              @if(isset($bookings[0]->consultation_files))
                @foreach($bookings[0]->consultation_files as $ind => $file)
                @php
                  $exAr = explode('/', $file->file_link);
                @endphp
                @if($file->file_type == 'application/pdf')
              <div class='img-div' data-bs-target="#carouselPrev" data-bs-slide-to="{{ $ind }}" id='img-div-save{{ $ind }}'><iframe src='{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}' class='img-thumbnail'></iframe><div class='middle'><button id='action-icon' value='img-div-save{{ $ind }}' class='btn btn-danger' role='{{ $exAr[sizeof($exAr)-1] }}' saved='{{ $file->id }}'><i class='bi bi-trash'></i></button></div></div>
                @else
              <div class='img-div' data-bs-target="#carouselPrev" data-bs-slide-to="{{ $ind }}" id='img-div-save{{ $ind }}'><img src='{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}' class='img-thumbnail'><div class='middle'><button id='action-icon' value='img-div-save{{ $ind }}' class='btn btn-danger' role='{{ $exAr[sizeof($exAr)-1] }}' saved='{{ $file->id }}' disabled><i class='bi bi-trash'></i></button></div></div>
                @endif
                @endforeach
              @endif
              @if(isset($bookings[0]->anesthesia_files))
                @foreach($bookings[0]->anesthesia_files as $file)
                @php
                  $ind++;
                  $exAr = explode('/', $file->file_link);
                @endphp
                @if($file->file_type == 'application/pdf')
              <div class='img-div' data-bs-target="#carouselPrev" data-bs-slide-to="{{ $ind }}" id='img-div-save{{ $ind }}'><iframe src='{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}' class='img-thumbnail'></iframe><div class='middle'><button id='action-icon' value='img-div-save{{ $ind }}' class='btn btn-danger' role='{{ $exAr[sizeof($exAr)-1] }}' saved='{{ $file->id }}'><i class='bi bi-trash'></i></button></div></div>
                @else
              <div class='img-div' data-bs-target="#carouselPrev" data-bs-slide-to="{{ $ind }}" id='img-div-save{{ $ind }}'><img src='{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}' class='img-thumbnail'><div class='middle'><button id='action-icon' value='img-div-save{{ $ind }}' class='btn btn-danger' role='{{ $exAr[sizeof($exAr)-1] }}' saved='{{ $file->id }}' disabled><i class='bi bi-trash'></i></button></div></div>
                @endif
                @endforeach
              @endif
              @if(isset($bookings[0]->doctor_files))
                @foreach($bookings[0]->doctor_files as $file)
                @php
                  $ind++;
                  $exAr = explode('/', $file->file_link);
                @endphp
                @if($file->file_type == 'application/pdf')
              <div class='img-div' data-bs-target="#carouselPrev" data-bs-slide-to="{{ $ind }}" id='img-div-save{{ $ind }}'><iframe src='{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}' class='img-thumbnail'></iframe><div class='middle'><button id='action-icon' value='img-div-save{{ $ind }}' class='btn btn-danger' role='{{ $exAr[sizeof($exAr)-1] }}' saved='{{ $file->id }}'><i class='bi bi-trash'></i></button></div></div>
                @else
              <div class='img-div' data-bs-target="#carouselPrev" data-bs-slide-to="{{ $ind }}" id='img-div-save{{ $ind }}'><img src='{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}' class='img-thumbnail'><div class='middle'><button id='action-icon' value='img-div-save{{ $ind }}' class='btn btn-danger' role='{{ $exAr[sizeof($exAr)-1] }}' saved='{{ $file->id }}' disabled><i class='bi bi-trash'></i></button></div></div>
                @endif
                @endforeach
              @endif
              @if(isset($bookings[0]->prescription_files))
                @foreach($bookings[0]->prescription_files as $file)
                @php
                  $ind++;
                  $exAr = explode('/', $file->file_link);
                @endphp
                @if($file->file_type == 'application/pdf')
              <div class='img-div' data-bs-target="#carouselPrev" data-bs-slide-to="{{ $ind }}" id='img-div-save{{ $ind }}'><iframe src='{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}' class='img-thumbnail'></iframe><div class='middle'><button id='action-icon' value='img-div-save{{ $ind }}' class='btn btn-danger' role='{{ $exAr[sizeof($exAr)-1] }}' saved='{{ $file->id }}'><i class='bi bi-trash'></i></button></div></div>
                @else
              <div class='img-div' data-bs-target="#carouselPrev" data-bs-slide-to="{{ $ind }}" id='img-div-save{{ $ind }}'><img src='{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}' class='img-thumbnail'><div class='middle'><button id='action-icon' value='img-div-save{{ $ind }}' class='btn btn-danger' role='{{ $exAr[sizeof($exAr)-1] }}' saved='{{ $file->id }}' disabled><i class='bi bi-trash'></i></button></div></div>
                @endif
                @endforeach
              @endif
            </div>
          </div>
          <div id="presPrevDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            <div class="card mb-3">
              <div class="card-header">Previous Prescription Preview</div>
              <div class="card-body">
                <iframe id="iframePrevPresc" src="{{ file_exists(public_path('storage/prescription_files/' . $bookings[0]->id . '_' . $bookings[0]->patient->l_name . '.pdf')) ? asset('storage/prescription_files/' . $bookings[0]->id . '_' . $bookings[0]->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" width="100%" height="300" style="border:1"></iframe>
                <small class="form-text text-muted">To print or download go to Tools</small>
              </div>
            </div>
          </div>
          <div id="medPrevDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            <div class="card mb-3">
              <div class="card-header">Previous Med Cert Preview</div>
              <div class="card-body">
                <iframe id="iframePrevMedCert" src="{{ file_exists(public_path('storage/med_cert_files/' . $bookings[0]->id . '_' . $bookings[0]->patient->l_name . '.pdf')) ? asset('storage/med_cert_files/' . $bookings[0]->id . '_' . $bookings[0]->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" width="100%" height="300" style="border:1"></iframe>
                <small class="form-text text-muted">To print or download go to Tools</small>
              </div>
            </div>
          </div>
          <div id="admitPrevDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            <div class="card mb-3">
              <div class="card-header">Previous Admitting Orders Preview</div>
              <div class="card-body">
                <iframe id="iframePrevAdmitting" src="{{ file_exists(public_path('storage/admitting_order_files/' . $bookings[0]->id . '_' . $bookings[0]->patient->l_name . '.pdf')) ? asset('storage/admitting_order_files/' . $bookings[0]->id . '_' . $bookings[0]->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" width="100%" height="300" style="border:1"></iframe>
                <small class="form-text text-muted">To print or download go to Tools</small>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
    
    <div class="col-lg-6">
      <div id="curChart" class="card mb-3 d-lg-block">
        <div class="card-header">Current Patient's Chart ({{ $datum->bookingDate }})</div>
        <div class="card-body">
          <div class="card mb-3">
            <div class="card-header">Vitals</div>
            <div class="card-body">
              <p>
                <strong>Temp:</strong> <span class="text-primary">{{ $datum->temp }}C</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>Height:</strong> <span class="text-primary">{{ $datum->height }}cm</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>Weight:</strong> <span class="text-primary">{{ $datum->weight }}kg</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>BMI:</strong> <span class="text-primary">{{ isset($datum->height) && (int)$datum->height > 0 ? number_format($datum->weight/(($datum->height/100)*($datum->height/100)), 0) : '' }}</span><br>
                <strong>BP:</strong> <span class="text-primary">{{ $datum->bpS }}/{{ $datum->bpD }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>O2 Sat:</strong> <span class="text-primary">{{ $datum->o2 }}%</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>Heart Rate:</strong> <span class="text-primary">{{ $datum->heart }}beats/min</span>
              </p>
            </div>
          </div>
          <ul class="nav nav-pills mb-3">
            <li class="nav-item">
              <a class="nav-link docNotesLink active" href="#" onclick="
                  $('.docNotesLink').each(function(){
                    $(this).removeClass('active');
                  });
                  $(this).addClass('active');
                  $('.docNotesDiv').each(function(){
                    $(this).hide();
                  });
                  $('#{{ $viewFolder }}_SUMM_{{ $datum->id }}').show();
                  $('#{{ $viewFolder }}_SOAP_{{ $datum->id }}').show();
                  $('#{{ $viewFolder }}_Presc_{{ $datum->id }}').show();
                  $('#{{ $viewFolder }}_MedCert_{{ $datum->id }}').show();
                  $('#{{ $viewFolder }}_Admitting_{{ $datum->id }}').show();

                  

                  @if(!isset($referal_conso))
                  $('#{{ $viewFolder }}_prescription').prop('disabled', false);
                  $('#{{ $viewFolder }}_prescriptionSelect').prop('disabled', false);
                  $('#{{ $viewFolder }}_prescriptionHelperDelete').prop('disabled', false);
                  $('#{{ $viewFolder }}_findings').prop('disabled', false);
                  $('#{{ $viewFolder }}_diagnosis').prop('disabled', false);
                  $('#{{ $viewFolder }}_recommendations').prop('disabled', false);
                  $('#{{ $viewFolder }}_con_date_ao').prop('disabled', false);
                  $('#{{ $viewFolder }}_procedure_ao').prop('disabled', false);
                  $('#{{ $viewFolder }}_procedure_aoSelect').prop('disabled', false);
                  $('#{{ $viewFolder }}_procedure_aoHelperDelete').prop('disabled', false);
                  $('#{{ $viewFolder }}_anesthesia_type_ao').prop('disabled', false);
                  $('#{{ $viewFolder }}_anesthesiologist_ao').prop('disabled', false);
                  $('#{{ $viewFolder }}_admittingOrder').prop('disabled', false);
                  $('#{{ $viewFolder }}_admittingOrderSelect').prop('disabled', false);
                  $('#{{ $viewFolder }}_admittingOrderHelperDelete').prop('disabled', false);
                  @else
                  $('#{{ $viewFolder }}_prescription').prop('disabled', true);
                  $('#{{ $viewFolder }}_prescriptionSelect').prop('disabled', true);
                  $('#{{ $viewFolder }}_prescriptionHelperDelete').prop('disabled', true);
                  $('#{{ $viewFolder }}_findings').prop('disabled', true);
                  $('#{{ $viewFolder }}_diagnosis').prop('disabled', true);
                  $('#{{ $viewFolder }}_recommendations').prop('disabled', true);
                  $('#{{ $viewFolder }}_con_date_ao').prop('disabled', true);
                  $('#{{ $viewFolder }}_procedure_ao').prop('disabled', true);
                  $('#{{ $viewFolder }}_procedure_aoSelect').prop('disabled', true);
                  $('#{{ $viewFolder }}_procedure_aoHelperDelete').prop('disabled', true);
                  $('#{{ $viewFolder }}_anesthesia_type_ao').prop('disabled', true);
                  $('#{{ $viewFolder }}_anesthesiologist_ao').prop('disabled', true);
                  $('#{{ $viewFolder }}_admittingOrder').prop('disabled', true);
                  $('#{{ $viewFolder }}_admittingOrderSelect').prop('disabled', true);
                  $('#{{ $viewFolder }}_admittingOrderHelperDelete').prop('disabled', true);
                  @endif
                  $('#{{ $viewFolder }}_prescription').val($('#{{ $viewFolder }}_parent_prescription_hidden').val());
                  $('#{{ $viewFolder }}_findings').val($('#{{ $viewFolder }}_parent_findings_hidden').val());
                  $('#{{ $viewFolder }}_diagnosis').val($('#{{ $viewFolder }}_parent_diagnosis_hidden').val());
                  $('#{{ $viewFolder }}_recommendations').val($('#{{ $viewFolder }}_parent_recommendations_hidden').val());
                  $('#{{ $viewFolder }}_con_date_ao').val($('#{{ $viewFolder }}_parent_con_date_ao_hidden').val());
                  $('#{{ $viewFolder }}_procedure_ao').val($('#{{ $viewFolder }}_parent_procedure_ao_hidden').val());
                  $('#{{ $viewFolder }}_anesthesia_type_ao').val($('#{{ $viewFolder }}_parent_anesthesia_type_ao_hidden').val());
                  $('#{{ $viewFolder }}_anesthesiologist_ao').val($('#{{ $viewFolder }}_parent_anesthesiologist_ao_hidden').val());
                  $('#{{ $viewFolder }}_admittingOrder').val($('#{{ $viewFolder }}_parent_admittingOrder_hidden').val());
                ">{{ !isset($referal_conso) ? 'Yours - ' . $datum->clinic->name . ' | ' . ($datum->booking_type == '' ? 'Consultations' : $datum->booking_type) : 'Dr. ' . Str::substr($datum->doctor->f_name, 0, 1) . '. ' . $datum->doctor->l_name . ' - ' . $datum->clinic->name . ' | ' . ($datum->booking_type == '' ? 'Consultations' : $datum->booking_type)}}</a>
            </li>
            <input type="hidden" class="form-control" id="{{ $viewFolder }}_parent_prescription_hidden" value="{{ addslashes($datum->prescription) }}">
            <input type="hidden" class="form-control" id="{{ $viewFolder }}_parent_findings_hidden" value="{{ addslashes($datum->findings) }}">
            <input type="hidden" class="form-control" id="{{ $viewFolder }}_parent_diagnosis_hidden" value="{{ addslashes($datum->diagnosis) }}">
            <input type="hidden" class="form-control" id="{{ $viewFolder }}_parent_recommendations_hidden" value="{{ addslashes($datum->recommendations) }}">
            <input type="hidden" class="form-control" id="{{ $viewFolder }}_parent_con_date_ao_hidden" value="{{ addslashes($datum->con_date_ao) }}">
            <input type="hidden" class="form-control" id="{{ $viewFolder }}_parent_procedure_ao_hidden" value="{{ addslashes($datum->procedure_ao) }}">
            <input type="hidden" class="form-control" id="{{ $viewFolder }}_parent_anesthesia_type_ao_hidden" value="{{ addslashes($datum->anesthesia_type_ao) }}">
            <input type="hidden" class="form-control" id="{{ $viewFolder }}_parent_anesthesiologist_ao_hidden" value="{{ addslashes($datum->anesthesiologist_ao) }}">
            <input type="hidden" class="form-control" id="{{ $viewFolder }}_parent_admittingOrder_hidden" value="{{ addslashes($datum->admittingOrder) }}">
            @if(isset($datum->consultation_referals[0]->id))
              @foreach($datum->consultation_referals as $cr)
            <li class="nav-item">
              <a class="nav-link docNotesLink" id="{{ $viewFolder }}_doctorLink_{{ $cr->id }}" href="#"  onclick="
                $('.docNotesLink').each(function(){
                  $(this).removeClass('active');
                });
                $(this).addClass('active');
                $('.docNotesDiv').each(function(){
                    $(this).hide();
                  });
                  $('#{{ $viewFolder }}_SUMM_{{ $cr->id }}').show();
                  $('#{{ $viewFolder }}_SOAP_{{ $cr->id }}').show();
                  $('#{{ $viewFolder }}_Presc_{{ $cr->id }}').show();
                  $('#{{ $viewFolder }}_MedCert_{{ $cr->id }}').show();
                  $('#{{ $viewFolder }}_Admitting_{{ $cr->id }}').show();

                  

                  @if(isset($referal_conso) && $referal_conso->id == $cr->id)
                  $('#{{ $viewFolder }}_prescription').prop('disabled', false);
                  $('#{{ $viewFolder }}_prescriptionSelect').prop('disabled', false);
                  $('#{{ $viewFolder }}_prescriptionHelperDelete').prop('disabled', false);
                  $('#{{ $viewFolder }}_findings').prop('disabled', false);
                  $('#{{ $viewFolder }}_diagnosis').prop('disabled', false);
                  $('#{{ $viewFolder }}_recommendations').prop('disabled', false);
                  $('#{{ $viewFolder }}_con_date_ao').prop('disabled', false);
                  $('#{{ $viewFolder }}_procedure_ao').prop('disabled', false);
                  $('#{{ $viewFolder }}_procedure_aoSelect').prop('disabled', false);
                  $('#{{ $viewFolder }}_procedure_aoHelperDelete').prop('disabled', false);
                  $('#{{ $viewFolder }}_anesthesia_type_ao').prop('disabled', false);
                  $('#{{ $viewFolder }}_anesthesiologist_ao').prop('disabled', false);
                  $('#{{ $viewFolder }}_admittingOrder').prop('disabled', false);
                  $('#{{ $viewFolder }}_admittingOrderSelect').prop('disabled', false);
                  $('#{{ $viewFolder }}_admittingOrderHelperDelete').prop('disabled', false);
                  @else
                  $('#{{ $viewFolder }}_prescription').prop('disabled', true);
                  $('#{{ $viewFolder }}_prescriptionSelect').prop('disabled', true);
                  $('#{{ $viewFolder }}_prescriptionHelperDelete').prop('disabled', true);
                  $('#{{ $viewFolder }}_findings').prop('disabled', true);
                  $('#{{ $viewFolder }}_diagnosis').prop('disabled', true);
                  $('#{{ $viewFolder }}_recommendations').prop('disabled', true);
                  $('#{{ $viewFolder }}_con_date_ao').prop('disabled', true);
                  $('#{{ $viewFolder }}_procedure_ao').prop('disabled', true);
                  $('#{{ $viewFolder }}_procedure_aoSelect').prop('disabled', true);
                  $('#{{ $viewFolder }}_procedure_aoHelperDelete').prop('disabled', true);
                  $('#{{ $viewFolder }}_anesthesia_type_ao').prop('disabled', true);
                  $('#{{ $viewFolder }}_anesthesiologist_ao').prop('disabled', true);
                  $('#{{ $viewFolder }}_admittingOrder').prop('disabled', true);
                  $('#{{ $viewFolder }}_admittingOrderSelect').prop('disabled', true);
                  $('#{{ $viewFolder }}_admittingOrderHelperDelete').prop('disabled', true);
                  @endif

                  $('#{{ $viewFolder }}_prescription').val($('#{{ $viewFolder }}_prescription_hidden').val());
                  $('#{{ $viewFolder }}_findings').val($('#{{ $viewFolder }}_findings_hidden').val());
                  $('#{{ $viewFolder }}_diagnosis').val($('#{{ $viewFolder }}_diagnosis_hidden').val());
                  $('#{{ $viewFolder }}_recommendations').val($('#{{ $viewFolder }}_recommendations_hidden').val());
                  $('#{{ $viewFolder }}_con_date_ao').val($('#{{ $viewFolder }}_con_date_ao_hidden').val());
                  $('#{{ $viewFolder }}_procedure_ao').val($('#{{ $viewFolder }}_procedure_ao_hidden').val());
                  $('#{{ $viewFolder }}_anesthesia_type_ao').val($('#{{ $viewFolder }}_anesthesia_type_ao_hidden').val());
                  $('#{{ $viewFolder }}_anesthesiologist_ao').val($('#{{ $viewFolder }}_anesthesiologist_ao_hidden').val());
                  $('#{{ $viewFolder }}_admittingOrder').val($('#{{ $viewFolder }}_admittingOrder_hidden').val());

              ">{{ isset($referal_conso) && $referal_conso->id == $cr->id  ? 'Yours - ' . $cr->clinic->name . ' | ' . ($cr->booking_type == '' ? 'Consultations' : $cr->booking_type) : 'Dr. ' . Str::substr($cr->doctor->f_name, 0, 1) . '. ' . $cr->doctor->l_name . ' - ' . $cr->clinic->name . ' | ' . ($cr->booking_type == '' ? 'Consultations' : $cr->booking_type) }}</a>
            </li>
              <input type="hidden" class="form-control" id="{{ $viewFolder }}_prescription_hidden" value="{{ addslashes($cr->prescription) }}">
              <input type="hidden" class="form-control" id="{{ $viewFolder }}_findings_hidden" value="{{ addslashes($cr->findings) }}">
              <input type="hidden" class="form-control" id="{{ $viewFolder }}_diagnosis_hidden" value="{{ addslashes($cr->diagnosis) }}">
              <input type="hidden" class="form-control" id="{{ $viewFolder }}_recommendations_hidden" value="{{ addslashes($cr->recommendations) }}">
              <input type="hidden" class="form-control" id="{{ $viewFolder }}_con_date_ao_hidden" value="{{ addslashes($cr->con_date_ao) }}">
              <input type="hidden" class="form-control" id="{{ $viewFolder }}_procedure_ao_hidden" value="{{ addslashes($cr->procedure_ao) }}">
              <input type="hidden" class="form-control" id="{{ $viewFolder }}_anesthesia_type_ao_hidden" value="{{ addslashes($cr->anesthesia_type_ao) }}">
              <input type="hidden" class="form-control" id="{{ $viewFolder }}_anesthesiologist_ao_hidden" value="{{ addslashes($cr->anesthesiologist_ao) }}">
              <input type="hidden" class="form-control" id="{{ $viewFolder }}_admittingOrder_hidden" value="{{ addslashes($cr->admittingOrder) }}">
              @endforeach
            @endif
          </ul>
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" id="sumCurLink" href="#" onclick="
                $('#sumPrevLink').addClass('active');  
                $('#soapPrevLink').removeClass('active');  
                $('#labPrevLink').removeClass('active');  
                $('#presPrevLink').removeClass('active');  
                $('#medPrevLink').removeClass('active');  
                $('#admitPrevLink').removeClass('active');
                $('#sumPrevDiv').show();  
                $('#soapPrevDiv').hide();  
                $('#labPrevDiv').hide();  
                $('#presPrevDiv').hide();  
                $('#medPrevDiv').hide();  
                $('#admitPrevDiv').hide();
                $('#sumCurLink').addClass('active');  
                $('#soapCurLink').removeClass('active');  
                $('#labCurLink').removeClass('active');  
                $('#presCurLink').removeClass('active');  
                $('#medCurLink').removeClass('active');  
                $('#admitCurLink').removeClass('active');
                $('#sumCurDiv').show();  
                $('#soapCurDiv').hide();  
                $('#labCurDiv').hide();  
                $('#presCurDiv').hide();  
                $('#medCurDiv').hide();  
                $('#admitCurDiv').hide();
              ">Summary</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="soapCurLink" href="#" onclick="
                $('#soapPrevLink').addClass('active');  
                $('#sumPrevLink').removeClass('active');  
                $('#labPrevLink').removeClass('active');  
                $('#presPrevLink').removeClass('active');  
                $('#medPrevLink').removeClass('active');  
                $('#admitPrevLink').removeClass('active');
                $('#soapPrevDiv').show();  
                $('#sumPrevDiv').hide();  
                $('#labPrevDiv').hide();  
                $('#presPrevDiv').hide();  
                $('#medPrevDiv').hide();  
                $('#admitPrevDiv').hide();
                $('#soapCurLink').addClass('active');  
                $('#sumCurLink').removeClass('active');  
                $('#labCurLink').removeClass('active');  
                $('#presCurLink').removeClass('active');  
                $('#medCurLink').removeClass('active');  
                $('#admitCurLink').removeClass('active');
                $('#soapCurDiv').show();  
                $('#sumCurDiv').hide();  
                $('#labCurDiv').hide();  
                $('#presCurDiv').hide();  
                $('#medCurDiv').hide();  
                $('#admitCurDiv').hide();
              ">SOAP</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="labCurLink" href="#" onclick="
                $('#sumPrevLink').removeClass('active');
                $('#soapPrevLink').removeClass('active');
                $('#labPrevLink').addClass('active');  
                $('#presPrevLink').removeClass('active');  
                $('#medPrevLink').removeClass('active');  
                $('#admitPrevLink').removeClass('active');
                $('#sumPrevDiv').hide();  
                $('#soapPrevDiv').hide();  
                $('#labPrevDiv').show();  
                $('#presPrevDiv').hide();  
                $('#medPrevDiv').hide();  
                $('#admitPrevDiv').hide();
                $('#sumCurLink').removeClass('active');
                $('#soapCurLink').removeClass('active');
                $('#labCurLink').addClass('active');  
                $('#presCurLink').removeClass('active');  
                $('#medPCurLink').removeClass('active');  
                $('#admitCurLink').removeClass('active');
                $('#sumCurDiv').hide();  
                $('#soapCurDiv').hide();  
                $('#labCurDiv').show();  
                $('#presCurDiv').hide();  
                $('#medCurDiv').hide();  
                $('#admitCurDiv').hide();
              ">File Uploads</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="presCurLink" href="#" onclick="
                $('#sumPrevLink').removeClass('active');
                $('#soapPrevLink').removeClass('active');
                $('#labPrevLink').removeClass('active');  
                $('#presPrevLink').addClass('active');  
                $('#medPrevLink').removeClass('active');  
                $('#admitPrevLink').removeClass('active');
                $('#sumPrevDiv').hide();  
                $('#soapPrevDiv').hide();  
                $('#labPrevDiv').hide();  
                $('#presPrevDiv').show();  
                $('#medPrevDiv').hide();  
                $('#admitPrevDiv').hide();
                $('#sumCurLink').removeClass('active');
                $('#soapCurLink').removeClass('active');
                $('#labCurLink').removeClass('active');  
                $('#presCurLink').addClass('active');  
                $('#medCurLink').removeClass('active');  
                $('#admitCurLink').removeClass('active');
                $('#sumCurDiv').hide();  
                $('#soapCurDiv').hide();  
                $('#labCurDiv').hide();  
                $('#presCurDiv').show();  
                $('#medCurDiv').hide();  
                $('#admitCurDiv').hide();
              ">E-Prescription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="medCurLink" href="#" onclick="
                $('#sumPrevLink').removeClass('active');
                $('#soapPrevLink').removeClass('active');
                $('#labPrevLink').removeClass('active');  
                $('#presPrevLink').removeClass('active');  
                $('#medPrevLink').addClass('active');  
                $('#admitPrevLink').removeClass('active');
                $('#sumPrevDiv').hide();  
                $('#soapPrevDiv').hide();  
                $('#labPrevDiv').hide();  
                $('#presPrevDiv').hide();  
                $('#medPrevDiv').show();  
                $('#admitPrevDiv').hide();
                $('#sumCurLink').removeClass('active');
                $('#soapCurLink').removeClass('active');
                $('#labCurLink').removeClass('active');  
                $('#presCurLink').removeClass('active');  
                $('#medCurLink').addClass('active');  
                $('#admitCurLink').removeClass('active');
                $('#sumCurDiv').hide();  
                $('#soapCurDiv').hide();  
                $('#labCurDiv').hide();  
                $('#presCurDiv').hide();  
                $('#medCurDiv').show();  
                $('#admitCurDiv').hide();
              ">Med Cert</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="admitCurLink" href="#" onclick="
                $('#sumPrevLink').removeClass('active');
                $('#soapPrevLink').removeClass('active');
                $('#labPrevLink').removeClass('active');  
                $('#presPrevLink').removeClass('active');  
                $('#medPrevLink').removeClass('active');
                $('#admitPrevLink').addClass('active'); 
                $('#sumPrevDiv').hide();  
                $('#soapPrevDiv').hide();  
                $('#labPrevDiv').hide();  
                $('#presPrevDiv').hide();  
                $('#medPrevDiv').hide(); 
                $('#admitPrevDiv').show();  
                $('#sumCurLink').removeClass('active');
                $('#soapCurLink').removeClass('active');
                $('#labCurLink').removeClass('active');  
                $('#presCurLink').removeClass('active');  
                $('#medCurLink').removeClass('active');
                $('#admitCurLink').addClass('active'); 
                $('#sumCurDiv').hide();  
                $('#soapCurDiv').hide();  
                $('#labCurDiv').hide();  
                $('#presCurDiv').hide();  
                $('#medCurDiv').hide(); 
                $('#admitCurDiv').show();  
              ">Admitting Orders</a>
            </li>
          </ul>
          <div id="sumCurDiv" class="container border border-1 border-top-0 mb-3 p-3">
            <div class="card mb-3">
              <div class="card-header">Scheduled Procedure</div>
              <div class="card-body" style="height: 1in; max-height: 1in">
                <p>{{ $datum->procedure_details }}</p>
              </div>
            </div>
            <div class="card mb-3">
              <div class="card-header">Patient's Complaint</div>
              <div class="card-body" style="height: 1in; max-height: 1in">
                <p>{{ $datum->complain }}</p>
                <small class="text-muted">{{ $datum->duration }}</small>
              </div>
            </div>
            @if(stristr($datum->doctor->specialty, 'Ophtha'))
            <div class="card mb-3">
              <div class="card-header">Eye Examination Information</div>
              <div class="card-body">
                <p>
                  <strong>AR OD:</strong> <span class="text-primary">{{ $datum->arod_sphere != 'No Target' ? ($datum->arod_sphere > 0 ? '+' . $datum->arod_sphere : $datum->arod_sphere) . ' - ' . ($datum->arod_cylinder > 0 ? '+' . $datum->arod_cylinder : $datum->arod_cylinder) . ' x ' . $datum->arod_axis : 'No Refraction Possible' }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                  <strong>AR OS:</strong> <span class="text-primary">{{ $datum->aros_sphere != 'No Target' ? ($datum->aros_sphere > 0 ? '+' . $datum->aros_sphere : $datum->aros_sphere) . ' - ' . ($datum->aros_cylinder > 0 ? '+' . $datum->aros_cylinder : $datum->aros_cylinder) . ' x ' . $datum->aros_axis : 'No Refraction Possible' }}</span><br>
                  <strong>UCVA OD:</strong> <span class="text-primary">{{ $datum->vaod_den != '' ? $datum->vaod_num . ' / ' . $datum->vaod_den : $datum->vaod_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                  <strong>UCVA OD Present Correction:</strong> <span class="text-primary">{{ $datum->vaodcor_den != '' ? $datum->vaodcor_num . ' / ' . $datum->vaodcor_den : $datum->vaodcor_num }}</span><br>
                  <strong>UCVA OS:</strong> <span class="text-primary">{{ $datum->vaos_den != '' ? $datum->vaos_num . ' / ' . $datum->vaos_den : $datum->vaos_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                  <strong>UCVA OS Present Correction:</strong> <span class="text-primary">{{ $datum->vaoscor_den != '' ? $datum->vaoscor_num . ' / ' . $datum->vaoscor_den : $datum->vaoscor_num }}</span><br>
                  <strong>VA OD Pinhole:</strong> <span class="text-primary">{{ $datum->pinod_den != '' ? $datum->pinod_num . ' / ' . $datum->pinod_den : $datum->pinod_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                  <strong>BCVA OD:</strong> <span class="text-primary">{{ $datum->pinodcor_den != '' ? $datum->pinodcor_num . ' / ' . $datum->pinodcor_den : $datum->pinodcor_num }}</span><br>
                  <strong>VA OS Pinhole:</strong> <span class="text-primary">{{ $datum->pinos_den != '' ? $datum->pinos_num . ' / ' . $datum->pinos_den : $datum->pinos_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                  <strong>BCVA OS:</strong> <span class="text-primary">{{ $datum->pinoscor_den != '' ? $datum->pinoscor_num . ' / ' . $datum->pinoscor_den : $datum->pinoscor_num }}</span><br>
                  <strong>Jaeger OU:</strong> <span class="text-primary">{{ $datum->jae_ou }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                  <strong>Jaeger OD:</strong> <span class="text-primary">{{ $datum->jae_od }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                  <strong>Jaeger OS:</strong> <span class="text-primary">{{ $datum->jae_os }}</span><br>
                  <strong>IOP OD:</strong> <span class="text-primary">{{ $datum->iopod }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                  <strong>IOP OS:</strong> <span class="text-primary">{{ $datum->iopos }}</span>
                </p>
              </div>
            </div>
            @endif
            <div id="{{ $viewFolder }}_SUMM_{{ $datum->id }}" class="docNotesDiv">
              <div class="card mb-3">
                <div class="card-header">Doctor's Notes</div>
                <div class="card-body table-responsive" style="height:300px; max-height: 300px">
                  <p>
                    <strong>History of Present Illness:</strong><div class="m-3">{!! nl2br(isset($datum->docNotesHPI) ? $datum->docNotesHPI : '') !!}</div><br>
                    <strong>Subjective Complaints:</strong><br><div class="m-3">{!! nl2br(isset($datum->docNotesSubject) ? $datum->docNotesSubject : '') !!}</div><br>
                    <strong>Objective Findings:</strong><br><div class="m-3">{!! nl2br(isset($datum->docNotes) ? $datum->docNotes : '') !!}</div><br>
                  </p>
                </div>
              </div>
              <div class="card mb-3">
                <div class="card-header">Assessment</div>
                <div class="card-body table-responsive" style="height:300px; max-height: 300px">
                  <p>
                    <strong>Primary Diagnosis:</strong> {!! nl2br(isset($datum->icd_code_obj) ? $datum->icd_code_obj->icd_code . ' - ' . $datum->icd_code_obj->details : '') !!}<br>
                    <strong>Secondary Diagnosis:</strong><br><div class="m-3">{!! nl2br(isset($datum->assessment) ? $datum->assessment : '') !!}</div><br>
                  </p>
                </div>
              </div>
              <div class="card mb-3">
                <div class="card-header">Plan</div>
                <div class="card-body table-responsive" style="height:300px; max-height: 300px">
                  <p>
                    <strong>Medical Therapeutics:</strong><br><div class="m-3">{!! nl2br(isset($datum->planMed) ? $datum->planMed : '') !!}</div><br>
                    <strong>Diagnostics and Surgery:</strong><br><div class="m-3">{!! nl2br(isset($datum->plan) ? $datum->plan : '') !!}</div><br>
                    <strong>Remarks:</strong><br><div class="m-3">{!! nl2br(isset($datum->planRem) ? $datum->planRem : '') !!}</div><br>
                  </p>
                </div>
              </div>
            </div>
            @if(isset($datum->consultation_referals[0]->id))
              @foreach($datum->consultation_referals as $cr)
            <div id="{{ $viewFolder }}_SUMM_{{ $cr->id }}" class="docNotesDiv" style="display: none">
              <div class="card mb-3">
                <div class="card-header">Doctor's Notes</div>
                <div class="card-body table-responsive" style="height:300px; max-height: 300px">
                  <p>
                    <strong>History of Present Illness:</strong><div class="m-3">{!! nl2br(isset($cr->docNotesHPI) ? $cr->docNotesHPI : '') !!}</div><br>
                    <strong>Subjective Complaints:</strong><br><div class="m-3">{!! nl2br(isset($cr->docNotesSubject) ? $cr->docNotesSubject : '') !!}</div><br>
                    <strong>Objective Findings:</strong><br><div class="m-3">{!! nl2br(isset($cr->docNotes) ? $cr->docNotes : '') !!}</div><br>
                  </p>
                </div>
              </div>
              <div class="card mb-3">
                <div class="card-header">Assessment</div>
                <div class="card-body table-responsive" style="height:300px; max-height: 300px">
                  <p>
                    <strong>Primary Diagnosis:</strong> {!! nl2br(isset($cr->icd_code_obj) ? $cr->icd_code_obj->icd_code . ' - ' . $cr->icd_code_obj->details : '') !!}<br>
                    <strong>Secondary Diagnosis:</strong><br><div class="m-3">{!! nl2br(isset($cr->assessment) ? $cr->assessment : '') !!}</div><br>
                  </p>
                </div>
              </div>
              <div class="card mb-3">
                <div class="card-header">Plan</div>
                <div class="card-body table-responsive" style="height:300px; max-height: 300px">
                  <p>
                    <strong>Medical Therapeutics:</strong><br><div class="m-3">{!! nl2br(isset($cr->planMed) ? $cr->planMed : '') !!}</div><br>
                    <strong>Diagnostics and Surgery:</strong><br><div class="m-3">{!! nl2br(isset($cr->plan) ? $cr->plan : '') !!}</div><br>
                    <strong>Remarks:</strong><br><div class="m-3">{!! nl2br(isset($cr->planRem) ? $cr->planRem : '') !!}</div><br>
                  </p>
                </div>
              </div>
            </div>
              @endforeach
            @endif
          </div>
          <div id="soapCurDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            <div class="card mb-3">
              <div class="card-header">Scheduled Procedure</div>
              <div class="card-body" style="height: 1in; max-height: 1in">
                <p>{{ $datum->procedure_details }}</p>
              </div>
            </div>
            <div class="card mb-3">
              <div class="card-header">Patient's Complaint</div>
              <div class="card-body" style="height: 1in; max-height: 1in">
                <p>{{ $datum->complain }}</p>
                <small class="text-muted">{{ $datum->duration }}</small>
              </div>
            </div>
            <div class="docNotesDiv" id="{{ $viewFolder }}_SOAP_{{ $datum->id }}">
              <div class="card mb-3">
                <div class="card-header">Doctor's Notes</div>
                <div class="card-body">
                  {{-- @if(!isset($bookings[0])) --}}
                  <div class="card mb-3">
                    <div class="card-header">History of Present Illness</div>
                    <div class="card-body">
                      <small class="text-muted">Helper</small>
                      <div class="input-group input-group-small flex-nowrap">
                        <select class="form-select" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ !isset($referal_conso) ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[docNotesHPI]" @if($user->id == $datum->doctor->id) id="{{ $viewFolder }}_docNotesHPI" @endif rows=3 {{ !isset($referal_conso)  ? '' : 'disabled' }}>{{ isset($datum->docNotesHPI) ? $datum->docNotesHPI : '' }}</textarea>
                      <small class="text-muted">Helper Save/Edit</small>
                      <div class="input-group input-group-small mb-3 flex-nowrap">
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                        </div>
                        <input type="text" class="form-control" id="{{ $viewFolder }}_docNotesHPITitle" name="{{ $viewFolder }}[docNotesHPITitle]" disabled>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                      </div>
                      <textarea class="form-control mb-2" name="{{ $viewFolder }}[docNotesHPIEdit]" id="{{ $viewFolder }}_docNotesHPIEdit" rows=3 disabled></textarea>
                    </div>
                  </div>
                  {{-- @else --}}
                  <div class="card mb-3">
                    <div class="card-header">Subjective Complaints</div>
                    <div class="card-body">
                      <small class="text-muted">Helper</small>
                      <div class="input-group input-group-small flex-nowrap">
                        <select class="form-select" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ !isset($referal_conso)  ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[docNotesSubject]" @if($user->id == $datum->doctor->id) id="{{ $viewFolder }}_docNotesSubject" @endif rows=3 {{ !isset($referal_conso)  ? '' : 'disabled' }}>{{ isset($datum->docNotesSubject) ? $datum->docNotesSubject : '' }}</textarea>
                      <small class="text-muted">Helper Save/Edit</small>
                      <div class="input-group input-group-small mb-3 flex-nowrap">
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                        </div>
                        <input type="text" class="form-control" id="{{ $viewFolder }}_docNotesSubjectTitle" name="{{ $viewFolder }}[docNotesSubjectTitle]" disabled>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                      </div>
                      <textarea class="form-control mb-2" name="{{ $viewFolder }}[ddocNotesSubjectEdit]" id="{{ $viewFolder }}_docNotesSubjectEdit" rows=3 disabled></textarea>
                    </div>
                  </div>
                  {{-- @endif --}}
                  <div class="card mb-3">
                    <div class="card-header">Objective Findings</div>
                    <div class="card-body">
                      @if(stristr($datum->doctor->specialty, 'Ophtha'))
                      <div class="card mb-3">
                        <div class="card-header">Eye Examination Information</div>
                        <div class="card-body">
                          <p>
                            <strong>AR OD:</strong> <span class="text-primary">{{ $datum->arod_sphere != 'No Target' ? ($datum->arod_sphere > 0 ? '+' . $datum->arod_sphere : $datum->arod_sphere) . ' - ' . ($datum->arod_cylinder > 0 ? '+' . $datum->arod_cylinder : $datum->arod_cylinder) . ' x ' . $datum->arod_axis : 'No Refraction Possible' }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                            <strong>AR OS:</strong> <span class="text-primary">{{ $datum->aros_sphere != 'No Target' ? ($datum->aros_sphere > 0 ? '+' . $datum->aros_sphere : $datum->aros_sphere) . ' - ' . ($datum->aros_cylinder > 0 ? '+' . $datum->aros_cylinder : $datum->aros_cylinder) . ' x ' . $datum->aros_axis : 'No Refraction Possible' }}</span><br>
                            <strong>UCVA OD:</strong> <span class="text-primary">{{ $datum->vaod_den != '' ? $datum->vaod_num . ' / ' . $datum->vaod_den : $datum->vaod_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                            <strong>UCVA OD Present Correction:</strong> <span class="text-primary">{{ $datum->vaodcor_den != '' ? $datum->vaodcor_num . ' / ' . $datum->vaodcor_den : $datum->vaodcor_num }}</span><br>
                            <strong>UCVA OS:</strong> <span class="text-primary">{{ $datum->vaos_den != '' ? $datum->vaos_num . ' / ' . $datum->vaos_den : $datum->vaos_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                            <strong>UCVA OS Present Correction:</strong> <span class="text-primary">{{ $datum->vaoscor_den != '' ? $datum->vaoscor_num . ' / ' . $datum->vaoscor_den : $datum->vaoscor_num }}</span><br>
                            <strong>VA OD Pinhole:</strong> <span class="text-primary">{{ $datum->pinod_den != '' ? $datum->pinod_num . ' / ' . $datum->pinod_den : $datum->pinod_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                            <strong>BCVA OD:</strong> <span class="text-primary">{{ $datum->pinodcor_den != '' ? $datum->pinodcor_num . ' / ' . $datum->pinodcor_den : $datum->pinodcor_num }}</span><br>
                            <strong>VA OS Pinhole:</strong> <span class="text-primary">{{ $datum->pinos_den != '' ? $datum->pinos_num . ' / ' . $datum->pinos_den : $datum->pinos_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                            <strong>BCVA OS:</strong> <span class="text-primary">{{ $datum->pinoscor_den != '' ? $datum->pinoscor_num . ' / ' . $datum->pinoscor_den : $datum->pinoscor_num }}</span><br>
                            <strong>Jaeger OU:</strong> <span class="text-primary">{{ $datum->jae_ou }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                            <strong>Jaeger OD:</strong> <span class="text-primary">{{ $datum->jae_od }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                            <strong>Jaeger OS:</strong> <span class="text-primary">{{ $datum->jae_os }}</span><br>
                            <strong>IOP OD:</strong> <span class="text-primary">{{ $datum->iopod }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                            <strong>IOP OS:</strong> <span class="text-primary">{{ $datum->iopos }}</span>
                          </p>
                        </div>
                      </div>
                      @endif
                      <small class="text-muted">Helper</small>
                      <div class="input-group input-group-small flex-nowrap">
                        <select class="form-select" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ !isset($referal_conso)  ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[docNotes]" @if($user->id == $datum->doctor->id) id="{{ $viewFolder }}_docNotes" @endif rows=3 {{ !isset($referal_conso)  ? 'required' : 'disabled' }} onchange="
                        $('#{{ $viewFolder }}_findings').val($(this).val());
                      ">{{ isset($datum->docNotes) ? $datum->docNotes : '' }}</textarea>
                      <small class="text-muted">Helper Save/Edit</small>
                      <div class="input-group input-group-small mb-3 flex-nowrap">
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                        </div>
                        <input type="text" class="form-control" id="{{ $viewFolder }}_docNotesTitle" name="{{ $viewFolder }}[docNotesTitle]" disabled>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                      </div>
                      <textarea class="form-control mb-2" name="{{ $viewFolder }}[_docNotesEdit]" id="{{ $viewFolder }}_docNotesEdit" rows=3 disabled></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mb-3">
                <div class="card-header">Assessment</div>
                <div class="card-body">
                  <div class="form-floating mb-3">
                    {{-- <select class="form-select" name="{{ $viewFolder }}[icd_code]" id="{{ $viewFolder }}_icd_code" placeholder="" {{ $user->id == $datum->doctor->id ? '' : 'disabled' }}>
                      <option value=""></option>
                    </select> --}}
                    <input class="form-control" list="icdCodeList" {{ !isset($referal_conso) ? 'id=' . $viewFolder . '_icd_code' : '' }} name="{{ $viewFolder }}[icd_code]" value="{{ isset($datum->icd_code_obj->icd_code) ? $datum->icd_code_obj->icd_code . ' - ' . $datum->icd_code_obj->details : '' }}" autocomplete="off" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                    <label for="{{ $viewFolder }}_icd_code">Primary Diagnosis</label>
                    <small id="help_{{ $viewFolder }}_icd_code" class="text-muted"></small>
                  </div>
                  <div class="card mb-3">
                    <div class="card-header">Secondary Diagnosis</div>
                    <div class="card-body">
                      <small class="text-muted">Helper</small>
                      <div class="input-group input-group-small flex-nowrap">
                        <select class="form-select" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ !isset($referal_conso)  ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[assessment]" @if($user->id == $datum->doctor->id) id="{{ $viewFolder }}_assessment" @endif rows=3 {{ !isset($referal_conso)  ? 'required' : 'disabled' }} onchange="
                        $('#{{ $viewFolder }}_diagnosis').val($(this).val());
                      ">{{ isset($datum->assessment) ? $datum->assessment : '' }}</textarea>
                      <small class="text-muted">Helper Save/Edit</small>
                      <div class="input-group input-group-small mb-3 flex-nowrap">
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                        </div>
                        <input type="text" class="form-control" id="{{ $viewFolder }}_assessmentTitle" name="{{ $viewFolder }}[assessmentTitle]" disabled>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                      </div>
                      <textarea class="form-control mb-2" name="{{ $viewFolder }}[_assessmentEdit]" id="{{ $viewFolder }}_assessmentEdit" rows=3 disabled></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mb-3">
                <div class="card-header">Plan</div>
                <div class="card-body">
                  <div class="card mb-3">
                    <div class="card-header">Medical Therapeutics</div>
                    <div class="card-body">
                      <small class="text-muted">Helper</small>
                      <div class="input-group input-group-small flex-nowrap">
                        <select class="form-select" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ !isset($referal_conso)  ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[planMed]" @if($user->id == $datum->doctor->id) id="{{ $viewFolder }}_planMed" @endif rows=3 {{ !isset($referal_conso)  ? 'required' : 'disabled' }}>{{ isset($datum->planMed) ? $datum->planMed : '' }}</textarea>
                      <small class="text-muted">Helper Save/Edit</small>
                      <div class="input-group input-group-small mb-3 flex-nowrap">
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                        </div>
                        <input type="text" class="form-control" id="{{ $viewFolder }}_planMedTitle" name="{{ $viewFolder }}[planMedTitle]" disabled>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                      </div>
                      <textarea class="form-control mb-2" name="{{ $viewFolder }}[_planMedEdit]" id="{{ $viewFolder }}_planMedEdit" rows=3 disabled></textarea>
                    </div>
                  </div>
                  <div class="card mb-3">
                    <div class="card-header">Diagnostics and Surgery</div>
                    <div class="card-body">
                      <small class="text-muted">Helper</small>
                      <div class="input-group input-group-small flex-nowrap">
                        <select class="form-select" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ !isset($referal_conso)  ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[plan]" @if($user->id == $datum->doctor->id) id="{{ $viewFolder }}_plan" @endif rows=3 {{ !isset($referal_conso)  ? 'required' : 'disabled' }}>{{ isset($datum->plan) ? $datum->plan : '' }}</textarea>
                      <small class="text-muted">Helper Save/Edit</small>
                      <div class="input-group input-group-small mb-3 flex-nowrap">
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                        </div>
                        <input type="text" class="form-control" id="{{ $viewFolder }}_planTitle" name="{{ $viewFolder }}[planTitle]" disabled>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                      </div>
                      <textarea class="form-control mb-2" name="{{ $viewFolder }}[_planEdit]" id="{{ $viewFolder }}_planEdit" rows=3 disabled></textarea>
                    </div>
                  </div>
                  <div class="card mb-3">
                    <div class="card-header">Remarks</div>
                    <div class="card-body">
                      <small class="text-muted">Helper</small>
                      <div class="input-group input-group-small flex-nowrap">
                        <select class="form-select" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ !isset($referal_conso)  ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[planRem]" @if($user->id == $datum->doctor->id) id="{{ $viewFolder }}_planRem" @endif rows=3 {{ !isset($referal_conso)  ? '' : 'disabled' }}>{{ isset($datum->planRem) ? $datum->planRem : '' }}</textarea>
                      <small class="text-muted">Helper Save/Edit</small>
                      <div class="input-group input-group-small mb-3 flex-nowrap">
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                        </div>
                        <input type="text" class="form-control" id="{{ $viewFolder }}_planRemTitle" name="{{ $viewFolder }}[planRemTitle]" disabled>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                      </div>
                      <textarea class="form-control mb-2" name="{{ $viewFolder }}[_planRemEdit]" id="{{ $viewFolder }}_planRemEdit" rows=3 disabled></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mb-3">
                <div class="card-header">Book Follow Up</div>
                <div class="card-body">
                  {{-- <div class="form-floating mb-3"> --}}
                    {{-- <label for="{{ $viewFolder }}_referal" class="form-label">Booking Date</label> --}}
                    <div class="input-group input-group-small mb-3 flex-nowrap">
                      <input class="form-control" type="date" name="{{ $viewFolder }}[referal]" id="{{ $viewFolder }}_referals" value="{{ isset($datum->advance_booking->id) ? $datum->advance_booking->bookingDate : '' }}" min="{{ date('Y-m-d', strtotime($datum->bookingDate . '+ 7days')) }}" step=7 max="{{ $maxDateSched }}" onkeydown="return false">
                      <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="
                        $('#{{ $viewFolder }}_referals').val('');
                      ">Clear Booking</button>
                    </div>
                    <small id="help_{{ $viewFolder }}_referal" class="text-muted"></small>
                  {{-- </div> --}}
                  {{-- <div class="form-floating mb-3">
                    <input class="form-control" id="{{ $viewFolder }}_referal" name="{{ $viewFolder }}[referal]" value="{{ isset($datum->advance_booking->id) ? ($datum->advance_booking->booking_type == '' ? 'Consultation' : $datum->advance_booking->booking_type) . ' - ' . $datum->advance_booking->bookingDate . ' (' . date('l', strtotime($datum->advance_booking->bookingDate)) . ')' : '' }}" {{ $datum->doctor_id != $user->id ? 'disabled' : '' }} autocomplete="off">
                    <small class="text-muted">Please type date and click the option that will appear.</small>
                  </div> --}}
                </div>
              </div>
            </div>
            @if(isset($datum->consultation_referals[0]->id))
              @foreach($datum->consultation_referals as $cr)
                @if(isset($referal_conso) && $referal_conso->id == $cr->id)  
            <input type="hidden" class="form-control" id="{{ $viewFolder }}_referral_id" name="{{ $viewFolder }}[referral_id]" value="{{ $cr->id }}">
                @endif
            <div class="docNotesDiv" id="{{ $viewFolder }}_SOAP_{{ $cr->id }}" style="display:none">
              <div class="card mb-3">
                <div class="card-header">Doctor's Notes</div>
                <div class="card-body">
                  {{-- @if(!isset($bookings[0])) --}}
                  <div class="card mb-3">
                    <div class="card-header">History of Present Illness</div>
                    <div class="card-body">
                      <small class="text-muted">Helper</small>
                      <div class="input-group input-group-small flex-nowrap">
                        <select class="form-select" placeholder="" {{ isset($referal_conso) && $referal_conso->id == $cr->id ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ isset($referal_conso) && $referal_conso->id == $cr->id  ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[docNotesHPI]" @if($user->id == $cr->doctor->id) id="{{ $viewFolder }}_docNotesHPI" @endif rows=3 {{ isset($referal_conso) && $referal_conso->id == $cr->id  ? '' : 'disabled' }}>{{ isset($cr->docNotesHPI) ? $cr->docNotesHPI : '' }}</textarea>
                      <small class="text-muted">Helper Save/Edit</small>
                      <div class="input-group input-group-small mb-3 flex-nowrap">
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                        </div>
                        <input type="text" class="form-control" id="{{ $viewFolder }}_docNotesHPITitle" name="{{ $viewFolder }}[docNotesHPITitle]" disabled>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                      </div>
                      <textarea class="form-control mb-2" name="{{ $viewFolder }}[docNotesHPIEdit]" id="{{ $viewFolder }}_docNotesHPIEdit" rows=3 disabled></textarea>
                    </div>
                  </div>
                  {{-- @else --}}
                  <div class="card mb-3">
                    <div class="card-header">Subjective Complaints</div>
                    <div class="card-body">
                      <small class="text-muted">Helper</small>
                      <div class="input-group input-group-small flex-nowrap">
                        <select class="form-select" placeholder="" {{ isset($referal_conso) && $referal_conso->id == $cr->id ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ isset($referal_conso) && $referal_conso->id == $cr->id  ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[docNotesSubject]" @if($user->id == $cr->doctor->id) id="{{ $viewFolder }}_docNotesSubject" @endif rows=3 {{ isset($referal_conso) && $referal_conso->id == $cr->id  ? '' : 'disabled' }}>{{ isset($cr->docNotesSubject) ? $cr->docNotesSubject : '' }}</textarea>
                      <small class="text-muted">Helper Save/Edit</small>
                      <div class="input-group input-group-small mb-3 flex-nowrap">
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                        </div>
                        <input type="text" class="form-control" id="{{ $viewFolder }}_docNotesSubjectTitle" name="{{ $viewFolder }}[docNotesSubjectTitle]" disabled>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                      </div>
                      <textarea class="form-control mb-2" name="{{ $viewFolder }}[ddocNotesSubjectEdit]" id="{{ $viewFolder }}_docNotesSubjectEdit" rows=3 disabled></textarea>
                    </div>
                  </div>
                  {{-- @endif --}}
                  <div class="card mb-3">
                    <div class="card-header">Objective Findings</div>
                    <div class="card-body">
                      @if(stristr($datum->doctor->specialty, 'Ophtha'))
                      <div class="card mb-3">
                        <div class="card-header">Eye Examination Information</div>
                        <div class="card-body">
                          <p>
                            <strong>AR OD:</strong> <span class="text-primary">{{ $datum->arod_sphere != 'No Target' ? ($datum->arod_sphere > 0 ? '+' . $datum->arod_sphere : $datum->arod_sphere) . ' - ' . ($datum->arod_cylinder > 0 ? '+' . $datum->arod_cylinder : $datum->arod_cylinder) . ' x ' . $datum->arod_axis : 'No Refraction Possible' }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                            <strong>AR OS:</strong> <span class="text-primary">{{ $datum->aros_sphere != 'No Target' ? ($datum->aros_sphere > 0 ? '+' . $datum->aros_sphere : $datum->aros_sphere) . ' - ' . ($datum->aros_cylinder > 0 ? '+' . $datum->aros_cylinder : $datum->aros_cylinder) . ' x ' . $datum->aros_axis : 'No Refraction Possible' }}</span><br>
                            <strong>UCVA OD:</strong> <span class="text-primary">{{ $datum->vaod_den != '' ? $datum->vaod_num . ' / ' . $datum->vaod_den : $datum->vaod_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                            <strong>UCVA OD Present Correction:</strong> <span class="text-primary">{{ $datum->vaodcor_den != '' ? $datum->vaodcor_num . ' / ' . $datum->vaodcor_den : $datum->vaodcor_num }}</span><br>
                            <strong>UCVA OS:</strong> <span class="text-primary">{{ $datum->vaos_den != '' ? $datum->vaos_num . ' / ' . $datum->vaos_den : $datum->vaos_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                            <strong>UCVA OS Present Correction:</strong> <span class="text-primary">{{ $datum->vaoscor_den != '' ? $datum->vaoscor_num . ' / ' . $datum->vaoscor_den : $datum->vaoscor_num }}</span><br>
                            <strong>VA OD Pinhole:</strong> <span class="text-primary">{{ $datum->pinod_den != '' ? $datum->pinod_num . ' / ' . $datum->pinod_den : $datum->pinod_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                            <strong>BCVA OD:</strong> <span class="text-primary">{{ $datum->pinodcor_den != '' ? $datum->pinodcor_num . ' / ' . $datum->pinodcor_den : $datum->pinodcor_num }}</span><br>
                            <strong>VA OS Pinhole:</strong> <span class="text-primary">{{ $datum->pinos_den != '' ? $datum->pinos_num . ' / ' . $datum->pinos_den : $datum->pinos_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                            <strong>BCVA OS:</strong> <span class="text-primary">{{ $datum->pinoscor_den != '' ? $datum->pinoscor_num . ' / ' . $datum->pinoscor_den : $datum->pinoscor_num }}</span><br>
                            <strong>Jaeger OU:</strong> <span class="text-primary">{{ $datum->jae_ou }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                            <strong>Jaeger OD:</strong> <span class="text-primary">{{ $datum->jae_od }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                            <strong>Jaeger OS:</strong> <span class="text-primary">{{ $datum->jae_os }}</span><br>
                            <strong>IOP OD:</strong> <span class="text-primary">{{ $datum->iopod }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                            <strong>IOP OS:</strong> <span class="text-primary">{{ $datum->iopos }}</span>
                          </p>
                        </div>
                      </div>
                      @endif
                      <small class="text-muted">Helper</small>
                      <div class="input-group input-group-small flex-nowrap">
                        <select class="form-select" placeholder="" {{ isset($referal_conso) && $referal_conso->id == $cr->id  ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ isset($referal_conso) && $referal_conso->id == $cr->id  ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[docNotes]" @if($user->id == $cr->doctor->id) id="{{ $viewFolder }}_docNotes" @endif rows=3 {{ isset($referal_conso) && $referal_conso->id == $cr->id  ? 'required' : 'disabled' }} onchange="
                        $('#{{ $viewFolder }}_findings').val($(this).val());
                      ">{{ isset($cr->docNotes) ? $cr->docNotes : '' }}</textarea>
                      <small class="text-muted">Helper Save/Edit</small>
                      <div class="input-group input-group-small mb-3 flex-nowrap">
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                        </div>
                        <input type="text" class="form-control" id="{{ $viewFolder }}_docNotesTitle" name="{{ $viewFolder }}[docNotesTitle]" disabled>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                      </div>
                      <textarea class="form-control mb-2" name="{{ $viewFolder }}[_docNotesEdit]" id="{{ $viewFolder }}_docNotesEdit" rows=3 disabled></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mb-3">
                <div class="card-header">Assessment</div>
                <div class="card-body">
                  <div class="form-floating mb-3">
                    {{-- <select class="form-select" name="{{ $viewFolder }}[icd_code]" id="{{ $viewFolder }}_icd_code" placeholder="" {{ $user->id == $cr->doctor->id ? '' : 'disabled' }}>
                      <option value=""></option>
                    </select> --}}
                    <input class="form-control" list="icdCodeList" {{ isset($referal_conso) && $referal_conso->id == $cr->id  ? 'id=' . $viewFolder . '_icd_code' : '' }} name="{{ $viewFolder }}[icd_code]" value="{{ isset($cr->icd_code_obj->icd_code) ? $cr->icd_code_obj->icd_code . ' - ' . $cr->icd_code_obj->details : '' }}" autocomplete="off" {{ isset($referal_conso) && $referal_conso->id == $cr->id  ? '' : 'disabled' }}>
                    <label for="{{ $viewFolder }}_icd_code">Primary Diagnosis</label>
                    <small id="help_{{ $viewFolder }}_icd_code" class="text-muted"></small>
                  </div>
                  <div class="card mb-3">
                    <div class="card-header">Secondary Diagnosis</div>
                    <div class="card-body">
                      <small class="text-muted">Helper</small>
                      <div class="input-group input-group-small flex-nowrap">
                        <select class="form-select" placeholder="" {{ isset($referal_conso) && $referal_conso->id == $cr->id  ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ isset($referal_conso) && $referal_conso->id == $cr->id  ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[assessment]" @if($user->id == $cr->doctor->id) id="{{ $viewFolder }}_assessment" @endif rows=3 {{ isset($referal_conso) && $referal_conso->id == $cr->id  ? 'required' : 'disabled' }}  onchange="
                        $('#{{ $viewFolder }}_diagnosis').val($(this).val());
                      ">{{ isset($cr->assessment) ? $cr->assessment : '' }}</textarea>
                      <small class="text-muted">Helper Save/Edit</small>
                      <div class="input-group input-group-small mb-3 flex-nowrap">
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                        </div>
                        <input type="text" class="form-control" id="{{ $viewFolder }}_assessmentTitle" name="{{ $viewFolder }}[assessmentTitle]" disabled>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                      </div>
                      <textarea class="form-control mb-2" name="{{ $viewFolder }}[_assessmentEdit]" id="{{ $viewFolder }}_assessmentEdit" rows=3 disabled></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mb-3">
                <div class="card-header">Plan</div>
                <div class="card-body">
                  <div class="card mb-3">
                    <div class="card-header">Medical Therapeutics</div>
                    <div class="card-body">
                      <small class="text-muted">Helper</small>
                      <div class="input-group input-group-small flex-nowrap">
                        <select class="form-select" placeholder="" {{ isset($referal_conso) && $referal_conso->id == $cr->id  ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ isset($referal_conso) && $referal_conso->id == $cr->id  ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[planMed]" @if($user->id == $cr->doctor->id) id="{{ $viewFolder }}_planMed" @endif rows=3 {{ isset($referal_conso) && $referal_conso->id == $cr->id  ? 'required' : 'disabled' }}>{{ isset($cr->planMed) ? $cr->planMed : '' }}</textarea>
                      <small class="text-muted">Helper Save/Edit</small>
                      <div class="input-group input-group-small mb-3 flex-nowrap">
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                        </div>
                        <input type="text" class="form-control" id="{{ $viewFolder }}_planMedTitle" name="{{ $viewFolder }}[planMedTitle]" disabled>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                      </div>
                      <textarea class="form-control mb-2" name="{{ $viewFolder }}[_planMedEdit]" id="{{ $viewFolder }}_planMedEdit" rows=3 disabled></textarea>
                    </div>
                  </div>
                  <div class="card mb-3">
                    <div class="card-header">Diagnostics and Surgery</div>
                    <div class="card-body">
                      <small class="text-muted">Helper</small>
                      <div class="input-group input-group-small flex-nowrap">
                        <select class="form-select" placeholder="" {{ isset($referal_conso) && $referal_conso->id == $cr->id  ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ isset($referal_conso) && $referal_conso->id == $cr->id  ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[plan]" @if($user->id == $cr->doctor->id) id="{{ $viewFolder }}_plan" @endif rows=3 {{ isset($referal_conso) && $referal_conso->id == $cr->id  ? 'required' : 'disabled' }}>{{ isset($cr->plan) ? $cr->plan : '' }}</textarea>
                      <small class="text-muted">Helper Save/Edit</small>
                      <div class="input-group input-group-small mb-3 flex-nowrap">
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                        </div>
                        <input type="text" class="form-control" id="{{ $viewFolder }}_planTitle" name="{{ $viewFolder }}[planTitle]" disabled>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                      </div>
                      <textarea class="form-control mb-2" name="{{ $viewFolder }}[_planEdit]" id="{{ $viewFolder }}_planEdit" rows=3 disabled></textarea>
                    </div>
                  </div>
                  <div class="card mb-3">
                    <div class="card-header">Remarks</div>
                    <div class="card-body">
                      <small class="text-muted">Helper</small>
                      <div class="input-group input-group-small flex-nowrap">
                        <select class="form-select" placeholder="" {{ isset($referal_conso) && $referal_conso->id == $cr->id  ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ isset($referal_conso) && $referal_conso->id == $cr->id  ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[planRem]" @if($user->id == $cr->doctor->id) id="{{ $viewFolder }}_planRem" @endif rows=3 {{ isset($referal_conso) && $referal_conso->id == $cr->id  ? '' : 'disabled' }}>{{ isset($cr->planRem) ? $cr->planRem : '' }}</textarea>
                      <small class="text-muted">Helper Save/Edit</small>
                      <div class="input-group input-group-small mb-3 flex-nowrap">
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                        </div>
                        <input type="text" class="form-control" id="{{ $viewFolder }}_planRemTitle" name="{{ $viewFolder }}[planRemTitle]" disabled>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                      </div>
                      <textarea class="form-control mb-2" name="{{ $viewFolder }}[_planRemEdit]" id="{{ $viewFolder }}_planRemEdit" rows=3 disabled></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              @endforeach
            @endif
          </div>
          <div id="labCurDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            <h5>Image Viewer</h5>
            <div id="carouselCur" class="carousel carousel-dark slide mb-3" data-bs-interval="false">
              <div class="carousel-indicators" id="labCurCarouselInd">
                @if(!empty($datum->consultation_files[0]->file_link))
                  @foreach($datum->consultation_files as $ind=>$file)
                <button type="button" data-bs-target="#carouselCur" data-bs-slide-to="{{ $ind }}" {{ $ind == 0 ? 'class=active aria-current=true' : '' }} aria-label="Slide {{ $ind+1 }}"></button>
                  @endforeach
                @else
                <button type="button" data-bs-target="#carouselCur" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                @endif
              </div>
              <div class="carousel-inner" id="labCurCarouselInner">
                @if(!empty($datum->consultation_files[0]->file_link))
                  @foreach($datum->consultation_files as $ind=>$file)
                <div class="carousel-item {{ $ind == 0 ? 'active' : '' }}">
                  @if($file->file_type == 'application/pdf')
                  <iframe src="{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" width="100%" height="373" style="border:1"></iframe>
                  @else
                  <img src="{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" class="d-block w-100" alt="">
                  @endif
                </div>  
                  @endforeach
                @else
                <div class="carousel-item active">
                  {{-- <iframe src="{{ asset('MDR_030502009768.pdf') }}" width="100%" height="373" style="border:1"></iframe> --}}
                  <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" class="d-block w-100" alt="">
                </div>
                @endif
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselCur" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselCur" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
            <div class="mb-3">
              <label for="formFileMultiple" class="form-label">Uploaded Images/Files</label>
              <input class="form-control" type="file" id="{{ $viewFolder }}_files" name="{{ $viewFolder }}[ConsultationFile][files][]" accept="image/*, .pdf" multiple>
            </div>
            <div class="row overflow-auto" id="image_preview_saved" style="max-height:500px">
              
            </div>
            <div class="row" id="image_preview">
              @if(isset($datum->consultation_files))
                @foreach($datum->consultation_files as $ind => $file)
                @php
                  $exAr = explode('/', $file->file_link);
                @endphp
                @if($file->file_type == 'application/pdf')
              <div class='img-div' data-bs-target="#carouselCur" data-bs-slide-to="{{ $ind }}" id='img-div-save{{ $ind }}'><iframe src='{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}' class='img-thumbnail' title='{{ $exAr[sizeof($exAr)-1] }}'></iframe><div class='middle'><button id='action-icon' value='img-div-save{{ $ind }}' class='btn btn-danger' role='{{ $exAr[sizeof($exAr)-1] }}' saved='{{ $file->id }}'><i class='bi bi-trash'></i></button></div></div>
                @else
              <div class='img-div' data-bs-target="#carouselCur" data-bs-slide-to="{{ $ind }}" id='img-div-save{{ $ind }}'><img src='{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}' class='img-thumbnail' title='{{ $exAr[sizeof($exAr)-1] }}'><div class='middle'><button id='action-icon' value='img-div-save{{ $ind }}' class='btn btn-danger' role='{{ $exAr[sizeof($exAr)-1] }}' saved='{{ $file->id }}'><i class='bi bi-trash'></i></button></div></div>
                @endif
                @endforeach
              @endif
            </div>
          </div>
          {{-- @if($user->id == $datum->doctor->id) --}}
          <div id="presCurDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            <div class="docNotesDiv card mb-3" id="{{ $viewFolder }}_Presc_{{ $datum->id }}">
              <div class="card-header">Prescription View</div>
              <div class="card-body">
                <iframe id="iframePresc{{ $datum->id }}" src="{{ file_exists(public_path('storage/prescription_files/' . $datum->id . '_' . $datum->patient->l_name . '.pdf')) ? asset('storage/prescription_files/' . $datum->id . '_' . $datum->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" width="100%" height="300" style="border:1"></iframe>
                <small class="form-text text-muted">To print or download check the upper right part</small>
              </div>
              <div class="card-footer">
                @if(!isset($referal_conso))
                <button id="createPDFButPresc{{ $datum->id }}" type="button" class="createPDFButPresc btn btn-{{ $bgColor }} btn-sm" {{ $datum->prescription == '' ? 'disabled' : '' }} onclick="
                  $('#doctors_home_submit_type').val('Pause');
                  $.ajax({
                    type: 'POST',
                    data: $('#bookMod').serialize(),
                    url: '{{ Route::has($viewFolder . '.' . $formAction) ? route($viewFolder . '.' . $formAction, $datum->id) : ''}}',
                    success:
                    function (){
                        $.ajax({
                          type: 'GET',
                          url: '{{ Route::has($viewFolder . '.pdfPrescription') ? route($viewFolder . '.pdfPrescription', $datum->id) : '' }}',
                          success:
                          function (data){
                            $('#iframePresc{{ $datum->id }}').attr('src', data);
                          }
                        });
                    }
                  });

                ">Create PDF</button>
                @endif
              </div>
            </div>
            @if(isset($datum->consultation_referals[0]->id))
              @foreach($datum->consultation_referals as $cr)
            <div class="docNotesDiv card mb-3" id="{{ $viewFolder }}_Presc_{{ $cr->id }}" style="display:none">
              <div class="card-header">Prescription View</div>
              <div class="card-body">
                <iframe id="iframePresc{{ $cr->id }}" src="{{ file_exists(public_path('storage/prescription_files/' . $cr->id . '_' . $cr->patient->l_name . '.pdf')) ? asset('storage/prescription_files/' . $cr->id . '_' . $cr->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" width="100%" height="300" style="border:1"></iframe>
                <small class="form-text text-muted">To print or download check the upper right part</small>
              </div>
              <div class="card-footer">
                @if(isset($referal_conso) && $referal_conso->id == $cr->id)
                <button id="createPDFButPresc{{ $cr->id }}" type="button" class="createPDFButPresc btn btn-{{ $bgColor }} btn-sm" {{ $cr->prescription == '' ? 'disabled' : '' }} onclick="
                  $('#doctors_home_submit_type').val('Pause');
                  $.ajax({
                    type: 'POST',
                    data: $('#bookMod').serialize(),
                    url: '{{ Route::has($viewFolder . '.' . $formAction) ? route($viewFolder . '.' . $formAction, $datum->id) : ''}}',
                    success:
                    function (){
                        $.ajax({
                          type: 'GET',
                          url: '{{ Route::has($viewFolder . '.pdfPrescription') ? route($viewFolder . '.pdfPrescription', $cr->id) : '' }}',
                          success:
                          function (data){
                            $('#iframePresc{{ $cr->id }}').attr('src', data);
                          }
                        });
                    }
                  });

                ">Create PDF</button>
                @endif
              </div>
            </div>
              @endforeach
            @endif
            <div class="form-floating mb-3">
              <textarea class="form-control" name="{{ $viewFolder }}[Doctor][sub_header_1]" id="{{ $viewFolder }}_sub_header_1" rows=3>{{ isset($datum->doctor->sub_header_1) ? $datum->doctor->sub_header_1 : '' }}</textarea>
              <label for="{{ $viewFolder }}_sub_header_1" class="form-label">MD Specialty/sub-specialty</label>
              <small id="help_{{ $viewFolder }}_sub_header_1" class="text-muted"></small>
            </div>
            <div class="form-floating mb-3">
              <textarea class="form-control" name="{{ $viewFolder }}[Doctor][sub_header_2]" id="{{ $viewFolder }}_sub_header_2" rows=3>{{ isset($datum->doctor->sub_header_2) ? $datum->doctor->sub_header_2 : '' }}</textarea>
              <label for="{{ $viewFolder }}_sub_header_2" class="form-label">MD Clinic and Clinic Address:</label>
              <small id="help_{{ $viewFolder }}_sub_header_2" class="text-muted"></small>
            </div>
            <div class="card mb-3">
              <div class="card-header">Prescription</div>
              <div class="card-body">
                <small class="text-muted">Helper</small>
                <div class="input-group input-group-small flex-nowrap">
                  <select class="form-select" placeholder="" id="{{ $viewFolder }}_prescriptionSelect" {{ !isset($referal_conso) ? '' : 'disabled' }}>
                    <option value=""></option>
                  </select>
                  <button class="btn btn-outline-secondary" type="button" id="{{ $viewFolder }}_prescriptionDeleteHelper" {{ !isset($referal_conso) ? '' : 'disabled' }}>Delete Helper</button>
                </div>
                <small class="text-muted">Content</small>
                <textarea class="form-control" name="{{ $viewFolder }}[prescription]" id="{{ $viewFolder }}_prescription" {{ !isset($referal_conso) ? '' : 'disabled' }} rows=3 onblur="
                  if($(this).val() == ''){
                    $('.createPDFButPresc').each(function(){
                      $(this).prop('disabled', true);
                    });
                  }else{
                    $('.createPDFButPresc').each(function(){
                      $(this).prop('disabled', false);
                    });
                  }
                ">{{ isset($datum->prescription) ? $datum->prescription : '' }}</textarea>
                <small class="text-muted">Helper Save/Edit</small>
                <div class="input-group input-group-small mb-3 flex-nowrap">
                  <div class="input-group-text">
                    <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                  </div>
                  <input type="text" class="form-control" name="{{ $viewFolder }}[prescriptionTitle]" disabled>
                  <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                </div>
                <textarea class="form-control mb-2" name="{{ $viewFolder }}[prescriptionEdit]" id="{{ $viewFolder }}_prescriptionEdit" rows=3 disabled></textarea>
              </div>
            </div>
          </div>
          <div id="medCurDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            <div class="docNotesDiv card mb-3" id="{{ $viewFolder }}_MedCert_{{ $datum->id }}">
              <div class="card-header">Med Cert View</div>
              <div class="card-body">
                <iframe id="iframeMedCert{{ $datum->id }}" src="{{ file_exists(public_path('storage/med_cert_files/' . $datum->id . '_' . $datum->patient->l_name . '.pdf')) ? asset('storage/med_cert_files/' . $datum->id . '_' . $datum->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" width="100%" height="300" style="border:1"></iframe>
                <small class="form-text text-muted">To print or download check the upper right part</small>
              </div>
              <div class="card-footer">
                @if(!isset($referal_conso))
                <button id="createPDFButMedCert{{ $datum->id }}" type="button" class="createPDFButMedCert btn btn-{{ $bgColor }} btn-sm" {{ ($datum->findings == '' || $datum->diagnosis == '' || $datum->recommendations == '') ? 'disabled' : '' }} onclick="
                  $('#doctors_home_submit_type').val('Pause');
                  $.ajax({
                    type: 'POST',
                    data: $('#bookMod').serialize(),
                    url: '{{ Route::has($viewFolder . '.' . $formAction) ? route($viewFolder . '.' . $formAction, $datum->id) : '' }}',
                    success:
                    function (){
                        $.ajax({
                          type: 'GET',
                          url: '{{ Route::has($viewFolder . '.pdfMedCert') ? route($viewFolder . '.pdfMedCert', $datum->id) : '' }}',
                          success:
                          function (data){
                            $('#iframeMedCert{{ $datum->id }}').attr('src', data);
                          }
                        });
                    }
                  });

                ">Create PDF</button>
                @endif
              </div>
            </div>
            @if(isset($datum->consultation_referals[0]->id))
              @foreach($datum->consultation_referals as $cr)
            <div class="docNotesDiv card mb-3" id="{{ $viewFolder }}_MedCert_{{ $cr->id }}" style="display:none">
              <div class="card-header">Med Cert View</div>
              <div class="card-body">
                <iframe id="iframeMedCert{{ $cr->id }}" src="{{ file_exists(public_path('storage/med_cert_files/' . $cr->id . '_' . $cr->patient->l_name . '.pdf')) ? asset('storage/med_cert_files/' . $cr->id . '_' . $cr->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" width="100%" height="300" style="border:1"></iframe>
                <small class="form-text text-muted">To print or download check the upper right part</small>
              </div>
              <div class="card-footer">
                @if(isset($referal_conso) && $referal_conso->id == $cr->id)
                <button id="createPDFButMedCert{{ $cr->id }}" type="button" class="createPDFButMedCert btn btn-{{ $bgColor }} btn-sm" {{ ($cr->findings == '' || $cr->diagnosis == '' || $cr->recommendations == '') ? 'disabled' : '' }} onclick="
                  $('#doctors_home_submit_type').val('Pause');
                  $.ajax({
                    type: 'POST',
                    data: $('#bookMod').serialize(),
                    url: '{{ Route::has($viewFolder . '.' . $formAction) ? route($viewFolder . '.' . $formAction, $datum->id) : ''}}',
                    success:
                    function (){
                        $.ajax({
                          type: 'GET',
                          url: '{{ Route::has($viewFolder . '.pdfMedCert') ? route($viewFolder . '.pdfMedCert', $cr->id) : '' }}',
                          success:
                          function (data){
                            $('#iframeMedCert{{ $cr->id }}').attr('src', data);
                          }
                        });
                    }
                  });

                ">Create PDF</button>
                @endif
              </div>
            </div>
              @endforeach
            @endif
            <div class="form-floating mb-3">
              <textarea class="form-control" name="{{ $viewFolder }}[findings]" id="{{ $viewFolder }}_findings" {{ !isset($referal_conso) ? '' : 'disabled' }} rows=3 onblur="
                  if($('#{{ $viewFolder }}_findings').val() == '' || $('#{{ $viewFolder }}_diagnosis').val() == '' || $('#{{ $viewFolder }}_recommendations').val() == ''){
                    $('.createPDFButMedCert').each(function(){
                      $(this).prop('disabled', true);
                    });
                  }else{
                    $('.createPDFButMedCert').each(function(){
                      $(this).prop('disabled', false);
                    });
                  }
                ">{{ isset($datum->findings) ? $datum->findings : '' }}</textarea>
              <label for="{{ $viewFolder }}_findings" class="form-label">Findings</label>
              <small id="help_{{ $viewFolder }}_findings" class="text-muted"></small>
            </div>
            <div class="form-floating mb-3">
              <textarea class="form-control" name="{{ $viewFolder }}[diagnosis]" id="{{ $viewFolder }}_diagnosis" {{ !isset($referal_conso) ? '' : 'disabled' }} rows=3 onblur="
                  if($('#{{ $viewFolder }}_findings').val() == '' || $('#{{ $viewFolder }}_diagnosis').val() == '' || $('#{{ $viewFolder }}_recommendations').val() == ''){
                    $('.createPDFButMedCert').each(function(){
                      $(this).prop('disabled', true);
                    });
                  }else{
                    $('.createPDFButMedCert').each(function(){
                      $(this).prop('disabled', false);
                    });
                  }
                ">{{ isset($datum->diagnosis) ? $datum->diagnosis : '' }}</textarea>
              <label for="{{ $viewFolder }}_diagnosis" class="form-label">Diagnosis</label>
              <small id="help_{{ $viewFolder }}_diagnosis" class="text-muted"></small>
            </div>
            <div class="form-floating mb-3">
              <textarea class="form-control" name="{{ $viewFolder }}[recommendations]" id="{{ $viewFolder }}_recommendations" {{ !isset($referal_conso) ? '' : 'disabled' }} rows=3 onblur="
                  if($('#{{ $viewFolder }}_findings').val() == '' || $('#{{ $viewFolder }}_diagnosis').val() == '' || $('#{{ $viewFolder }}_recommendations').val() == ''){
                    $('.createPDFButMedCert').each(function(){
                      $(this).prop('disabled', true);
                    });
                  }else{
                    $('.createPDFButMedCert').each(function(){
                      $(this).prop('disabled', false);
                    });
                  }
                ">{{ isset($datum->recommendations) ? $datum->recommendations : '' }}</textarea>
              <label for="{{ $viewFolder }}_recommendations" class="form-label">Recommendations</label>
              <small id="help_{{ $viewFolder }}_recommendations" class="text-muted"></small>
            </div>
          </div>
          <div id="admitCurDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            <div class="docNotesDiv card mb-3" id="{{ $viewFolder }}_Admitting_{{ $datum->id }}">
              <div class="card-header">Admitting Orders Preview</div>
              <div class="card-body">
                <iframe id="iframeAdmitting{{ $datum->id }}" src="{{ file_exists(public_path('storage/admitting_order_files/' . $datum->id . '_' . $datum->patient->l_name . '.pdf')) ? asset('storage/admitting_order_files/' . $datum->id . '_' . $datum->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" width="100%" height="300" style="border:1"></iframe>
                <small class="form-text text-muted">To print or download check the upper right part</small>
              </div>
              <div class="card-footer">
                @if(!isset($referal_conso))
                <button id="createPDFButAddmitting{{ $datum->id }}" type="button" class="createPDFButAddmitting btn btn-{{ $bgColor }} btn-sm" {{ ($datum->procedure_ao == '' || $datum->admittingOrder == '') ? 'disabled' : '' }} onclick="
                  $('#doctors_home_submit_type').val('Pause');
                  $.ajax({
                    type: 'POST',
                    data: $('#bookMod').serialize(),
                    url: '{{ Route::has($viewFolder . '.' . $formAction) ? route($viewFolder . '.' . $formAction, $datum->id) : ''}}',
                    success:
                    function (data){
                        $.ajax({
                          type: 'GET',
                          url: '{{ Route::has($viewFolder . '.pdfAdmitting') ? route($viewFolder . '.pdfAdmitting', $datum->id) : '' }}',
                          success:
                          function (data){
                            $('#iframeAdmitting{{ $datum->id }}').attr('src', data);
                            // var iFrame = $('#iframeAdmitting');
                            // iFrame.load(data);
                            // $('#iframeAdmitting').attr('src', $('#iframeAdmitting').attr('src'));
                          }
                        });
                    }
                  });
                ">Create PDF</button>
                @endif
              </div>
            </div>
            @if(isset($datum->consultation_referals[0]->id))
              @foreach($datum->consultation_referals as $cr)
            <div class="docNotesDiv card mb-3" id="{{ $viewFolder }}_Admitting_{{ $cr->id }}" style="display:none">
              <div class="card-header">Admitting Orders Preview</div>
              <div class="card-body">
                <iframe id="iframeAdmitting{{ $cr->id }}" src="{{ file_exists(public_path('storage/admitting_order_files/' . $cr->id . '_' . $cr->patient->l_name . '.pdf')) ? asset('storage/admitting_order_files/' . $cr->id . '_' . $cr->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" width="100%" height="300" style="border:1"></iframe>
                <small class="form-text text-muted">To print or download check the upper right part</small>
              </div>
              <div class="card-footer">
                @if(isset($referal_conso) && $referal_conso->id == $cr->id)
                <button id="createPDFButAddmitting{{ $cr->id }}" type="button" class="createPDFButAddmitting btn btn-{{ $bgColor }} btn-sm" {{ ($cr->procedure_ao == '' || $cr->admittingOrder == '') ? 'disabled' : '' }} onclick="
                  $('#doctors_home_submit_type').val('Pause');
                  $.ajax({
                    type: 'POST',
                    data: $('#bookMod').serialize(),
                    url: '{{ Route::has($viewFolder . '.' . $formAction) ? route($viewFolder . '.' . $formAction, $datum->id) : ''}}',
                    success:
                    function (data){
                        $.ajax({
                          type: 'GET',
                          url: '{{ Route::has($viewFolder . '.pdfAdmitting') ? route($viewFolder . '.pdfAdmitting', $cr->id) : '' }}',
                          success:
                          function (data){
                            $('#iframeAdmitting{{ $cr->id }}').attr('src', data);
                            // var iFrame = $('#iframeAdmitting');
                            // iFrame.load(data);
                            // $('#iframeAdmitting').attr('src', $('#iframeAdmitting').attr('src'));
                          }
                        });
                    }
                  });
                ">Create PDF</button>
                @endif
              </div>
            </div>
              @endforeach
            @endif
            <div class="form-floating mb-3">
              <input class="form-control" type="date" name="{{ $viewFolder }}[con_date_ao]" id="{{ $viewFolder }}_con_date_ao" value="{{ isset($datum->con_date_ao) ? $datum->con_date_ao : '' }}" placeholder="" {{ !isset($referal_conso) ? '' : 'disabled' }}>
              <label for="{{ $viewFolder }}_con_date_ao" class="form-label">Contemplated Date of Procedure</label>
              <small id="help_{{ $viewFolder }}_con_date_ao" class="text-muted"></small>
            </div>
            <div class="card mb-3">
              <div class="card-header">Procedure</div>
              <div class="card-body">
                <small class="text-muted">Helper</small>
                <div class="input-group input-group-small flex-nowrap">
                  <select class="form-select" id="{{ $viewFolder }}_procedure_aoSelect" placeholder="" {{ !isset($referal_conso) ? '' : 'disabled' }}>
                    <option value=""></option>
                  </select>
                  <button class="btn btn-outline-secondary" type="button" id="{{ $viewFolder }}_procedure_aoHelperDelete" {{ !isset($referal_conso) ? '' : 'disabled' }}>Delete Helper</button>
                </div>
                <small class="text-muted">Content</small>
                <textarea class="form-control" name="{{ $viewFolder }}[procedure_ao]" id="{{ $viewFolder }}_procedure_ao" {{ !isset($referal_conso) ? '' : 'disabled' }} rows=3 onblur="
                    if(($('#{{ $viewFolder }}_procedure_ao').val() || $('#{{ $viewFolder }}_admittingOrder').val()) == ''){
                        $('.createPDFButAddmitting').each(function(){
                        $(this).prop('disabled', true);
                      });
                    }else{
                      $('.createPDFButAddmitting').each(function(){
                        $(this).prop('disabled', false);
                      });
                    }
                  ">{{ isset($datum->procedure_ao) ? $datum->procedure_ao : '' }}</textarea>
                <small class="text-muted">Helper Save/Edit</small>
                <div class="input-group input-group-small mb-3 flex-nowrap">
                  <div class="input-group-text">
                    <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                  </div>
                  <input type="text" class="form-control" name="{{ $viewFolder }}[_procedure_aoTitle]" disabled>
                  <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                </div>
                <textarea class="form-control mb-2" name="{{ $viewFolder }}[procedure_aoEdit]" id="{{ $viewFolder }}_procedure_aoEdit" rows=3 disabled></textarea>
              </div>
            </div>
            <div class="form-floating mb-3">
              <select class="form-select" name="{{ $viewFolder }}[anesthesia_type_ao]" id="{{ $viewFolder }}_anesthesia_type_ao" placeholder="" {{ !isset($referal_conso) ? '' : 'disabled' }}>
                <option value="None" {{ (isset($datum->anesthesia_type_ao) && $datum->anesthesia_type_ao == 'None') ? 'selected' : ''}}>None</option>
                <option value="Regional Block" {{ (isset($datum->anesthesia_type_ao) && $datum->anesthesia_type_ao == 'Regional Block') ? 'selected' : ''}}>Regional Block</option>
                <option value="IV Sedation" {{ (isset($datum->anesthesia_type_ao) && $datum->anesthesia_type_ao == 'IV Sedation') ? 'selected' : ''}}>IV Sedation</option>
                <option value="General Anesthesia" {{ (isset($datum->anesthesia_type_ao) && $datum->anesthesia_type_ao == 'General Anesthesia') ? 'selected' : ''}}>General Anesthesia</option>
              </select>
              <label for="{{ $viewFolder }}_anesthesia_type_ao">Anesthesia Type</label>
              <small id="help_{{ $viewFolder }}_anesthesia_type_ao" class="text-muted"></small>
            </div>
            <div class="form-floating mb-3">
              <input class="form-control" type="text" name="{{ $viewFolder }}[anesthesiologist_ao]" id="{{ $viewFolder }}_anesthesiologist_ao" placeholder="" value="{{ isset($datum->anesthesiologist_ao) ? $datum->anesthesiologist_ao : '' }}" {{ !isset($referal_conso) ? '' : 'disabled' }}>
              <label for="{{ $viewFolder }}_anesthesiologist_ao" class="form-label">Anesthesiologist</label>
              <small id="help_{{ $viewFolder }}_anesthesiologist_ao" class="text-muted"></small>
            </div>
            <div class="card mb-3">
              <div class="card-header">Admitting Details</div>
              <div class="card-body">
                <small class="text-muted">Helper</small>
                <div class="input-group input-group-small flex-nowrap">
                  <select class="form-select" id="{{ $viewFolder }}_admittingOrderSelect" placeholder="" {{ !isset($referal_conso) ? '' : 'disabled' }}>
                    <option value=""></option>
                  </select>
                  <button class="btn btn-outline-secondary" type="button" id="{{ $viewFolder }}_admittingOrderHelperDelete" {{ !isset($referal_conso) ? '' : 'disabled' }}>Delete Helper</button>
                </div>
                <small class="text-muted">Content</small>
                <textarea class="form-control" name="{{ $viewFolder }}[admittingOrder]" id="{{ $viewFolder }}_admittingOrder" {{ !isset($referal_conso) ? '' : 'disabled' }} rows=3 onblur="
                    if(($('#{{ $viewFolder }}_procedure_ao').val() || $('#{{ $viewFolder }}_admittingOrder').val()) == ''){
                      $('.createPDFButAddmitting').each(function(){
                        $(this).prop('disabled', true);
                      });
                    }else{
                      $('.createPDFButAddmitting').each(function(){
                        $(this).prop('disabled', false);
                      });
                    }
                  ">{{ isset($datum->admittingOrder) ? $datum->admittingOrder : '' }}</textarea>
                <small class="text-muted">Helper Save/Edit</small>
                <div class="input-group input-group-small mb-3 flex-nowrap">
                  <div class="input-group-text">
                    <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                  </div>
                  <input type="text" class="form-control" name="{{ $viewFolder }}[admittingOrderTitle]" disabled>
                  <button class="btn btn-outline-secondary" type="button" id="button-addon2">Save</button>
                </div>
                <textarea class="form-control mb-2" name="{{ $viewFolder }}[admittingOrderEdit]" id="{{ $viewFolder }}_admittingOrderEdit" rows=3 disabled></textarea>
              </div>
            </div>
          </div>
          {{-- @endif --}}
        </div>
      </div>
    </div>
    
  </div>
</div>

<script>
  function loadPrevBooking(consultation_id, index){
    $.ajax({
      type: 'GET',
      url: '{{ Route::has($viewFolder . '.getPrevBookingInfo') ? route($viewFolder . '.getPrevBookingInfo') : ''}}/' + consultation_id + '/' + index,
      success:
        function(data, status){
          bookingObj = jQuery.parseJSON(data);

          if(bookingObj.parent_consultation.id != ''){
            orig_booking = bookingObj.consultation;
            bookingObj.consultation = bookingObj.parent_consultation;
          }

          $('#prevBookingDater').text(bookingObj.consultation.bookingDate);
          vitalStr = '<strong>Temp:</strong> ' + bookingObj.consultation.temp + 'C | <strong>Height:</strong> ' + bookingObj.consultation.height + 'cm | <strong>Weight:</strong> ' + bookingObj.consultation.weight + 'kg | <strong>BMI:</strong> ' + Math.round(bookingObj.consultation.weight/((bookingObj.consultation.height/100)*(bookingObj.consultation.height/100))) + '<br><strong>BP:</strong> ' + bookingObj.consultation.bpS + '/' + bookingObj.consultation.bpD + ' | <strong>O2 Sat:</strong> ' + bookingObj.consultation.o2 + '% | <strong>Heart Rate:</strong> ' + bookingObj.consultation.heart + 'beats/min';
          $('#prevVitaler').html(vitalStr);
          $('#prevProcDet').html(bookingObj.consultation.procedure_details);
          $('#prevSumProcDet').html(bookingObj.consultation.procedure_details);
          $('#prevPatComp').html(bookingObj.consultation.complains);
          $('#prevSumPatComp').html(bookingObj.consultation.complains);
          $('#prevPatCompDur').html(bookingObj.consultation.duration);
          $('#prevSumPatCompDur').html(bookingObj.consultation.duration);
          eyeStr = '';
          if(bookingObj.consultation.arod_sphere == 'No Target')
            eyeStr += '<strong>AR OD:</strong> <span class="text-primary">No Refraction Possible</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          else
            eyeStr += '<strong>AR OD:</strong> <span class="text-primary">' + bookingObj.consultation.arod_sphere + ' - ' + bookingObj.consultation.arod_cylinder + ' x ' + bookingObj.consultation.arod_axis + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          
          if(bookingObj.consultation.aros_sphere == 'No Target')
            eyeStr += '<strong>AR OS:</strong> <span class="text-primary">No Refraction Possible</span><br> ';
          else
            eyeStr += '<strong>AR OS:</strong> <span class="text-primary">' + bookingObj.consultation.aros_sphere + ' - ' + bookingObj.consultation.aros_cylinder + ' x ' + bookingObj.consultation.aros_axis + '</span><br> ';
          
          if(bookingObj.consultation.vaod_den == '')
            eyeStr += '<strong>UCVA OD:</strong> <span class="text-primary">' + bookingObj.consultation.vaod_num + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          else
            eyeStr += '<strong>UCVA OD:</strong> <span class="text-primary">' + bookingObj.consultation.vaod_num + ' / ' + bookingObj.consultation.vaod_den + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          
          if(bookingObj.consultation.vaodcor_den == '')
            eyeStr += '<strong>UCVA OD Present Correction:</strong> <span class="text-primary">' + bookingObj.consultation.vaodcor_num + '</span><br> ';
          else
            eyeStr += '<strong>UCVA OD Present Correction:</strong> <span class="text-primary">' + bookingObj.consultation.vaodcor_num + ' / ' + bookingObj.consultation.vaodcor_den + '</span><br> ';
          
          if(bookingObj.consultation.vaos_den == '')
            eyeStr += '<strong>UCVA OS:</strong> <span class="text-primary">' + bookingObj.consultation.vaos_num + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          else
            eyeStr += '<strong>UCVA OS:</strong> <span class="text-primary">' + bookingObj.consultation.vaos_num + ' / ' + bookingObj.consultation.vaos_den + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';

          if(bookingObj.consultation.vaoscor_den == '')
            eyeStr += '<strong>UCVA OS Present Correction:</strong> <span class="text-primary">' + bookingObj.consultation.vaoscor_num + '</span><br> ';
          else
            eyeStr += '<strong>UCVA OS Present Correction:</strong> <span class="text-primary">' + bookingObj.consultation.vaoscor_num + ' / ' + bookingObj.consultation.vaoscor_den + '</span><br> ';
          
          if(bookingObj.consultation.pinod_den == '')
            eyeStr += '<strong>VA OD Pinhole:</strong> <span class="text-primary">' + bookingObj.consultation.pinod_num + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          else
            eyeStr += '<strong>VA OD Pinhole:</strong> <span class="text-primary">' + bookingObj.consultation.pinod_num + ' / ' + bookingObj.consultation.pinod_den + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          
          if(bookingObj.consultation.pinodcor_den == '')
            eyeStr += '<strong>BCVA OD:</strong> <span class="text-primary">' + bookingObj.consultation.pinodcor_num + '</span><br> ';
          else
            eyeStr += '<strong>BCVA OD:</strong> <span class="text-primary">' + bookingObj.consultation.pinodcor_num + ' / ' + bookingObj.consultation.pinodcor_den + '</span><br> ';
          
          if(bookingObj.consultation.pinos_den == '')
            eyeStr += '<strong>VA OS Pinhole:</strong> <span class="text-primary">' + bookingObj.consultation.pinos_num + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          else
            eyeStr += '<strong>VA OS Pinhole:</strong> <span class="text-primary">' + bookingObj.consultation.pinos_num + ' / ' + bookingObj.consultation.pinos_den + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          
          if(bookingObj.consultation.pinodcor_den == '')
            eyeStr += '<strong>BCVA OS:</strong> <span class="text-primary">' + bookingObj.consultation.pinoscor_num + '</span><br> ';
          else
            eyeStr += '<strong>BCVA OS:</strong> <span class="text-primary">' + bookingObj.consultation.pinoscor_num + ' / ' + bookingObj.consultation.pinoscor_den + '</span><br> ';
          
          eyeStr += '<strong>Jaeger OU:</strong> <span class="text-primary">' + bookingObj.consultation.jae_ou + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          eyeStr += '<strong>Jaeger OD:</strong> <span class="text-primary">' + bookingObj.consultation.jae_od + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          eyeStr += '<strong>Jaeger OS:</strong> <span class="text-primary">' + bookingObj.consultation.jae_os + '</span><br> ';
          eyeStr += '<strong>IOP OD:</strong> <span class="text-primary">' + bookingObj.consultation.iopod + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          eyeStr += '<strong>IOP OS:</strong> <span class="text-primary">' + bookingObj.consultation.iopos + '</span>';
          $('#prevEyer').html(eyeStr);
          $('#prevEyerSum').html(eyeStr);

          if(bookingObj.parent_consultation.id != ''){
            bookingObj.consultation = orig_booking;
          }

          $('#{{ $viewFolder }}_prev_docNotesHPI').val(bookingObj.consultation.docNotesHPI);
          $('#{{ $viewFolder }}_prev_sum_docNotesHPI').html(bookingObj.consultation.docNotesHPI);
          $('#{{ $viewFolder }}_prev_docNotesSubject').val(bookingObj.consultation.docNotesSubject);
          $('#{{ $viewFolder }}_prev_sum_docNotesSubject').html(bookingObj.consultation.docNotesSubject);
          $('#{{ $viewFolder }}_prev_docNotes').val(bookingObj.consultation.docNotes);
          $('#{{ $viewFolder }}_prev_sum_docNotes').html(bookingObj.consultation.docNotes);
          if(bookingObj.consultation.icd_code_obj != null){
            $('#{{ $viewFolder }}_prev_icd_code').val(bookingObj.consultation.icd_code_obj.icd_code + ' - ' + bookingObj.consultation.icd_code_obj.details);
            $('#{{ $viewFolder }}_prev_sum_icd_code').html(bookingObj.consultation.icd_code_obj.icd_code + ' - ' + bookingObj.consultation.icd_code_obj.details);
          }
          $('#{{ $viewFolder }}_prev_assessment').val(bookingObj.consultation.assessment);
          $('#{{ $viewFolder }}_prev_sum_assessment').html(bookingObj.consultation.assessment);
          $('#{{ $viewFolder }}_prev_plan').val(bookingObj.consultation.plan);
          $('#{{ $viewFolder }}_prev_sum_plan').html(bookingObj.consultation.plan);
          $('#{{ $viewFolder }}_prev_planMed').val(bookingObj.consultation.planMed);
          $('#{{ $viewFolder }}_prev_sum_planMed').html(bookingObj.consultation.planMed);
          $('#{{ $viewFolder }}_prev_planRem').val(bookingObj.consultation.planRem);
          $('#{{ $viewFolder }}_prevsum_planRem').html(bookingObj.consultation.planRem);
          // $('#{{ $viewFolder }}_findings').val(bookingObj.consultation.findings);
          // $('#{{ $viewFolder }}_diagnosis').val(bookingObj.consultation.diagnosis);
          // $('#{{ $viewFolder }}_recommendations').val(bookingObj.consultation.recommendations);
          $('#iframePrevPresc').attr('src', bookingObj.consultation.iframePrevPrescSrc);
          $('#iframePrevMedCert').attr('src', bookingObj.consultation.iframePrevMedCertSrc);
          $('#iframePrevAdmitting').attr('src', bookingObj.consultation.iframePrevAdmittingSrc);

          if(bookingObj.consultation_files !== undefined){
            inner = '';
            indicator = '';
            grid = '';
            bookingObj.consultation_files.forEach(function(item, index){
              if(item.file_link.includes('.pdf')){
                if(item.file_link.includes('uploads'))
                  item.file_link = item.file_link.replace('uploads', 'storage/uploads');
                if(index == 0){
                  indicator = '<button type="button" data-bs-target="#carouselPrev" data-bs-slide-to="' + index + '" class="active" aria-current="true" aria-label="Slide ' + (index+1) + '"></button>'
                  inner = '<div class="carousel-item active"><iframe src="' + item.file_link + '" class="d-block w-100" alt=""></iframe></div>';
                }else{
                  indicator += '<button type="button" data-bs-target="#carouselPrev" data-bs-slide-to="' + index + '" aria-label="Slide ' + (index+1) + '"></button>'
                  inner += '<div class="carousel-item"><iframe src="' + item.file_link + '" class="d-block w-100" alt=""></iframe></div>';
                }
                grid += '<div class="img-div" data-bs-target="#carouselPrev" data-bs-slide-to="' + index + '" id="img-div-save' + index + '""><iframe src="' + item.file_link + '" class="img-thumbnail"></iframe><div class="middle"><button id="action-icon" value="img-div-save' + index + '" class="btn btn-danger" disabled><i class="bi bi-trash"></i></button></div></div>';
              }else{
                if(item.file_link.includes('uploads'))
                  item.file_link = item.file_link.replace('uploads', 'storage/uploads');
                if(index == 0){
                  indicator = '<button type="button" data-bs-target="#carouselPrev" data-bs-slide-to="' + index + '" class="active" aria-current="true" aria-label="Slide ' + (index+1) + '"></button>'
                  inner = '<div class="carousel-item active"><img src="' + item.file_link + '" class="d-block w-100" alt=""></div>';
                }else{
                  indicator += '<button type="button" data-bs-target="#carouselPrev" data-bs-slide-to="' + index + '" aria-label="Slide ' + (index+1) + '"></button>'
                  inner += '<div class="carousel-item"><img src="' + item.file_link + '" class="d-block w-100" alt=""></div>';
                }
                grid += '<div class="img-div" data-bs-target="#carouselPrev" data-bs-slide-to="' + index + '" id="img-div-save' + index + '""><img src="' + item.file_link + '" class="img-thumbnail"><div class="middle"><button id="action-icon" value="img-div-save' + index + '" class="btn btn-danger" disabled><i class="bi bi-trash"></i></button></div></div>';
              }
              
            });
            $('#labPrevCarouselInd').html(indicator);
            $('#labPrevCarouselInner').html(inner);
            $('#image_preview_prev_saved').html(grid);
          }else{
            $('#labPrevCarouselInd').html('<button type="button" data-bs-target="#carouselPrev" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>');
            $('#labPrevCarouselInner').html('<div class="carousel-item active"><img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" class="d-block w-100" alt=""></div>');
            $('#image_preview_prev_saved').html('');
          }
        }
    });
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
        } 
        // else {
          
        //   fileArr.push(total_file[i]);
        //   if(total_file[i].name.split('.')[1] == 'pdf')
        //     $('#image_preview').append("<div class='img-div' id='img-div"+i+"'><iframe src='"+URL.createObjectURL(event.target.files[i])+"' class='img-thumbnail' title='"+total_file[i].name+"'></iframe><div class='middle'><button id='action-icon' value='img-div"+i+"' class='btn btn-danger' role='"+total_file[i].name+"'><i class='bi bi-trash'></i></button></div></div>");
        //   else
        //     $('#image_preview').append("<div class='img-div' id='img-div"+i+"'><img src='"+URL.createObjectURL(event.target.files[i])+"' class='img-thumbnail' title='"+total_file[i].name+"'><div class='middle'><button id='action-icon' value='img-div"+i+"' class='btn btn-danger' role='"+total_file[i].name+"'><i class='bi bi-trash'></i></button></div></div>");
        // }
      }
      $('#doctors_home_submit_type').val('Pause');
      $.ajax({
        type: 'POST',
        data: new FormData($("#bookMod")[0]),
        processData: false,
        contentType: false,
        url: '{{ Route::has($viewFolder . '.' . $formAction) ? route($viewFolder . '.' . $formAction, !isset($referal_conso) ? $datum->id : $referal_conso->id) : ''}}',
        success:
          function (){
            $.ajax({
              type: 'GET',
              url: '{{ Route::has($viewFolder . '.getPrevBookingInfo') ? route($viewFolder . '.getPrevBookingInfo') : ''}}/{{ $datum->id }}/0',
              success:
                function(data, status){
                  bookingObj = jQuery.parseJSON(data);
                  if(bookingObj.consultation_files !== undefined){
                    inner = '';
                    indicator = '';
                    grid = '';
                    bookingObj.consultation_files.forEach(function(item, index){
                      if(item.file_link.includes('.pdf')){
                        if(item.file_link.includes('uploads'))
                          item.file_link = item.file_link.replace('uploads', 'storage/uploads');
                        if(index == 0){
                          indicator = '<button type="button" data-bs-target="#carouselCur" data-bs-slide-to="' + index + '" class="active" aria-current="true" aria-label="Slide ' + (index+1) + '"></button>'
                          inner = '<div class="carousel-item active"><iframe src="' + item.file_link + '" class="d-block w-100" alt=""></iframe></div>';
                        }else{
                          indicator += '<button type="button" data-bs-target="#carouselCur" data-bs-slide-to="' + index + '" aria-label="Slide ' + (index+1) + '"></button>'
                          inner += '<div class="carousel-item"><iframe src="' + item.file_link + '" class="d-block w-100" alt=""></iframe></div>';
                        }
                        grid += '<div class="img-div" data-bs-target="#carouselCur" data-bs-slide-to="' + index + '" id="img-div-save' + index + '""><iframe src="' + item.file_link + '" class="img-thumbnail" title="' + item.file_link.split("/")[item.file_link.split("/").length - 1] + '"></iframe><div class="middle"><button id="action-icon" value="img-div-save' + index + '" class="btn btn-danger" saved="' + item.id + '"><i class="bi bi-trash"></i></button></div></div>';
                      }else{
                        if(item.file_link.includes('uploads'))
                          item.file_link = item.file_link.replace('uploads', 'storage/uploads');
                        if(index == 0){
                          indicator = '<button type="button" data-bs-target="#carouselCur" data-bs-slide-to="' + index + '" class="active" aria-current="true" aria-label="Slide ' + (index+1) + '"></button>'
                          inner = '<div class="carousel-item active"><img src="' + item.file_link + '" class="d-block w-100" alt=""></div>';
                        }else{
                          indicator += '<button type="button" data-bs-target="#carouselCur" data-bs-slide-to="' + index + '" aria-label="Slide ' + (index+1) + '"></button>'
                          inner += '<div class="carousel-item"><img src="' + item.file_link + '" class="d-block w-100" alt=""></div>';
                        }
                        grid += '<div class="img-div" data-bs-target="#carouselCur" data-bs-slide-to="' + index + '" id="img-div-save' + index + '""><img src="' + item.file_link + '" class="img-thumbnail" title="' + item.file_link.split("/")[item.file_link.split("/").length - 1] + '"><div class="middle"><button id="action-icon" value="img-div-save' + index + '" class="btn btn-danger" saved="' + item.id + '"><i class="bi bi-trash"></i></button></div></div>';
                      }
                      
                    });
                    $('#labCurCarouselInd').html(indicator);
                    $('#labCurCarouselInner').html(inner);
                    $('#image_preview').html(grid);
                  }else{
                    $('#labCurCarouselInd').html('<button type="button" data-bs-target="#carouselCur" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>');
                    $('#labCurCarouselInner').html('<div class="carousel-item active"><img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" class="d-block w-100" alt=""></div>');
                    $('#image_preview').html('');
                  }
                  
                }
                
            });
            document.getElementById('{{ $viewFolder }}_files').files = FileListItem(fileArr);
          }
      });
      
     
    });
    
    $('body').on('click', '#action-icon', function(evt){
        var divName = this.value;
        var fileName = $(this).attr('role');
        if($(this).attr('saved') != ''){
          $.ajax({
            type: 'GET',
            url: '{{ Route::has('clinics_home.deleteUploadedFile') ? route('clinics_home.deleteUploadedFile') : ''}}/' + $(this).attr('saved'),
            success:
              function (){
                $.ajax({
                  type: 'GET',
                  url: '{{ Route::has($viewFolder . '.getPrevBookingInfo') ? route($viewFolder . '.getPrevBookingInfo') : ''}}/{{ $datum->id }}/0',
                  success:
                    function(data, status){
                      bookingObj = jQuery.parseJSON(data);
                      if(bookingObj.consultation_files !== undefined){
                        inner = '';
                        indicator = '';
                        grid = '';
                        bookingObj.consultation_files.forEach(function(item, index){
                          if(item.file_link.includes('.pdf')){
                            if(item.file_link.includes('uploads'))
                              item.file_link = item.file_link.replace('uploads', 'storage/uploads');
                            if(index == 0){
                              indicator = '<button type="button" data-bs-target="#carouselCur" data-bs-slide-to="' + index + '" class="active" aria-current="true" aria-label="Slide ' + (index+1) + '"></button>'
                              inner = '<div class="carousel-item active"><iframe src="' + item.file_link + '" class="d-block w-100" alt=""></iframe></div>';
                            }else{
                              indicator += '<button type="button" data-bs-target="#carouselCur" data-bs-slide-to="' + index + '" aria-label="Slide ' + (index+1) + '"></button>'
                              inner += '<div class="carousel-item"><iframe src="' + item.file_link + '" class="d-block w-100" alt=""></iframe></div>';
                            }
                            grid += '<div class="img-div" data-bs-target="#carouselCur" data-bs-slide-to="' + index + '" id="img-div-save' + index + '""><iframe src="' + item.file_link + '" class="img-thumbnail" title="' + item.file_link.split("/")[item.file_link.split("/").length - 1] + '></iframe><div class="middle"><button id="action-icon" value="img-div-save' + index + '" class="btn btn-danger" saved="' + item.id + '"><i class="bi bi-trash"></i></button></div></div>';
                          }else{
                            if(item.file_link.includes('uploads'))
                              item.file_link = item.file_link.replace('uploads', 'storage/uploads');
                            if(index == 0){
                              indicator = '<button type="button" data-bs-target="#carouselCur" data-bs-slide-to="' + index + '" class="active" aria-current="true" aria-label="Slide ' + (index+1) + '"></button>'
                              inner = '<div class="carousel-item active"><img src="' + item.file_link + '" class="d-block w-100" alt=""></div>';
                            }else{
                              indicator += '<button type="button" data-bs-target="#carouselCur" data-bs-slide-to="' + index + '" aria-label="Slide ' + (index+1) + '"></button>'
                              inner += '<div class="carousel-item"><img src="' + item.file_link + '" class="d-block w-100" alt=""></div>';
                            }
                            grid += '<div class="img-div" data-bs-target="#carouselCur" data-bs-slide-to="' + index + '" id="img-div-save' + index + '""><img src="' + item.file_link + '" class="img-thumbnail" title="' + item.file_link.split("/")[item.file_link.split("/").length - 1] + '"><div class="middle"><button id="action-icon" value="img-div-save' + index + '" class="btn btn-danger" saved="' + item.id + '""><i class="bi bi-trash"></i></button></div></div>';
                          }
                          
                        });
                        $('#labCurCarouselInd').html(indicator);
                        $('#labCurCarouselInner').html(inner);
                        $('#image_preview').html(grid);
                      }else{
                        $('#labCurCarouselInd').html('<button type="button" data-bs-target="#carouselCur" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>');
                        $('#labCurCarouselInner').html('<div class="carousel-item active"><img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" class="d-block w-100" alt=""></div>');
                        $('#image_preview').html('');
                      }
                    }
                });
              }
          });
        }
          
        // $(`#${divName}`).remove();
      
        // for (var i = 0; i < fileArr.length; i++) {
        //   if (fileArr[i].name === fileName) {
        //     fileArr.splice(i, 1);
        //   }
        // }
        document.getElementById('{{ $viewFolder }}_files').files = FileListItem(fileArr);
        evt.preventDefault();
    });
    
    
    $("#{{ $viewFolder }}_icd_code").on("input", function () {
      val = $(this).val();
      if(val.length >= 3){
        $.ajax({
          type: 'GET',
          url: '{{ Route::has('doctors_home.getIcdCode') ? route('doctors_home.getIcdCode') : ''}}/' + val,
          success: function(data){
            icdCodeObj = jQuery.parseJSON(data);
            var options = "";
            icdCodeObj.forEach(function (item, index){
                options  += '<option value="' + item.icd_code + ' - ' + item.details + '">' + item.icd_code + ' - ' + item.details + '</option>';
            });
            $("#icdCodeList").html(options);
          }
        });
      }
      
    });
  });

  $('#{{ $viewFolder }}_referal').flexdatalist({
    url:'{{ Route::has($viewFolder . '.getDoctorBookingList') ? route($viewFolder . '.getDoctorBookingList', [$datum->bookingDate, ($datum->booking_type == "" ? "Consultation" : $datum->booking_type)]) : ''}}/',
    data: {},
    selectionRequired: 1,
    searchContain:true,
    minLength: 1,
    searchIn: 'name',
    requestType: 'get',
    dataType: 'json'
  });

  function FileListItem(file) {
    file = [].slice.call(Array.isArray(file) ? file : arguments)
    for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
    if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
    for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
    return b.files
  }

</script>
