@extends('layout')
@section('content')
    <div class="row container" id="wrapper">
    <div class="halim-panel-filter">
        <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
            <div class="ajax"></div>
        </div>
    </div>
    <div id="halim_related_movies-2xx" class="wrap-slider">
        <div class="section-bar clearfix">
           <h3 class="section-title"><span>PHIM HOT</span></h3>
        </div>
        <div id="phim_hot" class="owl-carousel owl-theme related-film">
            @foreach ($hot_movies as $hot_movie)
                <article class="thumb grid-item post-38498">
                <div class="halim-item">
                    <a class="halim-thumb" href="{{route('movie', $hot_movie->slug)}}" title="{{$hot_movie->title}}">
                        <figure><img class="lazy img-responsive" src="{{asset('../uploads/movie/'.$hot_movie->image)}}" alt="{{$hot_movie->title}}" title="{{$hot_movie->title}}"></figure>
                        <span class="status">
                            @if($hot_movie->quality == 1)
                                HD
                            @elseif ($hot_movie->quality == 2)
                                Full HD
                            @else
                                SD
                            @endif
                        </span>
                        <span class="episode">
                            {{count($hot_movie->episodes)}}/{{$hot_movie->episode}} |
                            @if($hot_movie->subtitles == 1)
                                Vietsub
                            @elseif($hot_movie->subtitles == 2)
                                Engsub
                            @elseif($hot_movie->subtitles == 3)
                                Thuyết minh
                            @else
                                Lồng tiếng
                            @endif
                        </span> 
                        <div class="icon_overlay"></div>
                        <div class="halim-post-title-box">
                        <div class="halim-post-title ">
                            <p class="entry-title">{{$hot_movie->title}}</p>
                        </div>
                        </div>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
        @foreach ($movies_categories as $category_home)
            <section id="halim-advanced-widget-2">
                <div class="section-heading">
                    <a href="{{route('category', $category_home->slug)}}" title="{{$category_home->title}}">
                    <span class="h-text">{{$category_home->title}}</span>
                    </a>
                </div>
                <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                    @foreach ($category_home->movie->take(12) as $key => $movie)
                        <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                            <div class="halim-item">
                                <a class="halim-thumb" href="{{route('movie', $movie->slug)}}" title="{{$movie->title}}">
                                    <figure><img class="lazy img-responsive" src="{{asset('../uploads/movie/'.$movie->image)}}" alt="{{$movie->title}}" title="{{$movie->title}}"></figure>
                                    <span class="status">
                                        @if($movie->quality == 1)
                                            HD
                                        @elseif ($movie->quality == 2)
                                            Full HD
                                        @else
                                            SD
                                        @endif
                                    </span>
                                    <span class="episode">
                                        {{count($movie->episodes)}}/{{$movie->episode}} |
                                        @if($movie->subtitles == 1)
                                            Vietsub
                                        @elseif($movie->subtitles == 2)
                                            Engsub
                                        @elseif($movie->subtitles == 3)
                                            Thuyết minh
                                        @else
                                            Lồng tiếng
                                        @endif
                                    </span> 
                                    <div class="icon_overlay"></div>
                                    <div class="halim-post-title-box">
                                        <div class="halim-post-title ">
                                        <p class="entry-title">{{$movie->title}}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
            <div class="clearfix"></div>
        @endforeach
    </main>
    @include('pages.include.sidebar')
    </div>
@endsection