@extends('admin.layout.masterApp')

@section('pageTitle', isset($user) ? 'تعديل مستخدم' : 'إضافة مستخدم')
@section('pageDescription', 'إدارة بيانات الحساب والصلاحيات')

@section('addAndEditUser')
<div class="apage-head">
    <h4 class="apage-title"><i class="fas fa-user-gear mr-2"></i>{{ isset($user) ? 'تعديل مستخدم' : 'إضافة مستخدم جديد' }}</h4>
    <a href="{{ route('admin.users.index') }}" class="abtn-cancel" style="text-decoration:none;"><i class="fas fa-arrow-right"></i> رجوع</a>
</div>

<div class="aform-card">
    <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @isset($user) @method('PUT') @endisset

        @if ($errors->any())
            <div class="alert alert-danger" style="border-radius:10px;">
                <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="text-center mb-4">
            <img id="avatarPreview" src="{{ isset($user) && $user->profile_image ? asset('storage/' . $user->profile_image) : asset('admin/img/user-profile.jpg') }}"
                 style="width:110px;height:110px;border-radius:50%;object-fit:cover;border:3px solid #BC6FF1;">
            <div class="mt-2">
                <label class="abtn-cancel" style="cursor:pointer;">
                    <i class="fas fa-camera"></i> اختيار صورة
                    <input type="file" name="profile_image" accept="image/*" hidden onchange="document.getElementById('avatarPreview').src=window.URL.createObjectURL(this.files[0])">
                </label>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>الاسم</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" placeholder="اسم المستخدم">
            </div>
            <div class="form-group col-md-6">
                <label>البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" placeholder="example@mail.com">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>الدور (الصلاحية)</label>
                <select name="role" class="form-control">
                    @foreach (['user' => 'مستخدم عادي', 'admin' => 'مسؤول', 'super admin' => 'مسؤول أعلى'] as $val => $lbl)
                        <option value="{{ $val }}" {{ old('role', $user->role ?? 'user') == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>نوع الحساب</label>
                <select name="account_type" class="form-control">
                    @foreach (['user' => 'مستخدم', 'kafaa' => 'كفاءة', 'employee' => 'موظف'] as $val => $lbl)
                        <option value="{{ $val }}" {{ old('account_type', $user->account_type ?? 'user') == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>الهاتف</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone ?? '') }}" placeholder="07########">
            </div>
            <div class="form-group col-md-6">
                <label>الموقع</label>
                <input type="text" name="location" class="form-control" value="{{ old('location', $user->location ?? '') }}" placeholder="المدينة، الدولة">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>كلمة المرور {{ isset($user) ? '(اتركها فارغة لعدم التغيير)' : '' }}</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••">
            </div>
            <div class="form-group col-md-6">
                <label>تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••">
            </div>
        </div>

        <div class="form-group">
            <label>نبذة تعريفية</label>
            <textarea name="bio" class="form-control" rows="3" placeholder="نبذة عن المستخدم">{{ old('bio', $user->bio ?? '') }}</textarea>
        </div>

        <div class="text-left mt-3">
            <button type="submit" class="abtn-save"><i class="fas fa-save"></i> {{ isset($user) ? 'حفظ التعديلات' : 'إضافة المستخدم' }}</button>
        </div>
    </form>
</div>
@endsection
