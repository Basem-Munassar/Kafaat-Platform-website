@extends('kafaa.layout.masterApp')

@section('pageTitle', 'مسمياتي الوظيفية')
@section('pageDescription', 'إدارة المسميات الوظيفية الخاصة بك في السيرة الذاتية')

@section('jobsTitle')
<div class="c-grey text-center col-3 ">
    <form action="{{ route('kafaa.jobsTitle.create') }}" method="get">
        @csrf
        <button type="submit" class="btn flat f-first btn-block fnt-xxs ">Add New Job title</button>
    </form>
</div>
<br>
<hr>

@foreach($jobTitles as $jobTitle)
    <div class="row">
        <div class="col-xl-6 p-2">
            <div class="card flat c-white f-forth text-center">
                <div class="card-header">
                    Job Title
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $jobTitle->title }}</h5>
                    <p class="card-text">{{ $jobTitle->description }}</p>
                    <a href="{{ route('kafaa.jobsTitle.edit', $jobTitle->id) }}" class="btn flat f-third btn-block fnt-xxs mb-2">Edit</a>
                    <form action="{{ route('kafaa.jobsTitle.delete', $jobTitle->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" style="display:inline">@csrf @method('DELETE')<button type="submit" class="btn flat f-forth btn-block fnt-xxs">Delete</button></form>
                </div>
                <div class="card-footer text-muted c-white">
                    {{ $jobTitle->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
    </div>
@endforeach 

@endsection
