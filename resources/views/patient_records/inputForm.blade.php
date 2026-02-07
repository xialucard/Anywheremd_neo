@php
  unset($referal_conso);
  if(isset($datum->parent_consultation)){
    $referal_conso = $datum;
    $datum = $datum->parent_consultation;
  }
@endphp

<datalist id="patientNameList"></datalist>

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="card mb-3">
        <div class="card-header">Basic Information</div>
        <div class="card-body">
          <img src="{{ !empty($datum->profile_pic) ? (stristr($datum->profile_pic, 'uploads') ? asset('storage/' . $datum->profile_pic) : asset('storage/px_files/' . $datum->profile_pic)) : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" class="img-thumbnail float-start w-25 h-25 m-2" alt="">
          <p>
            <strong>Name:</strong> {{ !empty($datum->name) ? $datum->name : '' }} | 
            <strong>Age:</strong> {{ !empty($datum->birthdate) ? floor((strtotime(date('Y-m-d')) - strtotime($datum->birthdate))/(60*60*24*365.25)) : '' }} | 
            <strong>Birthday:</strong> {{ !empty($datum->birthdate) ? $datum->birthdate : '' }} | 
            <strong>Gender:</strong> {{ !empty($datum->gender) ? $datum->gender : '' }} | 
            <strong>Civil Status:</strong> {{ !empty($datum->civilStatus) ? $datum->civilStatus : '' }}<br>
            <strong>Address:</strong> {{ !empty($datum->address) ? $datum->address : '' }}<br>
            <strong>Email:</strong> {{ !empty($datum->email) ? $datum->email : '' }} | 
            <strong>Tel #:</strong> {{ !empty($datum->tel) ? $datum->tel : '' }} | 
            <strong>Mobile #:</strong> {{ !empty($datum->mobile_no) ? $datum->mobile_no : '' }}<br>
            <strong>Patient Type:</strong> {{ !empty($datum->patient_type) ? $datum->patient_type : '' }} | 
            <strong>Patient Sub Type: </strong>{{ !empty($datum->patient_sub_type) ? $datum->patient_sub_type . ' ' . $datum->referral_from : '' }}<br>
            <strong>Philhealth #: </strong>{{ !empty($datum->phil_num) ? $datum->phil_num : '' }} | 
            <strong>Philhealth Member Type:</strong> {{ !empty($datum->phil_mem_type) ? $datum->phil_mem_type : '' }}<br>
            <strong>HMO:</strong> {{ empty($datum->hmo) ? '' : $datum->health_org->name}} | 
            <strong>HMO #:</strong> {{ !empty($datum->hmo_num) ? $datum->hmo_num : '' }}<br>
            {{-- <strong>HMO:</strong> {{ !empty($datum->hmo) ? $datum->hmo : '' }} | 
            <strong>HMO #:</strong> {{ !empty($datum->hmo_num) ? $datum->hmo_num : '' }}<br> --}}
          </p>  
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card mb-3">
        <div class="card-header">Medical History</div>
        <div class="card-body">
          <p>
            <strong>Past Medical History:</strong> {{  !empty($datum->pastMedicalHistory) ? $datum->pastMedicalHistory : '' }}<br>
            @if(!empty($datum->pastMedicalHistory) && is_array(json_decode($datum->pastMedicalHistory)) && in_array('Cancer', json_decode($datum->pastMedicalHistory)))
            <strong>Cancer Details:</strong> {{ !empty($datum->pastMedicalHistoryCancer) ? $datum->pastMedicalHistoryCancer : '' }}<br>
            @endif
            @if(!empty($datum->pastMedicalHistory) && is_array(json_decode($datum->pastMedicalHistory)) && in_array('Others', json_decode($datum->pastMedicalHistory)))
            <strong>Others Details:</strong> {{ !empty($datum->pastMedicalHistoryOthers) ? $datum->pastMedicalHistoryOthers : '' }}<br>
            @endif
            <strong>Past Surgical History and Date:</strong> {{  !empty($datum->pastSurgicalHistory) ? $datum->pastSurgicalHistory : '' }}<br>
            <strong>Family History:</strong> {{ !empty($datum->pastSurgicalHistory) ? $datum->pastFamilyHistory : '' }}<br>
            @if(!empty($datum->pastFamilyHistory) && is_array(json_decode($datum->pastFamilyHistory)) && in_array('Cancer', json_decode($datum->pastFamilyHistory)))
            <strong>Cancer Details:</strong> {{ !empty($datum->pastFamilyHistoryCancer) ? $datum->pastFamilyHistoryCancer : '' }}<br>
            @endif
            @if(!empty($datum->pastFamilyHistory) && is_array(json_decode($datum->pastFamilyHistory)) && in_array('Others', json_decode($datum->pastFamilyHistory)))
            <strong>Others Details:</strong> {{ !empty($datum->pastFamilyHistoryOthers) ? $datum->pastFamilyHistoryOthers : '' }}<br>
            @endif
            <strong>Past Medication:</strong> {{ !empty($datum->pastMedication) ? $datum->pastMedication : '' }}<br>
            <strong>Present Medication:</strong> {{ !empty($datum->presentMedication) ? $datum->presentMedication : '' }}<br>
            <strong>Allergies:</strong> {{ !empty($datum->allergies) ? $datum->allergies : '' }}<br>
            @if(isset($datum->allergies) && is_array(json_decode($datum->allergies)) && in_array('Food', json_decode($datum->allergies)))
            <strong>Food Allergies:</strong> {{ !empty($datum->allergiesFood) ? $datum->allergiesFood : ''}}<br>
            @endif
            @if(isset($datum->allergies) && is_array(json_decode($datum->allergies)) && in_array('Medicine', json_decode($datum->allergies)))
            <strong>Medicine Allergies:</strong> {{ !empty($datum->allergiesMedicine) ? $datum->allergiesMedicine : '' }}<br>
            @endif
            @if(isset($datum->allergies) && is_array(json_decode($datum->allergies)) && in_array('Others', json_decode($datum->allergies)))
            <strong>Other Allergies:</strong> {{ !empty($datum->allergiesOthers) ? $datum->allergiesOthers : '' }}<br>
            @endif
          </p>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-4">
      <div class="card mb-3">
        <div class="card-header">Booking History</div>
        <div class="card-body table-responsive" style="max-height: 600px">
          <table class="table table-bordered table-striped table-hover table-sm">
            <thead class="table-{{ $bgColor }}">
                <tr>
                    <th class=""><i class="bi bi-gear"></i></th>
                    <th>Date</th>
                    <th>Parent Booking ID</th>
                    <th>Booking ID</th>
                    @if($user->user_type != 'Clinic')
                    <th>Clinic</th>
                    @endif
                    <th>Booking Type</th>
                    <th>Procedure Details</th>
                    @if($user->user_type != 'Doctor' || $user->specialty == 'POD')
                    <th>Doctor's Name</th>
                    <th>Remarks</th>
                    @endif
                    
                    <th>Status</th>
                </tr>
            </thead>
            @if(isset($datum->id))
            <tbody>
              @php
                if($user->user_type == 'Clinic')
                  $bookings = $datum->consultations()->where('clinic_id', $user->clinic_id)->orderByDesc('bookingDate')->get();
                elseif($user->user_type == 'Doctor'){
                  if($user->specialty == "POD")
                    $bookings = $datum->consultations()->whereIn('clinic_id', $doctorClinic)->orderByDesc('bookingDate')->get();
                  else
                    $bookings = $datum->consultations()->where('doctor_id', $user->id)->where('clinic_id', $clinic_id)->orderByDesc('bookingDate')->get();
                }else
                  $bookings = $datum->consultations()->orderByDesc('bookingDate')->get();
              @endphp
              @foreach($bookings as $ind=>$dat)
                <tr>
                  <td>
                    <div class="d-sm-flex flex-sm-row">
                      <div class="m-1"><a class="btn btn-{{ $bgColor }} btn-sm w-100" href="#" title="View" role="button" onclick="loadPrevBooking({{ $dat->id }}, {{ $ind }})"><i class="bi bi-binoculars"></i><span class="ps-1 d-sm-none">View</span></a></div>
                    </div>
                  </td>
                  <td>{{ $dat->bookingDate }}</td>
                  <td>{{ $dat->consultation_parent_id }}</td>
                  <td>{{ $dat->id }}</td>
                  @if($user->user_type != 'Clinic')
                  <td>{{ $dat->clinic->name }}</td>
                  @endif
                  <td>{{ $dat->booking_type == '' ? 'Consultation' : $dat->booking_type }}</td>
                  {{-- <td>{{ $dat->patient->name }}</td> --}}
                  <td>{{ $dat->procedure_details }}</td>
                  @if($user->user_type != 'Doctor' || $user->specialty == 'POD')
                  <td>{{ $dat->doctor->name }}</td>
                  <td>{{ $dat->others }}</td>
                  @endif
                  <td>{{ $dat->status }}</td>
                </tr>
              @endforeach
            </tbody>
            @endif
          </table>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      @if(isset($bookings[0]))
      <div class="card mb-3">
        <div class="card-header">Past Patient's Chart (<span id="prevBookingDater">{{ $bookings[0]->id . ' - ' . $bookings[0]->bookingDate }}</span>)</div>
        <div class="card-body">
          <ul class="nav nav-pills mb-3" id="referral_list">
            <li class="nav-item">
              <a class="nav-link docNotesLink active" href="#" onclick="loadPrevBooking({{ $bookings[0]->id }}, 0)">{{ 'Dr. ' . Str::substr($bookings[0]->doctor->f_name, 0, 1) . '. ' . $bookings[0]->doctor->l_name . ' - ' . $bookings[0]->clinic->name . ' | ' . ($bookings[0]->booking_type == '' ? 'Consultation' : $bookings[0]->booking_type)}}</a>
            </li>
            
            @if(isset($bookings[0]->consultation_referals[0]->id))
              @foreach($bookings[0]->consultation_referals as $cr)
            <li class="nav-item">
              <a class="nav-link docNotesLink" id="{{ $viewFolder }}_doctorLink_{{ $cr->id }}" href="#"  onclick="loadPrevBooking({{ $cr->id }}, 0)">{{'Dr. ' . Str::substr($cr->doctor->f_name, 0, 1) . '. ' . $cr->doctor->l_name . ' - ' . $cr->clinic->name . ' | ' . ($cr->booking_type == '' ? 'Consultation' : $cr->booking_type) }}</a>
            </li>
              @endforeach
            @endif
          </ul>
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
          <div class="card mb-3" id="eyeExam" {{ stristr($bookings[0]->doctor->specialty, 'Ophtha') ? '' : 'style=display:none' }}>
            <div class="card-header">Eye Examination Information</div>
            <div class="card-body">
              {{-- <p id="prevEyerBack">
                <strong>AR OD:</strong> <span class="text-primary">{{ $bookings[0]->arod_sphere != 'No Target' ? $bookings[0]->arod_sphere . ' - ' . $bookings[0]->arod_cylinder . ' x ' . $bookings[0]->arod_axis : $bookings[0]->arod_sphere }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>AR OS:</strong> <span class="text-primary">{{ $bookings[0]->aros_sphere != 'No Target' ? $bookings[0]->aros_sphere . ' - ' . $bookings[0]->aros_cylinder . ' x ' . $bookings[0]->aros_axis : $bookings[0]->aros_sphere }}</span><br>
                <strong>UCVA OD:</strong> <span class="text-primary">{{ $bookings[0]->vaod_den != '' ? $bookings[0]->vaod_num . ' / ' . $bookings[0]->vaod_den : $bookings[0]->vaod_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>UCVA OD w/ Correction:</strong> <span class="text-primary">{{ $bookings[0]->vaodcor_den != '' ? $bookings[0]->vaodcor_num . ' / ' . $bookings[0]->vaodcor_den : $bookings[0]->vaodcor_num }}</span><br>
                <strong>UCVA OS:</strong> <span class="text-primary">{{ $bookings[0]->vaos_den != '' ? $bookings[0]->vaos_num . ' / ' . $bookings[0]->vaos_den : $bookings[0]->vaos_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>UCVA OS w/ Correction:</strong> <span class="text-primary">{{ $bookings[0]->vaoscor_den != '' ? $bookings[0]->vaoscor_num . ' / ' . $bookings[0]->vaoscor_den : $bookings[0]->vaoscor_num }}</span><br>
                <strong>BCVA OD:</strong> <span class="text-primary">{{ $bookings[0]->pinod_den != '' ? $bookings[0]->pinod_num . ' / ' . $bookings[0]->pinod_den : $bookings[0]->pinod_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>BCVA OD w/ Correction:</strong> <span class="text-primary">{{ $bookings[0]->pinodcor_den != '' ? $bookings[0]->pinodcor_num . ' / ' . $bookings[0]->pinodcor_den : $bookings[0]->pinodcor_num }}</span><br>
                <strong>BCVA OS:</strong> <span class="text-primary">{{ $bookings[0]->pinos_den != '' ? $bookings[0]->pinos_num . ' / ' . $bookings[0]->pinos_den : $bookings[0]->pinos_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>BCVA OS w/ Correction:</strong> <span class="text-primary">{{ $bookings[0]->pinoscor_den != '' ? $bookings[0]->pinoscor_num . ' / ' . $bookings[0]->pinoscor_den : $bookings[0]->pinoscor_num }}</span><br>
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
            <li class="nav-item" id="dChart" @if($bookings[0]->booking_type == 'Dialysis') style="display:block" @else style="display:none" @endif>
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
            {{-- <li class="nav-item">
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
              ">HD Summary Sheet</a>
            </li> --}}
            
          </ul>
          {{-- <div id="hdSum" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            @can('clinics_home.pdfHDSum')
              <div class="m-1"><a id="printLinkID" class="btn btn-{{ $bgColor }} btn-sm w-100 printLink" href="{{ route('clinics_home.pdfHDSum', [isset($referal_conso) ? $referal_conso->id : $bookings[0]->id, !empty(parse_url(Request::fullUrl())['query']) ? parse_url(Request::fullUrl())['query'] : '']) }}" title="Print HD Summary Sheet" role="button" download><i class="bi bi-file-pdf-fill"></i><span class="ps-1 d-sm-none">Print HD Summary Sheet</span></a></div>
            @endcan
            <div class="table-responsive" style="max-height: 300px">
              <table class="table table-bordered table-striped table-hover table-sm medsOn">
                <thead class="table-{{ $bgColor }}">
                  <tr>
                    <th>Tx No.</th>
                    <th>Date</th>
                    <th>Dialyzer/Use No.</th>
                    <th>EDW</th>
                    <th>Pre HD Weight (kg)</th>
                    <th>Post HD Weight (kg)</th>
                    <th>Pre HD BP</th>
                    <th>Post HD BP</th>
                    <th>UF Goal</th>
                    <th>WT. Loss</th>
                    <th>EPO Inj.</th>
                    <th>Iron</th>
                    <th>Dialysis Complication</th>
                    <th>Remarks/NOD</th>
                  </tr>
                </thead>
                <tbody id="medsOnboardTable{{ $datum->id }}">
                @if(isset($allBooking))
                  @foreach ($allBooking as $ind=>$dat)
                  <tr id="hdBooking_{{ $dat->id }}">
                      <td>{{ $dat->treatment_number }}</td>
                      <td>{{ $dat->bookingDate }}</td>
                      <td>{{ $dat->dialyzer . '/' . $dat->use }}</td>
                      <td>{{ $dat->dry_weight }}<</td>
                      <td>{{ $dat->weight }}</td>
                      <td>{{ $dat->post_weight }}</td>
                      <td>{{ $dat->bpS . '/' . $dat->bpD }}</td>
                      <td>{{ $dat->post_bpS . '/' . $dat->post_bpD }}</td>
                      <td>{{ $dat->total_uf_goal }}</td>
                      <td>{{ $dat->weight_loss }}</td>
                      <td>{{ $dat->epo }}</td>
                      <td>{{ $dat->iv_iron }}</td>
                      <td>{{ nl2br($dat->dialysis_complication) }}</td>
                  </tr>
                  @endforeach
                @endif
                </tbody>
              </table>
            </div>
          </div> --}}
          <div id="sumCurDiv" class="container border border-1 border-top-0 mb-3 p-3">
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
                @if($bookings[0]->booking_type == 'Dialysis')
                <p>
                  <strong>Plan:</strong><br><div class="m-3" id="{{ $viewFolder }}_prev_sum_planMed">{!! isset($bookings[0]->planMed) ? nl2br($bookings[0]->planMed) : '' !!}</div><br>
                  <strong>Current Meds Onboard:</strong>
                  <div class="table-responsive" style="max-height: 300px">
                    <table class="table table-bordered table-striped table-hover table-sm medsOn">
                      <thead class="table-{{ $bgColor }}">
                        <tr>
                          <th>Meds</th>
                          <th>Dose</th>
                          <th>Delivery</th>
                          <th>Duration</th>
                        </tr>
                      </thead>
                      <tbody id="medsOnboardTable{{ $bookings[0]->id }}">
                      @foreach ($bookings[0]->consultation_meds_onboards()->orderBy('id', 'desc')->get() as $dat)
                        <tr id="{{ $dat->id }}" log="medsOnboards">
                            <td>{{ $dat->meds }}</td>
                            <td>{{ $dat->dose }}</td>
                            <td>{{ $dat->delivery }}</td>
                            <td>{{ $dat->duration }}</td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </p>
                @else
                <p>
                  <strong>Medical Therapeutics:</strong><br><div class="m-3" id="{{ $viewFolder }}_prev_sum_planMed">{!! nl2br(isset($bookings[0]->planMed) ? $bookings[0]->planMed : '') !!}</div><br>
                  <strong>Diagnostics and Surgery:</strong><br><div class="m-3" id="{{ $viewFolder }}_prev_sum_plan">{!! nl2br(isset($bookings[0]->plan) ? $bookings[0]->plan : '') !!}</div><br>
                  <strong>Remarks:</strong><br><div class="m-3" id="{{ $viewFolder }}_prev_sum_planRem">{!! nl2br(isset($bookings[0]->planRem) ? $bookings[0]->planRem : '') !!}</div><br>
                </p>
                @endif
              </div>
            </div>
          </div>
          <div id="soapPrevDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            <div class="card mb-3">
              <div class="card-header">Procedure</div>
              <div class="card-body" style="height: 1in; max-height: 1in">
                <p id="prevProcDet">{{ $bookings[0]->procedure_details }}</p>
              </div>
            </div>
            <div class="card mb-3">
              <div class="card-header">Patient's Complaint</div>
              <div class="card-body" style="height: 1in; max-height: 1in">
                <p id="prevPatComp">{{ $bookings[0]->complain }}</p>
                <small class="text-muted" id="prevPatCompDur">{{ $bookings[0]->duration }}</small>
              </div>
            </div>
            {{-- <ul class="nav nav-pills mb-3">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">{{ $user->name == $bookings[0]->doctor->name ? 'Yours' : 'Dr. ' . Str::substr($bookings[0]->doctor->f_name, 0, 1) . '. ' . $bookings[0]->doctor->l_name }}</a>
              </li>
            </ul> --}}
            <div class="card mb-3">
              <div class="card-header">Doctor's Notes</div>
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
                  <div class="card-header">Subjective Complaints</div>
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
                  <div class="card-header">Objective Findings</div>
                  <div class="card-body">
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
              <div class="card-header">Assessment</div>
              <div class="card-body">
                <div class="form-floating mb-3">
                  <select class="form-select" name="{{ $viewFolder }}[icd_code]" id="{{ $viewFolder }}_icd_code" placeholder="" disabled>
                    <option value=""></option>
                  </select>
                  <label for="{{ $viewFolder }}_icd_code">Primary Diagnosis</label>
                  <small id="help_{{ $viewFolder }}_icd_code" class="text-muted"></small>
                </div>
                <div class="card mb-3">
                  <div class="card-header">Secondary Diagnosis</div>
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
              <div class="card-header">Plan</div>
              <div class="card-body">
                @if($bookings[0]->booking_type == 'Dialysis')
                <div class="card mb-3">
                  <div class="card-header">Plan</div>
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
                  <div class="card-header">Current Meds Onboard</div>
                  <div class="card-body">
                    <div class="table-responsive" style="max-height: 300px">
                      <table class="table table-bordered table-striped table-hover table-sm medsOn">
                        <thead class="table-{{ $bgColor }}">
                          <tr>
                            <th>Meds</th>
                            <th>Dose</th>
                            <th>Delivery</th>
                            <th>Duration</th>
                          </tr>
                        </thead>
                        <tbody id="medsOnboardTable{{ $bookings[0]->id }}">
                        @foreach ($bookings[0]->consultation_meds_onboards()->orderBy('id', 'desc')->get() as $dat)
                          <tr id="{{ $dat->id }}" log="medsOnboards">
                              <td>{{ $dat->meds }}</td>
                              <td>{{ $dat->dose }}</td>
                              <td>{{ $dat->delivery }}</td>
                              <td>{{ $dat->duration }}</td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                @else
                <div class="card mb-3">
                  <div class="card-header">Medical Therapeutics</div>
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
                  <div class="card-header">Diagnostics and Surgery</div>
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
                  <div class="card-header">Remarks</div>
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
                @endif
              </div>
            </div>
          </div>
          <div id="labPrevDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            <div id="carouselPrev" class="carousel carousel-dark slide" data-bs-ride="true">
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
                  @if(stristr($file->file_type, 'pdf'))
                <div class="carousel-item {{ $ind == 0 ? 'active' : '' }}">
                  <iframe src="{{stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" class="d-block w-100" alt=""></iframe>
                </div>
                  @else
                <div class="carousel-item {{ $ind == 0 ? 'active' : '' }}">
                  <img src="{{stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" class="d-block w-100" alt="">
                </div>
                  @endif
                  @endforeach
                @endif
                @if(!empty($bookings[0]->anesthesia_files[0]->file_link))
                  @foreach($bookings[0]->anesthesia_files as $file)
                  @php
                    $ind++;
                    $key = true;
                  @endphp
                  @if(stristr($file->file_type, 'pdf'))
                <div class="carousel-item {{ $ind == 0 ? 'active' : '' }}">
                  <iframe src="{{stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" class="d-block w-100" alt=""></iframe>
                </div>
                  @else
                <div class="carousel-item {{ $ind == 0 ? 'active' : '' }}">
                  <img src="{{stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" class="d-block w-100" alt="">
                </div>
                  @endif
                  @endforeach
                @endif
                @if(!empty($bookings[0]->doctor_files[0]->file_link))
                  @foreach($bookings[0]->doctor_files as $file)
                  @php
                    $ind++;
                    $key = true;
                  @endphp
                  @if(stristr($file->file_type, 'pdf'))
                <div class="carousel-item {{ $ind == 0 ? 'active' : '' }}">
                  <iframe src="{{stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" class="d-block w-100" alt=""></iframe>
                </div>
                  @else
                <div class="carousel-item {{ $ind == 0 ? 'active' : '' }}">
                  <img src="{{stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" class="d-block w-100" alt="">
                </div>
                  @endif
                  @endforeach
                @endif
                @if(!empty($bookings[0]->prescription_files[0]->file_link))
                  @foreach($bookings[0]->prescription_files as $file)
                  @php
                    $ind++;
                    $key = true;
                  @endphp
                  @if(stristr($file->file_type, 'pdf'))
                <div class="carousel-item {{ $ind == 0 ? 'active' : '' }}">
                  <iframe src="{{stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" class="d-block w-100" alt=""></iframe>
                </div>
                  @else
                <div class="carousel-item {{ $ind == 0 ? 'active' : '' }}">
                  <img src="{{stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" class="d-block w-100" alt="">
                </div>
                  @endif
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
          </div>
          <div id="presPrevDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            <div class="card mb-3">
              <div class="card-header">Prescription Preview</div>
              <div class="card-body">
                <iframe id="iframePrevPresc" src="{{ file_exists(public_path('storage/prescription_files/' . $bookings[0]->id . '_' . trim($bookings[0]->patient->l_name) . '.pdf')) ? asset('storage/prescription_files/' . $bookings[0]->id . '_' . trim($bookings[0]->patient->l_name) . '.pdf') : (file_exists(public_path('storage/uploads/prescription_files/' . $bookings[0]->id . '_' . trim($bookings[0]->patient->l_name) . '.pdf')) ? asset('storage//uploads/prescription_files/' . $bookings[0]->id . '_' . trim($bookings[0]->patient->l_name) . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg') }}" width="100%" height="300" style="border:1"></iframe>
                <small class="form-text text-muted">To print or download go to Tools</small>
              </div>
            </div>
          </div>
          <div id="medPrevDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            <div class="card mb-3">
              <div class="card-header">Med Cert Preview</div>
              <div class="card-body">
                <iframe id="iframePrevMedCert" src="{{ file_exists(public_path('storage/med_cert_files/' . $bookings[0]->id . '_' . trim($bookings[0]->patient->l_name) . '.pdf')) ? asset('storage/med_cert_files/' . $bookings[0]->id . '_' . trim($bookings[0]->patient->l_name) . '.pdf') : (file_exists(public_path('storage/uploads/med_cert_files/' . $bookings[0]->id . '_' . trim($bookings[0]->patient->l_name) . '.pdf')) ? asset('storage//uploads/med_cert_files/' . $bookings[0]->id . '_' . trim($bookings[0]->patient->l_name) . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg') }}" width="100%" height="300" style="border:1"></iframe>
                <small class="form-text text-muted">To print or download go to Tools</small>
              </div>
            </div>
          </div>
          <div id="admitPrevDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            <div class="card mb-3">
              <div class="card-header">Admitting Orders Preview</div>
              <div class="card-body">
                <iframe id="iframePrevAdmitting" src="{{ file_exists(public_path('storage/admitting_order_files/' . $bookings[0]->id . '_' . trim($bookings[0]->patient->l_name) . '.pdf')) ? asset('storage/admitting_order_files/' . $bookings[0]->id . '_' . trim($bookings[0]->patient->l_name) . '.pdf') : (file_exists(public_path('storage/uploads/admitting_order_files/' . $bookings[0]->id . '_' . trim($bookings[0]->patient->l_name) . '.pdf')) ? asset('storage//uploads/admitting_order_files/' . $bookings[0]->id . '_' . trim($bookings[0]->patient->l_name) . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg') }}" width="100%" height="300" style="border:1"></iframe>
                <small class="form-text text-muted">To print or download go to Tools</small>
              </div>
            </div>
          </div>
          <div id="dialysisPrevDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            {{-- @if(isset($bookings[0]->booking_type) && $bookings[0]->booking_type == 'Dialysis') --}}
            @if(isset($bookings[0]->booking_type))
            {{-- @can('clinics_home.pdfHD') --}}
            <div class="m-1"><a id="printLinkID" class="btn btn-{{ $bgColor }} btn-sm w-100 printLink" href="{{ route('clinics_home.pdfHD', [isset($referal_conso) ? $referal_conso->id : $bookings[0]->id, !empty(parse_url(Request::fullUrl())['query']) ? parse_url(Request::fullUrl())['query'] : '']) }}" title="Print HD Form" role="button" download><i class="bi bi-filetype-pdf"></i><span class="ps-1 d-sm-none">Print HD Form</span></a></div>
            {{-- @endcan --}}
            <div class="row mt-3">
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
                        <input class="form-control" type="number" name="{{ $viewFolder }}[dry_weight]" min=1 step=.1 id="{{ $viewFolder }}_prev_dry_weight" value="{{ isset($bookings[0]->dry_weight) ? $bookings[0]->dry_weight : ''}}" placeholder="" disabled>
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
                        <input class="form-control" type="text" name="{{ $viewFolder }}[weight_loss]" id="{{ $viewFolder }}_prev_weight_loss" value="{{ isset($bookings[0]->weight_loss) ? $bookings[0]->weight_loss : ''}}" placeholder="" disabled>
                        <label for="{{ $viewFolder }}_prev_weight_loss" class="form-label">Weight Loss</label>
                        <small id="help_{{ $viewFolder }}_prev_weight_loss" class="text-muted"></small>
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
              <div class="col-lg-{{ true ? 6 : 12 }}">
                <div class="card mb-3">
                  <div class="card-header">{{ isset($bookings[0]->booking_type) ? 'Pre-HD ' : '' }}Vitals</div>
                  <div class="card-body">
                    <div class="input-group mb-3">
                      <div class="form-floating">
                        <input class="form-control" type="number" name="{{ $viewFolder }}[temp]" min=30 step=.1 id="{{ $viewFolder }}_prev_temp" value="{{ isset($bookings[0]->temp) ? $bookings[0]->temp : ''}}" placeholder="" {{ isset($bookings[0]->id) ? '' : '' }} disabled>
                        <label for="{{ $viewFolder }}_prev_temp" class="form-label">Temperature</label>
                        <small id="help_{{ $viewFolder }}_prev_temp" class="text-muted"></small>
                      </div>
                      <span class="input-group-text">C</span>
                    </div>
                    {{-- @if(isset($bookings[0]->booking_type)) --}}
                    @if(false)
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
                    @if(isset($bookings[0]->booking_type))
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
              {{-- @if(isset($bookings[0]->booking_type) && $bookings[0]->booking_type == 'Dialysis') --}}
              @if(isset($bookings[0]->booking_type))
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
                    {{-- @if(isset($bookings[0]->booking_type) && $bookings[0]->booking_type != 'Dialysis') --}}
                    @if(false)
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
            {{-- @if(isset($bookings[0]->booking_type) && $bookings[0]->booking_type == 'Dialysis') --}}
            @if(isset($bookings[0]->booking_type))
            
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
                      {{-- <div class="form-check">
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
                      </div> --}}
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[prev_ambulation_status_j][]" value="ambulatory" id="{{ $viewFolder }}_prev_ambulation_status_ambulatory" {{ (isset($bookings[0]->ambulation_status_j) && is_array(json_decode($bookings[0]->ambulation_status_j)) && in_array('ambulatory', json_decode($bookings[0]->ambulation_status_j))) ? 'checked' : ((isset($bookings[0]->ambulation_status) && $bookings[0]->ambulation_status == 'ambulatory') ? 'checked' : '') }} disabled>
                        <label class="form-check-label" for="{{ $viewFolder }}_prev_ambulation_status_ambulatory">ambulatory</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[prev_ambulation_status_j][]" value="w/ assistance" id="{{ $viewFolder }}_prev_ambulation_status_assistance" {{ (isset($bookings[0]->ambulation_status_j) && is_array(json_decode($bookings[0]->ambulation_status_j)) && in_array('w/ assistance', json_decode($bookings[0]->ambulation_status_j))) ? 'checked' : ((isset($bookings[0]->ambulation_status) && $bookings[0]->ambulation_status == 'w/ assistance') ? 'checked' : '') }} disabled>
                        <label class="form-check-label" for="{{ $viewFolder }}_prev_ambulation_status_assistance">w/ assistance</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[prev_ambulation_status_j][]" value="wheelchair" id="{{ $viewFolder }}_prev_ambulation_status_wheelchair" {{ (isset($bookings[0]->ambulation_status_j) && is_array(json_decode($bookings[0]->ambulation_status_j)) && in_array('wheelchair', json_decode($bookings[0]->ambulation_status_j))) ? 'checked' : ((isset($bookings[0]->ambulation_status) && $bookings[0]->ambulation_status == 'wheelchair') ? 'checked' : '') }} disabled>
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
                      {{-- <div class="form-check">
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
                      </div> --}}
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[prev_post_ambulation_status_j][]" value="ambulatory" id="{{ $viewFolder }}_prev_post_ambulation_status_ambulatory" {{ (isset($bookings[0]->post_ambulation_status_j) && is_array(json_decode($bookings[0]->post_ambulation_status_j)) && in_array('ambulatory', json_decode($bookings[0]->post_ambulation_status_j))) ? 'checked' : ((isset($bookings[0]->post_ambulation_status) && $bookings[0]->post_ambulation_status == 'ambulatory') ? 'checked' : '') }} disabled>
                        <label class="form-check-label" for="{{ $viewFolder }}_prev_post_ambulation_status_ambulatory">ambulatory</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[prev_post_ambulation_status_j][]" value="w/ assistance" id="{{ $viewFolder }}_prev_post_ambulation_status_assistance" {{ (isset($bookings[0]->post_ambulation_status_j) && is_array(json_decode($bookings[0]->post_ambulation_status_j)) && in_array('w/ assistance', json_decode($bookings[0]->post_ambulation_status_j))) ? 'checked' : ((isset($bookings[0]->post_ambulation_status) && $bookings[0]->post_ambulation_status == 'w/ assistance') ? 'checked' : '') }} disabled>
                        <label class="form-check-label" for="{{ $viewFolder }}_prev_post_ambulation_status_assistance">w/ assistance</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[prev_post_ambulation_status_j][]" value="wheelchair" id="{{ $viewFolder }}_prev_post_ambulation_status_wheelchair" {{ (isset($bookings[0]->post_ambulation_status_j) && is_array(json_decode($bookings[0]->post_ambulation_status_j)) && in_array('wheelchair', json_decode($bookings[0]->post_ambulation_status_j))) ? 'checked' : ((isset($bookings[0]->post_ambulation_status) && $bookings[0]->post_ambulation_status == 'wheelchair') ? 'checked' : '') }} disabled>
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
                          {{-- <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $viewFolder }}[prev_vaccess]" value="left" id="{{ $viewFolder }}_prev_vaccess_left" {{ (isset($bookings[0]->vaccess) && $bookings[0]->vaccess == 'left') ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_vaccess_left">left</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="{{ $viewFolder }}[prev_vaccess]" value="right" id="{{ $viewFolder }}_prev_vaccess_right" {{ (isset($bookings[0]->vaccess) && $bookings[0]->vaccess == 'right') ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_vaccess_right">right</label>
                          </div> --}}
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[prev_vaccess_j][]" value="left" id="{{ $viewFolder }}_prev__vaccess_left" {{ (isset($bookings[0]->vaccess_j) && is_array(json_decode($bookings[0]->vaccess_j)) && in_array('left', json_decode($bookings[0]->vaccess_j))) ? 'checked' : ((isset($bookings[0]->vaccess) && $bookings[0]->vaccess == 'left') ? 'checked' : '') }} disabled>
                            <label class="form-check-label" for="{{ $viewFolder }}_prev_vaccess_left">left</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[prev_vaccess_j][]" value="right" id="{{ $viewFolder }}_prev_vaccess_right" {{ (isset($bookings[0]->vaccess_j) && is_array(json_decode($bookings[0]->vaccess_j)) && in_array('right', json_decode($bookings[0]->vaccess_j))) ? 'checked' : ((isset($bookings[0]->vaccess) && $datum->vaccess == 'right') ? 'checked' : '') }} disabled>
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
                                $('#addMedLog{{ $bookings[0]->id }}').prop('disabled', false);
                              else
                                $('#addMedLog{{ $bookings[0]->id }}').prop('disabled', true);
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
                                $('#addMedLog{{ $bookings[0]->id }}').prop('disabled', false);
                              else
                                $('#addMedLog{{ $bookings[0]->id }}').prop('disabled', true);
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
                                $('#addMedLog{{ $bookings[0]->id }}').prop('disabled', false);
                              else
                                $('#addMedLog{{ $bookings[0]->id }}').prop('disabled', true);
                            ">
                            <label for="{{ $viewFolder }}_dosage" class="form-label">Dosage</label>
                            <small id="help_{{ $viewFolder }}_dosage" class="text-muted"></small>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <button id="addMedLog{{ $bookings[0]->id }}" type="button" class="addMedLog btn btn-{{ $bgColor }} btn-sm" disabled onclick="
                          $.ajax({
                            type: 'POST',
                            data: $('#bookMod').serialize(),
                            url: '{{ Route::has($viewFolder . '.' . $formAction) ? route($viewFolder . '.' . $formAction, $bookings[0]->id) : ''}}',
                            success:
                            function (){
                                $.ajax({
                                  type: 'GET',
                                  url: '{{ Route::has($viewFolder . '.getMedTable') ? route($viewFolder . '.getMedTable', $bookings[0]->id) : '' }}',
                                  success:
                                  function (data){
                                    medObj = jQuery.parseJSON(data);
                                    var tr;
                                    medObj.forEach(function (item, index){
                                      tr += '<tr id=\'' + item.id + '\' log=\'meds\'><td><div class=\'d-sm-flex flex-sm-row\'><div class=\'m-1\'><button type=\'submit\' class=\'btn btn-{{ $bgColor }} btn-sm w-100 rowBtnDel\'><i class=\'bi bi-trash\'></i><span class=\'ps-1 d-sm-none\'>Delete</span></button></div></div></td><td>' + item.time_given + '</td><td>' + item.medication + '</td><td>' + item.dosage + '</td><td>' + item.creator + '</td></tr>';
                                    });
                                    $('#medTable{{ $bookings[0]->id }}').html(tr);
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
                        <tbody id="medTable{{ $bookings[0]->id }}">
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
                                $('#addMonLog{{ $bookings[0]->id }}').prop('disabled', false);
                              }else
                                $('#addMonLog{{ $bookings[0]->id }}').prop('disabled', true);
                            ">
                                <label for="{{ $viewFolder }}_mon_time" class="form-label">Time</label>
                                <small id="help_{{ $viewFolder }}_mon_time" class="text-muted"></small>
                              </div>
                            </div>
                            <label for="{{ $viewFolder }}_bpS" class="form-label">BP</label>
                            <div class="input-group mb-3">
                              <input class="form-control" type="number" name="{{ $viewFolder }}[Monitoring][bpS]" min=50 max=250 step=1 id="{{ $viewFolder }}_mon_bpS" placeholder="Systolic" {{ isset($bookings[0]->id) ? '' : '' }} onchange="
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
                              <input class="form-control" type="number" name="{{ $viewFolder }}[Monitoring][bpD]" min=30 max=150 step=1 id="{{ $viewFolder }}_mon_bpD" placeholder="Diastolic" {{ isset($bookings[0]->id) ? '' : '' }} onchange="
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
                                <input class="form-control" type="number" name="{{ $viewFolder }}[Monitoring][heart]" min=1 id="{{ $viewFolder }}_mon_heart" placeholder="" {{ isset($bookings[0]->id) ? '' : '' }} onchange="
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
                                <input class="form-control" type="number" name="{{ $viewFolder }}[Monitoring][o2]" min=1 id="{{ $viewFolder }}_mon_o2" placeholder="" {{ isset($bookings[0]->id) ? '' : '' }} onchange="
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
                                $('#addMonLog{{ $bookings[0]->id }}').prop('disabled', false);
                              }else
                                $('#addMonLog{{ $bookings[0]->id }}').prop('disabled', true);
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
                                $('#addMonLog{{ $bookings[0]->id }}').prop('disabled', false);
                              }else
                                $('#addMonLog{{ $bookings[0]->id }}').prop('disabled', true);
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
                                $('#addMonLog{{ $bookings[0]->id }}').prop('disabled', false);
                              }else
                                $('#addMonLog{{ $bookings[0]->id }}').prop('disabled', true);
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
                                $('#addMonLog{{ $bookings[0]->id }}').prop('disabled', false);
                              }else
                                $('#addMonLog{{ $bookings[0]->id }}').prop('disabled', true);
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
                                $('#addMonLog{{ $bookings[0]->id }}').prop('disabled', false);
                              }else
                                $('#addMonLog{{ $bookings[0]->id }}').prop('disabled', true);
                            ">
                                <label for="{{ $viewFolder }}_mon_bfr" class="form-label">BFR</label>
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
                                $('#addMonLog{{ $bookings[0]->id }}').prop('disabled', false);
                              }else
                                $('#addMonLog{{ $bookings[0]->id }}').prop('disabled', true);
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
                                $('#addMonLog{{ $bookings[0]->id }}').prop('disabled', false);
                              }else
                                $('#addMonLog{{ $bookings[0]->id }}').prop('disabled', true);
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
                                $('#addMonLog{{ $bookings[0]->id }}').prop('disabled', false);
                              }else
                                $('#addMonLog{{ $bookings[0]->id }}').prop('disabled', true);
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
                                $('#addMonLog{{ $bookings[0]->id }}').prop('disabled', false);
                              }else
                                $('#addMonLog{{ $bookings[0]->id }}').prop('disabled', true);
                            ">
                                <label for="{{ $viewFolder }}_mon_remarks" class="form-label">Remarks</label>
                                <small id="help_{{ $viewFolder }}_mon_remarks" class="text-muted"></small>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <button id="addMonLog{{ $bookings[0]->id }}" type="button" class="addMonLog btn btn-{{ $bgColor }} btn-sm" disabled onclick="
                          $.ajax({
                            type: 'POST',
                            data: $('#bookMod').serialize(),
                            url: '{{ Route::has($viewFolder . '.' . $formAction) ? route($viewFolder . '.' . $formAction, $bookings[0]->id) : ''}}',
                            success:
                            function (){
                                $.ajax({
                                  type: 'GET',
                                  url: '{{ Route::has($viewFolder . '.getMonTable') ? route($viewFolder . '.getMonTable', $bookings[0]->id) : '' }}',
                                  success:
                                  function (data){
                                    medObj = jQuery.parseJSON(data);
                                    var tr;
                                    medObj.forEach(function (item, index){
                                      tr += '<tr id=\'' + item.id + '\' log=\'moni\'><td><div class=\'d-sm-flex flex-sm-row\'><div class=\'m-1\'><button type=\'submit\' class=\'btn btn-{{ $bgColor }} btn-sm w-100 rowBtnDel\'><i class=\'bi bi-trash\'></i><span class=\'ps-1 d-sm-none\'>Delete</span></button></div></div></td><td>' + item.time_given + '</td><td>' + item.bpS + '/' + item.bpD + '</td><td>' + item.heart + 'BPM</td><td>' + item.o2 + '%</td><td>' + item.ap + '</td><td>' + item.vp + '</td><td>' + item.tmp + '</td><td>' + item.bfr + '</td><td>' + item.nss + '</td><td>' + item.ufr + '</td><td>' + item.ufv + '</td><td>' + item.remarks + '</td><td>' + item.creator + '</td></tr>';
                                    });
                                    $('#monTable{{ $bookings[0]->id }}').html(tr);
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
                                $('#addMonLog{{ $bookings[0]->id }}').prop('disabled', true);
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
                            <th>BFR</th>
                            <th>NSS</th>
                            <th>UFR</th>
                            <th>UFV</th>
                            <th>Remarks</th>
                            <th>NOD</th>
                          </tr>
                        </thead>
                        <tbody id="monTable{{ $bookings[0]->id }}">
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
                                    $('#nurseNotesTable{{ $bookings[0]->id }}').html(tr);
                                  }
                                });
                                $('#{{ $viewFolder }}_notes_time').val('')
                                $('#{{ $viewFolder }}_nurse_notes').val('');
                                $('#addNurseNotesLog{{ $bookings[0]->id }}').prop('disabled', true);
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
                        <tbody id="nurseNotesTable{{ $bookings[0]->id }}">
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
      @endif
    </div>
    
    
    
  </div>
</div>

<script>
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
      url: '{{ Route::has('doctors_home.getPrevBookingInfo') ? route('doctors_home.getPrevBookingInfo') : ''}}/' + consultation_id + '/' + index,
      success:
        function(data, status){
          bookingObj = jQuery.parseJSON(data);
          // if(bookingObj.consultation.booking_type == 'Dialysis'){
            // alert($('#patient_records_prev_treatment_id').val());
            pdf_conso_id = consultation_id;
            if(bookingObj.parent_consultation.id != '')
              pdf_conso_id = bookingObj.parent_consultation.id;
            $('#printLinkID').attr('href', $('#printLinkID').attr('href').replace($('#patient_records_prev_treatment_id').val(), pdf_conso_id));
          // }
            if(bookingObj.consultation.doctor.specialty.includes('Ophtha')){
            $('#eyeExam').show();
          }else{
            $('#eyeExam').hide();
          }
          $('#referral_list').empty();
          if(bookingObj.parent_consultation.id != ''){
            if(bookingObj.parent_consultation.booking_type == '')
              bookingObj.parent_consultation.booking_type = 'Consultation';
            activeStr = '';
            if(bookingObj.parent_consultation.id == consultation_id)
              activeStr = 'active';
            var newItem = '<li class="nav-item"><a class="nav-link docNotesLink ' + activeStr + '" href="#" onclick="loadPrevBooking(' + bookingObj.parent_consultation.id + ', 0)">Dr. ' + bookingObj.parent_consultation.doctor.f_name.substring(0, 1) + '. ' + bookingObj.parent_consultation.doctor.l_name + ' - ' + bookingObj.parent_consultation.clinic.name + ' | ' + bookingObj.parent_consultation.booking_type + '</a></li>';
            $('#referral_list').append(newItem);
          }else{
            if(bookingObj.consultation.booking_type == '')
              bookingObj.consultation.booking_type = 'Consultation';
            activeStr = '';
            if(bookingObj.consultation.id == consultation_id)
              activeStr = 'active';
            var newItem = '<li class="nav-item"><a class="nav-link docNotesLink ' + activeStr + '" href="#" onclick="loadPrevBooking(' + bookingObj.consultation.id + ', 0)">Dr. ' + bookingObj.consultation.doctor.f_name.substring(0, 1) + '. ' + bookingObj.consultation.doctor.l_name + ' - ' + bookingObj.consultation.clinic.name + ' | ' + bookingObj.consultation.booking_type + '</a></li>';
            $('#referral_list').append(newItem);
          }

          
          if(bookingObj.consultation_referals[0].id != ''){
            $.each(bookingObj.consultation_referals, function(key, value){
              if(value.booking_type == '')
                value.booking_type = 'Consultation';
              activeStr = '';
              if(value.id == consultation_id)
                activeStr = 'active';
              var newItem = '<li class="nav-item"><a class="nav-link docNotesLink ' + activeStr + '" href="#" onclick="loadPrevBooking(' + value.id + ', 0)">Dr. ' + value.doctor.f_name.substring(0, 1) + '. ' + value.doctor.l_name + ' - ' + value.clinic.name + ' | ' + value.booking_type + '</a></li>';
              $('#referral_list').append(newItem);
            });
          }
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

          if(bookingObj.consultation.booking_type == 'Dialysis'){
            $('#dChart').show();
            $('#dialysisPrevDiv').hide();
            $('#dialysisPrevLink').removeClass('active');
            $('#sumPrevLink').addClass('active');
            $('#soapPrevLink').removeClass('active');  
            $('#labPrevLink').removeClass('active');  
            $('#presPrevLink').removeClass('active');  
            $('#medPrevLink').removeClass('active');  
            $('#admitPrevLink').removeClass('active');
            $('#dialysisPrevLink').removeClass('active');
            $('#soapPrevDiv').hide();  
            $('#labPrevDiv').hide();  
            $('#presPrevDiv').hide();  
            $('#medPrevDiv').hide();  
            $('#admitPrevDiv').hide();
            $('#dialysisPrevDiv').hide();
            $('#sumCurDiv').show();
          }else{
            $('#dChart').hide();
            $('#dialysisPrevLink').removeClass('active');
            $('#dialysisPrevDiv').hide();
            $('#sumPrevLink').addClass('active');
            $('#soapPrevLink').removeClass('active');  
            $('#labPrevLink').removeClass('active');  
            $('#presPrevLink').removeClass('active');  
            $('#medPrevLink').removeClass('active');  
            $('#admitPrevLink').removeClass('active');
            $('#dialysisPrevLink').removeClass('active');
            $('#soapPrevDiv').hide();  
            $('#labPrevDiv').hide();  
            $('#presPrevDiv').hide();  
            $('#medPrevDiv').hide();  
            $('#admitPrevDiv').hide();
            $('#dialysisPrevDiv').hide();
            $('#sumCurDiv').show();
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

          if(bookingObj.consultation.ambulation_status_j != null){
            if(bookingObj.consultation.ambulation_status_j != null){
              if(bookingObj.consultation.ambulation_status_j.includes('ambulatory'))
                $('#{{ $viewFolder }}_prev_ambulation_status_ambulatory').prop('checked', true);
              else
                $('#{{ $viewFolder }}_prev_ambulation_status_ambulatory').prop('checked', false);
              if(bookingObj.consultation.ambulation_status_j.includes('w/ assistance'))
                $('#{{ $viewFolder }}_prev_ambulation_status_assistance').prop('checked', true);
              else
                $('#{{ $viewFolder }}_prev_ambulation_status_assistance').prop('checked', false);
              if(bookingObj.consultation.ambulation_status_j.includes('wheelchair'))
                $('#{{ $viewFolder }}_prev_ambulation_status_wheelchair').prop('checked', true);
              else
                $('#{{ $viewFolder }}_prev_ambulation_status_wheelchair').prop('checked', false);
              
            }else{
              $('#{{ $viewFolder }}_prev_ambulation_status_ambulatory').prop('checked', false);
              $('#{{ $viewFolder }}_prev_ambulation_status_assistance').prop('checked', false);
              $('#{{ $viewFolder }}_prev_ambulation_status_wheelchair').prop('checked', false);
            }
          }else{
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
          }

          if(bookingObj.consultation.post_ambulation_status_j != null){
            if(bookingObj.consultation.post_ambulation_status_j != null){
              if(bookingObj.consultation.post_ambulation_status_j.includes('ambulatory'))
                $('#{{ $viewFolder }}_prev_post_ambulation_status_ambulatory').prop('checked', true);
              else
                $('#{{ $viewFolder }}_prev_post_ambulation_status_ambulatory').prop('checked', false);
              if(bookingObj.consultation.post_ambulation_status_j.includes('w/ assistance'))
                $('#{{ $viewFolder }}_prev_post_ambulation_status_assistance').prop('checked', true);
              else
                $('#{{ $viewFolder }}_prev_post_ambulation_status_assistance').prop('checked', false);
              if(bookingObj.consultation.post_ambulation_status_j.includes('wheelchair'))
                $('#{{ $viewFolder }}_prev_post_ambulation_status_wheelchair').prop('checked', true);
              else
                $('#{{ $viewFolder }}_prev_post_ambulation_status_wheelchair').prop('checked', false);
              
            }else{
              $('#{{ $viewFolder }}_prev_post_ambulation_status_ambulatory').prop('checked', false);
              $('#{{ $viewFolder }}_prev_post_ambulation_status_assistance').prop('checked', false);
              $('#{{ $viewFolder }}_prev_post_ambulation_status_wheelchair').prop('checked', false);
            }
          }else{
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

          if(bookingObj.consultation.vaccess_j != null){
            if(bookingObj.consultation.vaccess_j != null){
              if(bookingObj.consultation.vaccess_j.includes('left'))
                $('#{{ $viewFolder }}_prev_vaccess_left').prop('checked', true);
              else
                $('#{{ $viewFolder }}_prev_vaccess_left').prop('checked', false);
              if(bookingObj.consultation.vaccess_j.includes('right'))
                $('#{{ $viewFolder }}_prev_vaccess_right').prop('checked', true);
              else
                $('#{{ $viewFolder }}_prev_vaccess_right').prop('checked', false);
              
              
            }else{
              $('#{{ $viewFolder }}_prev_vaccess_left').prop('checked', false);
              $('#{{ $viewFolder }}_prev_vaccess_right').prop('checked', false);
              
            }
          }else{
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
          $('#medTable{{ isset($bookings[0]->id) ? $bookings[0]->id : '' }}').empty();
          $.each(bookingObj.consultation_meds, function(index, element){
            
            if(index == 0){
              $('#medTable{{ isset($bookings[0]->id) ? $bookings[0]->id : '' }}').empty().append('<tr id=\'' + element.id + '\' log=\'meds\'><td></td><td>' + element.time_given + '</td><td>' + element.medication + '</td><td>' + element.dosage + '</td><td>' + element.creator.name + '</td></tr>');
            }else{
              $('#medTable{{ isset($bookings[0]->id) ? $bookings[0]->id : '' }}').append('<tr id=\'' + element.id + '\' log=\'meds\'><td></td><td>' + element.time_given + '</td><td>' + element.medication + '</td><td>' + element.dosage + '</td><td>' + element.creator.name + '</td></tr>');
            }
          });
          $('#monTable{{ isset($bookings[0]->id) ? $bookings[0]->id : '' }}').empty();
          $.each(bookingObj.consultation_monitorings, function(index, element){
            if(index == 0){
              $('#monTable{{ isset($bookings[0]->id) ? $bookings[0]->id : '' }}').empty().append('<tr id=\'' + element.id + '\' log=\'moni\'><td></td><td>' + element.time_given + '</td><td>' + element.bpS + '/' + element.bpD + '</td><td>' + element.heart + 'BPM</td><td>' + element.o2 + '%</td><td>' + element.ap + '</td><td>' + element.vp + '</td><td>' + element.tmp + '</td><td>' + element.bfr + '</td><td>' + element.nss + '</td><td>' + element.ufr + '</td><td>' + element.ufv + '</td><td>' + element.remarks + '</td><td>' + element.creator.name + '</td></tr>');
            }else{
              $('#monTable{{ isset($bookings[0]->id) ? $bookings[0]->id : '' }}').append('<tr id=\'' + element.id + '\' log=\'moni\'><td></td><td>' + element.time_given + '</td><td>' + element.bpS + '/' + element.bpD + '</td><td>' + element.heart + 'BPM</td><td>' + element.o2 + '%</td><td>' + element.ap + '</td><td>' + element.vp + '</td><td>' + element.tmp + '</td><td>' + element.bfr + '</td><td>' + element.nss + '</td><td>' + element.ufr + '</td><td>' + element.ufv + '</td><td>' + element.remarks + '</td><td>' + element.creator.name + '</td></tr>');
            }
          });
          $('#nurseNotesTable{{ isset($bookings[0]->id) ? $bookings[0]->id : '' }}').empty();
          $.each(bookingObj.consultation_nurse_notes, function(index, element){
            if(index == 0){
              $('#nurseNotesTable{{ isset($bookings[0]->id) ? $bookings[0]->id : '' }}').empty().append('<tr id=\'' + element.id + '\' log=\'nurseNotes\'><td></td><td>' + element.time_given + '</td><td>' + element.notes + '</td><td>' + element.creator.name + '</td></tr>');
            }else{
              $('#nurseNotesTable{{ isset($bookings[0]->id) ? $bookings[0]->id : '' }}').append('<tr id=\'' + element.id + '\' log=\'nurseNotes\'><td></td><td>' + element.time_given + '</td><td>' + element.notes + '</td><td>' + element.creator.name + '</td></tr>');
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
            bookingObj.consultation_files.forEach(function(item, index){
              if(item.file_link.includes('uploads'))
                item.file_link = item.file_link.replace('uploads', 'storage/uploads');
              if(index == 0){
                indicator = '<button type="button" data-bs-target="#carouselPrev" data-bs-slide-to="' + index + '" class="active" aria-current="true" aria-label="Slide ' + (index+1) + '"></button>'
                inner = '<div class="carousel-item active"><img src="' + item.file_link + '" class="d-block w-100" alt=""></div>';
              }else{
                indicator += '<button type="button" data-bs-target="#carouselPrev" data-bs-slide-to="' + index + '" aria-label="Slide ' + (index+1) + '"></button>'
                inner += '<div class="carousel-item"><img src="' + item.file_link + '" class="d-block w-100" alt=""></div>';
              }
            });
            $('#labPrevCarouselInd').html(indicator);
            $('#labPrevCarouselInner').html(inner);
          }else{
            $('#labPrevCarouselInd').html('<button type="button" data-bs-target="#carouselPrev" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>');
            $('#labPrevCarouselInner').html('<div class="carousel-item active"><img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" class="d-block w-100" alt=""></div>');
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
            } else {
              fileArr.push(total_file[i]);
              $('#image_preview').append("<div class='img-div' id='img-div"+i+"'><img src='"+URL.createObjectURL(event.target.files[i])+"' class='img-thumbnail' title='"+total_file[i].name+"'><div class='middle'><button id='action-icon' value='img-div"+i+"' class='btn btn-danger' role='"+total_file[i].name+"'><i class='bi bi-trash'></i></button></div></div>");
            }
          }
    });

    $('body').on('click', '.docNotesLink', function(){
      $('.docNotesLink').each(function(){
        $(this).removeClass('active');
      });
      $(this).addClass('active');
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
    
    function FileListItem(file) {
        file = [].slice.call(Array.isArray(file) ? file : arguments)
        for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
        if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
        for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
        return b.files
    }

    
  });
</script>
