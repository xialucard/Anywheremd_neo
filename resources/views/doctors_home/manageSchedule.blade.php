<div class="card mb-3">
  <div class="card-header">
    Input Schedule Details
  </div>
  <div class="card-body">
    <div class="form-floating mb-3">
      <select class="form-select" name="{{ $viewFolder }}[clinic_id]" id="{{ $viewFolder }}_clinic_id" placeholder="" required>
        <option></option>
        {{-- <option value="0">Online</option> --}}
        @foreach ($selectItems['affiliated_clinics'] as $ind => $item)
          <option value="{{ $item->clinic_id }}">{{ $item->clinic->name }}</option>
        @endforeach
      </select>
      <label for="{{ $viewFolder }}_clinic_id">Clinic</label>
      <small id="help_{{ $viewFolder }}_clinic_id" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="date" name="{{ $viewFolder }}[date_from]" id="{{ $viewFolder }}_date_from" placeholder="" value="" required>
      <label for="{{ $viewFolder }}_date_from" class="form-label">Date From</label>
      <small id="help_{{ $viewFolder }}_date_from" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="date" name="{{ $viewFolder }}[date_to]" id="{{ $viewFolder }}_date_to" placeholder="" value="" required>
      <label for="{{ $viewFolder }}_date_to" class="form-label">Date To</label>
      <small id="help_{{ $viewFolder }}_date_to" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="time" name="{{ $viewFolder }}[time_from]" id="{{ $viewFolder }}_time_from" placeholder="" value="" required>
      <label for="{{ $viewFolder }}_time_from" class="form-label">Time From</label>
      <small id="help_{{ $viewFolder }}_time_from" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="time" name="{{ $viewFolder }}[time_to]" id="{{ $viewFolder }}_time_to" placeholder="" value="" required>
      <label for="{{ $viewFolder }}_time_to" class="form-label">Time To</label>
      <small id="help_{{ $viewFolder }}_time_to" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="number" name="{{ $viewFolder }}[timeslot_interval]" id="{{ $viewFolder }}_timeslot_interval" placeholder="" value="" required>
      <label for="{{ $viewFolder }}_timeslot_interval" class="form-label">Timeslot Interval in Minutes</label>
      <small id="help_{{ $viewFolder }}_timeslot_interval" class="text-muted"></small>
    </div>
    <div class="card mb-3">
      <div class="card-header">Days</div>
      <div class="card-body">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[days][]" id="daysMon"  value="Mon">
          <label class="form-check-label" for="daysMon">Monday</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[days][]" id="daysTue" value="Tue">
          <label class="form-check-label" for="daysTue">Tuesday</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[days][]" id="daysWed" value="Wed">
          <label class="form-check-label" for="daysWed">Wednesday</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[days][]" id="daysThu" value="Thu">
          <label class="form-check-label" for="daysThu">Thursday</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[days][]" id="daysFri" value="Fri">
          <label class="form-check-label" for="daysFri">Friday</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[days][]" id="daysSat" value="Sat">
          <label class="form-check-label" for="daysSat">Saturday</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[days][]" id="daysSun" value="Sun">
          <label class="form-check-label" for="daysSun">Sunday</label>
        </div>
      </div>
    </div>  
  </div>
</div>
<div class="card mb-3">
  <div class="card-header">Set Schedule</div>
  <div class="card-body">
    <div class="table-responsive">
      <div class="d-flex justify-content-end">
          {{-- {{ $data->withQueryString()->links() }} --}}
      </div>
      <table class="table table-bordered table-striped table-hover table-sm">
          <thead class="table-{{ $bgColor }}">
              <tr>
                  <th class=""><i class="bi bi-gear"></i></th>
                  <th>Clinic</th>
                  <th class="">Date</th>
                  <th class="">Time</th>
                  <th class="">Timeslot Interval</th>
                  <th class="">Days</th>
              </tr>
          </thead>
          <tbody>
          @foreach ($data as $dat)
              <tr>
                  <td>&nbsp;</td>
                  <td>{{ $dat->clinic->name }}</td>
                  <td>{{ $dat->date_from . ' - ' . $dat->date_to }}</td>
                  <td>{{ $dat->time_from . ' - ' . $dat->time_to }}</td>
                  <td>{{ $dat->timeslot_interval }} min/s</td>
                  <td>{{ $dat->days }}</td>
              </tr>
          @endforeach
          </tbody>
        </table>
      </div>
  </div>
</div>
<div class="card">
  <div class="card-body">
    @if ($datum->created_at != null)
    <small class="text-muted">Created at:&nbsp;{{ $datum->created_at }}&nbsp;by&nbsp;{{ $datum->creator->name ?? ""}}<br>Updated at:&nbsp;{{ $datum->updated_at }}&nbsp;by&nbsp;{{ $datum->updator->name ?? "" }}</small>
    @endif
  </div>
</div>





