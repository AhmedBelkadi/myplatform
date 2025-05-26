<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="border-radius: 0 26px 26px 0">
    <div class="app-brand demo my-4">
        <a href="/" class="app-brand-link">
            <span class="app-brand-logo">
                <img src="{{ asset('assets/img/logo.svg') }}" alt="Support Ticket System" style="height: 60px;">
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

   

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @if(auth()->user()->hasRole('Administrateur'))
            <!-- Admin Menu Items -->
            <li class="menu-item @yield('dashboard-active')">
                <a href="{{ route('admin.dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div>Dashboard</div>
                </a>
            </li>
            <li class="menu-item @yield('users-active')">
                <a href="{{ route('admin.users.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-group"></i>
                    <div>Utilisateurs</div>
                </a>
            </li>
            <li class="menu-item @yield('roles-active')">
                <a href="{{ route('admin.roles.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-key"></i>
                    <div>Rôles</div>
                </a>
            </li>
            <li class="menu-item @yield('permissions-active')">
                <a href="{{ route('admin.permissions.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-lock-alt"></i>
                    <div>Permissions</div>
                </a>
            </li>
            <li class="menu-item @yield('tickets-active')">
                <a href="{{ route('admin.tickets.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-support"></i>
                    <div>Tickets</div>
                </a>
            </li>

        @elseif(auth()->user()->hasRole('Support'))
            <!-- Support Agent Menu Items -->
            <li class="menu-item @yield('dashboard-active')">
                <a href="{{ route('support.dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div>Dashboard</div>
                </a>
            </li>
            <li class="menu-item @yield('tickets-active')">
                <a href="{{ route('support.tickets.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-support"></i>
                    <div>Tickets</div>
                </a>
            </li>
            <li class="menu-item @yield('profile-active')">
                <a href="{{ route('support.profile.show') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div>Mon Profil</div>
                </a>
            </li>

        @else
            <!-- Regular User Menu Items -->
          
            <li class="menu-item @yield('tickets-active')">
                <a href="{{ route('tickets.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-ticket"></i>
                    <div>Mes Tickets</div>
                </a>
            </li>
            <li class="menu-item @yield('profile-active')">
                <a href="{{ route('profile.show') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div>Mon Profil</div>
                </a>
            </li>
        @endif

        <li class="menu-item ">
            <hr>
            <form action="{{ route('logout') }}" method="POST" class="menu-link bg-transparent border-0">
                @csrf
                <button type="submit" class="menu-link border-0 bg-transparent w-100 d-flex align-items-center px-0">
                    <i class='bx bx-log-out menu-icon tf-icons'></i>
                    <div data-i18n="Analytics">Déconnexion</div>
                </button>
            </form>
        </li>

        <!-- Logout Button
        <li class="menu-item ">
            <form action="{{ route('logout') }}" method="POST" class="menu-link">
                @csrf
                <button class="bg-danger" type="submit" style="background: none; border: none; width: 100%; text-align: left; padding: 0.625rem 1rem;"> 
                    <i class="menu-icon tf-icons bx bx-log-out"></i>
                    <div>Déconnexion</div>
                </button>
            </form>
        </li> -->
    </ul>

    <!-- User Profile Info -->
    <div class="px-2 mt-auto w-100" style="margin-bottom: 1.5rem;">
        <div class="px-2 py-3 w-100" style="background: linear-gradient(to right, #4318FF, #868CFF); border-radius: 15px;">
            <div class="d-flex align-items-center gap-3">
                <div class="avatar">
                    <div class="rounded-circle bg-white d-flex align-items-center justify-content-center" 
                         style="width: 45px; height: 45px; box-shadow: 0 3px 6px rgba(0,0,0,0.16);">
                        <span class="fw-bold" style="color: #4318FF; font-size: 18px;">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </span>
                    </div>
                </div>
                <div class="user-info text-white">
                    <h6 class="mb-1 fw-bold">{{ Auth::user()->name }}</h6>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bx bxs-circle text-success" style="font-size: 8px;"></i>
                        <small class="opacity-75">
                            @if(auth()->user()->hasRole('Administrateur'))
                                Administrateur
                            @elseif(auth()->user()->hasRole('Support'))
                                Agent Support
                            @else
                                Utilisateur
                            @endif
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

</aside>















