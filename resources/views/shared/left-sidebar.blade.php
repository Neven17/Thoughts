<div class="card overflow-hidden">
    <div class="card-body pt-3">
        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
            <li class="nav-item">
                <a class="{{(Route::is ('dashboard')) ? 'text-white bg-primary rounded' : ''}} nav-link" href="{{route('dashboard')}}"> {{-- Ako je korisnik ta tom url napravi text-white.. Ako nije --}}
                    <span>Home</span></a>
            </li>

            <li class="nav-item">
                <a class="{{(Route::is ('weather')) ? 'text-white bg-primary rounded' : ''}} nav-link" href="{{route('weather')}}"> {{-- Ako je korisnik ta tom url napravi text-white.. Ako nije --}}
                    <span>Weather</span></a>
            </li>

          

            <li class="nav-item">
                <a class="{{(Route::is ('trivia')) ? 'text-white bg-primary rounded' : ''}} nav-link" href="{{route('trivia')}}"> {{-- Ako je korisnik ta tom url napravi text-white.. Ako nije --}}
                    <span>Trivia</span></a>
            </li>

            <li class="nav-item">
                <a class="{{(Route::is ('cats')) ? 'text-white bg-primary rounded' : ''}} nav-link" href="{{route('cats')}}"> {{-- Ako je korisnik ta tom url napravi text-white.. Ako nije --}}
                    <span>Cats</span></a>
            </li>
          

            <li class="nav-item">
                <a class="{{(Route::is ('terms')) ? 'text-white bg-primary rounded' : ''}} nav-link" href="{{route('terms')}}"> {{-- Ako je korisnik ta tom url napravi text-white.. Ako nije --}}
                    <span>Terms</span></a>
            </li>
           
        </ul>
    </div>
    <div class="card-footer text-center py-2">
        <a class="btn btn-link btn-sm" href="{{route('profile')}}" style="text-decoration: none;">View Profile </a>
    </div>
</div>