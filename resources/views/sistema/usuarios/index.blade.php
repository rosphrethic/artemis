
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
                                    <a href="/usuarios/create">
                                        <button class="btn btn-xs btn-index-fix btn-primary float-right" style=""><i class="fa fa-plus mr-2 mt-1"></i> Agregar Usuario</button>
                                    </a>

                                    <h5 class="card-title"> Usuarios <small class="text-primary ml-3">Sistema / Usuarios</small></h5>

                                    <hr>

                                    <table id="table_id" class="table table-hover responsive text-nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="80">ID</th>
                                                <th>Rol</th>
                                                <th>Nombre y apellido</th>
                                                <th>Correo electrónico</th>
                                                <th width="120">Estado</th>
                                                <th width="120">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($usuarios as $usuario)
                                                <tr>
                                                    <td>{{ $usuario->id }}</td>
                                                    <td>{{ $usuario->rol->nombre ?? ''}}</td>
                                                    <td>{{ $usuario->name }} {{ $usuario->lastname }}</td>
                                                    <td>{{ $usuario->email }}</td>
                                                    <td>{{ $usuario->status }}</td>
                                                    <td class="text-center">
                                                        <div class="row justify-content-end">
                                                            <div class="2"></div>
                                                            @if($usuario->status == 'Activo')
                                                                <a class="col-3 mr-2 text-warning" href="/usuarios/edit/{{ $usuario->id }}"><i class="fa fa-edit align-middle"></i></a>
                                                                
                                                                <a class="col-3 mr-2 text-secondary" href="#" onclick="event.preventDefault(); document.getElementById('deactivate-form{{ $usuario->id }}').submit();"><i class="fa fa-ban align-middle"></i></a>
                                                                <form id="deactivate-form{{ $usuario->id }}" action="/usuarios/deactivate/{{ $usuario->id }}" method="POST" onsubmit="return confirm('¿Está seguro de que desea desactivar a este usuario?');">@method('PATCH') @csrf</form>
                                                                
                                                                <a class="col-3 mr-2 text-danger" href="#" onclick="event.preventDefault(); document.getElementById('delete-form{{ $usuario->id }}').submit();"><i class="fa fa-trash align-middle"></i></a>
                                                                <form id="delete-form{{ $usuario->id }}" action="/usuarios/delete/{{ $usuario->id }}" method="POST" onsubmit="return confirm('¿Está seguro de que desea eliminar este usuario?');">@method('DELETE') @csrf</form>
                                                            @elseif ($usuario->status == 'Inactivo')
                                                                <a class="col-3 mr-2 text-success" href="#" onclick="event.preventDefault(); document.getElementById('reactivate-form{{ $usuario->id }}').submit();"><i class="fa fa-redo align-middle"></i></a>
                                                                <form id="reactivate-form{{ $usuario->id }}" action="/usuarios/reactivate/{{ $usuario->id }}" method="POST" onsubmit="return confirm('¿Está seguro de que desea reactivar a este usuario?');">@method('PATCH') @csrf</form>
                                                            @endif
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