<div class="form-floating mb-3">
    <input type="text" name="{{ $viewFolder }}[name]" id="search_{{ $viewFolder }}_name" class="form-control" placeholder="" aria-describedby="helpId">
    <label for="search_{{ $viewFolder }}_name" class="form-label">{{ str_replace('Input New ', '', $inputFormHeader) }} Name</label>
    <small id="help_search_{{ $viewFolder }}_name" class="text-muted"></small>
</div>