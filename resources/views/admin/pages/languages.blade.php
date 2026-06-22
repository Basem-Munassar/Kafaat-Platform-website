@extends('admin.layout.masterApp')

@section('pageTitle', 'إدارة اللغات')
@section('pageDescription', 'كل اللغات المضافة في النظام')

@section('languages')
<div class="apage-head">
    <div>
        <h4 class="apage-title"><i class="fas fa-language mr-2"></i>اللغات</h4>
        <span class="apage-count">{{ $languages->count() }} لغة</span>
    </div>
    <a href="{{ route('admin.languages.create') }}" class="abtn-add"><i class="fas fa-circle-plus"></i> إضافة لغة</a>
</div>

<div class="apanel">
    <div class="table-responsive">
        <table class="atable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>اللغة</th>
                    <th>المستوى</th>
                    <th>صاحبها</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($languages as $language)
                    <tr>
                        <td>{{ $language->id }}</td>
                        <td style="font-weight:bold;color:#2d114e;">{{ $language->language }}</td>
                        <td><span class="atag atag-soft">{{ $language->level }}</span></td>
                        <td>{{ optional(\App\Models\User::find($language->user_id))->name ?? '#' . $language->user_id }}</td>
                        <td>
                            <div class="d-flex" style="gap:.4rem;">
                                <a href="{{ route('admin.languages.edit', $language->id) }}" class="abtn-edit" title="تعديل"><i class="fas fa-pen"></i></a>
                                <form action="{{ route('admin.languages.delete', $language->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه اللغة؟')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="abtn-del" title="حذف"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5"><div class="aempty"><i class="fas fa-language"></i><p class="mt-2">لا توجد لغات.</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
