<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Artemis</title>

        <!-- Styles -->
        <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
        <style>
                /* Made with love by Mutiullah Samim*/

                .container{
                height: 100%;
                align-content: center;
                }

                .card{
                margin-top: auto;
                margin-bottom: auto;
                }

                .card-header h3{
                color: white;
                }
            }

        </style>
    </head>
    <body style="background-color: #EEF5F9">
        <div class="loader_bg">
            <div class="loader"></div>
        </div>
        <div id="layout-wrapper">
            <div class="main-content">
                <div class="page-content">    
                    <div class="container-fluid">
                        <div class="account-pages">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8 col-lg-6 col-xl-5">
                                        <div class="card overflow-hidden" style="margin-top: 10vh;">
                                            <div style="background-color: #2e3047">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="p-4 d-block text-center">
                                                            <h5 class="text-white text-center">Artemis</h5>
                                                            <img src="assets/images/favicon.png" alt="" class="rounded-circle" height="50">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body"> 
                                                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="username">Usuario</label>
                                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" @if(old('email')) value="{{ old('email') }}" @else style="border-color: ##64B5F6 !important" value="admin@charmed.dev" @endif id="username" autofocus>
                                                        @error('email') <span class="invalid-feedback text-primary font-weight-medium" role="alert">{{ $message }}</span> @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="userpassword">Contraseña</label>
                                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" style="border-color: ##64B5F6 !important" id="userpassword" value="password">
                                                        @error('password') <span class="invalid-feedback text-primary font-weight-medium" role="alert">{{ $message }}</span> @enderror
                                                    </div>

                                                    <div class="mt-3">
                                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Login</button>
                                                    </div>

                                                    <hr>

                                                    <p>Usuario: admin@charmed.dev</p>
                                                    <p>Contraseña: password</p>
                                                </form>
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
        
        <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>
    </body>
</html>


