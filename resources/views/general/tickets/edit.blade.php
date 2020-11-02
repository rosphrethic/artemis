@extends('layouts.app')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Proyectos <small class="text-primary ml-2">Sistema / Proyectos</small></h5>
                            <hr>

                            @if (Auth::user()->rol_id == 1)

                                @if ($ticket->estado == 'Finalizado')
                                    <p>Este registro se encuentra finalizado, no puede volver a editarlo.</p>
                                    <hr>
                                    <a href="/proyectos/{{ $proyecto->id }}" class="btn btn-primary float-left mt-1">Regresar</a>
                                @elseif ($ticket->estado == 'Anulado')
                                    <p>Este registro se encuentra anulado, no puede volver a editarlo.</p>
                                    <hr>
                                    <a href="/proyectos/{{ $proyecto->id }}" class="btn btn-primary float-left mt-1">Regresar</a>
                                @else
                                    <form action="/proyectos/{{ $proyecto->id }}/tickets/{{ $ticket->id }}/update" method="POST" autocomplete="off" class="mt-4"> 
                                        @method('PATCH')
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-md-2">Descripción</label>
                                            <div class="col-md-10">
                                                <input name="descripcion" class="form-control {{($errors->first('descripcion') ? 'is-invalid' : '')}}" type="text" value="{{ $proyecto->descripcion ?? old('descripcion') }}">
                                                @error('descripcion')<span class="text-primary font-size-12" role="alert">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2">Tipo</label>
                                            <div class="col-md-10">
                                                <select name="tipo_id" id="tipo_id" class="form-control">
                                                    <option value="{{ $ticket->tipo_id }}">Actual: {{ $ticket->tipoticket->nombre }}</option>
                                                    @foreach ($tipos_tickets as $tipo_ticket)
                                                        <option value="{{ $tipo_ticket->id }}">{{ $tipo_ticket->nombre }}</option>
                                                    @endforeach
                                                </select>
                                                @error('tipo_id')<span class="text-primary font-size-12" role="alert">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2">Prioridad</label>
                                            <div class="col-md-10">
                                                <select name="prioridad" id="prioridad" class="form-control">
                                                    <option value="{{ $ticket->prioridad }}" >{{ $ticket->prioridad }}</option>
                                                    <option value="Baja">Baja</option>
                                                    <option value="Media">Media</option>
                                                    <option value="Alta">Alta</option>
                                                    <option value="Emergencia">Emergencia</option>
                                                </select>
                                                @error('prioridad')<span class="text-primary font-size-12" role="alert">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        
                                        <hr>

                                        <button type="submit" class="btn btn-primary float-right mt-1"><i class="fa fa-check ml-1 mr-2"></i> Guardar Ticket</button>
                                        <a href="/proyectos/{{ $proyecto->id }}" class="btn btn-primary float-left mt-1">Regresar</a>
                                    </form>
                                @endif
                            @else 
                                <p>Ésta página solo está disponible para Administradores.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

