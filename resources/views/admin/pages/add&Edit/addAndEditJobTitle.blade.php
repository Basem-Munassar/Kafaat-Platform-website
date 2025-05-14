@extends('admin.layout.masterApp')
<!-- content -->
<!-- breadcrumb -->
@section('addAndEditJobTitle')
    <!-- content -->
    <div class="row">
        <div class="page-header breadcrumb-header p-3 mr-2 ml-2 m-2">
            <div class="row align-items-end ">
                <div class="col-lg-8">
                    <div class="page-header-title text-left-rtl">
                        <div class="d-inline">
                            <h3 class="lite-text ">{{ isset($jobTitle) ? 'Edit Job Title' : 'New Job Title' }}</h3>
                            <span class="lite-text text-gray">{{ isset($jobTitle) ? 'Edit the Job Title in your CV' : 'Add New Job Title to your CV' }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="#"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item "><a href="#">Component</a></li>
                        <li class="breadcrumb-item active">Job Title</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="jumbotron shade pt-5">
        <h1>{{ isset($jobTitle) ? 'Edit Job Title' : 'New Job Title' }}</h1>
        <!-- form -->
        <div class="row ">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">                
                <hr class="mt-0 mb-4">
                <form action="{{ isset($jobTitle) ? route('jobsTitles.update', $jobTitle->id) : route('jobsTitles.store') }}" method="POST" class="p-2">
                    @csrf
                    @if(isset($jobTitle))
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

                    <input type="hidden" name="user_id" value="{{ session('user_id') ?? auth()->id() }}">
                    
                    <div class="form-group">
                        <label for="jobTitle">Job Title</label>
                        <input type="text" name="title" class="form-control" id="jobTitle"
                            placeholder="website project" value="{{ old('title', $jobTitle->title ?? '') }}">
                    </div>
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                
                    <br class="mt-0 mb-4">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3">{{ old('description', $jobTitle->description ?? '') }}</textarea>
                    </div>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                
                    <div class="c-grey text-center col-3 ">
                        <button type="submit" class="btn flat f-first btn-block fnt-xxs ">{{ isset($jobTitle) ? 'Update' : 'Add' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end of form -->
@endsection
