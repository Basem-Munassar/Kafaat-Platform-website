@extends('client.layout.clientMasterApp')

@section('contact')
    <!-- ================== start  contact ================-->
    <section class="contact" id="contact">
        <!-- heading -->
        <div class="heading">
            <h1>تواصل معنا</h1>
        </div>
        <div class="container">
            <div class="contact-card">
                <div class="contact-content" data-reveal="left">
                    <div class="card-icon">
                        <img src="{{ asset('/client/img/icon-5.svg') }}" width="44" height="44" loading="lazy"
                            alt="envelop icon">
                    </div>
                    <h2 class="h2 section-title">إذا أعجبك ما تراه ، فلنعمل معًا.</h2>
                    <p class="section-text">
                        أقدم حلولًا سريعة لجعل حياة عملائي أسهل. لديك أي أسئلة؟ تواصل معي من نموذج الاتصال وسأعاود الاتصال
                        بك قريبًا.
                    </p>
                    <div class="contint-links">
                        <div class="conteint-box">
                            <a href=""><i class='bx bx-map'></i></a>
                            <span>اليمن, صنعاء</span>
                        </div>
                        <div class="conteint-box">
                            <a href=""><i class='bx bxs-phone'></i></a>
                            <span>+967 777309964</span>
                        </div>
                        <div class="conteint-box">
                            <a href=""><i class='bx bxl-gmail'></i></a>
                            <span>basemmunassar@gmail.com</span>
                        </div>
                    </div>
                </div>
                <form action="" class="contact-form" data-reveal="right">
                    <div class="input-wrapper">
                        <input type="text" name="posterName" placeholder="الاسم *" required class="input-field">
                        <input type="email" name="posterEmail" placeholder="الاميل *" required class="input-field">
                    </div>
                    <input type="text" name="content" placeholder="الموضوع *" required class="input-field-2">
                    <textarea name="message" placeholder="الرسالة *" required class="input-field"></textarea>
                    <button type="submit" class="btn btn-secondary">ارسل الرسالة</button>
                </form>
            </div>
        </div>
    </section>
    <!-- ================== END  contact ================-->
@endsection
