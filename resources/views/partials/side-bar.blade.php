<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{asset('images/logo_mirah_sans_fond.webp')}}" alt="" height="30">
            </span>
            <span class="logo-lg">
                <img src="{{asset('images/logo_mirah.webp')}}" alt="" width="120">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{asset('images/logo_mirah_sans_fond.webp')}}" alt="" height="30">
            </span>
            <span class="logo-lg">
                <img src="{{asset('images/logo_mirah.webp')}}" alt="" width="120">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route("dashboard")}}">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                        <i class="ri-pages-line"></i> <span data-key="t-dashboards">Campagne</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                        <i class="ri-pages-line"></i> <span data-key="t-dashboards">Departements</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                        <i class="ri-pages-line"></i> <span data-key="t-dashboards">Historique des enquêtes</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span data-key="t-apps">Enquêtes</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-calendar"> En attentes </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-calendar"> Validées </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-calendar"> Annulées </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @if(Auth::user()->account=='ADMINITRATEUR' || Auth::user()->account=='MINISTERE')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarBusiness" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                            <i class="ri-building-line"></i> <span data-key="t-authentication">Etablissements</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarBusiness">
                            <ul class="nav nav-sm flex-column" >
                                <li class="nav-item">
                                    <a href="{{route("business.add",['ajouter'])}}" class="nav-link" data-key="t-calendar"> Ajouter </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route("business.index")}}" class="nav-link" data-key="t-calendar"> Liste </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Utilisateurs</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column" >
                            <li class="nav-item">
                                <a href="{{route("user.add",['ajouter'])}}" class="nav-link" data-key="t-calendar"> Ajouter </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route("user.index")}}" class="nav-link" data-key="t-calendar"> Liste </a>
                            </li>
                        </ul>
                    </div>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>