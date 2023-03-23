@extends('layout')
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs"><span><span>Năm phát hành » <a href="{{route('year', $year)}}"><span class="breadcrumb_last" aria-current="page">{{$year}}</span></a></span></span></div>
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
             <h1 class="section-title"><span>Phim : năm {{$year}}</span></h1>
          </div>
          <div class="halim_box">
            @foreach ($year_movies as $year_movie)
               <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-27021">
                  <div class="halim-item">
                     <a class="halim-thumb" href="{{route('movie', $year_movie->slug)}}" title="{{$year_movie->title}}">
                        <figure><img class="lazy img-responsive" src="{{asset('./uploads/movie/'.$year_movie->image)}}" alt="{{$year_movie->title}}" title="{{$year_movie->title}}"></figure>
                        <span class="status">
                           @if($year_movie->quality == 1)
                              HD
                           @elseif ($year_movie->quality == 2)
                              Full HD
                           @else
                              SD
                           @endif
                        </span>
                        <span class="episode">
                           <i class="fa fa-play" aria-hidden="true"></i>
                           @if($year_movie->subtitles == 1)
                              Vietsub
                           @elseif($year_movie->subtitles == 2)
                              Engsub
                           @elseif($year_movie->subtitles == 3)
                              Thuyết minh
                           @else
                              Lồng tiếng
                           @endif
                        </span> 
                        <div class="icon_overlay"></div>
                        <div class="halim-post-title-box">
                           <div class="halim-post-title ">
                              <p class="entry-title">{{$year_movie->title}}</p>
                           </div>
                        </div>
                     </a>
                  </div>
               </article>
            @endforeach
          
          </div>
          <div class="clearfix"></div>
          <div class="text-center">
             {!! $year_movies->links("pagination::bootstrap-4") !!}
          </div>
       </section>
    </main>
    @include('pages.include.sidebar')
 </div>
@endsection