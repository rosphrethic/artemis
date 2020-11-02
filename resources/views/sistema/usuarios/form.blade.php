@extends('layouts.app')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            @if (Auth::user()->rol_id == 1)
                                <h5 class="card-title">Usuarios <small class="text-primary ml-2">Sistema / Usuarios</small></h5>
                                <hr>
                                @empty($user) <form action="/usuarios/store" method="POST" autocomplete="off" class="mt-4"> @endempty
                                @isset($user) <form action="/usuarios/update/{{ $user->id}}" method="POST" autocomplete="off" class="mt-4"> @method('PATCH') @endisset
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-md-2">Nombre</label>
                                        <div class="col-md-10">
                                            <input name="nombre" class="form-control {{($errors->first('nombre') ? 'is-invalid' : '')}}" type="text" value="{{ $user->name ?? old('nombre') }}" autofocus>
                                            @error('nombre')<span class="text-primary font-size-12" role="alert">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">Apellido</label>
                                        <div class="col-md-10">
                                            <input name="apellido" class="form-control {{($errors->first('apellido') ? 'is-invalid' : '')}}" type="text" value="{{ $user->lastname ?? old('apellido') }}">
                                            @error('apellido')<span class="text-primary font-size-12" role="alert">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">Correo electrónico</label>
                                        <div class="col-md-10">
                                            <input name="email" class="form-control {{($errors->first('email') ? 'is-invalid' : '')}}" type="text" value="{{ $user->email ?? old('email') }}">
                                            @error('email')<span class="text-primary font-size-12" role="alert">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2">Rol</label>
                                        <div class="col-md-10">
                                            <select name="rol_id" id="rol_id" class="form-control select-fix">
                                                @empty($user) <option value="">Seleccione un rol</option> @endempty
                                                @isset($user) <option value="{{ $user->rol_id }}">ACTUAL: {{ $user->rol->nombre }}</option> @endisset
                                                @foreach($roles as $rol) <option value="{{ $rol->id }}">{{ $rol->nombre }}</option> @endforeach
                                            </select>
                                            @error('rol')<span class="text-primary font-size-12" role="alert">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    @empty($user)
                                        <div class="form-group row">
                                            <label class="col-md-2">Contraseña</label>
                                            <div class="col-md-10">
                                                <input name="password" class="form-control {{($errors->first('password') ? 'is-invalid' : '')}}" type="text" value="{{ old('password') }}">
                                                @error('password')<span class="text-primary font-size-12" role="alert">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    @endempty
                                    <hr>
                                    <button type="submit" class="btn btn-primary float-right mt-1"><i class="fa fa-check ml-1 mr-2"></i> Guardar Usuario</button>
                                    <a href="/usuarios" class="btn btn-primary float-left mt-1">Regresar</a>
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