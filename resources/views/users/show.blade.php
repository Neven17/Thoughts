@extends('layout.layout')

@section('title', $user->name)

@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            @include('shared.success-message')
            <div class="mt-3">
                @include('users.shared.user-card')
            </div>
            <hr>
            @auth
                @if (Auth::user()->isBlockedByOrBlocking($user))
                    <p class="text-center mt-4">You are not authorized to view this user's thoughts.</p>
                @elseif (!Auth::user()->follows($user) && Auth::id() !== $user->id)
                    <p class="text-center mt-4">You are not following this user. Follow to see their thoughts.</p>
                @else
                    @forelse ($user->thoughts as $thought)
                        <div class="mt-3">
                            @include('thoughts.shared.thought-card')
                        </div>
                    @empty
                        <p class="text-center mt-4">No Thoughts Found.</p>
                    @endforelse

                    <div class="mt-3">
                        {{ $user->thoughts()->paginate(8)->withQueryString()->links() }}
                    </div>
                @endif
            @else
                <p class="text-center mt-4">Please log in to view this user's thoughts.</p>
            @endauth
        </div>
        <div class="col-3">
        
            @include('shared.search-users-bar')
            @include('shared.follow-box')
        </div>
    </div>
@endsection
