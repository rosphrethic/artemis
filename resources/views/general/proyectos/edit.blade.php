@extends('layouts.app')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            @if (Auth::user()->rol_id == 1)
                                <h5 class="card-title">Proyectos <small class="text-primary ml-2">Sistema / Proyectos</small></h5>
                                <hr>

                                @if ($proyecto->estado == 'Finalizado')
                                    <p>Este registro se encuentra finalizado, no puede volver a editarlo.</p>
                                    <hr>
                                    <a href="/proyectos" class="btn btn-primary float-left mt-1">Regresar</a>
                                @elseif ($proyecto->estado == 'Anulado')
                                    <p>Este registro se encuentra anulado, no puede volver a editarlo.</p>
                                    <hr>
                                    <a href="/proyectos" class="btn btn-primary float-left mt-1">Regresar</a>
                                @else
                                    <form action="/proyectos/update/{{ $proyecto->id}}" method="POST" autocomplete="off" class="mt-4"> @method('PATCH')
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-md-2">Supervisor encargado</label>
                                            <div class="col-md-10">
                                                <select name="supervisor_id" id="supervisor_id" class="form-control select2" data-live-search="true">
                                                    <option value="{{ $supervisor_actual->id }}">{{ $supervisor_actual->rol->nombre }} {{ $supervisor_actual->name }} {{ $supervisor_actual->lastname }}</option>
                                                    @foreach ($usuarios as $usuario) <option value="{{ $usuario->id }}">{{ $usuario->rol->nombre }} {{ $usuario->name }} {{ $usuario->lastname }}</option> @endforeach
                                                </select>
                                                @error('supervisor_id')<span class="text-primary font-size-12" role="alert">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2">Nombre del proyecto</label>
                                            <div class="col-md-10">
                                                <input name="nombre" class="form-control {{($errors->first('nombre') ? 'is-invalid' : '')}}" type="text" value="{{ $proyecto->nombre ?? old('nombre') }}" autofocus>
                                                @error('nombre')<span class="text-primary font-size-12" role="alert">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2">Descripción del proyecto</label>
                                            <div class="col-md-10">
                                                <input name="descripcion" class="form-control {{($errors->first('descripcion') ? 'is-invalid' : '')}}" type="text" value="{{ $proyecto->descripcion ?? old('descripcion') }}">
                                                @error('descripcion')<span class="text-primary font-size-12" role="alert">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <hr>

                                        <button type="submit" class="btn btn-primary float-right mt-1"><i class="fa fa-check ml-1 mr-2"></i> Guardar Proyecto</button>
                                        <a href="/proyectos" class="btn btn-primary float-left mt-1">Regresar</a>
                                    </form>
                                @endif
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

