@if(($user->active == 2) || ($user->approved == 1 && $user->active == 1))
<div class="card mb-3">
  <div class="card-header">
    Clinic Contact Info
  </div>
  <div class="card-body">
    <div class="form-floating mb-3">
      <input class="form-control" type="text" name="{{ $viewFolder }}[name]" id="{{ $viewFolder }}_name" placeholder="" value="{{ !empty($datum->clinic->name) ? $datum->clinic->name : ''  }}" required>
      <label for="{{ $viewFolder }}_name" class="form-label">Common Name</label>
      <small id="help_{{ $viewFolder }}_name" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="text" name="{{ $viewFolder }}[corporation]" id="{{ $viewFolder }}_corporation" placeholder="" value="{{ !empty($datum->clinic->corporation) ? $datum->clinic->corporation : ''  }}" required>
      <label for="{{ $viewFolder }}_corporation" class="form-label">Registered Name</label>
      <small id="help_{{ $viewFolder }}_corporation" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <textarea class="form-control" name="{{ $viewFolder }}[address]" id="{{ $viewFolder }}_address" required>{{ !empty($datum->clinic->address) ? $datum->clinic->address : ''  }}</textarea>
      <label for="{{ $viewFolder }}_address" class="form-label">Address</label>
      <small id="help_{{ $viewFolder }}_address" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="tel" pattern="[0-9]{4}-[0-9]{4}" name="{{ $viewFolder }}[tel]" id="{{ $viewFolder }}_tel" placeholder="0000-0000" value="{{ !empty($datum->clinic->tel) ? $datum->clinic->tel : ''  }}" required>
      <label for="{{ $viewFolder }}_tel" class="form-label">Tel #</label>
      <small id="help_{{ $viewFolder }}_tel" class="text-muted">Format: 0000-0000</small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="tel" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" name="{{ $viewFolder }}[mobile_no]" id="{{ $viewFolder }}_mobile_no" placeholder="0900-000-0000" value="{{ !empty($datum->clinic->mobile_no) ? $datum->clinic->mobile_no : ''  }}" required>
      <label for="{{ $viewFolder }}_mobile_no" class="form-label">Mobile #</label>
      <small id="help_{{ $viewFolder }}_mobile_no" class="text-muted">Format: 0900-000-0000</small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="email" name="{{ $viewFolder }}[email]" id="{{ $viewFolder }}_email" placeholder="" value="{{ !empty($datum->clinic->email) ? $datum->clinic->email : ''  }}" required>
      <label for="{{ $viewFolder }}_email" class="form-label">Email</label>
      <small id="help_{{ $viewFolder }}_email" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="text" name="{{ $viewFolder }}[website_link]" id="{{ $viewFolder }}_website_link" placeholder="" value="{{ !empty($datum->clinic->website_link) ? $datum->clinic->website_link : ''  }}" >
      <label for="{{ $viewFolder }}_website_link" class="form-label">Web Link</label>
      <small id="help_{{ $viewFolder }}_website_link" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="number" name="{{ $viewFolder }}[max_num_booking]" id="{{ $viewFolder }}_max_num_booking" placeholder="" value="{{ !empty($datum->clinic->max_num_booking) ? $datum->clinic->max_num_booking : ''  }}" required>
      <label for="{{ $viewFolder }}_max_num_booking" class="form-label">Max Number of Booking per Day</label>
      <small id="help_{{ $viewFolder }}_max_num_booking" class="text-muted"></small>
    </div>
  </div>
</div>
<div class="card mb-3">
  <div class="card-header">
    Admin User Info
  </div>
  <div class="card-body">
    <div class="form-floating mb-3">
      <input class="form-control" type="text" name="{{ $viewFolder }}[user][f_name]" id="{{ $viewFolder }}_f_name" placeholder="" value="{{ !empty($datum->f_name) ? $datum->f_name : ''  }}" required>
      <label for="{{ $viewFolder }}_f_name" class="form-label">First Name</label>
      <small id="help_{{ $viewFolder }}_m_name" class="text-muted"></small>
      <input type="hidden" class="form-control" name="{{ $viewFolder }}[user][id]" value="{{ !empty($datum->id) ? $datum->id : '' }}">
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="text" name="{{ $viewFolder }}[user][m_name]" id="{{ $viewFolder }}_m_name" placeholder="" value="{{ !empty($datum->m_name) ? $datum->m_name : ''  }}" required>
      <label for="{{ $viewFolder }}_m_name" class="form-label">Middle Name</label>
      <small id="help_{{ $viewFolder }}_m_name" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="text" name="{{ $viewFolder }}[user][l_name]" id="{{ $viewFolder }}_l_name" placeholder="" value="{{ !empty($datum->l_name) ? $datum->l_name : ''  }}" required>
      <label for="{{ $viewFolder }}_l_name" class="form-label">Last Name</label>
      <small id="help_{{ $viewFolder }}_l_name" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="text" name="{{ $viewFolder }}[user][designation]" id="{{ $viewFolder }}_designation" placeholder="" value="{{ !empty($datum->designation) ? $datum->designation : ''  }}" required>
      <label for="{{ $viewFolder }}_designation" class="form-label">Designation</label>
      <small id="help_{{ $viewFolder }}_designation" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="tel" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" name="{{ $viewFolder }}[user][mobile_no]" id="{{ $viewFolder }}_rep_mobile_no" placeholder="" value="{{ !empty($datum->mobile_no) ? $datum->mobile_no : ''  }}" required>
      <label for="{{ $viewFolder }}_rep_mobile_no" class="form-label">Mobile #</label>
      <small id="help_{{ $viewFolder }}_rep_mobile_no" class="text-muted">Format: 0900-000-0000</small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="email" name="{{ $viewFolder }}[user][email]" id="{{ $viewFolder }}_rep_email" placeholder="" value="{{ !empty($datum->email) ? $datum->email : ''  }}" {{ !empty($datum->users[0]->id) ? 'disabled' : 'required' }}>
      <label for="{{ $viewFolder }}_rep_email" class="form-label">Email</label>
      <small id="help_{{ $viewFolder }}_rep_email" class="text-muted"></small>
    </div>
  </div>
</div>
<div class="card mb-3">
  <div class="card-header">
    Change Password
  </div>
  <div class="card-body">
    <div class="form-floating mb-3">
      <input class="form-control" type="password" name="{{ $viewFolder }}[user][passwordOld]" id="{{ $viewFolder }}_password-old" placeholder="">
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
@endif





