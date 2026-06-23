@extends('admin.layout.masterApp')

@section('pageTitle', isset($project) ? 'تعديل مشروع' : 'إضافة مشروع')
@section('pageDescription', 'إدارة مشاريع السير الذاتية')

@section('addAndEditProject')
@php $userOptions = $users ?? \App\Models\User::orderBy('name')->get(); @endphp
<div class="apage-head">
    <h4 class="apage-title"><i class="fas fa-diagram-project mr-2"></i>{{ isset($project) ? 'تعديل مشروع' : 'إضافة مشروع جديد' }}</h4>
    <a href="{{ route('admin.projects.index') }}" class="abtn-cancel" style="text-decoration:none;"><i class="fas fa-arrow-right"></i> رجوع</a>
</div>

<div class="aform-card">
    <form action="{{ isset($project) ? route('admin.projects.update', $project->id) : route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @isset($project) @method('PUT') @endisset

        @if ($errors->any())
            <div class="alert alert-danger" style="border-radius:10px;">
                <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="text-center mb-4">
            <img id="projPreview" src="{{ isset($project) && $project->image ? asset('storage/' . $project->image) : asset('admin/img/user-profile.jpg') }}"
                 style="width:100%;max-width:280px;border-radius:12px;object-fit:cover;">
            <div class="mt-2">
                <label class="abtn-cancel" style="cursor:pointer;">
                    <i class="fas fa-image"></i> صورة المشروع
                    <input type="file" name="image" accept="image/*" hidden onchange="document.getElementById('projPreview').src=window.URL.createObjectURL(this.files[0])">
                </label>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>صاحب المشروع</label>
                <select name="user_id" class="form-control">
                    @foreach ($userOptions as $u)
                        <option value="{{ $u->id }}" {{ old('user_id', $project->user_id ?? '') == $u->id ? 'selected' : '' }}>{{ $u->name }} ({{ $u->email }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>عنوان المشروع</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $project->title ?? '') }}" placeholder="مثال: موقع شركة">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>التقنيات المستخدمة</label>
                <input type="text" name="technologies" class="form-control" value="{{ old('technologies', $project->technologies ?? '') }}" placeholder="Laravel, Vue, MySQL">
            </div>
            <div class="form-group col-md-6">
                <label>تاريخ المشروع</label>
                <input type="date" name="date" class="form-control" value="{{ old('date', $project->date ?? '') }}">
            </div>
        </div>

        <div class="form-group">
            <label>رابط المشروع</label>
            <input type="url" name="link" class="form-control" value="{{ old('link', $project->link ?? '') }}" placeholder="https://example.com">
        </div>

        <div class="form-group">
            <label>الوصف</label>
            <textarea name="description" class="form-control" rows="4" placeholder="وصف المشروع">{{ old('description', $project->description ?? '') }}</textarea>
        </div>

        <div class="text-left mt-3">
            <button type="submit" class="abtn-save"><i class="fas fa-save"></i> {{ isset($project) ? 'حفظ التعديلات' : 'إضافة المشروع' }}</button>
        </div>
    </form>
</div>
@endsection
