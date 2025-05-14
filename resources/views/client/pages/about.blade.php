@extends('client.layout.clientMasterApp')
@section('about')
        <!--================ start about ==============-->
        <section class="about" id="about">
            <div class="heading">
                <h1>من أنا؟</h1>
            </div>
            <div class="about-container ">
                <div class="about-img">
                    <img src="{{ asset('/client/img/about1.svg')}}" alt="">
                </div>
                <div class="about-text">
                        <h1>
                         <span>انا </span>باسم منصر الهمداني <br>a <span>مطور وجهات امامية</span>
                        </h1>
                        <p>
                            "أنا باسم عبدالرحمن صالح منصر الهمداني، مطور واجهات أمامية مبتكر ومبدع. لدي شغف كبير بتحويل التصاميم إلى تجارب مستخدم مذهلة ومبتكرة. من خلال استخدامي لأحدث تقنيات تطوير الواجهات، أسعى دائمًا إلى تحقيق التوازن المثالي بين الجمال والأداء."
                        </p>
                        <a href="#" class="btn">السيرة الذاتية</a>
                </div>
            </div>
        </section>
        <!--================ end about ===================-->
@endsection