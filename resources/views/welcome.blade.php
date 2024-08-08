
@extends('layout.welcome')

@section('title', 'Welcome')

@section('content')

    <div class="row justify-content-center">
        <div class="col-8 text-center">
            <h1 class="mt-5">{{ __('welcome.welcome_to_thoughts')}}</h1>
            <p class="lead mt-3">{{__('welcome.join_us')}}</p>
            
            @guest
                <div class="mt-4">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg mx-2">Log In</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary btn-lg mx-2">Register</a>
                </div>
            @else
                <div class="mt-4">
                    <a href="{{ route('dashboard') }}" class="btn btn-success btn-lg">Go to Dashboard</a>
                </div>
            @endguest
        </div>
    </div>

@endsection

