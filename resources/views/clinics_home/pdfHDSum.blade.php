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
            font-size:6pt;
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
            border: 1px solid black;
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
            <p>{{ $datum->clinic->address }}</p>
            <p>Contact Numbers:{{ $datum->clinic->tel }}/{{ $datum->clinic->mobile_no }}</p>
        </div>
        <div class="item" style="width: 4in; height:90px">
            <center><H1>Hemodialysis Summary<br>Sheet</H1></center>
        </div>
    </div>
    <div>
        <div class="item" style="width: 2.25in;">Patient: {{ $datum->patient->name }}</div>
        <div class="item" style="width: 2.3in;">Age/Sex: {{ floor((strtotime($datum->bookingDate) - strtotime($datum->patient->birthdate))/(60*60*24*365.25)) . '/' . $datum->patient->gender }}</div>
        <div class="item" style="width: 2.3in;">Patient Number: {{ $datum->patient_id }}</div>
    </div>
    <div>
        <div class="item" style="width: 2.25in;">Attending Nephrologist: Dr. {{ $datum->doctor->name }}</div>
        <div class="item" style="width: 2.3in;">Diagnosis: </div>
        <div class="item" style="width: 2.3in;">Allergies: </div>
    </div>
    <div>
        <table style="width: 7.27in; margin:0px; padding:0px;" border="1" cellspacing="0">
            <thead>
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
            <tbody">
            @foreach ($allBooking as $ind=>$dat)
              <tr id="hdBooking_{{ $dat->id }}">
                  <td>{{ $dat->treatment_number }}</td>
                  <td>{{ $dat->bookingDate }}</td>
                  <td>{{ $dat->mac_use }}</td>
                  <td>{{ $dat->dry_weight }}<</td>
                  <td>{{ $dat->weight }}</td>
                  <td>{{ $dat->post_weight }}</td>
                  <td>{{ $dat->bpS . '/' . $dat->bpD }}</td>
                  <td>{{ $dat->post_bpS . '/' . $dat->post_bpD }}</td>
                  <td>{{ $dat->total_uf_goal }}</td>
                  <td>{{ $dat->weight_loss }}</td>
                  <td>{{ isset($dat->consultation_meds()->where('medication', 'like', '%epo%')->get()[0]->dosage) ? $dat->consultation_meds()->where('medication', 'like', '%epo%')->get()[0]->dosage : '' }}</td>
                  <td>{{ isset($dat->consultation_meds()->where('medication', 'like', '%iron%')->get()[0]->dosage) ? $dat->consultation_meds()->where('medication', 'like', '%iron%')->get()[0]->dosage : '' }}</td>
                  <td>{{ nl2br($dat->dialysis_complication) }}</td>
                  <td>{{ $dat->creator->name }}</td>
              </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    
</body>

