@extends('client.layout.clientMasterApp')

@section('Home')
   <!--============ start home =================-->
<section class="home" id="home">
    <div class="home-container">
        <!-- home text -->
        <div class="home-text">
            <span class="hello">مرحبًا بك في</span>
            <h1>
                <span>منصة </span>كفاءات <br>حيث <span class="multtext">المهارات تتحدث</span>
            </h1>
            <p>
                وجهتك الأولى لاستعراض السير الذاتية لأصحاب الخبرات والكفاءات. 
                اكتشف ملفات تعريفية شاملة تشمل المهارات، الخبرات العملية، والإنجازات، 
                وتواصل مع أفضل المتخصصين في مختلف المجالات.
            </p>
            <!-- button -->
            <div class="home-btns">
                <a href="#profiles" class="btn">تصفح المواهب</a>
                <a href="#" class="btn btn--transparent">انضم إلينا</a>
            </div>
        </div>
        <!-- brand logo instead of image -->
        <div class="home-img">
            <div class="brand-logo">
                <span class="brand-name">كفاءات</span>
                <span class="brand-tagline">منصة الخبراء</span>
            </div>
        </div>
    </div>
</section>
<!--============== end home =================-->
        <section class="profiles" id="profiles">
            <div class="heading text-center mb-5">
                <h1>السير الذاتية المتاحة</h1>
                <span>تعرف على أفضل المتخصصين واطلع على خبراتهم بسرعة</span>
            </div>

            <div class="profiles-grid">
            <div class="container mt-5">
        <h2 class="text-center mb-5" style="font-weight: 700; color: var(--main-color, #333);">أبرز الكفاءات</h2>
        <div class="row">
            <style>
                .expert-card {
                    background: #fff;
                    border-radius: 20px;
                    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
                    transition: all 0.3s ease;
                    text-align: center;
                    padding: 30px 20px 20px;
                    margin-bottom: 30px;
                    border: 1px solid #f0f0f0;
                    height: 100%;
                    display: flex;
                    flex-direction: column;
                }
                .expert-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
                    border-color: var(--main-color, #e0a800);
                }
                .expert-img-container {
                    margin-bottom: 20px;
                }
                .expert-img-container img {
                    width: 100px;
                    height: 100px;
                    object-fit: cover;
                    border-radius: 50%;
                    border: 3px solid var(--main-color, #e0a800);
                    padding: 3px;
                }
                .expert-name {
                    font-size: 1.2rem;
                    font-weight: 700;
                    color: #2c3e50;
                    margin-bottom: 5px;
                }
                .expert-specialty {
                    color: var(--main-color, #e0a800);
                    font-size: 0.9rem;
                    font-weight: 600;
                    margin-bottom: 15px;
                }
                .expert-bio {
                    font-size: 0.85rem;
                    color: #666;
                    line-height: 1.6;
                    margin-bottom: 20px;
                    flex-grow: 1;
                }
                .expert-meta {
                    display: flex;
                    justify-content: center;
                    gap: 10px;
                    font-size: 0.85rem;
                    color: #888;
                    margin-bottom: 20px;
                    padding-top: 15px;
                    border-top: 1px dashed #eee;
                }
                .expert-meta i {
                    color: var(--main-color, #e0a800);
                    margin-left: 5px;
                }
                .btn-view-profile {
                    background-color: transparent;
                    color: var(--main-color, #e0a800);
                    border: 2px solid var(--main-color, #e0a800);
                    border-radius: 25px;
                    padding: 8px 25px;
                    font-weight: 600;
                    transition: 0.3s;
                    display: inline-block;
                    width: 100%;
                }
                .btn-view-profile:hover {
                    background-color: var(--main-color, #e0a800);
                    color: #fff;
                    text-decoration: none;
                }
            </style>

            @foreach ($users as $user)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 p-2">
                    <div class="expert-card">
                        <div class="expert-img-container">
                            <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('/client/img/profile.png') }}" alt="{{ $user->name }}">
                        </div>
                        <h5 class="expert-name">{{ $user->name }}</h5>
                        <div class="expert-specialty">{{ $user->specialty ?? 'كفاءة مميزة' }}</div>
                        
                        <p class="expert-bio">
                            {{ \Illuminate\Support\Str::limit($user->bio ?? 'لا توجد نبذة تعريفية متاحة حالياً.', 70) }}
                        </p>

                        <div class="expert-meta">
                            <span><i class="fa-solid fa-location-dot"></i> {{ $user->location ?? 'غير محدد' }}</span>
                        </div>

                        <div class="mt-auto">
                            <a href="{{ route('kafaa.show', $user->id) }}" class="btn-view-profile">عرض السيرة الذاتية</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
        </section>
@endsection