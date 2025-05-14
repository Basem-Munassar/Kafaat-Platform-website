@extends('admin.layout.masterApp')
<!-- content -->
<!-- breadcrumb -->
@section('jobsTitle')
<div class="c-grey text-center col-3 ">
    <form action="{{ route('jobsTitles.create') }}" method="get">
        @csrf
        <button type="submit" class="btn flat f-first btn-block fnt-xxs ">Add New Job title</button>
    </form>
</div>
<br>
<hr>

@php
    $userRole = session('user_role');
    $userId = session('user_id');
@endphp

@foreach($jobTitles as $jobTitle)
    @if($userRole === 'admin' || ($userRole === 'user' && $jobTitle->user_id == $userId))
        <div class="row">
            <div class="col-xl-6 p-2">
                <div class="card flat c-white f-forth text-center">
                    <div class="card-header">
                        Job Title
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $jobTitle->title }}</h5>
                        <p class="card-text">{{ $jobTitle->description }}</p>
                        <a href="#" class="btn text-center f-white">more Information</a>
                    </div>
                    <div class="card-footer text-muted c-white">
                        {{ $jobTitle->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach 

@endsection
