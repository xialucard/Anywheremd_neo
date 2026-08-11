@php
    // if(isset($fieldNameParent) && $fieldName == 'diagnosis'){
    //     $fieldEntry = isset($referal_conso->assessment) ? $referal_conso->assessment : $datum->assessment;
    // }
@endphp
<div class="container table-responsive mb-3" style="height: 200px; max-height: 200px; border: 1px solid; border-radius: 5px; overflow-y: auto;">
    @if(!isset($referal_conso))
    <div class="card mb-3">
        <div class="card-header @if(!isset($referal_conso)) bg-warning @else bg-secondary text-light @endif">@if(!isset($referal_conso)) Yours @else Dr. {{ $datum->doctor->name }} @endif</div>
        <div class="card-body">{{ isset($fieldEntry) && $fieldEntry != '' ? $fieldEntry : '' }}</div>
    </div>
    @else
    <div class="card mb-3">
        <div class="card-header @if(!isset($referal_conso)) bg-warning @else bg-secondary text-light @endif">@if(!isset($referal_conso)) Yours @else Dr. {{ $datum->doctor->name }} @endif</div>
        <div class="card-body">{{ isset($fieldEntryOrig) && $fieldEntryOrig != '' ? $fieldEntryOrig : '' }}</div>
    </div>
    @endif
    @foreach($datum->consultation_referals()->get() as $ref)
        @if(isset($ref[$fieldName]))
    <div class="card mb-3">
        <div class="card-header @if(!isset($referal_conso) || (isset($referal_conso) && $referal_conso->id != $ref->id)) bg-secondary text-light @else bg-warning @endif">@if(!isset($referal_conso) || (isset($referal_conso) && $referal_conso->id != $ref->id)) Dr. {{ $ref->doctor->name }} @else Yours @endif</div>
        <div class="card-body">{{ $ref[$fieldName] }}</div>
    </div>
        @else
    <div class="card mb-3">
        <div class="card-header @if(!isset($referal_conso) || (isset($referal_conso) && $referal_conso->id != $ref->id)) bg-secondary text-light @else bg-warning @endif">@if(!isset($referal_conso) || (isset($referal_conso) && $referal_conso->id != $ref->id)) Dr. {{ $ref->doctor->name }} @else Yours @endif</div>
        <div class="card-body">{{ isset($ref->printable_form[$fieldName]) && $ref->printable_form[$fieldName] != "" ? $ref->printable_form[$fieldName] : '' }}</div>
    </div>    
        @endif
    @endforeach
</div>

<textarea class="form-control soapField {{ ((!isset($fieldEntry) || $fieldEntry == "") && !is_null($fieldCarryOver) && $fieldCarryOver != '') ? 'text-danger' : ((!is_null($fieldCarryOver) && isset($fieldCarryOver) && $fieldCarryOver != '' && isset($fieldEntry) && $fieldEntry != '' && $fieldCarryOver == $fieldEntry) ? 'text-warning' : '') }}" @if(isset($fieldNameParent)) name="{{ $viewFolder }}[{{ $fieldNameParent }}][{{ $fieldName }}]" @else name="{{ $viewFolder }}[{{ $fieldName }}]" @endif id="{{ $viewFolder }}_{{ isset($fieldNameParent) && $fieldName == 'diagnosis' ? 'diagnosisN' : $fieldName }}" rows=3 onchange="$(this).removeClass('{{ (!isset($fieldEntry) || $fieldEntry == '') ? 'text-danger' : ((!is_null($fieldCarryOver) && isset($fieldCarryOver) && $fieldCarryOver != '' && isset($fieldEntry) && $fieldEntry != '' && $fieldCarryOver == $fieldEntry) ? 'text-warning' : '') }}'); $('#small{{ $fieldName }}').hide(); {{ isset($onblur) ? $onblur : '' }}" onblur="{{ isset($onblur) ? $onblur : '' }}">{{ isset($fieldEntry) && $fieldEntry != '' ? $fieldEntry : (!is_null($fieldCarryOver) && isset($fieldCarryOver) ? $fieldCarryOver : '') }}</textarea>
<small id="small{{ $fieldName }}" class="{{ (!isset($fieldEntry) || $fieldEntry == "") ? 'text-danger' : ((isset($fieldCarryOver) && $fieldCarryOver != '' && isset($fieldEntry) && $fieldEntry != '' && $fieldCarryOver == $fieldEntry) ? 'text-warning' : '') }} mb-3">@if(!is_null($fieldCarryOver) && isset($fieldCarryOver) && $fieldCarryOver != '' && ($fieldCarryOver == $fieldEntry || $fieldEntry == '' || !isset($fieldEntry) && !is_null($fieldCarryOverBookingType)))[carry over from {{ $fieldCarryOverBookingType == '' ? 'Consultation' : $fieldCarryOverBookingType }} booking last {{ $fieldCarryOverBookingDate }}]@endif</small><br>
<small class="text-muted mb-3">Note: Red = no new input (carried over). Orange = input present and unchanged from the previous booking.</small><br>
