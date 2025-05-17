<div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="searchPane" aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="staticBackdropLabel">Search Pane</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="{{ route($viewFolder . '.index') }}" method="GET">
            @include($viewFolder . '.search')
            
            <div class="btn-group" role="group">
                <button type="submit" class="btn btn-{{ $bgColor }}">Search</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>
</div>