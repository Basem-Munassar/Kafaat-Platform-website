@extends('admin.layout.masterApp')

@section('pageTitle', 'رسائل التواصل')
@section('pageDescription', 'الرسائل الواردة من نموذج تواصل معنا')

@section('messages')
<div class="apage-head">
    <div>
        <h4 class="apage-title"><i class="fas fa-envelope mr-2"></i>رسائل التواصل</h4>
        <span class="apage-count">{{ $messageCount }} رسالة</span>
    </div>
</div>

<div class="apanel">
    <div class="table-responsive">
        <table class="atable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>المرسل</th>
                    <th>الموضوع</th>
                    <th>الرسالة</th>
                    <th>التاريخ</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $message)
                    <tr>
                        <td>{{ $message->id }}</td>
                        <td>
                            <strong style="color:#2d114e;">{{ $message->name }}</strong><br>
                            <a href="mailto:{{ $message->email }}" style="color:#892CDC; font-size:.82rem;">{{ $message->email }}</a>
                        </td>
                        <td style="font-weight:bold;">{{ $message->subject }}</td>
                        <td style="max-width:340px;">{{ \Illuminate\Support\Str::limit($message->message, 90) }}</td>
                        <td>{{ $message->created_at ? $message->created_at->format('Y-m-d H:i') : '—' }}</td>
                        <td>
                            <div class="d-flex" style="gap:.4rem;">
                                <button type="button" class="abtn-edit" title="عرض"
                                    data-toggle="modal" data-target="#msg-{{ $message->id }}"><i class="fas fa-eye"></i></button>
                                <form action="{{ route('admin.messages.delete', $message->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه الرسالة؟')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="abtn-del" title="حذف"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>

                            <!-- View modal -->
                            <div class="modal fade text-right" id="msg-{{ $message->id }}" tabindex="-1" role="dialog" aria-hidden="true" dir="rtl">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="border-radius:14px;">
                                        <div class="modal-header" style="background:linear-gradient(135deg,#892CDC,#BC6FF1);color:#fff;border-radius:14px 14px 0 0;">
                                            <h5 class="modal-title">{{ $message->subject }}</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>من:</strong> {{ $message->name }} ({{ $message->email }})</p>
                                            <p><strong>التاريخ:</strong> {{ $message->created_at ? $message->created_at->format('Y-m-d H:i') : '—' }}</p>
                                            <hr>
                                            <p style="white-space:pre-line;color:#4a3a66;">{{ $message->message }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="mailto:{{ $message->email }}" class="abtn-save"><i class="fas fa-reply"></i> الرد عبر البريد</a>
                                            <button type="button" class="abtn-cancel" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6"><div class="aempty"><i class="fas fa-envelope-open"></i><p class="mt-2">لا توجد رسائل واردة.</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
