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
            <img src="{{ public_path('storage/printable_forms_files/' . $referal_conso->clinic->letterhead_pic) }}" alt="" style="width:7.4in">
        @elseif(!isset($referal_conso) && $datum->clinic->letterhead_pic)
            <img src="{{ public_path('storage/printable_forms_files/' . $datum->clinic->letterhead_pic) }}" alt="" style="width:7.4in">
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
    
    <center><h3>Nurse Notes</h3></center>
    <table border="1" cellspacing="0" width="100%">
        <tr>
            <th align="left" width="2in">PATIENT’S NAME:</th>
            <td>{{ $datum->patient->name }}</td>
        </tr>
        <tr>
            <th align="left">AGE/SEX:</th>
            <td>{{ floor((strtotime($datum->bookingDate) - strtotime($datum->patient->birthdate))/(60*60*24*365.25)) }}/{{ $datum->patient->gender }}<</td>
        </tr>
        <tr>
            <th align="left">SURGEON:</th>
            <td>Dr. {{ isset($referal_conso->doctor->name) ? $referal_conso->doctor->name : (!isset($referal_conso) ? $datum->doctor->name : '') }}</td>
        </tr>
        <tr>
            <th align="left">DIAGNOSIS:</th>
            <td>{{ isset($referal_conso->assessment) ? $referal_conso->assessment : (!isset($referal_conso) ? $datum->assessment : '') }}</td>
        </tr>
        <tr>
            <th align="left">PROCEDURE:</th>
            <td>{{ isset($referal_conso->procedure_details) ? $referal_conso->procedure_details : (!isset($referal_conso) ? $datum->procedure_details : '') }}</td>
        </tr>
        <tr>
            <th align="left">ANESTHESIOLOGIST:</th>
            <td>{{ isset($referal_conso->anesthesiologist_ao) ? $referal_conso->anesthesiologist_ao : (!isset($referal_conso) ? $datum->anesthesiologist_ao : '') }}</td>
        </tr>
        <tr>
            <th align="left">Booking Number:</th>
            <td>{{ isset($referal_conso->id) ? $referal_conso->id : (!isset($referal_conso) ? $datum->id : '') }}</td>
        </tr>
    </table>
    <br>
    @php
        $temp = json_decode(isset($referal_conso->printable_form['datetime_nurse_notes']) ? $referal_conso->printable_form['datetime_nurse_notes'] : (!isset($referal_conso) ? $datum->printable_form['datetime_nurse_notes'] : ''));
        // unset($datum->printable_form['datetime_nurse_notes']);
        // $datum->printable_form['datetime_nurse_notes'] = $temp;
    @endphp
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <tr>
            <th width="2in">Date/Time</th>
            <th>Details</th>
        </tr>
        <tr>
            <td>{{ isset($temp[0]) ? date('Y-m-d H:i:s', strtotime($temp[0])) : '' }}</td>
            <td>> Received patient ambulatory</td>
        </tr>
        <tr>
            <td>{{ isset($temp[1]) ? date('Y-m-d H:i:s', strtotime($temp[1])) : '' }}</td>
            <td>> Informed consent secured and signed by patient</td>
        </tr>
        <tr>
            <td>{{ isset($temp[2]) ? date('Y-m-d H:i:s', strtotime($temp[2])) : '' }}</td>
            <td>> Vital signs taken and recorded</td>
        </tr>
        <tr>
            <td>{{ isset($temp[3]) ? date('Y-m-d H:i:s', strtotime($temp[3])) : '' }}</td>
            <td>> Patient placed on OR bed in supine position</td>
        </tr>
        <tr>
            <td>{{ isset($temp[4]) ? date('Y-m-d H:i:s', strtotime($temp[4])) : '' }}</td>
            <td>> Given O2 @ 2L/min via nasal cannula</td>
        </tr>
        <tr>
            <td>{{ isset($temp[5]) ? date('Y-m-d H:i:s', strtotime($temp[5])) : '' }}</td>
            <td>> Cardiac monitor placed</td>
        </tr>
        <tr>
            <td>{{ isset($temp[6]) ? date('Y-m-d H:i:s', strtotime($temp[6])) : '' }}</td>
            <td>> Topical anesthesia applied</td>
        </tr>
        <tr>
            <td>{{ isset($temp[7]) ? date('Y-m-d H:i:s', strtotime($temp[7])) : '' }}</td>
            <td>> Asepsis/ antisepsis technique done</td>
        </tr>
        <tr>
            <td>{{ isset($temp[8]) ? date('Y-m-d H:i:s', strtotime($temp[8])) : '' }}</td>
            <td>> Sterile drapes placed aseptically</td>
        </tr>
        <tr>
            <td>{{ isset($temp[9]) ? date('Y-m-d H:i:s', strtotime($temp[9])) : '' }}</td>
            <td>> (PROCEDURE)</td>
        </tr>
        <tr>
            <td>{{ isset($temp[10]) ? date('Y-m-d H:i:s', strtotime($temp[10])) : '' }}</td>
            <td>> Surgery performed by Dr. {{ $datum->doctor->name }}</td>
        </tr>
        <tr>
            <td>{{ isset($temp[11]) ? date('Y-m-d H:i:s', strtotime($temp[11])) : '' }}</td>
            <td>> Topical antibiotic given by doctor’s order</td>
        </tr>
        <tr>
            <td>{{ isset($temp[12]) ? date('Y-m-d H:i:s', strtotime($temp[12])) : '' }}</td>
            <td>> Drapes removed</td>
        </tr>
        <tr>
            <td>{{ isset($temp[13]) ? date('Y-m-d H:i:s', strtotime($temp[13])) : '' }}</td>
            <td>> Transferred to Recovery Room, vital signs monitored</td>
        </tr>
        <tr>
            <td>{{ isset($temp[14]) ? date('Y-m-d H:i:s', strtotime($temp[14])) : '' }}</td>
            <td>> Post – operative care rendered</td>
        </tr>
        <tr>
            <td>{{ isset($temp[15]) ? date('Y-m-d H:i:s', strtotime($temp[15])) : '' }}</td>
            <td>> Endorsed to Peri-operative nurse for post-op instructions</td>
        </tr>
        <tr>
            <td>{{ isset($temp[16]) ? date('Y-m-d H:i:s', strtotime($temp[16])) : '' }}</td>
            <td>> Discharged patient ambulatory</td>
        </tr>
    </table>
    
    <br>
    <br>
    <br>
    <br>
    <span>{{ $user->name }} {{ isset($referal_conso->bookingDate) ? $referal_conso->bookingDate : (!isset($referal_conso) ? $datum->bookingDate : '') }}</span>
    <br>
    <span style="border-top: solid">Operating Room Nurse’s Signature over Printed Name & Date</span>
</body>

