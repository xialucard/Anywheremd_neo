<div class="btn-group-md">
    <a class="btn btn-{{ $bgColor }}" href="#" title="Search" data-bs-toggle="offcanvas" data-bs-target="#searchPane" href="#" role="button"><i class="bi bi-search"><span class="ps-1 d-none d-md-inline">Search</span></i></a>
    @if (Route::has($viewFolder . '.create'))
        @can($viewFolder . '.create')
    <a class="btn btn-{{ $bgColor }}" href="{{ route($viewFolder . '.create', [null, !empty(parse_url(Request::fullUrl())['query']) ? parse_url(Request::fullUrl())['query'] : '']) }}" title="Add New" role="button"><i class="bi bi-file-earmark-plus"></i><span class="ps-1 d-none d-md-inline">Add New</span></a>
        @endcan
    @endif
 </div>