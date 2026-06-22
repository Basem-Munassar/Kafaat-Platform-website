@extends('admin.layout.masterApp')

@section('pageTitle', 'لوحة التحكم')
@section('pageDescription', 'نظرة شاملة على النظام والمستخدمين والنشاط')

@section('dashboardContent')

@php
    $hour = (int) now()->format('H');
    $greeting = $hour < 12 ? 'صباح الخير' : 'مساء الخير';

    $stats = [
        ['label' => 'إجمالي المستخدمين', 'sub' => 'كل الحسابات المسجّلة',     'count' => $userCount,     'icon' => 'fa-users',          'route' => route('admin.users.index'),     'grad' => ['#892CDC', '#BC6FF1']],
        ['label' => 'المسؤولون',          'sub' => 'حسابات الإدارة',            'count' => $adminCount,    'icon' => 'fa-user-shield',    'route' => route('admin.users.index'),     'grad' => ['#2D114E', '#892CDC']],
        ['label' => 'الكفاءات / الموظفون','sub' => 'أصحاب الصفحات المهنية',     'count' => $kafaaCount,    'icon' => 'fa-user-tie',       'route' => route('admin.users.index'),     'grad' => ['#4E65FF', '#6A82FB']],
        ['label' => 'المستخدمون العاديون','sub' => 'زوار مسجّلون بدون صفحة',    'count' => $regularUserCount,'icon' => 'fa-user',          'route' => null,                           'grad' => ['#11998e', '#38ef7d']],
        ['label' => 'المشاريع',           'sub' => 'إجمالي المشاريع في النظام',  'count' => $projectCount,  'icon' => 'fa-diagram-project','route' => route('admin.projects.index'),  'grad' => ['#FF6B6B', '#FF8E53']],
        ['label' => 'المهارات',           'sub' => 'إجمالي المهارات المسجّلة',   'count' => $skillCount,    'icon' => 'fa-bolt',           'route' => route('admin.skills.index'),    'grad' => ['#f857a6', '#ff5858']],
        ['label' => 'اللغات',             'sub' => 'إجمالي اللغات المضافة',      'count' => $languageCount, 'icon' => 'fa-language',       'route' => route('admin.languages.index'), 'grad' => ['#36D1DC', '#5B86E5']],
        ['label' => 'المسميات الوظيفية',  'sub' => 'إجمالي المسميات',           'count' => $jobTitleCount, 'icon' => 'fa-briefcase',      'route' => route('admin.jobsTitle.index'), 'grad' => ['#FF9966', '#FF5E62']],
        ['label' => 'المنشورات',          'sub' => 'إجمالي المقالات',          'count' => $postCount,     'icon' => 'fa-newspaper',      'route' => route('admin.posts.index'),     'grad' => ['#654ea3', '#eaafc8']],
        ['label' => 'الآراء والتقييمات',  'sub' => 'إجمالي آراء الزوار',        'count' => $reviewCount,   'icon' => 'fa-star',           'route' => route('admin.reviews.index'),   'grad' => ['#f7971e', '#ffd200']],
        ['label' => 'رسائل التواصل',      'sub' => 'الرسائل الواردة',           'count' => $messageCount,  'icon' => 'fa-envelope',       'route' => route('admin.messages.index'),  'grad' => ['#1f4037', '#99f2c8']],
        ['label' => 'إجمالي الزيارات',    'sub' => 'كل زيارات الصفحات المهنية', 'count' => $totalVisits,   'icon' => 'fa-eye',            'route' => null,                           'grad' => ['#8E2DE2', '#4A00E0']],
    ];
@endphp

<!-- ===== Hero ===== -->
<div class="row m-1 mb-2">
    <div class="col-12 p-2">
        <div class="adash-hero">
            <div class="adash-hero__info">
                <span class="adash-hero__shield"><i class="fas fa-shield-halved"></i></span>
                <div>
                    <p class="adash-hero__hello">{{ $greeting }} 👋</p>
                    <h2 class="adash-hero__name">{{ $admin->name ?? 'مسؤول النظام' }}</h2>
                    <span class="adash-status">
                        <i class="fas fa-circle-check"></i>
                        لديك صلاحية التحكم الكامل بالنظام
                    </span>
                </div>
            </div>
            <div class="adash-hero__actions">
                <a href="{{ route('home.index') }}" target="_blank" class="adash-btn adash-btn--ghost">
                    <i class="fas fa-external-link-alt"></i> معاينة الموقع
                </a>
                <a href="{{ route('admin.users.index') }}" class="adash-btn adash-btn--light">
                    <i class="fas fa-users-gear"></i> إدارة المستخدمين
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ===== Live activity (sessions + visits) ===== -->
<p class="adash-section-title"><i class="fas fa-signal mr-2"></i>النشاط المباشر والزيارات</p>
<div class="row m-1 mb-2">
    <div class="col-xl-3 col-md-6 p-2">
        <div class="adash-live adash-live--green">
            <div class="adash-live__top"><i class="fas fa-circle adash-pulse"></i> متصل الآن</div>
            <div class="adash-live__num">{{ $activeSessions }}</div>
            <div class="adash-live__sub">جلسة نشطة خلال آخر 15 دقيقة</div>
            <div class="adash-live__split">
                <span><i class="fas fa-user-check"></i> {{ $onlineMembers }} مسجّل دخول</span>
                <span><i class="fas fa-user-clock"></i> {{ $onlineGuests }} زائر</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 p-2">
        <div class="adash-live adash-live--purple">
            <div class="adash-live__top"><i class="fas fa-calendar-day"></i> زيارات اليوم</div>
            <div class="adash-live__num">{{ $visitsToday }}</div>
            <div class="adash-live__sub">منذ بداية اليوم</div>
            <div class="adash-live__split">
                <span><i class="fas fa-calendar-week"></i> {{ $visitsThisWeek }} هذا الأسبوع</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 p-2">
        <div class="adash-live adash-live--blue">
            <div class="adash-live__top"><i class="fas fa-user-check"></i> زيارات المسجّلين</div>
            <div class="adash-live__num">{{ $visitsByMembers }}</div>
            <div class="adash-live__sub">زيارات من مستخدمين مسجّلي الدخول</div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 p-2">
        <div class="adash-live adash-live--orange">
            <div class="adash-live__top"><i class="fas fa-user-secret"></i> زيارات الزوار</div>
            <div class="adash-live__num">{{ $visitsByGuests }}</div>
            <div class="adash-live__sub">زيارات من غير المسجّلين</div>
        </div>
    </div>
</div>

<!-- ===== Stats Grid ===== -->
<p class="adash-section-title"><i class="fas fa-chart-pie mr-2"></i>إحصائيات النظام</p>
<div class="row m-1 mb-2">
    @foreach ($stats as $s)
        <div class="col-xl-3 col-md-6 col-sm-12 p-2">
            @php $tag = $s['route'] ? 'a' : 'div'; @endphp
            <{{ $tag }} @if($s['route']) href="{{ $s['route'] }}" @endif class="adash-stat">
                <span class="adash-stat__icon" style="background: linear-gradient(135deg, {{ $s['grad'][0] }}, {{ $s['grad'][1] }});">
                    <i class="fas {{ $s['icon'] }}"></i>
                </span>
                <div class="adash-stat__body">
                    <span class="adash-stat__label">{{ $s['label'] }}</span>
                    <span class="adash-stat__count">{{ $s['count'] }}</span>
                    <span class="adash-stat__sub">{{ $s['sub'] }}</span>
                </div>
                @if ($s['route'])<i class="fas fa-chevron-left adash-stat__arrow"></i>@endif
            </{{ $tag }}>
        </div>
    @endforeach
</div>

<!-- ===== Recent activity ===== -->
<div class="row m-1 mb-2">
    <!-- Recent users -->
    <div class="col-xl-6 p-2">
        <div class="adash-panel h-100">
            <div class="adash-panel__head">
                <span><i class="fas fa-user-plus mr-2"></i>أحدث المستخدمين</span>
                <a href="{{ route('admin.users.index') }}" class="adash-panel__link">عرض الكل</a>
            </div>
            <div class="table-responsive">
                <table class="table adash-table mb-0">
                    <thead><tr><th>المستخدم</th><th>النوع</th><th>تاريخ التسجيل</th></tr></thead>
                    <tbody>
                        @forelse ($recentUsers as $u)
                            <tr>
                                <td>
                                    <img src="{{ $u->profile_image ? asset('storage/' . $u->profile_image) : asset('admin/img/user-profile.jpg') }}" class="adash-avatar" alt="">
                                    <span>{{ $u->name }}</span>
                                </td>
                                <td>
                                    @php
                                        $isAdmin = in_array($u->role, ['admin','super admin']);
                                        $isKafaa = in_array($u->account_type, ['kafaa','employee']) || in_array($u->role, ['kafaa','employee']);
                                    @endphp
                                    <span class="adash-tag {{ $isAdmin ? 'tag-admin' : ($isKafaa ? 'tag-kafaa' : 'tag-user') }}">
                                        {{ $isAdmin ? 'مسؤول' : ($isKafaa ? 'كفاءة' : 'مستخدم') }}
                                    </span>
                                </td>
                                <td>{{ $u->created_at ? $u->created_at->format('Y-m-d') : '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center text-muted py-3">لا يوجد مستخدمون</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent reviews -->
    <div class="col-xl-6 p-2">
        <div class="adash-panel h-100">
            <div class="adash-panel__head">
                <span><i class="fas fa-star mr-2"></i>أحدث الآراء</span>
                <a href="{{ route('admin.reviews.index') }}" class="adash-panel__link">عرض الكل</a>
            </div>
            <div class="adash-panel__body">
                @forelse ($recentReviews as $r)
                    <div class="adash-review">
                        <div class="adash-review__head">
                            <strong>{{ $r->name }}</strong>
                            <span class="adash-stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $r->rating ? 'on' : 'off' }}"></i>
                                @endfor
                            </span>
                        </div>
                        <p class="adash-review__text">{{ \Illuminate\Support\Str::limit($r->comment, 90) }}</p>
                    </div>
                @empty
                    <p class="text-center text-muted py-3">لا توجد آراء بعد</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="row m-1 mb-2">
    <!-- Recent messages -->
    <div class="col-xl-7 p-2">
        <div class="adash-panel h-100">
            <div class="adash-panel__head">
                <span><i class="fas fa-envelope mr-2"></i>أحدث رسائل التواصل</span>
                <a href="{{ route('admin.messages.index') }}" class="adash-panel__link">عرض الكل</a>
            </div>
            <div class="table-responsive">
                <table class="table adash-table mb-0">
                    <thead><tr><th>المرسل</th><th>الموضوع</th><th>التاريخ</th></tr></thead>
                    <tbody>
                        @forelse ($recentMessages as $m)
                            <tr>
                                <td><strong>{{ $m->name }}</strong><br><small class="text-muted">{{ $m->email }}</small></td>
                                <td>{{ \Illuminate\Support\Str::limit($m->subject, 40) }}</td>
                                <td>{{ $m->created_at ? $m->created_at->format('Y-m-d') : '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center text-muted py-3">لا توجد رسائل</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent visits -->
    <div class="col-xl-5 p-2">
        <div class="adash-panel h-100">
            <div class="adash-panel__head">
                <span><i class="fas fa-eye mr-2"></i>أحدث الزيارات</span>
            </div>
            <div class="table-responsive">
                <table class="table adash-table mb-0">
                    <thead><tr><th>الصفحة المزارة</th><th>الزائر</th><th>التاريخ</th></tr></thead>
                    <tbody>
                        @forelse ($recentVisits as $v)
                            <tr>
                                <td>{{ $v->profile_name ?? '—' }}</td>
                                <td>
                                    @if ($v->visitor_user_id)
                                        <span class="adash-tag tag-kafaa">مسجّل</span>
                                    @else
                                        <span class="adash-tag tag-user">زائر</span>
                                    @endif
                                </td>
                                <td>{{ \Illuminate\Support\Carbon::parse($v->created_at)->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center text-muted py-3">لا توجد زيارات</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ===== Quick actions ===== -->
<p class="adash-section-title"><i class="fas fa-bolt mr-2"></i>إجراءات سريعة</p>
<div class="row m-1 mb-3">
    <div class="col-xl-3 col-md-6 p-2"><a href="{{ route('admin.users.create') }}" class="adash-quick"><i class="fas fa-user-plus"></i><span>إضافة مستخدم</span></a></div>
    <div class="col-xl-3 col-md-6 p-2"><a href="{{ route('admin.projects.create') }}" class="adash-quick"><i class="fas fa-circle-plus"></i><span>إضافة مشروع</span></a></div>
    <div class="col-xl-3 col-md-6 p-2"><a href="{{ route('admin.posts.create') }}" class="adash-quick"><i class="fas fa-pen-to-square"></i><span>كتابة منشور</span></a></div>
    <div class="col-xl-3 col-md-6 p-2"><a href="{{ route('admin.reviews.index') }}" class="adash-quick"><i class="fas fa-star-half-stroke"></i><span>إدارة الآراء</span></a></div>
</div>

<style>
    .adash-hero {
        display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1.5rem;
        background: linear-gradient(120deg, #2d114e 0%, #892CDC 55%, #BC6FF1 100%);
        border-radius: 20px; padding: 1.8rem 2rem; box-shadow: 0 18px 40px rgba(137, 44, 220, 0.25); color: #fff;
    }
    .adash-hero__info { display: flex; align-items: center; gap: 1.2rem; }
    .adash-hero__shield {
        width: 78px; height: 78px; border-radius: 20px; flex-shrink: 0; font-size: 2.2rem;
        display: flex; align-items: center; justify-content: center; color: #fff;
        background: rgba(255,255,255,.18); border: 2px solid rgba(255,255,255,.4);
    }
    .adash-hero__hello { margin: 0 0 .2rem; opacity: .9; font-size: .95rem; }
    .adash-hero__name { margin: 0 0 .6rem; font-size: 1.7rem; font-weight: bold; color: #fff; }
    .adash-status {
        display: inline-flex; align-items: center; gap: .45rem; padding: .35rem .9rem;
        border-radius: 30px; font-size: .85rem; font-weight: bold; background: rgba(255, 255, 255, 0.18);
    }
    .adash-status i { color: #5cffb1; }
    .adash-hero__actions { display: flex; flex-wrap: wrap; gap: .7rem; }

    .adash-btn {
        display: inline-flex; align-items: center; gap: .5rem; border: none; border-radius: 10px;
        padding: .65rem 1.3rem; font-weight: bold; font-size: .9rem; cursor: pointer; text-decoration: none;
        transition: transform .25s ease, box-shadow .25s ease;
    }
    .adash-btn:hover { transform: translateY(-2px); text-decoration: none; }
    .adash-btn--light { background: #fff; color: #892CDC; box-shadow: 0 8px 18px rgba(0,0,0,.15); }
    .adash-btn--light:hover { color: #892CDC; }
    .adash-btn--ghost { background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.4); }
    .adash-btn--ghost:hover { color: #fff; background: rgba(255,255,255,0.25); }

    .adash-section-title {
        font-size: 1.1rem; font-weight: bold; color: #2d114e; margin: .8rem 0 .3rem .8rem;
        padding-right: .8rem; border-right: 4px solid #892CDC;
    }

    /* live cards */
    .adash-live { border-radius: 16px; padding: 1.3rem 1.4rem; color: #fff; height: 100%;
        box-shadow: 0 12px 28px rgba(0,0,0,.12); }
    .adash-live--green  { background: linear-gradient(135deg, #11998e, #38ef7d); }
    .adash-live--purple { background: linear-gradient(135deg, #892CDC, #BC6FF1); }
    .adash-live--blue   { background: linear-gradient(135deg, #4E65FF, #6A82FB); }
    .adash-live--orange { background: linear-gradient(135deg, #FF9966, #FF5E62); }
    .adash-live__top { font-size: .9rem; font-weight: bold; opacity: .95; }
    .adash-live__num { font-size: 2.4rem; font-weight: bold; line-height: 1.2; }
    .adash-live__sub { font-size: .78rem; opacity: .9; }
    .adash-live__split { display: flex; flex-wrap: wrap; gap: .8rem; margin-top: .6rem; font-size: .8rem; font-weight: bold; }
    .adash-pulse { font-size: .6rem; animation: admPulse 1.4s ease-in-out infinite; vertical-align: middle; }
    @keyframes admPulse { 0%,100% { opacity: 1; } 50% { opacity: .25; } }

    /* stat cards */
    .adash-stat {
        display: flex; align-items: center; gap: 1rem; background: #fff; border-radius: 16px;
        padding: 1.2rem 1.3rem; box-shadow: 0 10px 25px rgba(137, 44, 220, 0.08);
        border: 1px solid rgba(137, 44, 220, 0.08); height: 100%; text-decoration: none; color: inherit;
        transition: transform .3s ease, box-shadow .3s ease; position: relative; overflow: hidden;
    }
    a.adash-stat:hover { transform: translateY(-5px); text-decoration: none; color: inherit; box-shadow: 0 18px 35px rgba(137, 44, 220, 0.18); }
    .adash-stat__icon { width: 54px; height: 54px; border-radius: 14px; flex-shrink: 0; display: flex;
        align-items: center; justify-content: center; color: #fff; font-size: 1.4rem; box-shadow: 0 8px 16px rgba(0,0,0,.12); }
    .adash-stat__body { display: flex; flex-direction: column; }
    .adash-stat__label { font-size: .92rem; font-weight: bold; color: #5b3f8d; }
    .adash-stat__count { font-size: 1.8rem; font-weight: bold; color: #2d114e; line-height: 1.15; }
    .adash-stat__sub { font-size: .75rem; color: #9a8bb5; }
    .adash-stat__arrow { position: absolute; left: 1rem; color: #d7c9ee; font-size: .9rem; transition: transform .3s ease, color .3s ease; }
    a.adash-stat:hover .adash-stat__arrow { transform: translateX(-4px); color: #892CDC; }

    /* panels */
    .adash-panel { background: #fff; border-radius: 16px; box-shadow: 0 10px 25px rgba(137,44,220,.07);
        border: 1px solid rgba(137,44,220,.08); overflow: hidden; }
    .adash-panel__head { display: flex; align-items: center; justify-content: space-between;
        padding: 1rem 1.3rem; font-weight: bold; color: #2d114e; border-bottom: 1px solid #f0ecf7; }
    .adash-panel__link { font-size: .8rem; color: #892CDC; text-decoration: none; font-weight: bold; }
    .adash-panel__link:hover { color: #BC6FF1; text-decoration: none; }
    .adash-panel__body { padding: .8rem 1.3rem; }

    .adash-table { font-size: .88rem; }
    .adash-table th { color: #9a8bb5; font-weight: bold; border: none; }
    .adash-table td { vertical-align: middle; border-color: #f4f1fa; color: #4a3a66; }
    .adash-avatar { width: 34px; height: 34px; border-radius: 50%; object-fit: cover; margin-left: .5rem; }

    .adash-tag { font-size: .72rem; font-weight: bold; padding: .2rem .7rem; border-radius: 20px; }
    .tag-admin { background: rgba(137,44,220,.12); color: #892CDC; }
    .tag-kafaa { background: rgba(78,101,255,.12); color: #4E65FF; }
    .tag-user  { background: #f0f0f5; color: #7c6a9c; }

    .adash-review { padding: .6rem 0; border-bottom: 1px dashed #efeaf7; }
    .adash-review:last-child { border-bottom: none; }
    .adash-review__head { display: flex; align-items: center; justify-content: space-between; }
    .adash-review__head strong { color: #2d114e; }
    .adash-review__text { margin: .3rem 0 0; color: #7c6a9c; font-size: .85rem; }
    .adash-stars .on { color: #ffc107; }
    .adash-stars .off { color: #e2dced; }

    .adash-quick {
        display: flex; flex-direction: column; align-items: center; justify-content: center; gap: .6rem;
        background: #fff; border-radius: 16px; padding: 1.4rem 1rem; text-align: center; text-decoration: none;
        height: 100%; border: 1px dashed rgba(137, 44, 220, 0.3); color: #5b3f8d; font-weight: bold;
        transition: transform .3s ease, box-shadow .3s ease, background .3s ease, color .3s ease;
    }
    .adash-quick i { font-size: 1.7rem; color: #892CDC; transition: color .3s ease; }
    .adash-quick:hover { transform: translateY(-4px); text-decoration: none; color: #fff;
        background: linear-gradient(135deg, #892CDC, #BC6FF1); box-shadow: 0 14px 28px rgba(137, 44, 220, 0.25); border-color: transparent; }
    .adash-quick:hover i { color: #fff; }

    @media (max-width: 575px) {
        .adash-hero { padding: 1.4rem; text-align: center; justify-content: center; }
        .adash-hero__info { flex-direction: column; text-align: center; }
        .adash-hero__actions { width: 100%; justify-content: center; }
    }
</style>
@endsection
