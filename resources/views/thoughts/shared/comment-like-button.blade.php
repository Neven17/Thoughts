<div id="like-comment-{{ $comment->id }}">
    @auth
        @if (Auth::id() !== $comment->user_id)
          
            @if (Auth::user()->likesComment->contains($comment->id))
              
                <form class="like-form unlike-form" data-comment-id="{{ $comment->id }}" action="{{ route('comments.unlike', $comment->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-link text-dark" style="text-decoration: none;">
                        <span class="fas fa-heart"></span>
                        <span>{{ $comment->likesComment()->count() }}</span>
                    </button>
                </form>
            @else
               
                <form class="like-form like-form" data-comment-id="{{ $comment->id }}" action="{{ route('comments.like', $comment->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-link text-dark" style="text-decoration: none;">
                        <span class="far fa-heart"></span>
                        <span style="cursor: pointer;">{{ $comment->likesComment()->count() }}</span>
                    </button>
                </form>
            @endif
        @else
           
            <span class="text-dark">
                <span class="fas fa-heart"></span>
                <span>{{ $comment->likesComment()->count() }}</span>
            </span>
        @endif
    @else
        {{-- Prikaz za goste --}}
        <a href="{{ route('login') }}" class="text-dark">
            <span class="far fa-heart"></span>
            <span>{{ $comment->likesComment()->count() }}</span>
        </a>
    @endauth
</div>


