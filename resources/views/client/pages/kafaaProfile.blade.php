@extends($cvLayout ?? 'client.layout.expertMasterApp')

@section('Home')
<!--============ start home =================-->
<section class="home" id="home">
    <div class="home-container">
        <div class="home-text">
            <span class="hello">مرحبا</span>
            <h1>
                <span>أنا </span>{{ $kafaa->name }}<br>
                <span class="multtext">{{ $kafaa->specialty ?? 'خبير' }}</span>
            </h1>
            <p>{{ $kafaa->bio ?? 'شغوف بمجالي وأسعى دائمًا لتقديم الأفضل.' }}</p>
            <div class="home-btns">
                <a href="#contact" class="btn">وظفني</a>
                <a href="#portfolio" class="btn btn--transparent">مشاريعي</a>
            </div>
        </div>
        <div class="home-img">
            <img src="{{ $kafaa->profile_image ? asset('storage/' . $kafaa->profile_image) : asset('client/img/pexels-photo-2379004-removebg-preview.png') }}" alt="{{ $kafaa->name }}">
        </div>
    </div>
</section>
<!--============== end home =================-->

<!--================ start about ==============-->
<section class="about" id="about">
    <div class="heading">
        <h1>من أنا؟</h1>
    </div>
    <div class="about-container">
        <div class="about-img">
            <img src="{{ asset('client/img/about1.svg') }}" alt="عن الكفاءة">
        </div>
        <div class="about-text">
            <h1><span>أنا </span>{{ $kafaa->name }}<br><span>{{ $kafaa->specialty ?? 'خبير' }}</span></h1>
            <p>{{ $kafaa->bio ?? 'لم يتم إضافة نبذة بعد.' }}</p>
            @if($kafaa->jobTitles->isNotEmpty())
                <div style="display:flex; flex-wrap:wrap; gap:.6rem; margin:1rem 0 1.4rem;">
                    @foreach($kafaa->jobTitles as $job)
                        <span style="background:rgba(137,44,220,.08); border:1px solid rgba(137,44,220,.2); color:#2d114e; padding:.4rem 1rem; border-radius:30px; font-weight:bold; font-size:.9rem;">
                            <i class='bx bx-briefcase'></i> {{ $job->title }}
                        </span>
                    @endforeach
                </div>
            @endif
            <a href="#" class="btn">السيرة الذاتية</a>
        </div>
    </div>
</section>
<!--================ end about ===================-->

<!--================ start experiences ===============-->
@if($kafaa->experiences->isNotEmpty())
<section class="experiences" id="experiences" style="padding:4rem 1rem;">
    <div class="heading">
        <h1>خبراتي العملية</h1>
        <span>مسيرتي المهنية</span>
    </div>
    <div style="max-width:850px; margin:2.5rem auto 0; position:relative;">
        @foreach($kafaa->experiences->sortByDesc('start_date') as $exp)
            <div style="background:#fff; border-radius:14px; padding:1.4rem 1.6rem; margin-bottom:1.2rem; box-shadow:0 8px 24px rgba(137,44,220,.08); border-right:4px solid #892CDC;">
                <h2 style="margin:0 0 .3rem; color:#2d114e; font-size:1.25rem;">{{ $exp->title }}</h2>
                <p style="margin:0 0 .4rem; color:#892CDC; font-weight:bold;"><i class='bx bx-buildings'></i> {{ $exp->company }}</p>
                <small style="color:#7c6a9c;">
                    <i class='bx bx-calendar'></i>
                    {{ \Carbon\Carbon::parse($exp->start_date)->format('Y-m') }}
                    —
                    {{ $exp->is_current ? 'حتى الآن' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('Y-m') : '') }}
                </small>
                @if($exp->description)
                    <p style="margin:.7rem 0 0; color:#555; line-height:1.8;">{{ $exp->description }}</p>
                @endif
            </div>
        @endforeach
    </div>
</section>
@endif
<!--================ end experiences ===============-->

<!--================ start certifications ===============-->
@if($kafaa->certifications->isNotEmpty())
<section class="certifications" id="certifications" style="padding:4rem 1rem;">
    <div class="heading">
        <h1>الشهادات</h1>
        <span>شهاداتي ومؤهلاتي</span>
    </div>
    <div style="max-width:1000px; margin:2.5rem auto 0; display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:1.2rem;">
        @foreach($kafaa->certifications as $cert)
            <div style="background:#fff; border-radius:14px; padding:1.3rem 1.5rem; box-shadow:0 8px 24px rgba(137,44,220,.08); border-top:4px solid #BC6FF1;">
                <h2 style="margin:0 0 .4rem; color:#2d114e; font-size:1.1rem;"><i class='bx bxs-medal' style="color:#892CDC;"></i> {{ $cert->name }}</h2>
                <p style="margin:0 0 .3rem; color:#7c6a9c;">{{ $cert->issuer }}</p>
                @if($cert->issue_date)
                    <small style="color:#999;"><i class='bx bx-calendar'></i> {{ \Carbon\Carbon::parse($cert->issue_date)->format('Y-m') }}</small>
                @endif
                @if($cert->link)
                    <div class="mt-2"><a href="{{ $cert->link }}" target="_blank" style="color:#892CDC; font-weight:bold;">عرض الشهادة <i class='bx bx-link-external'></i></a></div>
                @endif
            </div>
        @endforeach
    </div>
</section>
@endif
<!--================ end certifications ===============-->

<!--================= start skills =============-->
<section class="skills" id="skills">
    <div class="heading">
        <h1>مهاراتي</h1>
        <span>مهاراتي المفضلة</span>
    </div>
    @php
        // خريطة المستوى إلى نسبة مئوية لشريط التقدّم
        $levelPercent = function ($level) {
            $map = ['مبتدئ' => 30, 'متوسط' => 55, 'متقدم' => 80, 'خبير' => 100,
                    'beginner' => 30, 'intermediate' => 55, 'advanced' => 80, 'expert' => 100, 'professional' => 90];
            $key = mb_strtolower(trim((string) $level));
            return $map[$key] ?? 60;
        };
        // تجميع حسب التصنيف، مع تجاهل التصنيفات الفارغة أو الرقمية (بيانات قديمة)
        $skillGroups = $kafaa->skills->groupBy(function ($s) {
            return (!$s->category || is_numeric($s->category)) ? '' : $s->category;
        });
    @endphp

    <div class="kp-skills">
        @forelse($skillGroups as $groupTitle => $group)
            <div class="kp-skills__group">
                @if($groupTitle !== '')
                    <h3 class="kp-skills__title"><i class='bx bx-category'></i> {{ $groupTitle }}</h3>
                @endif
                <div class="kp-skills__grid">
                    @foreach($group as $skill)
                        <div class="kp-skill-card">
                            <div class="kp-skill-card__head">
                                <span class="kp-skill-card__name">{{ $skill->name }}</span>
                                <span class="kp-skill-card__level">{{ $skill->level ?? 'متوسط' }}</span>
                            </div>
                            <div class="kp-skill-card__bar">
                                <span style="width: {{ $levelPercent($skill->level) }}%;"></span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <p class="text-center">لا توجد مهارات مضافة بعد.</p>
        @endforelse
    </div>

    <style>
        .kp-skills { max-width: 1000px; margin: 2.5rem auto 0; padding: 0 1rem; }
        .kp-skills__group { margin-bottom: 2rem; }
        .kp-skills__title { color: #892CDC; text-align: center; margin-bottom: 1.4rem; font-size: 1.3rem; }
        .kp-skills__grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.2rem;
        }
        .kp-skill-card {
            background: #fff;
            border: 1px solid rgba(137, 44, 220, 0.12);
            border-radius: 14px;
            padding: 1.1rem 1.3rem;
            box-shadow: 0 8px 22px rgba(137, 44, 220, 0.06);
            transition: transform .3s ease, box-shadow .3s ease;
        }
        .kp-skill-card:hover { transform: translateY(-5px); box-shadow: 0 14px 30px rgba(137, 44, 220, 0.14); }
        .kp-skill-card__head { display: flex; justify-content: space-between; align-items: center; margin-bottom: .7rem; }
        .kp-skill-card__name { font-weight: bold; color: #2d114e; font-size: 1.05rem; }
        .kp-skill-card__level {
            font-size: .75rem; font-weight: bold; color: #892CDC;
            background: rgba(137, 44, 220, 0.1); padding: .2rem .7rem; border-radius: 20px; white-space: nowrap;
        }
        .kp-skill-card__bar { height: 8px; background: #eee5f7; border-radius: 10px; overflow: hidden; }
        .kp-skill-card__bar span {
            display: block; height: 100%;
            background: linear-gradient(90deg, #892CDC, #BC6FF1); border-radius: 10px;
        }
    </style>

    {{-- اللغات --}}
    @if($kafaa->languages->isNotEmpty())
        <div class="kp-langs" style="max-width:1100px; margin:2.5rem auto 0; padding:0 1rem;">
            <h3 style="text-align:center; color:#892CDC; margin-bottom:1.2rem;"><i class='bx bx-globe'></i> اللغات</h3>
            <div style="display:flex; flex-wrap:wrap; gap:.8rem; justify-content:center;">
                @foreach($kafaa->languages as $lang)
                    <span style="background:rgba(137,44,220,.08); border:1px solid rgba(137,44,220,.2); color:#2d114e; padding:.5rem 1.1rem; border-radius:30px; font-weight:bold;">
                        {{ $lang->language }} <small style="color:#7c6a9c;">({{ $lang->level }})</small>
                    </span>
                @endforeach
            </div>
        </div>
    @endif
</section>
<!--================ end skills ===============-->

<!--================ start  services ===============-->
<section class="services" id="services">
    <div class="services-heading">
        <h1>خدماتي</h1>
        <span>ماذا أقدم؟</span>
    </div>
    <div class="serices-continer">
        <div class="continer-box">
            @forelse($kafaa->services as $index => $service)
                <div class="box">
                    <div class="box-icons">
                        <a href="#"><i class='bx {{ $service->icon ?: 'bx-briefcase' }}'></i></a>
                        <h2>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</h2>
                    </div>
                    <h2>{{ $service->title }}</h2>
                    <p>{{ $service->description }}</p>
                </div>
            @empty
                <p class="text-center">لم تتم إضافة خدمات بعد.</p>
            @endforelse
        </div>
    </div>
</section>
<!--================ end  services ================-->

<!-- =============== start  portfolio ===============-->
<section class="portfolio" id="portfolio">
    <div class="services-heading">
        <h1>مشاريعي</h1>
        <span>اكتشف مجموعة مشاريعي المميزة</span>
    </div>
    <div class="portfolio-container">
        @if($kafaa->projects->isNotEmpty())
            @foreach($kafaa->projects as $project)
                <div class="portfolio-box">
                    <div class="portfolio-img">
                        <img src="{{ $project->image ? asset('storage/' . $project->image) : asset('client/img/port-1.jpg') }}" alt="{{ $project->title }}">
                    </div>
                    <div class="portfolio-info">
                        <div class="portfolio-title">
                            <h1>{{ $project->title }}</h1>
                            <a href="{{ $project->link ?? '#' }}"><i class='bx bxl-github'></i></a>
                        </div>
                        <p>{{ $project->description }}</p>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center">لا توجد مشاريع منشورة بعد.</p>
        @endif
    </div>
</section>
<!-- ================== end  portfolio ===============-->

<!-- ================== start  Reviews ================-->
<section class="reviews" id="Reviews">
    <div class="heading">
        <h1>المراجعات</h1>
        <span>آراء بعض العملاء</span>
    </div>
    <div class="reviews-container">
        @php
            // مراجعات خاصة بهذه الكفاءة
            $reviews = \App\Models\Review::where('profile_user_id', $kafaa->id)->latest()->take(3)->get();
        @endphp
        @forelse($reviews as $review)
            <div class="reviews-card">
                <img src="{{ $review->image ? asset('storage/' . $review->image) : asset('client/img/rev1.jpg') }}" alt="{{ $review->name }}">
                <h2>{{ $review->name }}</h2>
                <div class="star">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $review->rating)
                            <i class='bx bxs-star'></i>
                        @elseif($i - 0.5 <= $review->rating)
                            <i class='bx bxs-star-half'></i>
                        @else
                            <i class='bx bx-star'></i>
                        @endif
                    @endfor
                </div>
                <p>{{ $review->comment }}</p>
            </div>
        @empty
            <div class="reviews-card">
                <img src="{{ asset('client/img/rev1.jpg') }}" alt="">
                <h2>لا توجد مراجعات بعد</h2>
                <div class="star">
                    <i class='bx bx-star'></i><i class='bx bx-star'></i><i class='bx bx-star'></i><i class='bx bx-star'></i><i class='bx bx-star'></i>
                </div>
                <p>كن أول من يراجع هذه الكفاءة.</p>
            </div>
        @endforelse
    </div>
</section>
<!--=================== end Reviews ===================-->

<!-- ================== start  subscribe ================-->
<section class="subscribe">
    <h1>اشترك لمعرفة كل جديد</h1>
    <div class="subscribe-box">
        <input type="email" placeholder="أدخل بريدك الإلكتروني ...." id="subscriber-email">
        <button id="subbtn"><strong>إشترك الآن!</strong></button>
    </div>
</section>
<!-- ================== end  subscribe ================-->

<!-- ================== start  contact ================-->
<section class="contact" id="contact">
    <div class="heading">
        <h1>تواصل معي</h1>
    </div>
    <div class="container">
        <div class="contact-card">
            <div class="contact-content" data-reveal="left">
                <div class="card-icon">
                    <img src="{{ asset('client/img/icon-5.svg') }}" width="44" height="44" loading="lazy" alt="envelop icon">
                </div>
                <h2 class="h2 section-title">هل أعجبك ما تراه؟ دعنا نعمل معًا</h2>
                <p class="section-text">
                    أقدم حلولًا مبتكرة لتجعل مشروعك مميزًا. تواصل معي وسأرد عليك قريبًا.
                </p>
                <div class="contint-links">
                    <div class="conteint-box">
                        <a href="#"><i class='bx bx-map'></i></a>
                        <span>{{ $kafaa->location ?: 'غير محدد' }}</span>
                    </div>
                    <div class="conteint-box">
                        <a href="#"><i class='bx bxs-phone'></i></a>
                        <span>{{ $kafaa->phone ?: 'غير متوفر' }}</span>
                    </div>
                    <div class="conteint-box">
                        <a href="#"><i class='bx bxl-gmail'></i></a>
                        <span>{{ $kafaa->email }}</span>
                    </div>
                </div>
            </div>
            <form action="{{ route('contact.store') }}" method="POST" class="contact-form" data-reveal="right">
                @csrf
                <div class="input-wrapper">
                    <input type="text" name="name" placeholder="الاسم *" required class="input-field">
                    <input type="email" name="email" placeholder="الإيميل *" required class="input-field">
                </div>
                <input type="text" name="subject" placeholder="الموضوع *" required class="input-field-2">
                <textarea name="message" placeholder="الرسالة *" required class="input-field"></textarea>
                <button type="submit" class="btn btn-secondary">أرسل الرسالة</button>
            </form>
        </div>
    </div>
</section>
<!-- ================== END  contact ================-->
@endsection