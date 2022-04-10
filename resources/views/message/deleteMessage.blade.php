<!-- Se reciben los mensajes del backend para la informacion del usuario -->
@if($message = Session::get('danger')) 
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif