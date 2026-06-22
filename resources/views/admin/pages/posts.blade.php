@extends('admin.layout.masterApp')

@section('pageTitle', 'إدارة المنشورات')
@section('pageDescription', 'كل المقالات والمنشورات في النظام')

@section('posts')
<div class="apage-head">
    <div>
        <h4 class="apage-title"><i class="fas fa-newspaper mr-2"></i>المنشورات</h4>
        <span class="apage-count">{{ $posts->count() }} منشور</span>
    </div>
    <a href="{{ route('admin.posts.create') }}" class="abtn-add"><i class="fas fa-pen-to-square"></i> كتابة منشور</a>
</div>

<div class="apanel">
    <div class="table-responsive">
        <table class="atable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>مقتطف</th>
                    <th>الكاتب</th>
                    <th>التاريخ</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td style="font-weight:bold;color:#2d114e;">{{ $post->title }}</td>
                        <td>{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 60) }}</td>
                        <td>{{ $post->posterName ?? '—' }}</td>
                        <td>{{ $post->date ?? ($post->created_at ? $post->created_at->format('Y-m-d') : '—') }}</td>
                        <td>
                            <div class="d-flex" style="gap:.4rem;">
                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="abtn-edit" title="تعديل"><i class="fas fa-pen"></i></a>
                                <form action="{{ route('admin.posts.delete', $post->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا المنشور؟')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="abtn-del" title="حذف"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6"><div class="aempty"><i class="fas fa-newspaper"></i><p class="mt-2">لا توجد منشورات.</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
