<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:150px" class="me-3 avatar-sm rounded-circle" src="{{ $user->getImageURL() }}"
                    alt="{{ $user->name }} Avatar">
                <div>
                    <h3 class="card-title mb-0"><a href="#"
                            style="text-decoration: none; font-weight:bold; color:black"> {{ $user->name }}
                        </a></h3>
                    <span class="fs-6 text-muted">{{ $user->email }}</span>
                </div>
            </div>
            <div>
                @can('update', $user)
                  
                    <a href="{{ route('users.edit', $user->id) }}" style="text-decoration: none;"
                        class="btn btn-link fw-bold position-absolute top-0 end-0 mt-3 me-3">Edit Profile <i
                            class="fas fa-edit me-1"></i>
                    </a>
                @endcan
            </div>
        </div>

        <div class="px-2 mt-4">
            <h5 class="fs-5"> Bio : </h5>
        </div>

        <p class="fs-6 fw-light">
            {{ $user->bio }}
        </p>

        @include('users.shared.user-stats')

      
        <div class="d-flex">
            @auth
                @if (!$user->isBlocked(Auth::user()) && Auth::user()->isNot($user))
                   
                    <div class="mt-3">
                        @if (Auth::user()->follows($user))
                          
                            <form action="{{ route('users.unfollow', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm"> Unfollow </button>
                            </form>
                        @else
                           
                            <form action="{{ route('users.follow', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm"> Follow </button>
                            </form>
                        @endif
                    </div>
                @endif
            @endauth

         
            @auth
                @if (Auth::user()->isNot($user))
                  
                    <div class="mt-3" style="margin-left: auto;">
                        @if (Auth::user()->isBlocked($user))
                           
                            <form action="{{ route('users.unblock', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')"> Unblock </button>
                            </form>
                        @else
                           
                            <form action="{{ route('users.block', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm"
                                    onclick="return confirm('Are you sure?')"> Block </button>
                            </form>
                        @endif
                    </div>
                @endif
            @endauth
        </div>
    </div>
</div>
