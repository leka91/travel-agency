@if (session('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <strong>Warning!</strong> {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif