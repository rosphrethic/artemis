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

                                <a href="/roles/create">
                                    <button class="btn btn-xs btn-index-fix btn-primary float-right" style=""><i class="fa fa-plus mr-2 mt-1"></i> Agregar Roles</button>
                                </a>
                                <h5 class="card-title"> Roles <small class="text-primary ml-3">Sistema / Roles</small></h5>

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
                                        @foreach ($roles as $rol)
                                            <tr>
                                                <td>{{ $rol->id }}</td>
                                                <td>{{ $rol->nombre }}</td>
                                                <td>{{ $rol->estado }}</td>
                                                <td class="text-center">
                                                    <div class="row justify-content-end">
                                                    <div class="2"></div>
                                                            <a class="col-4 mr-2 text-warning" href="/roles/edit/{{ $rol->id }}"><i class="fa fa-edit align-middle"></i></a>
                                                            <a class="col-4 mr-2 text-danger" href="#" onclick="event.preventDefault(); document.getElementById('delete-form{{ $rol->id }}').submit();"><i class="fa fa-trash align-middle"></i></a>
                                                            <form id="delete-form{{ $rol->id }}" action="/roles/delete/{{ $rol->id }}" method="POST" onsubmit="return confirm('¿Está seguro de que desea eliminar este rol?');">@method('DELETE') @csrf</form>
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
