@extends('kafaa.layout.masterApp')

@section('pageTitle', 'مشاريعي')
@section('pageDescription', 'إدارة مشاريعك المعروضة في ملفك الشخصي')

@section('projects')
<div class="row m-1">
    <div class="col-12 p-2 d-flex justify-content-between align-items-center flex-wrap">
        <h4 style="font-weight:bold; color:#2d114e; margin:0;"><i class="fas fa-diagram-project mr-2" style="color:#892CDC;"></i>مشاريعي</h4>
        <a href="{{ route('kafaa.projects.create') }}" class="btn text-white" style="background:linear-gradient(135deg,#892CDC,#BC6FF1); border:none; border-radius:10px; font-weight:bold; padding:.55rem 1.4rem;">
            <i class="fas fa-circle-plus mr-1"></i>إضافة مشروع
        </a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success m-2" style="border-radius:10px;">{{ session('success') }}</div>
@endif

<div class="row m-1">
    @forelse($projects as $project)
        <div class="col-xl-3 col-md-6 col-sm-12 p-2">
            <div class="card h-100" style="border-radius:16px; border:1px solid rgba(137,44,220,0.1); box-shadow:0 8px 22px rgba(137,44,220,0.06); overflow:hidden;">
                <img class="card-img-top" src="{{ $project->image ? asset('storage/' . $project->image) : asset('client/img/port-1.jpg') }}" alt="{{ $project->title }}" style="height:160px; object-fit:cover;">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight:bold; color:#2d114e;">{{ $project->title }}</h5>
                    @if ($project->technologies)
                        <p class="mb-2"><span style="color:#892CDC; font-weight:bold; font-size:.85rem;">التقنيات:</span> <span style="font-size:.85rem;">{{ $project->technologies }}</span></p>
                    @endif
                    <p style="font-size:.85rem; color:#7c6a9c;">{{ \Illuminate\Support\Str::limit($project->description, 90) }}</p>
                    @if ($project->date)
                        <small class="text-muted"><i class="far fa-calendar mr-1"></i>{{ \Carbon\Carbon::parse($project->date)->format('Y-m-d') }}</small>
                    @endif
                </div>
                <div class="card-body pt-0 d-flex gap-2">
                    <a href="{{ route('kafaa.projects.edit', $project->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius:8px; flex:1;"><i class="fas fa-pen"></i> تعديل</a>
                    <form action="{{ route('kafaa.projects.delete', $project->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')" style="flex:1; margin-right:.4rem;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100" style="border-radius:8px;"><i class="fas fa-trash"></i> حذف</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 p-4 text-center">
            <i class="fas fa-folder-open" style="font-size:2.5rem; color:#d7c9ee;"></i>
            <p class="mt-2" style="color:#7c6a9c;">لا توجد مشاريع بعد. ابدأ بإضافة أول مشروع لك.</p>
        </div>
    @endforelse
</div>
@endsection
