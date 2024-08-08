@extends('layout.layout')

@section('title', 'Cats')

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-4 col-12">
        @include('shared.left-sidebar')
    </div>
    <div class="col-lg-6 col-md-8 col-12">
        <div class="container mt-4 text-center">
            <h1 class="text-center">Cat Images</h1>
            <h4>Maximum: 20 pictures</h4>
            <p>Submit to get new pictures each time</p>
            <div class="row justify-content-center">
                <div class="col-md-8 col-12">
                    <form action="{{ route('cats.fetch') }}" method="POST" class="form-inline justify-content-center">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="number" class="form-control form-control-lg" id="limit" name="limit" placeholder="Enter number of images" required min="1" max="20">
                            <button class="btn btn-primary" type="submit">Get Cat Images</button>
                        </div>
                    </form>
                </div>
            </div>

            @if(isset($catImages))
                <div class="row mt-4 justify-content-center">
                    @foreach($catImages as $image)
                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                            <div class="card mx-auto" style="max-width: 20rem;">
                                <img src="{{ $image['url'] }}" class="card-img-top" alt="Cat Image">
                            </div>
                        </div>
                    @endforeach
                </div>
            @elseif(isset($error))
                <div class="mt-4 alert alert-danger">
                    {{ $error }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
