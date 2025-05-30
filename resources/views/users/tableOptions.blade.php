<div class="d-sm-flex flex-sm-row">
    @if (Route::has($viewFolder . '.show'))
        @can($viewFolder . '.show')
    <div class="m-1"><a class="btn btn-dark btn-sm w-100" href="{{ route($viewFolder . '.show', [$dat->id, !empty(parse_url(Request::fullUrl())['query']) ? parse_url(Request::fullUrl())['query'] : '']) }}" title="View" role="button"><i class="bi bi-binoculars"></i><span class="ps-1 d-sm-none">View</span></a></div>
        @endcan
    @endif
    @if (Route::has($viewFolder . '.edit'))
        @can($viewFolder . '.edit')
    <div class="m-1"><a class="btn btn-dark btn-sm w-100" href="{{ route($viewFolder . '.edit', [$dat->id, !empty(parse_url(Request::fullUrl())['query']) ? parse_url(Request::fullUrl())['query'] : '']) }}" title="Edit" role="button"><i class="bi bi-pencil"></i><span class="ps-1 d-sm-none">Edit</span></a></div>
        @endcan
    @endif
    @if (Route::has($viewFolder . '.destroy'))
        @can($viewFolder . '.destroy')
    <form action="{{ route($viewFolder . '.destroy', $dat->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="m-1"><button type="submit" class="btn btn-dark btn-sm w-100" onclick="if(!confirm('Are you sure you want to delete this?')) return false;"><i class="bi bi-trash"></i><span class="ps-1 d-sm-none">Delete</span></button></div>
    </form>
        @endcan
    @endif
</div>


