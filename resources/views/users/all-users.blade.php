@extends('layout.layout')

@section('title', 'All Users')

@section('content')
    <div class="row">
        <div class="col-md-3 mb-4">
            @include('shared.left-sidebar')
        </div>
        <div class="col-md-6"> 
            <h2 class="mb-4">All Users</h2>
            @foreach ($ourUsers as $user)
                <div class="user-card mb-3  ">
                    <a href="{{ route('users.show', $user->id) }}" class="d-flex align-items-center  text-decoration-none ">
                        <img src="{{ $user->getImageURL() }}" alt="{{ $user->name }}" class="avatar-img rounded-circle me-3" style="width: 50px;">
                        <div class="user-info ms-1">
                            <h5 class="mb-0 text-black">{{ $user->name }}</h5>
                        </div>
                    </a>
                </div>
            @endforeach
            <div class="pagination">
                {{ $ourUsers->withQueryString()->links() }}
            </div>
        </div>
        <div class="col-md-3"> 
            @include('shared.search-users-bar')
        </div>
    </div>
@endsection
