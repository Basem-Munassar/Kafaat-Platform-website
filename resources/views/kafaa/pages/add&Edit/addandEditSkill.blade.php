@extends('kafaa.layout.masterApp')

@section('pageTitle', isset($skill) ? 'تعديل مهارة' : 'مهارة جديدة')
@section('pageDescription', 'أضف مهاراتك المهنية لعرضها في ملفك الشخصي')

@section('addAndEditSkill')
@php
    $levels = ['مبتدئ', 'متوسط', 'متقدم', 'خبير'];
    $categories = ['مهارات تقنية', 'مهارات شخصية', 'لغات برمجة', 'أدوات وبرامج', 'تصميم', 'إدارة'];
    $currentLevel = old('level', $skill->level ?? '');
    $currentCategory = old('category', $skill->category ?? '');
@endphp
<div class="row m-1">
    <div class="col-12 p-2">
        <div class="card shade" style="border-radius:16px; border:1px solid rgba(137,44,220,0.1);">
            <div class="card-body p-4">
                <h4 style="font-weight:bold; color:#2d114e;">
                    <i class="fas {{ isset($skill) ? 'fa-pen-to-square' : 'fa-circle-plus' }} mr-2" style="color:#892CDC;"></i>
                    {{ isset($skill) ? 'تعديل المهارة' : 'إضافة مهارة جديدة' }}
                </h4>
                <hr style="border-top:1px solid rgba(137,44,220,0.1);">

                @if ($errors->any())
                    <div class="alert alert-danger" style="border-radius:10px;">
                        <ul class="mb-0 pr-3">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                <form action="{{ isset($skill) ? route('kafaa.skills.update', $skill->id) : route('kafaa.skills.store') }}" method="POST">
                    @csrf
                    @if (isset($skill)) @method('PUT') @endif

                    <div class="form-group">
                        <label style="font-weight:bold; color:#4d3a7d;">اسم المهارة <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="مثال: تطوير واجهات React" value="{{ old('name', $skill->name ?? '') }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label style="font-weight:bold; color:#4d3a7d;">مستوى الإتقان <span class="text-danger">*</span></label>
                            <select name="level" class="form-control">
                                <option value="">— اختر المستوى —</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level }}" {{ $currentLevel == $level ? 'selected' : '' }}>{{ $level }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label style="font-weight:bold; color:#4d3a7d;">التصنيف</label>
                            <input type="text" name="category" class="form-control" list="categoryList"
                                   placeholder="مثال: مهارات تقنية" value="{{ $currentCategory }}">
                            <datalist id="categoryList">
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat }}">
                                @endforeach
                            </datalist>
                            <small class="form-text text-muted">اختياري — يُستخدم لتجميع المهارات المتشابهة معاً.</small>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn text-white" style="background:linear-gradient(135deg,#892CDC,#BC6FF1); border:none; border-radius:10px; font-weight:bold; padding:.6rem 2rem;">
                            <i class="fas fa-save mr-1"></i>{{ isset($skill) ? 'حفظ التعديلات' : 'إضافة المهارة' }}
                        </button>
                        <a href="{{ route('kafaa.skills.index') }}" class="btn btn-secondary mr-2" style="border-radius:10px; font-weight:bold; padding:.6rem 1.5rem;"><i class="fas fa-arrow-right mr-1"></i>رجوع</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
