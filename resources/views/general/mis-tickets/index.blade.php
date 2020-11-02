@extends('layouts.app')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="row">
                <div class="col-lg-9">
                    @include('layouts.message')
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Mis tickets</h5>
                            <hr>

                            @foreach ($tickets_activos as $ticket_activo)
                                <div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p>Descripción</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p>{{ $ticket_activo->descripcion }}</p>
                                                </div>
                                            </div>
                                                                        
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p>Tipo</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p>{{ $ticket_activo->tipoticket->nombre }}</p>
                                                </div>
                                            </div>

                                                                        
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p>Prioridad</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    @switch($ticket_activo->prioridad)
                                                        @case('Baja')
                                                            <div class="mr-4 mb-2 mr-2 badge badge-pill badge-success">{{ $ticket_activo->prioridad }}</div>
                                                            @break

                                                        @case('Media')
                                                            <div class="mr-4 mb-2 mr-2 badge badge-pill badge-warning text-white">{{ $ticket_activo->prioridad }}</div>
                                                            @break

                                                        @case('Alta')
                                                            <div class="mr-4 mb-2 mr-2 badge badge-pill badge-danger text-white">{{ $ticket_activo->prioridad }}</div>
                                                            @break

                                                        @case('Emergencia')
                                                            <div class="mr-4 mb-2 mr-2 badge badge-pill badge-danger text-white">¡¡ {{ $ticket_activo->prioridad }} !!</div>
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
                                                    <p>{{ $ticket_activo->user->name }} {{ $ticket_activo->user->lastname }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p>Ticket ID</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p>{{ $ticket_activo->id }}</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p>Estado</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    @switch($ticket_activo->estado)
                                                        @case('Pendiente')
                                                            <div class="mr-4 mb-2 mr-2 badge badge-pill badge-warning text-white">{{ $ticket_activo->estado }}</div>
                                                        @break

                                                        @case('Activo')
                                                            <div class="mr-4 mb-2 mr-2 badge badge-pill badge-primary">{{ $ticket_activo->estado }}</div>
                                                            @break

                                                        @case('Anulado')
                                                            <div class="mr-4 mb-2 mr-2 badge badge-pill badge-secondary text-white">{{ $ticket_activo->estado }}</div>
                                                            @break

                                                        @case('Finalizado')
                                                            <div class="mr-4 mb-2 mr-2 badge badge-pill badge-success text-white">{{ $ticket_activo->estado }}</div>
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
                                                    <p>{{ $ticket_activo->created_at }}</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p>Actualizado el</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p>{{ $ticket_activo->updated_at }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($ticket_activo->estado == 'Activo')
                                        <hr style="margin-top: 0px !important;">

                                        <form action="/proyectos/{{ $ticket_activo->proyecto_id }}/tickets/{{ $ticket_activo->id }}/finalize" method="POST">
                                            @method('PATCH')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success float-right text-white"><i class="fa fa-check mr-2 mt-1"></i> Finalizar Ticket</button>
                                        </form>

                                        <a href="/proyectos/{{ $ticket_activo->proyecto_id }}/tickets/{{ $ticket_activo->id }}">
                                            <button type="submit" class="btn btn-sm btn-primary float-right mr-3 text-white"><i class="fa fa-eye mr-2 mt-1"></i> Ver Ticket</button>
                                        </a>
                                    @endif 
                                </div>
                                @break
                            @endforeach
                        </div>
                    </div>


                    @foreach ($tickets_activos as $ticket_activo)
                        @if ($loop->first) @continue @endif
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p>Descripción</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p>{{ $ticket_activo->descripcion }}</p>
                                                </div>
                                            </div>
                                                                        
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p>Tipo</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p>{{ $ticket_activo->tipoticket->nombre }}</p>
                                                </div>
                                            </div>

                                                                        
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p>Prioridad</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    @switch($ticket_activo->prioridad)
                                                        @case('Baja')
                                                            <div class="mr-4 mb-2 mr-2 badge badge-pill badge-success">{{ $ticket_activo->prioridad }}</div>
                                                            @break

                                                        @case('Media')
                                                            <div class="mr-4 mb-2 mr-2 badge badge-pill badge-warning text-white">{{ $ticket_activo->prioridad }}</div>
                                                            @break

                                                        @case('Alta')
                                                            <div class="mr-4 mb-2 mr-2 badge badge-pill badge-danger text-white">{{ $ticket_activo->prioridad }}</div>
                                                            @break

                                                        @case('Emergencia')
                                                            <div class="mr-4 mb-2 mr-2 badge badge-pill badge-danger text-white">¡¡ {{ $ticket_activo->prioridad }} !!</div>
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
                                                    <p>{{ $ticket_activo->user->name }} {{ $ticket_activo->user->lastname }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p>Ticket ID</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p>{{ $ticket_activo->id }}</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p>Estado</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    @switch($ticket_activo->estado)
                                                        @case('Pendiente')
                                                            <div class="mr-4 mb-2 mr-2 badge badge-pill badge-warning text-white">{{ $ticket_activo->estado }}</div>
                                                        @break

                                                        @case('Activo')
                                                            <div class="mr-4 mb-2 mr-2 badge badge-pill badge-primary">{{ $ticket_activo->estado }}</div>
                                                            @break

                                                        @case('Anulado')
                                                            <div class="mr-4 mb-2 mr-2 badge badge-pill badge-secondary text-white">{{ $ticket_activo->estado }}</div>
                                                            @break

                                                        @case('Finalizado')
                                                            <div class="mr-4 mb-2 mr-2 badge badge-pill badge-success text-white">{{ $ticket_activo->estado }}</div>
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
                                                    <p>{{ $ticket_activo->created_at }}</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p>Actualizado el</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p>{{ $ticket_activo->updated_at }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($ticket_activo->estado == 'Activo')
                                        <hr style="margin-top: 0px !important;">

                                        <form action="/proyectos/{{ $ticket_activo->proyecto_id }}/tickets/{{ $ticket_activo->id }}/finalize" method="POST">
                                            @method('PATCH')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success float-right text-white"><i class="fa fa-check mr-2 mt-1"></i> Finalizar Ticket</button>
                                        </form>

                                        <a href="/proyectos/{{ $ticket_activo->proyecto_id }}/tickets/{{ $ticket_activo->id }}">
                                            <button type="submit" class="btn btn-sm btn-primary float-right mr-3 text-white"><i class="fa fa-eye mr-2 mt-1"></i> Ver Ticket</button>
                                        </a>
                                    @endif 
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-12">                            
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <h5 class="card-title">Historial</h5>
                                    <hr>

                                    <div class="scroll-area-lg" style="height: 876px;">
                                        <div class="scrollbar-container">
                                            <ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">
                                            
                                            @foreach ($tickets_finalizados as $ticket_finalizado)
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-right">
                                                                <div class="participante-text font-weight-bold float-right">Ticket ID {{ $ticket_finalizado->id }}
                                                                </div>
                                                                <br>
                                                                <div class="participante-text float-right mb-1">{{ $ticket_finalizado->tipoticket->nombre }}</div>
                                                                <br>
                                                                <div class="participante-text float-right mb-1">Finalizado el {{ $ticket_finalizado->updated_at }}</div>
                                                                <br>
                                                                <div class="participante-text float-right mb-2"><a href="/proyectos/{{ $ticket_finalizado->proyecto_id }}/tickets/{{ $ticket_finalizado->id }}"><small>Ver ticket</small></a></div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div>
</div>
            </div>
        </div>
    </div>
@endsection
