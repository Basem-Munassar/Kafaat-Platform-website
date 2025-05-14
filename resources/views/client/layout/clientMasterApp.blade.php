<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <title>Basem Munassar website</title>
    <!--=========== link cdnjs ============ -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <!--======== link style =========-->
    <link rel="stylesheet" href="{{ asset('/client/style.css') }}">
    <!--======== link icons ===========-->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel='stylesheet'>

</head>

<body>

    <!--=============== welcomePopup ==============-->
    <div id="welcomePopup" class="popup">
        <div class="popup-content">
            <p>مرحبًا بك في موقعي الشخصي!</p>
            <button id="closePopup">إغلاق</button>
        </div>
    </div>

    <!--==================== STYLE SWITCHER ====================-->
    <input type="radio" name="color" id="color-1">
    <input type="radio" name="color" id="color-2">
    <input type="radio" name="color" id="color-3">
    <input type="radio" name="color" id="color-4">
    <input type="radio" name="color" id="color-5">
    <input type="radio" name="color" id="color-6">
    <input type="radio" name="color" id="color-7">
    <input type="radio" name="color" id="color-8">
    <input type="radio" name="color" id="color-9">
    <input type="radio" name="color" id="color-10">
    <input type="checkbox" name="" id="toggler">

    <!-- style-switcher -->
    <div class="style-switcher">
        <label for="toggler" class="style-switcher-toggler">
            <i class="fa-solid fa-gear fa-spin"></i>
        </label>
        <h3 class="style-switcher-title">حدد ستايل الالوان</h3>
        <!-- style-switcher-colors -->
        <div class="style-switcher-colors">
            <label for="color-1" class="color-1 color"></label>
            <label for="color-2" class="color-2 color"></label>
            <label for="color-3" class="color-3 color"></label>
            <label for="color-4" class="color-4 color"></label>
            <label for="color-5" class="color-5 color"></label>
            <label for="color-6" class="color-6 color"></label>
            <label for="color-7" class="color-7 color"></label>
            <label for="color-8" class="color-8 color"></label>
            <label for="color-9" class="color-9 color"></label>
            <label for="color-10" class="color-10 color"></label>
        </div>
    </div>

    <!--================== start header ============-->
    <header class="header">
        <!-- logo -->
        <a href="#" class="logo"><i class='bx bx-laptop'></i></a>
        <!-- navbar -->
        <nav class="navbar">
            <a href="#home">الرئيسة</a>
            <a href="#about">من نحن</a>
            <a href="#skills">المهارات</a>
            <a href="#services">الخدمات</a>
            <a href="#portfolio">المشاريع</a>
            <a href="#Reviews">الاراء</a>
            <a href="#contact">تواصل معنا</a>
        </nav>

        <!-- socail links-->
        <div class="wrapper">
            <div class="icon facebook">
                <div class="tooltip">
                    Facebook
                </div>
                <span><i class='bx bxl-facebook-circle'></i></span>
            </div>
            <div class="icon instagram">
                <div class="tooltip">
                    Instagram
                </div>
                <span><i class='bx bxl-instagram-alt'></i></span>
            </div>
            <div class="icon github">
                <div class="tooltip">
                    Github
                </div>
                <span><i class='bx bxl-github'></i></span>
            </div>
            <div class="icon youtube">
                <div class="tooltip">
                    linkedin
                </div>
                <span><i class='bx bxl-linkedin-square'></i></span>
            </div>
        </div>
    </header>
    <!--================= end header =============-->
    <!------------------------------ start main ------------------------------------->
    <main class="main">
        <!--================ start home ==============-->
        @yield('Home')
        <!--================= end home =============-->
        <!--================ start about ==============-->
        @yield('about')
        <!--================ end about ===================-->
        <!--================ start skills ===================-->
        @yield('skills')
        <!--================ end skills ===================-->
        <!--================ start services ==============-->
        @yield('services')
        <!--================ end services ==============-->
        <!--================ start reviews ==============-->
        @yield('reviews')
        <!--================ end reviews ==============-->

        <!--================ start portfolio ==============-->
        @yield('portfolio')
        <!--================ end portfolio ==============-->
        <!--================ start subscribe ==============-->
        @yield('subscribe')
        <!--================ end subscribe ==============-->
        <!--================ start contact ==============-->
        @yield('contact')
        <!--================ end contact ==============-->
    </main>
    <!------------------------------ end main --------------------------------------->
    <!-- ================== start footer================ -->
    <footer class="footer">
        <div class="footer-container">
            <div class="copyright">
                <p>© 2025 باسم منصر الهمداني. كل الحقوق محفوظة.</p>
            </div>
            <!-- socail -->
            <div class="wrapper-1">
                <div class="icon-1 facebook-1">
                    <div class="tooltip-1">
                        Facebook
                    </div>
                    <span><i class='bx bxl-facebook-circle'></i></span>
                </div>
                <div class="icon-1 instagram-1">
                    <div class="tooltip-1">
                        Instagram
                    </div>
                    <span><i class='bx bxl-instagram-alt'></i></span>
                </div>
                <div class="icon-1 github-1">
                    <div class="tooltip-1">
                        Github
                    </div>
                    <span><i class='bx bxl-github'></i></span>
                </div>
                <div class="icon-1 linkedin-1">
                    <div class="tooltip-1">
                        linkedin
                    </div>
                    <span><i class='bx bxl-linkedin-square'></i></span>
                </div>
            </div>
        </div>
    </footer>
    <!-- ================== end footer================ -->


    <!--============ link script ================-->
    <script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/typed.js@2.0.12') }}"></script>
    <script src="{{ asset('/client/main.js') }}"></script>
</body>

</html>
