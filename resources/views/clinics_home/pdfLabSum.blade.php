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
                    <th rowspan="2">&nbsp;</th>
                    <th colspan="{{ isset($allBooking) ? sizeof($allBooking) : 0 }}">Date</th>
                </tr>
                <tr>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif  
                    <th>{{ $dat->bookingDate }}</th>
                    @endforeach
                @endif
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Hemoglobin</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ $dat->hemoglobin }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>Hematocrit</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)  
                        @continue
                    @endif
                    <td>{{ $dat->hematocrit }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>RBC</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ $dat->rbc }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>WBC</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ $dat->wbc }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>Platelet</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ $dat->platelet }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>URR</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{  number_format($dat->urr, 2) }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>Kt/V</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ number_format($dat->ktv2, 2) }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>Pre BUN</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ $dat->pre_bun }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>Post BUN</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ $dat->post_bun }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>Creatinine</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ $dat->creatinine }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>Serum Albumin</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ $dat->serum_albumin }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>Sodium</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ $dat->sodium }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>Potassium</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ $dat->potassium }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>Ionized Calcium</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ $dat->ionized_calcium }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>Uric Acid</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ $dat->uric_acid }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>SGPT</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ $dat->sgpt }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>SGOT</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ $dat->sgot }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>  
                <td>Serum Ferritin</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ $dat->serum_ferritin }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>Serum Iron</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ $dat->serum_iron }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>TIBC</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ $dat->tibc }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>TSAT</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ number_format($dat->tsat, 2) }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>HBsAg</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ $dat->hbsag }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>Anti-HBS</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ $dat->anti_hbs }}</td>
                    @endforeach
                @endif
                </tr>
                <tr>
                <td>Anti-HCV</td>
                @if(isset($allBooking))
                    @foreach ($allBooking as $ind=>$dat)
                    @if($dat->hemoglobin == null && $dat->hematocrit == null && $dat->rbc == null && $dat->wbc == null && $dat->platelet == null && $dat->urr == null && $dat->ktv2 == null && $dat->pre_bun == null && $dat->post_bun == null && $dat->creatinine == null && $dat->serum_albumin == null && $dat->sodium == null && $dat->potassium == null && $dat->ionized_calcium == null && $dat->uric_acid == null && $dat->sgpt == null && $dat->sgot == null && $dat->serum_ferritin == null && $dat->serum_iron == null && $dat->tibc == null && $dat->tsat == null && $dat->hbsag == null && $dat->anti_hbs == null && $dat->anti_hcv == null)
                        @continue
                    @endif
                    <td>{{ $dat->anti_hcv }}</td>
                    @endforeach
                @endif
                </tr>
            </tbody>
        </table>
        {{-- <table style="width: 7.27in; margin:0px; padding:0px;" border="1" cellspacing="0">
            <thead>
              <tr>
                <th rowspan="2">Date</th>
                <th rowspan="2">Hemoglobin</th>
                <th rowspan="2">Hematocrit</th>
                <th rowspan="2">RBC</th>
                <th rowspan="2">WBC</th>
                <th rowspan="2">Platelet</th>
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
                <td>{{ $dat->platelet }}</td>
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
        </table> --}}
    </div>
    
</body>

