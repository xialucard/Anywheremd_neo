<div class="d-sm-flex flex-sm-row">
    @if (Route::has($viewFolder . '.show'))
        @can($viewFolder . '.show')
    <div class="m-1"><a class="btn btn-{{ $bgColor }} btn-sm w-100" href="{{ route($viewFolder . '.show', [$dat->patient->id, !empty(parse_url(Request::fullUrl())['query']) ? parse_url(Request::fullUrl())['query'] : '']) }}" title="View" role="button"><i class="bi bi-binoculars"></i><span class="ps-1 d-sm-none">View</span></a></div>
        @endcan
    @endif
</div>


