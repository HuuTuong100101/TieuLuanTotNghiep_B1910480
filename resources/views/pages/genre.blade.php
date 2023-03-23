@extends('layout')
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs"><span><span>Thể loại » <a href="{{route('genre', $genre_slug->slug)}}"><span class="breadcrumb_last" aria-current="page">{{$genre_slug->title}}</span></a></span></span></div>
             </div>
          </div>
       </div>
       <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
          <div class="ajax"></div>
       </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
       <section>
          <div class="section-bar clearfix">
             <h1 class="section-title"><span>Phim {{$genre_slug->title}}</span></h1>
          </div>
          <div class="halim_box">
            @foreach ($genre_movies as $genre_movie)
               <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-27021">
                  <div class="halim-item">
                     <a class="halim-thumb" href="{{route('movie', $genre_movie->slug)}}" title="{{$genre_movie->title}}">
                        <figure><img class="lazy img-responsive" src="{{asset('./uploads/movie/'.$genre_movie->image)}}" alt="{{$genre_movie->title}}" title="{{$genre_movie->title}}"></figure>
                        <span class="status">
                           @if($genre_movie->quality == 1)
                              HD
                           @elseif ($genre_movie->quality == 2)
                              Full HD
                           @else
                              SD
                           @endif
                        </span>
                        <span class="episode">
                           <i class="fa fa-play" aria-hidden="true"></i>
                           @if($genre_movie->subtitles == 1)
                              Vietsub
                           @elseif($genre_movie->subtitles == 2)
                              Engsub
                           @elseif($genre_movie->subtitles == 3)
                              Thuyết minh
                           @else
                              Lồng tiếng
                           @endif
                        </span> 
                        <div class="icon_overlay"></div>
                        <div class="halim-post-title-box">
                           <div class="halim-post-title ">
                              <p class="entry-title">{{$genre_movie->title}}</p>
                           </div>
                        </div>
                     </a>
                  </div>
               </article>
            @endforeach
          
          </div>
          <div class="clearfix"></div>
          <div class="text-center">
             {!! $genre_movies->links("pagination::bootstrap-4") !!}
          </div>
       </section>
    </main>
    @include('pages.include.sidebar')
 </div>
@endsection