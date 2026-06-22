@extends('admin.layout.masterApp')

@section('pageTitle', 'إدارة المهارات')
@section('pageDescription', 'كل المهارات المسجّلة في النظام')

@section('skills')
<div class="apage-head">
    <div>
        <h4 class="apage-title"><i class="fas fa-bolt mr-2"></i>المهارات</h4>
        <span class="apage-count">{{ $skills->count() }} مهارة</span>
    </div>
    <a href="{{ route('admin.skills.create') }}" class="abtn-add"><i class="fas fa-circle-plus"></i> إضافة مهارة</a>
</div>

<div class="apanel">
    <div class="table-responsive">
        <table class="atable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>المهارة</th>
                    <th>المستوى</th>
                    <th>التصنيف</th>
                    <th>صاحبها</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($skills as $skill)
                    <tr>
                        <td>{{ $skill->id }}</td>
                        <td style="font-weight:bold;color:#2d114e;">{{ $skill->name }}</td>
                        <td><span class="atag atag-admin">{{ $skill->level }}</span></td>
                        <td>{{ $skill->category ?: '—' }}</td>
                        <td>{{ optional(\App\Models\User::find($skill->user_id))->name ?? '#' . $skill->user_id }}</td>
                        <td>
                            <div class="d-flex" style="gap:.4rem;">
                                <a href="{{ route('admin.skills.edit', $skill->id) }}" class="abtn-edit" title="تعديل"><i class="fas fa-pen"></i></a>
                                <form action="{{ route('admin.skills.delete', $skill->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه المهارة؟')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="abtn-del" title="حذف"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6"><div class="aempty"><i class="fas fa-bolt"></i><p class="mt-2">لا توجد مهارات.</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
