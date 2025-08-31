<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
@php
//   unset($referal_conso);
//   if(isset($datum->parent_consultation)){
//     $referal_conso = $datum;
//     $datum = $datum->parent_consultation;
//   }
  unset($referal_conso);
    if(isset($datum->clinic->id))
        $clinicDat = $datum->clinic->id;
    if(isset($datum->doctor->id))
        $doctorDat = $datum->doctor->id;
    $key = false;
    if(isset($datum->parent_consultation)){
        $referal_conso = $datum;
        $datum = $datum->parent_consultation;
        $key = true;
    }
@endphp
<form {{ isset($formId) ? 'id=' . $formId : '' }} action="{{ Route::has($viewFolder . '.' . $formAction) ? route($viewFolder . '.' . $formAction, $datum->id) : ''}}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($datum->id != null)
        @method('PATCH')
    @endif

    <div class="modal fade" id="inputFormModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered {{ $modalSize }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">{{ $inputFormHeader }}</h5>
                        <button type="button" class="btn-close modalForm-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body {{ stristr($inputFormHeader, 'Booking') ? 'pt-0' : '' }}">
                    <div class="container">
                        <div class="pb-8">
                            @if ($errors->any())
                                <div class="bg-danger text-white font-weight-bold rounded-top px-4 py-2">
                                    Something went wrong...
                                </div>
                                <ul class="border border-top-0 border-danger rounded-bottom px-4 py-2 text-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                    
                    @include(!isset($action) ? $viewFolder . '.inputForm' : $viewFolder . '.' . $action)
                    @if(isset($referer))
                    <input type="hidden" class="form-control" name="{{ $viewFolder }}[referer]" value="{{ $referer }}">
                    @endif
                </div>
                @php
                    $bgColor = 'dark';
                    if(!empty(Auth::user()->user_type)){
                        if(Auth::user()->user_type == 'Doctor')
                            $bgColor = 'warning';
                        if(Auth::user()->user_type == 'Clinic')
                            $bgColor = 'primary';
                    }
                @endphp
                <div class="modal-footer">
                @if(stristr($inputFormHeader, 'Booking') && $modalSize == 'modal-fullscreen')
                    <input type="hidden" class="form-control" id="{{ $viewFolder }}_submit_type" name="{{ $viewFolder }}[submit_type]" value="">
                    <button type="submit" onclick="
                        event.preventDefault(); 
                        // $('#{{ $viewFolder }}_docNotes').removeAttr('required');
                        // $('#{{ $viewFolder }}_docNotesSubject').removeAttr('required');
                        // $('#{{ $viewFolder }}_assessment').removeAttr('required');
                        // $('#{{ $viewFolder }}_plan').removeAttr('required');
                        // $('#{{ $viewFolder }}_planMed').removeAttr('required');
                        // $('#{{ $viewFolder }}_planRem').removeAttr('required');
                        // // $('#{{ $viewFolder }}_findings').removeAttr('required');
                        // $('#{{ $viewFolder }}_diagnosis').removeAttr('required');
                        // $('#{{ $viewFolder }}_recommendations').removeAttr('required');
                        $('#{{ $viewFolder }}_submit_type').val('Pause');
                        $('#{{ $formId }}').submit();
                        " class="btn btn-{{ $bgColor }}">Pause</button>
                    {{-- @if(isset($datum->consultation_referals[0]->id)) --}}
                    <button type="submit" onclick="
                        // event.preventDefault();
                        // $('#{{ $viewFolder }}_docNotes').attr('required');
                        // $('#{{ $viewFolder }}_docNotesSubject').attr('required', true);
                        // $('#{{ $viewFolder }}_assessment').attr('required', true);
                        // $('#{{ $viewFolder }}_plan').attr('required', true);
                        // $('#{{ $viewFolder }}_planMed').attr('required', true);
                        // $('#{{ $viewFolder }}_planRem').attr('required', true);
                        // $('#{{ $viewFolder }}_findings').attr('required', true);
                        // $('#{{ $viewFolder }}_diagnosis').attr('required', true);
                        // $('#{{ $viewFolder }}_recommendations').attr('required', true)
                        // $('#{{ $formId }}').submit();
                        $('#{{ $viewFolder }}_submit_type').val('');
                        " class="btn btn-danger">End</button>
                    {{-- @endif --}}
                @else
                    <button type="submit" id="submitButton" class="btn btn-{{ $bgColor }}">Submit</button>
                @endif
                    <button type="button" class="btn btn-{{ $bgColor }} modalForm-close" data-bs-dismiss="modal">Close</button>
                </div> 
        
            </div>
        </div>
    </div>
</form>

<!-- Optional: Place to the bottom of scripts -->
<script>
    const myModal = new bootstrap.Modal(('#inputFormModal'), {
    });
    @if($datum->id != null || $errors->any() || isset($modal))
    myModal.show();
    @endempty
    const myModalActive = document.querySelector('#inputFormModal')

    myModalActive.addEventListener("hidden.bs.modal", function () {
        @if($viewFolder == "doctors_home" && !stristr($inputFormHeader, 'View'))
        $('#doctors_home_submit_type').val('Pause');
        $.ajax({
            type: 'POST',
            data: $('#bookMod').serialize(),
            url: '{{ Route::has($viewFolder . '.' . $formAction) ? route($viewFolder . '.' . $formAction, $datum->id) : ''}}',
            success:
                function (){
                    window.location = "{!! isset($referer) ? $referer : route($viewFolder . '.index') !!}";
                }
        });
        @else
        window.location = "{!! isset($referer) ? $referer : route($viewFolder . '.index') !!}";
        @endif
    });
    
    @if(stristr($inputFormHeader, 'View'))
    $(function(){
        $(".form-floating input").attr("disabled", true);
        $(".form-floating textarea").attr("disabled", true);
        $(".form-floating select").attr("disabled", true);
        $(".form-floating button").attr("disabled", true);
        $(".modal-body div.card-header a").addClass("disabled");
        $(".modal-body div.card-footer a").addClass("disabled");
        $(".modal-body input").attr("disabled", true);
        $(".modal-body textarea").attr("disabled", true);
        $(".modal-body select").attr("disabled", true);
        $(".modal-body button").attr("disabled", true);
        $(".modal-footer button").attr("disabled", true);
        $(".form-floating a").addClass("disabled");
        $(".modalForm-close").attr("disabled", false);
        $("#carouselPrev button").attr("disabled", false);
    });
    @endif

    
</script>