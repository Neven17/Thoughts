<div class="card">
    <div class="px-3 pt-4 pb-2">
        <form enctype="multipart/form-data" method="POST" action="{{ route('users.update', $user->id) }}">
            
            @csrf
            @method('put')
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:150px" class="me-3 avatar-sm rounded-circle" src="{{ $user->getImageURL() }}"
                        alt="{{ $user->name }}">
                    <div>
                        <input name="name" value="{{ $user->name }}" type="text" class="form-control">
                        @error('name')
                            <span class="text-danger fs-6">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>
                <div>
                    @auth
                        @if (Auth::id() === $user->id)
                           
                            <a href="{{ route('users.show', $user->id) }}" style="text-decoration: none;">View</a>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="mt-4">
                <label for="">Profile Picture</label>
                <input class="form-control" name="image" type="file">
                @error('image')
                    <span class="text-danger fs-6">{{ $message }}</span> 
                @enderror
            </div>
            <div class="px-2 mt-4">
                <h5 class="fs-5"> Bio : </h5>
                <div class="mb-3">
                    <textarea class="form-control" id="bio" name="bio" rows="3" maxlength="700">{{ $user->bio }}</textarea>
                    @error('bio')
                        <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <button class="btn btn-dark btn-sm mb-3">Save</button>
            </div>
        </form>
        @auth()
                    @can('delete', $user)
            <div class="mt-1 d-flex justify-content-end">
                <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete Profile</button>
                </form>
            </div>
            @include('users.shared.user-stats')
            @endcan
       @endauth
    </div>
</div>

