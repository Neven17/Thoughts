@extends('layout.layout')


@section('content')
<div class="container">
    <h2>Notification Detail</h2>

    <div class="alert alert-info">
        <p>{{ $notification->data['message'] }}</p>
        <p>You are being redirected to the related item...</p>
    </div>
</div>
@endsection