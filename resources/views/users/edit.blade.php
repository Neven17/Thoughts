@extends('layout.layout')

@section('title', 'Edit Profile')   


@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
            <div class="col-6">
                @include('shared.success-message')
                <div class="mt-3">
                    @include('users.shared.user-edit-card')
                </div>
                <hr>

                @forelse ($thoughts as $thought)
                    {{-- Dodao ovaj odlomak da kada udes na svoj profil da ti dole izbaci sve tvoje objave--}}
                    {{-- thoughts iz dashboard controllera thoughts     dohvaca sve i izbacuje u preglednik --}}
                    <div class="mt-3">
                        @include('thoughts.shared.thought-card')
                    </div>
                @empty
                    <p class="text-center mt-4">No Results Found.</p>
                @endforelse

                <div class="mt-3">
                    {{ $thoughts->withQueryString()->links() }} {{--  PAGINATION(pretraga po nekoj rijeci) Dodajuci linkove dole on automatski stavlja tailwind css u providers/app mjenjam izgled --}}

                </div>




            </div>

            <div class="col-3">
           
                @include('shared.search-users-bar')
            </div>
        </div>
    @endsection
