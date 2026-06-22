@extends('admin.layout.masterApp')

@section('pageTitle', 'الآراء والتقييمات')
@section('pageDescription', 'مراجعة وحذف آراء الزوار')

@section('reviews')
<div class="apage-head">
    <div>
        <h4 class="apage-title"><i class="fas fa-star mr-2"></i>الآراء والتقييمات</h4>
        <span class="apage-count">{{ $reviewCount }} رأي · متوسط التقييم {{ $avgRating }}/5</span>
    </div>
</div>

<div class="row m-1">
    @forelse ($reviews as $review)
        <div class="col-xl-4 col-md-6 p-2">
            <div class="apanel h-100" style="padding:1.2rem;">
                <div class="d-flex align-items-center" style="gap:.7rem;">
                    <img class="aimg aimg-round" src="{{ $review->image ? asset('storage/' . $review->image) : asset('admin/img/user-profile.jpg') }}" alt="">
                    <div style="flex:1;">
                        <div style="font-weight:bold;color:#2d114e;">{{ $review->name }}</div>
                        <div class="adash-stars" style="font-size:.85rem;">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star" style="color: {{ $i <= $review->rating ? '#ffc107' : '#e2dced' }};"></i>
                            @endfor
                        </div>
                    </div>
                </div>
                <p style="color:#6b5b85; margin:.8rem 0; font-size:.9rem;">{{ $review->comment }}</p>
                <div class="d-flex align-items-center justify-content-between">
                    <small class="text-muted">
                        @if ($review->profile_user_id)
                            <i class="fas fa-user-tie"></i> عن: {{ optional($review->profileUser)->name ?? 'كفاءة #' . $review->profile_user_id }}
                        @else
                            <i class="fas fa-globe"></i> رأي عام
                        @endif
                        · {{ $review->created_at ? $review->created_at->format('Y-m-d') : '' }}
                    </small>
                    <form action="{{ route('admin.reviews.delete', $review->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا الرأي؟')">
                        @csrf @method('DELETE')
                        <button type="submit" class="abtn-del" title="حذف"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12"><div class="aempty"><i class="fas fa-star"></i><p class="mt-2">لا توجد آراء بعد.</p></div></div>
    @endforelse
</div>
@endsection
