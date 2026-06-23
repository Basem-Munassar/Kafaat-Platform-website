@extends('admin.layout.masterApp')

@section('pageTitle', isset($skill) ? 'تعديل مهارة' : 'إضافة مهارة')
@section('pageDescription', 'إدارة المهارات في النظام')

@section('addAndEditSkill')
@php $userOptions = $users ?? \App\Models\User::orderBy('name')->get(); @endphp
<div class="apage-head">
    <h4 class="apage-title"><i class="fas fa-bolt mr-2"></i>{{ isset($skill) ? 'تعديل مهارة' : 'إضافة مهارة جديدة' }}</h4>
    <a href="{{ route('admin.skills.index') }}" class="abtn-cancel" style="text-decoration:none;"><i class="fas fa-arrow-right"></i> رجوع</a>
</div>

<div class="aform-card">
    <form action="{{ isset($skill) ? route('admin.skills.update', $skill->id) : route('admin.skills.store') }}" method="POST">
        @csrf
        @isset($skill) @method('PUT') @endisset

        @if ($errors->any())
            <div class="alert alert-danger" style="border-radius:10px;">
                <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>صاحب المهارة</label>
                <select name="user_id" class="form-control">
                    @foreach ($userOptions as $u)
                        <option value="{{ $u->id }}" {{ old('user_id', $skill->user_id ?? '') == $u->id ? 'selected' : '' }}>{{ $u->name }} ({{ $u->email }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>اسم المهارة</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $skill->name ?? '') }}" placeholder="مثال: Laravel">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>المستوى</label>
                <select name="level" class="form-control">
                    @foreach (['مبتدئ', 'متوسط', 'متقدم', 'خبير'] as $lvl)
                        <option value="{{ $lvl }}" {{ old('level', $skill->level ?? '') == $lvl ? 'selected' : '' }}>{{ $lvl }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>التصنيف (اختياري)</label>
                <input type="text" name="category" class="form-control" list="catList" value="{{ old('category', $skill->category ?? '') }}" placeholder="مهارات تقنية">
                <datalist id="catList">
                    <option value="مهارات تقنية"><option value="مهارات شخصية"><option value="لغات برمجة"><option value="أدوات وتصميم">
                </datalist>
            </div>
        </div>

        <div class="text-left mt-3">
            <button type="submit" class="abtn-save"><i class="fas fa-save"></i> {{ isset($skill) ? 'حفظ التعديلات' : 'إضافة المهارة' }}</button>
        </div>
    </form>
</div>
@endsection
