@php
    unset($referal_conso);
    $referal_conso = array();
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
        <div class="item" style="width: 3in; height:90px">
            <h1 style="margin-bottom: 5px">{{ $datum->clinic->name }}</h1>
        </div>
        <div class="item" style="width: 4in; height:90px">
            <p>{{ $datum->clinic->address }}</p>
            <p>Contact Numbers:{{ $datum->clinic->tel }}/{{ $datum->clinic->mobile_no }}</p>
        </div>
    </div>
    
    <center><h3>Post-Operative Discharge Summary</h3></center>

    <p><strong>Patient Name:</strong> {{ $datum->patient->name }}</p>
    <p><strong>Age/Sex:</strong> {{ floor((strtotime($datum->bookingDate) - strtotime($datum->patient->birthdate))/(60*60*24*365.25)) }}/{{ $datum->patient->gender }}</p>
    <p><strong>Hospital/Clinic No.:</strong> {{ $datum->clinic->name }}/{{ $datum->clinic->mobile_no }}</p>
    <p><strong>Date of Surgery:</strong> {{ $datum->bookingDate }}</p>
    <p><strong>Surgeon:</strong> Dr. {{ $datum->doctor->name }}</p>
    <p><strong>Procedure:</strong> {{ $datum->procedure_details }} {{ $datum->plan }}</p>
    <ol>
        <li><strong>Pre-Operative Diagnosis:</strong></li>
        <li><strong>Post-Operative Diagnosis:</strong></li>
        <li><strong>Procedure Performed:</strong><br>{!! $datum->procedure_ao != "" ? $datum->procedure_ao : '<br><br>' !!}</li>
        <li><strong>Anesthesia Used: {{ $datum->anesthesia_type_ao }}</strong></li>
        <li><strong>Intraoperative Findings:</strong></li>
        <li><strong>Intraoperative Course:</strong><br><input type="checkbox">Unremarkable <input type="checkbox">With complications (specify): __________________________</li>
        <li><strong>Estimated Blood Loss:</strong> ___________ mL</li>
        <li><strong>Specimens Sent:</strong> <input type="checkbox">Yes <input type="checkbox"> No (Details: ____________________)</li>
        <li><strong>Post-Operative Condition:</strong><br><input type="checkbox">Stable <input type="checkbox"> Requires observation<br>Remarks: __________________________</li>
        <li><strong>Medications Given in Recovery:</strong></li>
        <li><strong>Discharge Medications:</strong><br>
            <ul>
                <li>__________________________ (dose, frequency, duration)</li>
                <li>__________________________ (dose, frequency, duration)</li>
                <li>__________________________ (dose, frequency, duration)</li>
                <li>__________________________ (dose, frequency, duration)</li>
                <li>__________________________ (dose, frequency, duration)</li>
            </ul>
        </li>
        <li><strong>Post-Operative Instructions:</strong><br>
            <ul>
                <li>Keep surgical site clean and dry.</li>
                <li>Change dressing as instructed.</li>
                <li>Avoid strenuous activity for ___ days.</li>
                <li>Diet: <input type="checkbox">Regular <input type="checkbox">Soft <input type="checkbox">Others: ___________</li>
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
            <p><strong>{{ $datum->clinic->name }}/{{ $datum->clinic->mobile_no }}</strong></p>
        </li>
    </ol>
    
    <br>
    <br>
    <br>
    <br>
    <span></span>
    <br>
    <span>Prepared By: {{ $user->name }} (Name & Signature)</span>
    <br>
    <span>Date/Time: {{ date('y-m-d H:i:s') }}</span>
    <br>
    <br>
    <br>
    <span></span>
    <br>
    <span>Doctor: Dr. {{ $datum->doctor->name }} (Name & Signature)</span>
    <br>
    <span>Date:__________________</span>
</body>

