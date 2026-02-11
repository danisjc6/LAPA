@if(session('success'))
    <div class="alert alert-success d-flex justify-content-between align-items-center">
        <span class="mx-auto">{{ session('success') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger d-flex justify-content-between align-items-center">
        <span class="mx-auto">{{ session('error') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
