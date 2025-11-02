<!--articles-->
<div class="articles">
    <div class="container title">
        <div class="head-text">
            <h2>المقالات</h2>
        </div>
    </div>
    <div class="view">
        <div class="container">
            <div class="row">
                <!-- Set up your HTML -->
                <div class="owl-carousel articles-carousel">
                    @foreach ($posts as $post)
                    <div class="card">
                        <div class="photo">
                            <img src="{{ asset('img/posts/' . $post->photo) }}" class="card-img-top" alt="Post Photo">
                            <a href="{{ route('website.article-details', $post->id) }}" class="click">المزيد</a>
                        </div>
                        <a href="#" class="favourite">
                            <i class="far fa-heart"></i>
                        </a>

                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">
                                {{ \Illuminate\Support\Str::words(strip_tags($post->content), 20, '...') }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

