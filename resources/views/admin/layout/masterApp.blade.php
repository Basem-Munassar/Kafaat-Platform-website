<!doctype html>
<html class="no-js" lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>لوحة مسؤول النظام</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('admin/css/normalize.css') }}">
    <link href="{{ asset('admin/css/fontawsome/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/css/main.css') }}">

    {{-- ===== Theme override: align admin look with the kafaa panel (RTL purple) ===== --}}
    <style>
        body {
            background-color: #eef1f7 !important;
            background-image:
                radial-gradient(circle at 0% 0%, rgba(137, 44, 220, 0.06), transparent 40%),
                radial-gradient(circle at 100% 100%, rgba(188, 111, 241, 0.07), transparent 45%),
                linear-gradient(160deg, #f4f6fb 0%, #eaedf5 100%) !important;
            background-attachment: fixed !important;
            direction: rtl;
        }
        .avam-container::before { left: 0 !important; right: auto !important; box-shadow: none !important; background: transparent !important; }
        #dw-s1.bmd-layout-drawer,
        .animated #dw-s1.bmd-layout-drawer {
            background: linear-gradient(165deg, #2d114e 0%, #1f0c38 100%) !important;
            box-shadow: 4px 0 24px rgba(45, 17, 78, 0.25);
            direction: rtl;
        }
        .side.a-collapse:not(.short) .ul-text { color: #fff; }
        .side-item a { color: #d9d2ec; }
        .side-item.selected a, .side-item a:hover { color: #fff; }
        .side-item.selected { background: rgba(188, 111, 241, .18); border-radius: 8px; }

        /* ===== Top bar ===== */
        .adm-topbar {
            display: flex !important; align-items: center; justify-content: space-between;
            flex-wrap: nowrap; gap: .6rem;
        }
        .adm-toggler { flex-shrink: 0; }
        .adm-topbar__actions { display: flex; align-items: center; gap: .6rem; flex-shrink: 0; }
        .adm-home-btn {
            display: inline-flex; align-items: center; gap: .4rem;
            background: linear-gradient(135deg, #892CDC, #BC6FF1);
            color: #fff; font-weight: bold; border-radius: 10px;
            padding: .5rem 1rem; text-decoration: none; white-space: nowrap;
            transition: transform .25s ease, box-shadow .25s ease;
        }
        .adm-home-btn:hover { color: #fff; transform: translateY(-2px); box-shadow: 0 8px 18px rgba(137,44,220,.3); }
        .adm-user-btn {
            display: inline-flex; align-items: center; gap: .5rem;
            background: #fff; border: 1px solid rgba(137,44,220,.15);
            border-radius: 30px; padding: .25rem .9rem .25rem .3rem;
            font-weight: bold; color: #2d114e; cursor: pointer; transition: box-shadow .25s ease;
        }
        .adm-user-btn:hover { box-shadow: 0 6px 16px rgba(137,44,220,.15); }
        .adm-user-btn::after { margin-right: .2rem; }
        .adm-user-btn__avatar { width: 34px; height: 34px; border-radius: 50%; object-fit: cover; }
        .adm-user-btn__name { font-size: .9rem; }
        .adm-badge-role {
            font-size: .7rem; background: rgba(137,44,220,.12); color: #892CDC;
            padding: .12rem .55rem; border-radius: 20px; font-weight: bold;
        }
        .adm-user-menu {
            border: none; border-radius: 12px; padding: .4rem;
            box-shadow: 0 12px 30px rgba(45,17,78,.18); min-width: 230px;
        }
        .adm-user-menu .dropdown-item { border-radius: 8px; padding: .55rem .8rem; }
        .adm-user-menu .dropdown-item:hover { background: rgba(137,44,220,.08); }

        /* ===== Shared admin page components ===== */
        .apage-head {
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;
            gap: .6rem; margin: .3rem .8rem .8rem;
        }
        .apage-title { font-weight: bold; color: #2d114e; margin: 0; font-size: 1.25rem; }
        .apage-title i { color: #892CDC; }
        .apage-count { font-size: .8rem; color: #9a8bb5; font-weight: bold; }
        .abtn-add {
            display: inline-flex; align-items: center; gap: .4rem; background: linear-gradient(135deg,#892CDC,#BC6FF1);
            color: #fff; border: none; border-radius: 10px; font-weight: bold; padding: .55rem 1.4rem; text-decoration: none;
            transition: transform .25s ease, box-shadow .25s ease;
        }
        .abtn-add:hover { color: #fff; transform: translateY(-2px); box-shadow: 0 8px 18px rgba(137,44,220,.3); text-decoration: none; }
        .apanel { background: #fff; border-radius: 16px; box-shadow: 0 10px 25px rgba(137,44,220,.07);
            border: 1px solid rgba(137,44,220,.08); overflow: hidden; margin: 0 .5rem; }
        .atable { width: 100%; margin: 0; font-size: .9rem; }
        .atable thead th { color: #9a8bb5; font-weight: bold; border: none; padding: 1rem; white-space: nowrap; }
        .atable tbody td { vertical-align: middle; border-color: #f4f1fa; color: #4a3a66; padding: .8rem 1rem; }
        .atable tbody tr:hover { background: #faf8fe; }
        .aimg { width: 46px; height: 46px; border-radius: 10px; object-fit: cover; }
        .aimg-round { border-radius: 50%; }
        .abtn-edit, .abtn-del {
            display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px;
            border-radius: 9px; border: 1px solid; background: #fff; cursor: pointer; transition: all .2s ease;
        }
        .abtn-edit { color: #892CDC; border-color: rgba(137,44,220,.3); }
        .abtn-edit:hover { background: #892CDC; color: #fff; }
        .abtn-del { color: #e74c6f; border-color: rgba(231,76,111,.3); }
        .abtn-del:hover { background: #e74c6f; color: #fff; }
        .atag { font-size: .72rem; font-weight: bold; padding: .2rem .7rem; border-radius: 20px; white-space: nowrap; }
        .atag-admin { background: rgba(137,44,220,.12); color: #892CDC; }
        .atag-kafaa { background: rgba(78,101,255,.12); color: #4E65FF; }
        .atag-user  { background: #f0f0f5; color: #7c6a9c; }
        .atag-soft  { background: rgba(54,209,220,.14); color: #2c8ea0; }
        .aempty { text-align: center; padding: 2.5rem 1rem; color: #9a8bb5; }
        .aempty i { font-size: 2.5rem; color: #d7c9ee; }
        /* form card */
        .aform-card { background: #fff; border-radius: 16px; box-shadow: 0 10px 25px rgba(137,44,220,.07);
            border: 1px solid rgba(137,44,220,.08); padding: 1.6rem; margin: 0 .5rem; }
        .aform-card label { font-weight: bold; color: #5b3f8d; font-size: .9rem; }
        .aform-card .form-control { border-radius: 10px; }
        .abtn-save { background: linear-gradient(135deg,#892CDC,#BC6FF1); color: #fff; border: none;
            border-radius: 10px; font-weight: bold; padding: .6rem 1.8rem; }
        .abtn-save:hover { color: #fff; box-shadow: 0 8px 18px rgba(137,44,220,.3); }
        .abtn-cancel { background: #f0f0f5; color: #7c6a9c; border: none; border-radius: 10px; font-weight: bold; padding: .6rem 1.6rem; }
    </style>
</head>

<body class="">
    <div class="bmd-layout-container bmd-drawer-f-l avam-container animated bmd-drawer-in">
        @php
            $adminUser = Auth::user();
            $adminAvatar = ($adminUser && $adminUser->profile_image)
                ? asset('storage/' . $adminUser->profile_image)
                : (session('user_image') ? asset('storage/' . session('user_image')) : asset('admin/img/user-profile.jpg'));
            $adminRoleLabel = match($adminUser->role ?? '') {
                'super admin' => 'مسؤول أعلى',
                'admin'       => 'مسؤول النظام',
                default       => 'مسؤول',
            };
        @endphp
        <header class="bmd-layout-header ">
            <div class="navbar navbar-light bg-faded animate__animated animate__fadeInDown adm-topbar">
                <button class="navbar-toggler adm-toggler" type="button" data-toggle="drawer" data-target="#dw-s1" aria-label="القائمة">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="adm-topbar__actions">
                    <a href="{{ route('home.index') }}" class="adm-home-btn">
                        <i class="fas fa-home"></i><span class="d-none d-sm-inline">الموقع</span>
                    </a>

                    <div class="dropdown">
                        <button class="adm-user-btn dropdown-toggle" type="button" id="admUserMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ $adminAvatar }}" alt="avatar" class="adm-user-btn__avatar">
                            <span class="adm-user-btn__name d-none d-md-inline">{{ $adminUser->name ?? 'المسؤول' }}</span>
                        </button>
                        <div aria-labelledby="admUserMenu" class="dropdown-menu dropdown-menu-right adm-user-menu">
                            <span class="dropdown-item-text px-3 py-2">
                                <span style="font-weight:bold; color:#2d114e;">{{ $adminUser->name ?? 'المسؤول' }}</span><br>
                                <span class="adm-badge-role">{{ $adminRoleLabel }}</span>
                            </span>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('admin.dashboard.index') }}" class="dropdown-item"><i class="fas fa-gauge fa-sm mr-2" style="color:#892CDC;"></i>لوحة التحكم</a>
                            <a href="{{ route('admin.users.index') }}" class="dropdown-item"><i class="fas fa-users fa-sm mr-2" style="color:#892CDC;"></i>إدارة المستخدمين</a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('auth.logout') }}" class="m-0">
                                @csrf
                                <button class="dropdown-item text-danger" type="submit"><i class="fas fa-sign-out-alt fa-sm mr-2"></i>تسجيل الخروج</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div id="dw-s1" class="bmd-layout-drawer bg-faded">
            <div class="container-fluid side-bar-container">
                <header class="pb-0 text-center mt-3">
                    <h4 class="text-white"><i class="fas fa-shield-halved mr-1"></i> لوحة المسؤول</h4>
                </header>

                <ul class="side a-collapse ">
                    <a class="ul-text"><i class="fas fa-tachometer-alt mr-1"></i> الرئيسية
                        <i class="fas fa-chevron-down arrow"></i></a>
                    <div class="side-item-container ">
                        <li class="side-item {{ request()->routeIs('admin.dashboard.*') ? 'selected' : '' }}">
                            <a href="{{ route('admin.dashboard.index') }}"><i class="fas fa-angle-right mr-2"></i>نظرة عامة</a>
                        </li>
                        <li class="side-item {{ request()->routeIs('admin.users.*') ? 'selected' : '' }}">
                            <a href="{{ route('admin.users.index') }}"><i class="fas fa-angle-right mr-2"></i>المستخدمون</a>
                        </li>
                    </div>
                </ul>

                <ul class="side a-collapse ">
                    <a class="ul-text"><i class="fas fa-layer-group mr-1"></i> إدارة المحتوى
                        <i class="fas fa-chevron-down arrow"></i></a>
                    <div class="side-item-container ">
                        <li class="side-item {{ request()->routeIs('admin.projects.*') ? 'selected' : '' }}">
                            <a href="{{ route('admin.projects.index') }}"><i class="fas fa-angle-right mr-2"></i>المشاريع</a>
                        </li>
                        <li class="side-item {{ request()->routeIs('admin.skills.*') ? 'selected' : '' }}">
                            <a href="{{ route('admin.skills.index') }}"><i class="fas fa-angle-right mr-2"></i>المهارات</a>
                        </li>
                        <li class="side-item {{ request()->routeIs('admin.languages.*') ? 'selected' : '' }}">
                            <a href="{{ route('admin.languages.index') }}"><i class="fas fa-angle-right mr-2"></i>اللغات</a>
                        </li>
                        <li class="side-item {{ request()->routeIs('admin.jobsTitle.*') ? 'selected' : '' }}">
                            <a href="{{ route('admin.jobsTitle.index') }}"><i class="fas fa-angle-right mr-2"></i>المسميات الوظيفية</a>
                        </li>
                        <li class="side-item {{ request()->routeIs('admin.posts.*') ? 'selected' : '' }}">
                            <a href="{{ route('admin.posts.index') }}"><i class="fas fa-angle-right mr-2"></i>المنشورات</a>
                        </li>
                    </div>
                </ul>

                <ul class="side a-collapse ">
                    <a class="ul-text"><i class="fas fa-comments mr-1"></i> التفاعل
                        <i class="fas fa-chevron-down arrow"></i></a>
                    <div class="side-item-container ">
                        <li class="side-item {{ request()->routeIs('admin.reviews.*') ? 'selected' : '' }}">
                            <a href="{{ route('admin.reviews.index') }}"><i class="fas fa-angle-right mr-2"></i>الآراء والتقييمات</a>
                        </li>
                        <li class="side-item {{ request()->routeIs('admin.messages.*') ? 'selected' : '' }}">
                            <a href="{{ route('admin.messages.index') }}"><i class="fas fa-angle-right mr-2"></i>رسائل التواصل</a>
                        </li>
                    </div>
                </ul>
            </div>
        </div>

        <main class="bmd-layout-content">
            <div class="container-fluid ">
                <div class="row">
                    <div class="page-header breadcrumb-header shade p-3 mr-2 ml-2 m-2">
                        <div class="row align-items-end ">
                            <div class="col-lg-8">
                                <div class="page-header-title">
                                    <div class="d-inline">
                                        <h3 class="lite-text ">@yield('pageTitle', 'لوحة مسؤول النظام')</h3>
                                        <span class="lite-text ">@yield('pageDescription', 'التحكم الكامل بالنظام والمستخدمين والمحتوى')</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success m-2" style="border-radius:10px;">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger m-2" style="border-radius:10px;">{{ session('error') }}</div>
                @endif

                <!-- content -->
                @yield('dashboardContent')
                @yield('users')
                @yield('addAndEditUser')
                @yield('projects')
                @yield('addAndEditProject')
                @yield('skills')
                @yield('addAndEditSkill')
                @yield('languages')
                @yield('addAndEditLanguage')
                @yield('jobsTitle')
                @yield('addAndEditJobTitle')
                @yield('posts')
                @yield('addAndEditPost')
                @yield('reviews')
                @yield('messages')
            </div>
        </main>
    </div>

    <script src="{{ asset('admin/js/vendor/modernizr.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script>
        $(document).ready(function() {
            $('body').bootstrapMaterialDesign();
        });
    </script>
    <script src="{{ asset('admin/js/main.js') }}"></script>
    @yield('scripts')
</body>
</html>
