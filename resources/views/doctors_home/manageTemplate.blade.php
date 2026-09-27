<div class="card mb-3">
  <div class="card-header">Printable Forms Template</div>
  <div class="card-body">
    <div class="table-responsive">
      <div class="d-flex justify-content-end">
          {{-- {{ $data->withQueryString()->links() }} --}}
      </div>
      <table class="table table-bordered table-striped table-hover table-sm">
          <thead class="table-{{ $bgColor }}">
              <tr>
                  <th>Field</th>
                  <th class="">Details</th>
              </tr>
          </thead>
          <tbody>
            <tr>
                <td>Admitting Orders</td>
                <td>
                  <textarea class="form-control" name="{{ $viewFolder }}[admittingOrder]" id="{{ $viewFolder }}_admittingOrder" rows=3>{{ isset($datum->admittingOrder) ? $datum->admittingOrder : '' }}</textarea>
                  <input type="hidden" class="form-control" name="{{ $viewFolder }}[id]" value="{{ isset($datum->id) ? $datum->id : '' }}">
                </td>
            </tr>
            <tr>
                <td>Peri-Operative Orders</td>
                <td>
                  <textarea class="form-control" name="{{ $viewFolder }}[additional_orders]" id="{{ $viewFolder }}_additional_orders" rows=3 >{{ isset($datum->additional_orders) ? $datum->additional_orders : '' }}</textarea>
                </td>
            </tr>
            <tr>
                <td>Operative Technique</td>
                <td>
                  <textarea class="form-control" name="{{ $viewFolder }}[operative_tech]" id="{{ $viewFolder }}_operative_technique" rows=3>{{ isset($datum->operative_tech) ? $datum->operative_tech : '' }}</textarea>
                </td>
            </tr>
            <tr>
                <td>Post-Operative Care/Home Care Instructions<br>(Things to expect after the procedure)</td>
                <td>
                  <textarea class="form-control" name="{{ $viewFolder }}[after_proc]" id="{{ $viewFolder }}_after_proc" rows=3>{{ isset($datum->after_proc) ? $datum->after_proc : '' }}</textarea>
                </td>
            </tr>
            <tr>
                <td>Post-Operative Care/Home Care Instructions<br>(Things to watch out for)</td>
                <td>
                  <textarea class="form-control" name="{{ $viewFolder }}[things_watch_out]" id="{{ $viewFolder }}_things_watch_out" rows=3>{{ isset($datum->things_watch_out) ? $datum->things_watch_out : '' }}</textarea>
                </td>
            </tr>
            <tr>
                <td>Post-Operative Care/Home Care Instructions<br>(Things to avoid)</td>
                <td>
                  <textarea class="form-control" name="{{ $viewFolder }}[things_avoid]" id="{{ $viewFolder }}_things_avoid" rows=3>{{ isset($datum->things_avoid) ? $datum->things_avoid : '' }}</textarea>
                </td>
            </tr>
            <tr>
                <td>Post-Operative Care/Home Care Instructions<br>(Wound care)</td>
                <td>
                  <textarea class="form-control" name="{{ $viewFolder }}[wound_care]" id="{{ $viewFolder }}_wound_care" rows=3>{{ isset($datum->wound_care) ? $datum->wound_care : '' }}</textarea>
                </td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>
</div>
<div class="card">
  <div class="card-body">
    @if (isset($datum->created_at))
    <small class="text-muted">Created at:&nbsp;{{ $datum->created_at }}&nbsp;by&nbsp;{{ $datum->creator->name ?? ""}}<br>Updated at:&nbsp;{{ $datum->updated_at }}&nbsp;by&nbsp;{{ $datum->updator->name ?? "" }}</small>
    @endif
  </div>
</div>





