<div class="card mb-3">
  <div class="card-header">Available Clinic to be Affiliated</div>
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
                  <th class="">Status</th>
              </tr>
          </thead>
          <tbody>
              @foreach($selectItems['clinics'] as $clinic)
            <tr>
                <td><input type="checkbox" name="{{ $viewFolder }}[clinic_id][]" value={{ $clinic->id }} {{ !empty($clinic->affiliated_doctors()->where('doctor_id', $user->id)->get()[0]) ? 'checked' : ''  }} {{ !empty($clinic->affiliated_doctors()->where('doctor_id', $user->id)->get()[0]) && $clinic->affiliated_doctors()->where('doctor_id', $user->id)->get()[0]->active == 1 ? 'disabled' : ''  }}></td>
                <td>{{ $clinic->name }}</td>
                <td>{{ !empty($clinic->affiliated_doctors()->where('doctor_id', $user->id)->get()[0]->active) ? ($clinic->affiliated_doctors()->where('doctor_id', $user->id)->get()[0]->active == 1 ? 'Approved' : 'For Approval') : ''  }}</td>
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





