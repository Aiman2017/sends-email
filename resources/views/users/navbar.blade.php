<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand" href="#">MyApp</a>

        <!-- Toggler/collapsible Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('settings')}}">settings</a>
                </li>
                @can('access', auth()->user())
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('users.index')}}">send message</a>
                    </li>
                @endcan
            </ul>

            <!-- Notification Icon -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-danger">3</span> <!-- Notification count -->
                    </a>
                    <!-- Dropdown Menu -->
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                        <li><a class="dropdown-item" href="#">New message from John</a></li>
                        <li><a class="dropdown-item" href="#">Reminder: Meeting at 3 PM</a></li>
                        <li><a class="dropdown-item" href="#">You have a new follower</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
