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

    <table border="1" cellspacing="0" width="100%">
        <tr>
            <td colspan="2"><strong>Date:</strong> {{ $datum->bookingDate }}</td>
        </tr>
        <tr>
            <td><strong>Name:</strong> {{ $datum->patient->name }}</td>
            <td><strong>Age/Sex:</strong> {{ floor((strtotime($datum->bookingDate) - strtotime($datum->patient->birthdate))/(60*60*24*365.25)) }}/{{ $datum->patient->gender }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Diagnosis:</strong> {{ $datum->assessment }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Procedure:</strong> {{ $datum->procedure_details }} {{ $datum->procedure_plan }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Surgeon:</strong> Dr. {{ $datum->doctor->name }}</td>
        </tr>
        <tr>
            <td><strong>Anesthesiologist:</strong> {{ $datum->anesthesiologist_ao }}</td>
            <td><strong>Anesthesia:</strong> {{ $datum->anesthesia_type_ao }}</td>
        </tr>
        <tr>
            <td><strong>Time Admitted:</strong></td>
            <td><strong>Time Discharged:</strong></td>
        </tr>
    </table>
    
    <center><h3>OPERATIVE TECHNIQUE</h3></center>

    <p>
        One drop of topical anesthesia applied to both eyes <br>
        Periorbital area scrubbed with 10% Povidone iodine solution <br>
        Patient is draped <br>
        Tegaderm is applied over the lids <br>
        Lid retractors applied <br>
        2% lidocaine applied topically <br>
        Side port incision with 15 degrees knife <br>
        Main incision port made with 2.75mm keratome knife <br>
        1% intracameral lidocaine injected into the anterior chamber <br>
        Capsule dye injected and then washed out <br>
        OVD injected <br>
        Capsulorrhexis performed <br>
        Hydrodissection and hydro-dilineation performed with BSS <br>
        Lens nucleus removed with phacoemulsification <br>
        Cortical material removed by Irrigation and aspiration <br>
        OVD injected to for the capsular bag <br>
        Intra-ocular lens injected via main port <br>
        Irrigation and aspiration of OVD performed <br>
        Intracameral injection of carbachol <br>
        Intracameral injection of antibiotic <br>
        Tested for leak <br>
        Lid retractors removed
    </p>
    
    
    <br>
    <br>
    <br>
    <br>
    <span>Surgeon: {{ $datum->doctor->name }} (Name & Signature)</span>
    <br>
    <span>Date: {{ date('Y-m-d') }}</span>
</body>

