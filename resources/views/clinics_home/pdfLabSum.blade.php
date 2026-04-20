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
                <th rowspan="2">Date</th>
                <th rowspan="2">Hemoglobin</th>
                <th rowspan="2">Hematocrit</th>
                <th rowspan="2">RBC</th>
                <th rowspan="2">WBC</th>
                <th colspan="2">Dialysis Adequacy</th>
                <th colspan="11">Blood Chemistry</th>
                <th colspan="4">Iron Studies</th>
                <th colspan="3">Hepatitis Profile</th>
              </tr>
              <tr>  
                <th>URR</th>
                <th>Kt/V</th>
                <th>Pre BUN</th>
                <th>Post BUN</th>
                <th>Creatinine</th>
                <th>Serum Albumin</th>
                <th>Sodium</th>
                <th>Potassium</th>
                <th>Phosphorus</th>
                <th>Ionized Calcium</th>
                <th>Uric Acid</th>
                <th>SGPT</th>
                <th>SGOT</th>
                <th>Serum Ferritin</th>
                <th>Serum Iron</th>
                <th>TIBC</th>
                <th>TSAT</th>
                <th>HBsAg</th>
                <th>Anti-HBS</th>
                <th>Anti-HCV</th>
              </tr>
            </thead>
            <tbody">
            @foreach ($allBooking as $ind=>$dat)
            <tr id="hdBooking_{{ $dat->id }}">
                <td>{{ $dat->bookingDate }}</td>
                <td>{{ $dat->hemoglobin }}</td>
                <td>{{ $dat->hematocrit }}</td>
                <td>{{ $dat->rbc }}</td>
                <td>{{ $dat->wbc }}</td>
                <td>{{ number_format($dat->urr, 2) }}</td>
                <td>{{ number_format($dat->ktv2, 2) }}</td>
                <td>{{ $dat->pre_bun }}</td>
                <td>{{ $dat->post_bun }}</td>
                <td>{{ $dat->creatinine }}</td>
                <td>{{ $dat->serum_albumin }}</td>
                <td>{{ $dat->sodium }}</td>
                <td>{{ $dat->potassium }}</td>
                <td>{{ $dat->phosphorus }}</td>
                <td>{{ $dat->ionized_calcium }}</td>
                <td>{{ $dat->uric_acid }}</td>
                <td>{{ $dat->sgpt }}</td>
                <td>{{ $dat->sgot }}</td>
                <td>{{ $dat->serum_ferritin }}</td>
                <td>{{ $dat->serum_iron }}</td>
                <td>{{ $dat->tibc }}</td>
                <td>{{ number_format($dat->tsat, 2) }}</td>
                <td>{{ $dat->hbsag }}</td>
                <td>{{ $dat->anti_hbs }}</td>
                <td>{{ $dat->anti_hcv }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    
</body>

