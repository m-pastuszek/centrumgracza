@extends('layouts.app')
@section('page_title')
    🔴 Transmisje na żywo
@endsection
@section('meta_description')Oglądaj najnowsze i najpopularniejsze transmisje live z różnych platform w jednym miejscu.@endsection
@section('meta_keywords', 'Centrum Gracza, live, gry na żywo, twitch, youtube, mixer, transmisje na żywo, live streams, gaming')

@section('additional_css')
@endsection
@section('additional_js')
@endsection

@section('content')

    <section class="overflow-hidden py-8 px-3 px-md-0" data-parallax="scroll" data-image-src="/storage/pages/stream_page.jpg">
        <div class="overlay" ya-style="background-color: #36373a;opacity: .9"></div>
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2 class="display-3 text-white mb-3">Najpopularniejsze streamy w jednym miejscu!</h2>
                    <p class="h5 font-weight-light text-light mb-0">Lubisz oglądać streamerów, jednak duża ilość platform utrudnia Ci ich ogarnięcie? <br/> Oglądaj wszystkich w jednym miejscu — na Centrum-Gracza.pl.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center mb-4 mb-md-0">
                    <div ya-svg="twitch"></div>
                </div>
                <div class="col-md-4 text-center mb-4 mb-md-0">
                    <div ya-svg="youtube"></div>
                </div>
                <div class="col-md-4 text-center">
                    <div ya-svg="mixer"></div>
                </div>
            </div>
        </div>
    </section>

    <!--
    <section class="bg-image py-0 py-lg-5">
        <img class="background" src="https://img.youtube.com/vi/LDzYR5_TR2o/maxresdefault.jpg" alt="">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card bg-darken mb-0 border-0 rounded-0">
                        <div class="card-header d-flex align-items-center bg-darken">
                            <h6 class="card-title text-white"><i class="fas fa-circle text-danger mr-1 font-size-xs"></i> Battlefield V Grand Operations - Live Gameplay</h6>
                            <div class="dropdown ml-auto">
                                <button class="btn btn-link p-0 text-white" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ya ya-menu"></i></button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Separated link</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0 px-0 px-md-2 pb-0 pb-md-2">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe src="https://player.twitch.tv/?t=01h10m06s&amp;video=v335875299" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    -->


    <section class="py-5 py-lg-7">
        <div class="container">
            <div class="row">
                <div class="col-11 col-md-8 mx-auto text-center mb-5">
                    <i class="ya ya-player icon"></i>
                    <h2 class="font-size-lg">Recently Uploaded Gameplays</h2>
                    <p class="mb-0">Months on ye at by esteem desire warmth former. Sure that that way gave any fond now. His boy middleton sir nor engrossed affection excellent.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-11 mx-auto">
                    <div class="row row-md">
                        <div class="col-md-4 card-group mb-4 mb-md-0">
                            <div class="card">
                                <a class="card-img card-img-lg" href="video-post.html">
                                    <img src="https://i1.ytimg.com/vi/YIRWzlMki4E/maxresdefault.jpg" alt="Far Cry 5 Live Action Gameplay Teaser Trailer">
                                    <div class="card-meta">
                                        <span>1:39</span>
                                    </div>
                                </a>
                                <div class="card-body">
                                    <h6 class="card-title"><a href="video-post.html">Far Cry 5 Live Action Gameplay Teaser </a></h6>
                                    <p class="card-text font-size-md">Built purse maids cease her ham new seven among and. Pulled coming wooded tended...</p>
                                </div>
                                <div class="card-footer">
                                    <span><i class="ya ya-clock"></i> September 14, 2018</span>
                                    <span class="ml-auto"><i class="ya ya-eye"></i> 3432 views</span>
                                </div>
                            </div>
                            <!-- end .card -->
                        </div>
                        <div class="col-md-4 card-group mb-4 mb-md-0">
                            <div class="card">
                                <a class="card-img card-img-lg" href="video-post.html">
                                    <img src="https://i1.ytimg.com/vi/HYrcX8QIIAs/maxresdefault.jpg" alt="God of War 4: The Lost Pages of Norse">
                                    <div class="card-meta">
                                        <span>2:19</span>
                                    </div>
                                </a>
                                <div class="card-body">
                                    <h6 class="card-title"><a href="video-post.html">God of War 4: The Lost Pages of Norse</a></h6>
                                    <p class="card-text font-size-md">Is at purse tried jokes china ready decay an. Small its shy way had woody downs ...</p>
                                </div>
                                <div class="card-footer">
                                    <span><i class="ya ya-clock"></i> September 13, 2018</span>
                                    <span class="ml-auto"><i class="ya ya-eye"></i> 2583 views</span>
                                </div>
                            </div>
                            <!-- end .card -->
                        </div>
                        <div class="col-md-4 card-group mb-4 mb-md-0">
                            <div class="card">
                                <a class="card-img card-img-lg" href="video-post.html">
                                    <img src="https://i1.ytimg.com/vi/N9fTYUj8pLE/maxresdefault.jpg" alt="Cyberpunk 2077 Gameplay Walkthrough 50 Minutes Demo">
                                    <div class="card-meta">
                                        <span>4:32</span>
                                    </div>
                                </a>
                                <div class="card-body">
                                    <h6 class="card-title"><a href="video-post.html">Cyberpunk 2077 Gameplay Walkthrough 50</a></h6>
                                    <p class="card-text font-size-md">We take an in-depth look at some of the traditional, and outright insane, vehicl...</p>
                                </div>
                                <div class="card-footer">
                                    <span><i class="ya ya-clock"></i> September 11, 2018</span>
                                    <span class="ml-auto"><i class="ya ya-eye"></i> 437 views</span>
                                </div>
                            </div>
                            <!-- end .card -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-md-5">
                <a class="btn btn-secondary btn-lg" href="videos.html" role="button">More Videos</a>
            </div>
        </div>
    </section>

    <section class="bg-dark p-1">
        <div class="container-fluid px-0">
            <div class="owl-carousel" ya-carousel="autowidth: true;dots: false;margin: 4;items: 2">
                <div class="owl-img owl-img-games lazyload">
                    <img class="lazyload" data-src="https://static.giantbomb.com/uploads/original/0/1992/2862202-27046828293_28e9c64a2b_o.jpg" alt="">
                    <div class="owl-caption owl-caption-bottom">
                        <h1 class="owl-title bg-darken text-white"><a href="game-post.html">God of War</a></h1>
                    </div>
                </div>
                <div class="owl-img owl-img-games lazyload">
                    <img class="lazyload" data-src="https://static.giantbomb.com/uploads/original/13/135472/3043941-5881871274-IsUman1n" alt="">
                    <div class="owl-caption owl-caption-bottom">
                        <h1 class="owl-title bg-darken text-white"><a href="game-post.html">The Division 2</a></h1>
                    </div>
                </div>
                <div class="owl-img owl-img-games lazyload">
                    <img class="lazyload" data-src="https://static.giantbomb.com/uploads/original/8/81005/2644135-14384067381_83a6e6c758_b.jpg" alt="">
                    <div class="owl-caption owl-caption-bottom">
                        <h1 class="owl-title bg-darken text-white"><a href="game-post.html">Dead Island 2</a></h1>
                    </div>
                </div>
                <div class="owl-img owl-img-games lazyload">
                    <img class="lazyload" data-src="https://static.giantbomb.com/uploads/original/13/135472/3015262-1249798788-Hah9zjpb" alt="">
                    <div class="owl-caption owl-caption-bottom">
                        <h1 class="owl-title bg-darken text-white"><a href="game-post.html">Marvel's Spider-Man</a></h1>
                    </div>
                </div>
                <div class="owl-img owl-img-games lazyload">
                    <img class="lazyload" data-src="https://static.giantbomb.com/uploads/original/9/95676/2644892-u4.jpg" alt="">
                    <div class="owl-caption owl-caption-bottom">
                        <h1 class="owl-title bg-darken text-white"><a href="game-post.html">Uncharted 4</a></h1>
                    </div>
                </div>
                <div class="owl-img owl-img-games lazyload">
                    <img class="lazyload" data-src="https://static.giantbomb.com/uploads/original/0/3699/2757242-ratchet+%26+clank+v3.jpg" alt="">
                    <div class="owl-caption owl-caption-bottom">
                        <h1 class="owl-title bg-darken text-white"><a href="game-post.html">Ratchet and Clank</a></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white border-top border-top py-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 py-5 m-auto text-left">
                    <div class="px-1 px-md-0">
                        <svg viewBox="0 0 48 48" width="48" height="48" style="opacity: .5">
                            <g fill="#111111">
                                <g class="nc-loop_mouse-48">
                                    <path fill="#111111" d="M28,47h-8c-6.1,0-11-4.9-11-11V12C9,5.9,13.9,1,20,1h8c6.1,0,11,4.9,11,11v24C39,42.1,34.1,47,28,47z M20,3 c-5,0-9,4-9,9v24c0,5,4,9,9,9h8c5,0,9-4,9-9V12c0-5-4-9-9-9H20z"></path>
                                    <path data-color="color-2" d="M24,22L24,22c-1.1,0-2-0.9-2-2v-6c0-1.1,0.9-2,2-2h0c1.1,0,2,0.9,2,2v6C26,21.1,25.1,22,24,22 z" transform="translate(0 0)"></path>
                                </g>
                                <script>
                                    ! function() {
                                        function t(t) {
                                            this.element = t, this.wheel = this.element.querySelectorAll("*")[1], this.animationId, this.start = null, this.init()
                                        }
                                        if (!window.requestAnimationFrame) {
                                            var i = null;
                                            window.requestAnimationFrame = function(t, n) {
                                                var e = (new Date).getTime();
                                                i || (i = e);
                                                var a = Math.max(0, 16 - (e - i)),
                                                    o = window.setTimeout(function() {
                                                        t(e + a)
                                                    }, a);
                                                return i = e + a, o
                                            }
                                        }
                                        t.prototype.init = function() {
                                            var t = this;
                                            this.animationId = window.requestAnimationFrame(t.triggerAnimation.bind(t))
                                        }, t.prototype.reset = function() {
                                            var t = this;
                                            window.cancelAnimationFrame(t.animationId)
                                        }, t.prototype.triggerAnimation = function(t) {
                                            var i = this;
                                            this.start || (this.start = t);
                                            var n = t - this.start,
                                                e = Math.min(n / 62.5, 12),
                                                a = e > 6 ? 12 - e : e;
                                            750 > n || (this.start = this.start + 750), this.wheel.setAttribute("transform", "translate(0 " + a + ")");
                                            if (document.documentElement.contains(this.element)) window.requestAnimationFrame(i.triggerAnimation.bind(i))
                                        };
                                        var n = document.getElementsByClassName("nc-loop_mouse-48"),
                                            e = [];
                                        if (n)
                                            for (var a = 0; n.length > a; a++) ! function(i) {
                                                e.push(new t(n[i]))
                                            }(a);
                                        document.addEventListener("visibilitychange", function() {
                                            "hidden" == document.visibilityState ? e.forEach(function(t) {
                                                t.reset()
                                            }) : e.forEach(function(t) {
                                                t.init()
                                            })
                                        })
                                    }();
                                </script>
                            </g>
                        </svg>
                        <h2 class="display-5 font-weight-normal text-dark mb-5 mt-4">“I've always loved to play multiplayer fps games.”</h2>
                        <p class="mb-4">Received the likewise law graceful his. Nor might set along charm now equal green. Pleased yet equally correct colonel not one. Say anxious carried compact conduct ps4 general nay certain.</p>
                        <hr class="my-5">
                        <p class="mb-5">Although moreover mistaken kindness me feelings do be marianne. Son over own nay with tell they cold upon are.</p>
                        <a class="mr-2" href="#"><i class="ya ya-facebook"></i></a>
                        <a class="mr-2" href="#"><i class="ya ya-twitter"></i></a>
                        <a class="mr-2" href="#"><i class="ya ya-twitch"></i></a>
                        <a class="mr-2" href="#"><i class="ya ya-instagram"></i></a>
                    </div>
                </div>
                <div class="col-md-6 img-cover py-7" style="min-height: 700px;">
                    <img src="/storage/img/streamer-1.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
@endsection