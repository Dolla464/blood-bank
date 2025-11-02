<!--intro-->
@if (session('success'))
    <div id="flash-success" class="alert alert-success">{{ session('success') }}</div>
    <script>
        // Wait a few seconds, then fade out and remove
        setTimeout(() => {
            const el = document.getElementById('flash-success');
            if (el) {
                el.style.transition = 'opacity 0.8s';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 800);
            }
        }, 3000); // 👈 3 seconds (change to 5000 for 5s, etc.)
    </script>
@endif
<div class="intro">
    <div id="slider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#slider" data-slide-to="0" class="active"></li>
            <li data-target="#slider" data-slide-to="1"></li>
            <li data-target="#slider" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item carousel-1 active">
                <div class="container info">
                    <div class="col-lg-5">
                        <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                        <p>
                            {{ $settings->about_app }}
                        </p>
                        <a href="#">المزيد</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item carousel-2">
                <div class="container info">
                    <div class="col-lg-5">
                        <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                        <p>
                            {{ $settings->about_app }}
                        </p>
                        <a href="#">المزيد</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item carousel-3">
                <div class="container info">
                    <div class="col-lg-5">
                        <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                        <p>
                            {{ $settings->about_app }}
                        </p>
                        <a href="#">المزيد</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
