@extends('website.layouts.app')

@section('content')
<!-- articles -->
<div class="articles py-4" dir="rtl">
    <div class="container">
        <div class="head-text mb-4 d-flex align-items-center justify-content-between">
            <h2 class="m-0 fw-bold">المقالات</h2>
            {{-- لو عايز زر "عرض الكل" أو حاجة تانية حطها هنا --}}
        </div>

        <div class="row">
            @forelse ($posts as $post)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card article-card h-100 border-0 shadow-sm rounded-4 overflow-hidden">

                        {{-- صورة المقال + الأزرار العائمة --}}
                        <div class="articlee-photo position-relative">
                            <img
                                src="{{ asset('img/posts/' . ($post->photo ?? 'default.jpg')) }}"
                                class="w-100 d-block articlee-img"
                                alt="{{ $post->title }}"
                                loading="lazy"
                            >

                            {{-- زر المفضلة (القلب) --}}
                            <button 
                                class="favouritee-btn position-absolute border-0 bg-transparent p-1 rounded-circle shadow-sm"
                                style="top: .75rem; left: .75rem; background-color: #2d3e50;"
                                data-post-id="{{ $post->id }}"
                                type="button"
                                aria-label="أضف للمفضلة"
                            >
                                <i class="far fa-heart fs-5" style="font-size: 1.4rem; color: #ec0000;"></i>
                            </button>

                            {{-- زر المزيد --}}
                            <a 
                                href="{{ route('website.article-details', $post->id) }}"
                                class="more-btn position-absolute text-decoration-none small fw-semibold px-3 py-1 rounded-pill"
                                style="bottom: .75rem; right: .75rem; background-color: rgba(0,0,0,.6); color: #fff;"
                                aria-label="اقرأ المزيد عن {{ $post->title }}"
                            >
                                المزيد
                            </a>
                        </div>

                        {{-- جسم الكارت --}}
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-2 fw-bold" style="line-height: 1.4;">
                                <a 
                                    href="{{ route('website.article-details', $post->id) }}"
                                    class="text-decoration-none text-dark"
                                >
                                    {{ $post->title }}
                                </a>
                            </h5>

                            <p class="card-text text-muted small flex-grow-1" style="line-height: 1.6;">
                                {{ \Illuminate\Support\Str::words(strip_tags($post->content), 20, '...') }}
                            </p>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    لا توجد مقالات متاحة حالياً.
                </div>
            @endforelse
        </div>

        {{-- الباجيناشن --}}
        @if ($posts->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $posts->onEachSide(1)->links('vendor.pagination.arabic') }}
            </div>
        @endif

    </div>
</div>


@endsection
