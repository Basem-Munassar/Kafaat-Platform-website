@extends('admin.layout.masterApp')

@section('pageTitle', 'إدارة المسميات الوظيفية')
@section('pageDescription', 'كل المسميات الوظيفية في النظام')

@section('jobsTitle')
<div class="apage-head">
    <div>
        <h4 class="apage-title"><i class="fas fa-briefcase mr-2"></i>المسميات الوظيفية</h4>
        <span class="apage-count">{{ $jobTitles->count() }} مسمى</span>
    </div>
    <a href="{{ route('admin.jobsTitle.create') }}" class="abtn-add"><i class="fas fa-circle-plus"></i> إضافة مسمى</a>
</div>

<div class="apanel">
    <div class="table-responsive">
        <table class="atable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>المسمى الوظيفي</th>
                    <th>الوصف</th>
                    <th>صاحبه</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jobTitles as $jobTitle)
                    <tr>
                        <td>{{ $jobTitle->id }}</td>
                        <td style="font-weight:bold;color:#2d114e;">{{ $jobTitle->title }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($jobTitle->description, 60) }}</td>
                        <td>{{ optional(\App\Models\User::find($jobTitle->user_id))->name ?? '#' . $jobTitle->user_id }}</td>
                        <td>
                            <div class="d-flex" style="gap:.4rem;">
                                <a href="{{ route('admin.jobsTitle.edit', $jobTitle->id) }}" class="abtn-edit" title="تعديل"><i class="fas fa-pen"></i></a>
                                <form action="{{ route('admin.jobsTitle.delete', $jobTitle->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="abtn-del" title="حذف"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5"><div class="aempty"><i class="fas fa-briefcase"></i><p class="mt-2">لا توجد مسميات وظيفية.</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
