@extends('client.layout.expertMasterApp')

@section('Home')
<section class="kafaa-profile-page">
    <div class="profile-hero">
        <div class="profile-hero__image">
            <img src="{{ $kafaa->profile_image ? asset('storage/' . $kafaa->profile_image) : asset('/client/img/profile.png') }}" alt="{{ $kafaa->name }}">
        </div>
        <div class="profile-hero__content">
            <h1>{{ $kafaa->name }}</h1>
            <p class="profile-hero__role">{{ $kafaa->specialty ?? 'كفاءة مميزة' }}</p>
            <p class="profile-hero__bio">{{ $kafaa->bio ?? 'سيرة ذاتية مصممة لعرض الخبرات والكفاءات بطريقة احترافية.' }}</p>
            <div class="profile-hero__meta">
                <span>{{ $kafaa->location ?: 'غير محدد' }}</span>
                <span>{{ $kafaa->email }}</span>
                <span>{{ $kafaa->phone ?: 'بدون رقم هاتف' }}</span>
            </div>
            <div class="profile-hero__badges">
                <span class="badge {{ $kafaa->is_available ? 'badge-success' : 'badge-secondary' }}">
                    {{ $kafaa->is_available ? 'متاحة للعمل' : 'غير متاحة للعمل' }}
                </span>
                <a href="{{ route('client.contact') }}" class="btn btn-primary">تواصل معنا</a>
            </div>
        </div>
    </div>

    <div class="profile-sections">
        <div class="profile-section" id="overview">
            <h2>نبذة عن الكفاءة</h2>
            <p>{{ $kafaa->bio ?? 'لا توجد معلومات إضافية حتى الآن.' }}</p>
        </div>

        <div class="profile-section" id="skills">
            <h2>المهارات</h2>
            @if($kafaa->skills->isNotEmpty())
                <div class="profile-tags">
                    @foreach($kafaa->skills as $skill)
                        <span>{{ $skill->name }}</span>
                    @endforeach
                </div>
            @else
                <p>لا توجد مهارات مدرجة بعد.</p>
            @endif
        </div>

        <div class="profile-section" id="projects">
            <h2>المشاريع</h2>
            @if($kafaa->projects->isNotEmpty())
                <div class="projects-grid">
                    @foreach($kafaa->projects as $project)
                        <div class="project-card">
                            <h3>{{ $project->title }}</h3>
                            <p>{{ \Illuminate\Support\Str::limit($project->description, 100) }}</p>
                            <span>{{ $project->technologies }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p>لا توجد مشاريع منشورة حتى الآن.</p>
            @endif
        </div>

        <div class="profile-section" id="certifications">
            <h2>الشهادات</h2>
            @if($kafaa->certifications->isNotEmpty())
                <ul>
                    @foreach($kafaa->certifications as $certification)
                        <li>{{ $certification->name }} - {{ $certification->institution }}</li>
                    @endforeach
                </ul>
            @else
                <p>لا توجد شهادات مدرجة حتى الآن.</p>
            @endif
        </div>

        <div class="profile-section" id="languages">
            <h2>اللغات</h2>
            @if($kafaa->languages->isNotEmpty())
                <div class="profile-tags">
                    @foreach($kafaa->languages as $language)
                        <span>{{ $language->name }} ({{ $language->level }})</span>
                    @endforeach
                </div>
            @else
                <p>لا توجد لغات مدرجة بعد.</p>
            @endif
        </div>

        <div class="profile-section" id="social">
            <h2>روابط التواصل</h2>
            @if($kafaa->socialLinks->isNotEmpty())
                <ul class="social-links">
                    @foreach($kafaa->socialLinks as $link)
                        <li><a href="{{ $link->link }}" target="_blank">{{ $link->platform ?? 'رابط' }}</a></li>
                    @endforeach
                </ul>
            @else
                <p>لا توجد روابط تواصل مضافة بعد.</p>
            @endif
        </div>
    </div>
</section>
@endsection
