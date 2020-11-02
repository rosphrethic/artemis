@extends('layouts.app')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="row">
            <div class="col-lg-9">
                    @include('layouts.message')
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Mi Perfil</h5>
                            <hr>
                            <div class="row">
                                <div class="col-12 col-lg-4 px-5 py-4">
                                    <img src="{{ asset('storage/' . $user->imagen) }}" alt="foto de perfil" width="200" height="200" class="ml-3 mt-2 rounded-circle shadow">
                                </div>
                                <div class="col-12 col-lg-8 mt-3">
                                    <div class="row">
                                            <div class="col-sm-3">
                                                <p>Nombre</p>
                                            </div>
                                            <div class="col-sm-9">
                                            <p>{{ $user->name }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p>Apellido</p>
                                            </div>
                                            <div class="col-sm-9">
                                            <p>{{ $user->lastname }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p>Rol</p>
                                            </div>
                                            <div class="col-sm-9">
                                            <p>{{ $user->rol->nombre }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p>Correo</p>
                                            </div>
                                            <div class="col-sm-9">
                                            <p>{{ $user->email }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p>Estado</p>
                                            </div>
                                            <div class="col-sm-9">
                                            <p>{{ $user->status }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p>Usuario desde</p>
                                            </div>
                                            <div class="col-sm-9">
                                            <p>{{ $user->created_at }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p>Imágen</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <form action="/{{ $user->id }}/update" method="POST" enctype="multipart/form-data"> 
                                                    @method('PATCH') 
                                                    @csrf
                                                    <input type="file" name="imagen" id="imagen" class="file-fixform-conrol {{($errors->first('imagen') ? 'is-invalid' : '')}}">
                                                    @error('imagen')<span class="text-primary font-size-12" role="alert">{{ $message }}</span> @enderror
                                                    <hr>
                                                    <button type="submit" class="btn btn-primary float-right mt-1"><i class="fa fa-check ml-1 mr-2"></i> Actualizar Perfil</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div>
                    <div class="col-lg-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="main-card card" style="margin-bottom: 20px">
                                    <div class="card-body" style="margin-bottom: -10px;">
                                        <h5 class="card-title">Resumen de Datos</h5>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card widget-content py-4">
                            <div class="widget-content-outer">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="widget-heading widget-text">Proyectos colaborados</div>
                                        <div class="widget-subheading widget-text">Total de colaboraciones</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-success">{{ $proyectos_colaborados }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <br>

                        <div class="card widget-content py-4">
                            <div class="widget-content-outer">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="widget-heading widget-text">Tickets finalizados</div>
                                        <div class="widget-subheading widget-text">Total de tickets entregados</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-warning">{{ $tickets_finalizados }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="card widget-content py-4">
                            <div class="widget-content-outer">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="widget-heading widget-text">Comentarios realizados</div>
                                        <div class="widget-subheading widget-text">Total de comentarios hechos</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-danger">{{ $comentarios_realizados }}</div>
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
