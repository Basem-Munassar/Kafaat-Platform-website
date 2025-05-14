@extends('admin.layout.masterApp')
<!-- content -->
<!-- breadcrumb -->
@section('addAndEditSkill')
    <!-- content -->
    <div class="row">
        <div class="page-header breadcrumb-header p-3 mr-2 ml-2 m-2">
            <div class="row align-items-end ">
                <div class="col-lg-8">
                    <div class="page-header-title text-left-rtl">
                        <div class="d-inline">
                            <h3 class="lite-text ">{{ isset($skill) ? 'Edit Skill' : 'New Skill' }}</h3>
                            <span class="lite-text text-gray">{{ isset($skill) ? 'Edit the skill in your CV' : 'Add New Skill to your CV' }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="#"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item "><a href="#">Component</a></li>
                        <li class="breadcrumb-item active">Skill Name</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="jumbotron shade pt-5">
        <h1>{{ isset($skill) ? 'Edit Skill' : 'New Skill' }}</h1>
        <!-- form -->
        <div class="row ">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">                
                <hr class="mt-0 mb-4">
                <form action="{{ isset($skill) ? route('skill.update', $skill->id) : route('skills.store') }}" method="POST" class="p-2">
                    @csrf
                    @if (isset($skill))
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
                        <label for="skillName">Skill Name</label>
                        <input type="text" name="name" class="form-control" id="skillName"
                            placeholder="solve problem" value="{{ old('name', $skill->name ?? '') }}">
                    </div>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                
                    <br class="mt-0 mb-4">

                    <div class="form-group">
                        <label for="skillLevel">Skill Level</label>
                        <input type="text" name="level" class="form-control" id="skillLevel"
                            placeholder="professional" value="{{ old('level', $skill->level ?? '') }}">
                    </div>
                    @error('level')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <div class="form-group">
                        <label for="skillCategory">Category</label>
                        <select class="form-control" name="category" id="skillCategory">
                            <option value="">Select one</option>
                            <option value="1" {{ old('category', $skill->category ?? '') == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('category', $skill->category ?? '') == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('category', $skill->category ?? '') == '3' ? 'selected' : '' }}>3</option>
                            <option value="4" {{ old('category', $skill->category ?? '') == '4' ? 'selected' : '' }}>4</option>
                            <option value="5" {{ old('category', $skill->category ?? '') == '5' ? 'selected' : '' }}>5</option>
                        </select>
                    </div>
                    @error('category')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <br class="mt-0 mb-4">
                    <div class="c-grey text-center col-3 ">
                        <button type="submit" class="btn flat f-first btn-block fnt-xxs ">
                            {{ isset($skill) ? 'Update' : 'Add' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end of form -->
@endsection
