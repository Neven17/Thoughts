
<div class="card">
    <div class="card-header pb-0 border-0">
        <h5 class="">{{ __('search.user_search')}}</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('search.users') }}">
            <input value="{{request('searchUsers','')}}" name="searchUsers" placeholder="..." class="form-control w-100" type="text" minlength="3" required >    
            <button class="btn btn-dark mt-2"> Search</button>

            @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
        </form>
    </div>
</div>
