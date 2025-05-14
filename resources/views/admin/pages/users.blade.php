@extends('admin.layout.masterApp')
<!-- content -->
<!-- breadcrumb -->
@section('users')
<div class="c-grey text-center col-3 ">
    <form action="{{ route('users.create') }}" method="get">
        @csrf
        <button type="submit" class="btn flat f-first btn-block fnt-xxs ">Add New User</button>
    </form>
</div>
<br>
<hr>

<div class="col-12 p-2">
    <div class="card shade h-100">
        <div class="card-body">
            <h5 class="card-title">Users</h5>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Profile Image</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Location</th>
                            <th scope="col">actions</th>
                            
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <th scope="col">{{ $user->id }}</th>
                        <th scope="col"> 
                            <img class="rounded-circle" src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" style="width: 75px; height: 80px; object-fit: cover;">
                        </th>
                        <th scope="col">{{ $user->name }}</th>
                        <th scope="col">{{ $user->email }}</th>
                        <th scope="col">{{ $user->phone }}</th>
                        <th scope="col">{{ $user->location }}</th>
                        <th scope="col">
                            <div class="c-grey text-center">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn flat f-third btn-block fnt-xxs mb-2">Edit</a>
                                <a href="{{ route('users.delete', $user->id) }}" class="btn flat f-forth btn-block fnt-xxs">Delete</a>
                            </div>
                        </th>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
