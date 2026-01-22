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
    <center><h3>OPHTHALMOLOGY ADMITTING AND PERI-OP FORM</h3></center>
    <table cellspacing="0" width="100%">
        <tr>
            <td><strong>Name of Patient:</strong> {{ $datum->patient->name }}</td>
            <td><strong>Age/Sex:</strong> {{ floor((strtotime($datum->bookingDate) - strtotime($datum->patient->birthdate))/(60*60*24*365.25)) }}/{{ $datum->patient->gender }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Diagnosis:</strong>{{ $datum->assessment }}</td>
        </tr>
        <tr>
            <td><strong>Procedure:</strong> {{ $datum->patient->name }}</td>
            <td><strong>Anesthesia:</strong> {{ $datum->anesthesia_type_ao }}</td>
        </tr>
        <tr>
            <td><strong>Surgeon:</strong> {{ $datum->doctor->name }}</td>
            <td><strong>Anesthesiology:</strong> {{ $datum->anesthesiologist_ao }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Date:</strong> {{ $datum->bookingDate }}</td>
        </tr>
    </table>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <tr rowspan="2">
            <td width="40%">
                <strong>DOCTOR’S ADMITTING ORDERS</strong><br>
                <p>PLEASE ADMIT MY PATIENT TO THE OPERATING ROOM:</p><br>
                <p>Take Vital signs every 15 mins, one hour prior to surgery.</p><br><br>
                <p>PLEASE DILATE <input type="checkbox"> with :</p><br><br><br>
                <p>PLEASE CONSTRICT <input type="checkbox"> with :</p><br><br><br><br><br><br><br><br><br>
                <span>Dr. {{ $datum->doctor->name }}</span><br>
                <span style="border-top:1px solid">MD signature above printed name</span>
            </td>
            <td width="25%" valign="top">
                <strong>Height:</strong> {{ $datum->height }} cm<br>
                <strong>Weight:</strong> {{ $datum->weight }} kg<br><br><br><br>
                <strong>Vital Signs:</strong><br>
                <strong>BP:</strong> {{ $datum->bpS }}/{{ $datum->bpD }}<br>
                <strong>Heart Rate:</strong> {{ $datum->heart }}<br>
                <strong>O2:</strong> {{ $datum->o2 }}<br>
                <strong>Temp:</strong> {{ $datum->temp }} C<br><br>
                <strong>IOP OD:</strong> {{ $datum->iopod }}<br>
                <strong>IOP OS:</strong> {{ $datum->iopos }}<br><br>
                <strong>Remarks:</strong>
            </td>
            <td width="35%" valign="top">
                <table border="0" cellspacing="0">
                    <tr>
                        <td>
                            <strong>History of Illness</strong><br>
                            <input type="checkbox">HPN <input type="checkbox">DM <input type="checkbox">Heart Disease <br>
                            <input type="checkbox">Asthma/Lung Disease <br>
                            <input type="checkbox">Kidney Disease <br>
                            <input type="checkbox">Thyriod Disease <br>
                            <input type="checkbox">Prostate Disease <br>
                            <input type="checkbox">Allergy: <br>
                            <input type="checkbox">Previous Surgey: <br>
                            <p>Covid 19 Vaccination History:</p> <br><br>
                        </td>
                    </tr>
                    <tr>
                        <td width="35%" valign="top" style="border-top: 1px solid">
                            <p><input type="checkbox">Intake of blood thinner or anti-coagulants eg. clopidogrel, warfarin, heparin, aspirin and the like. <br>IF YES, Date and time of last intake</p><br><br><br>
                            <p><input type="checkbox">Intake of maintenance medications: <br>IF YES, Meds, Date and time of last intake</p><br><br><br>
                        </td>
                    </tr>
                </table>
            </td>
    </table>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <tr>
            <td width="65%">
                <p>ADDITIONAL PERI-OPERATIVE ORDERS</p><br><br><br><br><br><br><br><br><br><br><br><br><br>

            </td>
            <td valign="top">
                <p>Intraoperative Vital Signs</p>
                <p>BP:</p>
                <p>O2:</p>
                <p>Temp:</p>
                <p>Remarks:</p><br><br>
                <p>Circulating Nurse</p>

            </td>
        </tr>
    </table>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <tr>
            <td width="65%" align="center">
                <p></p><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <span>Dr. {{ $datum->doctor->name }}</span><br>
                <span style="border-top:1px solid">MD signature above printed name</span>
            </td>
            <td valign="top">
                <p>Post Operative Vital Signs</p>
                <p>BP:</p>
                <p>O2:</p>
                <p>Temp:</p>
                <p>Remarks:</p><br><br>
                <p>Recovery Room Nurse</p>

            </td>
        </tr>
    </table>
    
</body>

