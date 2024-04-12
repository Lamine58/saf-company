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
                        <i class="ri-pages-line"></i> <span data-key="t-dashboards">Historique des enquêtes</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-search-2-line"></i> <span data-key="t-apps">Enquêtes</span>
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

                @if(Auth::user()->permission('LISTE CHAINE DE VALEUR'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route('value-chain.index')}}">
                            <i class="ri-pie-chart-2-line"></i> <span data-key="t-dashboards">Chaîne de valeurs</span>
                        </a>
                    </li>
                @endif
                
                @if(Auth::user()->permission('AJOUT CATEGORIE') || Auth::user()->permission('LISTE CATEGORIE'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarCategorie" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCategorie">
                            <i class="ri-apps-2-line"></i> <span data-key="t-apps">Categories</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarCategorie">
                            <ul class="nav nav-sm flex-column" >
                                @if(Auth::user()->permission('AJOUT CATEGORIE'))
                                    <li class="nav-item">
                                        <a href="{{route("category.add",['ajouter'])}}" class="nav-link" data-key="t-calendar"> Ajouter </a>
                                    </li>
                                @endif
                                @if(Auth::user()->permission('LISTE CATEGORIE'))
                                    <li class="nav-item">
                                        <a href="{{route("category.index")}}" class="nav-link" data-key="t-calendar"> Liste </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif

                @if(Auth::user()->permission('AJOUT FOURNISSEUR') || Auth::user()->permission('LISTE FOURNISSEUR'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarBusiness" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                            <i class="ri-building-line"></i> <span data-key="t-authentication">Fournisseurs</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarBusiness">
                            <ul class="nav nav-sm flex-column" >
                                @if(Auth::user()->permission('AJOUT FOURNISSEUR'))
                                    <li class="nav-item">
                                        <a href="{{route("business.add",['ajouter'])}}" class="nav-link" data-key="t-calendar"> Ajouter </a>
                                    </li>
                                @endif
                                @if(Auth::user()->permission('LISTE FOURNISSEUR'))
                                    <li class="nav-item">
                                        <a href="{{route("business.index")}}" class="nav-link" data-key="t-calendar"> Liste </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif

                @if(Auth::user()->permission('LISTE METHODE'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route('method.index')}}">
                            <i class="ri-file-search-line"></i> <span data-key="t-dashboards">Méthodes de collecte des données</span>
                        </a>
                    </li>
                @endif
                    
                @if(Auth::user()->permission('LISTE UNITE'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route('unity.index')}}">
                            <i class="ri-router-line"></i> <span data-key="t-dashboards">Unités de mesures</span>
                        </a>
                    </li>
                @endif
                    
                @if(Auth::user()->permission('LISTE PERIODICITE'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route('periodicity.index')}}">
                            <i class="ri-time-line"></i> <span data-key="t-dashboards">Periodicités</span>
                        </a>
                    </li>
                @endif
                
                @if(Auth::user()->permission('AJOUT UTILISATEUR') || Auth::user()->permission('LISTE UTILISATEUR') || Auth::user()->permission('LISTE ROLE') || Auth::user()->permission('LISTE PERMISSION'))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                            <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Utilisateurs</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarAuth">
                            <ul class="nav nav-sm flex-column" >
                                @if(Auth::user()->permission('AJOUT UTILISATEUR'))
                                    <li class="nav-item">
                                        <a href="{{route("user.add",['ajouter'])}}" class="nav-link" data-key="t-calendar"> Ajouter </a>
                                    </li>
                                @endif
                                @if(Auth::user()->permission('LISTE UTILISATEUR'))
                                    <li class="nav-item">
                                        <a href="{{route("user.index")}}" class="nav-link" data-key="t-calendar"> Liste </a>
                                    </li>
                                @endif
                                @if(Auth::user()->permission('LISTE ROLE'))
                                    <li class="nav-item">
                                        <a href="{{route("role.index")}}" class="nav-link" data-key="t-calendar"> Rôles </a>
                                    </li>
                                @endif
                                @if(Auth::user()->permission('LISTE PERMISSION'))
                                    <li class="nav-item">
                                        <a href="{{route("permission.index")}}" class="nav-link" data-key="t-calendar"> Permissions </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif


            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>