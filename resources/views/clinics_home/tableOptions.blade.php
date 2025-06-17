<div class="d-sm-flex flex-sm-row">
    @if (file_exists(public_path('storage/prescription_files/' . $dat->id . '_' . $dat->patient->l_name . '.pdf')))
    <div class="m-1"><a class="btn btn-{{ $bgColor }} btn-sm w-100" href="{{ asset('storage/prescription_files/' . $dat->id . '_' . $dat->patient->l_name . '.pdf') }}" title="Download Prescription" role="button" download><i class="bi bi-prescription"></i><span class="ps-1 d-sm-none">Download Prescription</span></a></div>
    @endif
    @if (file_exists(public_path('storage/med_cert_files/' . $dat->id . '_' . $dat->patient->l_name . '.pdf')))
    <div class="m-1"><a class="btn btn-{{ $bgColor }} btn-sm w-100" href="{{ asset('storage/med_cert_files/' . $dat->id . '_' . $dat->patient->l_name . '.pdf') }}" title="Download Med Cert" role="button" download><i class="bi bi-file-medical"></i><span class="ps-1 d-sm-none">Download Med Cert</span></a></div>
    @endif
    @if (file_exists(public_path('storage/admitting_order_files/' . $dat->id . '_' . $dat->patient->l_name . '.pdf')))
    <div class="m-1"><a class="btn btn-{{ $bgColor }} btn-sm w-100" href="{{ asset('storage/admitting_order_files/' . $dat->id . '_' . $dat->patient->l_name . '.pdf') }}" title="Download Admitting Order" role="button" download><i class="bi bi-file-arrow-down"></i><span class="ps-1 d-sm-none">Download Admitting Order</span></a></div>
    @endif
    @if (Route::has($viewFolder . '.show') && ($dat->temp != '' || $dat->consultation_parent_id != ''))
        @can($viewFolder . '.show')
    <div class="m-1"><a class="btn btn-{{ $bgColor }} btn-sm w-100" href="{{ route($viewFolder . '.show', [$dat->id, !empty(parse_url(Request::fullUrl())['query']) ? parse_url(Request::fullUrl())['query'] : '']) }}" title="View" role="button"><i class="bi bi-binoculars"></i><span class="ps-1 d-sm-none">View</span></a></div>
        @endcan
    @endif
    @if (Route::has($viewFolder . '.edit') && ($dat->status != 'Done') && $dat->consultation_parent_id == '')
        @can($viewFolder . '.edit')
    <div class="m-1"><a class="btn btn-{{ $bgColor }} btn-sm w-100" href="{{ route($viewFolder . '.edit', [$dat->id, !empty(parse_url(Request::fullUrl())['query']) ? parse_url(Request::fullUrl())['query'] : '']) }}" title="Edit" role="button"><i class="bi bi-pencil"></i><span class="ps-1 d-sm-none">Edit</span></a></div>
        @endcan
    @endif
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


