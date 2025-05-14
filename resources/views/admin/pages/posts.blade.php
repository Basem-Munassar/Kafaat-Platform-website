@extends('admin.layout.masterApp')
<!-- content -->
<!-- breadcrumb -->
@section('skills')

@foreach($posts as $post)
    <div class="row">
        <div class="col-xl-6 p-2">
            <div class="card flat c-white f-forth text-center">
                <div class="card-header">
                    post
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $post->name }}</h5>
                    <p class="card-text">{{$post->content}}</p>
                    <p class="card-text">{{$post->date}}</p>
                    <a href="#" class="btn text-center f-white">more Information</a>
                </div>
                <div class="card-footer text-muted c-white">
                    {{ $post->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
        
    </div>

@endforeach 

@endsection
