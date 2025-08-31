@php
  unset($referal_conso);
  if(isset($dat->parent_consultation)){
    $referal_conso = $dat;
    $dat = $dat->parent_consultation;
  }
//   print($dat->consultation_parent_id . ' ');
//   print($dat->temp . ' ');
//   print($dat->updated_by . ' ');
//   print($user->id);
@endphp
<div class="d-sm-flex flex-sm-row">
    @if (file_exists(public_path('storage/prescription_files/' . $dat->id . '_' . $dat->patient->l_name . '.pdf')))
    <div class="m-1"><a class="btn btn-{{ $bgColor }} btn-sm w-100" href="{{ asset('storage/prescription_files/' . (isset($referal_conso) ? $referal_conso->id : $dat->id) . '_' . (isset($referal_conso) ? $referal_conso->patient->l_name : $dat->patient->l_name) . '.pdf') }}" title="Download Prescription" role="button" download><i class="bi bi-prescription"></i><span class="ps-1 d-sm-none">Download Prescription</span></a></div>
    @endif
    @if (file_exists(public_path('storage/med_cert_files/' . $dat->id . '_' . $dat->patient->l_name . '.pdf')))
    <div class="m-1"><a class="btn btn-{{ $bgColor }} btn-sm w-100" href="{{ asset('storage/med_cert_files/' . (isset($referal_conso) ? $referal_conso->id : $dat->id) . '_' . (isset($referal_conso) ? $referal_conso->patient->l_name :$dat->patient->l_name) . '.pdf') }}" title="Download Med Cert" role="button" download><i class="bi bi-file-medical"></i><span class="ps-1 d-sm-none">Download Med Cert</span></a></div>
    @endif
    @if (file_exists(public_path('storage/admitting_order_files/' . $dat->id . '_' . $dat->patient->l_name . '.pdf')))
    <div class="m-1"><a class="btn btn-{{ $bgColor }} btn-sm w-100" href="{{ asset('storage/admitting_order_files/' . (isset($referal_conso) ? $referal_conso->id : $dat->id) . '_' . (isset($referal_conso) ? $referal_conso->patient->l_name :$dat->patient->l_name) . '.pdf') }}" title="Download Admitting Order" role="button" download><i class="bi bi-file-arrow-down"></i><span class="ps-1 d-sm-none">Download Admitting Order</span></a></div>
    @endif
    
    @if (Route::has($viewFolder . '.show') && ($dat->status == 'Done' || (!is_null($dat->temp) && !is_null($dat->vitals_updated_by) && $dat->vitals_updated_by != $user->id)))
        @can($viewFolder . '.show')
    <div class="m-1"><a class="btn btn-{{ $bgColor }} btn-sm w-100" href="{{ route($viewFolder . '.show', [isset($referal_conso) ? $referal_conso->id : $dat->id, !empty(parse_url(Request::fullUrl())['query']) ? parse_url(Request::fullUrl())['query'] : '']) }}" title="View" role="button"><i class="bi bi-binoculars"></i><span class="ps-1 d-sm-none">View</span></a></div>
        @endcan
    @endif
    @if (Route::has($viewFolder . '.edit') && (($dat->status != 'Done' && is_null($dat->consultation_parent_id) && !isset($dat->consultation_referals)) || is_null($dat->temp) || is_null($dat->vitals_updated_by) || $dat->booking_type == 'Dialysis' || (!is_null($dat->temp) && ($dat->vitals_updated_by == $user->id))))
        @can($viewFolder . '.edit')
    <div class="m-1"><a class="btn btn-{{ $bgColor }} btn-sm w-100" href="{{ route($viewFolder . '.edit', [isset($referal_conso) ? $referal_conso->id : $dat->id, !empty(parse_url(Request::fullUrl())['query']) ? parse_url(Request::fullUrl())['query'] : '']) }}" title="Edit" role="button"><i class="bi bi-pencil"></i><span class="ps-1 d-sm-none">Edit</span></a></div>
        @endcan
    @endif
    @if (Route::has($viewFolder . '.destroy') && $dat->status != 'Done')
        @can($viewFolder . '.destroy')
    <form action="{{ route($viewFolder . '.destroy', isset($referal_conso) ? $referal_conso->id : $dat->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="m-1"><button type="submit" class="btn btn-{{ $bgColor }} btn-sm w-100" onclick="if(!confirm('Are you sure you want to delete this?')) return false;"><i class="bi bi-trash"></i><span class="ps-1 d-sm-none">Delete</span></button></div>
    </form>
        @endcan
    @endif
</div>


