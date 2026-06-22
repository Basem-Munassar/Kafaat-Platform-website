@extends('client.layout.clientMasterApp')

@section('reviews')
    <!-- ================== start  Reviews ================-->
    <section class="reviews" id="Reviews">
        <!-- heading -->
        <div class="heading">
            <h1>آراء المستخدمين</h1>
            <span>ماذا قالوا عن كفاءات؟<br>شاركنا تجربتك</span>
        </div>

        @php
            // افتراض أن الـ Controller يمرر $reviews (Collection)
            $reviews = $reviews ?? collect(); 
        @endphp

        <div class="reviews-container">
            @if($reviews->isNotEmpty())
                @foreach($reviews as $review)
                    <div class="reviews-card">
                        <img src="{{ $review->image ? asset('storage/' . $review->image) : asset('/client/img/default-avatar.png') }}" alt="{{ $review->name }}">
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
                @endforeach
            @else
                <!-- بطاقات افتراضية لحين وجود مراجعات -->
                <div class="reviews-card">
                    <img src="{{ asset('client/img/rev1.jpg') }}" alt="">
                    <h2>باسم عبد الرحمن</h2>
                    <div class="star">
                        <i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star-half'></i>
                    </div>
                    <p>منصة كفاءات ساعدتني في إيجاد أفضل المواهب بسرعة، تجربة فريدة!</p>
                </div>
                <div class="reviews-card">
                    <img src="{{ asset('client/img/rev3.jpg') }}" alt="">
                    <h2>ليلى محمد</h2>
                    <div class="star">
                        <i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i>
                    </div>
                    <p>أفضل منصة لعرض الخبرات، الملفات واضحة والتواصل سهل.</p>
                </div>
                <div class="reviews-card">
                    <img src="{{ asset('client/img/rev2.jpg') }}" alt="">
                    <h2>محمد علي</h2>
                    <div class="star">
                        <i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bx-star'></i>
                    </div>
                    <p>فكرة مبتكرة ورائعة، أحببت طريقة عرض السير الذاتية.</p>
                </div>
            @endif
        </div>

        <!-- ========== نموذج إضافة رأي ========== -->
        <div class="review-form-container" id="add-review">
            <div class="heading">
                <h1>أضف رأيك</h1>
                <span>كيف كانت تجربتك مع كفاءات؟</span>
            </div>

            @if(session('review_success'))
                <div class="alert alert-success">{{ session('review_success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data" class="review-form">
                @csrf
                <div class="form-group">
                    <label for="name">الاسم</label>
                    <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="rating">تقييمك (من 1 إلى 5)</label>
                    <div class="star-rating">
                        <input type="radio" id="star5" name="rating" value="5" {{ old('rating') == 5 ? 'checked' : '' }}><label for="star5" title="ممتاز">★</label>
                        <input type="radio" id="star4" name="rating" value="4" {{ old('rating') == 4 ? 'checked' : '' }}><label for="star4" title="جيد جداً">★</label>
                        <input type="radio" id="star3" name="rating" value="3" {{ old('rating') == 3 ? 'checked' : '' }}><label for="star3" title="جيد">★</label>
                        <input type="radio" id="star2" name="rating" value="2" {{ old('rating') == 2 ? 'checked' : '' }}><label for="star2" title="مقبول">★</label>
                        <input type="radio" id="star1" name="rating" value="1" {{ old('rating') == 1 ? 'checked' : '' }}><label for="star1" title="ضعيف">★</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="comment">تعليقك</label>
                    <textarea name="comment" id="comment" rows="4" class="form-control" required>{{ old('comment') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">صورة شخصية (اختياري)</label>
                    <input type="file" name="image" id="image" class="form-control-file" accept="image/*">
                </div>
                <button type="submit" class="btn">أرسل رأيك</button>
            </form>
        </div>
        <!-- ========== نهاية النموذج ========== -->
    </section>
    <!--=================== end Reviews ===================-->
@endsection