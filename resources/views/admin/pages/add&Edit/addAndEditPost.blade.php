@extends('admin.layout.masterApp')

@section('pageTitle', isset($post) ? 'تعديل منشور' : 'كتابة منشور')
@section('pageDescription', 'إدارة المقالات والمنشورات')

@section('addAndEditPost')
<div class="apage-head">
    <h4 class="apage-title"><i class="fas fa-newspaper mr-2"></i>{{ isset($post) ? 'تعديل منشور' : 'كتابة منشور جديد' }}</h4>
    <a href="{{ route('admin.posts.index') }}" class="abtn-cancel" style="text-decoration:none;"><i class="fas fa-arrow-right"></i> رجوع</a>
</div>

<div class="aform-card">
    <form action="{{ isset($post) ? route('admin.posts.update', $post->id) : route('admin.posts.store') }}" method="POST">
        @csrf
        @isset($post) @method('PUT') @endisset

        @if ($errors->any())
            <div class="alert alert-danger" style="border-radius:10px;">
                <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="form-group">
            <label>عنوان المنشور</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $post->title ?? '') }}" placeholder="عنوان المقال">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>اسم الكاتب (اختياري)</label>
                <input type="text" name="posterName" class="form-control" value="{{ old('posterName', $post->posterName ?? '') }}" placeholder="اسم الكاتب">
            </div>
            <div class="form-group col-md-3">
                <label>بريد الكاتب (اختياري)</label>
                <input type="email" name="posterEmail" class="form-control" value="{{ old('posterEmail', $post->posterEmail ?? '') }}" placeholder="email@mail.com">
            </div>
            <div class="form-group col-md-3">
                <label>التاريخ</label>
                <input type="date" name="date" class="form-control" value="{{ old('date', $post->date ?? '') }}">
            </div>
        </div>

        <div class="form-group">
            <label>المحتوى</label>
            <textarea name="content" class="form-control" rows="9" placeholder="اكتب محتوى المقال هنا...">{{ old('content', $post->content ?? '') }}</textarea>
        </div>

        <div class="text-left mt-3">
            <button type="submit" class="abtn-save"><i class="fas fa-save"></i> {{ isset($post) ? 'حفظ التعديلات' : 'نشر المقال' }}</button>
        </div>
    </form>
</div>
@endsection
