@extends('kafaa.layout.masterApp')

@section('pageTitle', isset($experience) ? 'تعديل خبرة' : 'خبرة جديدة')
@section('pageDescription', 'أضف خبراتك العملية إلى سيرتك الذاتية')

@section('addAndEditExperience')
@php
    $start = old('start_date', isset($experience->start_date) ? $experience->start_date->format('Y-m-d') : '');
    $end   = old('end_date', isset($experience->end_date) ? $experience->end_date->format('Y-m-d') : '');
    $isCurrent = old('is_current', $experience->is_current ?? false);
@endphp
<div class="row m-1">
    <div class="col-12 p-2">
        <div class="card shade" style="border-radius:16px; border:1px solid rgba(137,44,220,0.1);">
            <div class="card-body p-4">
                <h4 style="font-weight:bold; color:#2d114e;">
                    <i class="fas {{ isset($experience) ? 'fa-pen-to-square' : 'fa-circle-plus' }} mr-2" style="color:#892CDC;"></i>
                    {{ isset($experience) ? 'تعديل الخبرة' : 'إضافة خبرة جديدة' }}
                </h4>
                <hr style="border-top:1px solid rgba(137,44,220,0.1);">

                @if ($errors->any())
                    <div class="alert alert-danger" style="border-radius:10px;">
                        <ul class="mb-0 pr-3">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                <form action="{{ isset($experience) ? route('kafaa.experiences.update', $experience->id) : route('kafaa.experiences.store') }}" method="POST">
                    @csrf
                    @if (isset($experience)) @method('PUT') @endif

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label style="font-weight:bold; color:#4d3a7d;">المسمى الوظيفي <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" placeholder="مثال: مطوّر ويب" value="{{ old('title', $experience->title ?? '') }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label style="font-weight:bold; color:#4d3a7d;">الجهة / الشركة <span class="text-danger">*</span></label>
                            <input type="text" name="company" class="form-control" placeholder="مثال: شركة التقنية" value="{{ old('company', $experience->company ?? '') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label style="font-weight:bold; color:#4d3a7d;">تاريخ البداية <span class="text-danger">*</span></label>
                            <input type="date" name="start_date" class="form-control" value="{{ $start }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label style="font-weight:bold; color:#4d3a7d;">تاريخ النهاية</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $end }}" {{ $isCurrent ? 'disabled' : '' }}>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="is_current" value="1" class="custom-control-input" id="is_current" {{ $isCurrent ? 'checked' : '' }} onchange="document.getElementById('end_date').disabled = this.checked; if(this.checked) document.getElementById('end_date').value='';">
                            <label class="custom-control-label" for="is_current" style="color:#4d3a7d;">أعمل هنا حالياً</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="font-weight:bold; color:#4d3a7d;">الوصف</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="مهامك وإنجازاتك في هذه الوظيفة...">{{ old('description', $experience->description ?? '') }}</textarea>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn text-white" style="background:linear-gradient(135deg,#892CDC,#BC6FF1); border:none; border-radius:10px; font-weight:bold; padding:.6rem 2rem;">
                            <i class="fas fa-save mr-1"></i>{{ isset($experience) ? 'حفظ التعديلات' : 'إضافة الخبرة' }}
                        </button>
                        <a href="{{ route('kafaa.experiences.index') }}" class="btn btn-secondary mr-2" style="border-radius:10px; font-weight:bold; padding:.6rem 1.5rem;"><i class="fas fa-arrow-right mr-1"></i>رجوع</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
