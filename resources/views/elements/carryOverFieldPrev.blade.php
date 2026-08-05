<div id="{{ $fieldName }}PrevDiv" class="container table-responsive mb-3" style="height: 200px; max-height: 200px; border: 1px solid; border-radius: 5px; overflow-y: auto;">
    @if(isset($fieldNameParent))
        @if(isset($bookings[0]->consultation_parent_id) && $bookings[0]->consultation_parent_id != "")
            @if(isset($bookings[0]->parent_consultation->printable_form[$fieldName]))
        <div class="card mb-3">
            <div class="card-header bg-secondary text-light">Dr. {{ $bookings[0]->parent_consultation->doctor->name }}</div>
            <div class="card-body">{{ $bookings[0]->parent_consultation->printable_form[$fieldName] }}</div>
        </div>
            @endif
        @endif
        @if(isset($bookings[0]->printable_form[$fieldName]))
        <div class="card mb-3">
            <div class="card-header bg-warning">Yours</div>
            <div class="card-body">{{ $bookings[0]->printable_form[$fieldName] }}</div>
        </div>
        @endif
        @foreach($bookings[0]->consultation_referals()->get() as $ref)
            @if(isset($ref->printable_form[$fieldName]))
        <div class="card mb-3">
            <div class="card-header bg-secondary text-light">Dr. {{ $ref->doctor->name }}</div>
            <div class="card-body">{{ $ref->printable_form[$fieldName] }}</div>
        </div>
            @endif
        @endforeach
    @else
        @if(isset($bookings[0]->consultation_parent_id) && $bookings[0]->consultation_parent_id != "")
            @if(isset($bookings[0]->parent_consultation->$fieldName) && $bookings[0]->parent_consultation->$fieldName != "")
        <div class="card mb-3">
            <div class="card-header bg-secondary text-light">Dr. {{ $bookings[0]->parent_consultation->doctor->name }}</div>
            <div class="card-body">{{ $bookings[0]->parent_consultation->$fieldName }}</div>
        </div>
            @endif
        @endif
        @if(isset($bookings[0]->$fieldName) && $bookings[0]->$fieldName != "")
        <div class="card mb-3">
            <div class="card-header bg-warning">Yours</div>
            <div class="card-body">{{ $bookings[0]->$fieldName }}</div>
        </div>
        @endif
        @foreach($bookings[0]->consultation_referals()->get() as $ref)
            @if(isset($ref->$fieldName) && $ref->$fieldName != "")
        <div class="card mb-3">
            <div class="card-header bg-secondary text-light">Dr. {{ $ref->doctor->name }}</div>
            <div class="card-body">{{ $ref->$fieldName }}</div>
        </div>
            @endif
        @endforeach
    @endif
</div>