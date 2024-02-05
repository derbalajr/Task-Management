<nav class="navbar navbar-expand-md navbar-dark main-background-color shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            Task Management
        </a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    Tasks
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('tasks.index') }}">All</a>
                    <a class="dropdown-item" href="{{ route('tasks.create') }}">Create Task</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    Projects
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('projects.index') }}">All</a>
                    <a class="dropdown-item" href="{{ route('projects.create') }}">Create Project</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
