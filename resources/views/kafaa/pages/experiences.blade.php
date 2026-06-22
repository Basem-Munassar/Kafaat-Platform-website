@extends('kafaa.layout.masterApp')

@section('pageTitle', 'خبراتي')
@section('pageDescription', 'سجلّك المهني الذي يظهر في ملفك الشخصي')

@section('experiences')
<div class="row m-1">
    <div class="col-12 p-2 d-flex justify-content-between align-items-center flex-wrap">
        <h4 style="font-weight:bold; color:#2d114e; margin:0;"><i class="fas fa-briefcase mr-2" style="color:#892CDC;"></i>خبراتي العملية</h4>
        <a href="{{ route('kafaa.experiences.create') }}" class="btn text-white" style="background:linear-gradient(135deg,#892CDC,#BC6FF1); border:none; border-radius:10px; font-weight:bold; padding:.55rem 1.4rem;">
            <i class="fas fa-circle-plus mr-1"></i>إضافة خبرة
        </a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success m-2" style="border-radius:10px;">{{ session('success') }}</div>
@endif

<div class="row m-1">
    @forelse($experiences as $exp)
        <div class="col-12 p-2">
            <div class="card" style="border-radius:14px; border:1px solid rgba(137,44,220,0.1); box-shadow:0 6px 18px rgba(137,44,220,0.05); border-right:4px solid #892CDC;">
                <div class="card-body d-flex justify-content-between flex-wrap">
                    <div>
                        <h5 style="font-weight:bold; color:#2d114e; margin-bottom:.2rem;">{{ $exp->title }}</h5>
                        <p style="color:#892CDC; font-weight:bold; margin-bottom:.3rem;"><i class="fas fa-building mr-1"></i>{{ $exp->company }}</p>
                        <small class="text-muted">
                            <i class="far fa-calendar mr-1"></i>
                            {{ $exp->start_date?->format('Y-m') }}
                            —
                            {{ $exp->is_current ? 'حتى الآن' : ($exp->end_date?->format('Y-m') ?? '') }}
                        </small>
                        @if ($exp->description)
                            <p class="mt-2 mb-0" style="font-size:.9rem; color:#7c6a9c;">{{ $exp->description }}</p>
                        @endif
                    </div>
                    <div class="d-flex align-items-start gap-2">
                        <a href="{{ route('kafaa.experiences.edit', $exp->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius:8px;"><i class="fas fa-pen"></i></a>
                        <form action="{{ route('kafaa.experiences.delete', $exp->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')" style="margin-right:.4rem;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius:8px;"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 p-4 text-center">
            <i class="fas fa-briefcase" style="font-size:2.5rem; color:#d7c9ee;"></i>
            <p class="mt-2" style="color:#7c6a9c;">لا توجد خبرات بعد. أضف خبرتك الأولى.</p>
        </div>
    @endforelse
</div>
@endsection
