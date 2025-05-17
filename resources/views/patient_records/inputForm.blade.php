@php
  unset($referal_conso);
  if(isset($datum->parent_consultation)){
    $referal_conso = $datum;
    $datum = $datum->parent_consultation;
  }
@endphp

<datalist id="patientNameList">
@foreach($selectItems['patients'] as $pat)
  <option patient_id="{{ $pat->id }}" value="{{ $pat->name }}">{{ $pat->name }}</option>
@endforeach
</datalist>

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
            <strong>Gender:</strong> {{ !empty($datum->gender) ? $datum->gender : '' }}<br>
            <strong>Address:</strong> {{ !empty($datum->address) ? $datum->address : '' }}<br>
            <strong>Email:</strong> {{ !empty($datum->email) ? $datum->email : '' }} | 
            <strong>Mobile #:</strong> {{ !empty($datum->mobile_num) ? $datum->mobile_num : '' }}<br>
            <strong>Patient Type:</strong> {{ !empty($datum->patient_type) ? $datum->patient_type : '' }} | 
            <strong>Patient Sub Type: </strong>{{ !empty($datum->patient_sub_type) ? $datum->patient_sub_type . ' ' . $datum->referral_from : '' }}<br>
            <strong>Philhealth #: </strong>{{ !empty($datum->phil_num) ? $datum->phil_num : '' }}<br>
            <strong>HMO:</strong> {{ !empty($datum->hmo) ? $datum->hmo : '' }} | 
            <strong>HMO #:</strong> {{ !empty($datum->hmo_num) ? $datum->hmo_num : '' }}<br>
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
            <strong>Alergies:</strong> {{ !empty($datum->allergies) ? $datum->allergies : '' }}<br>
            @if(isset($datum->allergies) && is_array(json_decode($datum->allergies)) && in_array('Food', json_decode($datum->allergies)))
            <strong>Food Alergies:</strong> {{ !empty($datum->allergiesFood) ? $datum->allergiesFood : ''}}<br>
            @endif
            @if(isset($datum->allergies) && is_array(json_decode($datum->allergies)) && in_array('Medicine', json_decode($datum->allergies)))
            <strong>Medicine Alergies:</strong> {{ !empty($datum->allergiesMedicine) ? $datum->patient->allergiesMedicine : '' }}<br>
            @endif
            @if(isset($datum->allergies) && is_array(json_decode($datum->allergies)) && in_array('Others', json_decode($datum->allergies)))
            <strong>Other Alergies:</strong> {{ !empty($datum->allergiesOthers) ? $datum->allergiesOthers : '' }}<br>
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
                    <th>Booking Type</th>
                    <th>Procedure Details</th>
                </tr>
            </thead>
            @if(isset($datum->id))
            <tbody>
              @php
                if($user->user_type == 'Clinic')
                  $bookings = $datum->consultations()->where('client_id', $user->id)->where('status', 'Done')->orderByDesc('bookingDate')->get();
                elseif($user->user_type == 'Doctor')
                  $bookings = $datum->consultations()->where('doctor_id', $user->id)->where('status', 'Done')->orderByDesc('bookingDate')->get();
                else
                  $bookings = $datum->consultations()->where('status', 'Done')->orderByDesc('bookingDate')->get();
                print_r($user->user_type);
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
            @endif
          </table>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      @if(isset($bookings[0]))
      <div class="card mb-3">
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
          <div class="card mb-3">
            <div class="card-header">Eye Examination Information</div>
            <div class="card-body">
              <p id="prevEyer">
                <strong>AR OD:</strong> <span class="text-primary">{{ $bookings[0]->arod_sphere != 'No Target' ? $bookings[0]->arod_sphere . ' - ' . $bookings[0]->arod_cylinder . ' x ' . $bookings[0]->arod_axis : $bookings[0]->arod_sphere }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>AR OS:</strong> <span class="text-primary">{{ $bookings[0]->aros_sphere != 'No Target' ? $bookings[0]->aros_sphere . ' - ' . $bookings[0]->aros_cylinder . ' x ' . $bookings[0]->aros_axis : $bookings[0]->aros_sphere }}</span><br>
                <strong>UCVA OD:</strong> <span class="text-primary">{{ is_int($bookings[0]->vaod_num) ? $bookings[0]->vaod_num . ' / ' . $bookings[0]->vaod_den : $bookings[0]->vaod_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>UCVA OD w/ Correction:</strong> <span class="text-primary">{{ is_int($bookings[0]->vaodcor_num) ? $bookings[0]->vaodcor_num . ' / ' . $bookings[0]->vaodcor_den : $bookings[0]->vaodcor_num }}</span><br>
                <strong>UCVA OS:</strong> <span class="text-primary">{{ is_int($bookings[0]->vaos_num) ? $bookings[0]->vaos_num . ' / ' . $bookings[0]->vaos_den : $bookings[0]->vaos_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>UCVA OS w/ Correction:</strong> <span class="text-primary">{{ is_int($bookings[0]->vaoscor_num) ? $bookings[0]->vaoscor_num . ' / ' . $bookings[0]->vaoscor_den : $bookings[0]->vaoscor_num }}</span><br>
                <strong>BCVA OD:</strong> <span class="text-primary">{{ is_int($bookings[0]->pinod_num) ? $bookings[0]->pinod_num . ' / ' . $bookings[0]->pinod_den : $bookings[0]->pinod_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>BCVA OD w/ Correction:</strong> <span class="text-primary">{{ is_int($bookings[0]->pinodcor_num) ? $bookings[0]->pinodcor_num . ' / ' . $bookings[0]->pinodcor_den : $bookings[0]->pinodcor_num }}</span><br>
                <strong>BCVA OS:</strong> <span class="text-primary">{{ is_int($bookings[0]->pinos_num) ? $bookings[0]->pinos_num . ' / ' . $bookings[0]->pinos_den : $bookings[0]->pinos_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>BCVA OS w/ Correction:</strong> <span class="text-primary">{{ is_int($bookings[0]->pinoscor_num) ? $bookings[0]->pinoscor_num . ' / ' . $bookings[0]->pinoscor_den : $bookings[0]->pinoscor_num }}</span><br>
                <strong>Jaeger OU:</strong> <span class="text-primary">{{ $bookings[0]->jae_ou }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>Jaeger OD:</strong> <span class="text-primary">{{ $bookings[0]->jae_od }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>Jaeger OS:</strong> <span class="text-primary">{{ $bookings[0]->jae_os }}</span><br>
                <strong>IOP OD:</strong> <span class="text-primary">{{ $bookings[0]->iopod }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>IOP OS:</strong> <span class="text-primary">{{ $bookings[0]->iopos }}</span>
              </p>
            </div>
          </div>
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" id="soapPrevLink" href="#" onclick="
                $('#soapPrevLink').addClass('active');  
                $('#labPrevLink').removeClass('active');  
                $('#presPrevLink').removeClass('active');  
                $('#medPrevLink').removeClass('active');  
                $('#admitPrevLink').removeClass('active');
                $('#soapPrevDiv').show();  
                $('#labPrevDiv').hide();  
                $('#presPrevDiv').hide();  
                $('#medPrevDiv').hide();  
                $('#admitPrevDiv').hide();
                $('#soapCurLink').addClass('active');  
                $('#labCurLink').removeClass('active');  
                $('#presCurLink').removeClass('active');  
                $('#medCurLink').removeClass('active');  
                $('#admitCurLink').removeClass('active');
                $('#soapCurDiv').show();  
                $('#labCurDiv').hide();  
                $('#presCurDiv').hide();  
                $('#medCurDiv').hide();  
                $('#admitCurDiv').hide();
              ">SOAP</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="labPrevLink" href="#" onclick="
                $('#soapPrevLink').removeClass('active');
                $('#labPrevLink').addClass('active');  
                $('#presPrevLink').removeClass('active');  
                $('#medPrevLink').removeClass('active');  
                $('#admitPrevLink').removeClass('active');
                $('#soapPrevDiv').hide();  
                $('#labPrevDiv').show();  
                $('#presPrevDiv').hide();  
                $('#medPrevDiv').hide();  
                $('#admitPrevDiv').hide();
                $('#soapCurLink').removeClass('active');
                $('#labCurLink').addClass('active');  
                $('#presCurLink').removeClass('active');  
                $('#medPCurLink').removeClass('active');  
                $('#admitCurLink').removeClass('active');
                $('#soapCurDiv').hide();  
                $('#labCurDiv').show();  
                $('#presCurDiv').hide();  
                $('#medCurDiv').hide();  
                $('#admitCurDiv').hide();
              ">File Uploads</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="presPrevLink" href="#" onclick="
                $('#soapPrevLink').removeClass('active');
                $('#labPrevLink').removeClass('active');  
                $('#presPrevLink').addClass('active');  
                $('#medPrevLink').removeClass('active');  
                $('#admitPrevLink').removeClass('active');
                $('#soapPrevDiv').hide();  
                $('#labPrevDiv').hide();  
                $('#presPrevDiv').show();  
                $('#medPrevDiv').hide();  
                $('#admitPrevDiv').hide();
                $('#soapCurLink').removeClass('active');
                $('#labCurLink').removeClass('active');  
                $('#presCurLink').addClass('active');  
                $('#medCurLink').removeClass('active');  
                $('#admitCurLink').removeClass('active');
                $('#soapCurDiv').hide();  
                $('#labCurDiv').hide();  
                $('#presCurDiv').show();  
                $('#medCurDiv').hide();  
                $('#admitCurDiv').hide();
              ">E-Prescription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="medPrevLink" href="#" onclick="
                $('#soapPrevLink').removeClass('active');
                $('#labPrevLink').removeClass('active');  
                $('#presPrevLink').removeClass('active');  
                $('#medPrevLink').addClass('active');  
                $('#admitPrevLink').removeClass('active');
                $('#soapPrevDiv').hide();  
                $('#labPrevDiv').hide();  
                $('#presPrevDiv').hide();  
                $('#medPrevDiv').show();  
                $('#admitPrevDiv').hide();
                $('#soapCurLink').removeClass('active');
                $('#labCurLink').removeClass('active');  
                $('#presCurLink').removeClass('active');  
                $('#medCurLink').addClass('active');  
                $('#admitCurLink').removeClass('active');
                $('#soapCurDiv').hide();  
                $('#labCurDiv').hide();  
                $('#presCurDiv').hide();  
                $('#medCurDiv').show();  
                $('#admitCurDiv').hide();
              ">Med Cert</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="admitPrevLink" href="#" onclick="
                $('#soapPrevLink').removeClass('active');
                $('#labPrevLink').removeClass('active');  
                $('#presPrevLink').removeClass('active');  
                $('#medPrevLink').removeClass('active');
                $('#admitPrevLink').addClass('active'); 
                $('#soapPrevDiv').hide();  
                $('#labPrevDiv').hide();  
                $('#presPrevDiv').hide();  
                $('#medPrevDiv').hide(); 
                $('#admitPrevDiv').show();  
                $('#soapCurLink').removeClass('active');
                $('#labCurLink').removeClass('active');  
                $('#presCurLink').removeClass('active');  
                $('#medCurLink').removeClass('active');
                $('#admitCurLink').addClass('active'); 
                $('#soapCurDiv').hide();  
                $('#labCurDiv').hide();  
                $('#presCurDiv').hide();  
                $('#medCurDiv').hide(); 
                $('#admitCurDiv').show();  
              ">Admitting Orders</a>
            </li>
          </ul>
          <div id="soapPrevDiv" class="container border border-1 border-top-0 mb-3 p-3">
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
            <ul class="nav nav-pills mb-3">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">{{ $user->name == $bookings[0]->doctor->name ? 'Yours' : 'Dr. ' . Str::substr($bookings[0]->doctor->f_name, 0, 1) . '. ' . $bookings[0]->doctor->l_name }}</a>
              </li>
            </ul>
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
                  <div class="card-header">Subject's Complaints</div>
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
              </div>
            </div>
          </div>
          <div id="labPrevDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            <div id="carouselPrev" class="carousel carousel-dark slide" data-bs-ride="true">
              <div class="carousel-indicators" id="labPrevCarouselInd">
                @if(!empty($bookings[0]->consultation_files[0]->file_link))
                  @foreach($bookings[0]->consultation_files as $ind=>$file)
                <button type="button" data-bs-target="#carouselPrev" data-bs-slide-to="{{ $ind }}" {{ $ind == 0 ? 'class=active aria-current=true' : '' }} aria-label="Slide {{ $ind+1 }}"></button>
                  @endforeach
                @else
                <button type="button" data-bs-target="#carouselPrev" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                @endif
              </div>
              <div class="carousel-inner" id="labPrevCarouselInner">
                @if(!empty($bookings[0]->consultation_files[0]->file_link))
                  @foreach($bookings[0]->consultation_files as $ind=>$file)
                <div class="carousel-item {{ $ind == 0 ? 'active' : '' }}">
                  <img src="{{stristr($file->file_link, 'uploada') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" class="d-block w-100" alt="">
                </div>
                  @endforeach
                @else
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
                <iframe id="iframePrevPresc" src="{{ file_exists(public_path('storage/prescription_files/' . $bookings[0]->id . '_' . $bookings[0]->patient->l_name . '.pdf')) ? asset('storage/prescription_files/' . $bookings[0]->id . '_' . $bookings[0]->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" width="100%" height="300" style="border:1"></iframe>
                <small class="form-text text-muted">To print or download go to Tools</small>
              </div>
            </div>
          </div>
          <div id="medPrevDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            <div class="card mb-3">
              <div class="card-header">Med Cert Preview</div>
              <div class="card-body">
                <iframe id="iframePrevMedCert" src="{{ file_exists(public_path('storage/med_cert_files/' . $bookings[0]->id . '_' . $bookings[0]->patient->l_name . '.pdf')) ? asset('storage/med_cert_files/' . $bookings[0]->id . '_' . $bookings[0]->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" width="100%" height="300" style="border:1"></iframe>
                <small class="form-text text-muted">To print or download go to Tools</small>
              </div>
            </div>
          </div>
          <div id="admitPrevDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            <div class="card mb-3">
              <div class="card-header">Admitting Orders Preview</div>
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
    
    
    
  </div>
</div>

<script>
  function loadPrevBooking(consultation_id, index){
    $.ajax({
      type: 'GET',
      url: '{{ Route::has('doctors_home.getPrevBookingInfo') ? route('doctors_home.getPrevBookingInfo') : ''}}/' + consultation_id + '/' + index,
      success:
        function(data, status){
          bookingObj = jQuery.parseJSON(data);
          $('#prevBookingDater').text(bookingObj.consultation.bookingDate);
          vitalStr = '<strong>Temp:</strong> ' + bookingObj.consultation.temp + 'C | <strong>Height:</strong> ' + bookingObj.consultation.height + 'cm | <strong>Weight:</strong> ' + bookingObj.consultation.weight + 'kg | <strong>BMI:</strong> ' + Math.round(bookingObj.consultation.weight/((bookingObj.consultation.height/100)*(bookingObj.consultation.height/100))) + '<br><strong>BP:</strong> ' + bookingObj.consultation.bpS + '/' + bookingObj.consultation.bpD + ' | <strong>O2 Sat:</strong> ' + bookingObj.consultation.o2 + '% | <strong>Heart Rate:</strong> ' + bookingObj.consultation.heart + 'beats/min';
          $('#prevVitaler').html(vitalStr);
          $('#prevProcDet').html(bookingObj.consultation.procedure_details);
          $('#prevPatComp').html(bookingObj.consultation.complains);
          $('#prevPatCompDur').html(bookingObj.consultation.duration);
          eyeStr = '';
          if(bookingObj.consultation.arod_sphere == 'No Target')
            eyeStr += '<strong>AR OD:</strong> <span class="text-primary">' + bookingObj.consultation.arod_sphere + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          else
            eyeStr += '<strong>AR OD:</strong> <span class="text-primary">' + bookingObj.consultation.arod_sphere + ' - ' + bookingObj.consultation.arod_cylinder + ' x ' + bookingObj.consultation.arod_axis + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          
          if(bookingObj.consultation.aros_sphere == 'No Target')
            eyeStr += '<strong>AR OS:</strong> <span class="text-primary">' + bookingObj.consultation.aros_sphere + '</span><br> ';
          else
            eyeStr += '<strong>AR OS:</strong> <span class="text-primary">' + bookingObj.consultation.aros_sphere + ' - ' + bookingObj.consultation.aros_cylinder + ' x ' + bookingObj.consultation.aros_axis + '</span><br> ';
          
          if(!Number.isInteger(bookingObj.consultation.vaod_num))
            eyeStr += '<strong>UCVA OD:</strong> <span class="text-primary">' + bookingObj.consultation.vaod_num + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          else
            eyeStr += '<strong>UCVA OD:</strong> <span class="text-primary">' + bookingObj.consultation.vaod_num + ' / ' + bookingObj.consultation.vaod_den + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          
          if(!Number.isInteger(bookingObj.consultation.vaodcor_num) == 'NA')
            eyeStr += '<strong>UCVA OD w/ Correction:</strong> <span class="text-primary">' + bookingObj.consultation.vaodcor_num + '</span><br> ';
          else
            eyeStr += '<strong>UCVA OD w/ Correction:</strong> <span class="text-primary">' + bookingObj.consultation.vaodcor_num + ' / ' + bookingObj.consultation.vaodcor_den + '</span><br> ';
          
          if(!Number.isInteger(bookingObj.consultation.vaos_num) == 'NA')
            eyeStr += '<strong>UCVA OS:</strong> <span class="text-primary">' + bookingObj.consultation.vaos_num + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          else
            eyeStr += '<strong>UCVA OS:</strong> <span class="text-primary">' + bookingObj.consultation.vaos_num + ' / ' + bookingObj.consultation.vaos_den + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';

          if(!Number.isInteger(bookingObj.consultation.vaoscor_num) == 'NA')
            eyeStr += '<strong>UCVA OS w/ Correction:</strong> <span class="text-primary">' + bookingObj.consultation.vaoscor_num + '</span><br> ';
          else
            eyeStr += '<strong>UCVA OS w/ Correction:</strong> <span class="text-primary">' + bookingObj.consultation.vaoscor_num + ' / ' + bookingObj.consultation.vaoscor_den + '</span><br> ';
          
          if(!Number.isInteger(bookingObj.consultation.pinod_num) == 'NA')
            eyeStr += '<strong>BCVA OD:</strong> <span class="text-primary">' + bookingObj.consultation.pinod_num + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          else
            eyeStr += '<strong>BCVA OD:</strong> <span class="text-primary">' + bookingObj.consultation.pinod_num + ' / ' + bookingObj.consultation.pinod_den + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          
          if(!Number.isInteger(bookingObj.consultation.pinodcor_num) == 'NA')
            eyeStr += '<strong>BCVA OD w/ Correction:</strong> <span class="text-primary">' + bookingObj.consultation.pinodcor_num + '</span><br> ';
          else
            eyeStr += '<strong>BCVA OD w/ Correction:</strong> <span class="text-primary">' + bookingObj.consultation.pinodcor_num + ' / ' + bookingObj.consultation.pinodcor_den + '</span><br> ';
          
          if(!Number.isInteger(bookingObj.consultation.pinos_num) == 'NA')
            eyeStr += '<strong>BCVA OS:</strong> <span class="text-primary">' + bookingObj.consultation.pinos_num + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          else
            eyeStr += '<strong>BCVA OS:</strong> <span class="text-primary">' + bookingObj.consultation.pinos_num + ' / ' + bookingObj.consultation.pinos_den + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          
          if(!Number.isInteger(bookingObj.consultation.pinodcor_num) == 'NA')
            eyeStr += '<strong>BCVA OS w/ Correction:</strong> <span class="text-primary">' + bookingObj.consultation.pinoscor_num + '</span><br> ';
          else
            eyeStr += '<strong>BCVA OS w/ Correction:</strong> <span class="text-primary">' + bookingObj.consultation.pinoscor_num + ' / ' + bookingObj.consultation.pinoscor_den + '</span><br> ';
          
          eyeStr += '<strong>Jaeger OU:</strong> <span class="text-primary">' + bookingObj.consultation.jae_ou + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          eyeStr += '<strong>Jaeger OD:</strong> <span class="text-primary">' + bookingObj.consultation.jae_od + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          eyeStr += '<strong>Jaeger OS:</strong> <span class="text-primary">' + bookingObj.consultation.jae_os + '</span><br> ';
          eyeStr += '<strong>IOP OD:</strong> <span class="text-primary">' + bookingObj.consultation.iopod + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          eyeStr += '<strong>IOP OS:</strong> <span class="text-primary">' + bookingObj.consultation.iopos + '</span>';
          $('#prevEyer').html(eyeStr);
          $('#{{ $viewFolder }}_prev_docNotesHPI').val(bookingObj.consultation.docNotesHPI);
          $('#{{ $viewFolder }}_prev_docNotesSubject').val(bookingObj.consultation.docNotesSubject);
          $('#{{ $viewFolder }}_prev_docNotes').val(bookingObj.consultation.docNotes);
          $('#{{ $viewFolder }}_prev_assessment').val(bookingObj.consultation.assessment);
          $('#{{ $viewFolder }}_prev_plan').val(bookingObj.consultation.plan);
          $('#{{ $viewFolder }}_prev_planMed').val(bookingObj.consultation.planMed);
          $('#{{ $viewFolder }}_prev_planRem').val(bookingObj.consultation.planRem);
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
                inner += '<div class="carousel-item active"><img src="' + item.file_link + '" class="d-block w-100" alt=""></div>';
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
