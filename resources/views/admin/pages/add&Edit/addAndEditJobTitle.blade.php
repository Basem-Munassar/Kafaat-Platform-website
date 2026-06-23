@extends('admin.layout.masterApp')

@section('pageTitle', isset($jobTitle) ? 'تعديل مسمى وظيفي' : 'إضافة مسمى وظيفي')
@section('pageDescription', 'إدارة المسميات الوظيفية في النظام')

@section('addAndEditJobTitle')
@php $userOptions = $users ?? \App\Models\User::orderBy('name')->get(); @endphp
<div class="apage-head">
    <h4 class="apage-title"><i class="fas fa-briefcase mr-2"></i>{{ isset($jobTitle) ? 'تعديل مسمى وظيفي' : 'إضافة مسمى وظيفي' }}</h4>
    <a href="{{ route('admin.jobsTitle.index') }}" class="abtn-cancel" style="text-decoration:none;"><i class="fas fa-arrow-right"></i> رجوع</a>
</div>

<div class="aform-card">
    <form action="{{ isset($jobTitle) ? route('admin.jobsTitle.update', $jobTitle->id) : route('admin.jobsTitle.store') }}" method="POST">
        @csrf
        @isset($jobTitle) @method('PUT') @endisset

        @if ($errors->any())
            <div class="alert alert-danger" style="border-radius:10px;">
                <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>صاحب المسمى</label>
                <select name="user_id" class="form-control">
                    @foreach ($userOptions as $u)
                        <option value="{{ $u->id }}" {{ old('user_id', $jobTitle->user_id ?? '') == $u->id ? 'selected' : '' }}>{{ $u->name }} ({{ $u->email }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>المسمى الوظيفي</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $jobTitle->title ?? '') }}" placeholder="مطوّر ويب">
            </div>
        </div>

        <div class="form-group">
            <label>الوصف</label>
            <textarea name="description" class="form-control" rows="4" placeholder="وصف المسمى الوظيفي">{{ old('description', $jobTitle->description ?? '') }}</textarea>
        </div>

        <div class="text-left mt-3">
            <button type="submit" class="abtn-save"><i class="fas fa-save"></i> {{ isset($jobTitle) ? 'حفظ التعديلات' : 'إضافة المسمى' }}</button>
        </div>
    </form>
</div>
@endsection
