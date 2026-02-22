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
            <td>Dr. {{ $datum->doctor->name }}</td>
        </tr>
        <tr>
            <th align="left">DIAGNOSIS:</th>
            <td>{{ $datum->assessment }}</td>
        </tr>
        <tr>
            <th align="left">PROCEDURE:</th>
            <td>{{ $datum->procedure_details }} {{ $datum->procedure_plan }}</td>
        </tr>
        <tr>
            <th align="left">ANESTHESIOLOGIST:</th>
            <td>{{ $datum->anesthesiologist_ao }}</td>
        </tr>
    </table>
    <br>
    @php
        $temp = json_decode($datum->printable_form['datetime_nurse_notes']);
        unset($datum->printable_form['datetime_nurse_notes']);
        $datum->printable_form['datetime_nurse_notes'] = $temp;
    @endphp
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <tr>
            <th width="2in">Date/Time</th>
            <th>Details</th>
        </tr>
        <tr>
            <td>{{ isset($datum->printable_form['datetime_nurse_notes'][0]) ? date('Y-m-d H:i:s', strtotime($datum->printable_form['datetime_nurse_notes'][0])) : '' }}</td>
            <td>> Received patient ambulatory</td>
        </tr>
        <tr>
            <td>{{ isset($datum->printable_form['datetime_nurse_notes'][1]) ? date('Y-m-d H:i:s', strtotime($datum->printable_form['datetime_nurse_notes'][1])) : '' }}</td>
            <td>> Informed consent secured and signed by patient</td>
        </tr>
        <tr>
            <td>{{ isset($datum->printable_form['datetime_nurse_notes'][2]) ? date('Y-m-d H:i:s', strtotime($datum->printable_form['datetime_nurse_notes'][2])) : '' }}</td>
            <td>> Vital signs taken and recorded</td>
        </tr>
        <tr>
            <td>{{ isset($datum->printable_form['datetime_nurse_notes'][3]) ? date('Y-m-d H:i:s', strtotime($datum->printable_form['datetime_nurse_notes'][3])) : '' }}</td>
            <td>> Patient placed on OR bed in supine position</td>
        </tr>
        <tr>
            <td>{{ isset($datum->printable_form['datetime_nurse_notes'][4]) ? date('Y-m-d H:i:s', strtotime($datum->printable_form['datetime_nurse_notes'][4])) : '' }}</td>
            <td>> Given O2 @ 2L/min via nasal cannula</td>
        </tr>
        <tr>
            <td>{{ isset($datum->printable_form['datetime_nurse_notes'][5]) ? date('Y-m-d H:i:s', strtotime($datum->printable_form['datetime_nurse_notes'][5])) : '' }}</td>
            <td>> Cardiac monitor placed</td>
        </tr>
        <tr>
            <td>{{ isset($datum->printable_form['datetime_nurse_notes'][6]) ? date('Y-m-d H:i:s', strtotime($datum->printable_form['datetime_nurse_notes'][6])) : '' }}</td>
            <td>> Topical anesthesia applied</td>
        </tr>
        <tr>
            <td>{{ isset($datum->printable_form['datetime_nurse_notes'][7]) ? date('Y-m-d H:i:s', strtotime($datum->printable_form['datetime_nurse_notes'][7])) : '' }}</td>
            <td>> Asepsis/ antisepsis technique done</td>
        </tr>
        <tr>
            <td>{{ isset($datum->printable_form['datetime_nurse_notes'][8]) ? date('Y-m-d H:i:s', strtotime($datum->printable_form['datetime_nurse_notes'][8])) : '' }}</td>
            <td>> Sterile drapes placed aseptically</td>
        </tr>
        <tr>
            <td>{{ isset($datum->printable_form['datetime_nurse_notes'][9]) ? date('Y-m-d H:i:s', strtotime($datum->printable_form['datetime_nurse_notes'][9])) : '' }}</td>
            <td>> (PROCEDURE)</td>
        </tr>
        <tr>
            <td>{{ isset($datum->printable_form['datetime_nurse_notes'][10]) ? date('Y-m-d H:i:s', strtotime($datum->printable_form['datetime_nurse_notes'][10])) : '' }}</td>
            <td>> Surgery performed by Dr. {{ $datum->patient->name }}</td>
        </tr>
        <tr>
            <td>{{ isset($datum->printable_form['datetime_nurse_notes'][11]) ? date('Y-m-d H:i:s', strtotime($datum->printable_form['datetime_nurse_notes'][11])) : '' }}</td>
            <td>> Topical antibiotic given by doctor’s order</td>
        </tr>
        <tr>
            <td>{{ isset($datum->printable_form['datetime_nurse_notes'][12]) ? date('Y-m-d H:i:s', strtotime($datum->printable_form['datetime_nurse_notes'][12])) : '' }}</td>
            <td>> Drapes removed</td>
        </tr>
        <tr>
            <td>{{ isset($datum->printable_form['datetime_nurse_notes'][13]) ? date('Y-m-d H:i:s', strtotime($datum->printable_form['datetime_nurse_notes'][13])) : '' }}</td>
            <td>> Transferred to Recovery Room, vital signs monitored</td>
        </tr>
        <tr>
            <td>{{ isset($datum->printable_form['datetime_nurse_notes'][14]) ? date('Y-m-d H:i:s', strtotime($datum->printable_form['datetime_nurse_notes'][14])) : '' }}</td>
            <td>> Post – operative care rendered</td>
        </tr>
        <tr>
            <td>{{ isset($datum->printable_form['datetime_nurse_notes'][15]) ? date('Y-m-d H:i:s', strtotime($datum->printable_form['datetime_nurse_notes'][15])) : '' }}</td>
            <td>> Endorsed to Peri-operative nurse for post-op instructions</td>
        </tr>
        <tr>
            <td>{{ isset($datum->printable_form['datetime_nurse_notes'][16]) ? date('Y-m-d H:i:s', strtotime($datum->printable_form['datetime_nurse_notes'][16])) : '' }}</td>
            <td>> Discharged patient ambulatory</td>
        </tr>
    </table>
    
    <br>
    <br>
    <br>
    <br>
    <span>{{ $user->name }} {{ date('Y-m-d') }}</span>
    <br>
    <span style="border-top: solid">Operating Room Nurse’s Signature over Printed Name & Date</span>
</body>

