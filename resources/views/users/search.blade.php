<div class="form-floating mb-3">
    <input type="text" name="{{ $viewFolder }}[name]" id="search_{{ $viewFolder }}_name" class="form-control" placeholder="" aria-describedby="helpId">
    <label for="search_{{ $viewFolder }}_name" class="form-label">{{ str_replace('Input New ', '', $inputFormHeader) }} Name</label>
    <small id="help_search_{{ $viewFolder }}_name" class="text-muted"></small>
</div>
<div class="form-floating mb-3">
    <input type="text" name="{{ $viewFolder }}[email]" id="search_{{ $viewFolder }}_email" class="form-control" placeholder="" aria-describedby="helpId">
    <label for="search_{{ $viewFolder }}_email" class="form-label">{{ str_replace('Input New ', '', $inputFormHeader) }} Email</label>
    <small id="help_search_{{ $viewFolder }}_email" class="text-muted"></small>
</div>
<div class="form-floating mb-3">
    <input type="text" list="roleList" name="roles[name]" id="search_{{ $viewFolder }}_role" class="form-control" placeholder="" autocomplete="off">
    <label for="search_{{ $viewFolder }}_role" class="form-label">{{ str_replace('Input New ', '', $inputFormHeader) }} Role</label>
    <small id="help_search_{{ $viewFolder }}_role" class="text-muted"></small>
</div>