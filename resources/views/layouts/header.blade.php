<header class="mb-3">
    <nav class="navbar navbar-expand navbar-light px-3">

        {{-- TOGGLE SIDEBAR --}}
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>

        {{-- RIGHT SIDE --}}
        <div class="ms-auto d-flex align-items-center">

            @auth
            <div class="dropdown">
                <a href="#" data-bs-toggle="dropdown"
                   class="d-flex align-items-center text-decoration-none">

                    <div class="avatar avatar-md">
                        @if(auth()->user()->profile_picture)
                            <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}?{{ time() }}" alt="Profile Picture" class="rounded-circle">
                        @else
                            <img src="{{ asset('assets-admin/images/faces/1.jpg') }}" alt="User">
                        @endif
                    </div>

                    <span class="ms-2 d-none d-md-inline text-dark fw-semibold">
                        {{ auth()->user()->name }}
                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.show') }}">
                            <i class="bi bi-person me-2"></i> Profile
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-danger" href="#"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
            @endauth

            @guest
            <a href="{{ route('login') }}" class="btn btn-primary">
                Login
            </a>
            @endguest

        </div>
    </nav>
</header>
