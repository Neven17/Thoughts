<div>
    @auth
        <form action="{{ route('thoughts.comments.store', $thought->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <textarea name="comment_content" class="fs-6 form-control" rows="2" maxlength="690">{{ old('comment_content') }}</textarea>
                @error('comment_content')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Post Comment</button>
            </div>
        </form>
    @endauth

    <hr>

    @forelse ($thought->comments as $comment)
        <div class="d-flex align-items-start mb-2">
            <a href="{{ route('users.show', ['user' => $comment->user->id]) }}" class="text-decoration-none">
                <img style="width: 35px;" class="me-2 avatar-sm rounded-circle" src="{{ $comment->user->getImageURL() }}" alt="{{ $comment->user->name }}">
            </a>
            <div class="w-100">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="font-weight-bold">
                        <a href="{{ route('users.show', ['user' => $comment->user->id]) }}" class="text-decoration-none text-dark">
                            {{ $comment->user->name }}
                        </a>
                    </h6>
                    <div class="d-flex align-items-center">
                        <span class="fs-6 text-muted me-2">
                            <span class="fas fa-clock"></span>
                            {{ $comment->created_at->diffForHumans() }}
                        </span>
                        @can('delete', $comment)
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger ml-auto" onclick="return confirm('Are you sure?')">x</button>
                            </form>
                        @endcan
                    </div>
                </div>
                <p class="fs-6 mt-1 text-muted">{{ $comment->content }}</p>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
           
            @include('thoughts.shared.comment-like-button', ['comment' => $comment])

            <div>
                <span class="fs-6 text-muted">
                   
                </span>
            </div>
        </div>
        <hr>
    @empty
       
    @endforelse
</div>
