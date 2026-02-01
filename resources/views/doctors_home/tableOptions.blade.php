<div class="d-sm-flex flex-sm-row">
    @if($dat->booking_type == 'Dialysis')
         @if($dat->assessment == '' || $dat->planMed == '')
        <div class="m-1"><a class="btn pe-none"><i class="bi bi-exclamation-triangle-fill text-danger"></i></a></div>
        @endif
    @else
        @if($dat->assessment == '' || $dat->planMed == '' || $dat->plan == '')
        <div class="m-1"><a class="btn pe-none"><i class="bi bi-exclamation-triangle-fill text-danger"></i></a></div>
        @endif
    @endif
    @if (Route::has($viewFolder . '.show') && $dat->status == 'Done')
        @can($viewFolder . '.show')
    <div class="m-1"><a class="btn btn-{{ $bgColor }} btn-sm w-100" href="{{ route($viewFolder . '.show', [$dat->id, !empty(parse_url(Request::fullUrl())['query']) ? parse_url(Request::fullUrl())['query'] : '']) }}" title="View" role="button"><i class="bi bi-binoculars"></i><span class="ps-1 d-sm-none">View</span></a></div>
        @endcan
    @endif
    @if (Route::has($viewFolder . '.edit') && $dat->status != 'Done')
        @can($viewFolder . '.edit')
    <div class="m-1"><a class="btn btn-{{ $bgColor }} btn-sm w-100" href="{{ route($viewFolder . '.edit', [$dat->id, !empty(parse_url(Request::fullUrl())['query']) ? parse_url(Request::fullUrl())['query'] : '']) }}" title="Edit" role="button"><i class="bi bi-pencil"></i><span class="ps-1 d-sm-none">Edit</span></a></div>
        @endcan
    @endif
    {{-- @if (Route::has($viewFolder . '.pdfPrescription'))
        @can($viewFolder . '.pdfPrescription')
    <div class="m-1"><a class="btn btn-{{ $bgColor }} btn-sm w-100" href="{{ route($viewFolder . '.pdfPrescription', [$dat->id, !empty(parse_url(Request::fullUrl())['query']) ? parse_url(Request::fullUrl())['query'] : '']) }}" title="Download PDF" role="button"><i class="bi bi-file-pdf"></i><span class="ps-1 d-sm-none">Download PDF</span></a></div>
        @endcan
    @endif --}}
    @if (Route::has($viewFolder . '.destroy') && $dat->status != 'Done')
        @can($viewFolder . '.destroy')
    <form action="{{ route($viewFolder . '.destroy', $dat->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="m-1"><button type="submit" class="btn btn-{{ $bgColor }} btn-sm w-100" onclick="if(!confirm('Are you sure you want to delete this?')) return false;"><i class="bi bi-trash"></i><span class="ps-1 d-sm-none">Delete</span></button></div>
    </form>
        @endcan
    @endif
</div>


