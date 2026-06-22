@extends('kafaa.layout.masterApp')

@section('pageTitle', 'ملفي الشخصي')
@section('pageDescription', 'حدّث بياناتك التي تظهر للزوار في صفحتك العامة')

@section('profileContent')
@php
    $avatar = $user->profile_image ? asset('storage/' . $user->profile_image) : asset('/client/img/profile.png');
@endphp
<div class="row m-1">
    <div class="col-12 p-2">
        <div class="card shade" style="border-radius:16px; border:1px solid rgba(137,44,220,0.1);">
            <div class="card-body p-4">
                <h4 style="font-weight:bold; color:#2d114e;"><i class="fas fa-id-card mr-2" style="color:#892CDC;"></i>تعديل الملف الشخصي</h4>
                <hr style="border-top:1px solid rgba(137,44,220,0.1);">

                @if (session('success'))
                    <div class="alert alert-success" style="border-radius:10px;">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger" style="border-radius:10px;">
                        <ul class="mb-0 pr-3">
                            @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('kafaa.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="text-center mb-4">
                        <img src="{{ $avatar }}" alt="{{ $user->name }}" id="avatarPreview"
                             style="width:110px; height:110px; border-radius:50%; object-fit:cover; border:3px solid #BC6FF1; box-shadow:0 8px 18px rgba(137,44,220,.2);">
                        <div class="mt-2">
                            <label for="profile_image" class="btn btn-sm text-white" style="background:linear-gradient(135deg,#892CDC,#BC6FF1); border:none; border-radius:8px; cursor:pointer;">
                                <i class="fas fa-camera mr-1"></i>تغيير الصورة
                            </label>
                            <input type="file" name="profile_image" id="profile_image" accept="image/*" class="d-none" onchange="previewAvatar(this)">
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="font-weight:bold; color:#4d3a7d;">الاسم <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" placeholder="اسمك الكامل">
                    </div>

                    <div class="form-group">
                        <label style="font-weight:bold; color:#4d3a7d;">التخصص</label>
                        <input type="text" name="specialty" class="form-control" value="{{ old('specialty', $user->specialty) }}" placeholder="مثال: مطوّر واجهات أمامية">
                        <small class="form-text text-muted">يظهر تحت اسمك في صفحتك العامة.</small>
                    </div>

                    <div class="form-group">
                        <label style="font-weight:bold; color:#4d3a7d;">النبذة التعريفية</label>
                        <textarea name="bio" class="form-control" rows="4" placeholder="عرّف بنفسك وخبراتك بإيجاز...">{{ old('bio', $user->bio) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label style="font-weight:bold; color:#4d3a7d;">رقم الهاتف</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" placeholder="مثال: 09xxxxxxxx">
                        </div>
                        <div class="col-md-6 form-group">
                            <label style="font-weight:bold; color:#4d3a7d;">الموقع / المدينة</label>
                            <input type="text" name="location" class="form-control" value="{{ old('location', $user->location) }}" placeholder="مثال: الرياض، السعودية">
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="font-weight:bold; color:#4d3a7d;">البريد الإلكتروني</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                        <small class="form-text text-muted">لا يمكن تغيير البريد الإلكتروني من هنا.</small>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn text-white" style="background:linear-gradient(135deg,#892CDC,#BC6FF1); border:none; border-radius:10px; font-weight:bold; padding:.6rem 2rem;">
                            <i class="fas fa-save mr-1"></i>حفظ التغييرات
                        </button>
                        <a href="{{ route('kafaa.show', $user->id) }}" target="_blank" class="btn btn-outline-primary mr-2" style="border-radius:10px; font-weight:bold; padding:.6rem 1.5rem;">
                            <i class="fas fa-eye mr-1"></i>معاينة صفحتي العامة
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => document.getElementById('avatarPreview').src = e.target.result;
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
