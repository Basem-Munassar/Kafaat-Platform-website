@extends('admin.layout.masterApp')

@section('pageTitle', isset($language) ? 'تعديل لغة' : 'إضافة لغة')
@section('pageDescription', 'إدارة اللغات في النظام')

@section('addAndEditLanguage')
@php $userOptions = $users ?? \App\Models\User::orderBy('name')->get(); @endphp
<div class="apage-head">
    <h4 class="apage-title"><i class="fas fa-language mr-2"></i>{{ isset($language) ? 'تعديل لغة' : 'إضافة لغة جديدة' }}</h4>
    <a href="{{ route('admin.languages.index') }}" class="abtn-cancel" style="text-decoration:none;"><i class="fas fa-arrow-right"></i> رجوع</a>
</div>

<div class="aform-card">
    <form action="{{ isset($language) ? route('admin.languages.update', $language->id) : route('admin.languages.store') }}" method="POST">
        @csrf
        @isset($language) @method('PUT') @endisset

        @if ($errors->any())
            <div class="alert alert-danger" style="border-radius:10px;">
                <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="form-row">
            <div class="form-group col-md-4">
                <label>صاحب اللغة</label>
                <select name="user_id" class="form-control">
                    @foreach ($userOptions as $u)
                        <option value="{{ $u->id }}" {{ old('user_id', $language->user_id ?? '') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>اللغة</label>
                <input type="text" name="language" class="form-control" value="{{ old('language', $language->language ?? '') }}" placeholder="العربية">
            </div>
            <div class="form-group col-md-4">
                <label>المستوى</label>
                <select name="level" class="form-control">
                    @foreach (['مبتدئ', 'متوسط', 'متقدم', 'بطلاقة', 'اللغة الأم'] as $lvl)
                        <option value="{{ $lvl }}" {{ old('level', $language->level ?? '') == $lvl ? 'selected' : '' }}>{{ $lvl }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="text-left mt-3">
            <button type="submit" class="abtn-save"><i class="fas fa-save"></i> {{ isset($language) ? 'حفظ التعديلات' : 'إضافة اللغة' }}</button>
        </div>
    </form>
</div>
@endsection
