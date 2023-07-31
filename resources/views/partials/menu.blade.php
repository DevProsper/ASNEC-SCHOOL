<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="index3.html" class="brand-link">
        <img src="{{asset('assets/images/logo-asnec-it.png')}}" alt="ASNEC-IT Logo" 
        class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">ASNEC-SCHOOL</span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets/images/avatar5.png')}}" class="img-circle elevation-2" 
                alt="images profile">
            </div>
            <div class="info">
                <a href="#" class="d-block">Prosper NGOUARI</a>
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
                            <i class="nav-icon fas fa-user"></i>
                            <p>Elèves</p>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            @can("inscri.reinscri")
            <li class="nav-item {{ setMenuClass('inscri.reinscri.', 'menu-open') }}">
                <a href="#" class="nav-link {{ setMenuClass('inscri.reinscri.', 'active') }}">
                    <i class="fas fa-school"></i>
                    <p>
                        Inscri. et Réinscription
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('inscri.reinscri.liste.index')}}"
                            class="nav-link {{ setMenuClass('inscri.reinscri.liste.index', 'active') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Elèves</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('administration.annees.scolaires.index')}}"
                            class="nav-link {{ setMenuClass('administration.annees.scolaires.index', 'active') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Inscription</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('administration.niveaux.nvscolaires.index')}}"
                            class="nav-link {{ setMenuClass('administration.niveaux.nvscolaires.index', 'active') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Réinscription</p>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan


            @can("enseignants")
                <li class="nav-item">
                    <a href="{{route('enseignants.enseignants.index')}}" 
                    class="nav-link {{ setMenuClass('enseignants.enseignants.index', 'active') }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Enseignants
                        </p>
                    </a>
                </li>
            @endcan

                @can("administration")
                <li class="nav-item {{ setMenuClass('administration.', 'menu-open') }}">
                    <a href="#" class="nav-link {{ setMenuClass('administration.', 'active') }}">
                        <i class="nav-icon fas fa-cog"></i>
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
                            <a href="{{route('administration.trimestres.trimestres.index')}}" 
                            class="nav-link {{ setMenuClass('administration.trimestres.trimestres.index', 'active') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gestion des trimestres</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('administration.mois.mois.index')}}" 
                            class="nav-link {{ setMenuClass('administration.mois.mois.index', 'active') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gestion des mois</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
             <!--   <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li> -->

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