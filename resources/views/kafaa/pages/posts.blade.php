@extends('kafaa.layout.masterApp')

@section('pageTitle', 'منشوراتي / مقالاتي')
@section('pageDescription', 'إدارة مقالاتك ومنشوراتك')

@section('posts')

@foreach($posts as $post)
    <div class="row">
        <div class="col-xl-6 p-2">
            <div class="card flat c-white f-forth text-center">
                <div class="card-header">
                    Post
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->content }}</p>
                    <p class="card-text">{{ $post->date }}</p>
                    <form action="{{ route('kafaa.posts.delete', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" style="display:inline">@csrf @method('DELETE')<button type="submit" class="btn flat f-forth btn-block fnt-xxs">Delete</button></form>
                </div>
                <div class="card-footer text-muted c-white">
                    {{ $post->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
    </div>
@endforeach 

@endsection
