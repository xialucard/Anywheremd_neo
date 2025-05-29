@php
  unset($referal_conso);
  if(isset($datum->parent_consultation)){
    $referal_conso = $datum;
    $datum = $datum->parent_consultation;
  }
@endphp

<datalist id="icdCodeList"></datalist>

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="card mb-3">
        <div class="card-header">Basic Information</div>
        <div class="card-body">
          <img src="{{ !empty($datum->patient->profile_pic) ? (stristr($datum->patient->profile_pic, 'uploads') ? asset('storage/' . $datum->patient->profile_pic) : asset('storage/px_files/' . $datum->patient->profile_pic)) : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" class="img-thumbnail float-start w-25 h-25 m-2" alt="">
          <p>
            <strong>Name:</strong> {{ $datum->patient->name }} | 
            <strong>Age:</strong> {{ floor((strtotime($datum->bookingDate) - strtotime($datum->patient->birthdate))/(60*60*24*365.25)) }} | 
            <strong>Birthday:</strong> {{ $datum->patient->birthdate }} | 
            <strong>Gender:</strong> {{ $datum->patient->gender }}<br>
            <strong>Address:</strong> {{ $datum->patient->address }}<br>
            <strong>Email:</strong> {{ $datum->patient->email }} | 
            <strong>Mobile #:</strong> {{ $datum->patient->mobile_num }}<br>
            <strong>Patient Type:</strong> {{ $datum->patient->patient_type }} | 
            <strong>Patient Sub Type: </strong>{{ $datum->patient->patient_sub_type . ' ' . $datum->patient->referral_from }}<br>
            <strong>Philhealth #: </strong>{{ $datum->patient->phil_num }}<br>
            <strong>HMO:</strong> {{ $datum->patient->hmo }} | 
            <strong>HMO #:</strong> {{ $datum->patient->hmo_num }}<br>
          </p>  
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6 d-none d-md-block">
      <div class="card mb-3">
        <div class="card-header">Booking History</div>
        <div class="card-body table-responsive" style="max-height: 185.5px">
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
                $bookings = $datum->patient->consultations()->where('doctor_id', $user->id)->where('bookingDate', '<=', $datum->bookingDate)->where('status', 'Done')->orderByDesc('bookingDate')->get();
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
    </div>
    <div class="col-lg-6">
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
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6 d-none d-md-block">
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
          @if(stristr($datum->doctor->specialty, 'Ophtha'))
          <div class="card mb-3">
            <div class="card-header">Eye Examination Information</div>
            <div class="card-body">
              <p id="prevEyer">
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
              </p>
            </div>
          </div>
          @endif
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
              <div class="card-header">Previous Procedure</div>
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
            <ul class="nav nav-pills mb-3">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">{{ $user->name == $bookings[0]->doctor->name ? 'Yours' : 'Dr. ' . Str::substr($bookings[0]->doctor->f_name, 0, 1) . '. ' . $bookings[0]->doctor->l_name }}</a>
              </li>
            </ul>
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
                  <input class="form-control" list="icdCodeList" id="{{ $viewFolder }}_icd_code" name="{{ $viewFolder }}[icd_code]" value="{{ isset($referedDoctorArr) ? implode(',', $referedDoctorArr) : '' }}" autocomplete="off">
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
                  <img src="{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" class="d-block w-100" alt="">
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
                  <img src="{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" class="d-block w-100" alt="">
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
                  <img src="{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" class="d-block w-100" alt="">
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
                  <img src="{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" class="d-block w-100" alt="">
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
              @if(isset($bookings[0]->consultation_files))
                @foreach($bookings[0]->consultation_files as $ind => $file)
                @php
                  $exAr = explode('/', $file->file_link);
                @endphp
              <div class='img-div' data-bs-target="#carouselPrev" data-bs-slide-to="{{ $ind }}" id='img-div-save{{ $ind }}'><img src='{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}' class='img-thumbnail' ><div class='middle'><button id='action-icon' value='img-div-save{{ $ind }}' class='btn btn-danger' role='{{ $exAr[sizeof($exAr)-1] }}' saved='{{ $file->id }}' disabled><i class='bi bi-trash'></i></button></div></div>
                @endforeach
              @endif
              @if(isset($bookings[0]->anesthesia_files))
                @foreach($bookings[0]->anesthesia_files as $file)
                @php
                  $ind++;
                @endphp
              <div class='img-div' data-bs-target="#carouselPrev" data-bs-slide-to="{{ $ind }}" id='img-div-save{{ $ind }}'><img src='{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}' class='img-thumbnail' ><div class='middle'><button id='action-icon' value='img-div-save{{ $ind }}' class='btn btn-danger' role='{{ $exAr[sizeof($exAr)-1] }}' saved='{{ $file->id }}' disabled><i class='bi bi-trash'></i></button></div></div>
                @endforeach
              @endif
              @if(isset($bookings[0]->doctor_files))
                @foreach($bookings[0]->doctor_files as $file)
                @php
                  $ind++;
                @endphp
              <div class='img-div' data-bs-target="#carouselPrev" data-bs-slide-to="{{ $ind }}" id='img-div-save{{ $ind }}'><img src='{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}' class='img-thumbnail' ><div class='middle'><button id='action-icon' value='img-div-save{{ $ind }}' class='btn btn-danger' role='{{ $exAr[sizeof($exAr)-1] }}' saved='{{ $file->id }}' disabled><i class='bi bi-trash'></i></button></div></div>
                @endforeach
              @endif
              @if(isset($bookings[0]->prescription_files))
                @foreach($bookings[0]->prescription_files as $file)
                @php
                  $ind++;
                @endphp
              <div class='img-div' data-bs-target="#carouselPrev" data-bs-slide-to="{{ $ind }}" id='img-div-save{{ $ind }}'><img src='{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}' class='img-thumbnail' ><div class='middle'><button id='action-icon' value='img-div-save{{ $ind }}' class='btn btn-danger' role='{{ $exAr[sizeof($exAr)-1] }}' saved='{{ $file->id }}' disabled><i class='bi bi-trash'></i></button></div></div>
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
      <div class="card mb-3">
        <div class="card-header">Current Patient's Chart ({{ $datum->bookingDate }})</div>
        <div class="card-body">
          <div class="card mb-3">
            <div class="card-header">Vitals</div>
            <div class="card-body">
              <p>
                <strong>Temp:</strong> <span class="text-primary">{{ $datum->temp }}C</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>Height:</strong> <span class="text-primary">{{ $datum->height }}cm</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>Weight:</strong> <span class="text-primary">{{ $datum->weight }}kg</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>BMI:</strong> <span class="text-primary">{{ number_format($datum->weight/(($datum->height/100)*($datum->height/100)), 0) }}</span><br>
                <strong>BP:</strong> <span class="text-primary">{{ $datum->bpS }}/{{ $datum->bpD }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>O2 Sat:</strong> <span class="text-primary">{{ $datum->o2 }}%</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>Heart Rate:</strong> <span class="text-primary">{{ $datum->heart }}beats/min</span>
              </p>
            </div>
          </div>
          @if(stristr($datum->doctor->specialty, 'Ophtha'))
          <div class="card mb-3">
            <div class="card-header">Eye Examination Information</div>
            <div class="card-body">
              <p>
                <strong>AR OD:</strong> <span class="text-primary">{{ $datum->arod_sphere != 'No Target' ? $datum->arod_sphere . ' - ' . $datum->arod_cylinder . ' x ' . $datum->arod_axis : 'No Refraction Possible' }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>AR OS:</strong> <span class="text-primary">{{ $datum->aros_sphere != 'No Target' ? $datum->aros_sphere . ' - ' . $datum->aros_cylinder . ' x ' . $datum->aros_axis : 'No Refraction Possible' }}</span><br>
                <strong>UCVA OD:</strong> <span class="text-primary">{{ $datum->vaod_den != '' ? $datum->vaod_num . ' / ' . $datum->vaod_den : $datum->vaod_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>UCVA OD w/ Correction:</strong> <span class="text-primary">{{ $datum->vaodcor_den != '' ? $datum->vaodcor_num . ' / ' . $datum->vaodcor_den : $datum->vaodcor_num }}</span><br>
                <strong>UCVA OS:</strong> <span class="text-primary">{{ $datum->vaos_den != '' ? $datum->vaos_num . ' / ' . $datum->vaos_den : $datum->vaos_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>UCVA OS w/ Correction:</strong> <span class="text-primary">{{ $datum->vaoscor_den != '' ? $datum->vaoscor_num . ' / ' . $datum->vaoscor_den : $datum->vaoscor_num }}</span><br>
                <strong>BCVA OD:</strong> <span class="text-primary">{{ $datum->pinod_den != '' ? $datum->pinod_num . ' / ' . $datum->pinod_den : $datum->pinod_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>BCVA OD w/ Correction:</strong> <span class="text-primary">{{ $datum->pinodcor_den != '' ? $datum->pinodcor_num . ' / ' . $datum->pinodcor_den : $datum->pinodcor_num }}</span><br>
                <strong>BCVA OS:</strong> <span class="text-primary">{{ $datum->pinos_den != '' ? $datum->pinos_num . ' / ' . $datum->pinos_den : $datum->pinos_num }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>BCVA OS w/ Correction:</strong> <span class="text-primary">{{ $datum->pinoscor_den != '' ? $datum->pinoscor_num . ' / ' . $datum->pinoscor_den : $datum->pinoscor_num }}</span><br>
                <strong>Jaeger OU:</strong> <span class="text-primary">{{ $datum->jae_ou }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>Jaeger OD:</strong> <span class="text-primary">{{ $datum->jae_od }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>Jaeger OS:</strong> <span class="text-primary">{{ $datum->jae_os }}</span><br>
                <strong>IOP OD:</strong> <span class="text-primary">{{ $datum->iopod }}</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;
                <strong>IOP OS:</strong> <span class="text-primary">{{ $datum->iopos }}</span>
              </p>
            </div>
          </div>
          @endif
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" id="soapCurLink" href="#" onclick="
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
              ">SOAP</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="labCurLink" href="#" onclick="
                $('#soapCurLink').removeClass('active');
                $('#labCurLink').addClass('active');  
                $('#presCurLink').removeClass('active');  
                $('#medCurLink').removeClass('active');  
                $('#admitCurLink').removeClass('active');
                $('#soapCurDiv').hide();  
                $('#labCurDiv').show();  
                $('#presCurDiv').hide();  
                $('#medCurDiv').hide();  
                $('#admitCurDiv').hide();
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
              ">File Uploads</a>
            </li>
            @if($user->id == $datum->doctor->id)
            <li class="nav-item">
              <a class="nav-link" id="presCurLink" href="#" onclick="
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
              ">E-Prescription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="medCurLink" href="#" onclick="
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
              ">Med Cert</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="admitCurLink" href="#" onclick="
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
              ">Admitting Orders</a>
            </li>
            @endif
          </ul>
          <div id="soapCurDiv" class="container border border-1 border-top-0 mb-3 p-3">
            <div class="card mb-3">
              <div class="card-header">Procedure</div>
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
                    $('#{{ $viewFolder }}_SOAP_{{ $datum->id }}').show();
                  ">{{  $user->id == $datum->doctor->id ? 'Yours' : 'Dr. ' . Str::substr($datum->doctor->f_name, 0, 1) . '. ' . $datum->doctor->l_name }}</a>
              </li>
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
                    $('#{{ $viewFolder }}_SOAP_{{ $cr->id }}').show();
                ">{{ $user->name == $cr->doctor->name ? 'Yours' : 'Dr. ' . Str::substr($cr->doctor->f_name, 0, 1) . '. ' . $cr->doctor->l_name }}</a>
              </li>
                @endforeach
              @endif
            </ul>
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
                        <select class="form-select" placeholder="" {{ $user->id == $datum->doctor->id && !isset($bookings[0]) ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ $user->id == $datum->doctor->id && !isset($bookings[0]) ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[docNotesHPI]" @if($user->id == $datum->doctor->id) id="{{ $viewFolder }}_docNotesHPI" @endif rows=3 {{ $user->id == $datum->doctor->id && !isset($bookings[0]) ? 'required' : '' }}>{{ isset($datum->docNotesHPI) ? $datum->docNotesHPI : '' }}</textarea>
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
                        <select class="form-select" placeholder="" {{ $user->id == $datum->doctor->id && isset($bookings[0]) ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ $user->id == $datum->doctor->id ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[docNotesSubject]" @if($user->id == $datum->doctor->id) id="{{ $viewFolder }}_docNotesSubject" @endif rows=3 {{ $user->id == $datum->doctor->id && isset($bookings[0]) ? 'required' : '' }}>{{ isset($datum->docNotesSubject) ? $datum->docNotesSubject : '' }}</textarea>
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
                        <select class="form-select" placeholder="" {{ $user->id == $datum->doctor->id ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ $user->id == $datum->doctor->id ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[docNotes]" @if($user->id == $datum->doctor->id) id="{{ $viewFolder }}_docNotes" @endif rows=3 {{ $user->id == $datum->doctor->id ? 'required' : 'disabled' }}>{{ isset($datum->docNotes) ? $datum->docNotes : '' }}</textarea>
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
                    <input class="form-control" list="icdCodeList" id="{{ $viewFolder }}_icd_code" name="{{ $viewFolder }}[icd_code]" value="{{ isset($referedDoctorArr) ? implode(',', $referedDoctorArr) : '' }}" autocomplete="off">
                    <label for="{{ $viewFolder }}_icd_code">Primary Diagnosis</label>
                    <small id="help_{{ $viewFolder }}_icd_code" class="text-muted"></small>
                  </div>
                  <div class="card mb-3">
                    <div class="card-header">Secondary Diagnosis</div>
                    <div class="card-body">
                      <small class="text-muted">Helper</small>
                      <div class="input-group input-group-small flex-nowrap">
                        <select class="form-select" placeholder="" {{ $user->id == $datum->doctor->id ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ $user->id == $datum->doctor->id ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[assessment]" @if($user->id == $datum->doctor->id) id="{{ $viewFolder }}_assessment" @endif rows=3 {{ $user->id == $datum->doctor->id ? 'required' : 'disabled' }}>{{ isset($datum->assessment) ? $datum->assessment : '' }}</textarea>
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
                        <select class="form-select" placeholder="" {{ $user->id == $datum->doctor->id ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ $user->id == $datum->doctor->id ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[planMed]" @if($user->id == $datum->doctor->id) id="{{ $viewFolder }}_planMed" @endif rows=3 {{ $user->id == $datum->doctor->id ? 'required' : 'disabled' }}>{{ isset($datum->planMed) ? $datum->planMed : '' }}</textarea>
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
                        <select class="form-select" placeholder="" {{ $user->id == $datum->doctor->id ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ $user->id == $datum->doctor->id ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[plan]" @if($user->id == $datum->doctor->id) id="{{ $viewFolder }}_plan" @endif rows=3 {{ $user->id == $datum->doctor->id ? 'required' : 'disabled' }}>{{ isset($datum->plan) ? $datum->plan : '' }}</textarea>
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
                        <select class="form-select" placeholder="" {{ $user->id == $datum->doctor->id ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ $user->id == $datum->doctor->id ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[planRem]" @if($user->id == $datum->doctor->id) id="{{ $viewFolder }}_planRem" @endif rows=3 {{ $user->id == $datum->doctor->id ? 'required' : 'disabled' }}>{{ isset($datum->planRem) ? $datum->planRem : '' }}</textarea>
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
            @if(isset($datum->consultation_referals[0]->id))
              @foreach($datum->consultation_referals as $cr)
                @if($user->id == $cr->doctor->id)  
            <input type="hidden" class="form-control" id="{{ $viewFolder }}_referral_id" name="{{ $viewFolder }}[referral_id]" value="{{ $cr->id }}">
                @endif
            <div class="docNotesDiv" id="{{ $viewFolder }}_SOAP_{{ $cr->id }}" style="display:none" >
              <div class="card mb-3">
                <div class="card-header">Doctor's Notes</div>
                <div class="card-body">
                  @if(!isset($bookings[0]))
                  <div class="card mb-3">
                    <div class="card-header">History of Present Illness</div>
                    <div class="card-body">
                      <small class="text-muted">Helper</small>
                      <div class="input-group input-group-small flex-nowrap">
                        <select class="form-select" placeholder="" {{ $user->id == $cr->doctor->id ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ $user->id == $cr->doctor->id ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[docNotesHPI]" @if($user->id == $cr->doctor->id) id="{{ $viewFolder }}_docNotesHPI" @endif rows=3 {{ $user->id == $cr->doctor->id ? 'required' : 'disabled' }}>{{ isset($cr->docNotesHPI) ? $cr->docNotesHPI : '' }}</textarea>
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
                  @else
                  <div class="card mb-3">
                    <div class="card-header">Subject's Complaints</div>
                    <div class="card-body">
                      <small class="text-muted">Helper</small>
                      <div class="input-group input-group-small flex-nowrap">
                        <select class="form-select" placeholder="" {{ $user->id == $cr->doctor->id ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ $user->id == $cr->doctor->id ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[docNotesSubject]" @if($user->id == $cr->doctor->id) id="{{ $viewFolder }}_docNotesSubject" @endif rows=3 {{ $user->id == $cr->doctor->id ? 'required' : 'disabled' }}>{{ isset($cr->docNotesSubject) ? $cr->docNotesSubject : '' }}</textarea>
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
                  @endif
                  <div class="card mb-3">
                    <div class="card-header">Objective Findings</div>
                    <div class="card-body">
                      <small class="text-muted">Helper</small>
                      <div class="input-group input-group-small flex-nowrap">
                        <select class="form-select" placeholder="" {{ $user->id == $cr->doctor->id ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ $user->id == $cr->doctor->id ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[docNotes]" @if($user->id == $cr->doctor->id) id="{{ $viewFolder }}_docNotes" @endif rows=3 {{ $user->id == $cr->doctor->id ? 'required' : 'disabled' }}>{{ isset($cr->docNotes) ? $cr->docNotes : '' }}</textarea>
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
                    <input class="form-control" list="icdCodeList" id="{{ $viewFolder }}_icd_code" name="{{ $viewFolder }}[icd_code]" value="{{ isset($referedDoctorArr) ? implode(',', $referedDoctorArr) : '' }}" autocomplete="off">
                    <label for="{{ $viewFolder }}_icd_code">Primary Diagnosis</label>
                    <small id="help_{{ $viewFolder }}_icd_code" class="text-muted"></small>
                  </div>
                  <div class="card mb-3">
                    <div class="card-header">Secondary Diagnosis</div>
                    <div class="card-body">
                      <small class="text-muted">Helper</small>
                      <div class="input-group input-group-small flex-nowrap">
                        <select class="form-select" placeholder="" {{ $user->id == $cr->doctor->id ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ $user->id == $cr->doctor->id ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[assessment]" @if($user->id == $cr->doctor->id) id="{{ $viewFolder }}_assessment" @endif rows=3 {{ $user->id == $cr->doctor->id ? 'required' : 'disabled' }}>{{ isset($cr->assessment) ? $cr->assessment : '' }}</textarea>
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
                        <select class="form-select" placeholder="" {{ $user->id == $cr->doctor->id ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ $user->id == $cr->doctor->id ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[planMed]" @if($user->id == $cr->doctor->id) id="{{ $viewFolder }}_planMed" @endif rows=3 {{ $user->id == $cr->doctor->id ? 'required' : 'disabled' }}>{{ isset($cr->planMed) ? $cr->planMed : '' }}</textarea>
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
                        <select class="form-select" placeholder="" {{ $user->id == $cr->doctor->id ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ $user->id == $cr->doctor->id ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[plan]" @if($user->id == $cr->doctor->id) id="{{ $viewFolder }}_plan" @endif rows=3 {{ $user->id == $cr->doctor->id ? 'required' : 'disabled' }}>{{ isset($cr->plan) ? $cr->plan : '' }}</textarea>
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
                        <select class="form-select" placeholder="" {{ $user->id == $cr->doctor->id ? '' : 'disabled' }}>
                          <option value=""></option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" {{ $user->id == $cr->doctor->id ? '' : 'disabled' }}>Delete Helper</button>
                      </div>
                      <small class="text-muted">Content</small>
                      <textarea class="form-control" name="{{ $viewFolder }}[planRem]" @if($user->id == $cr->doctor->id) id="{{ $viewFolder }}_planRem" @endif rows=3 {{ $user->id == $cr->doctor->id ? 'required' : 'disabled' }}>{{ isset($cr->planRem) ? $cr->planRem : '' }}</textarea>
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
              <div class="carousel-indicators">
                @if(!empty($datum->consultation_files[0]->file_link))
                  @foreach($datum->consultation_files as $ind=>$file)
                <button type="button" data-bs-target="#carouselCur" data-bs-slide-to="{{ $ind }}" {{ $ind == 0 ? 'class=active aria-current=true' : '' }} aria-label="Slide {{ $ind+1 }}"></button>
                  @endforeach
                @else
                <button type="button" data-bs-target="#carouselCur" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                @endif
              </div>
              <div class="carousel-inner">
                @if(!empty($datum->consultation_files[0]->file_link))
                  @foreach($datum->consultation_files as $ind=>$file)
                <div class="carousel-item {{ $ind == 0 ? 'active' : '' }}">
                  <img src="{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}" class="d-block w-100" alt="">
                </div>  
                  @endforeach
                @else
                <div class="carousel-item active">
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
              <input class="form-control" type="file" id="{{ $viewFolder }}_files" name="{{ $viewFolder }}[ConsultationFile][files][]" accept="image/png, image/gif, image/jpeg" multiple>
            </div>
            <div class="row overflow-auto" id="image_preview_saved" style="max-height:500px">
              @if(isset($datum->consultation_files))
                @foreach($datum->consultation_files as $ind => $file)
                @php
                  $exAr = explode('/', $file->file_link);
                @endphp
              <div class='img-div' data-bs-target="#carouselCur" data-bs-slide-to="{{ $ind }}" id='img-div-save{{ $ind }}'><img src='{{ stristr($file->file_link, 'uploads') ? asset('storage/' . $file->file_link)  : asset(str_replace('public', 'storage', $file->file_link)) }}' class='img-thumbnail' title='{{ $exAr[sizeof($exAr)-1] }}'><div class='middle'><button id='action-icon' value='img-div-save{{ $ind }}' class='btn btn-danger' role='{{ $exAr[sizeof($exAr)-1] }}' saved='{{ $file->id }}'><i class='bi bi-trash'></i></button></div></div>
                @endforeach
              @endif
            </div>
            <div class="row" id="image_preview"></div>
          </div>
          @if($user->id == $datum->doctor->id)
          <div id="presCurDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            <div class="card mb-3">
              <div class="card-header">Prescription View</div>
              <div class="card-body">
                <iframe id="iframePresc" src="{{ file_exists(public_path('storage/prescription_files/' . $datum->id . '_' . $datum->patient->l_name . '.pdf')) ? asset('storage/prescription_files/' . $datum->id . '_' . $datum->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" width="100%" height="300" style="border:1"></iframe>
                <small class="form-text text-muted">To print or download check the upper right part</small>
              </div>
              <div class="card-footer">
                <button id="createPDFButPresc" type="button" class="btn btn-{{ $bgColor }} btn-sm" {{ $datum->prescription == '' ? 'disabled' : '' }} onclick="
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
                            $('#iframePresc').attr('src', data);
                          }
                        });
                    }
                  });

                ">Create PDF</button>
              </div>
            </div>
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
                  <select class="form-select" placeholder="">
                    <option value=""></option>
                  </select>
                  <button class="btn btn-outline-secondary" type="button" id="button-addon2">Delete Helper</button>
                </div>
                <small class="text-muted">Content</small>
                <textarea class="form-control" name="{{ $viewFolder }}[prescription]" id="{{ $viewFolder }}_prescription" rows=3 onblur="
                  if($(this).val() == ''){
                    $('#createPDFButPresc').prop('disabled', true);
                  }else{
                    $('#createPDFButPresc').prop('disabled', false);
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
            <div class="card mb-3">
              <div class="card-header">Med Cert View</div>
              <div class="card-body">
                <iframe id="iframeMedCert" src="{{ file_exists(public_path('storage/med_cert_files/' . $datum->id . '_' . $datum->patient->l_name . '.pdf')) ? asset('storage/med_cert_files/' . $datum->id . '_' . $datum->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" width="100%" height="300" style="border:1"></iframe>
                <small class="form-text text-muted">To print or download check the upper right part</small>
              </div>
              <div class="card-footer">
                <button id="createPDFButMedCert" type="button" class="btn btn-{{ $bgColor }} btn-sm" {{ ($datum->findings == '' || $datum->diagnosis == '' || $datum->recommendations == '') ? 'disabled' : '' }} onclick="
                  $('#doctors_home_submit_type').val('Pause');
                  $.ajax({
                    type: 'POST',
                    data: $('#bookMod').serialize(),
                    url: '{{ Route::has($viewFolder . '.' . $formAction) ? route($viewFolder . '.' . $formAction, $datum->id) : ''}}',
                    success:
                    function (){
                        $.ajax({
                          type: 'GET',
                          url: '{{ Route::has($viewFolder . '.pdfMedCert') ? route($viewFolder . '.pdfMedCert', $datum->id) : '' }}',
                          success:
                          function (data){
                            $('#iframeMedCert').attr('src', data);
                          }
                        });
                    }
                  });

                ">Create PDF</button>
              </div>
            </div>
            <div class="form-floating mb-3">
              <textarea class="form-control" name="{{ $viewFolder }}[findings]" id="{{ $viewFolder }}_findings" rows=3 onblur="
                  if($('#{{ $viewFolder }}_findings').val() == '' || $('#{{ $viewFolder }}_diagnosis').val() == '' || $('#{{ $viewFolder }}_recommendations').val() == ''){
                    $('#createPDFButMedCert').prop('disabled', true);
                  }else{
                    $('#createPDFButMedCert').prop('disabled', false);
                  }
                ">{{ isset($datum->findings) ? $datum->findings : '' }}</textarea>
              <label for="{{ $viewFolder }}_findings" class="form-label">Findings</label>
              <small id="help_{{ $viewFolder }}_findings" class="text-muted"></small>
            </div>
            <div class="form-floating mb-3">
              <textarea class="form-control" name="{{ $viewFolder }}[diagnosis]" id="{{ $viewFolder }}_diagnosis" rows=3 onblur="
                  if($('#{{ $viewFolder }}_findings').val() == '' || $('#{{ $viewFolder }}_diagnosis').val() == '' || $('#{{ $viewFolder }}_recommendations').val() == ''){
                    $('#createPDFButMedCert').prop('disabled', true);
                  }else{
                    $('#createPDFButMedCert').prop('disabled', false);
                  }
                ">{{ isset($datum->diagnosis) ? $datum->diagnosis : '' }}</textarea>
              <label for="{{ $viewFolder }}_diagnosis" class="form-label">Diagnosis</label>
              <small id="help_{{ $viewFolder }}_diagnosis" class="text-muted"></small>
            </div>
            <div class="form-floating mb-3">
              <textarea class="form-control" name="{{ $viewFolder }}[recommendations]" id="{{ $viewFolder }}_recommendations" rows=3 onblur="
                  if($('#{{ $viewFolder }}_findings').val() == '' || $('#{{ $viewFolder }}_diagnosis').val() == '' || $('#{{ $viewFolder }}_recommendations').val() == ''){
                    $('#createPDFButMedCert').prop('disabled', true);
                  }else{
                    $('#createPDFButMedCert').prop('disabled', false);
                  }
                ">{{ isset($datum->recommendations) ? $datum->recommendations : '' }}</textarea>
              <label for="{{ $viewFolder }}_recommendations" class="form-label">Recommendations</label>
              <small id="help_{{ $viewFolder }}_recommendations" class="text-muted"></small>
            </div>
          </div>
          <div id="admitCurDiv" style="display:none" class="container border border-1 border-top-0 mb-3 p-3">
            <div class="card mb-3">
              <div class="card-header">Admitting Orders Preview</div>
              <div class="card-body">
                <iframe id="iframeAdmitting" src="{{ file_exists(public_path('storage/admitting_order_files/' . $datum->id . '_' . $datum->patient->l_name . '.pdf')) ? asset('storage/admitting_order_files/' . $datum->id . '_' . $datum->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" width="100%" height="300" style="border:1"></iframe>
                <small class="form-text text-muted">To print or download check the upper right part</small>
              </div>
              <div class="card-footer">
                <button id="createPDFButAddmitting" type="button" class="btn btn-{{ $bgColor }} btn-sm" {{ ($datum->procedure_ao == '' || $datum->admittingOrder == '') ? 'disabled' : '' }} onclick="
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
                            $('#iframeAdmitting').attr('src', data);
                            // var iFrame = $('#iframeAdmitting');
                            // iFrame.load(data);
                            // $('#iframeAdmitting').attr('src', $('#iframeAdmitting').attr('src'));
                          }
                        });
                    }
                  });
                ">Create PDF</button>
              </div>
            </div>
            <div class="form-floating mb-3">
              <input class="form-control" type="date" name="{{ $viewFolder }}[con_date_ao]" id="{{ $viewFolder }}_con_date_ao" value="{{ isset($datum->con_date_ao) ? $datum->con_date_ao : '' }}" placeholder="">
              <label for="{{ $viewFolder }}_con_date_ao" class="form-label">Contemplated Date of Procedure</label>
              <small id="help_{{ $viewFolder }}_con_date_ao" class="text-muted"></small>
            </div>
            <div class="card mb-3">
              <div class="card-header">Procedure</div>
              <div class="card-body">
                <small class="text-muted">Helper</small>
                <div class="input-group input-group-small flex-nowrap">
                  <select class="form-select" id="{{ $viewFolder }}_procedure_aoSelect" placeholder="">
                    <option value=""></option>
                  </select>
                  <button class="btn btn-outline-secondary" type="button" id="button-addon2">Delete Helper</button>
                </div>
                <small class="text-muted">Content</small>
                <textarea class="form-control" name="{{ $viewFolder }}[procedure_ao]" id="{{ $viewFolder }}_procedure_ao" rows=3 onblur="
                    if(($('#{{ $viewFolder }}_procedure_ao').val() || $('#{{ $viewFolder }}_admittingOrder').val()) == ''){
                      $('#createPDFButAddmitting').prop('disabled', true);
                    }else{
                      $('#createPDFButAddmitting').prop('disabled', false);
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
              <select class="form-select" name="{{ $viewFolder }}[anesthesia_type_ao]" id="{{ $viewFolder }}_anesthesia_type_ao" placeholder="">
                <option value="None" {{ (isset($datum->anesthesia_type_ao) && $datum->anesthesia_type_ao == 'None') ? 'selected' : ''}}>None</option>
                <option value="Regional Block" {{ (isset($datum->anesthesia_type_ao) && $datum->anesthesia_type_ao == 'Regional Block') ? 'selected' : ''}}>Regional Block</option>
                <option value="IV Sedation" {{ (isset($datum->anesthesia_type_ao) && $datum->anesthesia_type_ao == 'IV Sedation') ? 'selected' : ''}}>IV Sedation</option>
                <option value="General Anesthesia" {{ (isset($datum->anesthesia_type_ao) && $datum->anesthesia_type_ao == 'General Anesthesia') ? 'selected' : ''}}>General Anesthesia</option>
              </select>
              <label for="{{ $viewFolder }}_anesthesia_type_ao">Anesthesia Type</label>
              <small id="help_{{ $viewFolder }}_anesthesia_type_ao" class="text-muted"></small>
            </div>
            <div class="form-floating mb-3">
              <input class="form-control" type="text" name="{{ $viewFolder }}[anesthesiologist_ao]" id="{{ $viewFolder }}_anesthesiologist_ao" placeholder="" value="{{ isset($datum->anesthesiologist_ao) ? $datum->anesthesiologist_ao : '' }}">
              <label for="{{ $viewFolder }}_anesthesiologist_ao" class="form-label">Anesthesiologist</label>
              <small id="help_{{ $viewFolder }}_anesthesiologist_ao" class="text-muted"></small>
            </div>
            <div class="card mb-3">
              <div class="card-header">Admitting Details</div>
              <div class="card-body">
                <small class="text-muted">Helper</small>
                <div class="input-group input-group-small flex-nowrap">
                  <select class="form-select" id="{{ $viewFolder }}_admittingOrderSelect" placeholder="">
                    <option value=""></option>
                  </select>
                  <button class="btn btn-outline-secondary" type="button" id="button-addon2">Delete Helper</button>
                </div>
                <small class="text-muted">Content</small>
                <textarea class="form-control" name="{{ $viewFolder }}[admittingOrder]" id="{{ $viewFolder }}_admittingOrder" rows=3 onblur="
                    if(($('#{{ $viewFolder }}_procedure_ao').val() || $('#{{ $viewFolder }}_admittingOrder').val()) == ''){
                      $('#createPDFButAddmitting').prop('disabled', true);
                    }else{
                      $('#createPDFButAddmitting').prop('disabled', false);
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
          @endif
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
          
          if(bookingObj.consultation.vaod_den == '')
            eyeStr += '<strong>UCVA OD:</strong> <span class="text-primary">' + bookingObj.consultation.vaod_num + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          else
            eyeStr += '<strong>UCVA OD:</strong> <span class="text-primary">' + bookingObj.consultation.vaod_num + ' / ' + bookingObj.consultation.vaod_den + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          
          if(bookingObj.consultation.vaodcor_den == '')
            eyeStr += '<strong>UCVA OD w/ Correction:</strong> <span class="text-primary">' + bookingObj.consultation.vaodcor_num + '</span><br> ';
          else
            eyeStr += '<strong>UCVA OD w/ Correction:</strong> <span class="text-primary">' + bookingObj.consultation.vaodcor_num + ' / ' + bookingObj.consultation.vaodcor_den + '</span><br> ';
          
          if(bookingObj.consultation.vaos_den == '')
            eyeStr += '<strong>UCVA OS:</strong> <span class="text-primary">' + bookingObj.consultation.vaos_num + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          else
            eyeStr += '<strong>UCVA OS:</strong> <span class="text-primary">' + bookingObj.consultation.vaos_num + ' / ' + bookingObj.consultation.vaos_den + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';

          if(bookingObj.consultation.vaoscor_den == '')
            eyeStr += '<strong>UCVA OS w/ Correction:</strong> <span class="text-primary">' + bookingObj.consultation.vaoscor_num + '</span><br> ';
          else
            eyeStr += '<strong>UCVA OS w/ Correction:</strong> <span class="text-primary">' + bookingObj.consultation.vaoscor_num + ' / ' + bookingObj.consultation.vaoscor_den + '</span><br> ';
          
          if(bookingObj.consultation.pinod_den == '')
            eyeStr += '<strong>BCVA OD:</strong> <span class="text-primary">' + bookingObj.consultation.pinod_num + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          else
            eyeStr += '<strong>BCVA OD:</strong> <span class="text-primary">' + bookingObj.consultation.pinod_num + ' / ' + bookingObj.consultation.pinod_den + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          
          if(bookingObj.consultation.pinodcor_den == '')
            eyeStr += '<strong>BCVA OD w/ Correction:</strong> <span class="text-primary">' + bookingObj.consultation.pinodcor_num + '</span><br> ';
          else
            eyeStr += '<strong>BCVA OD w/ Correction:</strong> <span class="text-primary">' + bookingObj.consultation.pinodcor_num + ' / ' + bookingObj.consultation.pinodcor_den + '</span><br> ';
          
          if(bookingObj.consultation.pinos_den == '')
            eyeStr += '<strong>BCVA OS:</strong> <span class="text-primary">' + bookingObj.consultation.pinos_num + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          else
            eyeStr += '<strong>BCVA OS:</strong> <span class="text-primary">' + bookingObj.consultation.pinos_num + ' / ' + bookingObj.consultation.pinos_den + '</span>&nbsp;&nbsp;<span class="text-muted">|</span>&nbsp;&nbsp;';
          
          if(bookingObj.consultation.pinodcor_den == '')
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
            grid = '';
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
              grid += '<div class="img-div" data-bs-target="#carouselPrev" data-bs-slide-to="' + index + '" id="img-div-save' + index + '""><img src="' + item.file_link + '" class="img-thumbnail"><div class="middle"><button id="action-icon" value="img-div-save' + index + '" class="btn btn-danger" disabled><i class="bi bi-trash"></i></button></div></div>';
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
            url: '{{ Route::has('clinics_home.deleteUploadedFile') ? route('clinics_home.deleteUploadedFile') : ''}}/' + $(this).attr('saved')
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
  $("#{{ $viewFolder }}_icd_code").on("input", function () {
      val = $(this).val();
      $.ajax({
        type: 'GET',
        url: '{{ Route::has('doctors_home.getIcdCode') ? route('doctors_home.getIcdCode') : ''}}/' + val,
        success: function(data){
          icdCodeObj = jQuery.parseJSON(data);
          var options = "";
          icdCodeObj.forEach(function (item, index){
              options  += '<option value="' + item.icd_code + '">' + item.details + '</option>';
          });
          $("#icdCodeList").html(options);
        }
      });
    });

</script>
