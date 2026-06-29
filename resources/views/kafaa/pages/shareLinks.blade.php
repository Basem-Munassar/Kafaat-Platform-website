@extends('kafaa.layout.masterApp')

@section('pageTitle', 'مشاركة سيرتي الذاتية')
@section('pageDescription', 'أنشئ رابطًا مؤقتًا لعرض سيرتك الذاتية لأي شخص بدون شريط تنقّل')

@section('shareLinks')
<div class="row m-1">
    <div class="col-12 p-2">
        <h4 style="font-weight:bold; color:#2d114e; margin:0;">
            <i class="fas fa-share-nodes mr-2" style="color:#892CDC;"></i>روابط مشاركة السيرة الذاتية
        </h4>
        <p style="color:#7c6a9c; margin:.4rem 0 0;">
            ولّد رابطًا مؤقتًا صالحًا لمدة تحددها، يفتح صفحة سيرتك الذاتية فقط (بدون قائمة تنقّل، وفي الأعلى شعار كفاءات).
        </p>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success m-2" style="border-radius:10px;">{{ session('success') }}</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger m-2" style="border-radius:10px;">{{ $errors->first() }}</div>
@endif

{{-- Newly generated link --}}
@if (session('new_link'))
    <div class="row m-1">
        <div class="col-12 p-2">
            <div class="kshare-new">
                <div class="kshare-new__label"><i class="fas fa-circle-check mr-1"></i> تم إنشاء الرابط — انسخه وأرسله:</div>
                <div class="kshare-copy">
                    <input type="text" id="newLink" value="{{ session('new_link') }}" readonly onclick="this.select()">
                    <button type="button" class="kshare-copy__btn" onclick="copyLink('newLink', this)"><i class="fas fa-copy"></i> نسخ</button>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- Generate form --}}
<div class="row m-1">
    <div class="col-12 p-2">
        <div class="kshare-card">
            <form action="{{ route('kafaa.shareLinks.store') }}" method="POST" class="kshare-form">
                @csrf
                <div class="kshare-form__field">
                    <label>مدة صلاحية الرابط</label>
                    <select name="duration" class="form-control">
                        @foreach ($durations as $key => $info)
                            <option value="{{ $key }}" {{ $key === '24h' ? 'selected' : '' }}>{{ $info[0] }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="kshare-generate">
                    <i class="fas fa-link"></i> إنشاء رابط مؤقت
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Active / existing links --}}
<div class="row m-1">
    <div class="col-12 p-2">
        <div class="kshare-card">
            <h5 style="font-weight:bold;color:#2d114e;margin-bottom:1rem;"><i class="fas fa-list mr-2" style="color:#892CDC;"></i>روابطي</h5>

            @forelse ($links as $link)
                @php $expired = $link->expires_at->isPast(); @endphp
                <div class="kshare-item {{ $expired ? 'is-expired' : '' }}">
                    <div class="kshare-item__main">
                        <div class="kshare-copy">
                            <input type="text" id="link-{{ $link->id }}" value="{{ route('cv.share.view', $link->token) }}" readonly onclick="this.select()">
                            <button type="button" class="kshare-copy__btn" onclick="copyLink('link-{{ $link->id }}', this)" {{ $expired ? 'disabled' : '' }}><i class="fas fa-copy"></i></button>
                        </div>
                        <div class="kshare-item__meta">
                            @if ($expired)
                                <span class="kshare-badge kshare-badge--off"><i class="fas fa-clock"></i> منتهي</span>
                                <span class="text-muted">انتهى {{ $link->expires_at->diffForHumans() }}</span>
                            @else
                                <span class="kshare-badge kshare-badge--on"><i class="fas fa-circle-check"></i> فعّال</span>
                                <span class="text-muted">ينتهي {{ $link->expires_at->diffForHumans() }} ({{ $link->expires_at->format('Y-m-d H:i') }})</span>
                            @endif
                        </div>
                    </div>
                    <div class="kshare-item__actions">
                        @if (! $expired)
                            <a href="{{ route('cv.share.view', $link->token) }}" target="_blank" class="kshare-iconbtn" title="معاينة"><i class="fas fa-eye"></i></a>
                        @endif
                        <form action="{{ route('kafaa.shareLinks.delete', $link->id) }}" method="POST" onsubmit="return confirm('إلغاء هذا الرابط نهائيًا؟')">
                            @csrf @method('DELETE')
                            <button type="submit" class="kshare-iconbtn kshare-iconbtn--del" title="إلغاء"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center" style="padding:2rem;color:#9a8bb5;">
                    <i class="fas fa-link" style="font-size:2.4rem;color:#d7c9ee;"></i>
                    <p class="mt-2">لا توجد روابط بعد. أنشئ أول رابط للمشاركة.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    .kshare-card { background:#fff; border-radius:16px; padding:1.4rem; box-shadow:0 10px 25px rgba(137,44,220,.07); border:1px solid rgba(137,44,220,.08); }
    .kshare-form { display:flex; gap:1rem; align-items:flex-end; flex-wrap:wrap; }
    .kshare-form__field { flex:1; min-width:220px; }
    .kshare-form__field label { font-weight:bold; color:#5b3f8d; font-size:.9rem; }
    .kshare-form__field .form-control { border-radius:10px; }
    .kshare-generate { background:linear-gradient(135deg,#892CDC,#BC6FF1); color:#fff; border:none; border-radius:10px; font-weight:bold; padding:.65rem 1.6rem; white-space:nowrap; }
    .kshare-generate:hover { box-shadow:0 8px 18px rgba(137,44,220,.3); }

    .kshare-new { background:linear-gradient(135deg,#11998e,#38ef7d); border-radius:14px; padding:1.1rem 1.3rem; color:#fff; }
    .kshare-new__label { font-weight:bold; margin-bottom:.6rem; }

    .kshare-copy { display:flex; gap:.5rem; align-items:center; }
    .kshare-copy input { flex:1; border:none; border-radius:9px; padding:.6rem .8rem; font-size:.85rem; color:#2d114e; direction:ltr; text-align:left; background:#fff; }
    .kshare-copy__btn { background:#2d114e; color:#fff; border:none; border-radius:9px; padding:.55rem 1rem; font-weight:bold; white-space:nowrap; }
    .kshare-copy__btn:hover { background:#892CDC; }
    .kshare-copy__btn:disabled { opacity:.5; cursor:not-allowed; }

    .kshare-item { display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap; padding:1rem; border:1px solid #f0ecf7; border-radius:12px; margin-bottom:.8rem; }
    .kshare-item.is-expired { opacity:.7; background:#faf9fc; }
    .kshare-item__main { flex:1; min-width:260px; }
    .kshare-item__meta { margin-top:.5rem; display:flex; gap:.6rem; align-items:center; flex-wrap:wrap; font-size:.82rem; }
    .kshare-item__actions { display:flex; gap:.5rem; align-items:center; }
    .kshare-iconbtn { display:inline-flex; align-items:center; justify-content:center; width:38px; height:38px; border-radius:9px; border:1px solid rgba(137,44,220,.3); background:#fff; color:#892CDC; cursor:pointer; }
    .kshare-iconbtn:hover { background:#892CDC; color:#fff; }
    .kshare-iconbtn--del { color:#e74c6f; border-color:rgba(231,76,111,.3); }
    .kshare-iconbtn--del:hover { background:#e74c6f; color:#fff; }

    .kshare-badge { font-size:.72rem; font-weight:bold; padding:.2rem .7rem; border-radius:20px; }
    .kshare-badge--on { background:rgba(17,153,142,.12); color:#0f8a7e; }
    .kshare-badge--off { background:#f0e6ea; color:#b05c72; }
</style>

<script>
    function copyLink(inputId, btn) {
        var input = document.getElementById(inputId);
        input.select();
        input.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(input.value).then(function () {
            var original = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check"></i> تم النسخ';
            setTimeout(function () { btn.innerHTML = original; }, 1600);
        }).catch(function () {
            document.execCommand('copy');
        });
    }
</script>
@endsection
