<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" type="image/png" href="{{ asset('assets/favicon.png') }}"/>

        <!-- Styles -->
        <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

        <style>
            .text-primary {
                color: #3490dc !important;
            }

            .text-primary:hover {
                color: #45acff !important;
            }           
            
            td, th{
                border-right-width: 0 !important;
            }

            .table.table-bordered.dataTable {
                border-left-width: 0 !important;
            }

            .table th, .table td, .table{
                border: none !important;
            }

            .table td {
                padding-left: 19px !important;
            }

            .table th, .table td {
                border-bottom: #e6e6e6 solid 1px !important;
            }

            .paginate_button.current {
                background: white !important;
                border-color: #2e3047 !important;
            }

            .paginate_button.current, .dataTables_info {
                margin-top: 15px !important;
            }

            label {
                margin-top: 5px;
            }

            .bootstrap-select>.dropdown-toggle.bs-placeholder, 
            .bootstrap-select>.dropdown-toggle.bs-placeholder:active, 
            .bootstrap-select>.dropdown-toggle.bs-placeholder:focus, 
            .bootstrap-select>.dropdown-toggle.bs-placeholder:hover {
                color: #2e3047 !important;
                outline: 0px auto -webkit-focus-ring-color !important;
            }

            li > a, .metismenu-icon {
                color: #2e3047 !important;
            }       

            .app-header, .scrollbar-sidebar {
                background-color: white !important;
                color: white;
             }

             .widget-heading, .widget-subheading {
                 color: white;
                 opacity: 1;
             }

            .table-link {
                text-decoration: none;
                color: inherit; 
            }
            
            .table-link:hover {
                text-decoration: none;
            }

            .card-title {
                color: #495057 !important;
            }

            .btn-index-fix {
                margin-top: -9px;
            }
            .app-sidebar {
                width: 240px !important;
                min-width: 240px !important;
            }

            @media screen and (min-width: 1400px) {
                .fixed-sidebar .app-main .app-main__outer {
                    padding-left: 240px !important;
                }
            }


            .app-header {
                background-color: #2E3047 !important;
            }

            .select-fix {
                font-size: 14px !important;
            }
            .vertical-nav-menu i.metismenu-state-icon, .vertical-nav-menu i.metismenu-icon {
                opacity: 1 !important;
            }

            .participante-text {
                color: #2E3047 !important;
            }

            .no-btn {
                background: none !important;
                border: none !important;
            }

            .widget-text {
                color: #2E3047 !important;
            }
            .select2-container .select2-choice {
                display: block!important;
                height: 36px!important;
                white-space: nowrap!important;
                line-height: 26px!important;
            }

            .file-fix {
                height: 52px; 
                padding-top: 10px;
            }

            .circle-img {
                width: 250px;
                height: 250px;
                overflow: hidden;
            }

            .circle-img img {
                height: 100%;
                transform: translateX(-50%);
                margin-left: 50%;
            }
        </style>
    </head>
    <body>
        <div class="loader_bg">
            <div class="loader"></div>
        </div>
        <div id="wrapper">
            @include('layouts.nav') {{-- also includes @content --}}
        </div>
        
        <!-- JQuery & Datatablse -->
        <script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

        <script>
            $(document).ready( function () {
                $('#table_id').DataTable();
            } );

            $(".select2").select2({
                width: 'resolve', // need to override the changed default
                placeholder: "Seleccione una opción",
                allowClear: true
            });

            $(".select2e").select2({
                width: 'resolve', // need to override the changed default
                placeholder: "Seleccione una opción",
                allowClear: true
            });
        </script>
    </body>
</html>
