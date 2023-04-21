@extends('layout')
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs">
                  <span>
                     <span>
                        <a href="{{route('category',$movie->category->slug)}}">{{$movie->category->title}}</a> » 
                        <a href="{{route('country',$movie->country->slug)}}">{{$movie->country->title}}</a> » 
                        @foreach ($movie->movie_genre as $gen)
                           <a href="{{route('genre',$gen->slug)}}">{{$gen->title}}</a> » 
                        @endforeach
                        <span class="breadcrumb_last" aria-current="page">{{$movie->title}}</span>
                     </span>
                  </span>
               </div>
             </div>
          </div>
       </div>
       <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
          <div class="ajax"></div>
       </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
       <section id="content" class="test">
          <div class="clearfix wrap-content">
            
             <div class="halim-movie-wrapper">
                <div class="movie_info col-xs-12">
                   <div class="movie-poster col-md-3">
                      <img class="movie-thumb" src="{{asset('./uploads/movie/'.$movie->image)}}" alt="{{$movie->title}}">
                      <div class="d-block text-center mt-3">
                         <a href="#watch_trailer" class="btn btn-success watch_trailer">Xem Trailer</a>
                         <a style="width: 103.78px" href="{{route('watch', ['slug' => $movie->slug, 'number_episode' => 1])}}" class="btn btn-primary">Xem Phim</a>
                      </div>
                   </div>
                   <div class="film-poster col-md-9">
                      <h1 class="movie-title title-1" style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">{{$movie->title}}</h1>
                      <ul class="list-info-group">
                        <li class="list-info-group-item">
                           <span>Trạng Thái</span> : 
                           <span class="quality">
                              @if($movie->quality == 1)
                                 HD
                              @elseif ($movie->quality == 2)
                                 Full HD
                              @else
                                 SD
                              @endif
                           </span>
                           <span class="episode">
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
                        </li>
                        <li class="list-info-group-item"><span>Thời lượng</span> : {{$movie->lenght}}</li>
                     <li class="list-info-group-item"><span>Tập phim</span> : 
                        {{$all_episode}}/{{$movie->episode}} 
                        @if ($all_episode == $movie->episode)
                           - Hoàn Thành
                        @else
                           - Đang cập nhật ...
                        @endif
                     </li>
                        <li class="list-info-group-item"><span>Danh mục phim</span> : <a href="{{route('category',$movie->category->slug)}}" rel="category tag">{{$movie->category->title}}</a></li>
                        <li class="list-info-group-item"><span>Thể loại</span> : 
                           @foreach ($movie->movie_genre as $gen)
                              <a href="{{route('genre',$gen->slug)}}" rel="genre tag">
                                 {{$gen->title}}
                              </a>
                           @endforeach
                        </li>
                        <li class="list-info-group-item"><span>Tập mới nhất</span> : 
                           @foreach ($new_episode as $new)
                           <a href="{{route('watch', ['slug' => $movie->slug, 'number_episode' => $new->episode])}}">
                              Tập {{$new->episode}}
                           </a>
                           @endforeach
                        </li>
                        <li class="list-info-group-item"><span>Quốc gia</span> : <a href="{{route('country',$movie->country->slug)}}" rel="country tag">{{$movie->country->title}}</a></li>
                        <li class="list-info-group-item"><span>Số bài đánh giá</span> : {{$sum_rating}}</li>
                        <li class="list-info-group-item d-flex">
                           <span>Số sao trung bình</span> :
                           <ul class="list-inline text-center"  title="Average Rating" style="flex: 1;">
                              @for($count=1; $count<=5; $count++)
                                  @php
                                      $avg = 0;
                                      $avg_rating_copy = $avg_rating;
                                      foreach ($avg_rating_copy as $rating) {
                                          if ($rating->movie_id == $movie->id) {
                                              $avg = $rating->AVG_RATING;
                                          }
                                      }
                                      if($count<=$avg){ 
                                          $color = 'color:#ffcc00;'; //mau vang
                                      }
                                      else {
                                          $color = 'color:#ccc;'; //mau xam
                                      }
                                  @endphp
                                  <li 
                                      style="cursor:pointer; {{$color}} font-size:15px;"
                                  >
                                          &#9733;
                                  </li>
                              @endfor
                          </ul>
                        </li>
                        <li class="list-info-group-item"><span>Lượt quan tâm</span> : {{$movie->views}}</li>
                     </ul>
                   </div>
                </div>
             </div>
             <div class="clearfix"></div>
             <div class="section-bar clearfix">
                <h2 class="section-title"><span style="color:#ffed4d">Mô tả phim</span></h2>
             </div>
             <div class="entry-content htmlwrap clearfix" style="height: 200px; overflow: auto">
                <div class="video-item halim-entry-box">
                   <article id="post-38424" class="item-content">
                     {{$movie->description}}
                   </article>
                </div>
             </div>
             <div class="clearfix"></div>
            <div class="section-bar clearfix">
               <h2 class="section-title"><span style="color:#ffed4d">Đánh giá về phim này</span></h2>
            </div>
            <div class="entry-content htmlwrap clearfix">
               <div class="video-item halim-entry-box">
                  <article class="item-content rating-style">
                     <ul class="list-inline"  title="Average Rating">
                        @for($count=1; $count<=5; $count++)
                          <li 
                              title="star_rating"
                              id="{{$movie->id}}-{{$count}}"
                              data-index="{{$count}}"
                              data-movie_id="{{$movie->id}}"
                              class="rating"
                              style="cursor:pointer; 
                              font-size:30px;"
                           >
                              &#9733;
                           </li>
                        @endfor
                     </ul>
                  </article>
               </div>
            </div>
             <div id="halim_trailer"></div>
             <div class="section-bar clearfix">
               <h2 class="section-title"><span style="color:#ffed4d">Trailer phim</span></h2>
            </div>
            <div class="entry-content htmlwrap clearfix">
               <div class="video-item halim-entry-box">
                  <article id="watch_trailer" class="item-content">
                     <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{$movie->trailer}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                  </article>
               </div>
            </div>
             <div class="section-bar clearfix">
               <h2 class="section-title"><span style="color:#ffed4d">Tags phim</span></h2>
            </div>
            <div class="entry-content htmlwrap clearfix">
               <div class="video-item halim-entry-box">
                  <article id="post-38424" class="item-content">
                     @if($movie->tags)
                        @php
                           $tags = [];
                           $tags = explode(',', $movie->tags)
                        @endphp
                        @foreach ($tags as $key => $tag)
                           <button type="button" class="btn btn-primary btn-sm">
                              <a href="{{route('tag', $tag)}}">{{$tag}}</a>
                           </button>
                        @endforeach
                     @else
                        Không có tags phim nào
                     @endif
                  </article>
               </div>
            </div>
          </div>
       </section>
       <section class="related-movies">
          <div id="halim_related_movies-2xx" class="wrap-slider">
             <div class="section-bar clearfix">
                <h3 class="section-title"><span>PHIM CÙNG DANH MỤC</span></h3>
             </div>
             <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
               @foreach ($movie_related as $movie)
                  <article class="thumb grid-item post-38498">
                     <div class="halim-item">
                        <a class="halim-thumb" href="{{route('movie', $movie->slug)}}" title="{{$movie->title}}">
                           <figure><img class="lazy img-responsive" src="{{asset('./uploads/movie/'.$movie->image)}}" alt="{{$movie->title}}" title="{{$movie->title}}"></figure>
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
             <script>
                $(document).ready(function($) {				
                var owl = $('#halim_related_movies-2');
                owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 4}}})});
             </script>
          </div>
       </section>
    </main>
    @include('pages.include.sidebar')
</div>
@endsection