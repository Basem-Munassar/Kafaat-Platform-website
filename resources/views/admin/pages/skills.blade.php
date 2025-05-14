@extends('admin.layout.masterApp')
<!-- content -->
<!-- breadcrumb -->
@section('skills')
<div class="c-grey text-center col-3 ">
    <form action="{{ route('skills.create') }}" method="get">
        @csrf
        <button type="submit" class="btn flat f-first btn-block fnt-xxs ">Add New Skill</button>
    </form>
</div>
<br>
<hr>

@foreach($skills as $skill)
    <div class="row">
        <div class="col-xl-6 p-2">
            <div class="card flat c-white f-forth text-center">
                <div class="card-header">
                    Skill
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $skill->name }}</h5>
                    <p class="card-text">{{$skill->level}}</p>
                    <p class="card-text">{{$skill->category}}</p>
                    <a href="#" class="btn text-center f-white">more Information</a>
                </div>
                <div class="card-footer text-muted c-white">
                    {{ $skill->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
        
    </div>

@endforeach 

@endsection
