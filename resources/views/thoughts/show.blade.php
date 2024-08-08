@extends('layout.layout')

@section('title', 'View Thought')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-lg-6">
            @include('shared.success-message')

            <hr>

            <div class="mt-3">
                @include('thoughts.shared.thought-card')
            </div>
        </div>
        <div class="col-lg-3">
            @include('shared.search-bar')
            @include('shared.search-users-bar')
            @include('shared.follow-box')
        </div>
    </div>
</div>
@endsection
