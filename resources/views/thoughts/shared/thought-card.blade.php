<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle" src="{{ $thought->user->getImageURL() }}"
                    alt="{{ $thought->user->name }}">
                <div>
                    <h5 class="card-title mb-0"><a href="{{ route('users.show', $thought->user->id) }}" style="text-decoration: none; color:black;">
                            {{ $thought->user->name }}
                        </a></h5>
                </div>
            </div>
            <div>
                <div class="d-flex">
                    <a href="{{ route('thoughts.show', $thought->id) }}" style="text-decoration: none;"> View </a>
                    @auth()
                        @can('update', $thought)
                            <a class="mx-2" href="{{ route('thoughts.edit', $thought->id) }}" style="text-decoration: none;"> Edit </a>
                            <form method="POST" action="{{ route('thoughts.destroy', $thought->id) }}">
                                @csrf
                                @method('delete')
                                <button class="ms-1 btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"> X </button>
                            </form>
                        @endcan
                    @endauth
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($editing ?? false)
                <form action="{{ route('thoughts.update', $thought->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <textarea class="form-control" id="content" name="content" rows="4" maxlength="700">{{ old('content', $thought->content) }}</textarea>
                        @error('content')
                            <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-dark mb-2 btn-sm"> Update</button>
                    </div>
                </form>
            @else
                <p class="fs-6 fw-light text-muted fw-bold">
                    {{ $thought->content }}
                </p>
            @endif
            
            <div class="d-flex justify-content-between">
                @include('thoughts.shared.like-button')
                <div>
                    <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                        {{ $thought->created_at->diffForHumans() }} </span>
                </div>
            </div>
            @include('thoughts.shared.comments-box')
        </div>
    </div>
</div>
