{{-- フラッシュメッセージ --}}
@if (session('success'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true" class="text-white">&times;</span>
    </button>
</div>
@elseif(session('danger'))
<div class="alert alert-danger">
    {{ session('danger') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true" class="text-white">&times;</span>
    </button>
</div>
@endif
