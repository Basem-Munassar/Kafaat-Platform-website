@extends('client.layout.clientMasterApp')

@section('Home')
<!--============ start home =================-->
        <section class="home" id="home">
            <div class="home-container">
            <!-- home text -->
            <div class="home-text">
                <span class="hello">مرحبا</span>
                <h1>
                     <span>انا </span>باسم منصر الهمداني <br>a <span class="multtext">مطور وجهات امامية</span>  </h1>
                <p>
                    "عالم الواجهات الأمامية هو شغفي ومجالي المفضل. أنا متخصص في تحسين تجربة المستخدم من خلال تصاميم جذابة ومستجيبة تتوافق مع أحدث الاتجاهات. دعونا نعمل سويًا لنجعل رؤيتك الإبداعية واقعًا."
                </p>
                <!-- button -->
                <div class="home-btns">
                <a href="#contact" class="btn">وظفني</a>
                <a href="#portfolio" class="btn btn--transparent" >مشاريعي </a>
                </div>
            </div>
            <!-- img -->
            <div class="home-img">
                <img src="{{ asset('/client/img/pexels-photo-2379004-removebg-preview.png')}}" alt="">
            </div>
            </div>
        </section>
        <!--============== end home =================-->
@endsection