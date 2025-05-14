@extends('admin.layout.masterApp')
<!-- content -->
<!-- breadcrumb -->
@section('addAndEditLanguage')
    <!-- content -->
    <div class="row">
        <div class="page-header breadcrumb-header p-3 mr-2 ml-2 m-2">
            <div class="row align-items-end ">
                <div class="col-lg-8">
                    <div class="page-header-title text-left-rtl">
                        <div class="d-inline">
                            <h3 class="lite-text ">{{ isset($language) ? 'Edit Language' : 'New Language' }}</h3>
                            <span class="lite-text text-gray">{{ isset($language) ? 'Edit the language in your CV' : 'Add New Language to your CV' }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="#"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item "><a href="#">{{ isset($language) ? 'edit' : 'add' }}</a></li>
                        <li class="breadcrumb-item active">Language</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="jumbotron shade pt-5">
        <h1>{{ isset($language) ? 'Edit Language' : 'New Language' }}</h1>
        <!-- form -->
        <div class="row ">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">                
                <hr class="mt-0 mb-4">
                <form action="{{ isset($language) ? route('languages.update', $language->id) : route('languages.store') }}" method="POST" class="p-2">
                    @csrf
                    @if(isset($language))
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
                        <label for="languageName">Language Name</label>
                        <input type="text" name="language" class="form-control" id="languageName"
                            placeholder="English" value="{{ old('language', $language->language ?? '') }}">
                    </div>
                    @error('language')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                
                    <br class="mt-0 mb-4">

                    <div class="form-group">
                        <label for="languageLevel">Language Level</label>
                        <input type="text" name="level" class="form-control" id="languageLevel"
                            placeholder="Professional" value="{{ old('level', $language->level ?? '') }}">
                    </div>
                    @error('level')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <br class="mt-0 mb-4">
                    <div class="c-grey text-center col-3 ">
                        <button type="submit" class="btn flat f-first btn-block fnt-xxs ">{{ isset($language) ? 'Update' : 'Add' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end of form -->
@endsection
