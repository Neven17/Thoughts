

@extends('layout.layout')

@section('title', 'Dashboard')

@section('content')

    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-12">
            @include('shared.left-sidebar')
            @include('shared.follow-box')
        </div>
        <div class="col-lg-6 col-md-8 col-sm-12">
            @include('shared.error-message')
            @include('shared.success-message')
            @include('thoughts.shared.submit-thought')
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
            
            <div style="background-image: asset('storage/vijesti/onthisdayyyyS.jpg'); background-size: 100% 100%; background-position: center; background-repeat: no-repeat; padding: 5px; height: 407px; position: relative;">
                <div style="position: absolute; top: 20px; left: 20px; right: 0px; bottom: 20px; padding: 20px;">
                    <br><br><br>
                    <ul style="list-style-type: none; padding-top:6px;  padding-left: 0px;"> 
                        @if($todayInHistory)
                            @foreach($todayInHistory as $event)
                                <li style="margin-top: -6px;"> 
                                    <p style="font-size:12px; font-weight: bold; margin-bottom: 8px;">{{ $event }}</p> 
                                    
                                </li>
                                
                            @endforeach
                        @else
                            <p>Nema dostupnih povijesnih podataka za današnji dan.</p>
                        @endif
                    </ul>
                </div>
            </div>
            
          
            <div class="mt-4">
                @include('shared.search-users-bar')
            </div>
                
            
            <div class="mt-4">
                @include('shared.search-bar')
            </div>
        </div>
    </div>
    
@endsection

