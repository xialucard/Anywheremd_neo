
<div class="form-floating mb-3">
    <input type="text" list="patientNameList" name="{{ $viewFolder }}[name]" id="search_{{ $viewFolder }}_name" class="form-control" placeholder="" autocomplete="off" aria-describedby="helpId">
    <label for="search_{{ $viewFolder }}_name" class="form-label">{{ str_replace('Input New ', '', $inputFormHeader) }} Patient's Name</label>
    <small id="help_search_{{ $viewFolder }}_name" class="text-muted"></small>
</div>