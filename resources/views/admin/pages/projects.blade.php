@extends('admin.layout.masterApp')

@section('pageTitle', 'إدارة المشاريع')
@section('pageDescription', 'كل المشاريع المضافة في النظام')

@section('projects')
<div class="apage-head">
    <div>
        <h4 class="apage-title"><i class="fas fa-diagram-project mr-2"></i>المشاريع</h4>
        <span class="apage-count">{{ $projects->count() }} مشروع</span>
    </div>
    <a href="{{ route('admin.projects.create') }}" class="abtn-add"><i class="fas fa-circle-plus"></i> إضافة مشروع</a>
</div>

<div class="apanel">
    <div class="table-responsive">
        <table class="atable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الصورة</th>
                    <th>العنوان</th>
                    <th>التقنيات</th>
                    <th>الرابط</th>
                    <th>التاريخ</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td><img class="aimg" src="{{ $project->image ? asset('storage/' . $project->image) : asset('admin/img/user-profile.jpg') }}" alt=""></td>
                        <td style="font-weight:bold;color:#2d114e;">{{ $project->title }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($project->technologies, 40) ?: '—' }}</td>
                        <td>
                            @if ($project->link)
                                <a href="{{ $project->link }}" target="_blank" style="color:#892CDC;"><i class="fas fa-link"></i> زيارة</a>
                            @else <span class="text-muted">—</span> @endif
                        </td>
                        <td>{{ $project->date ?? '—' }}</td>
                        <td>
                            <div class="d-flex" style="gap:.4rem;">
                                <a href="{{ route('admin.projects.edit', $project->id) }}" class="abtn-edit" title="تعديل"><i class="fas fa-pen"></i></a>
                                <form action="{{ route('admin.projects.delete', $project->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا المشروع؟')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="abtn-del" title="حذف"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7"><div class="aempty"><i class="fas fa-diagram-project"></i><p class="mt-2">لا توجد مشاريع.</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
