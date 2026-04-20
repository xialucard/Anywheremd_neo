@php
    unset($referal_conso);
    // $referal_conso = array();
    if(isset($datum->clinic->id))
        $clinicDat = $datum->clinic->id;
    if(isset($datum->doctor->id))
        $doctorDat = $datum->doctor->id;
    $key = false;
    if(isset($datum->parent_consultation)){
        $referal_conso = $datum;
        $datum = $datum->parent_consultation;
        $key = true;
    }
    // print_r($referal_conso)
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ 'hd_' . $datum->id . '-' . $datum->treatment_number }}.pdf</title>
    <style>
        body {
            font-size:12pt;
            font-family: Arial, Helvetica, sans-serif;
        }
        p {
            padding: 3px;
            margin: 0px;
        }
        .item {
            display: inline-block;
            padding: 5px;
            margin: 0px;
            font-weight: bold;
            /* border: 1px solid black; */
            vertical-align: top; /* Important for alignment */
        }
        .form-check {
            display: inline-block;
            font-size:6pt;
            padding: 0px 3px;
            margin: 0px;
            vertical-align: top; /* Important for alignment */
        }
        .form-check-not-inline {
            font-size:6pt;
            padding: 0px 3px;
            margin: 0px;
            vertical-align: top; /* Important for alignment */
        }
        input[type="checkbox"] {
            vertical-align: middle; /* Aligns the checkbox vertically with the middle of the label text */
        }
        input[type="radio"] {
            vertical-align: middle; /* Aligns the radio vertically with the middle of the label text */
        }
        label {
            vertical-align: middle; /* Ensures the label also aligns with the middle */
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
     <div>
        @if(isset($referal_conso->clinic->letterhead_pic) && $referal_conso->clinic->letterhead_pic != '')
            <img src="{{ public_path('storage/printable_forms_files/' . $referal_conso->clinic->letterhead_pic) }}" alt="" style="width:7.4in; margin-bottom:5px">
        @elseif(!isset($referal_conso) && $datum->clinic->letterhead_pic)
            <img src="{{ public_path('storage/printable_forms_files/' . $datum->clinic->letterhead_pic) }}" alt="" style="width:7.4in; margin-bottom:5px">
        @else
        <div class="item" style="width: 3in; height:90px">
            <h1 style="margin-bottom: 5px">{{ isset($referal_conso->clinic->name) ? $referal_conso->clinic->name : (!isset($referal_conso) ? $datum->clinic->name : '') }}</h1>
        </div>
        <div class="item" style="width: 4in; height:90px">
            <p>{{ isset($referal_conso->clinic->address) ? $referal_conso->clinic->address : (!isset($referal_conso) ? $datum->clinic->address : '') }}</p>
            <p>Contact Numbers:{{ isset($referal_conso->clinic->tel) ? $referal_conso->clinic->tel : (!isset($referal_conso) ? $datum->clinic->tel : '') }}/{{ isset($referal_conso->clinic->mobile_no) ? $referal_conso->clinic->mobile_no : (!isset($referal_conso) ? $datum->clinic->mobile_no : '') }}</p>
        </div>
        @endif
    </div>
    
    <center><h3>Post-Operative Discharge Summary</h3></center>

    <p><strong>Patient Name:</strong> {{ $datum->patient->name }}</p>
    <p><strong>Age/Sex:</strong> {{ floor((strtotime($datum->bookingDate) - strtotime($datum->patient->birthdate))/(60*60*24*365.25)) }}/{{ $datum->patient->gender }}</p>
    <p><strong>Hospital/Clinic No.:</strong> {{ isset($referal_conso->clinic->name) ? $referal_conso->clinic->name : (!isset($referal_conso) ? $datum->clinic->name : '') }}/{{ isset($referal_conso->clinic->mobile_no) ? $referal_conso->clinic->mobile_no : (!isset($referal_conso) ? $datum->clinic->mobile_no : '') }}</p>
    <p><strong>Date of Surgery:</strong> {{ isset($referal_conso->clinic->bookingDate) ? date('F d, Y', strtotime($referal_conso->clinic->bookingDate)) : (!isset($referal_conso) ? date('F d, Y', strtotime($datum->bookingDate)) : '') }}</p>
    <p><strong>Surgeon:</strong> Dr. {{ isset($referal_conso->doctor->name) ? $referal_conso->doctor->name : (!isset($referal_conso) ? $datum->doctor->name : '') }}</p>
    <p><strong>Procedure:</strong> {{ isset($referal_conso->procedure_details) ? $referal_conso->procedure_details : (!isset($referal_conso) ? $datum->procedure_details : '') }} {{ isset($referal_conso->plan) ? $referal_conso->plan : (!isset($referal_conso) ? $datum->plan : '') }}</p>
    <p><strong>Booking Number:</strong> {{ isset($referal_conso->id) ? $referal_conso->id : (!isset($referal_conso) ? $datum->id : '') }}</p>
    <ol>
        <li><strong>Pre-Operative Diagnosis:</strong><br>{!! isset($referal_conso->printable_form['pre_op_diagnosis']) ? nl2br($referal_conso->printable_form['pre_op_diagnosis']) : (!isset($referal_conso) ? nl2br($datum->printable_form['pre_op_diagnosis']) : '') !!}</li>
        <li><strong>Post-Operative Diagnosis:</strong><br>{!! isset($referal_conso->printable_form['post_op_diagnosis']) ? nl2br($referal_conso->printable_form['post_op_diagnosis']) : (!isset($referal_conso) ? nl2br($datum->printable_form['post_op_diagnosis']) : '') !!}</li>
        <li><strong>Procedure Performed:</strong><br>{!! isset($referal_conso->printable_form['procedure_performed']) ? nl2br($referal_conso->printable_form['procedure_performed']) : (!isset($referal_conso) ? nl2br($datum->printable_form['procedure_performed']) : '') !!}</li>
        <li><strong>Anesthesia Used: {{ isset($referal_conso->anesthesia_type_ao) ? nl2br($referal_conso->anesthesia_type_ao) : (!isset($referal_conso) ? $datum->anesthesia_type_ao : '') }}</strong></li>
        <li><strong>Intraoperative Findings:</strong><br>{!! isset($referal_conso->printable_form['intraoperative_findings']) ? nl2br($referal_conso->printable_form['intraoperative_findings']) : (!isset($referal_conso) ? nl2br($datum->printable_form['intraoperative_findings']) : '') !!}</li>
        <li><strong>Intraoperative Course:</strong><br><input type="checkbox" {{ isset($referal_conso->printable_form['intraoperative_course']) && $referal_conso->printable_form['intraoperative_course'] == 'Unremarkable' ? 'checked' : (!isset($referal_conso) && $datum->printable_form['intraoperative_course'] == 'Unremarkable' ? 'checked' : '') }}>Unremarkable <input type="checkbox" {{ isset($referal_conso->printable_form['intraoperative_course']) && $referal_conso->printable_form['intraoperative_course'] == 'With Complications' ? 'checked' : (!isset($referal_conso) && $datum->printable_form['intraoperative_course'] == 'With Complications' ? 'checked' : '') }}>With complications (specify): {!! isset($referal_conso->printable_form['complication_specify']) ? nl2br($referal_conso->printable_form['complication_specify']) : (!isset($referal_conso) ? nl2br($datum->printable_form['complication_specify']) : '') !!}<</li>
        <li><strong>Estimated Blood Loss:</strong> {{ isset($referal_conso->printable_form['blood_loss']) ? $referal_conso->printable_form['blood_loss'] : (!isset($referal_conso) ? $datum->printable_form['blood_loss'] : '') }} mL</li>
        <li><strong>Specimens Sent:</strong> <input type="checkbox" {{ isset($referal_conso->printable_form['specimen_sent']) && $referal_conso->printable_form['specimen_sent'] == 'yes' ? 'checked' : (!isset($referal_conso) && $datum->printable_form['specimen_sent'] == 'yes' ? 'checked' : '') }}>Yes <input type="checkbox" {{ isset($referal_conso->printable_form['specimen_sent']) && $referal_conso->printable_form['specimen_sent'] == 'no' ? 'checked' : (!isset($referal_conso) && $datum->printable_form['specimen_sent'] == 'no' ? 'checked' : '') }}> No (Details: {!! isset($referal_conso->printable_form['specimen_sent_remarks']) ? nl2br($referal_conso->printable_form['specimen_sent_remarks']) : (!isset($referal_conso) ? nl2br($datum->printable_form['specimen_sent_remarks']) : '') !!})</li>
        <li><strong>Post-Operative Condition:</strong><br><input type="checkbox" {{ isset($referal_conso->printable_form['post_operative_condition']) && $referal_conso->printable_form['post_operative_condition'] == 'Stable' ? 'checked' : (!isset($referal_conso) && $datum->printable_form['post_operative_condition'] == 'Stable' ? 'checked' : '') }}>Stable <input type="checkbox" {{ isset($referal_conso->printable_form['post_operative_condition']) && $referal_conso->printable_form['post_operative_condition'] == 'Requires Observation' ? 'checked' : (!isset($referal_conso) && $datum->printable_form['post_operative_condition'] == 'Requires Observation' ? 'checked' : '') }}> Requires observation<br>Remarks: {!! isset($referal_conso->printable_form['post_operative_condition_remarks']) ? nl2br($referal_conso->printable_form['post_operative_condition_remarks']) : (!isset($referal_conso) ? nl2br($datum->printable_form['post_operative_condition_remarks']) : '') !!}</li>
        <li><strong>Medications Given in Recovery:</strong><br>{!! isset($referal_conso->printable_form['medication_given_recovery']) ? nl2br($referal_conso->printable_form['medication_given_recovery']) : (!isset($referal_conso) ? nl2br($datum->printable_form['medication_given_recovery']) : '') !!}</li>
        <li><strong>Discharge Medications:</strong><br>{!! isset($referal_conso->printable_form['discharge_medication']) ? nl2br($referal_conso->printable_form['discharge_medication']) : (!isset($referal_conso) ? nl2br($datum->printable_form['discharge_medication']) : '') !!}</li>
        <li><strong>Post-Operative Instructions:</strong><br>
            <ul>
                <li>Keep surgical site clean and dry.</li>
                <li>Change dressing as instructed.</li>
                <li>Avoid strenuous activity for {{ isset($referal_conso->printable_form['avoid_days']) ? $referal_conso->printable_form['avoid_days'] : (!isset($referal_conso) ? $datum->printable_form['avoid_days'] : '') }} days.</li>
                <li>Diet: <input type="checkbox" {{ isset($referal_conso->printable_form['diet']) && $referal_conso->printable_form['diet'] == 'Regular' ? 'checked' : (!isset($referal_conso) && $datum->printable_form['diet'] == 'Regular' ? 'checked' : '') }}>Regular <input type="checkbox" {{ isset($referal_conso->printable_form['diet']) && $referal_conso->printable_form['diet'] == 'Soft' ? 'checked' : (!isset($referal_conso) && $datum->printable_form['diet'] == 'Soft' ? 'checked' : '') }}>Soft <input type="checkbox" {{ isset($referal_conso->printable_form['diet']) && $referal_conso->printable_form['diet'] == 'Others' ? 'checked' : (!isset($referal_conso) && $datum->printable_form['diet'] == 'Others' ? 'checked' : '') }}>Others: <br>{!! isset($referal_conso->printable_form['diet_remarks']) ? nl2br($referal_conso->printable_form['diet_remarks']) : (!isset($referal_conso) ? nl2br($datum->printable_form['diet_remarks']) : '') !!}</li>
                <li>Watch for signs of infection: redness, swelling, fever, discharge.</li>
            </ul>
        </li>
        <li><strong>Follow-Up Appointment:</strong><br>
            <p>Date/Time: __________________________</p>
            <p>Location: __________________________</p>
        </li>
        <li><strong>Emergency Contact Instructions:</strong><br>
            <p>Return to ER or call your surgeon if you experience:</p>
            <ul>
                <li>Severe pain unrelieved by medication</li>
                <li>Persistent vomiting</li>
                <li>Bleeding from surgical site</li>
                <li>Fever > 38°C</li>
            </ul>
            <p><strong>Emergency Contact for questions or clarifications:</strong></p>
            <p><strong>{{ isset($referal_conso->clinic->name) ? $referal_conso->clinic->name : (!isset($referal_conso) ? $datum->clinic->name : '') }}/{{ isset($referal_conso->clinic->mobile_no) ? $referal_conso->clinic->mobile_no : (!isset($referal_conso) ? $datum->clinic->mobile_no : '') }}</strong></p>
        </li>
    </ol>
    
    <br>
    <br>
    <br>
    <br>
    <span></span>
    <br>
    <span>Prepared By: (Name & Signature)</span>
    <br>
    <span>Date/Time: {{ isset($referal_conso->bookingDate) ? date('F d, Y', strtotime($referal_conso->bookingDate)) : (!isset($referal_conso) ? date('F d, Y', strtotime($datum->bookingDate)) : '') }}</span>
    <br>
    <br>
    <br>
    @if(((isset($referal_conso) && isset($referal_conso->printable_form['dischargeSumSigKey']) && $referal_conso->printable_form['dischargeSumSigKey'] == 'yes') ? true : ((!isset($referal_conso) && $datum->printable_form['dischargeSumSigKey'] == 'yes') ? true : false)) && ($datum->doctor->sig_pic != '' || $referal_conso->doctor->sig_pic))
    <img src="{{ public_path('storage/doctor_files/' . (isset($referal_conso->doctor->sig_pic) ? $referal_conso->doctor->sig_pic : (!isset($referal_conso) ? $datum->doctor->sig_pic : ''))) }}" style="width:1in"><br>
    @endif
    <span>Doctor: Dr. {{ isset($referal_conso->doctor->name) ? $referal_conso->doctor->name : (!isset($referal_conso) ? $datum->doctor->name : '') }} (Name & Signature)</span>
    <br>
    <span>Date: {{ isset($referal_conso->bookingDate) ? date('F d, Y', strtotime($referal_conso->bookingDate)) : (!isset($referal_conso) ? date('F d, Y', strtotime($datum->bookingDate)) : '') }}</span>
</body>

