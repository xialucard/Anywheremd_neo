<div class="card mb-3">
  <div class="card-header">
    Clinic Contact Info
  </div>
  <div class="card-body">
    <div class="form-floating mb-3">
      <input class="form-control" type="text" name="{{ $viewFolder }}[name]" id="{{ $viewFolder }}_name" placeholder="" value="{{ !empty($datum->name) ? $datum->name : ''  }}" required>
      <label for="{{ $viewFolder }}_name" class="form-label">Common Name</label>
      <small id="help_{{ $viewFolder }}_name" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="text" name="{{ $viewFolder }}[corporation]" id="{{ $viewFolder }}_corporation" placeholder="" value="{{ !empty($datum->corporation) ? $datum->corporation : ''  }}" required>
      <label for="{{ $viewFolder }}_corporation" class="form-label">Registered Name</label>
      <small id="help_{{ $viewFolder }}_corporation" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <textarea class="form-control" name="{{ $viewFolder }}[address]" id="{{ $viewFolder }}_address" required>{{ !empty($datum->address) ? $datum->address : ''  }}</textarea>
      <label for="{{ $viewFolder }}_address" class="form-label">Address</label>
      <small id="help_{{ $viewFolder }}_address" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="text" name="{{ $viewFolder }}[tel]" id="{{ $viewFolder }}_tel" placeholder="" value="{{ !empty($datum->tel) ? $datum->tel : ''  }}" required>
      <label for="{{ $viewFolder }}_tel" class="form-label">Tel #</label>
      <small id="help_{{ $viewFolder }}_tel" class="text-muted"></small>
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
    <div class="form-floating mb-3">
      <input class="form-control" type="text" name="{{ $viewFolder }}[website_link]" id="{{ $viewFolder }}_website_link" placeholder="" value="{{ !empty($datum->website_link) ? $datum->website_link : ''  }}" >
      <label for="{{ $viewFolder }}_website_link" class="form-label">Web Link</label>
      <small id="help_{{ $viewFolder }}_website_link" class="text-muted"></small>
    </div>
  </div>
</div>
<div class="card mb-3">
  <div class="card-header">
    Admin User Info
  </div>
  <div class="card-body">
    <div class="form-floating mb-3">
      <input class="form-control" type="text" name="{{ $viewFolder }}[user][f_name]" id="{{ $viewFolder }}_f_name" placeholder="" value="{{ !empty($datum->users[0]->f_name) ? $datum->users[0]->f_name : ''  }}" required>
      <label for="{{ $viewFolder }}_f_name" class="form-label">First Name</label>
      <small id="help_{{ $viewFolder }}_m_name" class="text-muted"></small>
      <input type="hidden" class="form-control" name="{{ $viewFolder }}[user][id]" value="{{ !empty($datum->users[0]->id) ? $datum->users[0]->id : '' }}">
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="text" name="{{ $viewFolder }}[user][m_name]" id="{{ $viewFolder }}_m_name" placeholder="" value="{{ !empty($datum->users[0]->m_name) ? $datum->users[0]->m_name : ''  }}" required>
      <label for="{{ $viewFolder }}_m_name" class="form-label">Middle Name</label>
      <small id="help_{{ $viewFolder }}_m_name" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="text" name="{{ $viewFolder }}[user][l_name]" id="{{ $viewFolder }}_l_name" placeholder="" value="{{ !empty($datum->users[0]->l_name) ? $datum->users[0]->l_name : ''  }}" required>
      <label for="{{ $viewFolder }}_l_name" class="form-label">Last Name</label>
      <small id="help_{{ $viewFolder }}_l_name" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="text" name="{{ $viewFolder }}[user][designation]" id="{{ $viewFolder }}_designation" placeholder="" value="{{ !empty($datum->users[0]->designation) ? $datum->users[0]->designation : ''  }}" required>
      <label for="{{ $viewFolder }}_designation" class="form-label">Designation</label>
      <small id="help_{{ $viewFolder }}_designation" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="text" name="{{ $viewFolder }}[user][mobile_no]" id="{{ $viewFolder }}_rep_mobile_no" placeholder="" value="{{ !empty($datum->users[0]->mobile_no) ? $datum->users[0]->mobile_no : ''  }}" required>
      <label for="{{ $viewFolder }}_rep_mobile_no" class="form-label">Mobile #</label>
      <small id="help_{{ $viewFolder }}_rep_mobile_no" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="email" name="{{ $viewFolder }}[user][email]" id="{{ $viewFolder }}_rep_email" placeholder="" value="{{ !empty($datum->users[0]->email) ? $datum->users[0]->email : ''  }}" {{ !empty($datum->users[0]->id) ? 'disabled' : 'required' }}>
      <label for="{{ $viewFolder }}_rep_email" class="form-label">Email</label>
      <small id="help_{{ $viewFolder }}_rep_email" class="text-muted"></small>
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





