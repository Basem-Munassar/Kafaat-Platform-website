@extends('admin.layout.masterApp')

@section('pageTitle', 'إدارة المستخدمين')
@section('pageDescription', 'عرض وإضافة وتعديل وحذف جميع حسابات النظام')

@section('users')
<div class="apage-head">
    <div>
        <h4 class="apage-title"><i class="fas fa-users mr-2"></i>المستخدمون</h4>
        <span class="apage-count">{{ $users->count() }} مستخدم</span>
    </div>
    <a href="{{ route('admin.users.create') }}" class="abtn-add"><i class="fas fa-user-plus"></i> إضافة مستخدم</a>
</div>

<div class="apanel">
    <div class="table-responsive">
        <table class="atable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>المستخدم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الهاتف</th>
                    <th>النوع</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    @php
                        $isAdmin = in_array($user->role, ['admin','super admin']);
                        $isKafaa = in_array($user->account_type, ['kafaa','employee']) || in_array($user->role, ['kafaa','employee']);
                    @endphp
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <img class="aimg aimg-round mr-2" src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('admin/img/user-profile.jpg') }}" alt="">
                            <span style="font-weight:bold;color:#2d114e;">{{ $user->name }}</span>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? '—' }}</td>
                        <td>
                            <span class="atag {{ $isAdmin ? 'atag-admin' : ($isKafaa ? 'atag-kafaa' : 'atag-user') }}">
                                {{ $isAdmin ? 'مسؤول' : ($isKafaa ? 'كفاءة' : 'مستخدم') }}
                            </span>
                        </td>
                        <td>
                            @if ($isKafaa)
                                <span class="atag {{ $user->is_available ? 'atag-soft' : 'atag-user' }}">
                                    {{ $user->is_available ? 'ظاهر' : 'مخفي' }}
                                </span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex" style="gap:.4rem;">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="abtn-edit" title="تعديل"><i class="fas fa-pen"></i></a>
                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="abtn-del" title="حذف"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7"><div class="aempty"><i class="fas fa-users"></i><p class="mt-2">لا يوجد مستخدمون.</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
