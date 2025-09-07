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

<style>
        .doctor-conso-nav{
            font-size: 1.2em;
            font-weight:bold;
        }
</style>

<datalist id="icdCodeList"></datalist>

<div class="container">
  <div class="row sticky-top bg-white">
    <div class="col-lg-12 d-none d-md-block">
      <ul class="nav nav-tabs mt-3 doctor-conso-nav">
        <li class="nav-item">
          <a class="nav-link active" id="sumPrevLink" href="#" onclick="
            $('#sumPrevLink').addClass('active');  
            $('#soapPrevLink').removeClass('active');  
            $('#labPrevLink').removeClass('active');  
            $('#presPrevLink').removeClass('active');  
            $('#medPrevLink').removeClass('active');  
            $('#admitPrevLink').removeClass('active');
            $('#dialysisPrevLink').removeClass('active');
            $('#sumPrevDiv').show();  
            $('#soapPrevDiv').hide();  
            $('#labPrevDiv').hide();  
            $('#presPrevDiv').hide();  
            $('#medPrevDiv').hide();  
            $('#admitPrevDiv').hide();
            $('#dialysisPrevDiv').hide();
            $('#sumCurLink').addClass('active');  
            $('#soapCurLink').removeClass('active');  
            $('#labCurLink').removeClass('active');  
            $('#presCurLink').removeClass('active');  
            $('#medCurLink').removeClass('active');  
            $('#admitCurLink').removeClass('active');
            $('#dialysisCurLink').removeClass('active');
            $('#sumCurDiv').show();  
            $('#soapCurDiv').hide();  
            $('#labCurDiv').hide();  
            $('#presCurDiv').hide();  
            $('#medCurDiv').hide();  
            $('#admitCurDiv').hide();
            $('#dialysisCurDiv').hide();
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
            $('#dialysisPrevLink').removeClass('active');
            $('#soapPrevDiv').show();  
            $('#sumPrevDiv').hide();  
            $('#labPrevDiv').hide();  
            $('#presPrevDiv').hide();  
            $('#medPrevDiv').hide();  
            $('#admitPrevDiv').hide();
            $('#dialysisPrevDiv').hide();
            $('#soapCurLink').addClass('active');  
            $('#sumCurLink').removeClass('active');  
            $('#labCurLink').removeClass('active');  
            $('#presCurLink').removeClass('active');  
            $('#medCurLink').removeClass('active');  
            $('#admitCurLink').removeClass('active');
            $('#dialysisCurLink').removeClass('active');
            $('#soapCurDiv').show();  
            $('#sumCurDiv').hide();  
            $('#labCurDiv').hide();  
            $('#presCurDiv').hide();  
            $('#medCurDiv').hide();  
            $('#admitCurDiv').hide();
            $('#dialysisCurDiv').hide();
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
            $('#dialysisPrevLink').removeClass('active');
            $('#sumPrevDiv').hide();  
            $('#soapPrevDiv').hide();  
            $('#labPrevDiv').show();  
            $('#presPrevDiv').hide();  
            $('#medPrevDiv').hide();  
            $('#admitPrevDiv').hide();
            $('#dialysisPrevDiv').hide();
            $('#sumCurLink').removeClass('active');
            $('#soapCurLink').removeClass('active');
            $('#labCurLink').addClass('active');  
            $('#presCurLink').removeClass('active');  
            $('#medPCurLink').removeClass('active');  
            $('#admitCurLink').removeClass('active');
            $('#dialysisCurLink').removeClass('active');
            $('#sumCurDiv').hide();  
            $('#soapCurDiv').hide();  
            $('#labCurDiv').show();  
            $('#presCurDiv').hide();  
            $('#medCurDiv').hide();  
            $('#admitCurDiv').hide();
            $('#dialysisCurDiv').hide();
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
            $('#dialysisPrevLink').removeClass('active');
            $('#sumPrevDiv').hide();  
            $('#soapPrevDiv').hide();  
            $('#labPrevDiv').hide();  
            $('#presPrevDiv').show();  
            $('#medPrevDiv').hide();  
            $('#admitPrevDiv').hide();
            $('#dialysisPrevDiv').hide();
            $('#sumCurLink').removeClass('active');
            $('#soapCurLink').removeClass('active');
            $('#labCurLink').removeClass('active');  
            $('#presCurLink').addClass('active');  
            $('#medCurLink').removeClass('active');  
            $('#admitCurLink').removeClass('active');
            $('#dialysisCurLink').removeClass('active');
            $('#sumCurDiv').hide();  
            $('#soapCurDiv').hide();  
            $('#labCurDiv').hide();  
            $('#presCurDiv').show();  
            $('#medCurDiv').hide();  
            $('#admitCurDiv').hide();
            $('#dialysisCurDiv').hide();
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
            $('#dialysisPrevLink').removeClass('active');
            $('#sumPrevDiv').hide();  
            $('#soapPrevDiv').hide();  
            $('#labPrevDiv').hide();  
            $('#presPrevDiv').hide();  
            $('#medPrevDiv').show();  
            $('#admitPrevDiv').hide();
            $('#dialysisPrevDiv').hide();
            $('#sumCurLink').removeClass('active');
            $('#soapCurLink').removeClass('active');
            $('#labCurLink').removeClass('active');  
            $('#presCurLink').removeClass('active');  
            $('#medCurLink').addClass('active');  
            $('#admitCurLink').removeClass('active');
            $('#dialysisCurLink').removeClass('active');
            $('#sumCurDiv').hide();  
            $('#soapCurDiv').hide();  
            $('#labCurDiv').hide();  
            $('#presCurDiv').hide();  
            $('#medCurDiv').show();  
            $('#admitCurDiv').hide();
            $('#dialysisCurDiv').hide();
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
            $('#dialysisPrevLink').removeClass('active');
            $('#sumPrevDiv').hide();  
            $('#soapPrevDiv').hide();  
            $('#labPrevDiv').hide();  
            $('#presPrevDiv').hide();  
            $('#medPrevDiv').hide(); 
            $('#admitPrevDiv').show();
            $('#dialysisPrevDiv').hide();  
            $('#sumCurLink').removeClass('active');
            $('#soapCurLink').removeClass('active');
            $('#labCurLink').removeClass('active');  
            $('#presCurLink').removeClass('active');  
            $('#medCurLink').removeClass('active');
            $('#admitCurLink').addClass('active'); 
            $('#dialysisCurLink').removeClass('active');
            $('#sumCurDiv').hide();  
            $('#soapCurDiv').hide();  
            $('#labCurDiv').hide();  
            $('#presCurDiv').hide();  
            $('#medCurDiv').hide(); 
            $('#admitCurDiv').show();  
            $('#dialysisCurDiv').hide();  
          ">Admitting Orders</a>
        </li>
        @if($datum->booking_type == 'Dialysis')
        <li class="nav-item">
          <a class="nav-link" id="dialysisPrevLink" href="#" onclick="
            $('#sumPrevLink').removeClass('active');
            $('#soapPrevLink').removeClass('active');
            $('#labPrevLink').removeClass('active');  
            $('#presPrevLink').removeClass('active');  
            $('#medPrevLink').removeClass('active');
            $('#admitPrevLink').removeClass('active');
            $('#dialysisPrevLink').addClass('active');
            $('#sumPrevDiv').hide();  
            $('#soapPrevDiv').hide();  
            $('#labPrevDiv').hide();  
            $('#presPrevDiv').hide();  
            $('#medPrevDiv').hide(); 
            $('#admitPrevDiv').hide();  
            $('#dialysisPrevDiv').show();  
            $('#sumCurLink').removeClass('active');
            $('#soapCurLink').removeClass('active');
            $('#labCurLink').removeClass('active');  
            $('#presCurLink').removeClass('active');  
            $('#medCurLink').removeClass('active');
            $('#admitCurLink').removeClass('active');
            $('#dialysisCurLink').addClass('active'); 
            $('#sumCurDiv').hide();  
            $('#soapCurDiv').hide();  
            $('#labCurDiv').hide();  
            $('#presCurDiv').hide();  
            $('#medCurDiv').hide(); 
            $('#admitCurDiv').hide();  
            $('#dialysisCurDiv').show();  
          ">Dialysis Chart</a>
        </li>
        @endif
      </ul>
    </div>
  </div>
  <div class="container pt-3 border border-1 border-top-0">
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
              <div class="card-header">Booking History <small id="help_{{ $viewFolder }}_notes" class="text-muted">(select previous booking to compare with current booking)</small></div>
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
                            <div class="m-1"><a class="btn btn-{{ $bgColor }} btn-sm w-100" href="#" title="View" role="button" onclick="
                              loadPrevBooking({{ $dat->id }}, {{ $ind }});
                              $('#curChart').removeClass('col-lg-12');
                              $('#curChart').addClass('col-lg-6');
                              $('#pastChart').show();
                              $('#pastChart').removeClass('d-none');
                              $('#pastChart').removeClass('d-lg-none');
                              "><i class="bi bi-binoculars"></i><span class="ps-1 d-sm-none">View</span></a></div>
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
              <div class="card-body table-responsive" style="max-height: 780px">
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
      {{-- <div class="col-lg-12 mb-3 d-none d-md-block">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" id="sumPrevLink" href="#" onclick="
              $('#sumPrevLink').addClass('active');  
              $('#soapPrevLink').removeClass('active');  
              $('#labPrevLink').removeClass('active');  
              $('#presPrevLink').removeClass('active');  
              $('#medPrevLink').removeClass('active');  
              $('#admitPrevLink').removeClass('active');
              $('#dialysisPrevLink').removeClass('active');
              $('#sumPrevDiv').show();  
              $('#soapPrevDiv').hide();  
              $('#labPrevDiv').hide();  
              $('#presPrevDiv').hide();  
              $('#medPrevDiv').hide();  
              $('#admitPrevDiv').hide();
              $('#dialysisPrevDiv').hide();
              $('#sumCurLink').addClass('active');  
              $('#soapCurLink').removeClass('active');  
              $('#labCurLink').removeClass('active');  
              $('#presCurLink').removeClass('active');  
              $('#medCurLink').removeClass('active');  
              $('#admitCurLink').removeClass('active');
              $('#dialysisCurLink').removeClass('active');
              $('#sumCurDiv').show();  
              $('#soapCurDiv').hide();  
              $('#labCurDiv').hide();  
              $('#presCurDiv').hide();  
              $('#medCurDiv').hide();  
              $('#admitCurDiv').hide();
              $('#dialysisCurDiv').hide();
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
              $('#dialysisPrevLink').removeClass('active');
              $('#soapPrevDiv').show();  
              $('#sumPrevDiv').hide();  
              $('#labPrevDiv').hide();  
              $('#presPrevDiv').hide();  
              $('#medPrevDiv').hide();  
              $('#admitPrevDiv').hide();
              $('#dialysisPrevDiv').hide();
              $('#soapCurLink').addClass('active');  
              $('#sumCurLink').removeClass('active');  
              $('#labCurLink').removeClass('active');  
              $('#presCurLink').removeClass('active');  
              $('#medCurLink').removeClass('active');  
              $('#admitCurLink').removeClass('active');
              $('#dialysisCurLink').removeClass('active');
              $('#soapCurDiv').show();  
              $('#sumCurDiv').hide();  
              $('#labCurDiv').hide();  
              $('#presCurDiv').hide();  
              $('#medCurDiv').hide();  
              $('#admitCurDiv').hide();
              $('#dialysisCurDiv').hide();
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
              $('#dialysisPrevLink').removeClass('active');
              $('#sumPrevDiv').hide();  
              $('#soapPrevDiv').hide();  
              $('#labPrevDiv').show();  
              $('#presPrevDiv').hide();  
              $('#medPrevDiv').hide();  
              $('#admitPrevDiv').hide();
              $('#dialysisPrevDiv').hide();
              $('#sumCurLink').removeClass('active');
              $('#soapCurLink').removeClass('active');
              $('#labCurLink').addClass('active');  
              $('#presCurLink').removeClass('active');  
              $('#medPCurLink').removeClass('active');  
              $('#admitCurLink').removeClass('active');
              $('#dialysisCurLink').removeClass('active');
              $('#sumCurDiv').hide();  
              $('#soapCurDiv').hide();  
              $('#labCurDiv').show();  
              $('#presCurDiv').hide();  
              $('#medCurDiv').hide();  
              $('#admitCurDiv').hide();
              $('#dialysisCurDiv').hide();
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
              $('#dialysisPrevLink').removeClass('active');
              $('#sumPrevDiv').hide();  
              $('#soapPrevDiv').hide();  
              $('#labPrevDiv').hide();  
              $('#presPrevDiv').show();  
              $('#medPrevDiv').hide();  
              $('#admitPrevDiv').hide();
              $('#dialysisPrevDiv').hide();
              $('#sumCurLink').removeClass('active');
              $('#soapCurLink').removeClass('active');
              $('#labCurLink').removeClass('active');  
              $('#presCurLink').addClass('active');  
              $('#medCurLink').removeClass('active');  
              $('#admitCurLink').removeClass('active');
              $('#dialysisCurLink').removeClass('active');
              $('#sumCurDiv').hide();  
              $('#soapCurDiv').hide();  
              $('#labCurDiv').hide();  
              $('#presCurDiv').show();  
              $('#medCurDiv').hide();  
              $('#admitCurDiv').hide();
              $('#dialysisCurDiv').hide();
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
              $('#dialysisPrevLink').removeClass('active');
              $('#sumPrevDiv').hide();  
              $('#soapPrevDiv').hide();  
              $('#labPrevDiv').hide();  
              $('#presPrevDiv').hide();  
              $('#medPrevDiv').show();  
              $('#admitPrevDiv').hide();
              $('#dialysisPrevDiv').hide();
              $('#sumCurLink').removeClass('active');
              $('#soapCurLink').removeClass('active');
              $('#labCurLink').removeClass('active');  
              $('#presCurLink').removeClass('active');  
              $('#medCurLink').addClass('active');  
              $('#admitCurLink').removeClass('active');
              $('#dialysisCurLink').removeClass('active');
              $('#sumCurDiv').hide();  
              $('#soapCurDiv').hide();  
              $('#labCurDiv').hide();  
              $('#presCurDiv').hide();  
              $('#medCurDiv').show();  
              $('#admitCurDiv').hide();
              $('#dialysisCurDiv').hide();
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
              $('#dialysisPrevLink').removeClass('active');
              $('#sumPrevDiv').hide();  
              $('#soapPrevDiv').hide();  
              $('#labPrevDiv').hide();  
              $('#presPrevDiv').hide();  
              $('#medPrevDiv').hide(); 
              $('#admitPrevDiv').show();
              $('#dialysisPrevDiv').hide();  
              $('#sumCurLink').removeClass('active');
              $('#soapCurLink').removeClass('active');
              $('#labCurLink').removeClass('active');  
              $('#presCurLink').removeClass('active');  
              $('#medCurLink').removeClass('active');
              $('#admitCurLink').addClass('active'); 
              $('#dialysisCurLink').removeClass('active');
              $('#sumCurDiv').hide();  
              $('#soapCurDiv').hide();  
              $('#labCurDiv').hide();  
              $('#presCurDiv').hide();  
              $('#medCurDiv').hide(); 
              $('#admitCurDiv').show();  
              $('#dialysisCurDiv').hide();  
            ">Admitting Orders</a>
          </li>
          @if($datum->booking_type == 'Dialysis')
          <li class="nav-item">
            <a class="nav-link" id="dialysisPrevLink" href="#" onclick="
              $('#sumPrevLink').removeClass('active');
              $('#soapPrevLink').removeClass('active');
              $('#labPrevLink').removeClass('active');  
              $('#presPrevLink').removeClass('active');  
              $('#medPrevLink').removeClass('active');
              $('#admitPrevLink').removeClass('active');
              $('#dialysisPrevLink').addClass('active');
              $('#sumPrevDiv').hide();  
              $('#soapPrevDiv').hide();  
              $('#labPrevDiv').hide();  
              $('#presPrevDiv').hide();  
              $('#medPrevDiv').hide(); 
              $('#admitPrevDiv').hide();  
              $('#dialysisPrevDiv').show();  
              $('#sumCurLink').removeClass('active');
              $('#soapCurLink').removeClass('active');
              $('#labCurLink').removeClass('active');  
              $('#presCurLink').removeClass('active');  
              $('#medCurLink').removeClass('active');
              $('#admitCurLink').removeClass('active');
              $('#dialysisCurLink').addClass('active'); 
              $('#sumCurDiv').hide();  
              $('#soapCurDiv').hide();  
              $('#labCurDiv').hide();  
              $('#presCurDiv').hide();  
              $('#medCurDiv').hide(); 
              $('#admitCurDiv').hide();  
              $('#dialysisCurDiv').show();  
            ">Dialysis Chart</a>
          </li>
          @endif
        </ul>
      </div> --}}
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
            ">Previous Px's Chart</a>
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
            ">Current Px's Chart</a>
          </li>
        </ul>
        @if(isset($bookings[0]))
        <div id="pastChart" class="card mb-3 d-none d-lg-none">
          <div class="card-header">Past Patient's Chart (<span id="prevBookingDater">{{ $bookings[0]->bookingDate }}</span>)&nbsp;<a id="showPast" class="d-none d-lg-block" href="#" onclick="
            $('#curChart').removeClass('col-lg-6');
            $('#curChart').addClass('col-lg-12');
            $('#pastChart').hide();
            $('#pastChart').addClass('d-none');
            $('#pastChart').addClass('d-lg-none');
          ">hide past patient's chart</a></div>
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
            <ul class="nav nav-tabs d-xs-block d-lg-none">
              <li class="nav-item">
                <a class="nav-link active" id="sumPrevLink" href="#" onclick="
                  $('#sumPrevLink').addClass('active');  
                  $('#soapPrevLink').removeClass('active');  
                  $('#labPrevLink').removeClass('active');  
                  $('#presPrevLink').removeClass('active');  
                  $('#medPrevLink').removeClass('active');  
                  $('#admitPrevLink').removeClass('active');
                  $('#dialysisPrevLink').removeClass('active');
                  $('#sumPrevDiv').show();  
                  $('#soapPrevDiv').hide();  
                  $('#labPrevDiv').hide();  
                  $('#presPrevDiv').hide();  
                  $('#medPrevDiv').hide();  
                  $('#admitPrevDiv').hide();
                  $('#dialysisPrevDiv').hide();
                  $('#sumCurLink').addClass('active');  
                  $('#soapCurLink').removeClass('active');  
                  $('#labCurLink').removeClass('active');  
                  $('#presCurLink').removeClass('active');  
                  $('#medCurLink').removeClass('active');  
                  $('#admitCurLink').removeClass('active');
                  $('#dialysisCurLink').removeClass('active');
                  $('#sumCurDiv').show();  
                  $('#soapCurDiv').hide();  
                  $('#labCurDiv').hide();  
                  $('#presCurDiv').hide();  
                  $('#medCurDiv').hide();  
                  $('#admitCurDiv').hide();
                  $('#dialysisCurDiv').hide();
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
                  $('#dialysisPrevLink').removeClass('active');
                  $('#soapPrevDiv').show();  
                  $('#sumPrevDiv').hide();  
                  $('#labPrevDiv').hide();  
                  $('#presPrevDiv').hide();  
                  $('#medPrevDiv').hide();  
                  $('#admitPrevDiv').hide();
                  $('#dialysisPrevDiv').hide();
                  $('#soapCurLink').addClass('active');  
                  $('#sumCurLink').removeClass('active');  
                  $('#labCurLink').removeClass('active');  
                  $('#presCurLink').removeClass('active');  
                  $('#medCurLink').removeClass('active');  
                  $('#admitCurLink').removeClass('active');
                  $('#dialysisCurLink').removeClass('active');
                  $('#soapCurDiv').show();  
                  $('#sumCurDiv').hide();  
                  $('#labCurDiv').hide();  
                  $('#presCurDiv').hide();  
                  $('#medCurDiv').hide();  
                  $('#admitCurDiv').hide();
                  $('#dialysisCurDiv').hide();
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
                  $('#dialysisPrevLink').removeClass('active');
                  $('#sumPrevDiv').hide();  
                  $('#soapPrevDiv').hide();  
                  $('#labPrevDiv').show();  
                  $('#presPrevDiv').hide();  
                  $('#medPrevDiv').hide();  
                  $('#admitPrevDiv').hide();
                  $('#dialysisPrevDiv').hide();
                  $('#sumCurLink').removeClass('active');
                  $('#soapCurLink').removeClass('active');
                  $('#labCurLink').addClass('active');  
                  $('#presCurLink').removeClass('active');  
                  $('#medPCurLink').removeClass('active');  
                  $('#admitCurLink').removeClass('active');
                  $('#dialysisCurLink').removeClass('active');
                  $('#sumCurDiv').hide();  
                  $('#soapCurDiv').hide();  
                  $('#labCurDiv').show();  
                  $('#presCurDiv').hide();  
                  $('#medCurDiv').hide();  
                  $('#admitCurDiv').hide();
                  $('#dialysisCurDiv').hide();
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
                  $('#dialysisPrevLink').removeClass('active');
                  $('#sumPrevDiv').hide();  
                  $('#soapPrevDiv').hide();  
                  $('#labPrevDiv').hide();  
                  $('#presPrevDiv').show();  
                  $('#medPrevDiv').hide();  
                  $('#admitPrevDiv').hide();
                  $('#dialysisPrevDiv').hide();
                  $('#sumCurLink').removeClass('active');
                  $('#soapCurLink').removeClass('active');
                  $('#labCurLink').removeClass('active');  
                  $('#presCurLink').addClass('active');  
                  $('#medCurLink').removeClass('active');  
                  $('#admitCurLink').removeClass('active');
                  $('#dialysisCurLink').removeClass('active');
                  $('#sumCurDiv').hide();  
                  $('#soapCurDiv').hide();  
                  $('#labCurDiv').hide();  
                  $('#presCurDiv').show();  
                  $('#medCurDiv').hide();  
                  $('#admitCurDiv').hide();
                  $('#dialysisCurDiv').hide();
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
                  $('#dialysisPrevLink').removeClass('active');
                  $('#sumPrevDiv').hide();  
                  $('#soapPrevDiv').hide();  
                  $('#labPrevDiv').hide();  
                  $('#presPrevDiv').hide();  
                  $('#medPrevDiv').show();  
                  $('#admitPrevDiv').hide();
                  $('#dialysisPrevDiv').hide();
                  $('#sumCurLink').removeClass('active');
                  $('#soapCurLink').removeClass('active');
                  $('#labCurLink').removeClass('active');  
                  $('#presCurLink').removeClass('active');  
                  $('#medCurLink').addClass('active');  
                  $('#admitCurLink').removeClass('active');
                  $('#dialysisCurLink').removeClass('active');
                  $('#sumCurDiv').hide();  
                  $('#soapCurDiv').hide();  
                  $('#labCurDiv').hide();  
                  $('#presCurDiv').hide();  
                  $('#medCurDiv').show();  
                  $('#admitCurDiv').hide();
                  $('#dialysisCurDiv').hide();
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
                  $('#dialysisPrevLink').removeClass('active');
                  $('#sumPrevDiv').hide();  
                  $('#soapPrevDiv').hide();  
                  $('#labPrevDiv').hide();  
                  $('#presPrevDiv').hide();  
                  $('#medPrevDiv').hide(); 
                  $('#admitPrevDiv').show();
                  $('#dialysisPrevDiv').hide();  
                  $('#sumCurLink').removeClass('active');
                  $('#soapCurLink').removeClass('active');
                  $('#labCurLink').removeClass('active');  
                  $('#presCurLink').removeClass('active');  
                  $('#medCurLink').removeClass('active');
                  $('#admitCurLink').addClass('active'); 
                  $('#dialysisCurLink').removeClass('active');
                  $('#sumCurDiv').hide();  
                  $('#soapCurDiv').hide();  
                  $('#labCurDiv').hide();  
                  $('#presCurDiv').hide();  
                  $('#medCurDiv').hide(); 
                  $('#admitCurDiv').show();  
                  $('#dialysisCurDiv').hide();  
                ">Admitting Orders</a>
              </li>
              @if($datum->booking_type == 'Dialysis')
              <li class="nav-item">
                <a class="nav-link" id="dialysisPrevLink" href="#" onclick="
                  $('#sumPrevLink').removeClass('active');
                  $('#soapPrevLink').removeClass('active');
                  $('#labPrevLink').removeClass('active');  
                  $('#presPrevLink').removeClass('active');  
                  $('#medPrevLink').removeClass('active');
                  $('#admitPrevLink').removeClass('active');
                  $('#dialysisPrevLink').addClass('active');
                  $('#sumPrevDiv').hide();  
                  $('#soapPrevDiv').hide();  
                  $('#labPrevDiv').hide();  
                  $('#presPrevDiv').hide();  
                  $('#medPrevDiv').hide(); 
                  $('#admitPrevDiv').hide();  
                  $('#dialysisPrevDiv').show();  
                  $('#sumCurLink').removeClass('active');
                  $('#soapCurLink').removeClass('active');
                  $('#labCurLink').removeClass('active');  
                  $('#presCurLink').removeClass('active');  
                  $('#medCurLink').removeClass('active');
                  $('#admitCurLink').removeClass('active');
                  $('#dialysisCurLink').addClass('active'); 
                  $('#sumCurDiv').hide();  
                  $('#soapCurDiv').hide();  
                  $('#labCurDiv').hide();  
                  $('#presCurDiv').hide();  
                  $('#medCurDiv').hide(); 
                  $('#admitCurDiv').hide();  
                  $('#dialysisCurDiv').show();  
                ">Dialysis Chart</a>
              </li>
              @endif
            </ul>
            <div id="prevDiv" class="card-body table-responsive p-0" style="max-height: 600px">
              <div id="sumPrevDiv" class="container border border-1 mb-3 p-3">
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
                <div class="card mb-3">
                  <div class="card-header">Remarks</div>
                  <div class="card-body" style="height: 1in; max-height: 1in">
                    <p id="prevSumPatRem">{{ $bookings[0]->others }}</p>
                  </div>
                </div>
                @if(stristr($datum->doctor->specialty, 'Ophtha') && $datum->booking_type != "Dialysis")
                <div class="card mb-3">
                  <div class="card-header">Eye Examination Information</div>
                  <div class="card-body table-responsive">
                    {{-- <p id="prevEyerSumBack">
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
                    </p> --}}
                    <table class="table table-bordered table-striped table-hover table-sm">
                      <thead class="table-{{ $bgColor }}">
                          <tr>
                              <th>&nbsp;</th>
                              <th>OD</th>
                              <th>OS</th>
                              <th>OU</th>
                          </tr>
                      </thead>
                      <tbody id="prevEyerSum">
                        <tr>
                            <td>AR</td>
                            <td>{{ $bookings[0]->arod_sphere != 'No Target' ? ($bookings[0]->arod_sphere) . ' - ' . ($bookings[0]->arod_cylinder) . ' x ' . $bookings[0]->arod_axis : 'No Refraction Possible' }}</td>
                            <td>{{ $bookings[0]->aros_sphere != 'No Target' ? ($bookings[0]->aros_sphere) . ' - ' . ($bookings[0]->aros_cylinder) . ' x ' . $bookings[0]->aros_axis : 'No Refraction Possible' }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>UCVA</td>
                            <td>{{ $bookings[0]->vaod_den != '' ? $bookings[0]->vaod_num . ' / ' . $bookings[0]->vaod_den : $bookings[0]->vaod_num }}</td>
                            <td>{{ $bookings[0]->vaos_den != '' ? $bookings[0]->vaos_num . ' / ' . $bookings[0]->vaos_den : $bookings[0]->vaos_num }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>UCVA Present Correction</td>
                            <td>{{ $bookings[0]->vaodcor_den != '' ? $bookings[0]->vaodcor_num . ' / ' . $bookings[0]->vaodcor_den : $bookings[0]->vaodcor_num }}</td>
                            <td>{{ $bookings[0]->vaoscor_den != '' ? $bookings[0]->vaoscor_num . ' / ' . $bookings[0]->vaoscor_den : $bookings[0]->vaoscor_num }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>VA Pinhole</td>
                            <td>{{ $bookings[0]->pinod_den != '' ? $bookings[0]->pinod_num . ' / ' . $bookings[0]->pinod_den : $bookings[0]->pinod_num }}</td>
                            <td>{{ $bookings[0]->pinos_den != '' ? $bookings[0]->pinos_num . ' / ' . $bookings[0]->pinos_den : $bookings[0]->pinos_num }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>BCVA</td>
                            <td>{{ $bookings[0]->pinodcor_den != '' ? $bookings[0]->pinodcor_num . ' / ' . $bookings[0]->pinodcor_den : $bookings[0]->pinodcor_num }}</td>
                            <td>{{ $bookings[0]->pinoscor_den != '' ? $bookings[0]->pinoscor_num . ' / ' . $bookings[0]->pinoscor_den : $bookings[0]->pinoscor_num }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Jaeger</td>
                            <td>{{ $bookings[0]->jae_od }}</td>
                            <td>{{ $bookings[0]->jae_os }}</td>
                            <td>{{ $bookings[0]->jae_ou }}</td>
                        </tr>
                        <tr>
                            <td>IOP</td>
                            <td>{{ $bookings[0]->iopod }}</td>
                            <td>{{ $bookings[0]->iopos }}</td>
                            <td>&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                @endif
                <div class="card mb-3">
                  <div class="card-header">Doctor's Notes</div>
                  <div class="card-body table-responsive" style="height:300px; max-height: 300px">
                    <p>
                      <strong>History of Present Illness:</strong><div class="m-3" id="{{ $viewFolder }}_prev_sum_docNotesHPI">{!! isset($bookings[0]->docNotesHPI) ? nl2br($bookings[0]->docNotesHPI) : '' !!}</div><br>
                      <strong>Subjective Complaints:</strong><br><div class="m-3" id="{{ $viewFolder }}_prev_sum_docNotesSubject">{!! isset($bookings[0]->docNotesSubject) ? nl2br($bookings[0]->docNotesSubject) : '' !!}</div><br>
                      <strong>Objective Findings:</strong><br><div class="m-3" id="{{ $viewFolder }}_prev_sum_docNotes">{!! isset($bookings[0]->docNotes) ? nl2br($bookings[0]->docNotes) : '' !!}</div><br>
                    </p>
                  </div>
                </div>
                <div class="card mb-3">
                  <div class="card-header">Assessment</div>
                  <div class="card-body table-responsive" style="height:300px; max-height: 300px">
                    <p>
                      <strong>Primary Diagnosis:</strong> <span id="{{ $viewFolder }}_prev_sum_icd_code">{!! isset($bookings[0]->icd_code_obj) ? $bookings[0]->icd_code_obj->icd_code . ' - ' . $bookings[0]->icd_code_obj->details : '' !!}</span><br>
                      <strong>Secondary Diagnosis:</strong><br><div class="m-3" id="{{ $viewFolder }}_prev_sum_assessment">{!! isset($bookings[0]->assessment) ? nl2br($bookings[0]->assessment) : '' !!}</div><br>
                    </p>
                  </div>
                </div>
                <div class="card mb-3">
                  <div class="card-header">Plan</div>
                  <div class="card-body table-responsive" style="height:300px; max-height: 300px">
                    <p>
                      <strong>Medical Therapeutics:</strong><br><div class="m-3" id="{{ $viewFolder }}_prev_sum_planMed">{!! isset($bookings[0]->planMed) ? nl2br($bookings[0]->planMed) : '' !!}</div><br>
                      <strong>Diagnostics and Surgery:</strong><br><div class="m-3" id="{{ $viewFolder }}_prev_sum_plan">{!! isset($bookings[0]->plan) ? nl2br($bookings[0]->plan) : '' !!}</div><br>
                      <strong>Remarks:</strong><br><div class="m-3" id="{{ $viewFolder }}_prev_sum_planRem">{!! isset($bookings[0]->planRem) ? nl2br($bookings[0]->planRem) : '' !!}</div><br>
                    </p>
                  </div>
                </div>
              </div>
              <div id="soapPrevDiv" style="display:none" class="container border border-1 mb-3 p-3">
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
                  <div class="card-header">Remarks</div>
                  <div class="card-body" style="height: 1in; max-height: 1in">
                    <p id="prevPatRem">{{ $bookings[0]->others }}</p>
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
                        @if(stristr($datum->doctor->specialty, 'Ophtha') && $datum->booking_type != "Dialysis")
                        <div class="card mb-3">
                          <div class="card-header">Eye Examination Information</div>
                          <div class="card-body">
                            {{-- <p id="prevEyerBack">
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
                            </p> --}}
                            <table class="table table-bordered table-striped table-hover table-sm">
                              <thead class="table-{{ $bgColor }}">
                                  <tr>
                                      <th>&nbsp;</th>
                                      <th>OD</th>
                                      <th>OS</th>
                                      <th>OU</th>
                                  </tr>
                              </thead>
                              <tbody id="prevEyer">
                                <tr>
                                    <td>AR</td>
                                    <td>{{ $bookings[0]->arod_sphere != 'No Target' ? ($bookings[0]->arod_sphere) . ' - ' . ($bookings[0]->arod_cylinder) . ' x ' . $bookings[0]->arod_axis : 'No Refraction Possible' }}</td>
                                    <td>{{ $bookings[0]->aros_sphere != 'No Target' ? ($bookings[0]->aros_sphere) . ' - ' . ($bookings[0]->aros_cylinder) . ' x ' . $bookings[0]->aros_axis : 'No Refraction Possible' }}</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>UCVA</td>
                                    <td>{{ $bookings[0]->vaod_den != '' ? $bookings[0]->vaod_num . ' / ' . $bookings[0]->vaod_den : $bookings[0]->vaod_num }}</td>
                                    <td>{{ $bookings[0]->vaos_den != '' ? $bookings[0]->vaos_num . ' / ' . $bookings[0]->vaos_den : $bookings[0]->vaos_num }}</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>UCVA Present Correction</td>
                                    <td>{{ $bookings[0]->vaodcor_den != '' ? $bookings[0]->vaodcor_num . ' / ' . $bookings[0]->vaodcor_den : $bookings[0]->vaodcor_num }}</td>
                                    <td>{{ $bookings[0]->vaoscor_den != '' ? $bookings[0]->vaoscor_num . ' / ' . $bookings[0]->vaoscor_den : $bookings[0]->vaoscor_num }}</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>VA Pinhole</td>
                                    <td>{{ $bookings[0]->pinod_den != '' ? $bookings[0]->pinod_num . ' / ' . $bookings[0]->pinod_den : $bookings[0]->pinod_num }}</td>
                                    <td>{{ $bookings[0]->pinos_den != '' ? $bookings[0]->pinos_num . ' / ' . $bookings[0]->pinos_den : $bookings[0]->pinos_num }}</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>BCVA</td>
                                    <td>{{ $bookings[0]->pinodcor_den != '' ? $bookings[0]->pinodcor_num . ' / ' . $bookings[0]->pinodcor_den : $bookings[0]->pinodcor_num }}</td>
                                    <td>{{ $bookings[0]->pinoscor_den != '' ? $bookings[0]->pinoscor_num . ' / ' . $bookings[0]->pinoscor_den : $bookings[0]->pinoscor_num }}</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Jaeger</td>
                                    <td>{{ $bookings[0]->jae_od }}</td>
                                    <td>{{ $bookings[0]->jae_os }}</td>
                                    <td>{{ $bookings[0]->jae_ou }}</td>
                                </tr>
                                <tr>
                                    <td>IOP</td>
                                    <td>{{ $bookings[0]->iopod }}</td>
                                    <td>{{ $bookings[0]->iopos }}</td>
                                    <td>&nbsp;</td>
                                </tr>
                              </tbody>
                            </table>
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
              <div id="labPrevDiv" style="display:none" class="container border border-1 mb-3 p-3">
                <h5>Image Viewer</h5>
                <div id="carouselPrev" class="carousel carousel-dark slide" data-bs-interval="false">
                  <div class="carousel-indicators" id="labPrevCarouselInd">
                    @php
                      $key = false;
                      if(isset($bookings[0]->parent_consultation)){
                        $bookings[0]->consultation_files = $bookings[0]->parent_consultation->consultation_files;
                        $bookings[0]->anesthesia_files = $bookings[0]->parent_consultation->anesthesia_files;
                        $bookings[0]->doctor_files = $bookings[0]->parent_consultation->doctor_files;
                        $bookings[0]->prescription_files = $bookings[0]->parent_consultation->prescription_files;
                      }

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
                <div class="container horizontal-scrollable" style="overflow-x: auto; white-space: nowrap;">
                  <div class="row flex-nowrap" id="image_preview_prev_saved" style="max-height:200px">
                {{-- <div class="row overflow-auto" id="image_preview_prev_saved" style="max-height:500px"> --}}
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
              </div>
              <div id="presPrevDiv" style="display:none" class="container border border-1 mb-3 p-3">
                <div class="card mb-3">
                  <div class="card-header">Previous Prescription Preview</div>
                  <div class="card-body">
                    <iframe id="iframePrevPresc" src="{{ file_exists(public_path('storage/prescription_files/' . $bookings[0]->id . '_' . $bookings[0]->patient->l_name . '.pdf')) ? asset('storage/prescription_files/' . $bookings[0]->id . '_' . $bookings[0]->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" width="100%" height="300" style="border:1"></iframe>
                    <small class="form-text text-muted">To print or download go to Tools</small>
                  </div>
                </div>
              </div>
              <div id="medPrevDiv" style="display:none" class="container border border-1 mb-3 p-3">
                <div class="card mb-3">
                  <div class="card-header">Previous Med Cert Preview</div>
                  <div class="card-body">
                    <iframe id="iframePrevMedCert" src="{{ file_exists(public_path('storage/med_cert_files/' . $bookings[0]->id . '_' . $bookings[0]->patient->l_name . '.pdf')) ? asset('storage/med_cert_files/' . $bookings[0]->id . '_' . $bookings[0]->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" width="100%" height="300" style="border:1"></iframe>
                    <small class="form-text text-muted">To print or download go to Tools</small>
                  </div>
                </div>
              </div>
              <div id="admitPrevDiv" style="display:none" class="container border border-1 mb-3 p-3">
                <div class="card mb-3">
                  <div class="card-header">Previous Admitting Orders Preview</div>
                  <div class="card-body">
                    <iframe id="iframePrevAdmitting" src="{{ file_exists(public_path('storage/admitting_order_files/' . $bookings[0]->id . '_' . $bookings[0]->patient->l_name . '.pdf')) ? asset('storage/admitting_order_files/' . $bookings[0]->id . '_' . $bookings[0]->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" width="100%" height="300" style="border:1"></iframe>
                    <small class="form-text text-muted">To print or download go to Tools</small>
                  </div>
                </div>
              </div>
              <div id="dialysisPrevDiv" style="display:none" class="container border border-1 mb-3 p-3">
                @if(isset($datum->booking_type) && $datum->booking_type == 'Dialysis')
                <div class="row">
                  <div class="col-lg-4">
                    <div class="input-group mb-3">
                      <div class="form-floating">
                        <input class="form-control" type="text" name="{{ $viewFolder }}[id]" id="{{ $viewFolder }}_prev_treatment_id" value="{{ isset($bookings[0]->id) ? $bookings[0]->id : '' }}" placeholder="" disabled>
                        <label for="{{ $viewFolder }}_prev_treatment_id" class="form-label">Treatment Number</label>
                        <small id="help_{{ $viewFolder }}_prev_treatment_id" class="text-muted"></small>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="input-group mb-3">
                      <div class="form-floating">
                        <input class="form-control" type="time" name="{{ $viewFolder }}[time_started]" id="{{ $viewFolder }}_prev_time_started" value="{{ isset($bookings[0]->time_started) ? $bookings[0]->time_started : ''}}" placeholder="" disabled>
                        <label for="{{ $viewFolder }}_prev_time_started" class="form-label">Time Started</label>
                        <small id="help_{{ $viewFolder }}_prev_time_started" class="text-muted"></small>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="input-group mb-3">
                      <div class="form-floating">
                        <input class="form-control" type="time" name="{{ $viewFolder }}[time_ended]" id="{{ $viewFolder }}_prev_time_ended" value="{{ isset($bookings[0]->time_ended) ? $bookings[0]->time_ended : ''}}" placeholder="" disabled>
                        <label for="{{ $viewFolder }}_prev_time_ended" class="form-label">Time Ended</label>
                        <small id="help_{{ $viewFolder }}_prev_time_ended" class="text-muted"></small>
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
                            <input class="form-control" type="text" name="{{ $viewFolder }}[machine_number]" id="{{ $viewFolder }}_prev_machine_number" value="{{ isset($bookings[0]->machine_number) ? $bookings[0]->machine_number : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_machine_number" class="form-label">Machine Number</label>
                            <small id="help_{{ $viewFolder }}_prev_machine_number" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[dialyzer]" id="{{ $viewFolder }}_prev_dialyzer" value="{{ isset($bookings[0]->dialyzer) ? $bookings[0]->dialyzer : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_dialyzer" class="form-label">Dialyzer</label>
                            <small id="help_{{ $viewFolder }}_prev_dialyzer" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" step=1 min=0 name="{{ $viewFolder }}[mac_use]" id="{{ $viewFolder }}_prev_use" value="{{ isset($bookings[0]->mac_use) ? $bookings[0]->mac_use : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_use" class="form-label">Use</label>
                            <small id="help_{{ $viewFolder }}_prev_use" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[acid]" id="{{ $viewFolder }}_prev_acid" value="{{ isset($bookings[0]->acid) ? $bookings[0]->acid : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_acid" class="form-label">Acid</label>
                            <small id="help_{{ $viewFolder }}_prev_acid" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[mac_add]" id="{{ $viewFolder }}_prev_add" value="{{ isset($bookings[0]->mac_add) ? $bookings[0]->mac_add : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_add" class="form-label">Add</label>
                            <small id="help_{{ $viewFolder }}_prev_add" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[bfr]" id="{{ $viewFolder }}_prev_bfr" value="{{ isset($bookings[0]->bfr) ? $bookings[0]->bfr : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_bfr" class="form-label">BRF</label>
                            <small id="help_{{ $viewFolder }}_prev_bfr" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[dfr]" id="{{ $viewFolder }}_prev_dfr" value="{{ isset($bookings[0]->dfr) ? $bookings[0]->dfr : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_dfr" class="form-label">DFR</label>
                            <small id="help_{{ $viewFolder }}_prev_dfr" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[setup_prime]" id="{{ $viewFolder }}_prev_setup_prime" value="{{ isset($bookings[0]->setup_prime) ? $bookings[0]->setup_prime : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_setup_prime" class="form-label">Setup Prime</label>
                            <small id="help_{{ $viewFolder }}_prev_setup_prime" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <textarea class="form-control" name="{{ $viewFolder }}[safety_check]" id="{{ $viewFolder }}_prev_safety_check" rows=3 disabled>{{ isset($bookings[0]->safety_check) ? $bookings[0]->safety_check : ''}}</textarea>
                            <label for="{{ $viewFolder }}_prev_safety_check" class="form-label">Safety Check</label>
                            <small id="help_{{ $viewFolder }}_prev_safety_check" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <textarea class="form-control" name="{{ $viewFolder }}[residual_test]" id="{{ $viewFolder }}_prev_residual_test" rows=3 disabled>{{ isset($bookings[0]->residual_test) ? $bookings[0]->residual_test : ''}}</textarea>
                            <label for="{{ $viewFolder }}_prev_residual_test" class="form-label">Residual Test</label>
                            <small id="help_{{ $viewFolder }}_prev_residual_test" class="text-muted"></small>
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
                            <input class="form-control" type="text" name="{{ $viewFolder }}[dry_weight]" id="{{ $viewFolder }}_prev_dry_weight" value="{{ isset($bookings[0]->dry_weight) ? $bookings[0]->dry_weight : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_dry_weight" class="form-label">Estimate Dry Weight</label>
                            <small id="help_{{ $viewFolder }}_prev_dry_weight" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">kg</span>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[prev_post_hd_weight]" min=1 step=.1 id="{{ $viewFolder }}_prev_prev_post_hd_weight" value="{{ isset($bookings[0]->prev_post_hd_weight) ? $bookings[0]->prev_post_hd_weight : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_prev_post_hd_weight" class="form-label">Prev. Post HD Weight</label>
                            <small id="help_{{ $viewFolder }}_prev_prev_post_hd_weight" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">kg</span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[weight]" min=1 step=.1 id="{{ $viewFolder }}_prev_pre_hd_weight" value="{{ isset($bookings[0]->weight) ? $bookings[0]->weight : ''}}" placeholder="" onchange="
                              if($('#{{ $viewFolder }}_prev_pre_hd_weight').val() != '' &&  $('#{{ $viewFolder }}_prev_post_hd_weight').val() != ''){
                                $('#{{ $viewFolder }}_prev_weight_loss').val($('#{{ $viewFolder }}_prev_pre_hd_weight').val() - $('#{{ $viewFolder }}_prev_post_hd_weight').val());
                              }
                            " disabled>
                            <label for="{{ $viewFolder }}_prev_pre_hd_weight" class="form-label">Pre HD Weight</label>
                            <small id="help_{{ $viewFolder }}_prev_pre_hd_weight" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">kg</span>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[post_weight]" min=1 step=.1 id="{{ $viewFolder }}_prev_post_hd_weight" value="{{ isset($bookings[0]->post_weight) ? $bookings[0]->post_weight : ''}}" placeholder="" onchange="
                              if($('#{{ $viewFolder }}_prev_pre_hd_weight').val() != '' &&  $('#{{ $viewFolder }}_prev_post_hd_weight').val() != ''){
                                $('#{{ $viewFolder }}_prev_weight_loss').val($('#{{ $viewFolder }}_prev_pre_hd_weight').val() - $('#{{ $viewFolder }}_prev_post_hd_weight').val());
                              }
                            " disabled>
                            <label for="{{ $viewFolder }}_prev_post_hd_weight" class="form-label">Post HD Weight</label>
                            <small id="help_{{ $viewFolder }}_prev_post_hd_weight" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">kg</span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[ktv]" id="{{ $viewFolder }}_prev_ktv" value="{{ isset($bookings[0]->ktv) ? $bookings[0]->ktv : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_ktv" class="form-label">KT/V</label>
                            <small id="help_{{ $viewFolder }}_prev_ktv" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[net_uf]" id="{{ $viewFolder }}_prev_net_uf" value="{{ isset($bookings[0]->net_uf) ? $bookings[0]->net_uf : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_net_uf" class="form-label">Net UF</label>
                            <small id="help_{{ $viewFolder }}_prev_net_uf" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[hd_duration]" min=1 step=.1 id="{{ $viewFolder }}_prev_hd_duration" value="{{ isset($bookings[0]->hd_duration) ? $bookings[0]->hd_duration : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_hd_duration" class="form-label">Duration</label>
                            <small id="help_{{ $viewFolder }}_prev_hd_duration" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">hr/s</span>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[frequency]" min=1 step=.1 id="{{ $viewFolder }}_prev_frequency" value="{{ isset($bookings[0]->frequency) ? $bookings[0]->frequency : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_frequency" class="form-label">Frequency</label>
                            <small id="help_{{ $viewFolder }}_prev_frequency" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[prime]" id="{{ $viewFolder }}_prev_prime" value="{{ isset($bookings[0]->prime) ? $bookings[0]->prime : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_prime" class="form-label">Prime/Rinse</label>
                            <small id="help_{{ $viewFolder }}_prev_prime" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[other_fluids]" id="{{ $viewFolder }}_prev_other_fluids" value="{{ isset($bookings[0]->other_fluids) ? $bookings[0]->other_fluids : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_other_fluids" class="form-label">Other Fluids</label>
                            <small id="help_{{ $viewFolder }}_prev_other_fluids" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[total_uf_goal]" id="{{ $viewFolder }}_prev_total_uf_goal" value="{{ isset($bookings[0]->total_uf_goal) ? $bookings[0]->total_uf_goal : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_total_uf_goal" class="form-label">Total UF Goal</label>
                            <small id="help_{{ $viewFolder }}_prev_total_uf_goal" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[weight_loss]" min=0 step=.1 id="{{ $viewFolder }}_prev_weight_loss" value="{{ isset($bookings[0]->weight_loss) ? $bookings[0]->weight_loss : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_weight_loss" class="form-label">Weight Loss</label>
                            <small id="help_{{ $viewFolder }}_prev_weight_loss" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">kg</span>
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
                            <input class="form-control" type="text" name="{{ $viewFolder }}[brand]" id="{{ $viewFolder }}_prev_brand" value="{{ isset($bookings[0]->brand) ? $bookings[0]->brand : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_brand" class="form-label">Brand Name</label>
                            <small id="help_{{ $viewFolder }}_prev_brand" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[dose]" id="{{ $viewFolder }}_prev_dose" value="{{ isset($bookings[0]->dose) ? $bookings[0]->dose : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_dose" class="form-label">Dose</label>
                            <small id="help_{{ $viewFolder }}_prev_dose" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[regular_dose]" id="{{ $viewFolder }}_prev_regular_dose" value="{{ isset($bookings[0]->regular_dose) ? $bookings[0]->regular_dose : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_regular_dose" class="form-label">Regular Dose</label>
                            <small id="help_{{ $viewFolder }}_prev_regular_dose" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[low_dose]" id="{{ $viewFolder }}_prev_low_dose" value="{{ isset($bookings[0]->low_dose) ? $bookings[0]->low_dose : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_low_dose" class="form-label">Low Dose</label>
                            <small id="help_{{ $viewFolder }}_prev_low_dose" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[lmwh]" id="{{ $viewFolder }}_prev_lmwh" value="{{ isset($bookings[0]->lmwh) ? $bookings[0]->lmwh : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_lmwh" class="form-label">LMWH</label>
                            <small id="help_{{ $viewFolder }}_prev_lmwh" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[flushing]" id="{{ $viewFolder }}_prev_flushing" value="{{ isset($bookings[0]->flushing) ? $bookings[0]->flushing : ''}}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_flushing" class="form-label">NSS Flushing</label>
                            <small id="help_{{ $viewFolder }}_prev_flushing" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
                <div class="row">
                  <div class="col-lg-{{ stristr($doctor->specialty, 'Ophtha') && (isset($datum->booking_type) && $datum->booking_type != 'Dialysis') ? 4 : (isset($datum->booking_type) && $datum->booking_type == 'Dialysis' ? 6 : 12) }}">
                    <div class="card mb-3">
                      <div class="card-header">{{ isset($datum->booking_type) && $datum->booking_type == 'Dialysis' ? 'Pre-HD ' : '' }}Vitals</div>
                      <div class="card-body">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[temp]" min=30 step=.1 id="{{ $viewFolder }}_prev_temp" value="{{ isset($bookings[0]->temp) ? $bookings[0]->temp : ''}}" placeholder="" {{ isset($bookings[0]->id) ? '' : '' }} disabled>
                            <label for="{{ $viewFolder }}_prev_temp" class="form-label">Temperature</label>
                            <small id="help_{{ $viewFolder }}_prev_temp" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">C</span>
                        </div>
                        @if(isset($datum->booking_type) && $datum->booking_type != 'Dialysis')
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[height]" min=1 step=.1 id="{{ $viewFolder }}_prev_height" value="{{ isset($bookings[0]->height) ? $bookings[0]->height : '' }}" placeholder="" {{ isset($bookings[0]->id) ? '' : '' }} onblur="
                                if($(this).val() != '' && $('#{{ $viewFolder }}_prev_weight').val() != ''){
                                  $('#{{ $viewFolder }}_prev_bmi').val($('#{{ $viewFolder }}_prev_weight').val()/(($(this).val()/100)*($(this).val()/100)));
                                }else{
                                  $('#{{ $viewFolder }}_prev_bmi').val('');
                                }
                              " disabled>
                            <label for="{{ $viewFolder }}_prev_height" class="form-label">Height</label>
                            <small id="help_{{ $viewFolder }}_prev_height" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">cm</span>
                        </div>
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[weight]" min=1 step=.1 id="{{ $viewFolder }}_prev_weight" value="{{ isset($bookings[0]->weight) ? $bookings[0]->weight : '' }}" placeholder="" {{ isset($bookings[0]->id) ? '' : '' }} onblur="
                              if($(this).val() != '' && $('#{{ $viewFolder }}_prev_height').val() != ''){
                                $('#{{ $viewFolder }}_prev_bmi').val($(this).val()/(($('#{{ $viewFolder }}_prev_height').val()/100)*($('#{{ $viewFolder }}_prev_height').val()/100)));
                              }else{
                                $('#{{ $viewFolder }}_prev_bmi').val('');
                              }
                            " disabled>
                            <label for="{{ $viewFolder }}_prev_weight" class="form-label">Weight</label>
                            <small id="help_{{ $viewFolder }}_prev_weight" class="text-muted"></small>
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
                            <input class="form-control" type="number" name="{{ $viewFolder }}[bmi]" min=1 id="{{ $viewFolder }}_prev_bmi" value="{{ !empty($bookings[0]->height) ? (int)$bookings[0]->weight/(((int)$bookings[0]->height/100)*((int)$bookings[0]->height/100)) : '' }}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_bmi" class="form-label">BMI</label>
                            <small id="help_{{ $viewFolder }}_prev_bmi" class="text-muted"></small>
                          </div>
                        </div>
                        @endif
                        <label for="{{ $viewFolder }}_bpS" class="form-label">BP</label>
                        <div class="input-group mb-3">
                          <input class="form-control" type="number" name="{{ $viewFolder }}[bpS]" min=50 max=250 step=1 id="{{ $viewFolder }}_prev_bpS" value="{{ isset($bookings[0]->bpS) ? $bookings[0]->bpS : '' }}" placeholder="Systolic" {{ isset($bookings[0]->id) ? '' : '' }} disabled>
                          <span class="input-group-text">/</span>
                          <input class="form-control" type="number" name="{{ $viewFolder }}[bpD]" min=30 max=150 step=1 id="{{ $viewFolder }}_prev_bpD" value="{{ isset($bookings[0]->bpD) ? $bookings[0]->bpD : '' }}" placeholder="Diastolic" {{ isset($bookings[0]->id) ? '' : '' }} disabled>
                        </div>
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[o2]" min=1 id="{{ $viewFolder }}_prev_o2" value="{{ isset($bookings[0]->o2) ? $bookings[0]->o2 : '' }}" placeholder="" {{ isset($bookings[0]->id) ? '' : '' }} disabled>
                            <label for="{{ $viewFolder }}_prev_o2" class="form-label">O2 Sat</label>
                            <small id="help_{{ $viewFolder }}_prev_o2" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">%</span>
                        </div>
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[heart]" min=1 id="{{ $viewFolder }}_prev_heart" value="{{ isset($bookings[0]->heart) ? $bookings[0]->heart : '' }}" placeholder="" {{ isset($bookings[0]->id) ? '' : '' }} disabled>
                            <label for="{{ $viewFolder }}_prev_heart" class="form-label">Heart/Pulse Rate</label>
                            <small id="help_{{ $viewFolder }}_prev_heart" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">BPM</span>
                        </div>
                        @if(isset($datum->booking_type) && $datum->booking_type == 'Dialysis')
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[resp]" min=1 id="{{ $viewFolder }}_prev_resp" value="{{ isset($bookings[0]->resp) ? $bookings[0]->resp : '' }}" placeholder="" {{ isset($bookings[0]->id) ? '' : '' }} disabled>
                            <label for="{{ $viewFolder }}_prev_resp" class="form-label">Resp</label>
                            <small id="help_{{ $viewFolder }}_prev_resp" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">CPM</span>
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
                  @if(isset($datum->booking_type) && $datum->booking_type == 'Dialysis')
                  <div class="col-lg-6">
                    <div class="card mb-3">
                      <div class="card-header">Post-HD Vitals</div>
                      <div class="card-body">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[post_temp]" min=30 step=.1 id="{{ $viewFolder }}_prev_post_temp" value="{{ isset($bookings[0]->post_temp) ? $bookings[0]->post_temp : ''}}" placeholder="" {{ isset($bookings[0]->id) ? '' : '' }} disabled>
                            <label for="{{ $viewFolder }}_prev_post_temp" class="form-label">Temperature</label>
                            <small id="help_{{ $viewFolder }}_prev_post_temp" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">C</span>
                        </div>
                        @if(isset($datum->booking_type) && $datum->booking_type != 'Dialysis')
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[post_height]" min=1 step=.1 id="{{ $viewFolder }}_prev_post_height" value="{{ isset($bookings[0]->post_height) ? $bookings[0]->post_height : '' }}" placeholder="" {{ isset($bookings[0]->id) ? '' : '' }} onblur="
                                if($(this).val() != '' && $('#{{ $viewFolder }}_prev_post_weight').val() != ''){
                                  $('#{{ $viewFolder }}_prev_post_bmi').val($('#{{ $viewFolder }}_prev_post_weight').val()/(($(this).val()/100)*($(this).val()/100)));
                                }else{
                                  $('#{{ $viewFolder }}_prev_post_bmi').val('');
                                }
                              " disabled>
                            <label for="{{ $viewFolder }}_prev_post_height" class="form-label">Height</label>
                            <small id="help_{{ $viewFolder }}_prev_post_height" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">cm</span>
                        </div>
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[post_weight]" min=1 step=.1 id="{{ $viewFolder }}_prev_post_weight" value="{{ isset($bookings[0]->post_weight) ? $bookings[0]->post_weight : '' }}" placeholder="" {{ isset($bookings[0]->id) ? '' : '' }} onblur="
                              if($(this).val() != '' && $('#{{ $viewFolder }}_prev_post_height').val() != ''){
                                $('#{{ $viewFolder }}_prev_post_bmi').val($(this).val()/(($('#{{ $viewFolder }}_prev_post_height').val()/100)*($('#{{ $viewFolder }}_prev_post_height').val()/100)));
                              }else{
                                $('#{{ $viewFolder }}_prev_post_bmi').val('');
                              }
                            " disabled>
                            <label for="{{ $viewFolder }}_prev_post_weight" class="form-label">Weight</label>
                            <small id="help_{{ $viewFolder }}_prev_post_weight" class="text-muted"></small>
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
                            <input class="form-control" type="number" name="{{ $viewFolder }}[post_bmi]" min=1 id="{{ $viewFolder }}_prev_post_bmi" value="{{ !empty($bookings[0]->post_height) ? (int)$bookings[0]->post_weight/(((int)$bookings[0]->post_height/100)*((int)$bookings[0]->post_height/100)) : '' }}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_prev_post_bmi" class="form-label">BMI</label>
                            <small id="help_{{ $viewFolder }}_prev_post_bmi" class="text-muted"></small>
                          </div>
                        </div>
                        @endif
                        <label for="{{ $viewFolder }}_bpS" class="form-label">BP</label>
                        <div class="input-group mb-3">
                          <input class="form-control" type="number" name="{{ $viewFolder }}[post_bpS]" min=50 max=250 step=1 id="{{ $viewFolder }}_prev_post_bpS" value="{{ isset($bookings[0]->post_bpS) ? $bookings[0]->post_bpS : '' }}" placeholder="Systolic" {{ isset($bookings[0]->id) ? '' : '' }} disabled>
                          <span class="input-group-text">/</span>
                          <input class="form-control" type="number" name="{{ $viewFolder }}[post_bpD]" min=30 max=150 step=1 id="{{ $viewFolder }}_prev_post_bpD" value="{{ isset($bookings[0]->post_bpD) ? $bookings[0]->post_bpD : '' }}" placeholder="Diastolic" {{ isset($bookings[0]->id) ? '' : '' }} disabled>
                        </div>
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[post_o2]" min=1 id="{{ $viewFolder }}_prev_post_o2" value="{{ isset($bookings[0]->post_o2) ? $bookings[0]->post_o2 : '' }}" placeholder="" {{ isset($bookings[0]->id) ? '' : '' }} disabled>
                            <label for="{{ $viewFolder }}_prev_post_o2" class="form-label">O2 Sat</label>
                            <small id="help_{{ $viewFolder }}_prev_post_o2" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">%</span>
                        </div>
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[post_heart]" min=1 id="{{ $viewFolder }}_prev_post_heart" value="{{ isset($bookings[0]->post_heart) ? $bookings[0]->post_heart : '' }}" placeholder="" {{ isset($bookings[0]->id) ? '' : '' }} disabled>
                            <label for="{{ $viewFolder }}_prev_post_heart" class="form-label">Heart/Pulse Rate</label>
                            <small id="help_{{ $viewFolder }}_prev_post_heart" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">BPM</span>
                        </div>
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[post_resp]" min=1 id="{{ $viewFolder }}_prev_post_resp" value="{{ isset($bookings[0]->post_resp) ? $bookings[0]->post_resp : '' }}" placeholder="" {{ isset($bookings[0]->id) ? '' : '' }} disabled>
                            <label for="{{ $viewFolder }}_prev_post_resp" class="form-label">Resp</label>
                            <small id="help_{{ $viewFolder }}_prev_post_resp" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">CPM</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                </div>
                @if(isset($datum->booking_type) && $datum->booking_type == 'Dialysis')
                
                <div class="row">
                  <div class="col-lg-6">
                    <div class="card mb-3">
                      <div class="card-header">Pre-HD Assessment</div>
                      <div class="card-body">
                        <label>Mental Status</label>
                        <div class="container ml-5 mb-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[mental_status][]" value="awake" id="{{ $viewFolder }}_prev_mental_status_awake" {{ (isset($bookings[0]->mental_status) && is_array(json_decode($bookings[0]->mental_status)) && in_array('awake', json_decode($bookings[0]->mental_status))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_mental_status_awake">awake</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[mental_status][]" value="oriented" id="{{ $viewFolder }}_prev_mental_status_oriented" {{ (isset($bookings[0]->mental_status) && is_array(json_decode($bookings[0]->mental_status)) && in_array('oriented', json_decode($bookings[0]->mental_status))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_mental_status_oriented">oriented</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[mental_status][]" value="drowsy" id="{{ $viewFolder }}_prev_mental_status_drowsy" {{ (isset($bookings[0]->mental_status) && is_array(json_decode($bookings[0]->mental_status)) && in_array('drowsy', json_decode($bookings[0]->mental_status))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_mental_status_drowsy">drowsy</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[mental_status][]" value="disoriented" id="{{ $viewFolder }}_prev_mental_status_disoriented" {{ (isset($bookings[0]->mental_status) && is_array(json_decode($bookings[0]->mental_status)) && in_array('disoriented', json_decode($bookings[0]->mental_status))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_mental_status_disoriented">disoriented</label>
                          </div>
                        </div>
                        <label>Ambulation Status</label>
                        <div class="container ml-5 mb-3">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $viewFolder }}[prev_ambulation_status]" value="ambulatory" id="{{ $viewFolder }}_prev_ambulation_status_ambulatory" {{ (isset($bookings[0]->ambulation_status) && $bookings[0]->ambulation_status == 'ambulatory') ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_ambulation_status_ambulatory">ambulatory</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $viewFolder }}[prev_ambulation_status]" value="w/ assistance" id="{{ $viewFolder }}_prev_ambulation_status_assistance" {{ (isset($bookings[0]->ambulation_status) && $bookings[0]->ambulation_status == 'w/ assistance') ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_ambulation_status_assistance">w/ assistance</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $viewFolder }}[prev_ambulation_status]" value="wheelchair" id="{{ $viewFolder }}_prev_ambulation_status_wheelchair" {{ (isset($bookings[0]->ambulation_status) && $bookings[0]->ambulation_status == 'wheelchair') ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_ambulation_status_wheelchair">wheelchair</label>
                          </div>
                        </div>
                        <label>Subjective Complaints</label>
                        <div class="container ml-5 mb-3">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $viewFolder }}[prev_subjective_complaints]" value="none" id="{{ $viewFolder }}_prev_subjective_complaints_none" onchange="
                                if(!$(this).prop('checked')){
                                  $('#{{ $viewFolder }}_prev_subjective_complaints_text').prop('disabled', false);
                                  $('#{{ $viewFolder }}_prev_subjective_complaints_text').prop('required', true);
                                }else{
                                  $('#{{ $viewFolder }}_prev_subjective_complaints_text').prop('disabled', true);
                                  $('#{{ $viewFolder }}_prev_subjective_complaints_text').prop('required', false);
                                  $('#{{ $viewFolder }}_prev_subjective_complaints_text').val('');
                                }
                              " {{ (isset($bookings[0]->subjective_complaints) && $bookings[0]->ambulation_status == 'none') ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_subjective_complaints_none">none</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $viewFolder }}[prev_subjective_complaints]" value="yes" id="{{ $viewFolder }}_prev_subjective_complaints_yes" onchange="
                                if($(this).prop('checked')){
                                  $('#{{ $viewFolder }}_prev_subjective_complaints_text').prop('disabled', false);
                                  $('#{{ $viewFolder }}_prev_subjective_complaints_text').prop('required', true);
                                }else{
                                  $('#{{ $viewFolder }}_prev_subjective_complaints_text').prop('disabled', true);
                                  $('#{{ $viewFolder }}_prev_subjective_complaints_text').prop('required', false);
                                  $('#{{ $viewFolder }}_prev_subjective_complaints_text').val('');
                                }
                              "  {{ (isset($bookings[0]->subjective_complaints) && $bookings[0]->subjective_complaints == 'yes') ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_subjective_complaints_yes">yes</label>
                          </div>
                          <textarea class="form-control" name="{{ $viewFolder }}[subjective_complaints_text]" id="{{ $viewFolder }}_prev_subjective_complaints_text" rows=3 {{ (isset($bookings[0]->subjective_complaints) && $bookings[0]->subjective_complaints == 'yes') ? '' : 'disabled' }} disabled>{{ isset($bookings[0]->subjective_complaints_text) ? $bookings[0]->subjective_complaints_text : '' }}</textarea>
                        </div>
                        <label>Significant PE Findings</label>
                        <div class="container ml-5 mb-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Pallor" id="{{ $viewFolder }}_prev_pe_findings_pallor" {{ (isset($bookings[0]->pe_findings) && is_array(json_decode($bookings[0]->pe_findings)) && in_array('Pallor', json_decode($bookings[0]->pe_findings))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_pe_findings_pallor">Pallor</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Distended Neck Vein" id="{{ $viewFolder }}_prev_pe_findings_neck_vein" {{ (isset($bookings[0]->pe_findings) && is_array(json_decode($bookings[0]->pe_findings)) && in_array('Distended Neck Vein', json_decode($bookings[0]->pe_findings))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_pe_findings_neck_vein">Distended Neck Vein</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Abnormal Rhythm/Rate" id="{{ $viewFolder }}_prev_pe_findings_rhythm" {{ (isset($bookings[0]->pe_findings) && is_array(json_decode($bookings[0]->pe_findings)) && in_array('Abnormal Rhythm/Rate', json_decode($bookings[0]->pe_findings))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_pe_findings_rhythm">Abnormal Rhythm/Rate</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Rales" id="{{ $viewFolder }}_prev_pe_findings_rales" {{ (isset($bookings[0]->pe_findings) && is_array(json_decode($bookings[0]->pe_findings)) && in_array('Rales', json_decode($bookings[0]->pe_findings))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_pe_findings_rales">Rales</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Wheezing" id="{{ $viewFolder }}_prev_pe_findings_wheezing" {{ (isset($bookings[0]->pe_findings) && is_array(json_decode($bookings[0]->pe_findings)) && in_array('Wheezing', json_decode($bookings[0]->pe_findings))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_pe_findings_wheezing">Wheezing</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Decreased Breath Sounds" id="{{ $viewFolder }}_prev_pe_findings_breath_sounds" {{ (isset($bookings[0]->pe_findings) && is_array(json_decode($bookings[0]->pe_findings)) && in_array('Decreased Breath Sounds', json_decode($bookings[0]->pe_findings))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_pe_findings_breath_sounds">Decreased Breath Sounds</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Ascites - Abdominal Girth" id="{{ $viewFolder }}_prev_pe_findings_ascites" onchange="
                                if($(this).prop('checked')){
                                  $('#{{ $viewFolder }}_prev_pe_findings_ascites_text').prop('disabled', false);
                                  $('#{{ $viewFolder }}_prev_pe_findings_ascites_text').prop('required', true);
                                }else{
                                  $('#{{ $viewFolder }}_prev_pe_findings_ascites_text').prop('disabled', true);
                                  $('#{{ $viewFolder }}_prev_pe_findings_ascites_text').prop('required', false);
                                  $('#{{ $viewFolder }}_prev_pe_findings_ascites_text').val('');
                                }
                              " {{ (isset($bookings[0]->pe_findings) && is_array(json_decode($bookings[0]->pe_findings)) && in_array('Ascites - Abdominal Girth', json_decode($bookings[0]->pe_findings))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_pe_findings_ascites">Ascites - Abdominal Girth:</label>
                          </div>
                          <textarea class="form-control" name="{{ $viewFolder }}[pe_findings_ascites_text]" id="{{ $viewFolder }}_prev_pe_findings_ascites_text" rows=3 {{ (isset($bookings[0]->pe_findings) && is_array(json_decode($bookings[0]->pe_findings)) && in_array('Ascites - Abdominal Girth', json_decode($bookings[0]->pe_findings))) ? '' : 'disabled' }} disabled>{{ isset($bookings[0]->pe_findings_ascites_text) ? $bookings[0]->pe_findings_ascites_text : '' }}</textarea>
                          {{-- <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Decreased Breath Sounds" id="{{ $viewFolder }}_pe_findings_breath_sounds">
                            <label class="form-check-label" for="{{ $viewFolder }}_pe_findings_breath_sounds">Decreased Breath Sounds</label>
                          </div> --}}
                          
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Edema Grade" id="{{ $viewFolder }}_prev_pe_findings_edema" onchange="
                                if($(this).prop('checked')){
                                  $('#{{ $viewFolder }}_prev_pe_findings_edema_text').prop('disabled', false);
                                  $('#{{ $viewFolder }}_prev_pe_findings_edema_text').prop('required', true);
                                }else{
                                  $('#{{ $viewFolder }}_prev_pe_findings_edema_text').prop('disabled', true);
                                  $('#{{ $viewFolder }}_prev_pe_findings_edema_text').prop('required', false);
                                  $('#{{ $viewFolder }}_prev_pe_findings_edema_text').val('');
                                }
                              " {{ (isset($bookings[0]->pe_findings) && is_array(json_decode($bookings[0]->pe_findings)) && in_array('Edema Grade', json_decode($bookings[0]->pe_findings))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_pe_findings_edema">Edema Grade:</label>
                          </div>
                          <textarea class="form-control" name="{{ $viewFolder }}[pe_findings_edema_text]" id="{{ $viewFolder }}_prev_pe_findings_edema_text" rows=3 {{ (isset($bookings[0]->pe_findings) && is_array(json_decode($bookings[0]->pe_findings)) && in_array('Edema Grade', json_decode($bookings[0]->pe_findings))) ? '' : 'disabled' }} disabled>{{ isset($bookings[0]->pe_findings_edema_text) ? $bookings[0]->pe_findings_edema_text : '' }}</textarea>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Bleeding" id="{{ $viewFolder }}_prev_pe_findings_bleeding" {{ (isset($bookings[0]->pe_findings) && is_array(json_decode($bookings[0]->pe_findings)) && in_array('Bleeding', json_decode($bookings[0]->pe_findings))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_pe_findings_bleeding">Bleeding</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Others" id="{{ $viewFolder }}_prev_pe_findings_others" onchange="
                                if($(this).prop('checked')){
                                  $('#{{ $viewFolder }}_prev_pe_findings_others_text').prop('disabled', false);
                                  $('#{{ $viewFolder }}_prev_pe_findings_others_text').prop('required', true);
                                }else{
                                  $('#{{ $viewFolder }}_prev_pe_findings_others_text').prop('disabled', true);
                                  $('#{{ $viewFolder }}_prev_pe_findings_others_text').prop('required', false);
                                  $('#{{ $viewFolder }}_prev_pe_findings_others_text').val('');
                                }
                              " {{ (isset($bookings[0]->pe_findings) && is_array(json_decode($bookings[0]->pe_findings)) && in_array('Others', json_decode($bookings[0]->pe_findings))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_pe_findings_others">Others:</label>
                          </div>
                          <textarea class="form-control" name="{{ $viewFolder }}[pe_findings_others_text]" id="{{ $viewFolder }}_prev_pe_findings_others_text" rows=3 {{ (isset($bookings[0]->pe_findings) && is_array(json_decode($bookings[0]->pe_findings)) && in_array('Others', json_decode($bookings[0]->pe_findings))) ? '' : 'disabled' }} disabled>{{ isset($bookings[0]->pe_findings_others_text) ? $bookings[0]->pe_findings_others_text : '' }}</textarea>
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
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_mental_status][]" value="awake" id="{{ $viewFolder }}_prev_post_mental_status_awake" {{ (isset($bookings[0]->post_mental_status) && is_array(json_decode($bookings[0]->post_mental_status)) && in_array('awake', json_decode($bookings[0]->post_mental_status))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_post_mental_status_awake">awake</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_mental_status][]" value="oriented" id="{{ $viewFolder }}_prev_post_mental_status_oriented" {{ (isset($bookings[0]->post_mental_status) && is_array(json_decode($bookings[0]->post_mental_status)) && in_array('oriented', json_decode($bookings[0]->post_mental_status))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_post_mental_status_oriented">oriented</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_mental_status][]" value="drowsy" id="{{ $viewFolder }}_prev_post_mental_status_drowsy" {{ (isset($bookings[0]->post_mental_status) && is_array(json_decode($bookings[0]->post_mental_status)) && in_array('drowsy', json_decode($bookings[0]->post_mental_status))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_post_mental_status_drowsy">drowsy</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_mental_status][]" value="disoriented" id="{{ $viewFolder }}_prev_post_mental_status_disoriented" {{ (isset($bookings[0]->post_mental_status) && is_array(json_decode($bookings[0]->post_mental_status)) && in_array('disoriented', json_decode($bookings[0]->post_mental_status))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_post_mental_status_disoriented">disoriented</label>
                          </div>
                        </div>
                        <label>Ambulation Status</label>
                        <div class="container ml-5 mb-3">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $viewFolder }}[prev_post_ambulation_status]" value="ambulatory" id="{{ $viewFolder }}_prev_post_ambulation_status_ambulatory" {{ (isset($bookings[0]->post_ambulation_status) && $bookings[0]->post_ambulation_status == 'ambulatory') ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_post_ambulation_status_ambulatory">ambulatory</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $viewFolder }}[prev_post_ambulation_status]" value="w/ assistance" id="{{ $viewFolder }}_prev_post_ambulation_status_assistance" {{ (isset($bookings[0]->post_ambulation_status) && $bookings[0]->post_ambulation_status == 'w/ assistance') ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_post_ambulation_status_assistance">w/ assistance</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $viewFolder }}[prev_post_ambulation_status]" value="wheelchair" id="{{ $viewFolder }}_prev_post_ambulation_status_wheelchair" {{ (isset($bookings[0]->post_ambulation_status) && $bookings[0]->post_ambulation_status == 'wheelchair') ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_post_ambulation_status_wheelchair">wheelchair</label>
                          </div>
                        </div>
                        <label>Subjective Complaints</label>
                        <div class="container ml-5 mb-3">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $viewFolder }}[prev_post_subjective_complaints]" value="none" id="{{ $viewFolder }}_prev_post_subjective_complaints_none" onchange="
                                if(!$(this).prop('checked')){
                                  $('#{{ $viewFolder }}_prev_post_subjective_complaints_text').prop('disabled', false);
                                  $('#{{ $viewFolder }}_prev_post_subjective_complaints_text').prop('required', true);
                                }else{
                                  $('#{{ $viewFolder }}_prev_post_subjective_complaints_text').prop('disabled', true);
                                  $('#{{ $viewFolder }}_prev_post_subjective_complaints_text').prop('required', false);
                                  $('#{{ $viewFolder }}_prev_post_subjective_complaints_text').val('');
                                }
                              " {{ (isset($bookings[0]->post_subjective_complaints) && $bookings[0]->post_subjective_complaints == 'none') ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_post_subjective_complaints_none">none</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $viewFolder }}[prev_post_subjective_complaints]" value="yes" id="{{ $viewFolder }}_prev_post_subjective_complaints_yes" onchange="
                                if($(this).prop('checked')){
                                  $('#{{ $viewFolder }}_prev_post_subjective_complaints_text').prop('disabled', false);
                                  $('#{{ $viewFolder }}_prev_post_subjective_complaints_text').prop('required', true);
                                }else{
                                  $('#{{ $viewFolder }}_prev_post_subjective_complaints_text').prop('disabled', true);
                                  $('#{{ $viewFolder }}_prev_post_subjective_complaints_text').prop('required', false);
                                  $('#{{ $viewFolder }}_prev_post_subjective_complaints_text').val('');
                                }
                              " {{ (isset($bookings[0]->post_subjective_complaints) && $bookings[0]->post_subjective_complaints == 'yes') ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_post_subjective_complaints_yes">yes</label>
                          </div>
                          <textarea class="form-control" name="{{ $viewFolder }}[post_subjective_complaints_text]" id="{{ $viewFolder }}_prev_post_subjective_complaints_text" rows=3 {{ (isset($bookings[0]->post_subjective_complaints) && $bookings[0]->post_subjective_complaints == 'yes') ? '' : 'disabled' }} disabled>{{ isset($bookings[0]->post_subjective_complaints_text) ? $bookings[0]->post_subjective_complaints_text : '' }}</textarea>
                        </div>
                        <label>Significant PE Findings</label>
                        <div class="container ml-5 mb-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Pallor" id="{{ $viewFolder }}_prev_post_pe_findings_pallor" {{ (isset($bookings[0]->post_pe_findings) && is_array(json_decode($bookings[0]->post_pe_findings)) && in_array('Pallor', json_decode($bookings[0]->post_pe_findings))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_post_pe_findings_pallor">Pallor</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Distended Neck Vein" id="{{ $viewFolder }}_prev_post_pe_findings_neck_vein" {{ (isset($bookings[0]->post_pe_findings) && is_array(json_decode($bookings[0]->post_pe_findings)) && in_array('Distended Neck Vein', json_decode($bookings[0]->post_pe_findings))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_post_pe_findings_neck_vein">Distended Neck Vein</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Abnormal Rhythm/Rate" id="{{ $viewFolder }}_prev_post_pe_findings_rhythm" {{ (isset($bookings[0]->post_pe_findings) && is_array(json_decode($bookings[0]->post_pe_findings)) && in_array('Abnormal Rhythm/Rate', json_decode($bookings[0]->post_pe_findings))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_post_pe_findings_rhythm">Abnormal Rhythm/Rate</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Rales" id="{{ $viewFolder }}_prev_post_pe_findings_rales" {{ (isset($bookings[0]->post_pe_findings) && is_array(json_decode($bookings[0]->post_pe_findings)) && in_array('Rales', json_decode($bookings[0]->post_pe_findings))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_post_pe_findings_rales">Rales</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Wheezing" id="{{ $viewFolder }}_prev_post_pe_findings_wheezing" {{ (isset($bookings[0]->post_pe_findings) && is_array(json_decode($bookings[0]->post_pe_findings)) && in_array('Wheezing', json_decode($bookings[0]->post_pe_findings))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_post_pe_findings_wheezing">Wheezing</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Decreased Breath Sounds" id="{{ $viewFolder }}_prev_post_pe_findings_breath_sounds" {{ (isset($bookings[0]->post_pe_findings) && is_array(json_decode($bookings[0]->post_pe_findings)) && in_array('Decreased Breath Sounds', json_decode($bookings[0]->post_pe_findings))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_post_pe_findings_breath_sounds">Decreased Breath Sounds</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Ascites - Abdominal Girth" id="{{ $viewFolder }}_prev_post_pe_findings_ascites" onchange="
                                if($(this).prop('checked')){
                                  $('#{{ $viewFolder }}_prev_post_pe_findings_ascites_text').prop('disabled', false);
                                  $('#{{ $viewFolder }}_prev_post_pe_findings_ascites_text').prop('required', true);
                                }else{
                                  $('#{{ $viewFolder }}_prev_post_pe_findings_ascites_text').prop('disabled', true);
                                  $('#{{ $viewFolder }}_prev_post_pe_findings_ascites_text').prop('required', false);
                                  $('#{{ $viewFolder }}_prev_post_pe_findings_ascites_text').val('');
                                }
                              " {{ (isset($bookings[0]->post_pe_findings) && is_array(json_decode($bookings[0]->post_pe_findings)) && in_array('Ascites - Abdominal Girth', json_decode($bookings[0]->post_pe_findings))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_post_pe_findings_ascites">Ascites - Abdominal Girth:</label>
                          </div>
                          <textarea class="form-control" name="{{ $viewFolder }}[post_pe_findings_ascites_text]" id="{{ $viewFolder }}_prev_post_pe_findings_ascites_text" rows=3 {{ (isset($bookings[0]->post_pe_findings) && is_array(json_decode($bookings[0]->post_pe_findings)) && in_array('Ascites - Abdominal Girth', json_decode($bookings[0]->post_pe_findings))) ? '' : 'disabled' }} disabled>{{ isset($bookings[0]->post_pe_findings_ascites_text) ? $bookings[0]->post_pe_findings_ascites_text : '' }}</textarea>
                          {{-- <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Decreased Breath Sounds" id="{{ $viewFolder }}_post_pe_findings_breath_sounds">
                            <label class="form-check-label" for="{{ $viewFolder }}_post_pe_findings_breath_sounds">Decreased Breath Sounds</label>
                          </div> --}}
                          
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Edema Grade" id="{{ $viewFolder }}_prev_post_pe_findings_edema" onchange="
                                if($(this).prop('checked')){
                                  $('#{{ $viewFolder }}_prev_post_pe_findings_edema_text').prop('disabled', false);
                                  $('#{{ $viewFolder }}_prev_post_pe_findings_edema_text').prop('required', true);
                                }else{
                                  $('#{{ $viewFolder }}_prev_post_pe_findings_edema_text').prop('disabled', true);
                                  $('#{{ $viewFolder }}_prev_post_pe_findings_edema_text').prop('required', false);
                                  $('#{{ $viewFolder }}_prev_post_pe_findings_edema_text').val('');
                                }
                              " {{ (isset($bookings[0]->post_pe_findings) && is_array(json_decode($bookings[0]->post_pe_findings)) && in_array('Edema Grade', json_decode($bookings[0]->post_pe_findings))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_post_pe_findings_edema">Edema Grade:</label>
                          </div>
                          <textarea class="form-control" name="{{ $viewFolder }}[post_pe_findings_edema_text]" id="{{ $viewFolder }}_prev_post_pe_findings_edema_text" rows=3 {{ (isset($bookings[0]->post_pe_findings) && is_array(json_decode($bookings[0]->post_pe_findings)) && in_array('Edema Grade', json_decode($bookings[0]->post_pe_findings))) ? '' : 'disabled' }} disabled>{{ isset($bookings[0]->post_pe_findings_edema_text) ? $bookings[0]->post_pe_findings_edema_text : '' }}</textarea>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Bleeding" id="{{ $viewFolder }}_prev_post_pe_findings_bleeding" {{ (isset($bookings[0]->post_pe_findings) && is_array(json_decode($bookings[0]->post_pe_findings)) && in_array('Bleeding', json_decode($bookings[0]->post_pe_findings))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_post_pe_findings_bleeding">Bleeding</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Others" id="{{ $viewFolder }}_prev_post_pe_findings_others" onchange="
                                if($(this).prop('checked')){
                                  $('#{{ $viewFolder }}_prev_post_pe_findings_others_text').prop('disabled', false);
                                  $('#{{ $viewFolder }}_prev_post_pe_findings_others_text').prop('required', true);
                                }else{
                                  $('#{{ $viewFolder }}_prev_post_pe_findings_others_text').prop('disabled', true);
                                  $('#{{ $viewFolder }}_prev_post_pe_findings_others_text').prop('required', false);
                                  $('#{{ $viewFolder }}_prev_post_pe_findings_others_text').val('');
                                }
                              " {{ (isset($bookings[0]->post_pe_findings) && is_array(json_decode($bookings[0]->post_pe_findings)) && in_array('Others', json_decode($bookings[0]->post_pe_findings))) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_post_pe_findings_others">Others:</label>
                          </div>
                          <textarea class="form-control" name="{{ $viewFolder }}[post_pe_findings_others_text]" id="{{ $viewFolder }}_prev_post_pe_findings_others_text" rows=3 {{ (isset($bookings[0]->post_pe_findings) && is_array(json_decode($bookings[0]->post_pe_findings)) && in_array('Others', json_decode($bookings[0]->post_pe_findings))) ? '' : 'disabled' }} disabled>{{ isset($bookings[0]->post_pe_findings_others_text) ? $bookings[0]->post_pe_findings_others_text : '' }}</textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card mb-3">
                      <div class="card-header">Vascular Access</div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-lg-4">
                            <label>Vascular Access</label>
                            <div class="container ml-5 mb-3">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="{{ $viewFolder }}[prev_vaccess]" value="left" id="{{ $viewFolder }}_prev_vaccess_left" {{ (isset($bookings[0]->vaccess) && $bookings[0]->vaccess == 'left') ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="{{ $viewFolder }}_prev_vaccess_left">left</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="{{ $viewFolder }}[prev_vaccess]" value="right" id="{{ $viewFolder }}_prev_vaccess_right" {{ (isset($bookings[0]->vaccess) && $bookings[0]->vaccess == 'right') ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="{{ $viewFolder }}_prev_vaccess_right">right</label>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-8">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[vaccess_detail][]" value="Fistula" id="{{ $viewFolder }}_prev_fistula" {{ (isset($bookings[0]->vaccess_detail) && is_array(json_decode($bookings[0]->vaccess_detail)) && in_array('Fistula', json_decode($bookings[0]->vaccess_detail))) ? 'checked' : '' }} disabled>
                              <label class="form-check-label" for="{{ $viewFolder }}_prev_fistula">Fistula</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[vaccess_detail][]" value="Graft" id="{{ $viewFolder }}_prev_graft" {{ (isset($bookings[0]->vaccess_detail) && is_array(json_decode($bookings[0]->vaccess_detail)) && in_array('Graft', json_decode($bookings[0]->vaccess_detail))) ? 'checked' : '' }} disabled>
                              <label class="form-check-label" for="{{ $viewFolder }}_prev_graft">Graft</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[vaccess_detail][]" value="CVC" id="{{ $viewFolder }}_prev_cvc" {{ (isset($bookings[0]->vaccess_detail) && is_array(json_decode($bookings[0]->vaccess_detail)) && in_array('CVC', json_decode($bookings[0]->vaccess_detail))) ? 'checked' : '' }} disabled>
                              <label class="form-check-label" for="{{ $viewFolder }}_prev_cvc">CVC / PERM / others</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="card mb-3">
                      <div class="card-header">AV Fistula</div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[av_fistula_detail][]" value="Strong Thrill" id="{{ $viewFolder }}_prev_strong_thrill" {{ (isset($bookings[0]->av_fistula_detail) && is_array(json_decode($bookings[0]->av_fistula_detail)) && in_array('Strong Thrill', json_decode($bookings[0]->av_fistula_detail))) ? 'checked' : '' }} disabled>
                              <label class="form-check-label" for="{{ $viewFolder }}_prev_strong_thrill">Strong Thrill</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[av_fistula_detail][]" value="Weak Thrill" id="{{ $viewFolder }}_prev_weak_thrill" {{ (isset($bookings[0]->av_fistula_detail) && is_array(json_decode($bookings[0]->av_fistula_detail)) && in_array('Weak Thrill', json_decode($bookings[0]->av_fistula_detail))) ? 'checked' : '' }} disabled>
                              <label class="form-check-label" for="{{ $viewFolder }}_prev_weak_thrill">Weak Thrill</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[av_fistula_detail][]" value="Absent Thrill w/ Bruit" id="{{ $viewFolder }}_prev_absent_thrill_with" {{ (isset($bookings[0]->av_fistula_detail) && is_array(json_decode($bookings[0]->av_fistula_detail)) && in_array('Absent Thrill w/ Bruit', json_decode($bookings[0]->av_fistula_detail))) ? 'checked' : '' }} disabled>
                              <label class="form-check-label" for="{{ $viewFolder }}_prev_absent_thrill_with">Absent Thrill w/ Bruit</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[av_fistula_detail][]" value="Absent Thrill no Bruit" id="{{ $viewFolder }}_prev_absent_thrill_no" {{ (isset($bookings[0]->av_fistula_detail) && is_array(json_decode($bookings[0]->av_fistula_detail)) && in_array('Absent Thrill no Bruit', json_decode($bookings[0]->av_fistula_detail))) ? 'checked' : '' }} disabled>
                              <label class="form-check-label" for="{{ $viewFolder }}_prev_absent_thrill_no">Absent Thrill no Bruit</label>
                            </div>
                            <div class="input-group mb-3 mt-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[needle_gauge]" id="{{ $viewFolder }}_prev_needle_gauge" placeholder="" value="{{ !empty($bookings[0]->needle_gauge) ? $bookings[0]->needle_gauge : '' }}" disabled>
                                <label for="{{ $viewFolder }}_prev_needle_gauge" class="form-label">Needle Gauge</label>
                                <small id="help_{{ $viewFolder }}_prev_needle_gauge" class="text-muted"></small>
                              </div>
                            </div>
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="number" step="1" name="{{ $viewFolder }}[number_commultation]" id="{{ $viewFolder }}_prev_number_commultation" placeholder="" value="{{ !empty($bookings[0]->number_commultation) ? $bookings[0]->number_commultation : '' }}" disabled>
                                <label for="{{ $viewFolder }}_prev_number_commultation" class="form-label"># of Cannulation</label>
                                <small id="help_{{ $viewFolder }}_prev_number_commultation" class="text-muted"></small>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">  
                    <div class="card mb-3">
                      <div class="card-header">HD Catheter</div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[hd_catheter_detail][]" value="Both Patent" id="{{ $viewFolder }}_prev_both_patent" {{ (isset($bookings[0]->hd_catheter_detail) && is_array(json_decode($bookings[0]->hd_catheter_detail)) && in_array('Both Patent', json_decode($bookings[0]->hd_catheter_detail))) ? 'checked' : '' }} disabled>
                              <label class="form-check-label" for="{{ $viewFolder }}_prev_both_patent">Both Patent</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[hd_catheter_detail][]" value="A Clotted" id="{{ $viewFolder }}_prev_a_clotted" {{ (isset($bookings[0]->hd_catheter_detail) && is_array(json_decode($bookings[0]->hd_catheter_detail)) && in_array('A Clotted', json_decode($bookings[0]->hd_catheter_detail))) ? 'checked' : '' }} disabled>
                              <label class="form-check-label" for="{{ $viewFolder }}_prev_a_clotted">A Clotted</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[hd_catheter_detail][]" value="V Clotted" id="{{ $viewFolder }}_prev_v_clotted" {{ (isset($bookings[0]->hd_catheter_detail) && is_array(json_decode($bookings[0]->hd_catheter_detail)) && in_array('V Clotted', json_decode($bookings[0]->hd_catheter_detail))) ? 'checked' : '' }} disabled>
                              <label class="form-check-label" for="{{ $viewFolder }}_prev_v_clotted">V Clotted</label>
                            </div>
                            <div class="input-group mb-3 mt-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[hd_catheter_remarks]" id="{{ $viewFolder }}_prev_hd_catheter_remarks" placeholder="" value="{{ !empty($bookings[0]->hd_catheter_remarks) ? $bookings[0]->hd_catheter_remarks : '' }}" disabled>
                                <label for="{{ $viewFolder }}_prev_hd_catheter_remarks" class="form-label">Remarks</label>
                                <small id="help_{{ $viewFolder }}_prev_hd_catheter_remarks" class="text-muted"></small>
                              </div>
                            </div>
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[hd_catheter_hgb]" id="{{ $viewFolder }}_prev_hd_catheter_hgb" placeholder="" value="{{ !empty($bookings[0]->hd_catheter_hgb) ? $bookings[0]->hd_catheter_hgb : '' }}" disabled>
                                <label for="{{ $viewFolder }}_prev_hd_catheter_hgb" class="form-label">Latest HGB</label>
                                <small id="help_{{ $viewFolder }}_prev_hd_catheter_hgb" class="text-muted"></small>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card mb-3">
                      <div class="card-header">Medication Given</div>
                      <div class="card-body">
                        @if(Route::has($viewFolder . '.getMedTable'))
                        <div class="card mb-3">
                          <div class="card-header">Add Entry</div>
                          <div class="card-body">
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="time" name="{{ $viewFolder }}[Med][time_given]" id="{{ $viewFolder }}_time_given" value="" placeholder="" onchange="
                                  if($(this).val() != ''){
                                    $('#{{ $viewFolder }}_medication').prop('required', true);
                                    $('#{{ $viewFolder }}_dosage').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_medication').prop('required', false);
                                    $('#{{ $viewFolder }}_dosage').prop('required', false);
                                  }
                                  if($(this).val() != '' && $('#{{ $viewFolder }}_medication').val() != '' && $('#{{ $viewFolder }}_dosage').val() != '')
                                    $('#addMedLog{{ $datum->id }}').prop('disabled', false);
                                  else
                                    $('#addMedLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                <label for="{{ $viewFolder }}_time_given" class="form-label">Time Given</label>
                                <small id="help_{{ $viewFolder }}_time_given" class="text-muted"></small>
                              </div>
                            </div>
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[Med][medication]" id="{{ $viewFolder }}_medication" placeholder="" onchange="
                                  if($('#{{ $viewFolder }}_time_given').val() != ''){
                                    $('#{{ $viewFolder }}_medication').prop('required', true);
                                    $('#{{ $viewFolder }}_dosage').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_medication').prop('required', false);
                                    $('#{{ $viewFolder }}_dosage').prop('required', false);
                                  }
                                  if($('#{{ $viewFolder }}_time_given').val() != '' && $('#{{ $viewFolder }}_medication').val() != '' && $('#{{ $viewFolder }}_dosage').val() != '')
                                    $('#addMedLog{{ $datum->id }}').prop('disabled', false);
                                  else
                                    $('#addMedLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                <label for="{{ $viewFolder }}_medication" class="form-label">Medication</label>
                                <small id="help_{{ $viewFolder }}_medication" class="text-muted"></small>
                              </div>
                            </div>
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[Med][dosage]" id="{{ $viewFolder }}_dosage" placeholder=""  onchange="
                                  if($('#{{ $viewFolder }}_time_given').val() != ''){
                                    $('#{{ $viewFolder }}_medication').prop('required', true);
                                    $('#{{ $viewFolder }}_dosage').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_medication').prop('required', false);
                                    $('#{{ $viewFolder }}_dosage').prop('required', false);
                                  }
                                  if($('#{{ $viewFolder }}_time_given').val() != '' && $('#{{ $viewFolder }}_medication').val() != '' && $('#{{ $viewFolder }}_dosage').val() != '')
                                    $('#addMedLog{{ $datum->id }}').prop('disabled', false);
                                  else
                                    $('#addMedLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                <label for="{{ $viewFolder }}_dosage" class="form-label">Dosage</label>
                                <small id="help_{{ $viewFolder }}_dosage" class="text-muted"></small>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer">
                            <button id="addMedLog{{ $datum->id }}" type="button" class="addMedLog btn btn-{{ $bgColor }} btn-sm" disabled onclick="
                              $.ajax({
                                type: 'POST',
                                data: $('#bookMod').serialize(),
                                url: '{{ Route::has($viewFolder . '.' . $formAction) ? route($viewFolder . '.' . $formAction, $datum->id) : ''}}',
                                success:
                                function (){
                                    $.ajax({
                                      type: 'GET',
                                      url: '{{ Route::has($viewFolder . '.getMedTable') ? route($viewFolder . '.getMedTable', $datum->id) : '' }}',
                                      success:
                                      function (data){
                                        medObj = jQuery.parseJSON(data);
                                        var tr;
                                        medObj.forEach(function (item, index){
                                          tr += '<tr id=\'' + item.id + '\' log=\'meds\'><td><div class=\'d-sm-flex flex-sm-row\'><div class=\'m-1\'><button type=\'submit\' class=\'btn btn-{{ $bgColor }} btn-sm w-100 rowBtnDel\'><i class=\'bi bi-trash\'></i><span class=\'ps-1 d-sm-none\'>Delete</span></button></div></div></td><td>' + item.time_given + '</td><td>' + item.medication + '</td><td>' + item.dosage + '</td><td>' + item.creator + '</td></tr>';
                                        });
                                        $('#medTable{{ $datum->id }}').html(tr);
                                      }
                                    });
                                    $('#{{ $viewFolder }}_time_given').val('')
                                    $('#{{ $viewFolder }}_medication').val('');
                                    $('#{{ $viewFolder }}_dosage').val('');
                                    $('#addMedLog{{ $datum->id }}').prop('disabled', true);
                                }
                              });

                            ">Add Medication Log</button>
                          </div>
                        </div>
                        @endif
                        <div class="card-body table-responsive" style="max-height: 300px">
                          <table class="table table-bordered table-striped table-hover table-sm hdLogs">
                            <thead class="table-{{ $bgColor }}">
                              <tr>
                                <th class=""><i class="bi bi-gear"></i></th>
                                <th>Time</th>
                                <th>Medication</th>
                                <th>Dosage</th>
                                <th>NOD</th>
                              </tr>
                            </thead>
                            <tbody id="medTable{{ $datum->id }}">
                            @foreach ($bookings[0]->consultation_meds()->orderBy('id', 'desc')->get() as $dat)
                                <tr id="{{ $dat->id }}" log="meds">
                                    <td>@if(Route::has($viewFolder . '.getMedTable'))<div class="d-sm-flex flex-sm-row"><div class="m-1"><button type="submit" class="btn btn-{{ $bgColor }} btn-sm w-100 rowBtnDel"><i class="bi bi-trash"></i><span class="ps-1 d-sm-none">Delete</span></button></div></div>@endif</td>
                                    <td>{{ $dat->time_given }}</td>
                                    <td>{{ $dat->medication }}</td>
                                    <td>{{ $dat->dosage }}</td>
                                    <td>{{ $dat->creator->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card mb-3">
                      <div class="card-header">Special Endorsement</div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[rml]" id="{{ $viewFolder }}_prev_rml" placeholder="" value="{{ !empty($bookings[0]->rml) ? $bookings[0]->rml : '' }}" disabled>
                                <label for="{{ $viewFolder }}_prev_rml" class="form-label">RML</label>
                                <small id="help_{{ $viewFolder }}_prev_rml" class="text-muted"></small>
                              </div>
                            </div>
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[hepa]" id="{{ $viewFolder }}_prev_hepa" placeholder="" value="{{ !empty($bookings[0]->hepa) ? $bookings[0]->hepa : '' }}" disabled>
                                <label for="{{ $viewFolder }}_prev_hepa" class="form-label">HEPA Profile</label>
                                <small id="help_{{ $viewFolder }}_prev_hepa" class="text-muted"></small>
                              </div>
                            </div>
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[iv_iron]" id="{{ $viewFolder }}_prev_iv_iron" placeholder="" value="{{ !empty($bookings[0]->iv_iron) ? $bookings[0]->iv_iron : '' }}" disabled>
                                <label for="{{ $viewFolder }}_prev_iv_iron" class="form-label">IV Iron</label>
                                <small id="help_{{ $viewFolder }}_prev_iv_iron" class="text-muted"></small>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[epo]" id="{{ $viewFolder }}_prev_epo" placeholder="" value="{{ !empty($bookings[0]->epo) ? $bookings[0]->epo : '' }}" disabled>
                                <label for="{{ $viewFolder }}_prev_epo" class="form-label">EPO</label>
                                <small id="help_{{ $viewFolder }}_prev_epo" class="text-muted"></small>
                              </div>
                            </div>
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[hd_vac]" id="{{ $viewFolder }}_prev_hd_vac" placeholder="" value="{{ !empty($bookings[0]->hd_vac) ? $bookings[0]->hd_vac : '' }}" disabled>
                                <label for="{{ $viewFolder }}_prev_hd_vac" class="form-label">Vaccines</label>
                                <small id="help_{{ $viewFolder }}_prev_hd_vac" class="text-muted"></small>
                              </div>
                            </div>
                            <div class="form-floating mb-3">
                              <textarea class="form-control" name="{{ $viewFolder }}[hd_endorsement]" id="{{ $viewFolder }}_prev_hd_endorsement" disabled>{{ !empty($bookings[0]->hd_endorsement) ? $bookings[0]->hd_endorsement : '' }}</textarea>
                              <label for="{{ $viewFolder }}_prev_hd_endorsement" class="form-label">Endorsement Details</label>
                              <small id="help_{{ $viewFolder }}_prev_hd_endorsement" class="text-muted"></small>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card mb-3">
                      <div class="card-header">Dialysis Monitoring</div>
                      <div class="card-body">
                        @if(Route::has($viewFolder . '.getMonTable'))
                        <div class="card mb-3">
                          <div class="card-header">Add Entry</div>
                          <div class="card-body">
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="time" name="{{ $viewFolder }}[Monitoring][time_given]" id="{{ $viewFolder }}_mon_time" value="" placeholder="" onchange="
                                  if($(this).val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_time" class="form-label">Time</label>
                                    <small id="help_{{ $viewFolder }}_mon_time" class="text-muted"></small>
                                  </div>
                                </div>
                                <label for="{{ $viewFolder }}_bpS" class="form-label">BP</label>
                                <div class="input-group mb-3">
                                  <input class="form-control" type="number" name="{{ $viewFolder }}[Monitoring][bpS]" min=50 max=250 step=1 id="{{ $viewFolder }}_mon_bpS" placeholder="Systolic" {{ isset($datum->id) ? '' : '' }} onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                  <span class="input-group-text">/</span>
                                  <input class="form-control" type="number" name="{{ $viewFolder }}[Monitoring][bpD]" min=30 max=150 step=1 id="{{ $viewFolder }}_mon_bpD" placeholder="Diastolic" {{ isset($datum->id) ? '' : '' }} onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                </div>
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="number" name="{{ $viewFolder }}[Monitoring][heart]" min=1 id="{{ $viewFolder }}_mon_heart" placeholder="" {{ isset($datum->id) ? '' : '' }} onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_heart" class="form-label">Heart/Pulse Rate</label>
                                    <small id="help_{{ $viewFolder }}_mon_heart" class="text-muted"></small>
                                  </div>
                                  <span class="input-group-text">BPM</span>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="number" name="{{ $viewFolder }}[Monitoring][o2]" min=1 id="{{ $viewFolder }}_mon_o2" placeholder="" {{ isset($datum->id) ? '' : '' }} onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_o2" class="form-label">O2 Sat</label>
                                    <small id="help_{{ $viewFolder }}_mon_o2" class="text-muted"></small>
                                  </div>
                                  <span class="input-group-text">%</span>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="text" name="{{ $viewFolder }}[Monitoring][ap]" id="{{ $viewFolder }}_mon_ap" placeholder="" onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_ap" class="form-label">AP</label>
                                    <small id="help_{{ $viewFolder }}_mon_ap" class="text-muted"></small>
                                  </div>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="text" name="{{ $viewFolder }}[Monitoring][vp]" id="{{ $viewFolder }}_mon_vp" placeholder="" onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_vp" class="form-label">VP</label>
                                    <small id="help_{{ $viewFolder }}_mon_vp" class="text-muted"></small>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="text" name="{{ $viewFolder }}[Monitoring][tmp]" id="{{ $viewFolder }}_mon_tmp" placeholder="" onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_tmp" class="form-label">TMP</label>
                                    <small id="help_{{ $viewFolder }}_mon_tmp" class="text-muted"></small>
                                  </div>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="text" name="{{ $viewFolder }}[Monitoring][bfr]" id="{{ $viewFolder }}_mon_bfr" placeholder="" onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_bfr" class="form-label">BRF</label>
                                    <small id="help_{{ $viewFolder }}_mon_bfr" class="text-muted"></small>
                                  </div>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="text" name="{{ $viewFolder }}[Monitoring][nss]" id="{{ $viewFolder }}_mon_nss" placeholder="" onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_nss" class="form-label">NSS</label>
                                    <small id="help_{{ $viewFolder }}_mon_nss" class="text-muted"></small>
                                  </div>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="text" name="{{ $viewFolder }}[Monitoring][ufr]" id="{{ $viewFolder }}_mon_ufr" placeholder="" onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_ufr" class="form-label">UFR</label>
                                    <small id="help_{{ $viewFolder }}_mon_ufr" class="text-muted"></small>
                                  </div>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="text" name="{{ $viewFolder }}[Monitoring][ufv]" id="{{ $viewFolder }}_mon_ufv" placeholder="" onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_ufv" class="form-label">UFV</label>
                                    <small id="help_{{ $viewFolder }}_mon_ufv" class="text-muted"></small>
                                  </div>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="text" name="{{ $viewFolder }}[Monitoring][remarks]" id="{{ $viewFolder }}_mon_remarks" placeholder="" onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_remarks" class="form-label">Remarks</label>
                                    <small id="help_{{ $viewFolder }}_mon_remarks" class="text-muted"></small>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer">
                            <button id="addMonLog{{ $datum->id }}" type="button" class="addMonLog btn btn-{{ $bgColor }} btn-sm" disabled onclick="
                              $.ajax({
                                type: 'POST',
                                data: $('#bookMod').serialize(),
                                url: '{{ Route::has($viewFolder . '.' . $formAction) ? route($viewFolder . '.' . $formAction, $datum->id) : ''}}',
                                success:
                                function (){
                                    $.ajax({
                                      type: 'GET',
                                      url: '{{ Route::has($viewFolder . '.getMonTable') ? route($viewFolder . '.getMonTable', $datum->id) : '' }}',
                                      success:
                                      function (data){
                                        medObj = jQuery.parseJSON(data);
                                        var tr;
                                        medObj.forEach(function (item, index){
                                          tr += '<tr id=\'' + item.id + '\' log=\'moni\'><td><div class=\'d-sm-flex flex-sm-row\'><div class=\'m-1\'><button type=\'submit\' class=\'btn btn-{{ $bgColor }} btn-sm w-100 rowBtnDel\'><i class=\'bi bi-trash\'></i><span class=\'ps-1 d-sm-none\'>Delete</span></button></div></div></td><td>' + item.time_given + '</td><td>' + item.bpS + '/' + item.bpD + '</td><td>' + item.heart + 'BPM</td><td>' + item.o2 + '%</td><td>' + item.ap + '</td><td>' + item.vp + '</td><td>' + item.tmp + '</td><td>' + item.bfr + '</td><td>' + item.nss + '</td><td>' + item.ufr + '</td><td>' + item.ufv + '</td><td>' + item.remarks + '</td><td>' + item.creator + '</td></tr>';
                                        });
                                        $('#monTable{{ $datum->id }}').html(tr);
                                      }
                                    });
                                    $('#{{ $viewFolder }}_mon_time').val('');
                                    $('#{{ $viewFolder }}_mon_bpS').val('');
                                    $('#{{ $viewFolder }}_mon_bpD').val('');
                                    $('#{{ $viewFolder }}_mon_heart').val('');
                                    $('#{{ $viewFolder }}_mon_o2').val('');
                                    $('#{{ $viewFolder }}_mon_ap').val('');
                                    $('#{{ $viewFolder }}_mon_vp').val('');
                                    $('#{{ $viewFolder }}_mon_tmp').val('');
                                    $('#{{ $viewFolder }}_mon_bfr').val('');
                                    $('#{{ $viewFolder }}_mon_nss').val('');
                                    $('#{{ $viewFolder }}_mon_ufr').val('');
                                    $('#{{ $viewFolder }}_mon_ufv').val('');
                                    $('#{{ $viewFolder }}_mon_remarks').val('');
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                }
                              });

                            ">Add Monitoring Log</button>
                          </div>
                        </div>
                        @endif
                        <div class="card-body table-responsive" style="max-height: 300px">
                          <table class="table table-bordered table-striped table-hover table-sm hdLogs">
                            <thead class="table-{{ $bgColor }}">
                              <tr>
                                <th class=""><i class="bi bi-gear"></i></th>
                                <th>Time</th>
                                <th>BP</th>
                                <th>HR</th>
                                <th>O2 Sat</th>
                                <th>AP</th>
                                <th>VP</th>
                                <th>TMP</th>
                                <th>BRF</th>
                                <th>NSS</th>
                                <th>UFR</th>
                                <th>UFV</th>
                                <th>Remarks</th>
                                <th>NOD</th>
                              </tr>
                            </thead>
                            <tbody id="monTable{{ $datum->id }}">
                            @foreach ($bookings[0]->consultation_monitorings()->orderBy('id', 'desc')->get() as $dat)
                                <tr id="{{ $dat->id }}" log="moni">
                                    <td>@if(Route::has($viewFolder . '.getMonTable'))<div class="d-sm-flex flex-sm-row"><div class="m-1"><button type="submit" class="btn btn-{{ $bgColor }} btn-sm w-100 rowBtnDel"><i class="bi bi-trash"></i><span class="ps-1 d-sm-none">Delete</span></button></div></div>@endif</td>
                                    <td>{{ $dat->time_given }}</td>
                                    <td>{{ $dat->bpS . '/' . $dat->bpD }}</td>
                                    <td>{{ $dat->heart }}BPM</td>
                                    <td>{{ $dat->o2 }}%</td>
                                    <td>{{ $dat->ap }}</td>
                                    <td>{{ $dat->vp }}</td>
                                    <td>{{ $dat->tmp }}</td>
                                    <td>{{ $dat->bfr }}</td>
                                    <td>{{ $dat->nss }}</td>
                                    <td>{{ $dat->ufr }}</td>
                                    <td>{{ $dat->ufv }}</td>
                                    <td>{{ $dat->remarks }}</td>
                                    <td>{{ $dat->creator->name }}</td>
                                </tr>
                            @endforeach 
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card mb-3">
                      <div class="card-header">Nurse Notes</div>
                      <div class="card-body">
                        @if(Route::has($viewFolder . '.getNurseNotesTable'))
                        <div class="card mb-3">
                          <div class="card-header">Add Entry</div>
                          <div class="card-body">
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="time" name="{{ $viewFolder }}[Nurse][time_given]" id="{{ $viewFolder }}_notes_time" value="" placeholder="" onchange="
                                  if($(this).val() != ''){
                                    $('#{{ $viewFolder }}_nurse_notes').prop('required', true);
                                  
                                  }else{
                                    $('#{{ $viewFolder }}_nurse_notes').prop('required', false);
                                    
                                  }
                                  if($(this).val() != '' && $('#{{ $viewFolder }}_nurse_notes').val() != '')
                                    $('#addNurseNotesLog{{ $datum->id }}').prop('disabled', false);
                                  else
                                    $('#addNurseNotesLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                <label for="{{ $viewFolder }}_notes_time" class="form-label">Time Given</label>
                                <small id="help_{{ $viewFolder }}_notes_time" class="text-muted"></small>
                              </div>
                            </div>
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[Nurse][notes]" id="{{ $viewFolder }}_nurse_notes" placeholder="" onchange="
                                  if($('#{{ $viewFolder }}_notes_time').val() != ''){
                                    $('#{{ $viewFolder }}_nurse_notes').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_nurse_notes').prop('required', false);
                                  }
                                  if($('#{{ $viewFolder }}_notes_time').val() != '' && $('#{{ $viewFolder }}_nurse_notes').val() != '')
                                    $('#addNurseNotesLog{{ $datum->id }}').prop('disabled', false);
                                  else
                                    $('#addNurseNotesLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                <label for="{{ $viewFolder }}_nurse_notes" class="form-label">Notes</label>
                                <small id="help_{{ $viewFolder }}_nurse_notes" class="text-muted"></small>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer">
                            <button id="addNurseNotesLog{{ $datum->id }}" type="button" class="addNurseNotesLog btn btn-{{ $bgColor }} btn-sm" disabled onclick="
                              $.ajax({
                                type: 'POST',
                                data: $('#bookMod').serialize(),
                                url: '{{ Route::has($viewFolder . '.' . $formAction) ? route($viewFolder . '.' . $formAction, $datum->id) : ''}}',
                                success:
                                function (){
                                    $.ajax({
                                      type: 'GET',
                                      url: '{{ Route::has($viewFolder . '.getNurseNotesTable') ? route($viewFolder . '.getNurseNotesTable', $datum->id) : '' }}',
                                      success:
                                      function (data){
                                        medObj = jQuery.parseJSON(data);
                                        var tr;
                                        medObj.forEach(function (item, index){
                                          tr += '<tr id=\'' + item.id + '\' log=\'nurseNotes\'><td><div class=\'d-sm-flex flex-sm-row\'><div class=\'m-1\'><button type=\'submit\' class=\'btn btn-{{ $bgColor }} btn-sm w-100 rowBtnDel\'><i class=\'bi bi-trash\'></i><span class=\'ps-1 d-sm-none\'>Delete</span></button></div></div></td><td>' + item.time_given + '</td><td>' + item.notes + '</td><td>' + item.creator + '</td></tr>';
                                        });
                                        $('#nurseNotesTable{{ $datum->id }}').html(tr);
                                      }
                                    });
                                    $('#{{ $viewFolder }}_notes_time').val('')
                                    $('#{{ $viewFolder }}_nurse_notes').val('');
                                    $('#addNurseNotesLog{{ $datum->id }}').prop('disabled', true);
                                }
                              });

                            ">Add Nurse Notes</button>
                          </div>
                        </div>
                        @endif
                        <div class="card-body table-responsive" style="max-height: 300px">
                          <table class="table table-bordered table-striped table-hover table-sm hdLogs">
                            <thead class="table-{{ $bgColor }}">
                              <tr>
                                <th class=""><i class="bi bi-gear"></i></th>
                                <th>Time</th>
                                <th>Notes</th>
                                <th>NOD</th>
                              </tr>
                            </thead>
                            <tbody id="nurseNotesTable{{ $datum->id }}">
                            @foreach ($bookings[0]->consultation_nurse_notes()->orderBy('id', 'desc')->get() as $dat)
                                <tr id="{{ $dat->id }}" log="nurseNotes">
                                    <td>@if(Route::has($viewFolder . '.getNurseNotesTable'))<div class="d-sm-flex flex-sm-row"><div class="m-1"><button type="submit" class="btn btn-{{ $bgColor }} btn-sm w-100 rowBtnDel"><i class="bi bi-trash"></i><span class="ps-1 d-sm-none">Delete</span></button></div></div>@endif</td>
                                    <td>{{ $dat->time_given }}</td>
                                    <td>{{ $dat->notes }}</td>
                                    <td>{{ $dat->creator->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card mb-3">
                      <div class="card-header">Early Termination Waiver</div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="number" name="{{ $viewFolder }}[shorten_min]" id="{{ $viewFolder }}_prev_shorten_min" placeholder="" value="{{ !empty($bookings[0]->shorten_min) ? $bookings[0]->shorten_min : '' }}" disabled>
                                <label for="{{ $viewFolder }}_shorten_min" class="form-label">Shorten Treatment to</label>
                                <small id="help_{{ $viewFolder }}_shorten_min" class="text-muted"></small>
                              </div>
                              <span class="input-group-text">mins</span>
                            </div>
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[shorten_reason]" id="{{ $viewFolder }}_prev_shorten_reason" placeholder="" value="{{ !empty($bookings[0]->shorten_reason) ? $bookings[0]->shorten_reason : '' }}" disabled>
                                <label for="{{ $viewFolder }}_shorten_reason" class="form-label">Reason</label>
                                <small id="help_{{ $viewFolder }}_shorten_reason" class="text-muted"></small>
                              </div>
                              
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
        
        @endif
      </div>
      
      <div id="curChart" class="col-lg-12">
        <div class="card mb-3 d-lg-block">
          <div class="card-header">Current Patient's Chart ({{ $datum->bookingDate }})&nbsp;<a id="showPast" class="d-none d-lg-block" href="#" onclick="
            $('#curChart').removeClass('col-lg-12');
            $('#curChart').addClass('col-lg-6');
            $('#pastChart').show();
            $('#pastChart').removeClass('d-none');
            $('#pastChart').removeClass('d-lg-none');
          ">show past patient's chart</a></div>
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
            <ul class="nav nav-tabs d-xs-block d-lg-none">
              <li class="nav-item">
                <a class="nav-link active" id="sumCurLink" href="#" onclick="
                  $('#sumPrevLink').addClass('active');  
                  $('#soapPrevLink').removeClass('active');  
                  $('#labPrevLink').removeClass('active');  
                  $('#presPrevLink').removeClass('active');  
                  $('#medPrevLink').removeClass('active');  
                  $('#admitPrevLink').removeClass('active');
                  $('#dialysisPrevLink').removeClass('active');
                  $('#sumPrevDiv').show();  
                  $('#soapPrevDiv').hide();  
                  $('#labPrevDiv').hide();  
                  $('#presPrevDiv').hide();  
                  $('#medPrevDiv').hide();  
                  $('#admitPrevDiv').hide();
                  $('#dialysisPrevDiv').hide();
                  $('#sumCurLink').addClass('active');  
                  $('#soapCurLink').removeClass('active');  
                  $('#labCurLink').removeClass('active');  
                  $('#presCurLink').removeClass('active');  
                  $('#medCurLink').removeClass('active');  
                  $('#admitCurLink').removeClass('active');
                  $('#dialysisCurLink').removeClass('active');
                  $('#sumCurDiv').show();  
                  $('#soapCurDiv').hide();  
                  $('#labCurDiv').hide();  
                  $('#presCurDiv').hide();  
                  $('#medCurDiv').hide();  
                  $('#admitCurDiv').hide();
                  $('#dialysisCurDiv').hide();
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
                  $('#dialysisPrevLink').removeClass('active');
                  $('#soapPrevDiv').show();  
                  $('#sumPrevDiv').hide();  
                  $('#labPrevDiv').hide();  
                  $('#presPrevDiv').hide();  
                  $('#medPrevDiv').hide();  
                  $('#admitPrevDiv').hide();
                  $('#dialysisPrevDiv').hide();
                  $('#soapCurLink').addClass('active');  
                  $('#sumCurLink').removeClass('active');  
                  $('#labCurLink').removeClass('active');  
                  $('#presCurLink').removeClass('active');  
                  $('#medCurLink').removeClass('active');  
                  $('#admitCurLink').removeClass('active');
                  $('#dialysisCurLink').removeClass('active');
                  $('#soapCurDiv').show();  
                  $('#sumCurDiv').hide();  
                  $('#labCurDiv').hide();  
                  $('#presCurDiv').hide();  
                  $('#medCurDiv').hide();  
                  $('#admitCurDiv').hide();
                  $('#dialysisCurDiv').hide();
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
                  $('#dialysisPrevLink').removeClass('active');
                  $('#sumPrevDiv').hide();  
                  $('#soapPrevDiv').hide();  
                  $('#labPrevDiv').show();  
                  $('#presPrevDiv').hide();  
                  $('#medPrevDiv').hide();  
                  $('#admitPrevDiv').hide();
                  $('#dialysisPrevDiv').hide();
                  $('#sumCurLink').removeClass('active');
                  $('#soapCurLink').removeClass('active');
                  $('#labCurLink').addClass('active');  
                  $('#presCurLink').removeClass('active');  
                  $('#medPCurLink').removeClass('active');  
                  $('#admitCurLink').removeClass('active');
                  $('#dialysisCurLink').removeClass('active');
                  $('#sumCurDiv').hide();  
                  $('#soapCurDiv').hide();  
                  $('#labCurDiv').show();  
                  $('#presCurDiv').hide();  
                  $('#medCurDiv').hide();  
                  $('#admitCurDiv').hide();
                  $('#dialysisCurDiv').hide();
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
                  $('#dialysisPrevLink').removeClass('active');
                  $('#sumPrevDiv').hide();  
                  $('#soapPrevDiv').hide();  
                  $('#labPrevDiv').hide();  
                  $('#presPrevDiv').show();  
                  $('#medPrevDiv').hide();  
                  $('#admitPrevDiv').hide();
                  $('#dialysisPrevDiv').hide();
                  $('#sumCurLink').removeClass('active');
                  $('#soapCurLink').removeClass('active');
                  $('#labCurLink').removeClass('active');  
                  $('#presCurLink').addClass('active');  
                  $('#medCurLink').removeClass('active');  
                  $('#admitCurLink').removeClass('active');
                  $('#dialysisCurLink').removeClass('active');
                  $('#sumCurDiv').hide();  
                  $('#soapCurDiv').hide();  
                  $('#labCurDiv').hide();  
                  $('#presCurDiv').show();  
                  $('#medCurDiv').hide();  
                  $('#admitCurDiv').hide();
                  $('#dialysisCurDiv').hide();
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
                  $('#dialysisPrevLink').removeClass('active');
                  $('#sumPrevDiv').hide();  
                  $('#soapPrevDiv').hide();  
                  $('#labPrevDiv').hide();  
                  $('#presPrevDiv').hide();  
                  $('#medPrevDiv').show();  
                  $('#admitPrevDiv').hide();
                  $('#dialysisPrevDiv').hide();
                  $('#sumCurLink').removeClass('active');
                  $('#soapCurLink').removeClass('active');
                  $('#labCurLink').removeClass('active');  
                  $('#presCurLink').removeClass('active');  
                  $('#medCurLink').addClass('active');  
                  $('#admitCurLink').removeClass('active');
                  $('#dialysisCurLink').removeClass('active');
                  $('#sumCurDiv').hide();  
                  $('#soapCurDiv').hide();  
                  $('#labCurDiv').hide();  
                  $('#presCurDiv').hide();  
                  $('#medCurDiv').show();  
                  $('#admitCurDiv').hide();
                  $('#dialysisCurDiv').hide();
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
                  $('#dialysisPrevLink').removeClass('active');
                  $('#sumPrevDiv').hide();  
                  $('#soapPrevDiv').hide();  
                  $('#labPrevDiv').hide();  
                  $('#presPrevDiv').hide();  
                  $('#medPrevDiv').hide(); 
                  $('#admitPrevDiv').show();
                  $('#dialysisPrevDiv').hide();
                  $('#sumCurLink').removeClass('active');
                  $('#soapCurLink').removeClass('active');
                  $('#labCurLink').removeClass('active');  
                  $('#presCurLink').removeClass('active');  
                  $('#medCurLink').removeClass('active');
                  $('#admitCurLink').addClass('active'); 
                  $('#dialysisCurLink').removeClass('active');
                  $('#sumCurDiv').hide();  
                  $('#soapCurDiv').hide();  
                  $('#labCurDiv').hide();  
                  $('#presCurDiv').hide();  
                  $('#medCurDiv').hide(); 
                  $('#admitCurDiv').show(); 
                  $('#dialysisCurDiv').hide(); 
                ">Admitting Orders</a>
              </li>
              @if($datum->booking_type == 'Dialysis')
              <li class="nav-item">
                <a class="nav-link" id="dialysisCurLink" href="#" onclick="
                  $('#sumPrevLink').removeClass('active');
                  $('#soapPrevLink').removeClass('active');
                  $('#labPrevLink').removeClass('active');  
                  $('#presPrevLink').removeClass('active');  
                  $('#medPrevLink').removeClass('active');
                  $('#admitPrevLink').removeClass('active');
                  $('#dialysisPrevLink').addClass('active');
                  $('#sumPrevDiv').hide();  
                  $('#soapPrevDiv').hide();  
                  $('#labPrevDiv').hide();  
                  $('#presPrevDiv').hide();  
                  $('#medPrevDiv').hide(); 
                  $('#admitPrevDiv').hide();  
                  $('#dialysisPrevDiv').show();  
                  $('#sumCurLink').removeClass('active');
                  $('#soapCurLink').removeClass('active');
                  $('#labCurLink').removeClass('active');  
                  $('#presCurLink').removeClass('active');  
                  $('#medCurLink').removeClass('active');
                  $('#admitCurLink').removeClass('active');
                  $('#dialysisCurLink').addClass('active'); 
                  $('#sumCurDiv').hide();  
                  $('#soapCurDiv').hide();  
                  $('#labCurDiv').hide();  
                  $('#presCurDiv').hide();  
                  $('#medCurDiv').hide(); 
                  $('#admitCurDiv').hide();  
                  $('#dialysisCurDiv').show();  
                ">Dialysis Chart</a>
              </li>
              @endif
            </ul>
            <div id="curDiv" class="card-body table-responsive p-0" style="max-height: 600px">
              <div id="sumCurDiv" class="container border border-1 mb-3 p-3">
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
                <div class="card mb-3">
                  <div class="card-header">Remarks</div>
                  <div class="card-body" style="height: 1in; max-height: 1in">
                    <p>{{ $datum->others }}</p>
                  </div>
                </div>
                @if(stristr($datum->doctor->specialty, 'Ophtha') && $datum->booking_type != "Dialysis")
                <div class="card mb-3">
                  <div class="card-header">Eye Examination Information</div>
                  <div class="card-body">
                    {{-- <p>
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
                    </p> --}}
                    <table class="table table-bordered table-striped table-hover table-sm">
                      <thead class="table-{{ $bgColor }}">
                          <tr>
                              <th>&nbsp;</th>
                              <th>OD</th>
                              <th>OS</th>
                              <th>OU</th>
                          </tr>
                      </thead>
                      <tbody id="prevEyerSum">
                        <tr>
                            <td>AR</td>
                            <td>{{ $datum->arod_sphere != 'No Target' ? ($datum->arod_sphere) . ' - ' . ($datum->arod_cylinder) . ' x ' . $datum->arod_axis : 'No Refraction Possible' }}</td>
                            <td>{{ $datum->aros_sphere != 'No Target' ? ($datum->aros_sphere) . ' - ' . ($datum->aros_cylinder) . ' x ' . $datum->aros_axis : 'No Refraction Possible' }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>UCVA</td>
                            <td>{{ $datum->vaod_den != '' ? $datum->vaod_num . ' / ' . $datum->vaod_den : $datum->vaod_num }}</td>
                            <td>{{ $datum->vaos_den != '' ? $datum->vaos_num . ' / ' . $datum->vaos_den : $datum->vaos_num }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>UCVA Present Correction</td>
                            <td>{{ $datum->vaodcor_den != '' ? $datum->vaodcor_num . ' / ' . $datum->vaodcor_den : $datum->vaodcor_num }}</td>
                            <td>{{ $datum->vaoscor_den != '' ? $datum->vaoscor_num . ' / ' . $datum->vaoscor_den : $datum->vaoscor_num }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>VA Pinhole</td>
                            <td>{{ $datum->pinod_den != '' ? $datum->pinod_num . ' / ' . $datum->pinod_den : $datum->pinod_num }}</td>
                            <td>{{ $datum->pinos_den != '' ? $datum->pinos_num . ' / ' . $datum->pinos_den : $datum->pinos_num }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>BCVA</td>
                            <td>{{ $datum->pinodcor_den != '' ? $datum->pinodcor_num . ' / ' . $datum->pinodcor_den : $datum->pinodcor_num }}</td>
                            <td>{{ $datum->pinoscor_den != '' ? $datum->pinoscor_num . ' / ' . $datum->pinoscor_den : $datum->pinoscor_num }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Jaeger</td>
                            <td>{{ $datum->jae_od }}</td>
                            <td>{{ $datum->jae_os }}</td>
                            <td>{{ $datum->jae_ou }}</td>
                        </tr>
                        <tr>
                            <td>IOP</td>
                            <td>{{ $datum->iopod }}</td>
                            <td>{{ $datum->iopos }}</td>
                            <td>&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                @endif
                <div id="{{ $viewFolder }}_SUMM_{{ $datum->id }}" class="docNotesDiv">
                  <div class="card mb-3">
                    <div class="card-header">Doctor's Notes</div>
                    <div class="card-body table-responsive" style="height:300px; max-height: 300px">
                      <p>
                        <strong>History of Present Illness:</strong><div class="m-3">{!! isset($datum->docNotesHPI) ? nl2br($datum->docNotesHPI) : '' !!}</div><br>
                        <strong>Subjective Complaints:</strong><br><div class="m-3">{!! isset($datum->docNotesSubject) ? nl2br($datum->docNotesSubject) : '' !!}</div><br>
                        <strong>Objective Findings:</strong><br><div class="m-3">{!! isset($datum->docNotes) ? nl2br($datum->docNotes) : '' !!}</div><br>
                      </p>
                    </div>
                  </div>
                  <div class="card mb-3">
                    <div class="card-header">Assessment</div>
                    <div class="card-body table-responsive" style="height:300px; max-height: 300px">
                      <p>
                        <strong>Primary Diagnosis:</strong> {!! isset($datum->icd_code_obj) ? $datum->icd_code_obj->icd_code . ' - ' . $datum->icd_code_obj->details : '' !!}<br>
                        <strong>Secondary Diagnosis:</strong><br><div class="m-3">{!! isset($datum->assessment) ? nl2br($datum->assessment) : '' !!}</div><br>
                      </p>
                    </div>
                  </div>
                  <div class="card mb-3">
                    <div class="card-header">Plan</div>
                    <div class="card-body table-responsive" style="height:300px; max-height: 300px">
                      <p>
                        <strong>Medical Therapeutics:</strong><br><div class="m-3">{!! isset($datum->planMed) ? nl2br($datum->planMed) : '' !!}</div><br>
                        <strong>Diagnostics and Surgery:</strong><br><div class="m-3">{!! isset($datum->plan) ? nl2br($datum->plan) : '' !!}</div><br>
                        <strong>Remarks:</strong><br><div class="m-3">{!! isset($datum->planRem) ? nl2br($datum->planRem) : '' !!}</div><br>
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
                        <strong>History of Present Illness:</strong><div class="m-3">{!! isset($cr->docNotesHPI) ? nl2br($cr->docNotesHPI) : '' !!}</div><br>
                        <strong>Subjective Complaints:</strong><br><div class="m-3">{!! isset($cr->docNotesSubject) ? nl2br($cr->docNotesSubject) : '' !!}</div><br>
                        <strong>Objective Findings:</strong><br><div class="m-3">{!! isset($cr->docNotes) ? nl2br($cr->docNotes) : '' !!}</div><br>
                      </p>
                    </div>
                  </div>
                  <div class="card mb-3">
                    <div class="card-header">Assessment</div>
                    <div class="card-body table-responsive" style="height:300px; max-height: 300px">
                      <p>
                        <strong>Primary Diagnosis:</strong> {!! isset($cr->icd_code_obj) ? $cr->icd_code_obj->icd_code . ' - ' . $cr->icd_code_obj->details : '' !!}<br>
                        <strong>Secondary Diagnosis:</strong><br><div class="m-3">{!! isset($cr->assessment) ? nl2br($cr->assessment) : '' !!}</div><br>
                      </p>
                    </div>
                  </div>
                  <div class="card mb-3">
                    <div class="card-header">Plan</div>
                    <div class="card-body table-responsive" style="height:300px; max-height: 300px">
                      <p>
                        <strong>Medical Therapeutics:</strong><br><div class="m-3">{!! isset($cr->planMed) ? nl2br($cr->planMed) : '' !!}</div><br>
                        <strong>Diagnostics and Surgery:</strong><br><div class="m-3">{!! isset($cr->plan) ? nl2br($cr->plan) : '' !!}</div><br>
                        <strong>Remarks:</strong><br><div class="m-3">{!! isset($cr->planRem) ? nl2br($cr->planRem) : '' !!}</div><br>
                      </p>
                    </div>
                  </div>
                </div>
                  @endforeach
                @endif
              </div>
              <div id="soapCurDiv" style="display:none" class="container border border-1 mb-3 p-3">
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
                <div class="card mb-3">
                  <div class="card-header">Remarks</div>
                  <div class="card-body" style="height: 1in; max-height: 1in">
                    <p>{{ $datum->others }}</p>
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
                          @if(stristr($datum->doctor->specialty, 'Ophtha') && $datum->booking_type != "Dialysis")
                          <div class="card mb-3">
                            <div class="card-header">Eye Examination Information</div>
                            <div class="card-body">
                              {{-- <p>
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
                              </p> --}}
                              <table class="table table-bordered table-striped table-hover table-sm">
                                <thead class="table-{{ $bgColor }}">
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>OD</th>
                                        <th>OS</th>
                                        <th>OU</th>
                                    </tr>
                                </thead>
                                <tbody id="prevEyerSum">
                                  <tr>
                                      <td>AR</td>
                                      <td>{{ $datum->arod_sphere != 'No Target' ? ($datum->arod_sphere) . ' - ' . ($datum->arod_cylinder) . ' x ' . $datum->arod_axis : 'No Refraction Possible' }}</td>
                                      <td>{{ $datum->aros_sphere != 'No Target' ? ($datum->aros_sphere) . ' - ' . ($datum->aros_cylinder) . ' x ' . $datum->aros_axis : 'No Refraction Possible' }}</td>
                                      <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td>UCVA</td>
                                      <td>{{ $datum->vaod_den != '' ? $datum->vaod_num . ' / ' . $datum->vaod_den : $datum->vaod_num }}</td>
                                      <td>{{ $datum->vaos_den != '' ? $datum->vaos_num . ' / ' . $datum->vaos_den : $datum->vaos_num }}</td>
                                      <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td>UCVA Present Correction</td>
                                      <td>{{ $datum->vaodcor_den != '' ? $datum->vaodcor_num . ' / ' . $datum->vaodcor_den : $datum->vaodcor_num }}</td>
                                      <td>{{ $datum->vaoscor_den != '' ? $datum->vaoscor_num . ' / ' . $datum->vaoscor_den : $datum->vaoscor_num }}</td>
                                      <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td>VA Pinhole</td>
                                      <td>{{ $datum->pinod_den != '' ? $datum->pinod_num . ' / ' . $datum->pinod_den : $datum->pinod_num }}</td>
                                      <td>{{ $datum->pinos_den != '' ? $datum->pinos_num . ' / ' . $datum->pinos_den : $datum->pinos_num }}</td>
                                      <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td>BCVA</td>
                                      <td>{{ $datum->pinodcor_den != '' ? $datum->pinodcor_num . ' / ' . $datum->pinodcor_den : $datum->pinodcor_num }}</td>
                                      <td>{{ $datum->pinoscor_den != '' ? $datum->pinoscor_num . ' / ' . $datum->pinoscor_den : $datum->pinoscor_num }}</td>
                                      <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td>Jaeger</td>
                                      <td>{{ $datum->jae_od }}</td>
                                      <td>{{ $datum->jae_os }}</td>
                                      <td>{{ $datum->jae_ou }}</td>
                                  </tr>
                                  <tr>
                                      <td>IOP</td>
                                      <td>{{ $datum->iopod }}</td>
                                      <td>{{ $datum->iopos }}</td>
                                      <td>&nbsp;</td>
                                  </tr>
                                </tbody>
                              </table>
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
                          @if(stristr($datum->doctor->specialty, 'Ophtha') && $datum->booking_type != "Dialysis")
                          <div class="card mb-3">
                            <div class="card-header">Eye Examination Information</div>
                            <div class="card-body">
                              {{-- <p>
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
                              </p> --}}
                              <table class="table table-bordered table-striped table-hover table-sm">
                                <thead class="table-{{ $bgColor }}">
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>OD</th>
                                        <th>OS</th>
                                        <th>OU</th>
                                    </tr>
                                </thead>
                                <tbody id="prevEyerSum">
                                  <tr>
                                      <td>AR</td>
                                      <td>{{ $datum->arod_sphere != 'No Target' ? ($datum->arod_sphere) . ' - ' . ($datum->arod_cylinder) . ' x ' . $datum->arod_axis : 'No Refraction Possible' }}</td>
                                      <td>{{ $datum->aros_sphere != 'No Target' ? ($datum->aros_sphere) . ' - ' . ($datum->aros_cylinder) . ' x ' . $datum->aros_axis : 'No Refraction Possible' }}</td>
                                      <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td>UCVA</td>
                                      <td>{{ $datum->vaod_den != '' ? $datum->vaod_num . ' / ' . $datum->vaod_den : $datum->vaod_num }}</td>
                                      <td>{{ $datum->vaos_den != '' ? $datum->vaos_num . ' / ' . $datum->vaos_den : $datum->vaos_num }}</td>
                                      <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td>UCVA Present Correction</td>
                                      <td>{{ $datum->vaodcor_den != '' ? $datum->vaodcor_num . ' / ' . $datum->vaodcor_den : $datum->vaodcor_num }}</td>
                                      <td>{{ $datum->vaoscor_den != '' ? $datum->vaoscor_num . ' / ' . $datum->vaoscor_den : $datum->vaoscor_num }}</td>
                                      <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td>VA Pinhole</td>
                                      <td>{{ $datum->pinod_den != '' ? $datum->pinod_num . ' / ' . $datum->pinod_den : $datum->pinod_num }}</td>
                                      <td>{{ $datum->pinos_den != '' ? $datum->pinos_num . ' / ' . $datum->pinos_den : $datum->pinos_num }}</td>
                                      <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td>BCVA</td>
                                      <td>{{ $datum->pinodcor_den != '' ? $datum->pinodcor_num . ' / ' . $datum->pinodcor_den : $datum->pinodcor_num }}</td>
                                      <td>{{ $datum->pinoscor_den != '' ? $datum->pinoscor_num . ' / ' . $datum->pinoscor_den : $datum->pinoscor_num }}</td>
                                      <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td>Jaeger</td>
                                      <td>{{ $datum->jae_od }}</td>
                                      <td>{{ $datum->jae_os }}</td>
                                      <td>{{ $datum->jae_ou }}</td>
                                  </tr>
                                  <tr>
                                      <td>IOP</td>
                                      <td>{{ $datum->iopod }}</td>
                                      <td>{{ $datum->iopos }}</td>
                                      <td>&nbsp;</td>
                                  </tr>
                                </tbody>
                              </table>
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
              <div id="labCurDiv" style="display:none" class="container border border-1 mb-3 p-3">
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
                <div class="row overflow-auto" id="image_preview_saved" style="max-height:100px">
                  
                </div>
                <div class="container horizontal-scrollable" style="overflow-x: auto; white-space: nowrap;">
                  <div class="row flex-nowrap" id="image_preview" style="max-height:200px">
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
              </div>
              {{-- @if($user->id == $datum->doctor->id) --}}
              <div id="presCurDiv" style="display:none" class="container border border-1 mb-3 p-3">
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
              <div id="medCurDiv" style="display:none" class="container border border-1 mb-3 p-3">
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
              <div id="admitCurDiv" style="display:none" class="container border border-1 mb-3 p-3">
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
              <div id="dialysisCurDiv" style="display:none" class="container border border-1 mb-3 p-3">
                @if(isset($datum->booking_type) && $datum->booking_type == 'Dialysis')
                <div class="row">
                  <div class="col-lg-4">
                    <div class="input-group mb-3">
                      <div class="form-floating">
                        <input class="form-control" type="text" name="{{ $viewFolder }}[id]" id="{{ $viewFolder }}_id" value="{{ isset($datum->id) ? $datum->id : '' }}" placeholder="" {{ !isset($referal_conso)  ? 'readonly' : 'disabled' }}>
                        <label for="{{ $viewFolder }}_id" class="form-label">Treatment Number</label>
                        <small id="help_{{ $viewFolder }}_id" class="text-muted"></small>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="input-group mb-3">
                      <div class="form-floating">
                        <input class="form-control" type="time" name="{{ $viewFolder }}[time_started]" id="{{ $viewFolder }}_time_started" value="{{ isset($datum->time_started) ? $datum->time_started : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                        <label for="{{ $viewFolder }}_time_started" class="form-label">Time Started</label>
                        <small id="help_{{ $viewFolder }}_time_started" class="text-muted"></small>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="input-group mb-3">
                      <div class="form-floating">
                        <input class="form-control" type="time" name="{{ $viewFolder }}[time_ended]" id="{{ $viewFolder }}_time_ended" value="{{ isset($datum->time_ended) ? $datum->time_ended : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
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
                            <input class="form-control" type="text" name="{{ $viewFolder }}[machine_number]" id="{{ $viewFolder }}_machine_number" value="{{ isset($datum->machine_number) ? $datum->machine_number : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_machine_number" class="form-label">Machine Number</label>
                            <small id="help_{{ $viewFolder }}_machine_number" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[dialyzer]" id="{{ $viewFolder }}_dialyzer" value="{{ isset($datum->dialyzer) ? $datum->dialyzer : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_dialyzer" class="form-label">Dialyzer</label>
                            <small id="help_{{ $viewFolder }}_dialyzer" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" step=1 min=0 name="{{ $viewFolder }}[mac_use]" id="{{ $viewFolder }}_use" value="{{ isset($datum->mac_use) ? $datum->mac_use : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_use" class="form-label">Use</label>
                            <small id="help_{{ $viewFolder }}_use" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[acid]" id="{{ $viewFolder }}_acid" value="{{ isset($datum->acid) ? $datum->acid : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
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
                            <input class="form-control" type="text" name="{{ $viewFolder }}[mac_add]" id="{{ $viewFolder }}_add" value="{{ isset($datum->mac_add) ? $datum->mac_add : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_add" class="form-label">Add</label>
                            <small id="help_{{ $viewFolder }}_add" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[bfr]" id="{{ $viewFolder }}_bfr" value="{{ isset($datum->bfr) ? $datum->bfr : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_bfr" class="form-label">BRF</label>
                            <small id="help_{{ $viewFolder }}_bfr" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[dfr]" id="{{ $viewFolder }}_dfr" value="{{ isset($datum->dfr) ? $datum->dfr : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_dfr" class="form-label">DFR</label>
                            <small id="help_{{ $viewFolder }}_dfr" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[setup_prime]" id="{{ $viewFolder }}_setup_prime" value="{{ isset($datum->setup_prime) ? $datum->setup_prime : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
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
                            <textarea class="form-control" name="{{ $viewFolder }}[safety_check]" id="{{ $viewFolder }}_safety_check" rows=3 {{ !isset($referal_conso)  ? '' : 'disabled' }}>{{ isset($datum->safety_check) ? $datum->safety_check : ''}}</textarea>
                            <label for="{{ $viewFolder }}_safety_check" class="form-label">Safety Check</label>
                            <small id="help_{{ $viewFolder }}_safety_check" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <textarea class="form-control" name="{{ $viewFolder }}[residual_test]" id="{{ $viewFolder }}_residual_test" rows=3 {{ !isset($referal_conso)  ? '' : 'disabled' }}>{{ isset($datum->residual_test) ? $datum->residual_test : ''}}</textarea>
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
                            <input class="form-control" type="text" name="{{ $viewFolder }}[dry_weight]" id="{{ $viewFolder }}_dry_weight" value="{{ isset($datum->dry_weight) ? $datum->dry_weight : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_dry_weight" class="form-label">Estimate Dry Weight</label>
                            <small id="help_{{ $viewFolder }}_dry_weight" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">kg</span>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[prev_post_hd_weight]" min=1 step=.1 id="{{ $viewFolder }}_prev_post_hd_weight" value="{{ isset($datum->prev_post_hd_weight) ? $datum->prev_post_hd_weight : ''}}" placeholder=""  {{ !isset($referal_conso)  ? '' : 'disabled' }}>
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
                            <input class="form-control" type="number" name="{{ $viewFolder }}[weight]" min=1 step=.1 id="{{ $viewFolder }}_pre_hd_weight" value="{{ isset($datum->weight) ? $datum->weight : ''}}" placeholder="" onchange="
                              if($('#{{ $viewFolder }}_pre_hd_weight').val() != '' &&  $('#{{ $viewFolder }}_post_hd_weight').val() != ''){
                                $('#{{ $viewFolder }}_weight_loss').val($('#{{ $viewFolder }}_pre_hd_weight').val() - $('#{{ $viewFolder }}_post_hd_weight').val());
                              }
                            " {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_pre_hd_weight" class="form-label">Pre HD Weight</label>
                            <small id="help_{{ $viewFolder }}_pre_hd_weight" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">kg</span>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[post_weight]" min=1 step=.1 id="{{ $viewFolder }}_post_hd_weight" value="{{ isset($datum->post_weight) ? $datum->post_weight : ''}}" placeholder="" onchange="
                              if($('#{{ $viewFolder }}_pre_hd_weight').val() != '' &&  $('#{{ $viewFolder }}_post_hd_weight').val() != ''){
                                $('#{{ $viewFolder }}_weight_loss').val($('#{{ $viewFolder }}_pre_hd_weight').val() - $('#{{ $viewFolder }}_post_hd_weight').val());
                              }
                            " {{ !isset($referal_conso)  ? '' : 'disabled' }}>
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
                            <input class="form-control" type="text" name="{{ $viewFolder }}[ktv]" id="{{ $viewFolder }}_ktv" value="{{ isset($datum->ktv) ? $datum->ktv : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
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
                            <input class="form-control" type="text" name="{{ $viewFolder }}[net_uf]" id="{{ $viewFolder }}_net_uf" value="{{ isset($datum->net_uf) ? $datum->net_uf : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_net_uf" class="form-label">Net UF</label>
                            <small id="help_{{ $viewFolder }}_net_uf" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[hd_duration]" min=1 step=.1 id="{{ $viewFolder }}_hd_duration" value="{{ isset($datum->hd_duration) ? $datum->hd_duration : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_hd_duration" class="form-label">Duration</label>
                            <small id="help_{{ $viewFolder }}_hd_duration" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">hr/s</span>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[frequency]" min=1 step=.1 id="{{ $viewFolder }}_frequency" value="{{ isset($datum->frequency) ? $datum->frequency : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
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
                            <input class="form-control" type="text" name="{{ $viewFolder }}[prime]" id="{{ $viewFolder }}_prime" value="{{ isset($datum->prime) ? $datum->prime : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_prime" class="form-label">Prime/Rinse</label>
                            <small id="help_{{ $viewFolder }}_prime" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[other_fluids]" id="{{ $viewFolder }}_other_fluids" value="{{ isset($datum->other_fluids) ? $datum->other_fluids : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_other_fluids" class="form-label">Other Fluids</label>
                            <small id="help_{{ $viewFolder }}_other_fluids" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[total_uf_goal]" id="{{ $viewFolder }}_total_uf_goal" value="{{ isset($datum->total_uf_goal) ? $datum->total_uf_goal : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_total_uf_goal" class="form-label">Total UF Goal</label>
                            <small id="help_{{ $viewFolder }}_total_uf_goal" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[weight_loss]" min=0 step=.1 id="{{ $viewFolder }}_weight_loss" value="{{ isset($datum->weight_loss) ? $datum->weight_loss : ''}}" placeholder=""  {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_weight_loss" class="form-label">Weight Loss</label>
                            <small id="help_{{ $viewFolder }}_weight_loss" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">kg</span>
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
                            <input class="form-control" type="text" name="{{ $viewFolder }}[brand]" id="{{ $viewFolder }}_brand" value="{{ isset($datum->brand) ? $datum->brand : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_brand" class="form-label">Brand Name</label>
                            <small id="help_{{ $viewFolder }}_brand" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[dose]" id="{{ $viewFolder }}_dose" value="{{ isset($datum->dose) ? $datum->dose : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_dose" class="form-label">Dose</label>
                            <small id="help_{{ $viewFolder }}_dose" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[regular_dose]" id="{{ $viewFolder }}_regular_dose" value="{{ isset($datum->regular_dose) ? $datum->regular_dose : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
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
                            <input class="form-control" type="text" name="{{ $viewFolder }}[low_dose]" id="{{ $viewFolder }}_low_dose" value="{{ isset($datum->low_dose) ? $datum->low_dose : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_low_dose" class="form-label">Low Dose</label>
                            <small id="help_{{ $viewFolder }}_low_dose" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[lmwh]" id="{{ $viewFolder }}_lmwh" value="{{ isset($datum->lmwh) ? $datum->lmwh : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_lmwh" class="form-label">LMWH</label>
                            <small id="help_{{ $viewFolder }}_lmwh" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="text" name="{{ $viewFolder }}[flushing]" id="{{ $viewFolder }}_flushing" value="{{ isset($datum->flushing) ? $datum->flushing : ''}}" placeholder="" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
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
                  <div class="col-lg-{{ stristr($doctor->specialty, 'Ophtha') && (isset($datum->booking_type) && $datum->booking_type != 'Dialysis') ? 4 : (isset($datum->booking_type) && $datum->booking_type == 'Dialysis' ? 6 : 12) }}">
                    <div class="card mb-3">
                      <div class="card-header">{{ isset($datum->booking_type) && $datum->booking_type == 'Dialysis' ? 'Pre-HD ' : '' }}Vitals</div>
                      <div class="card-body">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[temp]" min=30 step=.1 id="{{ $viewFolder }}_temp" value="{{ isset($datum->temp) ? $datum->temp : ''}}" placeholder="" {{ isset($datum->id) ? '' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_temp" class="form-label">Temperature</label>
                            <small id="help_{{ $viewFolder }}_temp" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">C</span>
                        </div>
                        @if(isset($datum->booking_type) && $datum->booking_type != 'Dialysis')
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[height]" min=1 step=.1 id="{{ $viewFolder }}_height" value="{{ isset($datum->height) ? $datum->height : '' }}" placeholder="" {{ isset($datum->id) ? '' : '' }} onblur="
                                if($(this).val() != '' && $('#{{ $viewFolder }}_weight').val() != ''){
                                  $('#{{ $viewFolder }}_bmi').val($('#{{ $viewFolder }}_weight').val()/(($(this).val()/100)*($(this).val()/100)));
                                }else{
                                  $('#{{ $viewFolder }}_bmi').val('');
                                }
                              " {{ !isset($referal_conso)  ? '' : 'disabled' }}>
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
                            " {{ !isset($referal_conso)  ? '' : 'disabled' }}>
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
                        @endif
                        <label for="{{ $viewFolder }}_bpS" class="form-label">BP</label>
                        <div class="input-group mb-3">
                          <input class="form-control" type="number" name="{{ $viewFolder }}[bpS]" min=50 max=250 step=1 id="{{ $viewFolder }}_bpS" value="{{ isset($datum->bpS) ? $datum->bpS : '' }}" placeholder="Systolic" {{ isset($datum->id) ? '' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                          <span class="input-group-text">/</span>
                          <input class="form-control" type="number" name="{{ $viewFolder }}[bpD]" min=30 max=150 step=1 id="{{ $viewFolder }}_bpD" value="{{ isset($datum->bpD) ? $datum->bpD : '' }}" placeholder="Diastolic" {{ isset($datum->id) ? '' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                        </div>
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[o2]" min=1 id="{{ $viewFolder }}_o2" value="{{ isset($datum->o2) ? $datum->o2 : '' }}" placeholder="" {{ isset($datum->id) ? '' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_o2" class="form-label">O2 Sat</label>
                            <small id="help_{{ $viewFolder }}_o2" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">%</span>
                        </div>
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[heart]" min=1 id="{{ $viewFolder }}_heart" value="{{ isset($datum->heart) ? $datum->heart : '' }}" placeholder="" {{ isset($datum->id) ? '' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_heart" class="form-label">Heart/Pulse Rate</label>
                            <small id="help_{{ $viewFolder }}_heart" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">BPM</span>
                        </div>
                        @if(isset($datum->booking_type) && $datum->booking_type == 'Dialysis')
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[resp]" min=1 id="{{ $viewFolder }}_resp" value="{{ isset($datum->resp) ? $datum->resp : '' }}" placeholder="" {{ isset($datum->id) ? '' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_resp" class="form-label">Resp</label>
                            <small id="help_{{ $viewFolder }}_resp" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">CPM</span>
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
                  @if(isset($datum->booking_type) && $datum->booking_type == 'Dialysis')
                  <div class="col-lg-6">
                    <div class="card mb-3">
                      <div class="card-header">Post-HD Vitals</div>
                      <div class="card-body">
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[post_temp]" min=30 step=.1 id="{{ $viewFolder }}_post_temp" value="{{ isset($datum->post_temp) ? $datum->post_temp : ''}}" placeholder="" {{ isset($datum->id) ? '' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_post_temp" class="form-label">Temperature</label>
                            <small id="help_{{ $viewFolder }}_post_temp" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">C</span>
                        </div>
                        @if(isset($datum->booking_type) && $datum->booking_type != 'Dialysis')
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[post_height]" min=1 step=.1 id="{{ $viewFolder }}_post_height" value="{{ isset($datum->post_height) ? $datum->post_height : '' }}" placeholder="" {{ isset($datum->id) ? '' : '' }} onblur="
                                if($(this).val() != '' && $('#{{ $viewFolder }}_post_weight').val() != ''){
                                  $('#{{ $viewFolder }}_post_bmi').val($('#{{ $viewFolder }}_post_weight').val()/(($(this).val()/100)*($(this).val()/100)));
                                }else{
                                  $('#{{ $viewFolder }}_post_bmi').val('');
                                }
                              " {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_post_height" class="form-label">Height</label>
                            <small id="help_{{ $viewFolder }}_post_height" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">cm</span>
                        </div>
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[post_weight]" min=1 step=.1 id="{{ $viewFolder }}_post_weight" value="{{ isset($datum->post_weight) ? $datum->post_weight : '' }}" placeholder="" {{ isset($datum->id) ? '' : '' }} onblur="
                              if($(this).val() != '' && $('#{{ $viewFolder }}_post_height').val() != ''){
                                $('#{{ $viewFolder }}_post_bmi').val($(this).val()/(($('#{{ $viewFolder }}_post_height').val()/100)*($('#{{ $viewFolder }}_post_height').val()/100)));
                              }else{
                                $('#{{ $viewFolder }}_post_bmi').val('');
                              }
                            " {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_post_weight" class="form-label">Weight</label>
                            <small id="help_{{ $viewFolder }}_post_weight" class="text-muted"></small>
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
                            <input class="form-control" type="number" name="{{ $viewFolder }}[post_bmi]" min=1 id="{{ $viewFolder }}_post_bmi" value="{{ !empty($datum->post_height) ? (int)$datum->post_weight/(((int)$datum->post_height/100)*((int)$datum->post_height/100)) : '' }}" placeholder="" disabled>
                            <label for="{{ $viewFolder }}_post_bmi" class="form-label">BMI</label>
                            <small id="help_{{ $viewFolder }}_post_bmi" class="text-muted"></small>
                          </div>
                        </div>
                        @endif
                        <label for="{{ $viewFolder }}_bpS" class="form-label">BP</label>
                        <div class="input-group mb-3">
                          <input class="form-control" type="number" name="{{ $viewFolder }}[post_bpS]" min=50 max=250 step=1 id="{{ $viewFolder }}_post_bpS" value="{{ isset($datum->post_bpS) ? $datum->post_bpS : '' }}" placeholder="Systolic" {{ isset($datum->id) ? '' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                          <span class="input-group-text">/</span>
                          <input class="form-control" type="number" name="{{ $viewFolder }}[post_bpD]" min=30 max=150 step=1 id="{{ $viewFolder }}_post_bpD" value="{{ isset($datum->post_bpD) ? $datum->post_bpD : '' }}" placeholder="Diastolic" {{ isset($datum->id) ? '' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                        </div>
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[post_o2]" min=1 id="{{ $viewFolder }}_post_o2" value="{{ isset($datum->post_o2) ? $datum->post_o2 : '' }}" placeholder="" {{ isset($datum->id) ? '' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_post_o2" class="form-label">O2 Sat</label>
                            <small id="help_{{ $viewFolder }}_post_o2" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">%</span>
                        </div>
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[post_heart]" min=1 id="{{ $viewFolder }}_post_heart" value="{{ isset($datum->post_heart) ? $datum->post_heart : '' }}" placeholder="" {{ isset($datum->id) ? '' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_post_heart" class="form-label">Heart/Pulse Rate</label>
                            <small id="help_{{ $viewFolder }}_post_heart" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">BPM</span>
                        </div>
                        <div class="input-group mb-3">
                          <div class="form-floating">
                            <input class="form-control" type="number" name="{{ $viewFolder }}[post_resp]" min=1 id="{{ $viewFolder }}_post_resp" value="{{ isset($datum->post_resp) ? $datum->post_resp : '' }}" placeholder="" {{ isset($datum->id) ? '' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label for="{{ $viewFolder }}_post_resp" class="form-label">Resp</label>
                            <small id="help_{{ $viewFolder }}_post_resp" class="text-muted"></small>
                          </div>
                          <span class="input-group-text">CPM</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                  
                </div>
                @if(isset($datum->booking_type) && $datum->booking_type == 'Dialysis')
                
                <div class="row">
                  <div class="col-lg-6">
                    <div class="card mb-3">
                      <div class="card-header">Pre-HD Assessment</div>
                      <div class="card-body">
                        <label>Mental Status</label>
                        <div class="container ml-5 mb-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[mental_status][]" value="awake" id="{{ $viewFolder }}_mental_status_awake" {{ (isset($datum->mental_status) && is_array(json_decode($datum->mental_status)) && in_array('awake', json_decode($datum->mental_status))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_mental_status_awake">awake</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[mental_status][]" value="oriented" id="{{ $viewFolder }}_mental_status_oriented" {{ (isset($datum->mental_status) && is_array(json_decode($datum->mental_status)) && in_array('oriented', json_decode($datum->mental_status))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_mental_status_oriented">oriented</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[mental_status][]" value="drowsy" id="{{ $viewFolder }}_mental_status_drowsy" {{ (isset($datum->mental_status) && is_array(json_decode($datum->mental_status)) && in_array('drowsy', json_decode($datum->mental_status))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_mental_status_drowsy">drowsy</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[mental_status][]" value="disoriented" id="{{ $viewFolder }}_mental_status_disoriented" {{ (isset($datum->mental_status) && is_array(json_decode($datum->mental_status)) && in_array('disoriented', json_decode($datum->mental_status))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_mental_status_disoriented">disoriented</label>
                          </div>
                        </div>
                        <label>Ambulation Status</label>
                        <div class="container ml-5 mb-3">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $viewFolder }}[ambulation_status]" value="ambulatory" id="{{ $viewFolder }}_ambulation_status_ambulatory" {{ (isset($datum->ambulation_status) && $datum->ambulation_status == 'ambulatory') ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_ambulation_status_ambulatory">ambulatory</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $viewFolder }}[ambulation_status]" value="w/ assistance" id="{{ $viewFolder }}_ambulation_status_assistance" {{ (isset($datum->ambulation_status) && $datum->ambulation_status == 'w/ assistance') ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_ambulation_status_assistance">w/ assistance</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $viewFolder }}[ambulation_status]" value="wheelchair" id="{{ $viewFolder }}_ambulation_status_wheelchair" {{ (isset($datum->ambulation_status) && $datum->ambulation_status == 'wheelchair') ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_ambulation_status_wheelchair">wheelchair</label>
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
                              " {{ (isset($datum->subjective_complaints) && $datum->ambulation_status == 'none') ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
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
                              "  {{ (isset($datum->subjective_complaints) && $datum->subjective_complaints == 'yes') ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_subjective_complaints_yes">yes</label>
                          </div>
                          <textarea class="form-control" name="{{ $viewFolder }}[subjective_complaints_text]" id="{{ $viewFolder }}_subjective_complaints_text" rows=3 {{ (isset($datum->subjective_complaints) && $datum->subjective_complaints == 'yes') ? '' : 'disabled' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>{{ isset($datum->subjective_complaints_text) ? $datum->subjective_complaints_text : '' }}</textarea>
                        </div>
                        <label>Significant PE Findings</label>
                        <div class="container ml-5 mb-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Pallor" id="{{ $viewFolder }}_pe_findings_pallor" {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Pallor', json_decode($datum->pe_findings))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_pe_findings_pallor">Pallor</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Distended Neck Vein" id="{{ $viewFolder }}_pe_findings_neck_vein" {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Distended Neck Vein', json_decode($datum->pe_findings))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_pe_findings_neck_vein">Distended Neck Vein</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Abnormal Rhythm/Rate" id="{{ $viewFolder }}_pe_findings_rhythm" {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Abnormal Rhythm/Rate', json_decode($datum->pe_findings))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_pe_findings_rhythm">Abnormal Rhythm/Rate</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Rales" id="{{ $viewFolder }}_pe_findings_rales" {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Rales', json_decode($datum->pe_findings))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_pe_findings_rales">Rales</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Wheezing" id="{{ $viewFolder }}_pe_findings_wheezing" {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Wheezing', json_decode($datum->pe_findings))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_pe_findings_wheezing">Wheezing</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Decreased Breath Sounds" id="{{ $viewFolder }}_pe_findings_breath_sounds" {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Decreased Breath Sounds', json_decode($datum->pe_findings))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
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
                              " {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Ascites - Abdominal Girth', json_decode($datum->pe_findings))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_pe_findings_ascites">Ascites - Abdominal Girth:</label>
                          </div>
                          <textarea class="form-control" name="{{ $viewFolder }}[pe_findings_ascites_text]" id="{{ $viewFolder }}_pe_findings_ascites_text" rows=3 {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Ascites - Abdominal Girth', json_decode($datum->pe_findings))) ? '' : 'disabled' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>{{ isset($datum->pe_findings_ascites_text) ? $datum->pe_findings_ascites_text : '' }}</textarea>
                          {{-- <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Decreased Breath Sounds" id="{{ $viewFolder }}_pe_findings_breath_sounds">
                            <label class="form-check-label" for="{{ $viewFolder }}_pe_findings_breath_sounds">Decreased Breath Sounds</label>
                          </div> --}}
                          
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
                              " {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Edema Grade', json_decode($datum->pe_findings))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_pe_findings_edema">Edema Grade:</label>
                          </div>
                          <textarea class="form-control" name="{{ $viewFolder }}[pe_findings_edema_text]" id="{{ $viewFolder }}_pe_findings_edema_text" rows=3 {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Edema Grade', json_decode($datum->pe_findings))) ? '' : 'disabled' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>{{ isset($datum->pe_findings_edema_text) ? $datum->pe_findings_edema_text : '' }}</textarea>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[pe_findings][]" value="Bleeding" id="{{ $viewFolder }}_pe_findings_bleeding" {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Bleeding', json_decode($datum->pe_findings))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
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
                              " {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Others', json_decode($datum->pe_findings))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_pe_findings_others">Others:</label>
                          </div>
                          <textarea class="form-control" name="{{ $viewFolder }}[pe_findings_others_text]" id="{{ $viewFolder }}_pe_findings_others_text" rows=3 {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Others', json_decode($datum->pe_findings))) ? '' : 'disabled' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>{{ isset($datum->pe_findings_others_text) ? $datum->pe_findings_others_text : '' }}</textarea>
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
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_mental_status][]" value="awake" id="{{ $viewFolder }}_post_mental_status_awake" {{ (isset($datum->post_mental_status) && is_array(json_decode($datum->post_mental_status)) && in_array('awake', json_decode($datum->post_mental_status))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_post_mental_status_awake">awake</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_mental_status][]" value="oriented" id="{{ $viewFolder }}_post_mental_status_oriented" {{ (isset($datum->post_mental_status) && is_array(json_decode($datum->post_mental_status)) && in_array('oriented', json_decode($datum->post_mental_status))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_post_mental_status_oriented">oriented</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_mental_status][]" value="drowsy" id="{{ $viewFolder }}_post_mental_status_drowsy" {{ (isset($datum->post_mental_status) && is_array(json_decode($datum->post_mental_status)) && in_array('drowsy', json_decode($datum->post_mental_status))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_post_mental_status_drowsy">drowsy</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_mental_status][]" value="disoriented" id="{{ $viewFolder }}_post_mental_status_disoriented" {{ (isset($datum->post_mental_status) && is_array(json_decode($datum->post_mental_status)) && in_array('disoriented', json_decode($datum->post_mental_status))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_post_mental_status_disoriented">disoriented</label>
                          </div>
                        </div>
                        <label>Ambulation Status</label>
                        <div class="container ml-5 mb-3">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $viewFolder }}[post_ambulation_status]" value="ambulatory" id="{{ $viewFolder }}_post_ambulation_status_ambulatory" {{ (isset($datum->post_ambulation_status) && $datum->post_ambulation_status == 'ambulatory') ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_post_ambulation_status_ambulatory">ambulatory</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $viewFolder }}[post_ambulation_status]" value="w/ assistance" id="{{ $viewFolder }}_post_ambulation_status_assistance" {{ (isset($datum->post_ambulation_status) && $datum->post_ambulation_status == 'w/ assistance') ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_post_ambulation_status_assistance">w/ assistance</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $viewFolder }}[post_ambulation_status]" value="wheelchair" id="{{ $viewFolder }}_post_ambulation_status_wheelchair" {{ (isset($datum->post_ambulation_status) && $datum->post_ambulation_status == 'wheelchair') ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_post_ambulation_status_wheelchair">wheelchair</label>
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
                              " {{ (isset($datum->post_subjective_complaints) && $datum->post_subjective_complaints == 'none') ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
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
                              " {{ (isset($datum->post_subjective_complaints) && $datum->post_subjective_complaints == 'yes') ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_post_subjective_complaints_yes">yes</label>
                          </div>
                          <textarea class="form-control" name="{{ $viewFolder }}[post_subjective_complaints_text]" id="{{ $viewFolder }}_post_subjective_complaints_text" rows=3 {{ (isset($datum->post_subjective_complaints) && $datum->post_subjective_complaints == 'yes') ? '' : 'disabled' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>{{ isset($datum->post_subjective_complaints_text) ? $datum->post_subjective_complaints_text : '' }}</textarea>
                        </div>
                        <label>Significant PE Findings</label>
                        <div class="container ml-5 mb-3">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Pallor" id="{{ $viewFolder }}_post_pe_findings_pallor" {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Pallor', json_decode($datum->post_pe_findings))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_post_pe_findings_pallor">Pallor</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Distended Neck Vein" id="{{ $viewFolder }}_post_pe_findings_neck_vein" {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Distended Neck Vein', json_decode($datum->post_pe_findings))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_post_pe_findings_neck_vein">Distended Neck Vein</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Abnormal Rhythm/Rate" id="{{ $viewFolder }}_post_pe_findings_rhythm" {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Abnormal Rhythm/Rate', json_decode($datum->post_pe_findings))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_post_pe_findings_rhythm">Abnormal Rhythm/Rate</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Rales" id="{{ $viewFolder }}_post_pe_findings_rales" {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Rales', json_decode($datum->post_pe_findings))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_post_pe_findings_rales">Rales</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Wheezing" id="{{ $viewFolder }}_post_pe_findings_wheezing" {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Wheezing', json_decode($datum->post_pe_findings))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_post_pe_findings_wheezing">Wheezing</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Decreased Breath Sounds" id="{{ $viewFolder }}_post_pe_findings_breath_sounds" {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Decreased Breath Sounds', json_decode($datum->post_pe_findings))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
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
                              " {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Ascites - Abdominal Girth', json_decode($datum->post_pe_findings))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_post_pe_findings_ascites">Ascites - Abdominal Girth:</label>
                          </div>
                          <textarea class="form-control" name="{{ $viewFolder }}[post_pe_findings_ascites_text]" id="{{ $viewFolder }}_post_pe_findings_ascites_text" rows=3 {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Ascites - Abdominal Girth', json_decode($datum->post_pe_findings))) ? '' : 'disabled' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>{{ isset($datum->post_pe_findings_ascites_text) ? $datum->post_pe_findings_ascites_text : '' }}</textarea>
                          {{-- <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Decreased Breath Sounds" id="{{ $viewFolder }}_post_pe_findings_breath_sounds">
                            <label class="form-check-label" for="{{ $viewFolder }}_post_pe_findings_breath_sounds">Decreased Breath Sounds</label>
                          </div> --}}
                          
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
                              " {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Edema Grade', json_decode($datum->post_pe_findings))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_post_pe_findings_edema">Edema Grade:</label>
                          </div>
                          <textarea class="form-control" name="{{ $viewFolder }}[post_pe_findings_edema_text]" id="{{ $viewFolder }}_post_pe_findings_edema_text" rows=3 {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Edema Grade', json_decode($datum->post_pe_findings))) ? '' : 'disabled' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>{{ isset($datum->post_pe_findings_edema_text) ? $datum->post_pe_findings_edema_text : '' }}</textarea>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[post_pe_findings][]" value="Bleeding" id="{{ $viewFolder }}_post_pe_findings_bleeding" {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Bleeding', json_decode($datum->post_pe_findings))) ? 'checked' : '' }}>
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
                              " {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Others', json_decode($datum->post_pe_findings))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                            <label class="form-check-label" for="{{ $viewFolder }}_post_pe_findings_others">Others:</label>
                          </div>
                          <textarea class="form-control" name="{{ $viewFolder }}[post_pe_findings_others_text]" id="{{ $viewFolder }}_post_pe_findings_others_text" rows=3 {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Others', json_decode($datum->post_pe_findings))) ? '' : 'disabled' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>{{ isset($datum->post_pe_findings_others_text) ? $datum->post_pe_findings_others_text : '' }}</textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card mb-3">
                      <div class="card-header">Vascular Access</div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-lg-4">
                            <label>Vascular Access</label>
                            <div class="container ml-5 mb-3">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="{{ $viewFolder }}[vaccess]" value="left" id="{{ $viewFolder }}_vaccess_left" {{ (isset($datum->vaccess) && $datum->vaccess == 'left') ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                                <label class="form-check-label" for="{{ $viewFolder }}_vaccess_left">left</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="{{ $viewFolder }}[vaccess]" value="right" id="{{ $viewFolder }}_vaccess_right" {{ (isset($datum->vaccess) && $datum->vaccess == 'right') ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                                <label class="form-check-label" for="{{ $viewFolder }}_vaccess_right">right</label>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-8">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[vaccess_detail][]" value="Fistula" id="{{ $viewFolder }}_fistula" {{ (isset($datum->vaccess_detail) && is_array(json_decode($datum->vaccess_detail)) && in_array('Fistula', json_decode($datum->vaccess_detail))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                              <label class="form-check-label" for="{{ $viewFolder }}_fistula">Fistula</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[vaccess_detail][]" value="Graft" id="{{ $viewFolder }}_graft" {{ (isset($datum->vaccess_detail) && is_array(json_decode($datum->vaccess_detail)) && in_array('Graft', json_decode($datum->vaccess_detail))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                              <label class="form-check-label" for="{{ $viewFolder }}_graft">Graft</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[vaccess_detail][]" value="CVC" id="{{ $viewFolder }}_cvc" {{ (isset($datum->vaccess_detail) && is_array(json_decode($datum->vaccess_detail)) && in_array('CVC', json_decode($datum->vaccess_detail))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                              <label class="form-check-label" for="{{ $viewFolder }}_cvc">CVC / PERM / others</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="card mb-3">
                      <div class="card-header">AV Fistula</div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[av_fistula_detail][]" value="Strong Thrill" id="{{ $viewFolder }}_strong_thrill" {{ (isset($datum->av_fistula_detail) && is_array(json_decode($datum->av_fistula_detail)) && in_array('Strong Thrill', json_decode($datum->av_fistula_detail))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                              <label class="form-check-label" for="{{ $viewFolder }}_strong_thrill">Strong Thrill</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[av_fistula_detail][]" value="Weak Thrill" id="{{ $viewFolder }}_weak_thrill" {{ (isset($datum->av_fistula_detail) && is_array(json_decode($datum->av_fistula_detail)) && in_array('Weak Thrill', json_decode($datum->av_fistula_detail))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                              <label class="form-check-label" for="{{ $viewFolder }}_weak_thrill">Weak Thrill</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[av_fistula_detail][]" value="Absent Thrill w/ Bruit" id="{{ $viewFolder }}_absent_thrill_with" {{ (isset($datum->av_fistula_detail) && is_array(json_decode($datum->av_fistula_detail)) && in_array('Absent Thrill w/ Bruit', json_decode($datum->av_fistula_detail))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                              <label class="form-check-label" for="{{ $viewFolder }}_absent_thrill_with">Absent Thrill w/ Bruit</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[av_fistula_detail][]" value="Absent Thrill no Bruit" id="{{ $viewFolder }}_absent_thrill_no" {{ (isset($datum->av_fistula_detail) && is_array(json_decode($datum->av_fistula_detail)) && in_array('Absent Thrill no Bruit', json_decode($datum->av_fistula_detail))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                              <label class="form-check-label" for="{{ $viewFolder }}_absent_thrill_no">Absent Thrill no Bruit</label>
                            </div>
                            <div class="input-group mb-3 mt-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[needle_gauge]" id="{{ $viewFolder }}_needle_gauge" placeholder="" value="{{ !empty($datum->needle_gauge) ? $datum->needle_gauge : '' }}" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                                <label for="{{ $viewFolder }}_needle_gauge" class="form-label">Needle Gauge</label>
                                <small id="help_{{ $viewFolder }}_needle_gauge" class="text-muted"></small>
                              </div>
                            </div>
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="number" step="1" name="{{ $viewFolder }}[number_commultation]" id="{{ $viewFolder }}_number_commultation" placeholder="" value="{{ !empty($datum->number_commultation) ? $datum->number_commultation : '' }}" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                                <label for="{{ $viewFolder }}_number_commultation" class="form-label"># of Cannulation</label>
                                <small id="help_{{ $viewFolder }}_number_commultation" class="text-muted"></small>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">  
                    <div class="card mb-3">
                      <div class="card-header">HD Catheter</div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[hd_catheter_detail][]" value="Both Patent" id="{{ $viewFolder }}_both_patent" {{ (isset($datum->hd_catheter_detail) && is_array(json_decode($datum->hd_catheter_detail)) && in_array('Both Patent', json_decode($datum->hd_catheter_detail))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                              <label class="form-check-label" for="{{ $viewFolder }}_both_patent">Both Patent</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[hd_catheter_detail][]" value="A Clotted" id="{{ $viewFolder }}_a_clotted" {{ (isset($datum->hd_catheter_detail) && is_array(json_decode($datum->hd_catheter_detail)) && in_array('A Clotted', json_decode($datum->hd_catheter_detail))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                              <label class="form-check-label" for="{{ $viewFolder }}_a_clotted">A Clotted</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[hd_catheter_detail][]" value="V Clotted" id="{{ $viewFolder }}_v_clotted" {{ (isset($datum->hd_catheter_detail) && is_array(json_decode($datum->hd_catheter_detail)) && in_array('V Clotted', json_decode($datum->hd_catheter_detail))) ? 'checked' : '' }} {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                              <label class="form-check-label" for="{{ $viewFolder }}_v_clotted">V Clotted</label>
                            </div>
                            <div class="input-group mb-3 mt-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[hd_catheter_remarks]" id="{{ $viewFolder }}_hd_catheter_remarks" placeholder="" value="{{ !empty($datum->hd_catheter_remarks) ? $datum->hd_catheter_remarks : '' }}" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                                <label for="{{ $viewFolder }}_hd_catheter_remarks" class="form-label">Remarks</label>
                                <small id="help_{{ $viewFolder }}_hd_catheter_remarks" class="text-muted"></small>
                              </div>
                            </div>
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[hd_catheter_hgb]" id="{{ $viewFolder }}_hd_catheter_hgb" placeholder="" value="{{ !empty($datum->hd_catheter_hgb) ? $datum->hd_catheter_hgb : '' }}" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                                <label for="{{ $viewFolder }}_hd_catheter_hgb" class="form-label">Latest HGB</label>
                                <small id="help_{{ $viewFolder }}_hd_catheter_hgb" class="text-muted"></small>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card mb-3">
                      <div class="card-header">Medication Given</div>
                      <div class="card-body">
                        @if(Route::has($viewFolder . '.getMedTable'))
                        <div class="card mb-3">
                          <div class="card-header">Add Entry</div>
                          <div class="card-body">
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="time" name="{{ $viewFolder }}[Med][time_given]" id="{{ $viewFolder }}_time_given" value="" placeholder="" onchange="
                                  if($(this).val() != ''){
                                    $('#{{ $viewFolder }}_medication').prop('required', true);
                                    $('#{{ $viewFolder }}_dosage').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_medication').prop('required', false);
                                    $('#{{ $viewFolder }}_dosage').prop('required', false);
                                  }
                                  if($(this).val() != '' && $('#{{ $viewFolder }}_medication').val() != '' && $('#{{ $viewFolder }}_dosage').val() != '')
                                    $('#addMedLog{{ $datum->id }}').prop('disabled', false);
                                  else
                                    $('#addMedLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                <label for="{{ $viewFolder }}_time_given" class="form-label">Time Given</label>
                                <small id="help_{{ $viewFolder }}_time_given" class="text-muted"></small>
                              </div>
                            </div>
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[Med][medication]" id="{{ $viewFolder }}_medication" placeholder="" onchange="
                                  if($('#{{ $viewFolder }}_time_given').val() != ''){
                                    $('#{{ $viewFolder }}_medication').prop('required', true);
                                    $('#{{ $viewFolder }}_dosage').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_medication').prop('required', false);
                                    $('#{{ $viewFolder }}_dosage').prop('required', false);
                                  }
                                  if($('#{{ $viewFolder }}_time_given').val() != '' && $('#{{ $viewFolder }}_medication').val() != '' && $('#{{ $viewFolder }}_dosage').val() != '')
                                    $('#addMedLog{{ $datum->id }}').prop('disabled', false);
                                  else
                                    $('#addMedLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                <label for="{{ $viewFolder }}_medication" class="form-label">Medication</label>
                                <small id="help_{{ $viewFolder }}_medication" class="text-muted"></small>
                              </div>
                            </div>
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[Med][dosage]" id="{{ $viewFolder }}_dosage" placeholder=""  onchange="
                                  if($('#{{ $viewFolder }}_time_given').val() != ''){
                                    $('#{{ $viewFolder }}_medication').prop('required', true);
                                    $('#{{ $viewFolder }}_dosage').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_medication').prop('required', false);
                                    $('#{{ $viewFolder }}_dosage').prop('required', false);
                                  }
                                  if($('#{{ $viewFolder }}_time_given').val() != '' && $('#{{ $viewFolder }}_medication').val() != '' && $('#{{ $viewFolder }}_dosage').val() != '')
                                    $('#addMedLog{{ $datum->id }}').prop('disabled', false);
                                  else
                                    $('#addMedLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                <label for="{{ $viewFolder }}_dosage" class="form-label">Dosage</label>
                                <small id="help_{{ $viewFolder }}_dosage" class="text-muted"></small>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer">
                            <button id="addMedLog{{ $datum->id }}" type="button" class="addMedLog btn btn-{{ $bgColor }} btn-sm" disabled onclick="
                              $.ajax({
                                type: 'POST',
                                data: $('#bookMod').serialize(),
                                url: '{{ Route::has($viewFolder . '.' . $formAction) ? route($viewFolder . '.' . $formAction, $datum->id) : ''}}',
                                success:
                                function (){
                                    $.ajax({
                                      type: 'GET',
                                      url: '{{ Route::has($viewFolder . '.getMedTable') ? route($viewFolder . '.getMedTable', $datum->id) : '' }}',
                                      success:
                                      function (data){
                                        medObj = jQuery.parseJSON(data);
                                        var tr;
                                        medObj.forEach(function (item, index){
                                          tr += '<tr id=\'' + item.id + '\' log=\'meds\'><td><div class=\'d-sm-flex flex-sm-row\'><div class=\'m-1\'><button type=\'submit\' class=\'btn btn-{{ $bgColor }} btn-sm w-100 rowBtnDel\'><i class=\'bi bi-trash\'></i><span class=\'ps-1 d-sm-none\'>Delete</span></button></div></div></td><td>' + item.time_given + '</td><td>' + item.medication + '</td><td>' + item.dosage + '</td><td>' + item.creator + '</td></tr>';
                                        });
                                        $('#medTable{{ $datum->id }}').html(tr);
                                      }
                                    });
                                    $('#{{ $viewFolder }}_time_given').val('')
                                    $('#{{ $viewFolder }}_medication').val('');
                                    $('#{{ $viewFolder }}_dosage').val('');
                                    $('#addMedLog{{ $datum->id }}').prop('disabled', true);
                                }
                              });

                            ">Add Medication Log</button>
                          </div>
                        </div>
                        @endif
                        <div class="card-body table-responsive" style="max-height: 300px">
                          <table class="table table-bordered table-striped table-hover table-sm hdLogs">
                            <thead class="table-{{ $bgColor }}">
                              <tr>
                                <th class=""><i class="bi bi-gear"></i></th>
                                <th>Time</th>
                                <th>Medication</th>
                                <th>Dosage</th>
                                <th>NOD</th>
                              </tr>
                            </thead>
                            <tbody id="medTable{{ $datum->id }}">
                            @foreach ($datum->consultation_meds()->orderBy('id', 'desc')->get() as $dat)
                                <tr id="{{ $dat->id }}" log="meds">
                                    <td>@if(Route::has($viewFolder . '.getMedTable'))<div class="d-sm-flex flex-sm-row"><div class="m-1"><button type="submit" class="btn btn-{{ $bgColor }} btn-sm w-100 rowBtnDel"><i class="bi bi-trash"></i><span class="ps-1 d-sm-none">Delete</span></button></div></div>@endif</td>
                                    <td>{{ $dat->time_given }}</td>
                                    <td>{{ $dat->medication }}</td>
                                    <td>{{ $dat->dosage }}</td>
                                    <td>{{ $dat->creator->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card mb-3">
                      <div class="card-header">Special Endorsement</div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[rml]" id="{{ $viewFolder }}_rml" placeholder="" value="{{ !empty($datum->rml) ? $datum->rml : '' }}" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                                <label for="{{ $viewFolder }}_rml" class="form-label">RML</label>
                                <small id="help_{{ $viewFolder }}_rml" class="text-muted"></small>
                              </div>
                            </div>
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[hepa]" id="{{ $viewFolder }}_hepa" placeholder="" value="{{ !empty($datum->hepa) ? $datum->hepa : '' }}" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                                <label for="{{ $viewFolder }}_hepa" class="form-label">HEPA Profile</label>
                                <small id="help_{{ $viewFolder }}_hepa" class="text-muted"></small>
                              </div>
                            </div>
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[iv_iron]" id="{{ $viewFolder }}_iv_iron" placeholder="" value="{{ !empty($datum->iv_iron) ? $datum->iv_iron : '' }}" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                                <label for="{{ $viewFolder }}_iv_iron" class="form-label">IV Iron</label>
                                <small id="help_{{ $viewFolder }}_iv_iron" class="text-muted"></small>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[epo]" id="{{ $viewFolder }}_epo" placeholder="" value="{{ !empty($datum->epo) ? $datum->epo : '' }}" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                                <label for="{{ $viewFolder }}_epo" class="form-label">EPO</label>
                                <small id="help_{{ $viewFolder }}_epo" class="text-muted"></small>
                              </div>
                            </div>
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[hd_vac]" id="{{ $viewFolder }}_hd_vac" placeholder="" value="{{ !empty($datum->hd_vac) ? $datum->hd_vac : '' }}" {{ !isset($referal_conso)  ? '' : 'disabled' }}>
                                <label for="{{ $viewFolder }}_hd_vac" class="form-label">Vaccines</label>
                                <small id="help_{{ $viewFolder }}_hd_vac" class="text-muted"></small>
                              </div>
                            </div>
                            <div class="form-floating mb-3">
                              <textarea class="form-control" name="{{ $viewFolder }}[hd_endorsement]" id="{{ $viewFolder }}_hd_endorsement" {{ !isset($referal_conso)  ? '' : 'disabled' }}>{{ !empty($datum->hd_endorsement) ? $datum->hd_endorsement : '' }}</textarea>
                              <label for="{{ $viewFolder }}_hd_endorsement" class="form-label">Endorsement Details</label>
                              <small id="help_{{ $viewFolder }}_hd_endorsement" class="text-muted"></small>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card mb-3">
                      <div class="card-header">Dialysis Monitoring</div>
                      <div class="card-body">
                        @if(Route::has($viewFolder . '.getMonTable'))
                        <div class="card mb-3">
                          <div class="card-header">Add Entry</div>
                          <div class="card-body">
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="time" name="{{ $viewFolder }}[Monitoring][time_given]" id="{{ $viewFolder }}_mon_time" value="" placeholder="" onchange="
                                  if($(this).val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_time" class="form-label">Time</label>
                                    <small id="help_{{ $viewFolder }}_mon_time" class="text-muted"></small>
                                  </div>
                                </div>
                                <label for="{{ $viewFolder }}_bpS" class="form-label">BP</label>
                                <div class="input-group mb-3">
                                  <input class="form-control" type="number" name="{{ $viewFolder }}[Monitoring][bpS]" min=50 max=250 step=1 id="{{ $viewFolder }}_mon_bpS" placeholder="Systolic" {{ isset($datum->id) ? '' : '' }} onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                  <span class="input-group-text">/</span>
                                  <input class="form-control" type="number" name="{{ $viewFolder }}[Monitoring][bpD]" min=30 max=150 step=1 id="{{ $viewFolder }}_mon_bpD" placeholder="Diastolic" {{ isset($datum->id) ? '' : '' }} onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                </div>
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="number" name="{{ $viewFolder }}[Monitoring][heart]" min=1 id="{{ $viewFolder }}_mon_heart" placeholder="" {{ isset($datum->id) ? '' : '' }} onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_heart" class="form-label">Heart/Pulse Rate</label>
                                    <small id="help_{{ $viewFolder }}_mon_heart" class="text-muted"></small>
                                  </div>
                                  <span class="input-group-text">BPM</span>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="number" name="{{ $viewFolder }}[Monitoring][o2]" min=1 id="{{ $viewFolder }}_mon_o2" placeholder="" {{ isset($datum->id) ? '' : '' }} onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_o2" class="form-label">O2 Sat</label>
                                    <small id="help_{{ $viewFolder }}_mon_o2" class="text-muted"></small>
                                  </div>
                                  <span class="input-group-text">%</span>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="text" name="{{ $viewFolder }}[Monitoring][ap]" id="{{ $viewFolder }}_mon_ap" placeholder="" onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_ap" class="form-label">AP</label>
                                    <small id="help_{{ $viewFolder }}_mon_ap" class="text-muted"></small>
                                  </div>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="text" name="{{ $viewFolder }}[Monitoring][vp]" id="{{ $viewFolder }}_mon_vp" placeholder="" onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_vp" class="form-label">VP</label>
                                    <small id="help_{{ $viewFolder }}_mon_vp" class="text-muted"></small>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="text" name="{{ $viewFolder }}[Monitoring][tmp]" id="{{ $viewFolder }}_mon_tmp" placeholder="" onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_tmp" class="form-label">TMP</label>
                                    <small id="help_{{ $viewFolder }}_mon_tmp" class="text-muted"></small>
                                  </div>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="text" name="{{ $viewFolder }}[Monitoring][bfr]" id="{{ $viewFolder }}_mon_bfr" placeholder="" onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_bfr" class="form-label">BRF</label>
                                    <small id="help_{{ $viewFolder }}_mon_bfr" class="text-muted"></small>
                                  </div>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="text" name="{{ $viewFolder }}[Monitoring][nss]" id="{{ $viewFolder }}_mon_nss" placeholder="" onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_nss" class="form-label">NSS</label>
                                    <small id="help_{{ $viewFolder }}_mon_nss" class="text-muted"></small>
                                  </div>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="text" name="{{ $viewFolder }}[Monitoring][ufr]" id="{{ $viewFolder }}_mon_ufr" placeholder="" onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_ufr" class="form-label">UFR</label>
                                    <small id="help_{{ $viewFolder }}_mon_ufr" class="text-muted"></small>
                                  </div>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="text" name="{{ $viewFolder }}[Monitoring][ufv]" id="{{ $viewFolder }}_mon_ufv" placeholder="" onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_ufv" class="form-label">UFV</label>
                                    <small id="help_{{ $viewFolder }}_mon_ufv" class="text-muted"></small>
                                  </div>
                                </div>
                                <div class="input-group mb-3">
                                  <div class="form-floating">
                                    <input class="form-control" type="text" name="{{ $viewFolder }}[Monitoring][remarks]" id="{{ $viewFolder }}_mon_remarks" placeholder="" onchange="
                                  if($('#{{ $viewFolder }}_mon_time').val() != ''){
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', true);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_mon_bpS').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bpD').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_heart').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_o2').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ap').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_vp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_tmp').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_bfr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_nss').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufr').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_ufv').prop('required', false);
                                    $('#{{ $viewFolder }}_mon_remarks').prop('required', false);
                                  }
                                  if(
                                    $('#{{ $viewFolder }}_mon_time').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpS').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bpD').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_heart').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_o2').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ap').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_vp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_tmp').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_bfr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_nss').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufr').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_ufv').val() != '' &&
                                    $('#{{ $viewFolder }}_mon_remarks').val() != ''
                                  ){
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', false);
                                  }else
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                    <label for="{{ $viewFolder }}_mon_remarks" class="form-label">Remarks</label>
                                    <small id="help_{{ $viewFolder }}_mon_remarks" class="text-muted"></small>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer">
                            <button id="addMonLog{{ $datum->id }}" type="button" class="addMonLog btn btn-{{ $bgColor }} btn-sm" disabled onclick="
                              $.ajax({
                                type: 'POST',
                                data: $('#bookMod').serialize(),
                                url: '{{ Route::has($viewFolder . '.' . $formAction) ? route($viewFolder . '.' . $formAction, $datum->id) : ''}}',
                                success:
                                function (){
                                    $.ajax({
                                      type: 'GET',
                                      url: '{{ Route::has($viewFolder . '.getMonTable') ? route($viewFolder . '.getMonTable', $datum->id) : '' }}',
                                      success:
                                      function (data){
                                        medObj = jQuery.parseJSON(data);
                                        var tr;
                                        medObj.forEach(function (item, index){
                                          tr += '<tr id=\'' + item.id + '\' log=\'moni\'><td><div class=\'d-sm-flex flex-sm-row\'><div class=\'m-1\'><button type=\'submit\' class=\'btn btn-{{ $bgColor }} btn-sm w-100 rowBtnDel\'><i class=\'bi bi-trash\'></i><span class=\'ps-1 d-sm-none\'>Delete</span></button></div></div></td><td>' + item.time_given + '</td><td>' + item.bpS + '/' + item.bpD + '</td><td>' + item.heart + 'BPM</td><td>' + item.o2 + '%</td><td>' + item.ap + '</td><td>' + item.vp + '</td><td>' + item.tmp + '</td><td>' + item.bfr + '</td><td>' + item.nss + '</td><td>' + item.ufr + '</td><td>' + item.ufv + '</td><td>' + item.remarks + '</td><td>' + item.creator + '</td></tr>';
                                        });
                                        $('#monTable{{ $datum->id }}').html(tr);
                                      }
                                    });
                                    $('#{{ $viewFolder }}_mon_time').val('');
                                    $('#{{ $viewFolder }}_mon_bpS').val('');
                                    $('#{{ $viewFolder }}_mon_bpD').val('');
                                    $('#{{ $viewFolder }}_mon_heart').val('');
                                    $('#{{ $viewFolder }}_mon_o2').val('');
                                    $('#{{ $viewFolder }}_mon_ap').val('');
                                    $('#{{ $viewFolder }}_mon_vp').val('');
                                    $('#{{ $viewFolder }}_mon_tmp').val('');
                                    $('#{{ $viewFolder }}_mon_bfr').val('');
                                    $('#{{ $viewFolder }}_mon_nss').val('');
                                    $('#{{ $viewFolder }}_mon_ufr').val('');
                                    $('#{{ $viewFolder }}_mon_ufv').val('');
                                    $('#{{ $viewFolder }}_mon_remarks').val('');
                                    $('#addMonLog{{ $datum->id }}').prop('disabled', true);
                                }
                              });

                            ">Add Monitoring Log</button>
                          </div>
                        </div>
                        @endif
                        <div class="card-body table-responsive" style="max-height: 300px">
                          <table class="table table-bordered table-striped table-hover table-sm hdLogs">
                            <thead class="table-{{ $bgColor }}">
                              <tr>
                                <th class=""><i class="bi bi-gear"></i></th>
                                <th>Time</th>
                                <th>BP</th>
                                <th>HR</th>
                                <th>O2 Sat</th>
                                <th>AP</th>
                                <th>VP</th>
                                <th>TMP</th>
                                <th>BRF</th>
                                <th>NSS</th>
                                <th>UFR</th>
                                <th>UFV</th>
                                <th>Remarks</th>
                                <th>NOD</th>
                              </tr>
                            </thead>
                            <tbody id="monTable{{ $datum->id }}">
                            @foreach ($datum->consultation_monitorings()->orderBy('id', 'desc')->get() as $dat)
                                <tr id="{{ $dat->id }}" log="moni">
                                    <td>@if(Route::has($viewFolder . '.getMonTable'))<div class="d-sm-flex flex-sm-row"><div class="m-1"><button type="submit" class="btn btn-{{ $bgColor }} btn-sm w-100 rowBtnDel"><i class="bi bi-trash"></i><span class="ps-1 d-sm-none">Delete</span></button></div></div>@endif</td>
                                    <td>{{ $dat->time_given }}</td>
                                    <td>{{ $dat->bpS . '/' . $dat->bpD }}</td>
                                    <td>{{ $dat->heart }}BPM</td>
                                    <td>{{ $dat->o2 }}%</td>
                                    <td>{{ $dat->ap }}</td>
                                    <td>{{ $dat->vp }}</td>
                                    <td>{{ $dat->tmp }}</td>
                                    <td>{{ $dat->bfr }}</td>
                                    <td>{{ $dat->nss }}</td>
                                    <td>{{ $dat->ufr }}</td>
                                    <td>{{ $dat->ufv }}</td>
                                    <td>{{ $dat->remarks }}</td>
                                    <td>{{ $dat->creator->name }}</td>
                                </tr>
                            @endforeach 
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card mb-3">
                      <div class="card-header">Nurse Notes</div>
                      <div class="card-body">
                        @if(Route::has($viewFolder . '.getNurseNotesTable'))
                        <div class="card mb-3">
                          <div class="card-header">Add Entry</div>
                          <div class="card-body">
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="time" name="{{ $viewFolder }}[Nurse][time_given]" id="{{ $viewFolder }}_notes_time" value="" placeholder="" onchange="
                                  if($(this).val() != ''){
                                    $('#{{ $viewFolder }}_nurse_notes').prop('required', true);
                                  
                                  }else{
                                    $('#{{ $viewFolder }}_nurse_notes').prop('required', false);
                                    
                                  }
                                  if($(this).val() != '' && $('#{{ $viewFolder }}_nurse_notes').val() != '')
                                    $('#addNurseNotesLog{{ $datum->id }}').prop('disabled', false);
                                  else
                                    $('#addNurseNotesLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                <label for="{{ $viewFolder }}_notes_time" class="form-label">Time Given</label>
                                <small id="help_{{ $viewFolder }}_notes_time" class="text-muted"></small>
                              </div>
                            </div>
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[Nurse][notes]" id="{{ $viewFolder }}_nurse_notes" placeholder="" onchange="
                                  if($('#{{ $viewFolder }}_notes_time').val() != ''){
                                    $('#{{ $viewFolder }}_nurse_notes').prop('required', true);
                                  }else{
                                    $('#{{ $viewFolder }}_nurse_notes').prop('required', false);
                                  }
                                  if($('#{{ $viewFolder }}_notes_time').val() != '' && $('#{{ $viewFolder }}_nurse_notes').val() != '')
                                    $('#addNurseNotesLog{{ $datum->id }}').prop('disabled', false);
                                  else
                                    $('#addNurseNotesLog{{ $datum->id }}').prop('disabled', true);
                                ">
                                <label for="{{ $viewFolder }}_nurse_notes" class="form-label">Notes</label>
                                <small id="help_{{ $viewFolder }}_nurse_notes" class="text-muted"></small>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer">
                            <button id="addNurseNotesLog{{ $datum->id }}" type="button" class="addNurseNotesLog btn btn-{{ $bgColor }} btn-sm" disabled onclick="
                              $.ajax({
                                type: 'POST',
                                data: $('#bookMod').serialize(),
                                url: '{{ Route::has($viewFolder . '.' . $formAction) ? route($viewFolder . '.' . $formAction, $datum->id) : ''}}',
                                success:
                                function (){
                                    $.ajax({
                                      type: 'GET',
                                      url: '{{ Route::has($viewFolder . '.getNurseNotesTable') ? route($viewFolder . '.getNurseNotesTable', $datum->id) : '' }}',
                                      success:
                                      function (data){
                                        medObj = jQuery.parseJSON(data);
                                        var tr;
                                        medObj.forEach(function (item, index){
                                          tr += '<tr id=\'' + item.id + '\' log=\'nurseNotes\'><td><div class=\'d-sm-flex flex-sm-row\'><div class=\'m-1\'><button type=\'submit\' class=\'btn btn-{{ $bgColor }} btn-sm w-100 rowBtnDel\'><i class=\'bi bi-trash\'></i><span class=\'ps-1 d-sm-none\'>Delete</span></button></div></div></td><td>' + item.time_given + '</td><td>' + item.notes + '</td><td>' + item.creator + '</td></tr>';
                                        });
                                        $('#nurseNotesTable{{ $datum->id }}').html(tr);
                                      }
                                    });
                                    $('#{{ $viewFolder }}_notes_time').val('')
                                    $('#{{ $viewFolder }}_nurse_notes').val('');
                                    $('#addNurseNotesLog{{ $datum->id }}').prop('disabled', true);
                                }
                              });

                            ">Add Nurse Notes</button>
                          </div>
                        </div>
                        @endif
                        <div class="card-body table-responsive" style="max-height: 300px">
                          <table class="table table-bordered table-striped table-hover table-sm hdLogs">
                            <thead class="table-{{ $bgColor }}">
                              <tr>
                                <th class=""><i class="bi bi-gear"></i></th>
                                <th>Time</th>
                                <th>Notes</th>
                                <th>NOD</th>
                              </tr>
                            </thead>
                            <tbody id="nurseNotesTable{{ $datum->id }}">
                            @foreach ($datum->consultation_nurse_notes()->orderBy('id', 'desc')->get() as $dat)
                                <tr id="{{ $dat->id }}" log="nurseNotes">
                                    <td>@if(Route::has($viewFolder . '.getNurseNotesTable'))<div class="d-sm-flex flex-sm-row"><div class="m-1"><button type="submit" class="btn btn-{{ $bgColor }} btn-sm w-100 rowBtnDel"><i class="bi bi-trash"></i><span class="ps-1 d-sm-none">Delete</span></button></div></div>@endif</td>
                                    <td>{{ $dat->time_given }}</td>
                                    <td>{{ $dat->notes }}</td>
                                    <td>{{ $dat->creator->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card mb-3">
                      <div class="card-header">Early Termination Waiver</div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="number" name="{{ $viewFolder }}[shorten_min]" id="{{ $viewFolder }}_shorten_min" placeholder="" value="{{ !empty($datum->shorten_min) ? $datum->shorten_min : '' }}">
                                <label for="{{ $viewFolder }}_shorten_min" class="form-label">Shorten Treatment to</label>
                                <small id="help_{{ $viewFolder }}_shorten_min" class="text-muted"></small>
                              </div>
                              <span class="input-group-text">mins</span>
                            </div>
                            <div class="input-group mb-3">
                              <div class="form-floating">
                                <input class="form-control" type="text" name="{{ $viewFolder }}[shorten_reason]" id="{{ $viewFolder }}_shorten_reason" placeholder="" value="{{ !empty($datum->shorten_reason) ? $datum->shorten_reason : '' }}">
                                <label for="{{ $viewFolder }}_shorten_reason" class="form-label">Reason</label>
                                <small id="help_{{ $viewFolder }}_shorten_reason" class="text-muted"></small>
                              </div>
                              
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
              </div>
            </div>
            {{-- @endif --}}
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
  const div1 = document.getElementById('prevDiv');
  const div2 = document.getElementById('curDiv');

  let isScrolling = false; // Flag to prevent infinite loops

  div1.addEventListener('scroll', function() {
    if (!isScrolling) {
      isScrolling = true;
      div2.scrollTop = div1.scrollTop;
      setTimeout(() => { isScrolling = false; }, 50); // Small delay to reset flag
    }
  });

  div2.addEventListener('scroll', function() {
    if (!isScrolling) {
      isScrolling = true;
      div1.scrollTop = div2.scrollTop;
      setTimeout(() => { isScrolling = false; }, 50); // Small delay to reset flag
    }
  });
});
  function nl2br (str, is_xhtml) {
    // http://kevin.vanzonneveld.net
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Philip Peterson
    // +   improved by: Onno Marsman
    // +   improved by: Atli Þór
    // +   bugfixed by: Onno Marsman
    // +      input by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Maximusya
    // *     example 1: nl2br('Kevin\nvan\nZonneveld');
    // *     returns 1: 'Kevin<br />\nvan<br />\nZonneveld'
    // *     example 2: nl2br("\nOne\nTwo\n\nThree\n", false);
    // *     returns 2: '<br>\nOne<br>\nTwo<br>\n<br>\nThree<br>\n'
    // *     example 3: nl2br("\nOne\nTwo\n\nThree\n", true);
    // *     returns 3: '<br />\nOne<br />\nTwo<br />\n<br />\nThree<br />\n'
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>'; // Adjust comment to avoid issue on phpjs.org display

    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
  }
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
          if(bookingObj.consultation.temp == null)
            bookingObj.consultation.temp = '';
          var bmiKey = false;
          if(bookingObj.consultation.height == null){
            bookingObj.consultation.height = '';
          }else
            bmiKey = true;
          
          if(bookingObj.consultation.weight == null){
            bookingObj.consultation.weight = '';
          }else
            bmiKey = true;
          
          var bmi = '';
          if(bmiKey)
            bmi = Math.round(bookingObj.consultation.weight/((bookingObj.consultation.height/100)*(bookingObj.consultation.height/100)));

          if(bookingObj.consultation.bpS == null)
            bookingObj.consultation.bpS = '';
          if(bookingObj.consultation.bpD == null)
            bookingObj.consultation.bpD = '';
          if(bookingObj.consultation.o2 == null)
            bookingObj.consultation.o2 = '';
          if(bookingObj.consultation.heart == null)
            bookingObj.consultation.heart = '';
            
          vitalStr = '<strong>Temp:</strong>&nbsp;<span class="text-primary">' + bookingObj.consultation.temp + 'C</span>&nbsp;&nbsp;|&nbsp;&nbsp;<strong>Height:</strong>&nbsp;<span class="text-primary">' + bookingObj.consultation.height + 'cm</span>&nbsp;&nbsp;|&nbsp;&nbsp;<strong>Weight:</strong>&nbsp;<span class="text-primary">' + bookingObj.consultation.weight + 'kg</span>&nbsp;&nbsp;|&nbsp;&nbsp;<strong>BMI:</strong>&nbsp;<span class="text-primary">' + bmi + '</span><br><strong>BP:</strong>&nbsp;<span class="text-primary">' + bookingObj.consultation.bpS + '/' + bookingObj.consultation.bpD + '</span>&nbsp;&nbsp;|&nbsp;&nbsp;<strong>O2 Sat:</strong>&nbsp;<span class="text-primary">' + bookingObj.consultation.o2 + '%</span>&nbsp;&nbsp;|&nbsp;&nbsp;<strong>Heart Rate:</strong>&nbsp;<span class="text-primary">' + bookingObj.consultation.heart + 'beats/min</span>';
          $('#prevVitaler').html(vitalStr);
          $('#prevProcDet').html(bookingObj.consultation.procedure_details);
          $('#prevSumProcDet').html(bookingObj.consultation.procedure_details);
          $('#prevPatComp').html(bookingObj.consultation.complains);
          $('#prevSumPatComp').html(bookingObj.consultation.complains);
          $('#prevPatCompDur').html(bookingObj.consultation.duration);
          $('#prevSumPatCompDur').html(bookingObj.consultation.duration);
          $('#prevPatRem').html(bookingObj.consultation.others);
          $('#prevSumPatRem').html(bookingObj.consultation.others);
          eyeStr = '<tr><td>AR</td><td>';
          if(bookingObj.consultation.arod_sphere == 'No Target')
            eyeStr += 'No Refraction Possible';
          else{
            if(bookingObj.consultation.arod_sphere == null)
              bookingObj.consultation.arod_sphere = '';
            if(bookingObj.consultation.arod_cylinder == null)
              bookingObj.consultation.arod_cylinder = '';
            if(bookingObj.consultation.arod_axis == null)
              bookingObj.consultation.arod_axis = '';
            eyeStr += bookingObj.consultation.arod_sphere + ' - ' + bookingObj.consultation.arod_cylinder + ' x ' + bookingObj.consultation.arod_axis;
          }
          eyeStr += '</td><td>';
          if(bookingObj.consultation.aros_sphere == 'No Target')
            eyeStr += 'No Refraction Possible';
          else{
            if(bookingObj.consultation.aros_sphere == null)
              bookingObj.consultation.arod_saros_spherephere = '';
            if(bookingObj.consultation.aros_cylinder == null)
             bookingObj.consultation.aros_cylinder = '';
            if(bookingObj.consultation.aros_axis == null)
             bookingObj.consultation.aros_axis = '';
            eyeStr += bookingObj.consultation.aros_sphere + ' - ' + bookingObj.consultation.aros_cylinder + ' x ' + bookingObj.consultation.aros_axis;
          }
          eyeStr += '</td><td></td>';
          eyeStr += '<tr><td>UCVA</td><td>';
          if((bookingObj.consultation.vaod_den == '' || bookingObj.consultation.vaod_den == null) && bookingObj.consultation.vaod_num != null)
            eyeStr += bookingObj.consultation.vaod_num;
          else{
            var key = false;
            if(bookingObj.consultation.vaod_num != null)
              key = true;
            if(bookingObj.consultation.vaod_den != null)
             key = true;
            if(key)
              eyeStr += bookingObj.consultation.vaod_num + ' / ' + bookingObj.consultation.vaod_den;
          }
          eyeStr += '</td><td>';
          if((bookingObj.consultation.vaos_den == '' || bookingObj.consultation.vaos_den == null) && bookingObj.consultation.vaos_num != null)
            eyeStr += bookingObj.consultation.vaos_num;
          else{
            key = false;
            if(bookingObj.consultation.vaos_num != null)
              key = true;
            if(bookingObj.consultation.vaos_den != null)
             key = true;
            if(key)
              eyeStr += bookingObj.consultation.vaos_num + ' / ' + bookingObj.consultation.vaos_den;
          }
          eyeStr += '</td><td></td>';
          eyeStr += '<tr><td>UCVA Present Correction</td><td>';
          if((bookingObj.consultation.vaodcor_den == '' || bookingObj.consultation.vaodcor_den == null) && bookingObj.consultation.vaodcor_num != null)
            eyeStr += bookingObj.consultation.vaodcor_num;
          else{
            key = false;
            if(bookingObj.consultation.vaodcor_num != null)
              key = true;
            if(bookingObj.consultation.vaodcor_den != null)
             key = true;
            if(key)
              eyeStr += bookingObj.consultation.vaodcor_num + ' / ' + bookingObj.consultation.vaodcor_den;
          }
          eyeStr += '</td><td>';
          if((bookingObj.consultation.vaoscor_den == '' || bookingObj.consultation.vaoscor_den == null) && bookingObj.consultation.vaoscor_num != null)
            eyeStr += bookingObj.consultation.vaoscor_num;
          else{
            key = false;
            if(bookingObj.consultation.vaoscor_num != null)
              key = true;
            if(bookingObj.consultation.vaoscor_den != null)
              key = true;
            if(key)
              eyeStr += bookingObj.consultation.vaoscor_num + ' / ' + bookingObj.consultation.vaoscor_den;
          }
          eyeStr += '</td><td></td>';
          eyeStr += '<tr><td>VA Pinhole</td><td>';
          if((bookingObj.consultation.pinod_den == '' || bookingObj.consultation.pinod_den == null) && bookingObj.consultation.pinod_num != null)
            eyeStr += bookingObj.consultation.pinod_num;
          else{
            key = false;
            if(bookingObj.consultation.pinod_num != null)
              key = true;
            if(bookingObj.consultation.pinod_den != null)
              key = true;
            if(key)
              eyeStr += bookingObj.consultation.pinod_num + ' / ' + bookingObj.consultation.pinod_den;
          }
          eyeStr += '</td><td>';
          if((bookingObj.consultation.pinos_den == '' || bookingObj.consultation.pinos_den == null) && bookingObj.consultation.pinos_num != null)
            eyeStr += bookingObj.consultation.pinos_num;
          else{
            key = false;
            if(bookingObj.consultation.pinos_num != null)
              key = true;
            if(bookingObj.consultation.pinos_den != null)
              key = true;
            if(key)
              eyeStr += bookingObj.consultation.pinos_num + ' / ' + bookingObj.consultation.pinos_den;
          }
          eyeStr += '</td><td></td>';
          eyeStr += '<tr><td>BCVA</td><td>';
          if((bookingObj.consultation.pinodcor_den == '' || bookingObj.consultation.pinodcor_den == null) && bookingObj.consultation.pinodcor_num != null)
            eyeStr += bookingObj.consultation.pinodcor_num;
          else{
            key = false;
            if(bookingObj.consultation.pinodcor_num != null)
              key = true;
            if(bookingObj.consultation.pinodcor_den != null)
              key = true;
            if(key)
              eyeStr += bookingObj.consultation.pinodcor_num + ' / ' + bookingObj.consultation.pinodcor_den;
          }
          eyeStr += '</td><td>';
          if((bookingObj.consultation.pinoscor_den == '' || bookingObj.consultation.pinoscor_den == null) && bookingObj.consultation.pinoscor_num != null)
            eyeStr += bookingObj.consultation.pinoscor_num;
          else{
            key = false;
            if(bookingObj.consultation.pinoscor_num != null)
              key = true;
            if(bookingObj.consultation.pinoscor_den != null)
              key = true;
            if(key)
              eyeStr += bookingObj.consultation.pinoscor_num + ' / ' + bookingObj.consultation.pinoscor_den;
          }
          eyeStr += '</td><td></td>';
          eyeStr += '<tr><td>Jaeger</td><td>';
          if(bookingObj.consultation.jae_os != null)
            eyeStr += bookingObj.consultation.jae_os;
          eyeStr += '</td><td>';
          if(bookingObj.consultation.jae_od != null)
            eyeStr += bookingObj.consultation.jae_od;
          eyeStr += '</td><td>';
          if(bookingObj.consultation.jae_ou != null)
            eyeStr += bookingObj.consultation.jae_ou;
          eyeStr += '</td>';
          eyeStr += '<tr><td>IOP</td><td>';
          if(bookingObj.consultation.iopod != null)
            eyeStr += bookingObj.consultation.iopod;
          eyeStr += '</td><td>';
          if(bookingObj.consultation.iopos != null)
            eyeStr += bookingObj.consultation.iopos;
          eyeStr += '</td><td></td>';
          $('#prevEyer').html(eyeStr);
          $('#prevEyerSum').html(eyeStr);

          if(bookingObj.parent_consultation.id != ''){
            bookingObj.consultation = orig_booking;
          }
          if(bookingObj.consultation.docNotesHPI != null){
            $('#{{ $viewFolder }}_prev_docNotesHPI').val(bookingObj.consultation.docNotesHPI);
            $('#{{ $viewFolder }}_prev_sum_docNotesHPI').html(nl2br(bookingObj.consultation.docNotesHPI));
          }else{
            $('#{{ $viewFolder }}_prev_docNotesHPI').val('');
            $('#{{ $viewFolder }}_prev_sum_docNotesHPI').html('');
          }
          if(bookingObj.consultation.docNotesSubject != null){
            $('#{{ $viewFolder }}_prev_docNotesSubject').val(bookingObj.consultation.docNotesSubject);
            $('#{{ $viewFolder }}_prev_sum_docNotesSubject').html(nl2br(bookingObj.consultation.docNotesSubject));
          }else{
            $('#{{ $viewFolder }}_prev_docNotesSubject').val('');
            $('#{{ $viewFolder }}_prev_sum_docNotesSubject').html('');
          }
          if(bookingObj.consultation.docNotes != null){
            $('#{{ $viewFolder }}_prev_docNotes').val(bookingObj.consultation.docNotes);
            $('#{{ $viewFolder }}_prev_sum_docNotes').html(nl2br(bookingObj.consultation.docNotes));
          }else{
            $('#{{ $viewFolder }}_prev_docNotes').val('');
            $('#{{ $viewFolder }}_prev_sum_docNotes').html('');
          }
          if(bookingObj.consultation.icd_code_obj != null){
            $('#{{ $viewFolder }}_prev_icd_code').val(bookingObj.consultation.icd_code_obj.icd_code + ' - ' + bookingObj.consultation.icd_code_obj.details);
            $('#{{ $viewFolder }}_prev_sum_icd_code').html(bookingObj.consultation.icd_code_obj.icd_code + ' - ' + bookingObj.consultation.icd_code_obj.details);
          }else{
            $('#{{ $viewFolder }}_prev_icd_code').val('');
            $('#{{ $viewFolder }}_prev_sum_icd_code').html('');
          }
          if(bookingObj.consultation.assessment != null){
            $('#{{ $viewFolder }}_prev_assessment').val(bookingObj.consultation.assessment);
            $('#{{ $viewFolder }}_prev_sum_assessment').html(nl2br(bookingObj.consultation.assessment));
          }else{
            $('#{{ $viewFolder }}_prev_assessment').val('');
            $('#{{ $viewFolder }}_prev_sum_assessment').html('');
          }
          if(bookingObj.consultation.plan != null){
            $('#{{ $viewFolder }}_prev_plan').val(bookingObj.consultation.plan);
            $('#{{ $viewFolder }}_prev_sum_plan').html(nl2br(bookingObj.consultation.plan));
          }else{
            $('#{{ $viewFolder }}_prev_plan').val('');
            $('#{{ $viewFolder }}_prev_sum_plan').html('');
          }
          if(bookingObj.consultation.planMed != null){
            $('#{{ $viewFolder }}_prev_planMed').val(bookingObj.consultation.planMed);
            $('#{{ $viewFolder }}_prev_sum_planMed').html(nl2br(bookingObj.consultation.planMed));
          }else{
            $('#{{ $viewFolder }}_prev_planMed').val('');
            $('#{{ $viewFolder }}_prev_sum_planMed').html('');
          }
          if(bookingObj.consultation.planRem != null){
            $('#{{ $viewFolder }}_prev_planRem').val(bookingObj.consultation.planRem);
            $('#{{ $viewFolder }}_prev_sum_planRem').html(nl2br(bookingObj.consultation.planRem));
          }else{
            $('#{{ $viewFolder }}_prev_planRem').val('');
            $('#{{ $viewFolder }}_prev_sum_planRem').html('');
          }
          
          if(bookingObj.consultation.id != null){
            $('#{{ $viewFolder }}_prev_treatment_id').val(bookingObj.consultation.id);
          }else{
            $('#{{ $viewFolder }}_prev_treatment_id').val('');
          }
          if(bookingObj.consultation.time_started != null){
            $('#{{ $viewFolder }}_prev_time_started').val(bookingObj.consultation.time_started);
          }else{
            $('#{{ $viewFolder }}_prev_time_started').val('');
          }
          if(bookingObj.consultation.time_ended != null){
            $('#{{ $viewFolder }}_prev_time_ended').val(bookingObj.consultation.time_ended);
          }else{
            $('#{{ $viewFolder }}_prev_time_ended').val('');
          }
          if(bookingObj.consultation.machine_number != null){
            $('#{{ $viewFolder }}_prev_machine_number').val(bookingObj.consultation.machine_number);
          }else{
            $('#{{ $viewFolder }}_prev_machine_number').val('');
          }
          if(bookingObj.consultation.dialyzer != null){
            $('#{{ $viewFolder }}_prev_dialyzer').val(bookingObj.consultation.dialyzer);
          }else{
            $('#{{ $viewFolder }}_prev_dialyzer').val('');
          }
          if(bookingObj.consultation.mac_use != null){
            $('#{{ $viewFolder }}_prev_mac_use').val(bookingObj.consultation.mac_use);
          }else{
            $('#{{ $viewFolder }}_prev_mac_use').val('');
          }
          if(bookingObj.consultation.acid != null){
            $('#{{ $viewFolder }}_prev_acid').val(bookingObj.consultation.acid);
          }else{
            $('#{{ $viewFolder }}_prev_acid').val('');
          }
          if(bookingObj.consultation.mac_add != null){
            $('#{{ $viewFolder }}_prev_add').val(bookingObj.consultation.mac_add);
          }else{
            $('#{{ $viewFolder }}_prev_add').val('');
          }
          if(bookingObj.consultation.bfr != null){
            $('#{{ $viewFolder }}_prev_bfr').val(bookingObj.consultation.bfr);
          }else{
            $('#{{ $viewFolder }}_prev_bfr').val('');
          }
          if(bookingObj.consultation.dfr != null){
            $('#{{ $viewFolder }}_prev_dfr').val(bookingObj.consultation.dfr);
          }else{
            $('#{{ $viewFolder }}_prev_dfr').val('');
          }
          if(bookingObj.consultation.setup_prime != null){
            $('#{{ $viewFolder }}_prev_setup_prime').val(bookingObj.consultation.setup_prime);
          }else{
            $('#{{ $viewFolder }}_prev_setup_prime').val('');
          }
          if(bookingObj.consultation.safety_check != null){
            $('#{{ $viewFolder }}_prev_safety_check').val(bookingObj.consultation.safety_check);
          }else{
            $('#{{ $viewFolder }}_prev_safety_check').val('');
          }
          if(bookingObj.consultation.residual_test != null){
            $('#{{ $viewFolder }}_prev_residual_test').val(bookingObj.consultation.residual_test);
          }else{
            $('#{{ $viewFolder }}_prev_residual_test').val('');
          }
          if(bookingObj.consultation.dry_weight != null){
            $('#{{ $viewFolder }}_prev_dry_weight').val(bookingObj.consultation.dry_weight);
          }else{
            $('#{{ $viewFolder }}_prev_dry_weight').val('');
          }
          if(bookingObj.consultation.prev_post_hd_weight != null){
            $('#{{ $viewFolder }}_prev_dry_prev_post_hd_weight').val(bookingObj.consultation.prev_post_hd_weight);
          }else{
            $('#{{ $viewFolder }}_prev_dry_prev_post_hd_weight').val('');
          }
          if(bookingObj.consultation.pre_hd_weight != null){
            $('#{{ $viewFolder }}_prev_pre_hd_weight').val(bookingObj.consultation.pre_hd_weight);
          }else{
            $('#{{ $viewFolder }}_prev_pre_hd_weight').val('');
          }
          if(bookingObj.consultation.post_hd_weight != null){
            $('#{{ $viewFolder }}_prev_post_hd_weight').val(bookingObj.consultation.post_hd_weight);
          }else{
            $('#{{ $viewFolder }}_prev_post_hd_weight').val('');
          }
          if(bookingObj.consultation.ktv != null){
            $('#{{ $viewFolder }}_prev_ktv').val(bookingObj.consultation.ktv);
          }else{
            $('#{{ $viewFolder }}_prev_ktv').val('');
          }
          if(bookingObj.consultation.net_uf != null){
            $('#{{ $viewFolder }}_prev_net_uf').val(bookingObj.consultation.net_uf);
          }else{
            $('#{{ $viewFolder }}_prev_net_uf').val('');
          }
          if(bookingObj.consultation.hd_duration != null){
            $('#{{ $viewFolder }}_prev_hd_duration').val(bookingObj.consultation.hd_duration);
          }else{
            $('#{{ $viewFolder }}_prev_hd_duration').val('');
          }
          if(bookingObj.consultation.frequency != null){
            $('#{{ $viewFolder }}_prev_frequency').val(bookingObj.consultation.frequency);
          }else{
            $('#{{ $viewFolder }}_prev_frequency').val('');
          }
          if(bookingObj.consultation.prime != null){
            $('#{{ $viewFolder }}_prev_prime').val(bookingObj.consultation.prime);
          }else{
            $('#{{ $viewFolder }}_prev_prime').val('');
          }
          if(bookingObj.consultation.other_fluids != null){
            $('#{{ $viewFolder }}_prev_other_fluids').val(bookingObj.consultation.other_fluids);
          }else{
            $('#{{ $viewFolder }}_prev_other_fluids').val('');
          }
          if(bookingObj.consultation.total_uf_goal != null){
            $('#{{ $viewFolder }}_prev_total_uf_goal').val(bookingObj.consultation.total_uf_goal);
          }else{
            $('#{{ $viewFolder }}_prev_total_uf_goal').val('');
          }
          if(bookingObj.consultation.weight_loss != null){
            $('#{{ $viewFolder }}_prev_weight_loss').val(bookingObj.consultation.weight_loss);
          }else{
            $('#{{ $viewFolder }}_prev_weight_loss').val('');
          }
          if(bookingObj.consultation.brand != null){
            $('#{{ $viewFolder }}_prev_brand').val(bookingObj.consultation.brand);
          }else{
            $('#{{ $viewFolder }}_prev_brand').val('');
          }
          if(bookingObj.consultation.dose != null){
            $('#{{ $viewFolder }}_prev_dose').val(bookingObj.consultation.dose);
          }else{
            $('#{{ $viewFolder }}_prev_dose').val('');
          }
          if(bookingObj.consultation.regular_dose != null){
            $('#{{ $viewFolder }}_prev_regular_dose').val(bookingObj.consultation.regular_dose);
          }else{
            $('#{{ $viewFolder }}_prev_regular_dose').val('');
          }
          if(bookingObj.consultation.low_dose != null){
            $('#{{ $viewFolder }}_prev_low_dose').val(bookingObj.consultation.low_dose);
          }else{
            $('#{{ $viewFolder }}_prev_low_dose').val('');
          }
          if(bookingObj.consultation.lmwh != null){
            $('#{{ $viewFolder }}_prev_lmwh').val(bookingObj.consultation.lmwh);
          }else{
            $('#{{ $viewFolder }}_prev_lmwh').val('');
          }
          if(bookingObj.consultation.flushing != null){
            $('#{{ $viewFolder }}_prev_flushing').val(bookingObj.consultation.flushing);
          }else{
            $('#{{ $viewFolder }}_prev_flushing').val('');
          }
          if(bookingObj.consultation.temp != null){
            $('#{{ $viewFolder }}_prev_temp').val(bookingObj.consultation.temp);
          }else{
            $('#{{ $viewFolder }}_prev_temp').val('');
          }
          if(bookingObj.consultation.bpS != null){
            $('#{{ $viewFolder }}_prev_bpS').val(bookingObj.consultation.bpS);
          }else{
            $('#{{ $viewFolder }}_prev_bpS').val('');
          }
          if(bookingObj.consultation.bpD != null){
            $('#{{ $viewFolder }}_prev_bpD').val(bookingObj.consultation.bpD);
          }else{
            $('#{{ $viewFolder }}_prev_bpD').val('');
          }
          if(bookingObj.consultation.o2 != null){
            $('#{{ $viewFolder }}_prev_o2').val(bookingObj.consultation.o2);
          }else{
            $('#{{ $viewFolder }}_prev_o2').val('');
          }
          if(bookingObj.consultation.heart != null){
            $('#{{ $viewFolder }}_prev_heart').val(bookingObj.consultation.heart);
          }else{
            $('#{{ $viewFolder }}_prev_heart').val('');
          }
          if(bookingObj.consultation.resp != null){
            $('#{{ $viewFolder }}_prev_resp').val(bookingObj.consultation.resp);
          }else{
            $('#{{ $viewFolder }}_prev_resp').val('');
          }
          if(bookingObj.consultation.post_temp != null){
            $('#{{ $viewFolder }}_prev_post_temp').val(bookingObj.consultation.post_temp);
          }else{
            $('#{{ $viewFolder }}_prev_post_temp').val('');
          }
          if(bookingObj.consultation.post_bpS != null){
            $('#{{ $viewFolder }}_prev_post_bpS').val(bookingObj.consultation.post_bpS);
          }else{
            $('#{{ $viewFolder }}_prev_post_bpS').val('');
          }
          if(bookingObj.consultation.post_bpD != null){
            $('#{{ $viewFolder }}_prev_post_bpD').val(bookingObj.consultation.post_bpD);
          }else{
            $('#{{ $viewFolder }}_prev_post_bpD').val('');
          }
          if(bookingObj.consultation.post_o2 != null){
            $('#{{ $viewFolder }}_prev_post_o2').val(bookingObj.consultation.post_o2);
          }else{
            $('#{{ $viewFolder }}_prev_post_o2').val('');
          }
          if(bookingObj.consultation.post_heart != null){
            $('#{{ $viewFolder }}_prev_post_heart').val(bookingObj.consultation.post_heart);
          }else{
            $('#{{ $viewFolder }}_prev_post_heart').val('');
          }
          if(bookingObj.consultation.post_resp != null){
            $('#{{ $viewFolder }}_prev_post_resp').val(bookingObj.consultation.post_resp);
          }else{
            $('#{{ $viewFolder }}_prev_post_resp').val('');
          }
          if(bookingObj.consultation.mental_status != null){
            if(bookingObj.consultation.mental_status.includes('awake'))
              $('#{{ $viewFolder }}_prev_mental_status_awake').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_mental_status_awake').prop('checked', false);
            if(bookingObj.consultation.mental_status.includes('oriented'))
              $('#{{ $viewFolder }}_prev_mental_status_oriented').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_mental_status_oriented').prop('checked', false);
            if(bookingObj.consultation.mental_status.includes('drowsy'))
              $('#{{ $viewFolder }}_prev_mental_status_drowsy').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_mental_status_drowsy').prop('checked', false);
            if(bookingObj.consultation.mental_status.includes('disoriented'))
              $('#{{ $viewFolder }}_prev_mental_status_disoriented').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_mental_status_disoriented').prop('checked', false);
          }else{
            $('#{{ $viewFolder }}_prev_mental_status_awake').prop('checked', false);
            $('#{{ $viewFolder }}_prev_mental_status_oriented').prop('checked', false);
            $('#{{ $viewFolder }}_prev_mental_status_drowsy').prop('checked', false);
            $('#{{ $viewFolder }}_prev_mental_status_disoriented').prop('checked', false);
          }
          
          if(bookingObj.consultation.post_mental_status != null){
            if(bookingObj.consultation.post_mental_status.includes('awake'))
              $('#{{ $viewFolder }}_prev_post_mental_status_awake').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_post_mental_status_awake').prop('checked', false);
            if(bookingObj.consultation.post_mental_status.includes('oriented'))
              $('#{{ $viewFolder }}_prev_post_mental_status_oriented').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_post_mental_status_oriented').prop('checked', false);
            if(bookingObj.consultation.post_mental_status.includes('drowsy'))
              $('#{{ $viewFolder }}_prev_post_mental_status_drowsy').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_post_mental_status_drowsy').prop('checked', false);
            if(bookingObj.consultation.post_mental_status.includes('disoriented'))
              $('#{{ $viewFolder }}_prev_post_mental_status_disoriented').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_post_mental_status_disoriented').prop('checked', false);
          }else{
            $('#{{ $viewFolder }}_prev_post_mental_status_awake').prop('checked', false);
            $('#{{ $viewFolder }}_prev_post_mental_status_oriented').prop('checked', false);
            $('#{{ $viewFolder }}_prev_post_mental_status_drowsy').prop('checked', false);
            $('#{{ $viewFolder }}_prev_post_mental_status_disoriented').prop('checked', false);
          }

          if(bookingObj.consultation.ambulation_status != null){
            if(bookingObj.consultation.ambulation_status == 'ambulatory')
              $('#{{ $viewFolder }}_prev_ambulation_status_ambulatory').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_ambulation_status_ambulatory').prop('checked', false);
            if(bookingObj.consultation.ambulation_status == 'w/ assistance')
              $('#{{ $viewFolder }}_prev_ambulation_status_assistance').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_ambulation_status_assistance').prop('checked', false);
            if(bookingObj.consultation.ambulation_status == 'wheelchair')
              $('#{{ $viewFolder }}_prev_ambulation_status_wheelchair').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_ambulation_status_wheelchair').prop('checked', false);
          }else{  
            $('#{{ $viewFolder }}_prev_ambulation_status_ambulatory').prop('checked', false);
            $('#{{ $viewFolder }}_prev_ambulation_status_assistance').prop('checked', false);
            $('#{{ $viewFolder }}_prev_ambulation_status_wheelchair').prop('checked', false);
          }

          if(bookingObj.consultation.post_ambulation_status != null){
            if(bookingObj.consultation.post_ambulation_status == 'ambulatory')
              $('#{{ $viewFolder }}_prev_post_ambulation_status_ambulatory').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_post_ambulation_status_ambulatory').prop('checked', false);
            if(bookingObj.consultation.post_ambulation_status == 'w/ assistance')
              $('#{{ $viewFolder }}_prev_post_ambulation_status_assistance').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_post_ambulation_status_assistance').prop('checked', false);
            if(bookingObj.consultation.post_ambulation_status == 'wheelchair')
              $('#{{ $viewFolder }}_prev_post_ambulation_status_wheelchair').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_post_ambulation_status_wheelchair').prop('checked', false);
          }else{  
            $('#{{ $viewFolder }}_prev_post_ambulation_status_ambulatory').prop('checked', false);
            $('#{{ $viewFolder }}_prev_post_ambulation_status_assistance').prop('checked', false);
            $('#{{ $viewFolder }}_prev_post_ambulation_status_wheelchair').prop('checked', false);
          }

          if(bookingObj.consultation.subjective_complaints != null){
            if(bookingObj.consultation.subjective_complaints == 'none')
              $('#{{ $viewFolder }}_prev_subjective_complaints_none').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_subjective_complaints_none').prop('checked', false);
            if(bookingObj.consultation.subjective_complaints == 'yes')
              $('#{{ $viewFolder }}_prev_subjective_complaints_yes').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_subjective_complaints_yes').prop('checked', false);
            $('#{{ $viewFolder }}_prev_subjective_complaints_text').val(bookingObj.consultation.subjective_complaints_text);
           
          }else{  
            $('#{{ $viewFolder }}_prev_subjective_complaints_none').prop('checked', false);
            $('#{{ $viewFolder }}_prev_subjective_complaints_yes').prop('checked', false);
            $('#{{ $viewFolder }}_prev_subjective_complaints_text').val('');
            
          }

          if(bookingObj.consultation.post_subjective_complaints != null){
            if(bookingObj.consultation.post_subjective_complaints == 'none')
              $('#{{ $viewFolder }}_prev_post_subjective_complaints_none').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_post_subjective_complaints_none').prop('checked', false);
            if(bookingObj.consultation.post_subjective_complaints == 'yes')
              $('#{{ $viewFolder }}_prev_post_subjective_complaints_yes').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_post_subjective_complaints_yes').prop('checked', false);
            $('#{{ $viewFolder }}_prev_post_subjective_complaints_text').val(bookingObj.consultation.post_subjective_complaints_text);
           
          }else{  
            $('#{{ $viewFolder }}_prev_post_subjective_complaints_none').prop('checked', false);
            $('#{{ $viewFolder }}_prev_post_subjective_complaints_yes').prop('checked', false);
            $('#{{ $viewFolder }}_prev_post_subjective_complaints_text').val('');
            
          }

          if(bookingObj.consultation.pe_findings != null){
            if(bookingObj.consultation.pe_findings.includes('Pallor'))
              $('#{{ $viewFolder }}_prev_pe_findings_pallor').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_pe_findings_pallor').prop('checked', false);
            if(bookingObj.consultation.pe_findings.includes('Distended Neck Vein'))
              $('#{{ $viewFolder }}_prev_pe_findings_neck_vein').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_pe_findings_neck_vein').prop('checked', false);
            if(bookingObj.consultation.pe_findings.includes('Abnormal Rhythm/Rate'))
              $('#{{ $viewFolder }}_prev_pe_findings_rhythm').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_pe_findings_rhythym').prop('checked', false);
            if(bookingObj.consultation.pe_findings.includes('Rales'))
              $('#{{ $viewFolder }}_prev_pe_findings_rales').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_pe_findings_rales').prop('checked', false);
            if(bookingObj.consultation.pe_findings.includes('Wheezing'))
              $('#{{ $viewFolder }}_prev_pe_findings_wheezing').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_pe_findings_wheezing').prop('checked', false);
            if(bookingObj.consultation.pe_findings.includes('Decreased Breath Sounds'))
              $('#{{ $viewFolder }}_prev_pe_findings_breath_sounds').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_pe_findings_breath_sounds').prop('checked', false);
            if(bookingObj.consultation.pe_findings.includes('Ascites - Abdominal Girth'))
              $('#{{ $viewFolder }}_prev_pe_findings_ascites').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_pe_findings_ascites').prop('checked', false);
            if(bookingObj.consultation.pe_findings.includes('Edema Grade'))
              $('#{{ $viewFolder }}_prev_pe_findings_edema').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_pe_findings_edema').prop('checked', false);
            if(bookingObj.consultation.pe_findings.includes('Bleeding'))
              $('#{{ $viewFolder }}_prev_pe_findings_bleeding').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_pe_findings_bleeding').prop('checked', false);
            if(bookingObj.consultation.pe_findings.includes('Others'))
              $('#{{ $viewFolder }}_prev_pe_findings_others').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_pe_findings_others').prop('checked', false);
            $('#{{ $viewFolder }}_prev_pe_findings_ascites_text').val(bookingObj.consultation.pe_findings_ascites_text);
            $('#{{ $viewFolder }}_prev_pe_findings_edema_text').val(bookingObj.consultation.pe_findings_edema_text);
            $('#{{ $viewFolder }}_prev_pe_findings_others_text').val(bookingObj.consultation.pe_findings_others_text);
            
          }else{
            $('#{{ $viewFolder }}_prev_pe_findings_pallor').prop('checked', false);
            $('#{{ $viewFolder }}_prev_pe_findings_neck_vein').prop('checked', false);
            $('#{{ $viewFolder }}_prev_pe_findings_rhythm').prop('checked', false);
            $('#{{ $viewFolder }}_prev_pe_findings_rales').prop('checked', false);
            $('#{{ $viewFolder }}_prev_pe_findings_wheezing').prop('checked', false);
            $('#{{ $viewFolder }}_prev_pe_findings_breath_sounds').prop('checked', false);
            $('#{{ $viewFolder }}_prev_pe_findings_ascites').prop('checked', false);
            $('#{{ $viewFolder }}_prev_pe_findings_edema').prop('checked', false);
            $('#{{ $viewFolder }}_prev_pe_findings_bleeding').prop('checked', false);
            $('#{{ $viewFolder }}_prev_pe_findings_others').prop('checked', false);
            $('#{{ $viewFolder }}_prev_pe_findings_ascites_text').val('');
            $('#{{ $viewFolder }}_prev_pe_findings_edema_text').val('');
            $('#{{ $viewFolder }}_prev_pe_findings_others_text').val('');
          }

          if(bookingObj.consultation.post_pe_findings != null){
            if(bookingObj.consultation.post_pe_findings.includes('Pallor'))
              $('#{{ $viewFolder }}_prev_post_pe_findings_pallor').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_post_pe_findings_pallor').prop('checked', false);
            if(bookingObj.consultation.post_pe_findings.includes('Distended Neck Vein'))
              $('#{{ $viewFolder }}_prev_post_pe_findings_neck_vein').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_post_pe_findings_neck_vein').prop('checked', false);
            if(bookingObj.consultation.post_pe_findings.includes('Abnormal Rhythm/Rate'))
              $('#{{ $viewFolder }}_prev_post_pe_findings_rhythm').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_post_pe_findings_rhythym').prop('checked', false);
            if(bookingObj.consultation.post_pe_findings.includes('Rales'))
              $('#{{ $viewFolder }}_prev_post_pe_findings_rales').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_post_pe_findings_rales').prop('checked', false);
            if(bookingObj.consultation.post_pe_findings.includes('Wheezing'))
              $('#{{ $viewFolder }}_prev_post_pe_findings_wheezing').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_post_pe_findings_wheezing').prop('checked', false);
            if(bookingObj.consultation.post_pe_findings.includes('Decreased Breath Sounds'))
              $('#{{ $viewFolder }}_prev_post_pe_findings_breath_sounds').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_post_pe_findings_breath_sounds').prop('checked', false);
            if(bookingObj.consultation.post_pe_findings.includes('Ascites - Abdominal Girth'))
              $('#{{ $viewFolder }}_prev_post_pe_findings_ascites').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_post_pe_findings_ascites').prop('checked', false);
            if(bookingObj.consultation.post_pe_findings.includes('Edema Grade'))
              $('#{{ $viewFolder }}_prev_post_pe_findings_edema').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_post_pe_findings_edema').prop('checked', false);
            if(bookingObj.consultation.post_pe_findings.includes('Bleeding'))
              $('#{{ $viewFolder }}_prev_post_pe_findings_bleeding').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_post_pe_findings_bleeding').prop('checked', false);
            if(bookingObj.consultation.post_pe_findings.includes('Others'))
              $('#{{ $viewFolder }}_prev_post_pe_findings_others').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_post_pe_findings_others').prop('checked', false);
            $('#{{ $viewFolder }}_prev_post_pe_findings_ascites_text').val(bookingObj.consultation.post_pe_findings_ascites_text);
            $('#{{ $viewFolder }}_prev_post_pe_findings_edema_text').val(bookingObj.consultation.post_pe_findings_edema_text);
            $('#{{ $viewFolder }}_prev_post_pe_findings_others_text').val(bookingObj.consultation.post_pe_findings_others_text);
            
          }else{
            $('#{{ $viewFolder }}_prev_post_pe_findings_pallor').prop('checked', false);
            $('#{{ $viewFolder }}_prev_post_pe_findings_neck_vein').prop('checked', false);
            $('#{{ $viewFolder }}_prev_post_pe_findings_rhythm').prop('checked', false);
            $('#{{ $viewFolder }}_prev_post_pe_findings_rales').prop('checked', false);
            $('#{{ $viewFolder }}_prev_post_pe_findings_wheezing').prop('checked', false);
            $('#{{ $viewFolder }}_prev_post_pe_findings_breath_sounds').prop('checked', false);
            $('#{{ $viewFolder }}_prev_post_pe_findings_ascites').prop('checked', false);
            $('#{{ $viewFolder }}_prev_post_pe_findings_edema').prop('checked', false);
            $('#{{ $viewFolder }}_prev_post_pe_findings_bleeding').prop('checked', false);
            $('#{{ $viewFolder }}_prev_post_pe_findings_others').prop('checked', false);
            $('#{{ $viewFolder }}_prev_post_pe_findings_ascites_text').val('');
            $('#{{ $viewFolder }}_prev_post_pe_findings_edema_text').val('');
            $('#{{ $viewFolder }}_prev_post_pe_findings_others_text').val('');
          }

          if(bookingObj.consultation.vaccess != null){
            if(bookingObj.consultation.vaccess == 'left')
              $('#{{ $viewFolder }}_prev_vaccess_left').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_vaccess_left').prop('checked', false);
            if(bookingObj.consultation.vaccess == 'right')
              $('#{{ $viewFolder }}_prev_vaccess_right').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_vaccess_right').prop('checked', false);
            
          }else{  
            $('#{{ $viewFolder }}_prev_vaccess_left').prop('checked', false);
            $('#{{ $viewFolder }}_prev_vaccess_right').prop('checked', false);
            
          }

          if(bookingObj.consultation.vaccess_detail != null){
            if(bookingObj.consultation.vaccess_detail.includes('Fistula'))
              $('#{{ $viewFolder }}_prev_fistula').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_fistula').prop('checked', false);
            if(bookingObj.consultation.vaccess_detail.includes('Graft'))
              $('#{{ $viewFolder }}_prev_graft').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_graft').prop('checked', false);
            if(bookingObj.consultation.vaccess_detail.includes('CVC'))
              $('#{{ $viewFolder }}_prev_cvc').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_cvc').prop('checked', false);
          }else{
            $('#{{ $viewFolder }}_prev_fistula').prop('checked', false);
            $('#{{ $viewFolder }}_prev_graft').prop('checked', false);
            $('#{{ $viewFolder }}_prev_cvc').prop('checked', false);
            
          }
          if(bookingObj.consultation.av_fistula_detail != null){
            // alert(bookingObj.consultation.av_fistula_detail);
            if(bookingObj.consultation.av_fistula_detail.includes('Strong Thrill'))
              $('#{{ $viewFolder }}_prev_strong_thrill').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_strong_thrill').prop('checked', false);
            if(bookingObj.consultation.av_fistula_detail.includes('Strong Thrill'))
              $('#{{ $viewFolder }}_prev_weak_thrill').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_weak_thrill').prop('checked', false);
            if(bookingObj.consultation.av_fistula_detail.includes('Absent Thrill w/ Bruit'))
              $('#{{ $viewFolder }}_prev_absent_thrill_with').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_absent_thrill_with').prop('checked', false);
            if(bookingObj.consultation.av_fistula_detail.includes('Absent Thrill no Bruit'))
              $('#{{ $viewFolder }}_prev_absent_thrill_no').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_absent_thrill_no').prop('checked', false);
            $('#{{ $viewFolder }}_prev_needle_gauge').val(bookingObj.consultation.needle_gauge);
            $('#{{ $viewFolder }}_prev_number_commultation').val(bookingObj.consultation.number_commultation);
            
          }else{
            $('#{{ $viewFolder }}_prev_strong_thrill').prop('checked', false);
            $('#{{ $viewFolder }}_prev_weak_thrill').prop('checked', false);
            $('#{{ $viewFolder }}_prev_absent_thrill_with').prop('checked', false);
            $('#{{ $viewFolder }}_prev_absent_thrill_no').prop('checked', false);
            $('#{{ $viewFolder }}_prev_needle_gauge').val('');
            $('#{{ $viewFolder }}_prev_number_commultation').val('');
            
          }
          if(bookingObj.consultation.hd_catheter_detail != null){
            // alert(bookingObj.consultation.av_fistula_detail);
            if(bookingObj.consultation.hd_catheter_detail.includes('Both Patent'))
              $('#{{ $viewFolder }}_prev_both_patent').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_both_patent').prop('checked', false);
            if(bookingObj.consultation.hd_catheter_detail.includes('A Clotted'))
              $('#{{ $viewFolder }}_prev_a_clotted').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_a_clotted').prop('checked', false);
            if(bookingObj.consultation.hd_catheter_detail.includes('V Clotted'))
              $('#{{ $viewFolder }}_prev_v_clotted').prop('checked', true);
            else
              $('#{{ $viewFolder }}_prev_v_clotted').prop('checked', false);
            
            $('#{{ $viewFolder }}_prev_hd_catheter_remarks').val(bookingObj.consultation.hd_catheter_remarks);
            $('#{{ $viewFolder }}_prev_hd_catheter_hgb').val(bookingObj.consultation.hd_catheter_hgb);
            
          }else{
            $('#{{ $viewFolder }}_prev_both_patent').prop('checked', false);
            $('#{{ $viewFolder }}_prev_a_clotted').prop('checked', false);
            $('#{{ $viewFolder }}_prev_v_clotted').prop('checked', false);
            $('#{{ $viewFolder }}_prev_hd_catheter_remarks').val('');
            $('#{{ $viewFolder }}_prev_hd_catheter_hgb').val('');
            
          }

          if(bookingObj.consultation.rml != null){
            $('#{{ $viewFolder }}_prev_rml').val(bookingObj.consultation.rml);
          }else{
            $('#{{ $viewFolder }}_prev_rml').val('');
          }
          if(bookingObj.consultation.hepa != null){
            $('#{{ $viewFolder }}_prev_hepa').val(bookingObj.consultation.hepa);
          }else{
            $('#{{ $viewFolder }}_prev_hepa').val('');
          }
          if(bookingObj.consultation.iv_iron != null){
            $('#{{ $viewFolder }}_prev_iv_iron').val(bookingObj.consultation.iv_iron);
          }else{
            $('#{{ $viewFolder }}_prev_iv_iron').val('');
          }
          if(bookingObj.consultation.epo != null){
            $('#{{ $viewFolder }}_prev_epo').val(bookingObj.consultation.epo);
          }else{
            $('#{{ $viewFolder }}_prev_epo').val('');
          }
          if(bookingObj.consultation.hd_vac != null){
            $('#{{ $viewFolder }}_prev_hd_vac').val(bookingObj.consultation.hd_vac);
          }else{
            $('#{{ $viewFolder }}_prev_hd_vac').val('');
          }
          if(bookingObj.consultation.hd_endorsement != null){
            $('#{{ $viewFolder }}_prev_hd_endorsement').val(bookingObj.consultation.hd_endorsement);
          }else{
            $('#{{ $viewFolder }}_prev_hd_endorsement').val('');
          }
          if(bookingObj.consultation.shorten_min != null){
            $('#{{ $viewFolder }}_prev_shorten_min').val(bookingObj.consultation.shorten_min);
          }else{
            $('#{{ $viewFolder }}_prev_shorten_min').val('');
          }
          if(bookingObj.consultation.shorten_reason != null){
            $('#{{ $viewFolder }}_prev_shorten_reason').val(bookingObj.consultation.shorten_reason);
          }else{
            $('#{{ $viewFolder }}_prev_shorten_reason').val('');
          }
          $('#medTable{{ $datum->id }}').empty();
          $.each(bookingObj.consultation_meds, function(index, element){
            if(index == 0){
              $('#medTable{{ $datum->id }}').empty().append('<tr id=\'' + element.id + '\' log=\'meds\'><td></td><td>' + element.time_given + '</td><td>' + element.medication + '</td><td>' + element.dosage + '</td><td>' + element.creator.name + '</td></tr>');
            }else{
              $('#medTable{{ $datum->id }}').append('<tr id=\'' + element.id + '\' log=\'meds\'><td></td><td>' + element.time_given + '</td><td>' + element.medication + '</td><td>' + element.dosage + '</td><td>' + element.creator.name + '</td></tr>');
            }
          });
          $('#monTable{{ $datum->id }}').empty();
          $.each(bookingObj.consultation_monitorings, function(index, element){
            if(index == 0){
              $('#monTable{{ $datum->id }}').empty().append('<tr id=\'' + element.id + '\' log=\'moni\'><td></td><td>' + element.time_given + '</td><td>' + element.bpS + '/' + element.bpD + '</td><td>' + element.heart + 'BPM</td><td>' + element.o2 + '%</td><td>' + element.ap + '</td><td>' + element.vp + '</td><td>' + element.tmp + '</td><td>' + element.bfr + '</td><td>' + element.nss + '</td><td>' + element.ufr + '</td><td>' + element.ufv + '</td><td>' + element.remarks + '</td><td>' + element.creator.name + '</td></tr>');
            }else{
              $('#monTable{{ $datum->id }}').append('<tr id=\'' + element.id + '\' log=\'moni\'><td></td><td>' + element.time_given + '</td><td>' + element.bpS + '/' + element.bpD + '</td><td>' + element.heart + 'BPM</td><td>' + element.o2 + '%</td><td>' + element.ap + '</td><td>' + element.vp + '</td><td>' + element.tmp + '</td><td>' + element.bfr + '</td><td>' + element.nss + '</td><td>' + element.ufr + '</td><td>' + element.ufv + '</td><td>' + element.remarks + '</td><td>' + element.creator.name + '</td></tr>');
            }
          });
          $('#nurseNotesTable{{ $datum->id }}').empty();
          $.each(bookingObj.consultation_nurse_notes, function(index, element){
            if(index == 0){
              $('#nurseNotesTable{{ $datum->id }}').empty().append('<tr id=\'' + element.id + '\' log=\'nurseNotes\'><td></td><td>' + element.time_given + '</td><td>' + element.shorten_reason + '</td><td>' + element.creator.name + '</td></tr>');
            }else{
              $('#nurseNotesTable{{ $datum->id }}').append('<tr id=\'' + element.id + '\' log=\'nurseNotes\'><td></td><td>' + element.time_given + '</td><td>' + element.shorten_reason + '</td><td>' + element.creator.name + '</td></tr>');
            }
          });
          

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
    $("table.hdLogs").on("click", ".rowBtnDel", function ( event ) {
      if(!confirm('Are you sure you want to delete this?')){
        return false;
      }else{
        event.preventDefault();
        $(this).closest("tr").remove();
        $.ajax({
          type: 'GET',
          url: '{{ Route::has($viewFolder . '.deleteHDLogs') ? route($viewFolder . '.deleteHDLogs') : ''}}/' + $(this).closest("tr").attr("log") + '/' + $(this).closest("tr").attr("id"),
        });
      }
    });

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
