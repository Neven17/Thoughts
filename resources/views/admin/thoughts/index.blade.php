@extends('layout.layout')

@section('title', 'Thoughts | Admin Dashboard') 

@section('content')
    <div class="row">
        <div class="col-3">
            @include('admin.shared.left-sidebar')
        </div>
        <div class="col-9">
            <h1>Thoughts</h1>

            <table class="table table-striped mt-3">
                <thead class="table-dark">
                    <tr>

                        <th>ID</th>
                        <th>User</th>
                        <th>Content</th>
                        <th>Created At</th>
                        <th>#</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($thoughts as $thought)
                        
                    
                    <tr>

                        <td>{{$thought->id}}</td>
                        <td> <a href="{{ route('users.show', $thought->user) }}">{{ $thought->user->name }}</a></td>
                        <td>{{$thought->content}}</td>
                        <td>{{$thought->created_at->toDateString() }}</td>
                        <td>
                          <a href="{{route('thoughts.show', $thought->id)}}">Show
                            <a href="{{route('thoughts.edit', $thought->id)}}">Edit

                        </td>
                    </tr>
                    @endforeach
                </tbody>



            </table>
            <div>
                {{$thoughts->links()}}
            </div>
        </div>

    </div>

@endsection
