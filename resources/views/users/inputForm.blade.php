<div class="form-floating mb-3">
  <input class="form-control" type="text" name="{{ $viewFolder }}[f_name]" id="{{ $viewFolder }}_f_name" placeholder="" value="{{ !empty($datum->f_name) ? $datum->f_name : ''  }}" required>
  <label for="{{ $viewFolder }}_f_name" class="form-label">First Name</label>
  <small id="help_{{ $viewFolder }}_m_name" class="text-muted"></small>
</div>
<div class="form-floating mb-3">
  <input class="form-control" type="text" name="{{ $viewFolder }}[m_name]" id="{{ $viewFolder }}_m_name" placeholder="" value="{{ !empty($datum->m_name) ? $datum->m_name : ''  }}" required>
  <label for="{{ $viewFolder }}_m_name" class="form-label">Middle Name</label>
  <small id="help_{{ $viewFolder }}_m_name" class="text-muted"></small>
</div>
<div class="form-floating mb-3">
  <input class="form-control" type="text" name="{{ $viewFolder }}[l_name]" id="{{ $viewFolder }}_l_name" placeholder="" value="{{ !empty($datum->l_name) ? $datum->l_name : ''  }}" required>
  <label for="{{ $viewFolder }}_l_name" class="form-label">Last Name</label>
  <small id="help_{{ $viewFolder }}_l_name" class="text-muted"></small>
</div>
<div class="form-floating mb-3">
  <input class="form-control" type="text" name="{{ $viewFolder }}[mobile_no]" id="{{ $viewFolder }}_mobile_no" placeholder="" value="{{ !empty($datum->mobile_no) ? $datum->mobile_no : ''  }}" required>
  <label for="{{ $viewFolder }}_mobile_no" class="form-label">Mobile #</label>
  <small id="help_{{ $viewFolder }}_mobile_no" class="text-muted"></small>
</div>
<div class="form-floating mb-3">
  <input class="form-control" type="email" name="{{ $viewFolder }}[email]" id="{{ $viewFolder }}_email" placeholder="" value="{{ !empty($datum->email) ? $datum->email : ''  }}" required>
  <label for="{{ $viewFolder }}_email" class="form-label">Email</label>
  <small id="help_{{ $viewFolder }}_email" class="text-muted"></small>
</div>
<div class="form-floating">
  <select class="form-select" name="{{ $viewFolder }}[role]" id="{{ $viewFolder }}_role" placeholder="" required>
    <option></option>
    @foreach ($selectItems['roles'] as $ind => $item)
      <option value="{{ $item->name }}" {{ $userRole['0'] == $item->name ? 'selected' : '' }}>{{ $item->name }}</option>
    @endforeach
  </select>
  <label for="{{ $viewFolder }}_role">Role</label>
  <small id="help_{{ $viewFolder }}_role" class="text-muted"></small>
</div>
<small class="text-muted">Default password is r00tb33r</small>
<div class="card">
  <div class="card-body">
    @if ($datum->created_at != null)
    <small class="text-muted">Created at:&nbsp;{{ $datum->created_at }}&nbsp;by&nbsp;{{ $datum-> ?? ""}}<br>Updated at:&nbsp;{{ $datum->updated_at }}&nbsp;by&nbsp;{{ $datum->updator->name ?? "" }}</small>
    @endif
  </div>
</div>





