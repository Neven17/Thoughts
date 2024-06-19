<div class="card overflow-hidden">
    <div class="card-body pt-3">
        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
            <li class="nav-item">
                <a class="{{ Route::is('admin.dashboard') ? 'text-white bg-primary rounded' : '' }} nav-link"
                    href="{{ route('admin.dashboard') }}"> {{-- Ako je korisnik ta tom url napravi text-white.. Ako nije --}}
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::is('admin.users.index') ? 'text-white bg-primary rounded' : '' }} nav-link"
                    href="{{ route('admin.users.index') }}"> {{-- Ako je korisnik ta tom url napravi text-white.. Ako nije --}}
                    <span>Users</span></a>
            </li>

            <li class="nav-item">
                <a class="{{ Route::is('admin.thoughts.index') ? 'text-white bg-primary rounded' : '' }} nav-link"
                    href="{{ route('admin.thoughts.index') }}"> {{-- Ako je korisnik ta tom url napravi text-white.. Ako nije --}}
                    <span>Thoughts</span></a>
            </li>


            <li class="nav-item">
                <a class="{{ Route::is('admin.comments.index') ? 'text-white bg-primary rounded' : '' }} nav-link"
                    href="{{ route('admin.comments.index') }}"> {{-- Ako je korisnik ta tom url napravi text-white.. Ako nije --}}
                    <span>Comments</span></a>
            </li>


        </ul>
    </div>
    
</div>
