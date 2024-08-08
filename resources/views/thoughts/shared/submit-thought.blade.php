@auth
    <h4> {{ __('thoughts.login_to_share')}} </h4>  
    <div class="row ">
        <form action="{{ route('thoughts.store') }}" method="post">
            @csrf
            <div class="mb-3 ">
            <textarea class="form-control" id="content" name="content" rows="3">{{ old('content') }}</textarea>

                @error('content')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="">
                <button type="submit" class="btn btn-dark"> Share </button>
            </div>
        </form>
    </div>
@endauth
@guest
    <h4>{{ __('thoughts.login_to_share')}}</h4> 
@endguest
