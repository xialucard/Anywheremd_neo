<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
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
                <div class="modal-body">
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
                    <button type="submit" class="btn btn-{{ $bgColor }}">Submit</button>
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
        window.location = "{{ route($viewFolder . '.index') }}";
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
    });
    @endif

    
</script>