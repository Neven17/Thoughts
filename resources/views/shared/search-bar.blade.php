
<div class="card">
    <div class="card-header pb-0 border-0">
        <h5 class="">{{ __('search.search_thoughts')}}</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('search.content') }}">
            <input value="{{request('searchContent','')}}" name="search" placeholder="..." class="form-control w-100" type="text" minlength="1" required >    
            <button class="btn btn-dark mt-2"> Search</button>
        </form>
    </div>
</div>
