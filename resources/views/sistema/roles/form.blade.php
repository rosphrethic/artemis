@extends('layouts.app')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            @if (Auth::user()->rol_id == 1)
                                <h5 class="card-title">Roles <small class="text-primary ml-2">Sistema / Roles</small></h5>
                                <hr>
                                @empty($rol) <form action="/roles/store" method="POST" autocomplete="off" class="mt-4"> @endempty
                                @isset($rol) <form action="/roles/update/{{ $rol->id }}" method="POST" autocomplete="off" class="mt-4"> @method('PATCH') @endisset
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-md-2">Nombre</label>
                                        <div class="col-md-10">
                                            <input name="nombre" class="form-control {{($errors->first('nombre') ? 'is-invalid' : '')}}" type="text" value="{{ $rol->nombre ?? old('nombre') }}" autofocus>
                                            @error('nombre')<span class="text-primary font-size-12" role="alert">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary float-right mt-1"><i class="fa fa-check ml-1 mr-2"></i> Guardar Rol</button>
                                    <a href="/roles" class="btn btn-primary float-left mt-1">Regresar</a>
                                </form>
                            @else 
                                <p>Ésta página solo está disponible para Administradores</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
