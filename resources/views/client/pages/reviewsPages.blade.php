@extends('client.layout.clientMasterApp')

@section('reviews')
 <!-- ================== start  Reviews ================-->
 <section class="reviews" id="Reviews">
    <!-- heading -->
    <div class="heading">
        <h1>المراجعات</h1>
        <span>اكتشف أفضل العروض<br>شكرا لي الأشخاص الأعلى تقييماً</span>
    </div>
    <div class="reviews-container">
        <!-- card 1 -->
        <div class="reviews-card">
            <img src="{{ asset('/client/img/rev1.jpg')}}" alt="">
            <h2>
                أحمد عبد الرحمن
            </h2>
            <div class="star">
                <i class='bx bxs-star-half' ></i>
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
            </div>
            <p>
                خدمة رائعة ومحترفة. تمكنت من تحسين تجربة المستخدم لموقعي بشكل مذهل!
            </p>
        </div>
        <!-- card 2 -->
        <div class="reviews-card">
            <img src="{{ asset('/client/img/rev3.jpg')}}" alt="">
            <h2>ليلى محمد</h2>
            <div class="star">
                <i class='bx bxs-star-half' ></i>
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
            </div>
            <p>خدمة رائعة وفريق يتمتع بالاحترافية. أنا سعيدة جدًا بالنتائج!</p>
        </div>
        <!-- card 3 -->
        <div class="reviews-card">
            <img src="{{ asset('/client/img/rev2.jpg')}}" alt="">
            <h2>محمد علي</h2>
            <div class="star">
                <i class='bx bxs-star-half' ></i>
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
            </div>
            <p>
                خدمة ممتازة ونتائج فوق توقعاتي. لا يمكنني سوى التوصية بها للجميع!
            </p>
        </div>
    </div>
</section>
<!--=================== end Reviews ===================-->

@endsection