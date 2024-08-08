<nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark sticky-top bg-body-tertiary" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand fw-light" href="/">{{ config('app.name') }}</a>

        <a class="navbar-brand fw-light" href="{{ route('dashboard') }}">
            <img class="w-24" src="{{ asset('storage/logo/bijeli-oblak.png') }}" alt="Logo" style="width: 25px; height: 25px; margin-bottom: 20px;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                @auth
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-light text-dark">{{ Auth::user()->unreadNotifications->count() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        @php
                            $notifications = Auth::user()->notifications->take(8);
                        @endphp
            
                        @forelse ($notifications as $notification)
                            <a class="dropdown-item" href="{{ route('notifications.show', $notification->id) }}">
                                {{ $notification->data['message'] }}
                            </a>
                        @empty
                            <a class="dropdown-item" href="#">No new notifications</a>
                        @endforelse
                        
                        <div class="dropdown-item text-center">
                            <a href="{{ route('notifications.index') }}">See All Notifications</a>
                        </div>
                    </div>
                </li>
            @endauth

               
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endguest

               
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">{{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm mt-1" type="submit">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
