@extends('layout.layout')

@section('content')
<div class="container">
    <h2>All Notifications</h2>
    @foreach ($notifications as $notification)
        <div class="alert alert-info">
            <p>{{ $notification->data['message'] }}</p>
            <a href="{{ route('notifications.show', $notification->id) }}">Go to related item</a>
        </div>
    @endforeach
</div>
@endsection
