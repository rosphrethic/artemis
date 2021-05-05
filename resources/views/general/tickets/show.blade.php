@extends('layouts.app')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="row">
                <div class="col-lg-9">
                    @include('layouts.message')
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Detalles del Ticket #{{ $ticket->id }} del proyecto {{ $ticket->proyecto->nombre }}</h5>
                            <hr>

                            @if (Auth::user()->rol_id == 1 || Auth::user()->user_id == $ticket->asignado_a)
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p>Descripción</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p>{{ $ticket->descripcion }}</p>
                                            </div>
                                        </div>
                                                                    
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p>Tipo</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p>{{ $ticket->tipoticket->nombre }}</p>
                                            </div>
                                        </div>

                                                                    
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p>Prioridad</p>
                                            </div>
                                            <div class="col-sm-9">
                                                @switch($ticket->prioridad)
                                                    @case('Baja')
                                                        <div class="mr-4 mb-2 mr-2 badge badge-pill badge-success">{{ $ticket->prioridad }}</div>
                                                        @break

                                                    @case('Media')
                                                        <div class="mr-4 mb-2 mr-2 badge badge-pill badge-warning text-white">{{ $ticket->prioridad }}</div>
                                                        @break

                                                    @case('Alta')
                                                        <div class="mr-4 mb-2 mr-2 badge badge-pill badge-danger text-white">{{ $ticket->prioridad }}</div>
                                                        @break

                                                    @case('Emergencia')
                                                        <div class="mr-4 mb-2 mr-2 badge badge-pill badge-danger text-white">¡¡ {{ $ticket->prioridad }} !!</div>
                                                        @break

                                                    @default
                                                        <p>Error</p>
                                                @endswitch
                                            </div>
                                        </div>
                                                                    
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p>Emitido por</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p>{{ $ticket->user->name }} {{ $ticket->user->lastname }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p>Asignado a</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p>{{ $ticket->asignadoa->name ?? ''}} {{ $ticket->asignadoa->lastname ?? ''}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p>Estado</p>
                                            </div>
                                            <div class="col-sm-9">
                                                @switch($ticket->estado)
                                                    @case('Pendiente')
                                                        <div class="mr-4 mb-2 mr-2 badge badge-pill badge-warning text-white">{{ $ticket->estado }}</div>
                                                    @break

                                                    @case('Activo')
                                                        <div class="mr-4 mb-2 mr-2 badge badge-pill badge-primary">{{ $ticket->estado }}</div>
                                                        @break

                                                    @case('Anulado')
                                                        <div class="mr-4 mb-2 mr-2 badge badge-pill badge-secondary text-white">{{ $ticket->estado }}</div>
                                                        @break

                                                    @case('Finalizado')
                                                        <div class="mr-4 mb-2 mr-2 badge badge-pill badge-success text-white">{{ $ticket->estado }}</div>
                                                        @break
                                                    @default
                                                        <p>Error</p>
                                                @endswitch
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p>Creado el</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p>{{ $ticket->created_at }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p>Actualizado&nbsp;el</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p>{{ $ticket->updated_at }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if ($ticket->estado == 'Activo')
                                    <hr style="margin-top: 0px !important;">

                                    @if (Auth::user()->rol_id == 1)
                                        <form action="/proyectos/{{ $proyecto }}/tickets/{{ $ticket->id }}/delete" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger float-right text-white"><i class="fa fa-edit mr-2 mt-1"></i> Eliminar Ticket</button>
                                        </form>

                                        <form action="/proyectos/{{ $proyecto }}/tickets/{{ $ticket->id }}/anull" method="POST">
                                            @method('PATCH')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-secondary float-right mr-3 text-white"><i class="fa fa-ban mr-2 mt-1"></i> Anular Ticket</button>
                                        </form>
                                    @endif

                                    <form action="/proyectos/{{ $proyecto }}/tickets/{{ $ticket->id }}/finalize" method="POST">
                                        @method('PATCH')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success float-right @if (Auth::user()->rol_id == 1) mr-3 @endif text-white"><i class="fa fa-check mr-2 mt-1"></i> Finalizar Ticket</button>
                                    </form>

                                    @if (Auth::user()->rol_id == 1)
                                        @if ($ticket->asignado_a != null)
                                            <form action="/proyectos/{{ $proyecto }}/tickets/{{ $ticket->id }}/unassign" method="POST">
                                                @method('PATCH')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-alternate float-right mr-3 text-white"><i class="fa fa-redo mr-2 mt-1"></i> Desasignar Ticket</button>
                                            </form>
                                        @endif
                                    @endif

                                    @if (Auth::user()->rol_id == 1)
                                        <a href="/proyectos/{{ $proyecto }}/tickets/{{ $ticket->id }}/edit">
                                            <button type="submit" class="btn btn-sm btn-warning float-right mr-3 text-white"><i class="fa fa-edit mr-2 mt-1"></i> Editar Ticket</button>
                                        </a>
                                    @endif
                                @endif     
                            </div>
                        </div>

                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Comentarios</h5>
                                <hr>

                                <div class="scroll-area-md">
                                    <div class="scrollbar-container">
                                        <ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">
                                            @foreach ($comentarios as $keys => $comentario)
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            @if(Auth::user()->id == $comentario->user_id) 
                                                                <div class="widget-content-right" style="max-width: 50%; width: 50% !important;">
                                                                    <div class="participante-text font-weight-bold">Tú <small>({{ $comentario->created_at }})</small></div>
                                                                    <div class="participante-text">{{ $comentario->mensaje }}</div>
                                                                    @if ($comentario->archivo)
                                                                        <div class="participante-text mb-1 float-left">
                                                                            <a href="{{ asset('storage/' . $comentario->archivo) }}" target="_blank"><small>Ver archivo adjunto</small></a>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @else
                                                                <div class="widget-content-left" style="max-width: 50%; width: 50% !importnat;">
                                                                    <div class="participante-text font-weight-bold">{{ $comentario->user->name }} {{ $comentario->user->lastname }} <small>({{ $comentario->created_at }})</small></div>
                                                                    <div class="participante-text float-left">{{ $comentario->mensaje }}</div>
                                                                    <br>
                                                                    @if ($comentario->archivo)
                                                                        <div class="participante-text mb-1">
                                                                            <a href="{{ asset('storage/' . $comentario->archivo) }}" target="_blank"><small>Ver archivo adjunto</small></a>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                @if ($ticket->estado == 'Activo')
                                    <hr class="mb-4">

                                    <form action="/proyectos/{{ $proyecto }}/tickets/{{ $ticket->id }}/comment" method="POST" autocomplete="off" class="mt-4" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                        <input type="hidden" name="proyecto_id" value="{{ $proyecto }}">
                                        
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <textarea name="mensaje" id="mensaje" cols="30" rows="2" class="form-control" placeholder="Escriba su comentario..."></textarea>
                                                @error('mensaje')<span class="text-primary font-size-12" role="alert">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <input type="file" name="archivo" id="archivo" class="form-control file-fix">
                                        <hr class="mt-4 mb-4">

                                        <button type="submit" class="btn btn-xs btn-primary float-right mt-"><i class="fa fa-comment mr-2 mt-1"></i> Comentar</button>
                                    </form>  
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="row">
                            <div class="col-12">                            
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">Archivos subidos</h5>
                                        <hr>

                                        <div class="scroll-area-lg" style="height: 876px;">
                                            <div class="scrollbar-container">
                                                <ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">
                                                
                                                @foreach ($comentarios as $comentario)
                                                    @if ($comentario->archivo)
                                                        <li class="list-group-item">
                                                            <div class="widget-content p-0">
                                                                <div class="widget-content-wrapper">
                                                                    <div class="widget-content-right">
                                                                        @if(Auth::user()->id == $comentario->user_id) 
                                                                            <div class="participante-text font-weight-bold float-right">Tú</div>
                                                                        @else
                                                                            <div class="participante-text font-weight-bold float-right">{{ $comentario->user->name }} {{ $comentario->user->lastname }}</div>
                                                                        @endif
                                                                        <br>
                                                                        <div class="participante-text float-right mb-2"><small>({{ $comentario->created_at }})</small></div>
                                                                        <div class="participante-text mb-4">
                                                                            <a href="{{ asset('storage/' . $comentario->archivo) }}" target="_blank">
                                                                                <img src="{{ asset('storage/' . $comentario->archivo) }}" alt="" class="float-right mb-4" width="100%"/>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

