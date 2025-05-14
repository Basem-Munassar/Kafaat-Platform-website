@extends('admin.layout.masterApp')
<!-- content -->
<!-- breadcrumb -->
@section('projects')
<div class="c-grey text-center col-3 ">
    <form action="{{ route('projects.create') }}" method="get">
        @csrf
        <button type="submit" class="btn flat f-first btn-block fnt-xxs ">Add New Project</button>
    </form>
</div>
<br>
<hr>

<div class="row">
    
    @foreach($projects as $project)
<div class="col col-xl-3 col-md-6 col-sm-12 p-2">
<div class="card flat f-main mb-4">
    <img class="card-img-top" src="{{ asset('storage/' . $project->image) }}" alt="Project Image">

    <div class="card-body">
        <h5 class="card-title">{{ $project->title }}</h5>
        <p class="text-left">
            used class: <br>
            <span class="fnt-code c-primary">{{ $project->technologies }}</span>
        </p>
    </div>

    <ul class="list-group list-group-flush">
        <li class="list-group-item">Date: {{ $project->date }}</li>
        <li class="list-group-item">Description: {{ $project->description }}</li>
    </ul>

    <div class="card-body">
        <div class="c-grey text-center">
            <a href="{{ route('projects.edit', $project->id) }}" class="btn flat f-third btn-block fnt-xxs mb-2">Edit</a>
            <a href="{{ route('projects.delete', $project->id) }}" class="btn flat f-forth btn-block fnt-xxs">Delete</a>
        </div>    </div>
</div>
</div>

@endforeach
@endsection
