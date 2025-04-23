<div class="card mb-3">
  <div class="card-header">Available Doctor to be Affiliated</div>
  <div class="card-body">
    <div class="table-responsive">
      <div class="d-flex justify-content-end">
          {{-- {{ $data->withQueryString()->links() }} --}}
      </div>
      <table class="table table-bordered table-striped table-hover table-sm">
          <thead class="table-{{ $bgColor }}">
              <tr>
                  <th class=""><i class="bi bi-gear"></i></th>
                  <th>Doctor</th>
                  <th>Specialty</th>
                  <th class="">Status</th>
              </tr>
          </thead>
          <tbody>
              @foreach($selectItems['doctors'] as $doctor)
            <tr>
                <td><input type="checkbox" name="{{ $viewFolder }}[doctor_id][]" value={{ $doctor->id }} {{ (!empty($doctor->affiliated_clinics()->where('clinic_id', $user->clinic_id)->get()[0]->active)) ? 'checked' : ''  }} {{ (!empty($doctor->affiliated_clinics()->where('clinic_id', $user->clinic_id)->get()[0]->active) && $doctor->affiliated_clinics()->where('clinic_id', $user->clinic_id)->get()[0]->active == 1) ? 'disabled' : ''  }}></td>
                <td>Dr. {{ $doctor->name }}</td>
                <td>{{ $doctor->specialty }}</td>
                <td>{{ !empty($doctor->affiliated_clinics()->where('clinic_id', $user->clinic_id)->get()[0]->active) ? ($doctor->affiliated_clinics()->where('clinic_id', $user->clinic_id)->get()[0]->active == 1 ? 'Approved' : 'For Approval') : ''  }}</td>
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





