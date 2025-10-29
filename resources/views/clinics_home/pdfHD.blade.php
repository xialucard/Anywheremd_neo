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
            <table style="width: 100%">
                <tr>
                    <td>Name:</td>
                    <td>{{ $datum->patient->name }}</td>
                    <td>Patient #:</td>
                    <td>{{ $datum->patient->id }}</td>
                </tr>
                <tr>
                    <td>Height:</td>
                    <td>{{ $datum->height }} cm</td>
                    <td>Gender:</td>
                    <td>{{ $datum->patient->gender }}</td>
                </tr>
                <tr>
                    <td>Age:</td>
                    <td>{{ floor((strtotime($datum->bookingDate) - strtotime($datum->patient->birthdate))/(60*60*24*365.25)) }}</td>
                    <td>DOB:</td>
                    <td>{{ $datum->patient->birthdate }}</td>
                </tr>
                <tr>
                    <td>Diagnosis:</td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td>Attending Nephrologist:</td>
                    <td>Dr. {{ $datum->doctor->name }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div>
        <div class="item" style="width: 1in;">Date: {{ $datum->bookingDate }}</div>
        <div class="item" style="width: 1.3in;">Time Started: {{ $datum->time_started }}</div>
        <div class="item" style="width: 1.3in;">Time Ended: {{ $datum->time_ended }}</div>
        <div class="item" style="width: 1.43in;">Machine #: {{ $datum->machine_number }}</div>
        <div class="item" style="width: 1.5in;">Treatment #: {{ $datum->treatment_number }}</div>
    </div>
    <div>
        <div class="item" style="width: 1.5in; height:130px">
            <strong>Vital Signs</strong>
            <table style="width: 100%; margin:0px; padding:0px;" border="1" cellspacing="0">
                <tr>
                    <td></td>
                    <td>PRE-HD</td>
                    <td>POST-HD</td>
                </tr>
                <tr>
                    <td>BP(mmHg)</td>
                    <td>{{ $datum->bpS }}/{{ $datum->bpD }}</td>
                    <td>{{ $datum->post_bpS }}/{{ $datum->post_bpD }}</td>
                </tr>
                <tr>
                    <td>Pulse(bpm)</td>
                    <td>{{ $datum->heart }}</td>
                    <td>{{ $datum->post_heart }}</td>
                </tr>
                <tr>
                    <td>Resp(cpm)</td>
                    <td>{{ $datum->resp }}</td>
                    <td>{{ $datum->post_resp }}</td>
                </tr>
                <tr>
                    <td>Temp(C)</td>
                    <td>{{ $datum->temp }}</td>
                    <td>{{ $datum->post_temp }}</td>
                </tr>
                <tr>
                    <td>O2</td>
                    <td>{{ $datum->o2 }}</td>
                    <td>{{ $datum->post_o2 }}</td>
                </tr>
                <tr>
                    <td>ECG Reading</td>
                    <td colspan="2"></td>
                </tr>
            </table>
        </div>
        <div class="item" style="width: 3.5in; height:130px">
            <strong>Treatment Plan</strong>
            <table style="width: 100%; margin:0px; padding:0px;" border="1" cellspacing="0">
                <tr>
                    <td>Est. Dry wt(kg)</td>
                    <td>{{ $datum->dry_weight }}</td>
                    <td>Prev. Post HD wt(kg)</td>
                    <td>{{ $datum->prev_post_hd_weight }}</td>
                </tr>
                <tr>
                    <td>Pre HD wt(kg)</td>
                    <td>{{ $datum->pre_hd_weight }}</td>
                    <td>Post HD wt(kg)</td>
                    <td>{{ $datum->post_hd_weight }}</td>
                </tr>
                <tr>
                    <td>Wt gain</td>
                    <td colspan="3">{{ $datum->post_hd_weight>$datum->pre_hd_weight ? ($datum->post_hd_weight-$datum->pre_hd_weight) : '' }}</td>
                </tr>
                <tr>
                    <td>KT/V</td>
                    <td colspan="3">{{ $datum->ktv }}</td>
                </tr>
                <tr>
                    <td>Net UF</td>
                    <td>{{ $datum->net_uf }}</td>
                    <td>Duration(hrs)</td>
                    <td>{{ $datum->hd_duration }}</td>
                </tr>
                <tr>
                    <td>Frequency</td>
                    <td colspan="3">{{ $datum->frequency }}</td>
                </tr>
                <tr>
                    <td>Prime/Rinse</td>
                    <td>{{ $datum->prime }}</td>
                    <td>Other Fluids</td>
                    <td>{{ $datum->other_fluids }}</td>
                    
                </tr>
                <tr>
                    <td>Total UF Goal</td>
                    <td>{{ $datum->total_uf_goal }}</td>
                    <td>Wt Loss</td>
                    <td>{{ $datum->weight_loss }}</td>
                    
                </tr>
                
            </table>
        </div>
        <div class="item" style="width: 1.84in; height:130px">
            <table style="width: 100%; margin:0px; padding:0px">
                <tr>
                    <td>Dialyzer:</td>
                    <td>{{ $datum->dialyzer }}</td>
                </tr>
                <tr>
                    <td>Use:</td>
                    <td>{{ $datum->mac_use }}</td>
                </tr>
                <tr>
                    <td>Acid:</td>
                    <td>{{ $datum->acid }}</td>
                </tr>
                <tr>
                    <td>Add:</td>
                    <td>{{ $datum->mac_add }}</td>
                </tr>
                <tr>
                    <td>BFR:</td>
                    <td>{{ $datum->bfr }}</td>
                </tr>
                <tr>
                    <td>DFR:</td>
                    <td>{{ $datum->dfr }}</td>
                </tr>
                <tr>
                    <td>Setup Prime:</td>
                    <td>{{ $datum->setup_prime }}</td>
                </tr>
                <tr>
                    <td>Safety Check:</td>
                    <td>{{ $datum->safety_check }}</td>
                </tr>
                <tr>
                    <td>Residual Test:</td>
                    <td>{{ $datum->residual_test }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div>
        <div class="item" style="width: 2.5in; height:450px">
            <strong>Pre HD Assessment</strong>
            <div>
                <div>Mental Status</div>
                <div class="form-check">
                    <input type="checkbox" value="awake" {{ (isset($datum->mental_status) && is_array(json_decode($datum->mental_status)) && in_array('awake', json_decode($datum->mental_status))) ? 'checked' : '' }}>
                    <label>awake</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" value="oriented" {{ (isset($datum->mental_status) && is_array(json_decode($datum->mental_status)) && in_array('oriented', json_decode($datum->mental_status))) ? 'checked' : '' }}>
                    <label>oriented</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->mental_status) && is_array(json_decode($datum->mental_status)) && in_array('drowsy', json_decode($datum->mental_status))) ? 'checked' : '' }}>
                    <label>drowsy</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->mental_status) && is_array(json_decode($datum->mental_status)) && in_array('disoriented', json_decode($datum->mental_status))) ? 'checked' : '' }}>
                    <label>disoriented</label>
                </div>
            </div>
            <div>
                <div>Ambulation Status</div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->ambulation_status_j) && is_array(json_decode($datum->ambulation_status_j)) && in_array('ambulatory', json_decode($datum->ambulation_status_j))) ? 'checked' : ((isset($datum->ambulation_status) && $datum->ambulation_status == 'ambulatory') ? 'checked' : '') }}>
                    <label>ambulatory</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->ambulation_status_j) && is_array(json_decode($datum->ambulation_status_j)) && in_array('w/ assistance', json_decode($datum->ambulation_status_j))) ? 'checked' : ((isset($datum->ambulation_status) && $datum->ambulation_status == 'w/ assistance') ? 'checked' : '') }}>
                    <label>w/ assistance</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->ambulation_status_j) && is_array(json_decode($datum->ambulation_status_j)) && in_array('wheelchair', json_decode($datum->ambulation_status_j))) ? 'checked' : ((isset($datum->ambulation_status) && $datum->ambulation_status == 'wheelchair') ? 'checked' : '') }}>
                    <label>wheelchair</label>
                </div>
            </div>
            <div>
                <div>Subject Complaints</div>
                <div class="form-check">
                    <input type="radio" {{ !(isset($datum->subjective_complaints) && $datum->subjective_complaints == 'yes') ? 'checked' : '' }}>
                    <label>none</label>
                  </div>
                  <div class="form-check">
                    <input type="radio" {{ (isset($datum->subjective_complaints) && $datum->subjective_complaints == 'yes') ? 'checked' : '' }}>
                    <label>yes</label>
                  </div>
                  <div class="form-check" style="border-bottom: 1px solid #000; padding: 3px; width:1.5in">
                    {!! isset($datum->subjective_complaints_text) ? nl2br($datum->subjective_complaints_text) : '' !!}
                  </div>
            </div>
            <div>
                <div>Significant PE Findings:</div>
                <div class="form-check-not-inline">
                    <input type="checkbox" {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Pallor', json_decode($datum->pe_findings))) ? 'checked' : '' }}>
                    <label>Pallor</label>
                </div>
                <div class="form-check-not-inline">
                    <input type="checkbox" {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Distended Neck Vein', json_decode($datum->pe_findings))) ? 'checked' : '' }}>
                    <label>Distended Neck Vein</label>
                </div>
                <div class="form-check-not-inline">
                    <input type="checkbox" {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Abnormal Rhythm/Rate', json_decode($datum->pe_findings))) ? 'checked' : '' }}>
                    <label>Abnormal Rhythm/Rate</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Rales', json_decode($datum->pe_findings))) ? 'checked' : '' }}>
                    <label >Rales</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Wheezing', json_decode($datum->pe_findings))) ? 'checked' : '' }}>
                    <label>Wheezing</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Decreased Breath Sounds', json_decode($datum->pe_findings))) ? 'checked' : '' }}>
                    <label>Decreased Breath Sounds</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Ascites - Abdominal Girth', json_decode($datum->pe_findings))) ? 'checked' : '' }}>
                    <label >Ascites - Abdominal Girth:</label>
                </div>
                <div class="form-check" style="border-bottom: 1px solid #000; padding: 3px; width:1.1in">
                    {!! isset($datum->pe_findings_ascites_text) ? $datum->pe_findings_ascites_text : '' !!}
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Edema Grade', json_decode($datum->pe_findings))) ? 'checked' : '' }}>
                    <label>Edema Grade:</label>
                </div>
                <div class="form-check" style="border-bottom: 1px solid #000; padding: 3px; width:1.55in">
                    {!! isset($datum->pe_findings_edema_text) ? $datum->pe_findings_edema_text : '' !!}
                </div>
                <div class="form-check-not-inline">
                    <input type="checkbox" {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Bleeding', json_decode($datum->pe_findings))) ? 'checked' : '' }}>
                    <label>Bleeding</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->pe_findings) && is_array(json_decode($datum->pe_findings)) && in_array('Others', json_decode($datum->pe_findings))) ? 'checked' : '' }}>
                    <label>Others:</label>
                </div>
                <div class="form-check" style="border-bottom: 1px solid #000; padding: 3px; width:1.8in">
                    {!! isset($datum->pe_findings_others_text) ? $datum->pe_findings_others_text : "&nbsp;" !!}
                </div>
            </div>
            <div style="margin-top: 30px">   
                <div class="form-check">
                    <label>MD:</label>
                </div>
                <div class="form-check" style="border-bottom: 1px solid #000; padding: 3px; width:2.1in">
                    {!! isset($datum->doctor->name) ? 'Dr. ' . $datum->doctor->name : "&nbsp;" !!}
                </div>
            </div>
            <div style="margin-top: 30px"> 
                <div class="form-check">
                    <label>RN:</label>
                </div>
                <div class="form-check" style="border-bottom: 1px solid #000; padding: 3px; width:2.1in">
                    {!! isset($datum->hd_initiator->name) ? $datum->hd_initiator->name : "&nbsp;" !!}
                </div>
            </div>
            <div> 
                <div class="form-check" style="margin-left: 100px;">Initiated By</div>
            </div>
        </div>
        <div class="item" style="width: 2.5in; height:450px">
            <strong>Post HD Assessment</strong>
            <div>
                <div>Mental Status</div>
                <div class="form-check">
                    <input type="checkbox" value="awake" {{ (isset($datum->post_mental_status) && is_array(json_decode($datum->post_mental_status)) && in_array('awake', json_decode($datum->post_mental_status))) ? 'checked' : '' }}>
                    <label>awake</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" value="oriented" {{ (isset($datum->post_mental_status) && is_array(json_decode($datum->post_mental_status)) && in_array('oriented', json_decode($datum->post_mental_status))) ? 'checked' : '' }}>
                    <label>oriented</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->post_mental_status) && is_array(json_decode($datum->post_mental_status)) && in_array('drowsy', json_decode($datum->post_mental_status))) ? 'checked' : '' }}>
                    <label>drowsy</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->post_mental_status) && is_array(json_decode($datum->post_mental_status)) && in_array('disoriented', json_decode($datum->post_mental_status))) ? 'checked' : '' }}>
                    <label>disoriented</label>
                </div>
            </div>
            <div>
                <div>Ambulation Status</div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->post_ambulation_status_j) && is_array(json_decode($datum->post_ambulation_status_j)) && in_array('ambulatory', json_decode($datum->post_ambulation_status_j))) ? 'checked' : ((isset($datum->post_ambulation_status) && $datum->post_ambulation_status == 'ambulatory') ? 'checked' : '') }}>
                    <label>ambulatory</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->post_ambulation_status_j) && is_array(json_decode($datum->post_ambulation_status_j)) && in_array('w/ assistance', json_decode($datum->post_ambulation_status_j))) ? 'checked' : ((isset($datum->post_ambulation_status) && $datum->post_ambulation_status == 'w/ assistance') ? 'checked' : '') }}>
                    <label>w/ assistance</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->post_ambulation_status_j) && is_array(json_decode($datum->post_ambulation_status_j)) && in_array('wheelchair', json_decode($datum->post_ambulation_status_j))) ? 'checked' : ((isset($datum->post_ambulation_status) && $datum->post_ambulation_status == 'wheelchair') ? 'checked' : '') }}>
                    <label>wheelchair</label>
                </div>
            </div>
            <div>
                <div>Subject Complaints</div>
                <div class="form-check">
                    <input type="radio" {{ !(isset($datum->post_subjective_complaints) && $datum->post_subjective_complaints == 'yes') ? 'checked' : '' }}>
                    <label>none</label>
                  </div>
                  <div class="form-check">
                    <input type="radio" {{ (isset($datum->post_subjective_complaints) && $datum->post_subjective_complaints == 'yes') ? 'checked' : '' }}>
                    <label>yes</label>
                  </div>
                  <div class="form-check" style="border-bottom: 1px solid #000; padding: 3px; width:1.5in">
                    {!! isset($datum->post_subjective_complaints_text) ? nl2br($datum->post_subjective_complaints_text) : '&nbsp;' !!}
                  </div>
            </div>
            <div>
                <div>Significant PE Findings:</div>
                <div class="form-check-not-inline">
                    <input type="checkbox" {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Pallor', json_decode($datum->post_pe_findings))) ? 'checked' : '' }}>
                    <label>Pallor</label>
                </div>
                <div class="form-check-not-inline">
                    <input type="checkbox" {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Distended Neck Vein', json_decode($datum->post_pe_findings))) ? 'checked' : '' }}>
                    <label>Distended Neck Vein</label>
                </div>
                <div class="form-check-not-inline">
                    <input type="checkbox" {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Abnormal Rhythm/Rate', json_decode($datum->post_pe_findings))) ? 'checked' : '' }}>
                    <label>Abnormal Rhythm/Rate</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Rales', json_decode($datum->post_pe_findings))) ? 'checked' : '' }}>
                    <label >Rales</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Wheezing', json_decode($datum->post_pe_findings))) ? 'checked' : '' }}>
                    <label>Wheezing</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Decreased Breath Sounds', json_decode($datum->post_pe_findings))) ? 'checked' : '' }}>
                    <label>Decreased Breath Sounds</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Ascites - Abdominal Girth', json_decode($datum->post_pe_findings))) ? 'checked' : '' }}>
                    <label >Ascites - Abdominal Girth:</label>
                </div>
                <div class="form-check" style="border-bottom: 1px solid #000; padding: 3px; width:1.1in">
                    {!! isset($datum->post_pe_findings_ascites_text) ? $datum->post_pe_findings_ascites_text : '' !!}
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Edema Grade', json_decode($datum->post_pe_findings))) ? 'checked' : '' }}>
                    <label>Edema Grade:</label>
                </div>
                <div class="form-check" style="border-bottom: 1px solid #000; padding: 3px; width:1.55in">
                    {!! isset($datum->post_pe_findings_edema_text) ? $datum->ppost_e_findings_edema_text : '' !!}
                </div>
                <div class="form-check-not-inline">
                    <input type="checkbox" {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Bleeding', json_decode($datum->post_pe_findings))) ? 'checked' : '' }}>
                    <label>Bleeding</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->post_pe_findings) && is_array(json_decode($datum->post_pe_findings)) && in_array('Others', json_decode($datum->post_pe_findings))) ? 'checked' : '' }}>
                    <label>Others:</label>
                </div>
                <div class="form-check" style="border-bottom: 1px solid #000; padding: 3px; width:1.8in">
                    {!! isset($datum->post_pe_findings_others_text) ? $datum->post_pe_findings_others_text : "&nbsp;" !!}
                </div>
            </div>
            <div style="margin-top: 30px">   
                <div class="form-check">
                    <label>MD:</label>
                </div>
                <div class="form-check" style="border-bottom: 1px solid #000; padding: 3px; width:2.1in">
                    {!! isset($datum->doctor->name) ? 'Dr. ' . $datum->doctor->name : "&nbsp;" !!}
                </div>
            </div>
            <div style="margin-top: 30px"> 
                <div class="form-check">
                    <label>RN:</label>
                </div>
                <div class="form-check" style="border-bottom: 1px solid #000; padding: 3px; width:2.1in">
                    {!! isset($datum->hd_initiator->name) ? $datum->hd_initiator->name : "&nbsp;" !!}
                </div>
            </div>
            <div> 
                <div class="form-check" style="margin-left: 100px;">Ternimated By</div>
            </div>
        </div>
        <div class="item" style="width: 1.84in; height:450px">
            <strong>Anticoagulant</strong>
            <table style="width: 100%; margin:0px; padding:0px">
                <tr>
                    <td>Brand Name:</td>
                    <td>{{ $datum->brand }}</td>
                </tr>
                <tr>
                    <td>Dose:</td>
                    <td>{{ $datum->dose }}</td>
                </tr>
                <tr>
                    <td>Regular Dose:</td>
                    <td>{{ $datum->regular_dose }}</td>
                </tr>
                <tr>
                    <td>Low Dose:</td>
                    <td>{{ $datum->low_dose }}</td>
                </tr>
                <tr>
                    <td>LMWH:</td>
                    <td>{{ $datum->lmwh }}</td>
                </tr>
                <tr>
                    <td>NSS Flushing:</td>
                    <td>{{ $datum->flushing }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div>
        <div class="item" style="width: 2.5in; height:190px">
            <div>
                <strong>Vascular Access</strong>
            </div>
            <div class="form-check">
                <label>Vascular Access:</label>
                <input type="checkbox" {{ (isset($datum->vaccess_j) && is_array(json_decode($datum->vaccess_j)) && in_array('left', json_decode($datum->vaccess_j))) ? 'checked' : ((isset($datum->vaccess) && $datum->vaccess == 'left') ? 'checked' : '') }}>
                <label>left</label>
            </div>
            <div class="form-check" style="width: 1in">
                <input type="checkbox" {{ (isset($datum->vaccess_j) && is_array(json_decode($datum->vaccess_j)) && in_array('right', json_decode($datum->vaccess_j))) ? 'checked' : ((isset($datum->vaccess) && $datum->vaccess == 'right') ? 'checked' : '') }}>
                <label>right</label>
            </div>
            <div class="form-check">
                <input type="checkbox" {{ (isset($datum->vaccess_detail) && is_array(json_decode($datum->vaccess_detail)) && in_array('Fistula', json_decode($datum->vaccess_detail))) ? 'checked' : '' }}>
                <label>Fistula</label>
            </div>
            <div class="form-check">
                <input type="checkbox" {{ (isset($datum->vaccess_detail) && is_array(json_decode($datum->vaccess_detail)) && in_array('Graft', json_decode($datum->vaccess_detail))) ? 'checked' : '' }}>
                <label>Graft</label>
            </div>
            <div class="form-check">
                <input type="checkbox" {{ (isset($datum->vaccess_detail) && is_array(json_decode($datum->vaccess_detail)) && in_array('CVC', json_decode($datum->vaccess_detail))) ? 'checked' : '' }}>
                <label>CVC / PERM / others</label>
            </div>
            <div class="item" style="width: 1.1in;">
                <strong>AV Fistula</strong>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->av_fistula_detail) && is_array(json_decode($datum->av_fistula_detail)) && in_array('Strong Thrill', json_decode($datum->av_fistula_detail))) ? 'checked' : '' }}>
                    <label>Strong Thrill</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->av_fistula_detail) && is_array(json_decode($datum->av_fistula_detail)) && in_array('Weak Thrill', json_decode($datum->av_fistula_detail))) ? 'checked' : '' }}>
                    <label>Weak Thrill</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->av_fistula_detail) && is_array(json_decode($datum->av_fistula_detail)) && in_array('Absent Thrill w/ Bruit', json_decode($datum->av_fistula_detail))) ? 'checked' : '' }}>
                    <label>Absent Thrill w/ Bruit</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->av_fistula_detail) && is_array(json_decode($datum->av_fistula_detail)) && in_array('Absent Thrill no Bruit', json_decode($datum->av_fistula_detail))) ? 'checked' : '' }}>
                    <label>Absent Thrill no Bruit</label>
                </div>
                <div class="form-check">
                    <label>Needle Gauge: {{ !empty($datum->needle_gauge) ? $datum->needle_gauge : '' }}</label>
                </div>
                <div class="input-group mb-3">
                    <label># of Cannulation: {{ !empty($datum->number_commultation) ? $datum->number_commultation : '' }}</label>
                </div>
            </div>
            <div class="item" style="width: 1.1in; height: 1.27in">
                <strong>HD Catheter</strong>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->hd_catheter_detail) && is_array(json_decode($datum->hd_catheter_detail)) && in_array('Both Patent', json_decode($datum->hd_catheter_detail))) ? 'checked' : '' }}>
                    <label>Both Patent</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->hd_catheter_detail) && is_array(json_decode($datum->hd_catheter_detail)) && in_array('A Clotted', json_decode($datum->hd_catheter_detail))) ? 'checked' : '' }}>
                    <label>A Clotted</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" {{ (isset($datum->hd_catheter_detail) && is_array(json_decode($datum->hd_catheter_detail)) && in_array('V Clotted', json_decode($datum->hd_catheter_detail))) ? 'checked' : '' }}>
                    <label>V Clotted</label>
                </div>
                <div class="form-check">
                    <label>Remarks: {{ !empty($datum->hd_catheter_remarks) ? nl2br($datum->hd_catheter_remarks) : '' }}</label>
                </div>
                <div class="input-group mb-3">
                    <label>Latest HGB: {{ !empty($datum->hd_catheter_hgb) ? nl2br($datum->hd_catheter_hgb) : '' }}</label>
                </div>
            </div>
        </div>
        <div class="item" style="width: 4.48in; height:190px">
            <strong>Medication Given</strong>
            <table style="width: 100%; margin:0px; padding:0px;" border="1" cellspacing="0">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Medication</th>
                        <th>Dosage</th>
                        <th>NOD</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($datum->consultation_meds()->orderBy('id', 'desc')->get() as $dat)
                    <tr>
                        <td>{{ $dat->time_given }}</td>
                        <td>{{ $dat->medication }}</td>
                        <td>{{ $dat->dosage }}</td>
                        <td>{{ $dat->creator->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <div class="item" style="width: 7.12in; height:70px">
            <strong>Special Endorsement</strong>
            <table style="width: 100%; margin:0px; padding:0px;" border="1" cellspacing="0">
                <tr>
                    <th width=".5in">RML</th>
                    <td width="1in">{{ $datum->rml }}</td>
                    <td></td>
                </tr>
                <tr>
                    <th>Hepa Profile</th>
                    <td>{{ $datum->hepa }}</td>
                    <td></td>
                </tr>
                <tr>
                    <th>IV Iron</th>
                    <td>{{ $datum->iv_iron }}</td>
                    <td></td>
                </tr>
                <tr>
                    <th>EPO</th>
                    <td>{{ $datum->epo }}</td>
                    <td></td>
                </tr>
                <tr>
                    <th>Vaccines</th>
                    <td>{{ $datum->hd_vac }}</td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="page-break"></div>
    <div>
        <div class="item" style="width: 7.12in; height:100px">
            <strong>Dialysis Monitoring Treatment</strong>
            <table style="width: 100%; margin:0px; padding:0px;" border="1" cellspacing="0">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>BP</th>
                        <th>HR</th>
                        <th>O2 Sat</th>
                        <th>AP</th>
                        <th>VP</th>
                        <th>TMP</th>
                        <th>BRF</th>
                        <th>NSS</th>
                        <th>UFR</th>
                        <th>UFV</th>
                        <th>Remarks</th>
                        <th>NOD</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($datum->consultation_monitorings()->orderBy('id', 'desc')->get() as $dat)
                    <tr>
                        <td>{{ $dat->time_given }}</td>
                        <td>{{ $dat->bpS . '/' . $dat->bpD }}</td>
                        <td>{{ $dat->heart }}BPM</td>
                        <td>{{ $dat->o2 }}%</td>
                        <td>{{ $dat->ap }}</td>
                        <td>{{ $dat->vp }}</td>
                        <td>{{ $dat->tmp }}</td>
                        <td>{{ $dat->bfr }}</td>
                        <td>{{ $dat->nss }}</td>
                        <td>{{ $dat->ufr }}</td>
                        <td>{{ $dat->ufv }}</td>
                        <td>{{ $dat->remarks }}</td>
                        <td>{{ $dat->creator->name }}</td>
                    </tr>
                @endforeach 
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <div class="item" style="width: 3.49in; height:410px">
            <strong>Vital Sign Graphical Sheet</strong>
            <table style="width: 100%; margin:0px; padding:0px;" border="1" cellspacing="0">
                <thead>
                    <tr>
                        <th rowspan="2">BP</th>
                        <th rowspan="2">HR</th>
                        <th rowspan="2">Temp</th>
                        <th colspan="15">Time</th>
                    </tr>
                    <tr>
                        <th colspan="3">1st HR</th>
                        <th colspan="3">2nd HR</th>
                        <th colspan="3">3rd HR</th>
                        <th colspan="3">4th HR</th>
                        <th colspan="3">5th HR</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $temp = '';
                        $flag = 0;
                    @endphp
                    @for($bp=260; $bp>=40; $bp-=10)
                        @php
                            if($flag == 2)
                                $temp = 42;
                            if($bp <= 250 && $temp>=35 && ($flag%2) == 0){
                                if($flag > 0)
                                    $temp--;
                                if($temp < 35)
                                    $temp = '';
                               
                            }
                            $flag++;  
                        @endphp
                    <tr>
                        <th>{{ $bp }}</th>
                        <th>{{ $bp<=210 ? $bp-10 : '' }}</th>
                        <th>{{ ($flag%2) == 0 ? $temp : '' }}</th>
                        <th style="font-size: 7pt">
                            {{ isset($datum->consultation_monitorings()->orderBy('id', 'asc')->get()[0]) && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[0]->bpS >= $bp && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[0]->bpS < $bp+10  ? 'v' : '' }}
                            {{ isset($datum->consultation_monitorings()->orderBy('id', 'asc')->get()[0]) && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[0]->bpD >= $bp && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[0]->bpD < $bp+10  ? '^' : '' }}
                        </th>
                        <th style="font-size: 7pt">{{ isset($datum->consultation_monitorings()->orderBy('id', 'asc')->get()[0]) && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[0]->heart >= $bp-10 && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[0]->heart < $bp  ? 'x' : '' }}</th>
                        <th style="font-size: 7pt">{{ $temp != '' && ($flag%2) == 0 && isset($datum->consultation_monitorings()->orderBy('id', 'asc')->get()[0]) && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[0]->tmp >= $temp && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[0]->tmp < $temp+1  ? '*' : '' }}</th>
                        <th style="font-size: 7pt">
                            {{ isset($datum->consultation_monitorings()->orderBy('id', 'asc')->get()[1]) && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[1]->bpS >= $bp && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[1]->bpS < $bp+10  ? 'v' : '' }}
                            {{ isset($datum->consultation_monitorings()->orderBy('id', 'asc')->get()[1]) && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[1]->bpD >= $bp && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[1]->bpD < $bp+10  ? '^' : '' }}
                        </th>
                        <th style="font-size: 7pt">{{ isset($datum->consultation_monitorings()->orderBy('id', 'asc')->get()[1]) && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[1]->heart >= $bp-10 && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[1]->heart < $bp  ? 'x' : '' }}</th>
                        <th style="font-size: 7pt">{{ $temp != '' && ($flag%2) == 0 && isset($datum->consultation_monitorings()->orderBy('id', 'asc')->get()[1]) && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[1]->tmp >= $temp && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[1]->tmp < $temp+1  ? '*' : '' }}</th>
                        <th style="font-size: 7pt">
                            {{ isset($datum->consultation_monitorings()->orderBy('id', 'asc')->get()[2]) && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[2]->bpS >= $bp && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[2]->bpS < $bp+10  ? 'v' : '' }}
                            {{ isset($datum->consultation_monitorings()->orderBy('id', 'asc')->get()[2]) && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[2]->bpD >= $bp && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[2]->bpD < $bp+10  ? '^' : '' }}
                        </th>
                        <th style="font-size: 7pt">{{ isset($datum->consultation_monitorings()->orderBy('id', 'asc')->get()[2]) && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[2]->heart >= $bp-10 && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[2]->heart < $bp  ? 'x' : '' }}</th>
                        <th style="font-size: 7pt">{{ $temp != '' && ($flag%2) == 0 && isset($datum->consultation_monitorings()->orderBy('id', 'asc')->get()[2]) && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[2]->tmp >= $temp && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[2]->tmp < $temp+1  ? '*' : '' }}</th>
                        <th style="font-size: 7pt">
                            {{ isset($datum->consultation_monitorings()->orderBy('id', 'asc')->get()[3]) && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[3]->bpS >= $bp && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[3]->bpS < $bp+10  ? 'v' : '' }}
                            {{ isset($datum->consultation_monitorings()->orderBy('id', 'asc')->get()[3]) && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[3]->bpD >= $bp && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[3]->bpD < $bp+10  ? '^' : '' }}
                        </th>
                        <th style="font-size: 7pt">{{ isset($datum->consultation_monitorings()->orderBy('id', 'asc')->get()[3]) && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[3]->heart >= $bp-10 && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[3]->heart < $bp  ? 'x' : '' }}</th>
                        <th style="font-size: 7pt">{{ $temp != '' && ($flag%2) == 0 && isset($datum->consultation_monitorings()->orderBy('id', 'asc')->get()[3]) && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[3]->tmp >= $temp && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[3]->tmp < $temp+1  ? '*' : '' }}</th>
                        <th style="font-size: 7pt">
                            {{ isset($datum->consultation_monitorings()->orderBy('id', 'asc')->get()[4]) && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[4]->bpS >= $bp && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[4]->bpS < $bp+10  ? 'v' : '' }}
                            {{ isset($datum->consultation_monitorings()->orderBy('id', 'asc')->get()[4]) && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[4]->bpD >= $bp && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[4]->bpD < $bp+10  ? '^' : '' }}
                        </th>
                        <th style="font-size: 7pt">{{ isset($datum->consultation_monitorings()->orderBy('id', 'asc')->get()[4]) && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[4]->heart >= $bp-10 && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[4]->heart < $bp  ? 'x' : '' }}</th>
                        <th style="font-size: 7pt">{{ $temp != '' && ($flag%2) == 0 && isset($datum->consultation_monitorings()->orderBy('id', 'asc')->get()[4]) && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[4]->tmp >= $temp && $datum->consultation_monitorings()->orderBy('id', 'asc')->get()[4]->tmp < $temp+1  ? '*' : '' }}</th>
                    </tr>
                    @endfor
                    <tr>
                        <td colspan="18">Legends:</td>
                    </tr>
                    <tr>
                        <td colspan="18">v-Systolic BP</td>
                    </tr>
                    <tr>
                        <td colspan="18">^-Diastolic BP</td>
                    </tr>
                    <tr>
                        <td colspan="18">x-Heart Rate</td>
                    </tr>
                    <tr>
                        <td colspan="18">*-Body Temparature</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="item" style="width: 3.48in; height:410px">
            <strong>Nurse Notes</strong>
            <table style="width: 100%; margin:0px; padding:0px;" border="1" cellspacing="0">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Notes</th>
                        <th>NOD</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($datum->consultation_nurse_notes()->orderBy('id', 'desc')->get() as $dat)
                    <tr>
                        <td>{{ $dat->time_given }}</td>
                        <td>{{ nl2br($dat->notes) }}</td>
                        <td>{{ $dat->creator->name }}</td>
                    </tr>
                @endforeach
                </tbody>
                </table>
        </div>
    </div>
    <div>
        <div class="item" style="width: 7.12in; height:220px;font-size:8pt;">
            <strong>Waiver for Early Termination</strong>
            <br>
            <br>
            <p> I, {{ $datum->patient->name }}, request to terminate my dialysis prior to the prescribed time. I am fully aware that this is against the medical advice of my physician. The risk and consequences of early termination of my treatment have been previously explained to me by my physician. I understand that if, before the next treatment, I have unusual symptoms such as shortness of breath or chest pain, I should immediately, contact my physician. I hereby willfully assume the risk of my early termination of hemodialysis treatment and agree not to hold my physician, the dialysis facility, and its employee or agents responsible for any harm or injury whichh may results from my action.</p>
            <br>
            <br>
            <p>Prescribed Time:___________________. Shortened treatment to {{ $datum->shorten_min }} min/s</p>
            <p>Reason (Specify): {{ nl2br($datum->shorten_reason) }}</p>
            <br>
            <br>
            <div class="item" width="2in" style="margin-left:1.5in; margin-right:1in; border:0; border-top: 1px solid #000">Patient's Signature/Date</div>
            <div class="item" width="2in" style="margin-right:1in; border:0; border-top: 1px solid #000">Staff's Signature/Date</div>
        </div>
    </div>
</body>

