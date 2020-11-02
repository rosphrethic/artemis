@extends('layouts.app')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="row">
                <div class="col-lg-12">
                    @include('layouts.message')
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            @if (Auth::user()->rol_id == 1)
                                <a href="/tipos-tickets/create">
                                    <button class="btn btn-xs btn-index-fix btn-primary float-right"><i class="fa fa-plus mr-2 mt-1"></i> Agregar Tipo de Ticket</button>
                                </a>
                                <h5 class="card-title"> Tipos de Tickets <small class="text-primary ml-3">Sistema / Tipos de Tickets</small></h5>
                                <hr>

                                <table id="table_id" class="table table-hover responsive text-nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="100">ID</th>
                                            <th>Nombre</th>
                                            <th width="100">Estado</th>
                                            <th width="100">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tipos_tickets as $tipo_ticket)
                                            <tr>
                                                <td>{{ $tipo_ticket->id }}</td>
                                                <td>{{ $tipo_ticket->nombre }}</td>
                                                <td>{{ $tipo_ticket->estado }}</td>
                                                <td class="text-center">
                                                    <div class="row justify-content-end">
                                                    <div class="2"></div>
                                                            <a class="col-4 mr-2 text-warning" href="/tipos-tickets/edit/{{ $tipo_ticket->id }}"><i class="fa fa-edit align-middle"></i></a>
                                                            <a class="col-4 mr-2 text-danger" href="#" onclick="event.preventDefault(); document.getElementById('delete-form{{ $tipo_ticket->id }}').submit();"><i class="fa fa-trash align-middle"></i></a>
                                                            <form id="delete-form{{ $tipo_ticket->id }}" action="/tipos-tickets/delete/{{ $tipo_ticket->id }}" method="POST" onsubmit="return confirm('¿Está seguro de que desea eliminar este tipo de ticket?');">@method('DELETE') @csrf</form>
                                                        <div class="2"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
