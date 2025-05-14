@extends('admin.layout.masterApp')
<!-- content -->
<!-- breadcrumb -->
@section('languages')
<div class="c-grey text-center col-3 ">
    <form action="{{ route('languages.create') }}" method="get">
        @csrf
        <button type="submit" class="btn flat f-first btn-block fnt-xxs ">Add New language</button>
    </form>
</div>
<br>
<hr>

@foreach($languages as $language)
    <div class="row">
        <div class="col-xl-6 p-2">
            <div class="card flat c-white f-forth text-center">
                <div class="card-header">
                    Language
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $language->name }}</h5>
                    <p class="card-text">{{$language->level}}</p>
                    <p class="card-text">{{$language->category}}</p>
                    <div class="card-footer text-muted c-white">
                        <a href="{{ route('languages.edit', $language->id) }}" class="btn flat f-third btn-block fnt-xxs mb-2">Edit</a>
                        <a href="{{ route('languages.delete', $language->id) }}" class="btn flat f-forth btn-block fnt-xxs">Delete</a>
                    </div>                </div>
                <div class="card-footer text-muted c-white">
                    {{ $language->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
        
    </div>

@endforeach 

@endsection
