@extends('layouts.app')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="row">
                <div class="col-lg-9">
                @include('layouts.message')
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            @if (Auth::user()->rol_id == 1)
                                <h5 class="card-title">Detalles del proyecto {{ $proyecto->nombre }}</h5>
                                <hr>

                                <div class="row">
                                    <div class="col-sm-2">
                                        <p>Descripción</p>
                                    </div>
                                    <div class="col-sm-10">
                                        <p>{{ $proyecto->descripcion }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-2">
                                        <p>Participantes</p>
                                    </div>
                                    <div class="col-sm-10">
                                        <p>{{ count($participantes) }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-2">
                                        <p>Supervisor</p>
                                    </div>
                                    <div class="col-sm-10">
                                    <p>{{ $supervisor_asignado->name }} {{ $supervisor_asignado->lastname }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-2">
                                        <p>Contacto</p>
                                    </div>
                                    <div class="col-sm-10">
                                    <p>{{ $supervisor_asignado->email }}</p>
                                    </div>
                                </div>
                                
                                @if ($proyecto->estado == 'Activo')

                                    <hr style="margin-top: 0px !important;">

                                    <form action="/proyectos/delete/{{ $proyecto->id }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger float-right text-white"><i class="fa fa-edit mr-2 mt-1"></i> Eliminar Proyecto</button>
                                    </form>

                                    <form action="/proyectos/anull/{{ $proyecto->id }}" method="POST">
                                        @method('PATCH')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-secondary float-right mr-3 text-white"><i class="fa fa-ban mr-2 mt-1"></i> Anular Proyecto</button>
                                    </form>

                                    <form action="/proyectos/finalize/{{ $proyecto->id }}" method="POST">
                                        @method('PATCH')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success float-right mr-3 text-white"><i class="fa fa-check mr-2 mt-1"></i> Finalizar Proyecto</button>
                                    </form>

                                    <a href="/proyectos/edit/{{ $proyecto->id }}">
                                        <button type="submit" class="btn btn-sm btn-warning float-right mr-3 text-white"><i class="fa fa-edit mr-2 mt-1"></i> Editar Proyecto</button>
                                    </a>
                                @endif
                            </div>
                        </div>
                
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Resumen estadístico de tickets</h5>
                                <hr>

                                <div class="row text-center">
                                    <div class="col-1"></div>
                                    <div class="col-6 col-lg-2">
                                        <p>Activos</p>
                                        <p>{{ $tickets_activos }}</p>
                                    </div>
                                    <div class="col-6 col-lg-2">
                                        <p>Pendientes</p>
                                        <p>{{ $tickets_pendientes }}</p>
                                    </div>
                                    <div class="col-6 col-lg-2">
                                        <p>Finalizados</p>
                                        <p>{{ $tickets_finalizados }}</p>
                                    </div>
                                    <div class="col-6 col-lg-2">
                                        <p>Anulados</p>
                                        <p>{{ $tickets_anulados }}</p>
                                    </div>
                                    <div class="col-6 col-lg-2">
                                        <p>Total</p>
                                        <p>{{ $tickets_total }}</p>
                                    </div>
                                </div>

                                <div class="progress">
                                    <div class="progress-bar progress-bar-animated progress-bar-striped bg-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{ $tickets_activos_porcentaje }}%;">{{ round($tickets_activos_porcentaje) }}% activo</div>
                                    <div class="progress-bar progress-bar-animated progress-bar-striped bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{ $tickets_pendientes_porcentaje }}%;">{{ round($tickets_pendientes_porcentaje) }}% pendiente</div>
                                    <div class="progress-bar progress-bar-animated progress-bar-striped bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{ $tickets_finalizados_porcentaje }}%;">{{ round($tickets_finalizados_porcentaje) }}% finalizado</div>
                                    <div class="progress-bar progress-bar-animated progress-bar-striped bg-secondary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{ $tickets_anulados_porcentaje }}%;">{{ round($tickets_anulados_porcentaje) }}% anulado</div>
                                </div>
                            </div>
                        </div>

                        @if ($proyecto->estado == 'Activo')
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <h5 class="card-title">Agregar un nuevo ticket</h5>
                                    <hr>                            
                                    <form action="/proyectos/{{ $proyecto->id}}/create-ticket" method="POST" autocomplete="off" class="mt-4">
                                        @csrf
                                        <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">
                                        <div class="form-group row">
                                            <label class="col-md-2">Descripción</label>
                                            <div class="col-md-10">
                                                <input name="descripcion" class="form-control {{($errors->first('descripcion') ? 'is-invalid' : '')}}" type="text">
                                                @error('descripcion')<span class="text-primary font-size-12" role="alert">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2">Tipo</label>
                                            <div class="col-md-10">
                                                <select name="tipo_id" id="tipo_id" class="form-control select-fix">
                                                    <option hidden >Seleccione un tipo de ticket</option>
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
                                                <select name="prioridad" id="prioridad" class="form-control select-fix">
                                                    <option hidden >Seleccione un nivel de prioridad</option>
                                                    <option value="Baja">Baja</option>
                                                    <option value="Media">Media</option>
                                                    <option value="Alta">Alta</option>
                                                    <option value="Emergencia">Emergencia</option>
                                                </select>
                                                @error('prioridad')<span class="text-primary font-size-12" role="alert">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <hr class="mt-4 mb-4">

                                        <button type="submit" class="btn btn-xs btn-primary float-right"><i class="fa fa-plus mr-2 mt-1"></i> Agregar Ticket</button>
                                    </form>
                                </div>
                            </div>

                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <h5 class="card-title">Asignar ticket</h5>
                                    <hr>                            
                                    <form action="/proyectos/assign/{{ $proyecto->id}}" method="POST" autocomplete="off" class="mt-4">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">

                                        <div class="form-group row">
                                            <label class="col-md-2">Ticket</label>
                                            <div class="col-md-10">
                                                <select name="ticket_id" id="ticket_id" class="form-control select2">
                                                    @foreach ($tickets_para_asignar as $ticket_para_asignar)
                                                        <option value="{{ $ticket_para_asignar->id }}">Ticket ID {{ $ticket_para_asignar->id }} - {{ $ticket_para_asignar->tipoticket->nombre }} - Prioridad {{ $ticket_para_asignar->prioridad }} - {{ $ticket_para_asignar->descripcion }}</option>
                                                    @endforeach
                                                </select>
                                                @error('ticket_id')<span class="text-primary font-size-12" role="alert">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2">Participante</label>
                                            <div class="col-md-10">
                                                <select name="participante_id" id="participante_id" class="form-control select2e">
                                                    @foreach ($participantes as $participante)
                                                        <option value="{{ $participante->user->id }}">{{ $participante->user->name }} {{ $participante->user->lastname }}</option>
                                                    @endforeach
                                                </select>
                                                @error('participante_id')<span class="text-primary font-size-12" role="alert">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <hr class="mt-4 mb-4">

                                        <button type="submit" class="btn btn-xs btn-primary float-right mt-"><i class="fa fa-check mr-2 mt-1"></i> Asignar Ticket</button>
                                    </form>                     
                                </div>
                            </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">Ver tickets</h5>

                                        <hr class="mb-4">

                                        <table id="table_id" class="table table-hover responsive" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th width="1">#</th>
                                                    <th width="1">Prioridad</th>
                                                    <th width="1">Tipo</th>
                                                    <th>Emitido por</th>
                                                    <th>Asignado a</th>
                                                    <th width="1">Estado</th>
                                                    <th width="155">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tickets as $keys => $ticket)
                                                    <tr>
                                                        <td><a href="/proyectos/{{ $proyecto->id }}/tickets/{{ $ticket->id }}" class="table-link">{{ $keys+1 }}</a></td>
                                                        <td>
                                                            <a href="/proyectos/{{ $proyecto->id }}/tickets/{{ $ticket->id }}">
                                                                @switch($ticket->prioridad)
                                                                    @case('Baja')
                                                                        <div class="mb-2 mt-2 badge badge-pill badge-success">{{ $ticket->prioridad }}</div>
                                                                        @break

                                                                    @case('Media')
                                                                        <div class="mb-2 mt-2 badge badge-pill badge-warning text-white">{{ $ticket->prioridad }}</div>
                                                                        @break

                                                                    @case('Alta')
                                                                        <div class="mb-2 mt-2 badge badge-pill badge-danger text-white">{{ $ticket->prioridad }}</div>
                                                                        @break

                                                                    @case('Emergencia')
                                                                        <div class="mb-2 mt-2 badge badge-pill badge-danger text-white">¡¡ {{ $ticket->prioridad }} !!</div>
                                                                        @break

                                                                    @default
                                                                        <p>Error</p>
                                                                @endswitch
                                                                
                                                            </a>
                                                        </td>
                                                        <td><a href="/proyectos/{{ $proyecto->id }}/tickets/{{ $ticket->id }}" class="table-link">{{ $ticket->tipoticket->nombre }}</a></td>
                                                        <td><a href="/proyectos/{{ $proyecto->id }}/tickets/{{ $ticket->id }}" class="table-link">{{ $ticket->user->name }} {{ $ticket->user->lastname }}</a></td>
                                                        <td><a href="/proyectos/{{ $proyecto->id }}/tickets/{{ $ticket->id }}" class="table-link">{{ $ticket->asignadoa->name ?? ''}} {{ $ticket->asignadoa->lastname ?? ''}}</a></td>
                                                        <td><a href="/proyectos/{{ $proyecto->id }}/tickets/{{ $ticket->id }}" class="table-link">
                                                                @switch($ticket->estado)    
                                                                    @case('Pendiente')
                                                                        <div class="mr-4 mb-2 mt-2 mr-2 badge badge-pill badge-warning text-white">{{ $ticket->estado }}</div>
                                                                        @break

                                                                    @case('Activo')
                                                                        <div class="mr-4 mb-2 mt-2 mr-2 badge badge-pill badge-primary">{{ $ticket->estado }}</div>
                                                                        @break

                                                                    @case('Anulado')
                                                                        <div class="mr-4 mb-2 mt-2 mr-2 badge badge-pill badge-secondary text-white">{{ $ticket->estado }}</div>
                                                                        @break

                                                                    @case('Finalizado')
                                                                        <div class="mr-4 mb-2 mt-2 mr-2 badge badge-pill badge-success text-white">{{ $ticket->estado }}</div>
                                                                        @break
                                                                    @default
                                                                        <p>Error</p>
                                                                @endswitch     
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @if ($ticket->estado == 'Activo' || $ticket->estado == 'Pendiente')
                                                                <div class="row justify-content-end">
                                                                    <div class="2">
                                                                        <form action="/proyectos/{{ $proyecto->id }}/tickets/{{ $ticket->id }}/edit">
                                                                            <button type="submit" class="btn no-btn"><i class="fa fa-edit align-middle text-warning"></i></button>
                                                                        </form>
                                                                    </div>

                                                                    @if ($ticket->asignado_a != null)

                                                                        <div class="2">
                                                                            <form action="/proyectos/{{ $proyecto->id }}/tickets/{{ $ticket->id }}/unassign" method="POST" onsubmit="return confirm('¿Está seguro de que desea desasignar este ticket?');">
                                                                                @method('PATCH')
                                                                                @csrf
                                                                                <button type="submit" class="btn no-btn"><i class="fa fa-redo align-middle text-alternate"></i></button>
                                                                            </form>
                                                                        </div>
                                                                    
                                                                    @endif

                                                                    <div class="2">
                                                                        <form action="/proyectos/{{ $proyecto->id }}/tickets/{{ $ticket->id }}/finalize" method="POST" onsubmit="return confirm('¿Está seguro de que desea finalizar este ticket?');">
                                                                            @method('PATCH')
                                                                            @csrf
                                                                            <button type="submit" class="btn no-btn"><i class="fa fa-check align-middle text-success"></i></button>
                                                                        </form>
                                                                    </div>

                                                                    <div class="2">
                                                                        <form action="/proyectos/{{ $proyecto->id }}/tickets/{{ $ticket->id }}/anull" method="POST" onsubmit="return confirm('¿Está seguro de que desea anular este ticket?');">
                                                                            @method('PATCH')
                                                                            @csrf
                                                                            <button type="submit" class="btn no-btn"><i class="fa fa-ban align-middle text-secondary"></i></button>
                                                                        </form>
                                                                    </div>

                                                                    <div class="2">
                                                                        <form action="/proyectos/{{ $proyecto->id }}/tickets/{{ $ticket->id }}/delete" method="POST" onsubmit="return confirm('¿Está seguro de que desea eliminar este ticket?');">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <button type="submit" class="btn no-btn"><i class="fa fa-trash align-middle text-danger"></i></button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="col-lg-3">
                        <div class="row">
                            @if ($proyecto->estado == 'Activo')
                                <div class="col-12">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body">
                                            <h5 class="card-title">Agregar Participante</h5>

                                            <hr class="mb-4">

                                            <form action="/proyectos/add/{{ $proyecto->id}}" method="POST" autocomplete="off" class="mt-4">
                                                @csrf
                                                <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <select name="participante_id" id="participante_id" class="form-control select2e" title="Seleccione un participante" data-live-search="true">
                                                            @foreach ($participantes_filtrados as $usuario)
                                                                <option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->lastname }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('participante_id')<span class="text-primary font-size-12" role="alert">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <hr class="mt-4 mb-4">

                                                <button type="submit" class="btn btn-xs btn-primary float-right mt-"><i class="fa fa-check mr-2 mt-1"></i> Agregar Participante</button>
                                            </form>  
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="col-12">                            
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">Participantes</h5>
                                        <hr>

                                        <div class="scroll-area-lg">
                                            <div class="scrollbar-container">
                                                <ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">
                                                
                                                @foreach ($participantes as $participante)
                                                    <li class="list-group-item">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left">
                                                                    <div class="participante-text font-weight-bold">{{ $participante->user->name }} {{ $participante->user->lastname }}</div>
                                                                    <div class="participante-text mb-1">{{ $participante->user->email }}</div>
                                                                    <!-- <div class="mt-1 mr-2 badge badge-primary">&nbsp;&nbsp;3&nbsp;&nbsp;</div> -->
                                                                    <!-- <div class="mt-2 mr-2 badge badge-success">&nbsp;&nbsp;4&nbsp;&nbsp;</div> -->
                                                                    @if ($proyecto->estado == 'Activo')
                                                                        <a href="#" onclick="event.preventDefault(); document.getElementById('remove-form{{ $participante->participante_id }}').submit();">
                                                                            <div class="mb-2 mr-2 badge badge-danger">Remover</div>
                                                                            <form id="remove-form{{ $participante->participante_id }}" action="/proyectos/remove/{{ $proyecto->id }}" method="POST" onsubmit="return confirm('¿Está seguro de que desea remover a este participante del proyecto {{ $proyecto->nombre }}?');">
                                                                                @method('DELETE') 
                                                                                @csrf
                                                                                <input type="hidden" name="participante_id" value="{{ $participante->participante_id }}">
                                                                                <input type="hidden" name="actual_participante_id" value="{{ $participante->id }}">
                                                                                <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">
                                                                            </form>
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @else 
                                    <p>Ésta página solo está disponible para Administradores</p>
                                @endif
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

