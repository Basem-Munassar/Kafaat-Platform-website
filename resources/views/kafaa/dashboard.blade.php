@extends('kafaa.layout.masterApp')

@section('pageTitle', 'لوحة التحكم')
@section('pageDescription', 'إحصائيات وإدارة السيرة الذاتية الخاصة بك')

@section('dashboardContent')

@php
    $avatar = $user->profile_image ? asset('storage/' . $user->profile_image) : asset('/client/img/profile.png');
    $hour = (int) now()->format('H');
    $greeting = $hour < 12 ? 'صباح الخير' : ($hour < 18 ? 'مساء الخير' : 'مساء الخير');

    $stats = [
        ['label' => 'مشاريعي',            'sub' => 'إجمالي المشاريع المضافة',   'count' => $projectCount,  'icon' => 'fa-diagram-project', 'fa' => 'fas', 'route' => route('kafaa.projects.index'),  'grad' => ['#892CDC', '#BC6FF1']],
        ['label' => 'مهاراتي',            'sub' => 'إجمالي المهارات المهنية',   'count' => $skillCount,    'icon' => 'fa-bolt',           'fa' => 'fas', 'route' => route('kafaa.skills.index'),    'grad' => ['#2D114E', '#892CDC']],
        ['label' => 'لغاتي',              'sub' => 'إجمالي اللغات المتقنة',     'count' => $languageCount, 'icon' => 'fa-language',       'fa' => 'fas', 'route' => route('kafaa.languages.index'), 'grad' => ['#FF6B6B', '#FF8E53']],
        ['label' => 'مسمياتي الوظيفية',   'sub' => 'إجمالي المسميات الوظيفية',  'count' => $jobTitleCount, 'icon' => 'fa-briefcase',      'fa' => 'fas', 'route' => route('kafaa.jobsTitle.index'), 'grad' => ['#4E65FF', '#6A82FB']],
        ['label' => 'خبراتي',             'sub' => 'إجمالي الخبرات العملية',    'count' => $experienceCount, 'icon' => 'fa-briefcase',    'fa' => 'fas', 'route' => route('kafaa.experiences.index'), 'grad' => ['#FF9966', '#FF5E62']],
        ['label' => 'خدماتي',             'sub' => 'إجمالي الخدمات المقدّمة',   'count' => $serviceCount,    'icon' => 'fa-concierge-bell','fa' => 'fas', 'route' => route('kafaa.services.index'),    'grad' => ['#36D1DC', '#5B86E5']],
        ['label' => 'منشوراتي',           'sub' => 'إجمالي المقالات والمنشورات','count' => $postCount,     'icon' => 'fa-newspaper',      'fa' => 'fas', 'route' => route('kafaa.posts.index'),     'grad' => ['#11998e', '#38ef7d']],
        ['label' => 'زيارات صفحتي',       'sub' => 'إجمالي الزيارات من الزوار', 'count' => $myVisits,      'icon' => 'fa-eye',            'fa' => 'fas', 'route' => null,                            'grad' => ['#f857a6', '#ff5858']],
    ];
@endphp

<!-- ===== Welcome Hero ===== -->
<div class="row m-1 mb-2">
    <div class="col-12 p-2">
        <div class="kdash-hero">
            <div class="kdash-hero__info">
                <img src="{{ $avatar }}" alt="{{ $user->name }}" class="kdash-hero__avatar">
                <div>
                    <p class="kdash-hero__hello">{{ $greeting }} 👋</p>
                    <h2 class="kdash-hero__name">{{ $user->name }}</h2>
                    <span class="kdash-status {{ $user->is_available ? 'is-on' : 'is-off' }}">
                        <i class="fas {{ $user->is_available ? 'fa-circle-check' : 'fa-circle-xmark' }}"></i>
                        {{ $user->is_available ? 'متاح للعمل ويظهر في الصفحة الرئيسية' : 'غير متاح ومخفي عن الزوار' }}
                    </span>
                </div>
            </div>
            <div class="kdash-hero__actions">
                <a href="{{ route('kafaa.show', $user->id) }}" target="_blank" class="kdash-btn kdash-btn--ghost">
                    <i class="fas fa-external-link-alt"></i> معاينة صفحتي العامة
                </a>
                <form action="{{ route('kafaa.toggleAvailability') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="kdash-btn {{ $user->is_available ? 'kdash-btn--danger' : 'kdash-btn--light' }}">
                        <i class="fas {{ $user->is_available ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                        {{ $user->is_available ? 'إخفاء حسابي' : 'تفعيل ظهوري' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ===== Stats Grid ===== -->
<p class="kdash-section-title"><i class="fas fa-chart-pie mr-2"></i>نظرة عامة على بياناتك</p>
<div class="row m-1 mb-2">
    @foreach ($stats as $s)
        <div class="col-xl-4 col-md-6 col-sm-12 p-2">
            @php $tag = $s['route'] ? 'a' : 'div'; @endphp
            <{{ $tag }} @if($s['route']) href="{{ $s['route'] }}" @endif class="kdash-stat">
                <span class="kdash-stat__icon" style="background: linear-gradient(135deg, {{ $s['grad'][0] }}, {{ $s['grad'][1] }});">
                    <i class="{{ $s['fa'] }} {{ $s['icon'] }}"></i>
                </span>
                <div class="kdash-stat__body">
                    <span class="kdash-stat__label">{{ $s['label'] }}</span>
                    <span class="kdash-stat__count">{{ $s['count'] }}</span>
                    <span class="kdash-stat__sub">{{ $s['sub'] }}</span>
                </div>
                @if ($s['route'])
                    <i class="fas fa-chevron-left kdash-stat__arrow"></i>
                @endif
            </{{ $tag }}>
        </div>
    @endforeach
</div>

<!-- ===== Quick Actions ===== -->
<p class="kdash-section-title"><i class="fas fa-bolt mr-2"></i>إجراءات سريعة</p>
<div class="row m-1 mb-3">
    <div class="col-xl-3 col-md-6 col-sm-6 p-2">
        <a href="{{ route('kafaa.projects.index') }}" class="kdash-quick">
            <i class="fas fa-circle-plus"></i><span>إضافة مشروع</span>
        </a>
    </div>
    <div class="col-xl-3 col-md-6 col-sm-6 p-2">
        <a href="{{ route('kafaa.skills.index') }}" class="kdash-quick">
            <i class="fas fa-circle-plus"></i><span>إضافة مهارة</span>
        </a>
    </div>
    <div class="col-xl-3 col-md-6 col-sm-6 p-2">
        <a href="{{ route('kafaa.services.index') }}" class="kdash-quick">
            <i class="fas fa-circle-plus"></i><span>إضافة خدمة</span>
        </a>
    </div>
    <div class="col-xl-3 col-md-6 col-sm-6 p-2">
        <a href="{{ route('kafaa.experiences.index') }}" class="kdash-quick">
            <i class="fas fa-circle-plus"></i><span>إضافة خبرة</span>
        </a>
    </div>
    <div class="col-xl-3 col-md-6 col-sm-6 p-2">
        <a href="{{ route('kafaa.profile.edit') }}" class="kdash-quick">
            <i class="fas fa-id-card"></i><span>تعديل ملفي الشخصي</span>
        </a>
    </div>
    <div class="col-xl-3 col-md-6 col-sm-6 p-2">
        <a href="{{ route('kafaa.posts.index') }}" class="kdash-quick">
            <i class="fas fa-pen-to-square"></i><span>كتابة منشور</span>
        </a>
    </div>
    <div class="col-xl-3 col-md-6 col-sm-6 p-2">
        <a href="{{ route('kafaa.show', $user->id) }}" target="_blank" class="kdash-quick">
            <i class="fas fa-eye"></i><span>عرض ملفي العام</span>
        </a>
    </div>
</div>

<style>
    /* ===== Welcome Hero ===== */
    .kdash-hero {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
        background: linear-gradient(120deg, #2d114e 0%, #892CDC 55%, #BC6FF1 100%);
        border-radius: 20px;
        padding: 1.8rem 2rem;
        box-shadow: 0 18px 40px rgba(137, 44, 220, 0.25);
        color: #fff;
    }
    .kdash-hero__info { display: flex; align-items: center; gap: 1.2rem; }
    .kdash-hero__avatar {
        width: 78px; height: 78px; border-radius: 50%;
        object-fit: cover; border: 3px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.2); flex-shrink: 0;
    }
    .kdash-hero__hello { margin: 0 0 .2rem; opacity: .9; font-size: .95rem; }
    .kdash-hero__name { margin: 0 0 .6rem; font-size: 1.7rem; font-weight: bold; color: #fff; }
    .kdash-status {
        display: inline-flex; align-items: center; gap: .45rem;
        padding: .35rem .9rem; border-radius: 30px; font-size: .85rem; font-weight: bold;
        background: rgba(255, 255, 255, 0.18); backdrop-filter: blur(4px);
    }
    .kdash-status.is-on  i { color: #5cffb1; }
    .kdash-status.is-off i { color: #ffd0d0; }
    .kdash-hero__actions { display: flex; flex-wrap: wrap; gap: .7rem; }

    /* ===== Buttons ===== */
    .kdash-btn {
        display: inline-flex; align-items: center; gap: .5rem;
        border: none; border-radius: 10px; padding: .65rem 1.3rem;
        font-weight: bold; font-size: .9rem; cursor: pointer; text-decoration: none;
        transition: transform .25s ease, box-shadow .25s ease, opacity .25s ease;
    }
    .kdash-btn:hover { transform: translateY(-2px); text-decoration: none; }
    .kdash-btn--light  { background: #fff; color: #892CDC; box-shadow: 0 8px 18px rgba(0,0,0,.15); }
    .kdash-btn--ghost  { background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.4); }
    .kdash-btn--ghost:hover { color: #fff; background: rgba(255,255,255,0.25); }
    .kdash-btn--danger { background: #ff5b5b; color: #fff; box-shadow: 0 8px 18px rgba(255,91,91,.35); }
    .kdash-btn--danger:hover { color: #fff; }

    /* ===== Section title ===== */
    .kdash-section-title {
        font-size: 1.1rem; font-weight: bold; color: #2d114e;
        margin: .5rem 0 .3rem .8rem; padding-right: .8rem;
        border-right: 4px solid #892CDC;
    }

    /* ===== Stat cards ===== */
    .kdash-stat {
        display: flex; align-items: center; gap: 1rem;
        background: #fff; border-radius: 16px; padding: 1.3rem 1.4rem;
        box-shadow: 0 10px 25px rgba(137, 44, 220, 0.08);
        border: 1px solid rgba(137, 44, 220, 0.08);
        height: 100%; text-decoration: none; color: inherit;
        transition: transform .3s ease, box-shadow .3s ease;
        position: relative; overflow: hidden;
    }
    a.kdash-stat:hover {
        transform: translateY(-5px); text-decoration: none; color: inherit;
        box-shadow: 0 18px 35px rgba(137, 44, 220, 0.18);
    }
    .kdash-stat__icon {
        width: 58px; height: 58px; border-radius: 14px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 1.5rem; box-shadow: 0 8px 16px rgba(0,0,0,.12);
    }
    .kdash-stat__body { display: flex; flex-direction: column; }
    .kdash-stat__label { font-size: 1rem; font-weight: bold; color: #5b3f8d; }
    .kdash-stat__count { font-size: 1.9rem; font-weight: bold; color: #2d114e; line-height: 1.15; }
    .kdash-stat__sub   { font-size: .8rem; color: #9a8bb5; }
    .kdash-stat__arrow {
        position: absolute; left: 1.1rem; color: #d7c9ee; font-size: .9rem;
        transition: transform .3s ease, color .3s ease;
    }
    a.kdash-stat:hover .kdash-stat__arrow { transform: translateX(-4px); color: #892CDC; }

    /* ===== Quick actions ===== */
    .kdash-quick {
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        gap: .6rem; background: #fff; border-radius: 16px; padding: 1.4rem 1rem;
        text-align: center; text-decoration: none; height: 100%;
        border: 1px dashed rgba(137, 44, 220, 0.3); color: #5b3f8d; font-weight: bold;
        transition: transform .3s ease, box-shadow .3s ease, background .3s ease, color .3s ease;
    }
    .kdash-quick i { font-size: 1.7rem; color: #892CDC; transition: color .3s ease; }
    .kdash-quick:hover {
        transform: translateY(-4px); text-decoration: none; color: #fff;
        background: linear-gradient(135deg, #892CDC, #BC6FF1);
        box-shadow: 0 14px 28px rgba(137, 44, 220, 0.25); border-color: transparent;
    }
    .kdash-quick:hover i { color: #fff; }

    @media (max-width: 575px) {
        .kdash-hero { padding: 1.4rem; text-align: center; justify-content: center; }
        .kdash-hero__info { flex-direction: column; text-align: center; }
        .kdash-hero__actions { width: 100%; justify-content: center; }
    }
</style>
@endsection
