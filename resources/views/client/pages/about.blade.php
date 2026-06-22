@extends('client.layout.clientMasterApp')
@section('about')
    <!--================ start about ==============-->
    <section class="about" id="about">
        <div class="heading">
            <h1>عن كفاءات</h1>
        </div>
        <div class="about-container ">
            <div class="about-img">
                <img src="{{ asset('client/img/about1.svg') }}" alt="منصة كفاءات لعرض الخبرات">
            </div>
            <div class="about-text">
                <h1>
                    <span>منصة </span>كفاءات <br>حيث <span>الخبرات تلتقي</span>
                </h1>
                <p>
                    كفاءات هي منصتك الأولى لاستعراض السير الذاتية للمحترفين وأصحاب الخبرات المتميزة.
                    نقدم لك ملفات شخصية شاملة تعرض المهارات، الإنجازات، والخبرات العملية،
                    لنسهّل عليك اكتشاف أفضل الكفاءات في مختلف التخصصات.
                    <br><br>
                    تم تطوير هذه المنصة بالكامل على يد <strong>باسم عبدالرحمن صالح منصر الهمداني</strong>،
                    مطور واجهات أمامية شغوف بتحويل الأفكار إلى تجارب رقمية سلسة وجذابة.
                </p>
                <a href="{{ route('kafaa.show', 1) }}" class="btn">السيرة الذاتية للمطور</a>
            </div>
        </div>
    </section>
    <!--================ end about ===================-->
@endsection