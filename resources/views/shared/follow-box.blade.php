
<div class="card mt-3">
    <div class="card-header pb-0 border-0">
        <h5 class="">Our Users</h5>
    </div>
    <div class="card-body">
        @foreach (auth()->user()->followSuggestions() as $user)
            <div class="hstack gap-2 mb-3">
                <div class="avatar">
                    <a href="{{ route('users.show', $user->id) }}"><img style="width:50px;"
                            class="avatar-img rounded-circle" src="{{ $user->getImageURL() }}" alt=""></a>
                </div>
                <div class="overflow-hidden">
                    <a class="h6 mb-0" href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
                    <p class="mb-0 small text-truncate">{{ $user->email }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="card-footer text-center py-1" >
        <a class="btn btn-link btn-sm" style="font-weight: bold;font-size: 14px; text-decoration:none;"  href="{{route('all.users')}}">View More </a>
    </div>
</div>
