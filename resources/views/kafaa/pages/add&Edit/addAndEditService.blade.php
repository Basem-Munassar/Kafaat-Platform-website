@extends('kafaa.layout.masterApp')

@section('pageTitle', isset($service) ? 'تعديل خدمة' : 'خدمة جديدة')
@section('pageDescription', 'أضف الخدمات التي تقدّمها لعملائك')

@section('addAndEditService')
@php
    $icons = [
        'bx-palette'     => 'تصميم',
        'bx-code-alt'    => 'برمجة',
        'bx-mobile-alt'  => 'تطبيقات جوال',
        'bx-desktop'     => 'تطوير ويب',
        'bx-line-chart'  => 'تسويق / تحليلات',
        'bx-pen'         => 'كتابة محتوى',
        'bx-camera'      => 'تصوير',
        'bx-cog'         => 'حلول تقنية',
        'bx-support'     => 'دعم واستشارات',
        'bx-bulb'        => 'استشارات',
    ];
    $currentIcon = old('icon', $service->icon ?? 'bx-briefcase');
@endphp
<div class="row m-1">
    <div class="col-12 p-2">
        <div class="card shade" style="border-radius:16px; border:1px solid rgba(137,44,220,0.1);">
            <div class="card-body p-4">
                <h4 style="font-weight:bold; color:#2d114e;">
                    <i class="fas {{ isset($service) ? 'fa-pen-to-square' : 'fa-circle-plus' }} mr-2" style="color:#892CDC;"></i>
                    {{ isset($service) ? 'تعديل الخدمة' : 'إضافة خدمة جديدة' }}
                </h4>
                <hr style="border-top:1px solid rgba(137,44,220,0.1);">

                @if ($errors->any())
                    <div class="alert alert-danger" style="border-radius:10px;">
                        <ul class="mb-0 pr-3">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                <form action="{{ isset($service) ? route('kafaa.services.update', $service->id) : route('kafaa.services.store') }}" method="POST">
                    @csrf
                    @if (isset($service)) @method('PUT') @endif

                    <div class="form-group">
                        <label style="font-weight:bold; color:#4d3a7d;">عنوان الخدمة <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" placeholder="مثال: تصميم واجهات UI/UX" value="{{ old('title', $service->title ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label style="font-weight:bold; color:#4d3a7d;">الأيقونة</label>
                        <div class="d-flex flex-wrap gap-2" id="iconPicker">
                            @foreach ($icons as $iconClass => $iconLabel)
                                <label class="icon-option" style="cursor:pointer; text-align:center;">
                                    <input type="radio" name="icon" value="{{ $iconClass }}" class="d-none" {{ $currentIcon == $iconClass ? 'checked' : '' }}>
                                    <span class="icon-box" style="display:flex; flex-direction:column; align-items:center; justify-content:center; width:80px; height:80px; border-radius:12px; border:2px solid {{ $currentIcon == $iconClass ? '#892CDC' : 'rgba(137,44,220,0.15)' }}; background:{{ $currentIcon == $iconClass ? 'rgba(137,44,220,0.08)' : '#fff' }}; margin:.25rem;">
                                        <i class='bx {{ $iconClass }}' style="font-size:1.6rem; color:#892CDC;"></i>
                                        <small style="font-size:.65rem; color:#7c6a9c; margin-top:.2rem;">{{ $iconLabel }}</small>
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="font-weight:bold; color:#4d3a7d;">وصف الخدمة <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control" rows="4" placeholder="اشرح ما تقدّمه في هذه الخدمة...">{{ old('description', $service->description ?? '') }}</textarea>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn text-white" style="background:linear-gradient(135deg,#892CDC,#BC6FF1); border:none; border-radius:10px; font-weight:bold; padding:.6rem 2rem;">
                            <i class="fas fa-save mr-1"></i>{{ isset($service) ? 'حفظ التعديلات' : 'إضافة الخدمة' }}
                        </button>
                        <a href="{{ route('kafaa.services.index') }}" class="btn btn-secondary mr-2" style="border-radius:10px; font-weight:bold; padding:.6rem 1.5rem;"><i class="fas fa-arrow-right mr-1"></i>رجوع</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('#iconPicker input[type=radio]').forEach(function (radio) {
        radio.addEventListener('change', function () {
            document.querySelectorAll('#iconPicker .icon-box').forEach(function (box) {
                box.style.border = '2px solid rgba(137,44,220,0.15)';
                box.style.background = '#fff';
            });
            var box = this.nextElementSibling;
            box.style.border = '2px solid #892CDC';
            box.style.background = 'rgba(137,44,220,0.08)';
        });
    });
</script>
@endsection
