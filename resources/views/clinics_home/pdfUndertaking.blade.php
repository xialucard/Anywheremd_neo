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
    
    <center><h2>Undertaking</h2></center>
    <center>
        <p>I hereby undertake in in relation to procedures I have performed in the {{ $datum->clinic->name }},</p>
        <br>
        <p>that in the event that any PhilHealth reimbursement claims filed by <strong>Center</strong>, for and on my behalf, are denied for reasons <strong>not attributable to any error committed by the Center’s personnel</strong>, </p>
        <br>
        <p>that I will reimburse {{ $datum->clinic->name }}, upon notice and without need of further demand, for any and all costs— including facility fees and other related charges.</p>
        <br>
        <p>I further authorize the Center to deduct from my future professional fees any and all amounts that should have been reimbursable to the Center.</p>
        <br>
        <p>For claims returned to the Center (RTH) due to deficiencies related to patient or physician requirements, I commit to submit the required documents or corrections <strong>no later than two (2) weeks before the standard 60‑day RTH deadline</strong>. I understand that failure to comply shall render me liable to reimburse the Center for the full amount of the claim.</p>
        <br>
        <p>__________________________________________________________________</p>
    </center>
    
    
    <br>
    <br>
    <br>
    <br>
    <span>Doctor: Dr. {{ isset($referal_conso->doctor->name) ? $referal_conso->doctor->name : (!isset($referal_conso) ? $datum->doctor->name : '') }} (Name & Signature)</span>
    <br>
    <span>Date: {{ isset($referal_conso->bookingDate) ? date('F d, Y', strtotime($referal_conso->bookingDate)) : (!isset($referal_conso) ? date('F d, Y', strtotime($datum->bookingDate)) : '') }}</span>
    <br>
    <span>Booking Number: {{ isset($referal_conso->id) ? $referal_conso->id : (!isset($referal_conso) ? $datum->id : '') }}</span>
</body>

