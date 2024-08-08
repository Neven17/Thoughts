@extends('layout.layout')

@section('title', 'Edit Profile')   

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-12">
            @include('shared.left-sidebar')
        </div>
        <div class="col-lg-6 col-md-8 col-sm-12">
            @include('shared.success-message')
            <div class="mt-3">
                @include('users.shared.user-edit-card')
            </div>
            <hr>

           
            @forelse ($thoughts as $thought)
                <div class="mt-3">
                    @include('thoughts.shared.thought-card')
                </div>
            @empty
                <p class="text-center mt-4">No Results Found.</p>
            @endforelse

            <div class="mt-3">
                {{ $thoughts->withQueryString()->links() }}
            </div>
        </div>

        <div class="col-lg-3 col-md-12 col-sm-12">
            @include('shared.search-users-bar')
        </div>
    </div>
@endsection
