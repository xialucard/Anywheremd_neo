<div class="form-floating mb-3">
  <input class="form-control" type="text" name="{{ $viewFolder }}[f_name]" id="{{ $viewFolder }}_f_name" placeholder="" value="{{ $datum->f_name }}" required>
  <label for="{{ $viewFolder }}_f_name" class="form-label">First Name</label>
  <small id="help_{{ $viewFolder }}_f_name" class="text-muted"></small>
</div>
<div class="form-floating mb-3">
  <input class="form-control" type="text" name="{{ $viewFolder }}[m_name]" id="{{ $viewFolder }}_m_name" placeholder="" value="{{ $datum->m_name }}" required>
  <label for="{{ $viewFolder }}_m_name" class="form-label">Middle Name</label>
  <small id="help_{{ $viewFolder }}_m_name" class="text-muted"></small>
</div>
<div class="form-floating mb-3">
  <input class="form-control" type="text" name="{{ $viewFolder }}[l_name]" id="{{ $viewFolder }}_l_name" placeholder="" value="{{ $datum->l_name }}" required>
  <label for="{{ $viewFolder }}_l_name" class="form-label">First Name</label>
  <small id="help_{{ $viewFolder }}_l_name" class="text-muted"></small>
</div>
<div class="form-floating mb-3">
  <input class="form-control" type="tel" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" name="{{ $viewFolder }}[mobile_no]" id="{{ $viewFolder }}_mobile_no" placeholder="" value="{{ !empty($datum->mobile_no) ? $datum->mobile_no : ''  }}" required>
  <label for="{{ $viewFolder }}_mobile_no" class="form-label">Mobile #</label>
  <small id="help_{{ $viewFolder }}_mobile_no" class="text-muted"></small>
</div>
<div class="form-floating mb-3">
  <input class="form-control" type="email" name="{{ $viewFolder }}[email]" id="{{ $viewFolder }}_email" placeholder="" value="{{ !empty($datum->email) ? $datum->email : ''  }}" required>
  <label for="{{ $viewFolder }}_email" class="form-label">Email</label>
  <small id="help_{{ $viewFolder }}_email" class="text-muted"></small>
</div>
<div class="form-floating mb-3">
  <select class="form-select" name="{{ $viewFolder }}[role]" id="{{ $viewFolder }}_role" placeholder="" disabled>
    <option></option>
    @foreach ($selectItems['roles'] as $ind => $item)
      <option value="{{ $item->name }}" {{ $userRole['0'] == $item->name ? 'selected' : '' }}>{{ $item->name }}</option>
    @endforeach
  </select>
  <label for="{{ $viewFolder }}_role">Role</label>
  <small id="help_{{ $viewFolder }}_role" class="text-muted"></small>
</div>
<div class="card mb-3">
  <div class="card-header">
    Change Password
  </div>
  <div class="card-body">
    <div class="form-floating mb-3">
      <input class="form-control" type="password" name="{{ $viewFolder }}[passwordOld]" id="{{ $viewFolder }}_password-old" placeholder="">
      <label for="{{ $viewFolder }}_password-old" class="form-label">Old Password</label>
      <small id="help_{{ $viewFolder }}_password-old" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="password" name="{{ $viewFolder }}[user][passwordNew]" id="{{ $viewFolder }}_password-new" onblur="
            if($('#{{ $viewFolder }}_password-new').val() != $('#{{ $viewFolder }}_password-reinput').val()){
              $('#submitButton').prop('disabled', true);
              $('#help_{{ $viewFolder }}_password-reinput').text('New password and reinput password not match.');
            }else{
              $('#submitButton').prop('disabled', false);
              $('#help_{{ $viewFolder }}_password-reinput').text('');
            }
          " placeholder="">
      <label for="{{ $viewFolder }}_password-new" class="form-label">New Password</label>
      <small id="help_{{ $viewFolder }}_password-new" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="password" name="{{ $viewFolder }}[user][passwordReinput]" id="{{ $viewFolder }}_password-reinput" onblur="
            if($('#{{ $viewFolder }}_password-new').val() != $('#{{ $viewFolder }}_password-reinput').val()){
              $('#submitButton').prop('disabled', true);
              $('#help_{{ $viewFolder }}_password-reinput').text('New password and reinput password not match.');
            }else{
              $('#submitButton').prop('disabled', false);
              $('#help_{{ $viewFolder }}_password-reinput').text('');
            }
          " placeholder="">
      <label for="{{ $viewFolder }}_password-reinput" class="form-label">Reinput Password</label>
      <small id="help_{{ $viewFolder }}_password-reinput" class="text-muted"></small>
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





