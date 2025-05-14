@extends('admin.layout.masterApp')
<!-- content -->
<!-- breadcrumb -->
@section('addAndEditProject')
    <!-- content -->
    <div class="row">
        <div class="page-header breadcrumb-header p-3 mr-2 ml-2 m-2">
            <div class="row align-items-end ">
                <div class="col-lg-8">
                    <div class="page-header-title text-left-rtl">
                        <div class="d-inline">
                            <h3 class="lite-text ">{{ isset($project) ? 'Edit Project' : 'New Project' }}</h3>
                            <span class="lite-text text-gray">{{ isset($project) ? 'Edit your project details' : 'Add New Project to your CV' }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="#"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item "><a href="#">Component</a></li>
                        <li class="breadcrumb-item active">Project</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="jumbotron shade pt-5">
        <h1>{{ isset($project) ? 'Edit Project' : 'New Project' }}</h1>
        <!-- form -->
        <div class="row ">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">                
                <hr class="mt-0 mb-4">
                <form action="{{ isset($project) ? route('projects.update', $project->id) : route('projects.store') }}" method="POST" class="p-2" enctype="multipart/form-data">
                    @csrf
                    @if(isset($project))
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

                    <h4 class="c-grey  pt-3 pb-3">Project Image</h4>
                    <hr class="mt-0 mb-4">
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose image</label>
                    </div>
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                
                    <br class="mt-0 mb-4">
                    <br class="mt-0 mb-4">

                    <div class="form-group">
                        <label for="ProjectTitle">Project Title</label>
                        <input type="text" name="title" class="form-control" id="ProjectTitle"
                            placeholder="website project" value="{{ old('title', $project->title ?? '') }}">
                    </div>
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                
                    <br class="mt-0 mb-4">

                    <div class="form-group">
                        <label for="date">Project Date</label>
                        <input type="date" name="date" class="form-control" id="date"
                            placeholder="website project" value="{{ old('date', $project->date ?? '') }}">
                    </div>
                    @error('date')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                
                    <br class="mt-0 mb-4">

                    <div class="form-group">
                        <label for="technologies">Technologies</label>
                        <select class="form-control" name="technologies" id="technologies">
                            <option value="">Select one</option>
                            <option value="1" {{ old('technologies', $project->technologies ?? '') == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('technologies', $project->technologies ?? '') == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('technologies', $project->technologies ?? '') == '3' ? 'selected' : '' }}>3</option>
                            <option value="4" {{ old('technologies', $project->technologies ?? '') == '4' ? 'selected' : '' }}>4</option>
                            <option value="5" {{ old('technologies', $project->technologies ?? '') == '5' ? 'selected' : '' }}>5</option>
                        </select>
                    </div>
                    @error('technologies')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                
                    <br class="mt-0 mb-4">
                    <div class="form-group">
                        <label for="linkProject">Link of the Project</label>
                        <input type="text" name="link" class="form-control" id="linkProject"
                            placeholder="website project" value="{{ old('link', $project->link ?? '') }}">
                    </div>
                    @error('link')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                
                    <br class="mt-0 mb-4">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3">{{ old('description', $project->description ?? '') }}</textarea>
                    </div>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                
                    <div class="c-grey text-center col-3 ">
                        <button type="submit" class="btn flat f-first btn-block fnt-xxs ">{{ isset($project) ? 'Update' : 'Add' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end of form -->
    
@endsection
