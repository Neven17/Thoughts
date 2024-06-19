@extends('layout.layout')

@section('title', 'Dashboard')

@section('content')

    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
            @include('shared.follow-box')
        </div>
        <div class="col-6">
            @include('shared.success-message')
            @include('thoughts.shared.submit-thought')
            <hr>
           
            {{-- Foreach petlja za prikazivanje misli --}}
            
            @forelse ($thoughts as $thought)
                <div class="mt-3">
                    @include('thoughts.shared.thought-card')
                </div>
            @empty
                <p class="text-center mt-4">No Results Found.</p> 
            @endforelse
           

            {{-- Paginacija --}}
            <div class="mt-3">
                {{ $thoughts->withQueryString()->links() }}
            </div>

        </div>
        <div class="col-3">
            {{-- Prikaz povijesnih događaja kao liste --}}
            <div style="background-image: url('/storage/vijesti/onthisdayyyyy.jpg'); background-size: 100% 100%; background-position: center; background-repeat: no-repeat; padding: 5px; width:auto; height: 407px; position: relative;">
                <div style="position: absolute; top: 20px; left: 20px; right: 20px; bottom: 20px; padding: 20px;">
                    <br><br><br>
                    <ul style="list-style-type: none; padding-top:9px;"> 
                        @if($todayInHistory)
                            @foreach($todayInHistory as $event)
                                <li style="margin-top: 15px;"> <!-- Svaki događaj će biti <li> element -->
                                    <p style="font-size:12px; font-weight: bold; margin-bottom: 8px;">{{ $event }}</p> 
                                </li>

                                
                            @endforeach
                        @else
                            <p>Nema dostupnih povijesnih podataka za današnji dan.</p>
                        @endif
                    </ul>
                </div>
            </div>
            
            {{-- Pretraga misli --}}
            <div class="mt-4">
                @include('shared.search-users-bar')
                </div>
                
                {{-- Pretraga korisnika --}}
                <div class="mt-4">
                @include('shared.search-bar')
            </div>
        </div>
    </div>
    
@endsection