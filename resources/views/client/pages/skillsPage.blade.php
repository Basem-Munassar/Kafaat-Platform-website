@extends('client.layout.clientMasterApp')

@section('skills')
    <!--================= start featured =============-->
    <section class="featured" id="featured">
        <div class="heading">
            <h1>أبرز الكفاءات</h1>
            <span>نخبة متميزة من أصحاب الخبرات</span>
        </div>

        <div class="featured-grid">
            {{-- اختر أبرز 3 كفاءات (يمكنك تغيير المعيار من الكنترولر عبر $featuredUsers) --}}
            @foreach ($featuredUsers ?? $users->take(3) as $user)
                <div class="featured-card">
                    <div class="featured-card__image">
                        <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('/client/img/profile.png') }}" alt="{{ $user->name }}">
                        <div class="featured-card__badge">🌟 خبير</div>
                    </div>
                    <div class="featured-card__content">
                        <h3 class="featured-card__name">{{ $user->name }}</h3>
                        <p class="featured-card__specialty">{{ $user->specialty ?? 'مطور واجهات أمامية' }}</p>
                        <p class="featured-card__bio">{{ \Illuminate\Support\Str::limit($user->bio ?? 'خبرة واسعة في تصميم وتطوير تجارب المستخدم.', 85) }}</p>
                        <div class="featured-card__skills">
                            <span>HTML</span><span>CSS</span><span>JavaScript</span>
                        </div>
                        <a href="{{ route('kafaa.show', $user->id) }}" class="btn featured-card__btn">عرض الملف الشخصي</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!--================= all profiles =============-->
    <section class="profiles" id="profiles">
        <div class="heading text-center mb-5">
            <h1>السير الذاتية المتاحة</h1>
            <span>تعرف على أفضل المتخصصين واطلع على خبراتهم بسرعة</span>
        </div>

        <div class="profiles-grid">
            @foreach ($users as $user)
                <div class="profile-card">
                    <div class="profile-card__head">
                        <div class="profile-card__avatar">
                            <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('/client/img/profile.png') }}" alt="{{ $user->name }}">
                        </div>
                        <h5 class="profile-card__name">{{ $user->name }}</h5>
                        <p class="profile-card__bio">{{ $user->bio ? \Illuminate\Support\Str::limit($user->bio, 100, '...') : 'مطور واجهات أمامية بخبرة عالية في تصميم واجهات المستخدم.' }}</p>
                    </div>

                    <div class="profile-card__info">
                        <div class="profile-card__item">
                            <span>الإيميل</span>
                            <strong>{{ $user->email }}</strong>
                        </div>
                        <div class="profile-card__item">
                            <span>الموقع</span>
                            <strong>{{ $user->location ?: 'غير محدد' }}</strong>
                        </div>
                    </div>

                    <div class="profile-card__button">
                        <a href="{{ route('kafaa.show', $user->id) }}" class="btn">عرض الملف الشخصي</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!--================ end skills ===============-->
@endsection