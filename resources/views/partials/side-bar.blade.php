<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{asset('images/logo_mirah_sans_fond.webp')}}" alt="" height="30">
            </span>
            <span class="logo-lg">
                <img src="{{asset('images/logo_mirah.webp')}}" alt="" width="120">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{asset('assets/images/logo-saf-short.png')}}" alt="" height="30">
            </span>
            <span class="logo-lg">
                <img src="{{asset('assets/images/logo-saf-short.png')}}" alt="" width="90">
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

                @if(Auth::user()->permission("CRM") || Auth::user()->permission("MAILING"))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route("crm")}}">
                            <i class=" ri-computer-line"></i> <span data-key="t-dashboards">CRM</span>
                        </a>
                    </li>
                @endif
            
                @if(Auth::user()->permission("LISTE CLIENT") || Auth::user()->permission("AJOUTER CLIENT"))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarCustomer" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCustomer">
                            <i class="ri-user-line"></i> <span data-key="t-authentication">Clients</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarCustomer">
                            <ul class="nav nav-sm flex-column" >
                                @if(Auth::user()->permission("AJOUT CLIENT"))
                                    <li class="nav-item">
                                        <a href="{{route("customer.add",['ajouter'])}}" class="nav-link" data-key="t-calendar"> Ajouter un client </a>
                                    </li>
                                @endif
                                @if(Auth::user()->permission("LISTE CLIENT"))
                                    <li class="nav-item">
                                        <a href="{{route("customer.index")}}" class="nav-link" data-key="t-calendar"> Liste des clients  </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif

                @if(Auth::user()->permission("LISTE SOUSCRIPTION EN COURS") || Auth::user()->permission("LISTE SOUSCRIPTION EXPIRE")  || Auth::user()->permission("LISTE PAIEMENT")  
                    || Auth::user()->permission("AJOUT SOUSCRIPTION") || Auth::user()->permission("SUPPRESSION SOUSCRIPTION") )
                    
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarSouscription" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSouscription">
                            <i class="ri-file-list-line"></i> <span data-key="t-authentication">Souscriptions</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarSouscription">
                            <ul class="nav nav-sm flex-column">
                                @if(Auth::user()->permission("AJOUT SOUSCRIPTION"))
                                    <li class="nav-item">
                                        <a href="{{route("souscription.add",['ajouter'])}}" class="nav-link" data-key="t-calendar"> Nouvelle souscription </a>
                                    </li>
                                @endif    

                                @if(Auth::user()->permission("LISTE SOUSCRIPTION EN COURS"))
                                    <li class="nav-item">
                                        <a href="{{route("souscription.index")}}" class="nav-link" data-key="t-calendar"> Souscription en cours </a>
                                    </li>
                                @endif 

                                @if(Auth::user()->permission("LISTE SOUSCRIPTION EXPIRE"))
                                    <li class="nav-item">
                                        <a href="{{route("souscription.expired")}}" class="nav-link" data-key="t-calendar"> Souscription expiré </a>
                                    </li>
                                @endif 

                                @if(Auth::user()->permission("LISTE PAIEMENT"))
                                    <li class="nav-item">
                                        <a href="{{route("payment.index")}}" class="nav-link" data-key="t-calendar"> Paiements </a>
                                    </li>
                                @endif 
                            </ul>
                        </div>
                    </li>
                @endif

                @if(Auth::user()->permission("AJOUT TRANSFERT") || Auth::user()->permission("LISTE TRANSFERT"))
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarMoney" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMoney">
                        <i class="ri-arrow-left-right-line"></i> <span data-key="t-authentication">Transfert d'argent</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarMoney">
                        <ul class="nav nav-sm flex-column" > 
                            @if(Auth::user()->permission("AJOUT TRANSFERT"))
                                <li class="nav-item">
                                    <a href="{{route("transfert_money.add",['Charger'])}}" class="nav-link" data-key="t-calendar"> Charger un rapport Excel</a>
                                </li>
                            @endif
                            @if(Auth::user()->permission("LISTE TRANSFERT"))
                                <li class="nav-item">
                                    <a href="{{route("transfert_money.index")}}"  class="nav-link" data-key="t-calendar"> Historique transaction </a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-calendar"> Rapports </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
                
                @if(Auth::user()->permission("LISTE TYPE D'ASSURANCE") || Auth::user()->permission("AJOUTER TYPE D'ASSURANCE"))
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarInsurancetype" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInsurancetype">
                            <i class="ri-home-heart-line"></i> <span data-key="t-authentication">Type d'assurance</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarInsurancetype">
                            <ul class="nav nav-sm flex-column" >
                                @if(Auth::user()->permission("AJOUT TYPE D'ASSURANCE"))
                                    <li class="nav-item">
                                        <a href="{{route("insurance-type.add",['ajouter'])}}" class="nav-link" data-key="t-calendar"> Ajouter un type d'assurance </a>
                                    </li>
                                @endif
                                @if(Auth::user()->permission("LISTE TYPE D'ASSURANCE"))
                                    <li class="nav-item">
                                        <a href="{{route("insurance-type.index")}}" class="nav-link" data-key="t-calendar"> Liste type d'assurance  </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif
                
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarStats" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarStats">
                        <i class="ri-line-chart-line"></i> <span data-key="t-authentication">Statistique</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarStats">
                        <ul class="nav nav-sm flex-column" >
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-calendar"> Rapport 1 </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-calendar"> Rapport 2 </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-calendar"> Rapport 3 </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-calendar"> Rapport 4 </a>
                            </li>
                        </ul>
                    </div>
                </li>
                
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