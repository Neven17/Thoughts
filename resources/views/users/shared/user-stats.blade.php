<div class="d-flex justify-content-start">
    <a href="" class="fw-light nav-link fs-6 me-3" data-bs-toggle="modal" data-bs-target="#followersModal">
        <span class="fas fa-user me-1"></span> {{ $user->followers()->count() }} Followers
    </a>
    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
        </span> {{ $user->thoughts()->count() }} </a>
 
</div>

@auth
@if (Auth::user()->isBlockedByOrBlocking($user))

@else
        
        <div class="modal fade" id="followersModal" tabindex="-1" aria-labelledby="followersModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="followersModalLabel">Followers List</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4>Followers of {{ $user->name }}</h>
                            <ul>
                                @foreach ($user->followers as $follower)
                                    <li>
                                        <a href="{{ route('users.show', $follower->id) }}"
                                            class="d-flex align-items-center  text-black text-decoration-none">
                                            <img src="{{ $follower->getImageURL() }}" alt="{{ $follower->name }}"
                                                class="avatar-img rounded-circle me-3" style="width: 20px; ">
                                            {{ $follower->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                    </div>
                </div>
            </div>
        </div>
    @endif
@endauth
