<nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark sticky-top bg-body-tertiary"
    data-bs-theme="dark">
    <div class="container">
        {{--<a class="navbar-brand fw-light" href="/"><span class="fas fa-thought me-1">
            </span>{{ config('app.name') }}</a> {{-- uzeo iz configa ime --}}
            <a class="navbar-brand fw-light" href="/dashboard">{{ config('app.name') }}  <img class=" w-24" src="{{asset('storage/logo/bijeli-oblak.png')}}" alt="" style="width: 25px; height:25px; margin-bottom:20px;"></a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                @guest

                    <li class="nav-item">
                        <a class="{{ Route::is('login') ? 'active' : '' }} nav-link mr" aria-current="page"
                            href="{{ route('login') }}">Login</a>{{-- svjetli login ukoliko je korisnik stisnuo taj button a ako ne, biti ce default --}}
                    </li>
                    <li class="nav-item ">
                        <a class="{{ Route::is('register') ? 'active' : '' }} nav-link "
                            href="{{ route('register') }}">Register</a> {{--  Route is active(svijetli), ce se pokazati ukoliko je korisnik STISNUO NA reg button --}}
                    </li>

                @endguest





                @auth()
                    @if (Auth::user()->is_admin)
                        <li class="nav-item">
                            <a class="{{ Route::is('admin.dashboard') ? 'active' : '' }} nav-link"
                                href="{{ route('admin.dashboard') }}">Admin
                                Dashboard</a> {{-- DODAO  DA IMAM ADMIN GUMB UKOLIKO JE NETKO ADMIN --}}
                        </li>
                    @endif




                    <li class="nav-item">
                        <a class="{{ Route::is('profile') ? 'active' : '' }} nav-link"
                            href="{{ route('profile') }}">{{ Auth::user()->name }}</a> 
                    </li>

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST"> {{-- Kada je user logiran da mu prikaze logout --}}
                            @csrf
                            <button class="btn btn-danger btn-sm" type="submit">Logout</button>

                        </form>
                    @endauth


                <li class="nav-item">
                    <a class="nav-link  ms-4" href="{{ route('lang', 'en') }}">en</a> {{-- zbog promjene jezika  ms-4 --}}
                </li>



                <li class="nav-item ">
                    <a class="nav-link " href="{{ route('lang', 'hr') }}">hr</a> {{-- ovo sam dodao  zbog promjene jezika --}}
                </li>




            </ul>
        </div>

    </div>
</nav>
