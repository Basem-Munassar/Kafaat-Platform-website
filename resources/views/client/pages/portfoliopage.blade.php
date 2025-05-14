@extends('client.layout.clientMasterApp')

@section('portfolio')
    <!-- =============== start  portfolio ===============-->
    <section class="portfolio" id="portfolio">
        <div class="services-heading">
            <h1>مشاريعي</h1>
            <span>اكتشف مجموعة مشاريعي المميزة</span>
        </div>

        <div class="portfolio-container">
            <!-- portfolio-box 1 -->
            <div class="portfolio-box">
                <div class="portfolio-img">
                    <img src="{{ asset('/client/img/port-1.jpg') }}" alt="">
                </div>
                <div class="portfolio-info">
                    <div class="portfolio-title">
                        <h1>تطبيق موقع الويب الديناميكي</h1>
                        <a href="#"><i class='bx bxl-github'></i></a>
                    </div>
                    <p>تم تطوير هذا التطبيق باستخدام تقنيات حديثة لتقديم تجربة مستخدم رائعة.</p>
                </div>
            </div>

            <!-- portfolio-box 2 -->
            <div class="portfolio-box">
                <div class="portfolio-img">
                    <img src="{{ asset('/client/img/port-2.jpg') }}" alt="">
                </div>
                <div class="portfolio-info">
                    <div class="portfolio-title">
                        <h1>تطوير تطبيق محمول</h1>
                        <a href="#"><i class='bx bxl-github'></i></a>
                    </div>
                    <p>تطوير تطبيق محمول يقدم حلاً مبتكرًا للاحتياجات اليومية للمستخدمين.</p>
                </div>
            </div>

            <!-- portfolio-box 3 -->
            <div class="portfolio-box">
                <div class="portfolio-img">
                    <img src="{{ asset('/client/img/port-3.jpg') }}" alt="تصميم موقع ويب إبداعي">
                </div>
                <div class="portfolio-info">
                    <div class="portfolio-title">
                        <h1>تصميم موقع ويب إبداعي</h1>
                        <a href="#"><i class='bx bxl-github'></i></a>
                    </div>
                    <p>تصميم فريد وإبداعي لموقع ويب يجمع بين الجمال وسهولة الاستخدام.</p>
                </div>
            </div>

            <!-- portfolio-box 4 -->
            <div class="portfolio-box">
                <div class="portfolio-img">
                    <img src="{{ asset('/client/img/port-4.jpg') }}" alt="تصميم شعار مبتكر">
                </div>
                <div class="portfolio-info">
                    <div class="portfolio-title">
                        <h1>تصميم شعار مبتكر</h1>
                        <a href="#"><i class='bx bxl-github'></i></a>
                    </div>
                    <p>تم تصميم شعار جديد ومبتكر يعبر عن هوية العلامة التجارية بشكل فريد.</p>
                </div>
            </div>

            <!-- portfolio-box 5 -->
            <div class="portfolio-box">
                <div class="portfolio-img">
                    <img src="{{ asset('/client/img/port-5.jpg') }}" alt="تطوير تطبيق محمول">
                </div>
                <div class="portfolio-info">
                    <div class="portfolio-title">
                        <h1>تصميم واجهة مستخدم مبتكرة</h1>
                        <a href="#"><i class='bx bxl-github'></i></a>
                    </div>
                    <p>تم تصميم هذه الواجهة لتوفير تجربة مستخدم مريحة وجذابة.</p>
                </div>
            </div>

            <!-- portfolio-box 6 -->
            <div class="portfolio-box">
                <div class="portfolio-img">
                    <img src="{{ asset('/client/img/port-6.jpg') }}" alt="تصميم موقع إلكتروني">
                </div>
                <div class="portfolio-info">
                    <div class="portfolio-title">
                        <h1>تصميم موقع إلكتروني</h1>
                        <a href="#"><i class='bx bxl-github'></i></a>
                    </div>
                    <p>تصميم موقع ويب متجاوب يعكس رؤية العميل ويقدم محتوى مميز وجذاب.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- ================== end  portfolio ===============-->
@endsection
