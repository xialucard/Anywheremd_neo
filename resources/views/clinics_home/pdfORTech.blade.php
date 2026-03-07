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
            font-size:10pt;
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
            <img src="{{ public_path('storage/printable_forms_files/' . $referal_conso->clinic->letterhead_pic) }}" alt="" style="width:7.35in; margin-bottom:5px">
        @elseif(!isset($referal_conso) && $datum->clinic->letterhead_pic)
            <img src="{{ public_path('storage/printable_forms_files/' . $datum->clinic->letterhead_pic) }}" alt="" style="width:7.35in; margin-bottom:5px">
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

    <table border="1" cellspacing="0" width="100%">
        <tr>
            <td><strong>Date:</strong> {{ $datum->bookingDate }}</td>
            <td><strong>Booking Number:</strong>{{ isset($referal_conso->id) ? $referal_conso->id : (!isset($referal_conso) ? $datum->id : '') }}</td>
            <td colspan="2"><strong>Civil Status:</strong> {{ $datum->patient->civilStatus }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Name:</strong> {{ $datum->patient->name }}</td>
            <td><strong>Date of Birth:</strong> {{ $datum->patient->birthdate }}</td>
            <td><strong>Age/Sex:</strong> {{ floor((strtotime($datum->bookingDate) - strtotime($datum->patient->birthdate))/(60*60*24*365.25)) }}/{{ $datum->patient->gender }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Surgeon:</strong> Dr. {{ isset($referal_conso->doctor->name) ? $referal_conso->doctor->name : (!isset($referal_conso) ? $datum->doctor->name : '') }}</td>
            <td colspan="2"><strong>Anesthesiologist:</strong> {{ isset($referal_conso->anesthesiologist_ao) ? $referal_conso->anesthesiologist_ao : (!isset($referal_conso) ? $datum->anesthesiologist_ao : '') }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Scrub Nurse:</strong> {{ isset($referal_conso->printable_form['scrub_nurse']) ? $referal_conso->printable_form['scrub_nurse'] : (!isset($referal_conso) ? $datum->printable_form['scrub_nurse'] : '') }}</td>
            <td colspan="2"><strong>Anesthesia:</strong> {{ isset($referal_conso->anesthesia_type_ao) ? $referal_conso->anesthesia_type_ao : (!isset($referal_conso) ? $datum->anesthesia_type_ao : '') }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Circulating Nurse:</strong><br>{{ isset($referal_conso->printable_form['circ_nurse']) ? $referal_conso->printable_form['circ_nurse'] : (!isset($referal_conso) ? $datum->printable_form['circ_nurse'] : '') }}</td>
            <td><strong>Time Admitted:</strong><br>{{ isset($referal_conso->printable_form['time_admitted']) ? $referal_conso->printable_form['time_admitted'] : (!isset($referal_conso) ? $datum->printable_form['time_admitted'] : '') }}</td>
            <td><strong>Time Discharged:</strong><br>{{ isset($referal_conso->printable_form['time_discharged']) ? $referal_conso->printable_form['time_discharged'] : (!isset($referal_conso) ? $datum->printable_form['time_discharged'] : '') }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Pre-Operative Diagnosis - 1st Case Rate:</strong><br>{{ isset($referal_conso->printable_form['pre_operative']) ? $referal_conso->printable_form['pre_operative'] : (!isset($referal_conso) ? $datum->printable_form['pre_operative'] : '') }}</td>
            <td colspan="2"><strong>Pre-Operative Diagnosis - 2nd Case Rate:</strong><br>{{ isset($referal_conso->printable_form['pre_operative1']) ? $referal_conso->printable_form['pre_operative1'] : (!isset($referal_conso) ? $datum->printable_form['pre_operative1'] : '') }}</td>
            
        </tr>
        <tr>
            <td><strong>Final Diagnosis - 1st Case Rate:</strong><br>{{ isset($referal_conso->printable_form['final_diagnosis']) ? $referal_conso->asseprintable_form['final_diagnosis']ssment : (!isset($referal_conso) ? $datum->printable_form['final_diagnosis'] : '') }}</td>
            <td><strong>ICD Code:</strong><br>{{ isset($referal_conso->printable_form['icd_code']) ? $referal_conso->printable_form['icd_code'] : (!isset($referal_conso) ? $datum->printable_form['icd_code'] : '') }}</td>
            <td><strong>Final Diagnosis - 2nd Case Rate:</strong><br>{{ isset($referal_conso->printable_form['final_diagnosis1']) ? $referal_conso->printable_form['final_diagnosis1'] : (!isset($referal_conso) ? $datum->printable_form['final_diagnosis1'] : '') }}</td>
            <td><strong>ICD Code:</strong><br>{{ isset($referal_conso->printable_form['icd_code1']) ? $referal_conso->printable_form['icd_code1'] : (!isset($referal_conso) ? $datum->printable_form['icd_code1'] : '') }}</td>
        </tr>
        <tr>
            <td><strong>Operation Performed - 1st Case Rate:</strong><br>{{ isset($referal_conso->printable_form['operation_performed']) ? $referal_conso->printable_form['operation_performed'] : (!isset($referal_conso) ? $datum->printable_form['operation_performed'] : '') }} {{ isset($referal_conso->procedure_plan) ? $referal_conso->procedure_plan : (!isset($referal_conso) ? $datum->procedure_plan : '') }}</td>
            <td><strong>RVS Code:</strong><br>{{ isset($referal_conso->printable_form['rvs_code']) ? $referal_conso->printable_form['rvs_code'] : (!isset($referal_conso) ? $datum->printable_form['rvs_code'] : '') }}</td>
            <td><strong>Operation Performed - 2nd Case Rate:</strong><br>{{ isset($referal_conso->printable_form['operation_performed1']) ? $referal_conso->printable_form['operation_performed1'] : (!isset($referal_conso) ? $datum->printable_form['operation_performed1'] : '') }} {{ isset($referal_conso->procedure_plan) ? $referal_conso->procedure_plan : (!isset($referal_conso) ? $datum->procedure_plan : '') }}</td>
            <td><strong>RVS Code:</strong><br>{{ isset($referal_conso->printable_form['rvs_code1']) ? $referal_conso->printable_form['rvs_code1'] : (!isset($referal_conso) ? $datum->printable_form['rvs_code1'] : '') }}</td>
        </tr>
        <tr>
            <td colspan="3"><strong>Specimen:</strong> {{ isset($referal_conso->printable_form['specimen_remarks']) ? $referal_conso->printable_form['specimen_remarks'] : (!isset($referal_conso) ? $datum->printable_form['specimen_remarks'] : '') }}</td>
            <td><input type="checkbox" {{ isset($referal_conso->printable_form['specimen']) && $referal_conso->printable_form['specimen'] == 'yes' ? 'checked' : (!isset($referal_conso) && $datum->printable_form['specimen'] == 'yes' ? 'checked' : '') }}>Yes <input type="checkbox" {{ isset($referal_conso->printable_form['specimen']) && $referal_conso->printable_form['specimen'] == 'no' ? 'checked' : (!isset($referal_conso) && $datum->printable_form['specimen'] == 'no' ? 'checked' : '') }}> No</td>
        </tr>
        
        {{-- <tr>
            <td><strong>Anesthesiologist:</strong> {{ isset($datum->printable_form['anesthesiologist_ot']) ? $datum->printable_form['anesthesiologist_ot'] : '' }}</td>
            <td><strong>Anesthesia:</strong> {{ isset($datum->printable_form['anesthesia_type_ot']) ? $datum->printable_form['anesthesia_type_ot'] : '' }}</td>
        </tr> --}}
    </table>
    
    <center><h3>OPERATIVE TECHNIQUE</h3></center>
    <div style="height:4in">
        <p>
            {!! isset($referal_conso->printable_form['operative_tech']) ? nl2br($referal_conso->printable_form['operative_tech']) : (!isset($referal_conso) ? nl2br($datum->printable_form['operative_tech']) : '') !!}
        </p>
    </div>
    
    {{-- <p>
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
    </p> --}}
    
    
    
    @if($datum->doctor->sig_pic != '' || $referal_conso->doctor->sig_pic)
    <img src="{{ public_path('storage/doctor_files/' . (isset($referal_conso->doctor->sig_pic) ? $referal_conso->doctor->sig_pic : (!isset($referal_conso) ? $datum->doctor->sig_pic : ''))) }}" style="width:1in"><br>
    @endif
    <span>Surgeon: {{ isset($referal_conso->doctor->name) ? $referal_conso->doctor->name : (!isset($referal_conso) ? $datum->doctor->name : '') }} (Name & Signature)</span>
    <br>
    <span>Date: {{ isset($referal_conso->bookingDate) ? $referal_conso->bookingDate : (!isset($referal_conso) ? $datum->bookingDate : '') }}</span>
</body>

