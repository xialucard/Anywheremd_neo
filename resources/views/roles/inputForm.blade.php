<div class="form-floating mb-3">
  <input class="form-control" type="text" name="{{ $viewFolder }}[name]" id="{{ $viewFolder }}_name" placeholder="" value="{{ !empty($datum->name) ? $datum->name : ''  }}" required>
  <label for="{{ $viewFolder }}_name" class="form-label">Name</label>
  <small id="help_{{ $viewFolder }}_name" class="text-muted"></small>
</div>
<div class="card mt-3">
  <div class="card-header">
    Assigned Permission/s
  </div>
  <div class="card-body">
    @php
      $selectedPermission[] = "";
    @endphp
    @if (!empty($datum->permissions))
      @php
        $selectedPermission[] = "";
        foreach($datum->permissions as $permission){
          $selectedPermission[] = $permission['id'];
        }
      @endphp
    @endif
    @foreach ($selectItems['permissions'] as $ind => $item)
      @if (stristr($item->name, ".") && !stristr($item->name, "password"))
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="{{ $viewFolder }}[permission][{{ $item->name }}]" value="{{ $item->id }}" id="{{ $viewFolder }}_user_permission_{{ $ind }}" {{ in_array($item->id, $selectedPermission) ? 'checked' : ''}}>
      <label class="form-check-label" for="{{ $viewFolder }}_user_warehouse_{{ $ind }}">
        {{ $item->name . " | " . $item->guard_name }}
      </label>
    </div>       
      @endif
    @endforeach
  </div>
</div>
<div class="card mt-3">
  <div class="card-body">
    @if ($datum->created_at != null)
    <small class="text-muted">Created at:&nbsp;{{ $datum->created_at }}&nbsp;by&nbsp;{{ $datum->creator->name ?? ""}}<br>Updated at:&nbsp;{{ $datum->updated_at }}&nbsp;by&nbsp;{{ $datum->updator->name ?? "" }}</small>
    @endif
  </div>
</div>





