@if(($user->active == 2) || ($user->approved == 1 && $user->active == 1))
<div class="card mb-3">
  <div class="card-header">
    Personal Info
  </div>
  <div class="card-body">
    <div class="mb-3">
      <div class="mb-4 d-flex justify-content-center">
          <img id="profileImage" src="{{ $datum->profile_pic != '' ? asset('storage/doctor_files/' . $datum->profile_pic) : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}"
          alt="example placeholder" style="width: 300px;" />
      </div>
      <div class="d-flex justify-content-center">
          <div class="btn btn-{{ $bgColor }} btn-rounded">
              <label class="form-label text-white m-1" for="{{ $viewFolder }}_profile_pic">Profile Pic</label>
              <input type="file" class="form-control d-none" name="{{ $viewFolder }}[profile_pic]" id="{{ $viewFolder }}_profile_pic" onchange="displaySelectedImage(event, 'profileImage')" />
          </div>
      </div>
    </div>
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
      <input class="form-control" type="date" name="{{ $viewFolder }}[dob]" id="{{ $viewFolder }}_dob" placeholder="" value="{{ !empty($datum->dob) ? $datum->dob : ''  }}" required>
      <label for="{{ $viewFolder }}_l_name" class="form-label">Birth Date</label>
      <small id="help_{{ $viewFolder }}_l_name" class="text-muted"></small>
    </div>
    <div class="row g-3 align-items-center">
      <div class="col-auto">
        <label class="col-form-label">Gender</label>
      </div>
      <div class="col-auto">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="{{ $viewFolder }}[gender]" id="{{ $viewFolder }}_gender1" value="Male" {{ !empty($datum->gender) && $datum->gender == 'Male' ? 'checked' : '' }}>
          <label class="form-check-label" for="{{ $viewFolder }}_gender1">Male</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="{{ $viewFolder }}[gender]" id="{{ $viewFolder }}_gender2" value="Female" {{ !empty($datum->gender) && $datum->gender == 'Female' ? 'checked' : '' }}>
          <label class="form-check-label" for="{{ $viewFolder }}_gender2">Female</label>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="card mb-3">
  <div class="card-header">
    Contact Info
  </div>
  <div class="card-body">
    <div class="form-floating mb-3">
      <textarea class="form-control" name="{{ $viewFolder }}[address]" id="{{ $viewFolder }}_address" required>{{ !empty($datum->address) ? $datum->address : ''  }}</textarea>
      <label for="{{ $viewFolder }}_address" class="form-label">Address</label>
      <small id="help_{{ $viewFolder }}_address" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="tel" pattern="[0-9]{4}-[0-9]{4}" name="{{ $viewFolder }}[tel]" id="{{ $viewFolder }}_tel" placeholder="0000-0000" value="{{ !empty($datum->tel) ? $datum->tel : ''  }}" required>
      <label for="{{ $viewFolder }}_tel" class="form-label">Tel #</label>
      <small id="help_{{ $viewFolder }}_tel" class="text-muted">Format: 0000-0000</small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="tel" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" name="{{ $viewFolder }}[mobile_no]" id="{{ $viewFolder }}_mobile_no" placeholder="0900-000-0000" value="{{ !empty($datum->mobile_no) ? $datum->mobile_no : ''  }}" required>
      <label for="{{ $viewFolder }}_mobile_no" class="form-label">Mobile #</label>
      <small id="help_{{ $viewFolder }}_mobile_no" class="text-muted">Format: 0900-000-0000</small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="email" name="{{ $viewFolder }}[email]" id="{{ $viewFolder }}_email" placeholder="" value="{{ !empty($datum->email) ? $datum->email : ''  }}">
      <label for="{{ $viewFolder }}_email" class="form-label">Email</label>
      <small id="help_{{ $viewFolder }}_email" class="text-muted"></small>
    </div>
  </div>
</div>
<div class="card mb-3">
  <div class="card-header">
    Profession Info
  </div>
  <div class="card-body">
    <div class="form-floating mb-3">
      @php
          ksort($selectItems['specialty']);
      @endphp
      <select class="form-select" name="{{ $viewFolder }}[specialty]" id="{{ $viewFolder }}_specialty" placeholder="Select One" required>
        @foreach ($selectItems['specialty'] as $ind => $item)
          @if (!empty($item[0]))
        <optgroup label="{{ $ind }}">
            @php
                sort($item);
            @endphp
            @foreach ($item as $itemSub)
            <option value="{{ $itemSub != ' ' ? $ind . ' - ' . $itemSub : $ind }}" {{ (!empty($datum->specialty) && $datum->specialty == ($itemSub != ' ' ? $ind . ' - ' . $itemSub : $ind)) ? 'selected' : '' }}>{{ $itemSub != ' ' ? $ind . ' - ' . $itemSub : $ind }}</option>
            @endforeach
        </optgroup>
          @else
        <option value="{{ $ind }}" {{ (!empty($datum->specialty) && $datum->specialty == $ind) ? 'selected' : '' }}>{{ $ind }}</option>
          @endif
          
        @endforeach
      </select>
      <label for="{{ $viewFolder }}_specialty">Specialty</label>
      <small id="help_{{ $viewFolder }}_specialty" class="text-muted"></small>
    </div>
    <div class="mb-3">
      <div class="mb-4 d-flex justify-content-center">
          <img id="prcImage" src="{{ $datum->prc_pic != '' ? asset('storage/doctor_files/' . $datum->prc_pic) : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}"
          alt="example placeholder" style="width: 300px;" />
      </div>
      <div class="d-flex justify-content-center">
          <div class="btn btn-{{ $bgColor }} btn-rounded">
              <label class="form-label text-white m-1" for="{{ $viewFolder }}_prc_pic">PRC License Pic</label>
              <input type="file" class="form-control d-none" name="{{ $viewFolder }}[prc_pic]" id="{{ $viewFolder }}_prc_pic" onchange="displaySelectedImage(event, 'prcImage')" />
          </div>
      </div>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="text" name="{{ $viewFolder }}[prc_number]" id="{{ $viewFolder }}_prc_number" placeholder="" value="{{ !empty($datum->prc_number) ? $datum->prc_number : ''  }}" required>
      <label for="{{ $viewFolder }}_prc_number" class="form-label">PRC #</label>
      <small id="help_{{ $viewFolder }}_prc_number" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="date" name="{{ $viewFolder }}[prc_expiry]" id="{{ $viewFolder }}_prc_expiry" placeholder="" value="{{ !empty($datum->prc_expiry) ? $datum->prc_expiry : ''  }}" required>
      <label for="{{ $viewFolder }}_prc_expiry" class="form-label">PRC Expiry</label>
      <small id="help_{{ $viewFolder }}_prc_expiry" class="text-muted"></small>
    </div>
    <div class="mb-3">
      <div class="mb-4 d-flex justify-content-center">
          <img id="diplomaImage" src="{{ $datum->diploma_pic != '' ? asset('storage/doctor_files/' . $datum->diploma_pic) : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}"
          alt="example placeholder" style="width: 300px;" />
      </div>
      <div class="d-flex justify-content-center">
          <div class="btn btn-{{ $bgColor }} btn-rounded">
              <label class="form-label text-white m-1" for="{{ $viewFolder }}_diploma_pic">Diploma Pic</label>
              <input type="file" class="form-control d-none" name="{{ $viewFolder }}[diploma_pic]" id="{{ $viewFolder }}_diploma_pic" onchange="displaySelectedImage(event, 'diplomaImage')" />
          </div>
      </div>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="text" name="{{ $viewFolder }}[medSchool]" id="{{ $viewFolder }}_medSchool" placeholder="" value="{{ !empty($datum->medSchool) ? $datum->medSchool : ''  }}" required>
      <label for="{{ $viewFolder }}_medSchool" class="form-label">Medical School</label>
      <small id="help_{{ $viewFolder }}_medSchool" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="date" name="{{ $viewFolder }}[medgraddate]" id="{{ $viewFolder }}_medgraddate" placeholder="" value="{{ !empty($datum->medgraddate) ? $datum->medgraddate : ''  }}" required>
      <label for="{{ $viewFolder }}_medgraddate" class="form-label">Date Graduated</label>
      <small id="help_{{ $viewFolder }}_medgraddate" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="text" name="{{ $viewFolder }}[residencySchool]" id="{{ $viewFolder }}_residencySchool" placeholder="" value="{{ !empty($datum->residencySchool) ? $datum->residencySchool : ''  }}" required>
      <label for="{{ $viewFolder }}_residencySchool" class="form-label">Residency Institution</label>
      <small id="help_{{ $viewFolder }}_residencySchool" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="text" name="{{ $viewFolder }}[subSchool]" id="{{ $viewFolder }}_subSchool" placeholder="" value="{{ !empty($datum->subSchool) ? $datum->subSchool : ''  }}" required>
      <label for="{{ $viewFolder }}_subSchool" class="form-label">Sub-specialty Institution</label>
      <small id="help_{{ $viewFolder }}_subSchool" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="text" name="{{ $viewFolder }}[hAffiliation]" id="{{ $viewFolder }}_hAffiliation" placeholder="" value="{{ !empty($datum->hAffiliation) ? $datum->hAffiliation : ''  }}" required>
      <label for="{{ $viewFolder }}_hAffiliation" class="form-label">Hospital Affiliation</label>
      <small id="help_{{ $viewFolder }}_hAffiliation" class="text-muted"></small>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" type="number" name="{{ $viewFolder }}[fee]" id="{{ $viewFolder }}_fee" placeholder="" value="{{ !empty($datum->fee) ? $datum->fee : ''  }}" required>
      <label for="{{ $viewFolder }}_fee" class="form-label">Fee</label>
      <small id="help_{{ $viewFolder }}_fee" class="text-muted"></small>
    </div>
    <div class="mb-3">
      <div class="mb-4 d-flex justify-content-center">
          <img id="sigImage" src="{{ $datum->sig_pic != '' ? (stristr($datum->sig_pic, 'uploads') ? asset('storage/' . $datum->sig_pic) : asset('storage/doctor_files/' . $datum->sig_pic)) : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg' }}"
          alt="example placeholder" style="width: 300px;" />
      </div>
      <div class="d-flex justify-content-center">
          <div class="btn btn-{{ $bgColor }} btn-rounded">
              <label class="form-label text-white m-1" for="{{ $viewFolder }}_sig_pic">Signature Pic</label>
              <input type="file" class="form-control d-none" name="{{ $viewFolder }}[sig_pic]" id="{{ $viewFolder }}_sig_pic" onchange="displaySelectedImage(event, 'sigImage')" />
          </div>
      </div>
    </div>
  </div>
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
      <input class="form-control" type="password" name="{{ $viewFolder }}[passwordNew]" id="{{ $viewFolder }}_password-new" onblur="
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
      <input class="form-control" type="password" name="{{ $viewFolder }}[passwordReinput]" id="{{ $viewFolder }}_password-reinput" onblur="
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
<script>
  function displaySelectedImage(event, elementId) {
    const selectedImage = document.getElementById(elementId);
    const fileInput = event.target;

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            selectedImage.src = e.target.result;
        };

        reader.readAsDataURL(fileInput.files[0]);
    }
  }
</script>
@endif





