<!--inside-article-->
<div class="article-details">
    <div class="inside-article">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('website.home') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="#">المقالات</a></li>
                        <li class="breadcrumb-item active" aria-current="page">الوقاية من الأمراض</li>
                    </ol>
                </nav>
            </div>
            <div class="article-image">
                <img src="{{ asset('img/posts/' . $post->photo) }}">
            </div>
            <div class="article-title col-12">
                <div class="h-text col-6">
                    <h4>{{ $post->title }}</h4>
                </div>
                <div class="icon col-6">
                    <button type="button"><i class="far fa-heart"></i></button>
                </div>
            </div>

            <!--text-->
            <div class="text">
                <p>
                    {{ $post->content }}
                </p>
            </div>

        </div>
    </div>
</div>
