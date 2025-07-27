@extends('layouts.app')
@section('content')
@php
    $bgColor = 'dark';
    if(!empty(Auth::user()->user_type)){
        if(Auth::user()->user_type == 'Doctor')
            $bgColor = 'warning';
        if(Auth::user()->user_type == 'Clinic')
            $bgColor = 'primary';
    }
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2>{{ __(ucwords(str_replace("_", " ", $viewFolder)) . ' List') }}</h2>
            <div class="card">
                <div class="card-header">
                    @include('elements.moduleOptions')
                </div>
                <div class="card-body table-responsive">
                    {{-- <div class="d-flex justify-content-end">
                        {{ $data->withQueryString()->links() }}
                    </div> --}}
                    <table class="table table-bordered table-striped table-hover table-sm">
                        <thead class="table-{{ $bgColor }}">
                            <tr>
                                <th class="w-10"><i class="bi bi-gear"></i></th>
                                <th>Profile Pic</th>
                                <th>Patient's Name</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            unset($patientArr);
                        @endphp
                        @if(isset($data))
                        @foreach ($data as $dat)
                            @if((isset($patientArr) && !in_array($dat->patient->id, $patientArr)) || !isset($patientArr))
                            <tr>
                                <td>@include($viewFolder . '.tableOptions')</td>
                                <td class="text-center"><img src="{{ !empty($dat->patient->profile_pic) ? (stristr($dat->patient->profile_pic, 'uploads') ? asset('storage/' . $dat->patient->profile_pic) : asset('storage/px_files/' . $dat->patient->profile_pic)) : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}" width="70px"></td>
                                <td>{{ $dat->patient->name }}</td>
                            </tr>
                            @php
                                $patientArr[$dat->patient->id] = $dat->patient->id;
                            @endphp
                            @endif
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{-- <div class="d-flex justify-content-end">
                        {{ $data->withQueryString()->links() }}
                    </div> --}}
                </div>
                <div class="card-footer">
                    @include('elements.moduleOptions')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
