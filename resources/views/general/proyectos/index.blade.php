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
                                <a href="/proyectos/create">
                                    <button class="btn btn-xs btn-index-fix btn-primary float-right" style=""><i class="fa fa-plus mr-2 mt-1"></i> Agregar Proyecto</button>
                                </a>
                                <h5 class="card-title"> Proyectos <small class="text-primary ml-3">General / Proyectos</small></h5>
                                <hr>

                                <table id="table_id" class="table table-hover responsive" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="1">ID</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th width="100">Estado</th>
                                            <th width="120">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($proyectos as $proyecto)
                                            <tr>
                                                <td><a href="/proyectos/{{ $proyecto->id }}" class="table-link">{{ $proyecto->id }}</a></td>
                                                <td><a href="/proyectos/{{ $proyecto->id }}" class="table-link">{{ $proyecto->nombre }}</a></td>
                                                <td><a href="/proyectos/{{ $proyecto->id }}" class="table-link">{{ $proyecto->descripcion }}</a></td>
                                                <td><a href="/proyectos/{{ $proyecto->id }}" class="table-link">
                                                        @switch($proyecto->estado)
                                                            @case('Activo')
                                                                <div class="mr-4 mb-2 mt-2 mr-2 badge badge-pill badge-primary">{{ $proyecto->estado }}</div>
                                                                @break

                                                            @case('Anulado')
                                                                <div class="mr-4 mb-2 mt-2 mr-2 badge badge-pill badge-secondary text-white">{{ $proyecto->estado }}</div>
                                                                @break

                                                            @case('Finalizado')
                                                                <div class="mr-4 mb-2 mt-2 mr-2 badge badge-pill badge-success text-white">{{ $proyecto->estado }}</div>
                                                                @break
                                                            @default
                                                                <p>Error</p>
                                                        @endswitch      
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    @if ($proyecto->estado == 'Activo')
                                                        <div class="row justify-content-end">
                                                            <div class="2">
                                                                <form action="/proyectos/edit/{{ $proyecto->id }}">
                                                                    <button type="submit" class="btn no-btn"><i class="fa fa-edit align-middle text-warning"></i></button>
                                                                </form>
                                                            </div>

                                                            <div class="2">
                                                                <form action="/proyectos/finalize/{{ $proyecto->id }}" method="POST" onsubmit="return confirm('¿Está seguro de que desea finalizar este proyecto?');">
                                                                    @method('PATCH')
                                                                    @csrf
                                                                    <button type="submit" class="btn no-btn"><i class="fa fa-check align-middle text-success"></i></button>
                                                                </form>
                                                            </div>

                                                            <div class="2">
                                                                <form action="/proyectos/anull/{{ $proyecto->id }}" method="POST" onsubmit="return confirm('¿Está seguro de que desea anular este proyecto?');">
                                                                    @method('PATCH')
                                                                    @csrf
                                                                    <button type="submit" class="btn no-btn"><i class="fa fa-ban align-middle text-secondary"></i></button>
                                                                </form>
                                                            </div>

                                                            <div class="2">
                                                                <form action="/proyectos/delete/{{ $proyecto->id }}" method="POST" onsubmit="return confirm('¿Está seguro de que desea eliminar este proyecto?');">
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
