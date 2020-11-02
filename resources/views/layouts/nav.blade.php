<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    <!-- Topbar -->
    <div class="app-header header-shadow">
        <div class="app-header__logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="" width="40">
            <a href="/">
                <h4 class="ml-3 mt-2 table-link text-white"><em>Artemis</em></h4>
            </a>
        </div>
        <div class="app-header__mobile-menu">
            <div>
                <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                    <span class="hamburger-box">
                        <span class="mr-4 hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
        <div class="app-header__menu">
            <span>
                <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                    <span class="btn-icon-wrapper">
                        <i class="fa fa-ellipsis-v fa-w-6"></i>
                    </span>
                </button>
            </span>
        </div>
        <div class="app-header__content">
            <div class="app-header-right">
                <div class="header-btn-lg pr-0">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="btn-group">
                                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn" >
                                        <img width="40" height="40" class="rounded-circle" src="{{ asset('storage/' . Auth::user()->imagen) }}" alt=""/>
                                    </a>
                                </div>
                            </div>
                            <div class="widget-content-left  ml-3 header-user-info">
                                <div class="widget-heading float-right">
                                    <a href="/perfiles/{{ Auth::user()->id }}" class="table-link">     
                                        {{ auth()->user()->name}} {{ auth()->user()->lastname}}     
                                    </a>
                                </div>
                                <br>
                                <div class="widget-subheading float-right">
                                    <a href="/perfiles/{{ Auth::user()->id }}" class="table-link">     
                                        {{ auth()->user()->rol->nombre}}     
                                    </a>
                                </div>
                            </div>
                            <div class="widget-content-right header-user-info ml-3">
                                <form id="logout-button" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-button').submit();">
                                    <i class="fa text-white fa-power-off ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="app-main">
        <div class="app-sidebar sidebar-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>

            <div class="scrollbar-sidebar">
                <div class="app-sidebar__inner">
                    <ul class="vertical-nav-menu">
                        <!-- Menu 1 -->
                        <li class="app-sidebar__heading">General</li>
                        <li><a href="/"><i class="metismenu-icon pe-7s-home"></i> Página Principal </a></li>
                        @if (Auth::user()->rol_id == 1) 
                            <li><a href="/proyectos"><i class="metismenu-icon pe-7s-menu"></i> Proyectos </a></li>
                        @else 
                        <li><a href="/tickets"><i class="metismenu-icon pe-7s-ticket"></i> Mis tickets </a></li>
                        @endif
                        <!-- Menu 2 -->
                            <li class="app-sidebar__heading">Sistema</li>
                            @if (Auth::user()->rol_id == 1) 
                                <li><a href="/roles"><i class="metismenu-icon pe-7s-edit"></i> Roles </a></li>
                                <li><a href="/usuarios"><i class="metismenu-icon pe-7s-users"></i> Usuarios </a></li>
                                <li><a href="/tipos-tickets"><i class="metismenu-icon pe-7s-wallet"></i> Tipos de tickets </a></li>
                            @endif
                    </ul>
                </div>
            </div>
        </div>

        @yield('content')
    </div>
</div>
