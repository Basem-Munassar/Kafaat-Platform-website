<!doctype html>
<html class="no-js" lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>لوحة الكفاءة</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('kafaa/css/normalize.css') }}">
    <link href="{{ asset('kafaa/css/fontawsome/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('kafaa/css/main.css') }}">
</head>

<body class="">
    <div class="bmd-layout-container bmd-drawer-f-l avam-container animated bmd-drawer-in">
        @php
            $kafaaUser = Auth::user();
            $kafaaAvatar = ($kafaaUser && $kafaaUser->profile_image) ? asset('storage/' . $kafaaUser->profile_image) : asset('/client/img/profile.png');
        @endphp
        <header class="bmd-layout-header ">
            <div class="navbar navbar-light bg-faded animate__animated animate__fadeInDown kafaa-topbar">
                <!-- Sidebar toggler (RTL start = right) -->
                <button class="navbar-toggler kafaa-toggler" type="button" data-toggle="drawer" data-target="#dw-s1" aria-label="القائمة">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Actions group (RTL end = left) -->
                <div class="kafaa-topbar__actions">
                    <a href="{{ route('home.index') }}" class="kafaa-home-btn">
                        <i class="fas fa-home"></i><span class="d-none d-sm-inline">الرئيسية</span>
                    </a>

                    <div class="dropdown">
                        <button class="kafaa-user-btn dropdown-toggle" type="button" id="kafaaUserMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ $kafaaAvatar }}" alt="avatar" class="kafaa-user-btn__avatar">
                            <span class="kafaa-user-btn__name d-none d-md-inline">{{ $kafaaUser->name ?? 'كفاءة' }}</span>
                        </button>
                        <div aria-labelledby="kafaaUserMenu" class="dropdown-menu dropdown-menu-right kafaa-user-menu">
                            <span class="dropdown-item-text px-3 py-2" style="font-weight:bold; color:#2d114e;">{{ $kafaaUser->name ?? 'كفاءة' }}</span>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('kafaa.profile.edit') }}" class="dropdown-item"><i class="fas fa-id-card fa-sm mr-2" style="color:#892CDC;"></i>تعديل ملفي الشخصي</a>
                            <a href="{{ route('kafaa.show', Auth::id()) }}" target="_blank" class="dropdown-item"><i class="far fa-user fa-sm mr-2" style="color:#892CDC;"></i>عرض ملفي العام</a>
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

        <style>
            .kafaa-topbar {
                display: flex !important;
                align-items: center;
                justify-content: space-between;
                flex-wrap: nowrap;
                gap: .6rem;
            }
            .kafaa-toggler { flex-shrink: 0; }
            .kafaa-topbar__actions { display: flex; align-items: center; gap: .6rem; flex-shrink: 0; }

            .kafaa-home-btn {
                display: inline-flex; align-items: center; gap: .4rem;
                background: linear-gradient(135deg, #892CDC, #BC6FF1);
                color: #fff; font-weight: bold; border-radius: 10px;
                padding: .5rem 1rem; text-decoration: none; white-space: nowrap;
                transition: transform .25s ease, box-shadow .25s ease;
            }
            .kafaa-home-btn:hover { color: #fff; transform: translateY(-2px); box-shadow: 0 8px 18px rgba(137,44,220,.3); }

            .kafaa-user-btn {
                display: inline-flex; align-items: center; gap: .5rem;
                background: #fff; border: 1px solid rgba(137,44,220,.15);
                border-radius: 30px; padding: .25rem .9rem .25rem .3rem;
                font-weight: bold; color: #2d114e; cursor: pointer;
                transition: box-shadow .25s ease;
            }
            .kafaa-user-btn:hover { box-shadow: 0 6px 16px rgba(137,44,220,.15); }
            .kafaa-user-btn::after { margin-right: .2rem; }
            .kafaa-user-btn__avatar { width: 34px; height: 34px; border-radius: 50%; object-fit: cover; }
            .kafaa-user-btn__name { font-size: .9rem; }

            .kafaa-user-menu {
                border: none; border-radius: 12px; padding: .4rem;
                box-shadow: 0 12px 30px rgba(45,17,78,.18); min-width: 220px;
            }
            .kafaa-user-menu .dropdown-item { border-radius: 8px; padding: .55rem .8rem; }
            .kafaa-user-menu .dropdown-item:hover { background: rgba(137,44,220,.08); }
        </style>

        <div id="dw-s1" class="bmd-layout-drawer bg-faded">
            <div class="container-fluid side-bar-container">
                <header class="pb-0 text-center mt-3">
                    <h4 class="text-white">لوحة الكفاءة</h4>
                </header>

                <ul class="side a-collapse ">
                    <a class="ul-text"><i class="fas fa-tachometer-alt mr-1"></i> القائمة الرئيسية 
                        <i class="fas fa-chevron-down arrow"></i></a>
                    <div class="side-item-container ">
                        <li class="side-item {{ request()->routeIs('kafaa.dashboard.index') ? 'selected' : '' }}">
                            <a href="{{ route('kafaa.dashboard.index') }}"><i class="fas fa-angle-right mr-2"></i>نظرة عامة</a>
                        </li>
                        <li class="side-item {{ request()->routeIs('kafaa.projects.*') ? 'selected' : '' }}">
                            <a href="{{ route('kafaa.projects.index') }}"><i class="fas fa-angle-right mr-2"></i>مشاريعي</a>
                        </li>
                        <li class="side-item {{ request()->routeIs('kafaa.skills.*') ? 'selected' : '' }}">
                            <a href="{{ route('kafaa.skills.index') }}"><i class="fas fa-angle-right mr-2"></i>مهاراتي</a>
                        </li>
                        <li class="side-item {{ request()->routeIs('kafaa.languages.*') ? 'selected' : '' }}">
                            <a href="{{ route('kafaa.languages.index') }}"><i class="fas fa-angle-right mr-2"></i>لغاتي</a>
                        </li>
                        <li class="side-item {{ request()->routeIs('kafaa.jobsTitle.*') ? 'selected' : '' }}">
                            <a href="{{ route('kafaa.jobsTitle.index') }}"><i class="fas fa-angle-right mr-2"></i>مسمياتي الوظيفية</a>
                        </li>
                        <li class="side-item {{ request()->routeIs('kafaa.experiences.*') ? 'selected' : '' }}">
                            <a href="{{ route('kafaa.experiences.index') }}"><i class="fas fa-angle-right mr-2"></i>خبراتي</a>
                        </li>
                        <li class="side-item {{ request()->routeIs('kafaa.services.*') ? 'selected' : '' }}">
                            <a href="{{ route('kafaa.services.index') }}"><i class="fas fa-angle-right mr-2"></i>خدماتي</a>
                        </li>
                        <li class="side-item {{ request()->routeIs('kafaa.posts.*') ? 'selected' : '' }}">
                            <a href="{{ route('kafaa.posts.index') }}"><i class="fas fa-angle-right mr-2"></i>منشوراتي</a>
                        </li>
                    </div>
                </ul>

                <ul class="side a-collapse ">
                    <a class="ul-text"><i class="fas fa-user-cog mr-1"></i> حسابي
                        <i class="fas fa-chevron-down arrow"></i></a>
                    <div class="side-item-container ">
                        <li class="side-item {{ request()->routeIs('kafaa.profile.*') ? 'selected' : '' }}">
                            <a href="{{ route('kafaa.profile.edit') }}"><i class="fas fa-angle-right mr-2"></i>ملفي الشخصي</a>
                        </li>
                        <li class="side-item {{ request()->routeIs('kafaa.shareLinks.*') ? 'selected' : '' }}">
                            <a href="{{ route('kafaa.shareLinks.index') }}"><i class="fas fa-angle-right mr-2"></i>مشاركة سيرتي</a>
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
                                        <h3 class="lite-text ">@yield('pageTitle', 'لوحة تحكم الموظف')</h3>
                                        <span class="lite-text ">@yield('pageDescription', 'إدارة السيرة الذاتية والمشاريع')</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- content -->
                 @yield('dashboardContent')
                 @yield('profileContent')
                 @yield('shareLinks')
                 @yield('projects')
                 @yield('addAndEditProject')
                 @yield('skills')
                 @yield('addAndEditSkill')
                 @yield('languages')
                 @yield('addAndEditLanguage')
                 @yield('jobsTitle')
                 @yield('addAndEditJobTitle')
                 @yield('experiences')
                 @yield('addAndEditExperience')
                 @yield('services')
                 @yield('addAndEditService')
                 @yield('posts')
            </div>
        </main>
    </div>

    <script src="{{ asset('kafaa/js/vendor/modernizr.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"></script>
    <script>
        $(document).ready(function() {
            $('body').bootstrapMaterialDesign();
        });
    </script>
    <script src="{{ asset('kafaa/js/main.js') }}"></script>
</body>
</html>
