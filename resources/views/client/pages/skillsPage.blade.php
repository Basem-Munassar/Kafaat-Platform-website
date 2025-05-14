@extends('client.layout.clientMasterApp')

@section('skills')
        <!--================= start skills =============-->
        <section class="skills" id="skills">
            <div class="heading">
                <h1>مهراتي</h1>
                <span>مهراتي المفضلة</span>
            </div>

            <div class="skills-container">
                <div class="skills-content">
                    <!-- heading-lift -->
                    <div class="heading-lift">
                        <h3 class="skills-title">
                            <i class="bx bx-code-curly" > مطور الواجهة الأمامية </i>
                        </h3>
                    </div>

                    <!-- skills info html -->
                    <div class="skills-info">
                        <div class="skills-data">
                            <div class="skills-blob">
                                <img src="{{asset('/client/img/html-1.svg')}}" alt="">
                            </div>
                            <h3 class="skills-name">HTML</h3>
                            <span class="skills-subtitle">متقدم</span>
                        </div>
                        <!-- skills info css -->
                        <div class="skills-data">
                            <div class="skills-blob">
                                <img src="{{ asset('/client/img/css-3.svg')}}" alt="">
                            </div>
                            <h3 class="skills-name">CSS</h3>
                            <span class="skills-subtitle">متوسط</span>
                        </div>
                        <!-- skills info javascript-->
                        <div class="skills-data">
                            <div class="skills-blob">
                                <img src="{{ asset('/client/img/logo-javascript.svg')}}" alt="">
                            </div>
                            <h3 class="skills-name">js</h3>
                            <span class="skills-subtitle">اساسيات</span>
                        </div>

                </div>

                <div class="skills-info">
                    <!-- skills info bootstrap-->
                    <div class="skills-data">
                        <div class="skills-blob">
                            <img src="{{ asset('/client/img/bootstrap-4.svg')}}" alt="">
                        </div>
                        <h3 class="skills-name">bootstrap</h3>
                        <span class="skills-subtitle">عادي</span>
                    </div>
                    <div class="skills-data ">
                        <div class="skills-blob">
                            <img src="{{ asset('/client/img/git-icon.svg')}}" alt="">
                        </div>
                        <h3 class="skills-name">Git</h3>
                        <span class="skills-subtitle">متوسط</span>
                    </div>
                </div>
                </div>

                <div class="skills-content">
                    <!-- heading-lift -->
                    <div class="heading-lift">
                        <h3 class="skills-title">
                            <i class='bx bx-palette' ></i> مصمم الويب
                        </h3>
                    </div>
                <!-- skills info adobe-xd -->
                <div class="skills-info">
                    <div class="skills-data">
                        <div class="skills-blob">
                            <img src="{{ asset('/client/img/adobe-xd-1.svg')}}" alt="">
                        </div>
                        <h3 class="skills-name">adobe</h3>
                        <span class="skills-subtitle">متوسط</span>
                    </div>
                    <!-- skills info invision-->
                    <div class="skills-data">
                        <div class="skills-blob">
                            <img src="{{ asset('/client/img/invision.svg')}}" alt="">
                        </div>
                        <h3 class="skills-name">invision</h3>
                        <span class="skills-subtitle">اساسيات</span>
                    </div>
                    <!-- skills info canva-->
                    <div class="skills-data">
                        <div class="skills-blob">
                            <img src="{{ asset('/client/img/canva-1.svg')}}" alt="">
                        </div>
                        <h3 class="skills-name">canva</h3>
                        <span class="skills-subtitle">متقدم</span>
                    </div>
                </div>

                <div class="skills-info">
                    <div class="skills-data">
                        <div class="skills-blob">
                            <img src="{{ asset('/client/img/adobe-photoshop-2.svg')}}" alt="">
                        </div>
                        <h3 class="skills-name">photoshop</h3>
                        <span class="skills-subtitle">متوسط</span>
                    </div>
                    <div class="skills-data">
                        <div class="skills-blob">
                            <img src="{{ asset('/client/img/figma-1.svg')}}" alt="">
                        </div>
                        <h3 class="skills-name">figma</h3>
                        <span class="skills-subtitle">متقدم</span>
                    </div>
                </div>
                </div>
            </div>
        </section>
        <!--================ end skills ===============-->
@endsection