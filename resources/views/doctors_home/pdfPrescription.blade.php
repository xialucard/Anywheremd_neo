<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <title>{{ $datum->id . '_' . $datum->patient->l_name }}.pdf</title>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    
    <style>
        table {
            width: 100%; 
            border-collapse: collapse;
        }
        th {
            background-color: black; 
            color:white
        }
        table.table-bordered td{
            border: 1px black solid;
            padding: 5px;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .page_break { page-break-before: always; }
        .d-flex {
            text-align: center;
            justify-content: flex-start;
        }
        .d-flex {
            display: flex !important;
        }
        .justify-content-start {
            justify-content: flex-start !important;
        }
        .d-inline-flex {
            display: inline-flex !important;
        }
        .border-dark {
            border: 1px black solid;
        }
        .p-1 {
            padding: 3px;
        }
        body{
            font-size: 190%;
        }
        
    </style>
    <script type="text/javascript"> try { this.print(); } catch (e) { window.onload = window.print; } </script>

</head>
<body>
    <h3 class="text-center m-0 mb-1">{{ $datum->doctor->name }} M.D.</h3>
    <p class="text-center m-0 mb-1 p-0">{{ $datum->doctor->sub_header_1 }}</p>
    <p class="text-center m-0 mb-3 p-0">{{ $datum->doctor->sub_header_2 }}</p>
    <p><strong>Name:</strong> {{ $datum->patient->name }}</p>
    <p><strong>Age:</strong> {{ floor((strtotime($datum->bookingDate) - strtotime($datum->patient->birthdate))/(60*60*24*365.25)) }}</p>
    <img src="{{ asset('img/rx.jpg') }}" style="width:2in">
    @php
        $datum->prescription = nl2br($datum->prescription);
    @endphp
    <p>{!!html_entity_decode($datum->prescription)!!}</p>
    <div class="position-absolute top-100 start-100 text-end mt-5">
        <img src="{{ stristr($datum->doctor->sig_pic, 'uploads') ? asset('storage/' . $datum->doctor->sig_pic) : asset('storage/' . $datum->doctor->sig_pic) }}" style="width:1in"><br>
        {{ str_pad("", strlen($datum->doctor->name), "_", STR_PAD_LEFT) }}<br>
        Dr. {{ $datum->doctor->name }}<br>
        PRC#: {{ $datum->doctor->prc_number }}<br>
        PTR#: {{ $datum->doctor->prc_number }}
    </div>
    

</body>

