@extends('admin.layout.masterApp')
<!-- content -->
<!-- breadcrumb -->
@section('addAndEditUser')
    <!-- content -->
    <div class="row">
        <div class="page-header breadcrumb-header p-3 mr-2 ml-2 m-2">
            <div class="row align-items-end ">
                <div class="col-lg-8">
                    <div class="page-header-title text-left-rtl">
                        <div class="d-inline">
                            <h3 class="lite-text ">{{ isset($user) ? 'Edit User' : 'New User' }}</h3>
                            <span class="lite-text text-gray">{{ isset($user) ? 'Edit Existing User' : 'Add New User' }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="#"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item "><a href="#">Component</a></li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="jumbotron shade pt-5">
        <h1>{{ isset($user) ? 'Edit User' : 'New User' }}</h1>
        <!-- form -->
        <div class="row ">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">                
                <hr class="mt-0 mb-4">
                <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST" class="p-2" enctype="multipart/form-data">
                    @csrf
                    @if(isset($user))
                        @method('PUT')
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h4 class="c-grey  pt-3 pb-3">User image</h4>
                    <hr class="mt-0 mb-4">
                    <div class="custom-file">
                        <input type="file" name="profile_image" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose profile image</label>
                    </div>
                    @error('profile_image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                
                    <br class="mt-0 mb-4">
                    <br class="mt-0 mb-4">

                    <div class="form-group">
                        <label for="userName">User Name</label>
                        <input type="text" name="name" class="form-control" id="userName"
                            placeholder="Basem" value="{{ old('name', $user->name ?? '') }}">
                    </div>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <br class="mt-0 mb-4">

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="example@gmail.com" value="{{ old('email', $user->email ?? '') }}">
                    </div>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror                
                    <br class="mt-0 mb-4">

                    <div class="form-group">
                        <label for="phoneNubmer">Phone Number</label>
                        <input type="number" name="phone" class="form-control" id="phoneNubmer"
                            placeholder="77########" value="{{ old('phone', $user->phone ?? '') }}">
                    </div>
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror                
                    <br class="mt-0 mb-4">

                    @if(!isset($user))
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm password">
                                @error('password_confirmation')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <br class="mt-0 mb-4">

                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="location" class="form-control" id="location"
                            placeholder="" value="{{ old('location', $user->location ?? '') }}">
                    </div>
                    @error('location')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror                
                    <br class="mt-0 mb-4">

                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea class="form-control" name="bio" id="bio" rows="3">{{ old('bio', $user->bio ?? '') }}</textarea>
                    </div>
                    @error('bio')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                
                    
                    <div class="c-grey text-center col-3 ">
                        <button type="submit" class="btn flat f-first btn-block fnt-xxs ">{{ isset($user) ? 'Update' : 'Add' }}</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- end of form -->
@endsection
