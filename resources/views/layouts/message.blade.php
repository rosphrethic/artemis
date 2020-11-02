@if ($message = Session::get('message'))
    <div class="alert alert-primary fade show" role="alert">{{ $message }}</div>  
@endif
@if ($pemessage = Session::get('pemessage'))
    <div class="alert alert-primary fade show" role="alert">{{ $pemessage }}</div>  
@endif
@if ($errors->any())
    <div class="alert alert-primary fade show" role="alert">Hubo un error, verifique el contenido del formulario!</div>  
@endif