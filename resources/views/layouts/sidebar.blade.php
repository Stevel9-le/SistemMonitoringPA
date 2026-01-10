<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">

        {{-- HEADER --}}
        <div class="sidebar-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="{{ route('dashboard') }}" class="fw-bold">
                        Monitoring PA
                    </a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block">
                        <i class="bi bi-x bi-middle"></i>
                    </a>
                </div>
            </div>


        </div>

        {{-- MENU --}}
        <div class="sidebar-menu">
            <ul class="menu">

                {{-- DASHBOARD --}}
                <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="sidebar-link">
                        <i class="bi bi-house-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- ================= ADMIN ================= --}}
                @if(auth()->check() && auth()->user()->hasRole('admin'))

                <li class="sidebar-item {{ request()->routeIs('projects.*') ? 'active' : '' }}">
                    <a href="{{ route('projects.index') }}" class="sidebar-link">
                        <i class="bi bi-folder-fill"></i>
                        <span>Project Management</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('staff.*') ? 'active' : '' }}">
                    <a href="{{ route('staff.index') }}" class="sidebar-link">
                        <i class="bi bi-people-fill"></i>
                        <span>Staff Management</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                    <a href="{{ route('reports.index') }}" class="sidebar-link">
                        <i class="bi bi-bar-chart-fill"></i>
                        <span>Reports</span>
                    </a>
                </li>
                @endif

                {{-- ================= STAFF ================= --}}
                @role('staff')
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link d-flex align-items-center">
                        <i class="bi bi-folder-fill"></i>
                        <span>My Projects</span>

                        @php
                            $myProjectsCount = \App\Models\Project::where(
                                'assigned_staff_id',
                                auth()->id()
                            )->count();
                        @endphp

                        @if($myProjectsCount > 0)
                            <span class="badge bg-primary ms-auto">
                                {{ $myProjectsCount }}
                            </span>
                        @endif
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-pencil-square"></i>
                        <span>Project Updates</span>
                    </a>
                </li>
                @endrole

                {{-- ================= STUDENT ================= --}}
                @if(auth()->check() && auth()->user()->hasRole('student'))
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-book-fill"></i>
                        <span>My Final Project</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-graph-up"></i>
                        <span>Progress Tracking</span>
                    </a>
                </li>
                @endif

                {{-- PROFILE --}}
                <li class="sidebar-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <a href="{{ route('profile.show') }}" class="sidebar-link">
                        <i class="bi bi-person-circle"></i>
                        <span>My Profile</span>
                    </a>
                </li>

                {{-- LOGOUT --}}
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </li>

            </ul>
        </div>

    </div>
</div>
