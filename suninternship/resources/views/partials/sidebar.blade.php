<nav class="sidebar">
    <div class="menu-content">
        <div class="user-info">
            <img src="{{ asset(Auth::user()->image) }}" alt="Image de l'utilisateur" />
            <div class="user-details">
                <h3 class="user-name">{{ Auth::user()->fullname }}</h3>
                <p class="user-status">En ligne</p>
            </div>
        </div>

        <ul class="menu-items" id="menu1">
            <li class="item tooltip {{ request()->routeIs('dashboard.main') ? 'active' : '' }}">
                <div>
                    <a href="{{ route('dashboard.main') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Tableau de bord</span>
                    </a>
                    <div class="tooltiptext">Tableau de bord</div>
                </div>
            </li>

            <li class="item {{ request()->routeIs('dashboard.stagiaires*') ? 'active' : '' }}">
                <div class="submenu-item tooltip">
                    <span>
                        <i class="fas fa-user-graduate"></i>
                        <span>Stagiaires</span>
                    </span>
                    <i class="fas fa-chevron-right"></i>
                    <div class="tooltiptext">Stagiaires</div>
                </div>
            </li>

            <li class="item tooltip {{ request()->routeIs('dashboard.settings') ? 'active' : '' }}">
                <div>
                    <a href="{{ route('dashboard.settings') }}">
                        <i class="fas fa-gear"></i>
                        <span>Paramètres</span>
                    </a>
                    <div class="tooltiptext">Paramètres</div>
                </div>
            </li>

            <li class="item tooltip {{ request()->routeIs('dashboard.help') ? 'active' : '' }}">
                <a href="{{ route('dashboard.help') }}">
                    <i class="fas fa-question-circle"></i>
                    <span>Aide</span>
                </a>
                <div class="tooltiptext">Aide</div>
            </li>

            <li class="item tooltip">
                <a href="{{ route('logout') }}">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Déconnexion</span>
                </a>
                <div class="tooltiptext">Déconnexion</div>
            </li>
        </ul>

        <ul class="menu-items" id="menu2">
            <div class="menu-title">
                <i class="fas fa-chevron-left"></i>
                <span>Retour</span>
            </div>
            <li class="item tooltip {{ request()->routeIs('dashboard.add-intern') ? 'active' : '' }}">
                <a href="{{ route('dashboard.add-intern') }}">
                    <i class="fas fa-user-plus"></i>
                    <span>Ajouter un stagiaire</span>
                </a>
                <div class="tooltiptext">Ajouter</div>
            </li>
            <li class="item tooltip {{ request()->routeIs('dashboard.edit-intern') ? 'active' : '' }}">
                <a href="{{ route('dashboard.edit-intern') }}">
                    <i class="fas fa-user-edit"></i>
                    <span>Modifier un stagiaire</span>
                </a>
                <div class="tooltiptext">Modifier</div>
            </li>
            <li class="item tooltip {{ request()->routeIs('dashboard.delete-intern') ? 'active' : '' }}">
                <a href="{{ route('dashboard.delete-intern') }}">
                    <i class="fas fa-user-minus"></i>
                    <span>Supprimer un stagiaire</span>
                </a>
                <div class="tooltiptext">Supprimer</div>
            </li>
        </ul>
    </div>
</nav>