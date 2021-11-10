<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}"><i data-feather="home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}"><i data-feather="user-plus"></i> Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}"><i data-feather="log-in"></i> Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"><i data-feather="log-out"></i> Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('clients.index') }}"><i data-feather="users"></i> Clients</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i data-feather="user"></i>
                        Admin
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('admins.index') }}">List of admins</a></li>
                        <li><a class="dropdown-item" href="{{ route('admins.show') }}">My profile</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
