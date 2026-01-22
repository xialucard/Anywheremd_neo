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
    
    <center><h3>DATA PROCESSING CONSENT FORM</h3></center>
    <p>Compliant with RA 10173 (Data Privacy Act of 2012) and NPC Circular 2023-04</p>
    <ol>
        <li>
            <strong>Identity of the Personal Information Controller (PIC)</strong>
            <p>Name of Organization: {{ $datum->clinic->name }}</p>
            <p>Address: {{ $datum->clinic->address }}</p>
            <p>Contact Number: {{ $datum->clinic->tel }}/{{ $datum->clinic->mobile_no }}</p>
            <p>Data Protection Officer (DPO): __________________________________</p>
            <p>DPO Email: _________________________________________________</p>
        </li>
        <li>
            <strong>Purpose of Data Collection and Processing</strong>
            <p>We will collect and process your personal data for the following specific and legitimate purposes:</p>
            <ul>
                <li>Clinical data will be used by your Doctor to evaluate your condition and to give you sound medical and surgical advice.</li>
                <li>De-identified data may also be used to improve the delivery of health care services by the Center.</li>
            </ul>
            <p>These purposes have been explained to you clearly and in plain language, as required by the National Privacy Commission.</p>
        </li>
        <li>
            <strong>Types of Personal Data to Be Collected</strong>
            <p>We may collect and process the following categories of personal data:</p>
            <ul>
                <li>Personal Information: (e.g., name, address, contact details, email)</li>
                <li>Sensitive Personal Information: (e.g., health data, government IDs)</li>
                <li>Other Data Necessary for Stated Purposes: _______________________</li>
            </ul>
        </li>
        <li>
            <strong>Scope, Nature, and Extent of Processing</strong>
            <p>Your personal data will be processed through the following activities:</p>
            <ul>
                <li>Collection through: Interview by clinic staff</li>
                <li>Storage in: Clinic database</li>
                <li>Access by authorized personnel only</li>
                <li>Retention for 10 years</li>
                <li>Disposal method: Deletion / culling</li>
            </ul>
            <p>Processing may include both manual and automated systems.</p>
        </li>
        <li>
            <strong>Data Sharing and Transfer</strong>
            <p>Your data may be shared with third parties.</p>
            <ul>
                <li>Name of third party recipient(s): Philhealth, HMO</li>
                <li>Purpose of sharing: Claims reimbursement</li>
                <li>The data may not be transferred outside the Philippines</li>
                
            </ul>
        </li>
        <li>
            <strong>Rights of the Data Subject</strong>
            <p>Under the Data Privacy Act, you have the right to:</p>
            <ul>
                <li>Be informed</li>
                <li>Access your personal data</li>
                <li>Object to processing</li>
                <li>Withdraw consent at any time</li>
                <li>Correct or rectify inaccuracies</li>
                <li>Erasure or blocking</li>
                <li>Data portability</li>
                <li>File a complaint with the National Privacy Commission</li>
            </ul>
            <p>You may exercise these rights by contacting our DPO.</p>
        </li>
        <li>
            <strong>Security Measures</strong>
            <p>We implement organizational, physical, and technical measures to protect your data, including:</p>
            <ul>
                <li>Access controls</li>
                <li>Secure storage system</li>
                <li>Encryption (if applicable)</li>
                <li>Regular audits and monitoring</li>
            </ul>
        </li>
        <li>
            <strong>Declaration and Consent</strong>
            <p>By signing below, you confirm that:</p>
            <ul>
                <li>You have read and understood this consent form.</li>
                <li>You voluntarily give your <strong>explicit, informed, and freely given consent</strong> for the collection and processing of your personal data for the purposes stated above.</li>
                <li>You understand that you may withdraw your consent at any time without affecting the lawfulness of processing prior to withdrawal.</li>
                
            </ul>
        </li>
    </ol>
    <br>
    <br>
    <br>
    <br>
    <p>Signature of Data Subject: ___________________________</p>
    <p>Printed Name: {{ $datum->patient->name }}</p>
    <p>Date: {{ $datum->bookingDate }}</p>
</body>

