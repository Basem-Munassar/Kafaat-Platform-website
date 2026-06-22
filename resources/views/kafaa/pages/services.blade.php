@extends('kafaa.layout.masterApp')

@section('pageTitle', 'خدماتي')
@section('pageDescription', 'الخدمات التي تقدّمها وتظهر في صفحتك العامة')

@section('services')
<div class="row m-1">
    <div class="col-12 p-2 d-flex justify-content-between align-items-center flex-wrap">
        <h4 style="font-weight:bold; color:#2d114e; margin:0;"><i class="fas fa-concierge-bell mr-2" style="color:#892CDC;"></i>الخدمات التي أقدّمها</h4>
        <a href="{{ route('kafaa.services.create') }}" class="btn text-white" style="background:linear-gradient(135deg,#892CDC,#BC6FF1); border:none; border-radius:10px; font-weight:bold; padding:.55rem 1.4rem;">
            <i class="fas fa-circle-plus mr-1"></i>إضافة خدمة
        </a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success m-2" style="border-radius:10px;">{{ session('success') }}</div>
@endif

<div class="row m-1">
    @forelse($services as $service)
        <div class="col-xl-4 col-md-6 col-sm-12 p-2">
            <div class="card h-100" style="border-radius:16px; border:1px solid rgba(137,44,220,0.1); box-shadow:0 8px 22px rgba(137,44,220,0.06);">
                <div class="card-body">
                    <div style="width:56px; height:56px; border-radius:14px; display:flex; align-items:center; justify-content:center; background:linear-gradient(135deg,#892CDC,#BC6FF1); color:#fff; font-size:1.6rem; margin-bottom:.8rem;">
                        <i class='bx {{ $service->icon ?: 'bx-briefcase' }}'></i>
                    </div>
                    <h5 style="font-weight:bold; color:#2d114e;">{{ $service->title }}</h5>
                    <p style="font-size:.9rem; color:#7c6a9c;">{{ $service->description }}</p>
                </div>
                <div class="card-body pt-0 d-flex gap-2">
                    <a href="{{ route('kafaa.services.edit', $service->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius:8px; flex:1;"><i class="fas fa-pen"></i> تعديل</a>
                    <form action="{{ route('kafaa.services.delete', $service->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')" style="flex:1; margin-right:.4rem;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100" style="border-radius:8px;"><i class="fas fa-trash"></i> حذف</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 p-4 text-center">
            <i class="fas fa-concierge-bell" style="font-size:2.5rem; color:#d7c9ee;"></i>
            <p class="mt-2" style="color:#7c6a9c;">لا توجد خدمات بعد. أضف أول خدمة تقدّمها.</p>
        </div>
    @endforelse
</div>
@endsection
