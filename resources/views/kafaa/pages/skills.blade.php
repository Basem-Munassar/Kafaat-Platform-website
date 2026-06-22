@extends('kafaa.layout.masterApp')

@section('pageTitle', 'مهاراتي')
@section('pageDescription', 'إدارة مهاراتك المهنية المعروضة في ملفك الشخصي')

@section('skills')
<div class="row m-1">
    <div class="col-12 p-2 d-flex justify-content-between align-items-center flex-wrap">
        <h4 style="font-weight:bold; color:#2d114e; margin:0;"><i class="fas fa-bolt mr-2" style="color:#892CDC;"></i>مهاراتي</h4>
        <a href="{{ route('kafaa.skills.create') }}" class="btn text-white" style="background:linear-gradient(135deg,#892CDC,#BC6FF1); border:none; border-radius:10px; font-weight:bold; padding:.55rem 1.4rem;">
            <i class="fas fa-circle-plus mr-1"></i>إضافة مهارة
        </a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success m-2" style="border-radius:10px;">{{ session('success') }}</div>
@endif

<div class="row m-1">
    @forelse($skills as $skill)
        <div class="col-xl-4 col-md-6 col-sm-12 p-2">
            <div class="card h-100" style="border-radius:14px; border:1px solid rgba(137,44,220,0.1); box-shadow:0 6px 18px rgba(137,44,220,0.06);">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <div>
                        <h5 style="font-weight:bold; color:#2d114e; margin-bottom:.4rem;">{{ $skill->name }}</h5>
                        <span style="display:inline-block; background:rgba(137,44,220,.1); color:#892CDC; padding:.2rem .8rem; border-radius:20px; font-size:.8rem; font-weight:bold;">{{ $skill->level }}</span>
                        @if ($skill->category)
                            <span style="display:inline-block; background:#f0f0f5; color:#7c6a9c; padding:.2rem .8rem; border-radius:20px; font-size:.8rem; margin-right:.3rem;">{{ $skill->category }}</span>
                        @endif
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('kafaa.skills.edit', $skill->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius:8px;"><i class="fas fa-pen"></i></a>
                        <form action="{{ route('kafaa.skills.delete', $skill->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')" style="margin-right:.4rem;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius:8px;"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 p-4 text-center">
            <i class="fas fa-bolt" style="font-size:2.5rem; color:#d7c9ee;"></i>
            <p class="mt-2" style="color:#7c6a9c;">لا توجد مهارات بعد. أضف مهارتك الأولى.</p>
        </div>
    @endforelse
</div>
@endsection
