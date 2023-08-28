<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{route('home')}}" class="brand-link">
        <img src="{{asset('assets/images/logo-asnec-it.png')}}" alt="ASNEC-IT Logo" 
        class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">SIGES</span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets/images/avatar5.png')}}" class="img-circle elevation-2" 
                alt="images profile">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" 
                aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" 
            data-accordion="false">

            @can("eleves")
            <li class="nav-item {{ setMenuClass('eleves.', 'menu-open') }}">
                <a href="#" class="nav-link {{ setMenuClass('eleves.', 'active') }}">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <p>
                        Pré-Admission
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('eleves.eleves.index')}}" class="nav-link {{ setMenuClass('eleves.eleves.index', 'active') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Nouveaux Arrivants</p>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            @can("caisses")
            <li class="nav-item {{ setMenuClass('caisses.', 'menu-open') }}">
                <a href="#" class="nav-link {{ setMenuClass('caisses.', 'active') }}">
                    <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                    <p>
                        Caisse
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('caisses.inscription-reinscription.index')}}"
                            class="nav-link {{ setMenuClass('caisses.inscription-reinscription.index', 'active') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Admission arrivants</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('caisses.scolarite.index')}}"
                            class="nav-link {{ setMenuClass('caisses.scolarite.index', 'active') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Admission & paiements</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('caisses.operation.index')}}"
                            class="nav-link {{ setMenuClass('caisses.operation.index', 'active') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Mes opérations</p>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            @can("evaluations")
            <li class="nav-item {{ setMenuClass('evaluations.primaire.', 'menu-open') }}">
                <a href="#" class="nav-link {{ setMenuClass('evaluations.primaire.', 'active') }}">
                    <i class="fas fa-star" aria-hidden="true"></i>
                    <p>
                        Evaluations primaire
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('evaluations.primaire.evaluations_p.index')}}"
                            class="nav-link {{ setMenuClass('evaluations.primaire.evaluations_p.index', 'active') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Notes niveau prim.</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('evaluations.primaire.notes_p.index')}}"
                            class="nav-link {{ setMenuClass('evaluations.primaire.notes_p.index', 'active') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Liste notes prim.</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('evaluations.primaire.bulletin_p.index')}}"
                            class="nav-link {{ setMenuClass('evaluations.primaire.bulletin_p.index', 'active') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Bulletin niveau prim.</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ setMenuClass('secondaire.evaluations.', 'menu-open') }}">
                <a href="#" class="nav-link {{ setMenuClass('secondaire.evaluations.', 'active') }}">
                    <i class="fas fa-star" aria-hidden="true"></i>
                    <p>
                        Evaluations secondaire
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('secondaire.evaluations.evaluations.index')}}"
                            class="nav-link {{ setMenuClass('secondaire.evaluations.evaluations.index', 'active') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Notes niveau second.</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('secondaire.evaluations.notes.index')}}"
                            class="nav-link {{ setMenuClass('secondaire.evaluations.notes.index', 'active') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Liste notes second.</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('secondaire.evaluations.bulletin.index')}}"
                            class="nav-link {{ setMenuClass('secondaire.evaluations.bulletin.index', 'active') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Bulletin niveau second.</p>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan


            @can("enseignants")
                <li class="nav-item">
                    <a href="{{route('enseignants.enseignants.index')}}" 
                    class="nav-link {{ setMenuClass('enseignants.enseignants.index', 'active') }}">
                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                        <p>
                            Enseignants
                        </p>
                    </a>
                </li>
            @endcan

            @can("administration")
                <li class="nav-item {{ setMenuClass('administration.', 'menu-open') }}">
                    <a href="#" class="nav-link {{ setMenuClass('administration.', 'active') }}">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                        <p>
                            Administration
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('administration.annees.scolaires.index')}}" 
                            class="nav-link {{ setMenuClass('administration.annees.scolaires.index', 'active') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Année scolaire</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('administration.niveaux.nvscolaires.index')}}" 
                            class="nav-link {{ setMenuClass('administration.niveaux.nvscolaires.index', 'active') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Niveaux scolaires</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('administration.tarifications.tarifications.index')}}" 
                            class="nav-link {{ setMenuClass('administration.tarifications.tarifications.index', 'active') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tarifications</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('administration.classes.classes.index')}}" 
                            class="nav-link {{ setMenuClass('administration.classes.classes.index', 'active') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gestion des classes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('administration.matieres.matieres.index')}}" 
                            class="nav-link {{ setMenuClass('administration.matieres.matieres.index', 'active') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gestion des matières</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('administration.batiments.batiments.index')}}" 
                            class="nav-link {{ setMenuClass('administration.batiments.batiments.index', 'active') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gestion de batiment(s)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('administration.salles.salles.index')}}" 
                            class="nav-link {{ setMenuClass('administration.salles.salles.index', 'active') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gestion des salles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('administration.periodes.periodes.index')}}" 
                            class="nav-link {{ setMenuClass('administration.periodes.periodes.index', 'active') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gestion des périodes</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            
            @can("utilisateurs")
                <li class="nav-item">
                    <a href="{{route('users.utilisateurs.index')}}" 
                    class="nav-link {{ setMenuClass('users.utilisateurs.index', 'active') }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Utilisateurs
                        </p>
                    </a>
                </li>
                @endcan
            </ul>
        </nav>

    </div>

</aside>