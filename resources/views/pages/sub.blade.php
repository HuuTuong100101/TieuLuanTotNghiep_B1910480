@extends('layout')
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs">
                    <span>
                        <span>Subtitle » 
                            @if ($sub == 0)
                                <a href="{{route('subtitle', 0)}}">
                                    <span class="breadcrumb_last" aria-current="page">Phim lồng tiếng</span>
                                </a>
                            @else
                                <a href="{{route('subtitle', 3)}}">
                                    <span class="breadcrumb_last" aria-current="page">Phim thuyết minh</span>
                                </a>
                            @endif
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
       <section>
          <div class="section-bar clearfix">
            @if ($sub == 0)
                <h1 class="section-title"><span>Phim lồng tiếng</span></h1>
            @else
                <h1 class="section-title"><span>Phim thuyết minh</span></h1>
            @endif
          </div>
          <div class="halim_box">
            @foreach ($sub_movies as $sub_movie)
               <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-27021">
                  <div class="halim-item">
                     <a class="halim-thumb" href="{{route('movie', $sub_movie->slug)}}" title="{{$sub_movie->title}}">
                        <figure><img class="lazy img-responsive" src="{{asset('./uploads/movie/'.$sub_movie->image)}}" alt="{{$sub_movie->title}}" title="{{$sub_movie->title}}"></figure>
                        <span class="status">
                           @if($sub_movie->quality == 1)
                              HD
                           @elseif ($sub_movie->quality == 2)
                              Full HD
                           @else
                              SD
                           @endif
                        </span>
                        <span class="episode">
                           <i class="fa fa-play" aria-hidden="true"></i>
                            @if($sub_movie->subtitles == 1)
                                Vietsub
                            @elseif($sub_movie->subtitles == 2)
                                Engsub
                            @elseif($sub_movie->subtitles == 3)
                                Thuyết minh
                            @else
                                Lồng tiếng
                           @endif
                        </span> 
                        <div class="icon_overlay"></div>
                        <div class="halim-post-title-box">
                           <div class="halim-post-title ">
                              <p class="entry-title">{{$sub_movie->title}}</p>
                           </div>
                        </div>
                     </a>
                  </div>
               </article>
            @endforeach
          
          </div>
          <div class="clearfix"></div>
          <div class="text-center">
             {!! $sub_movies->links("pagination::bootstrap-4") !!}
          </div>
       </section>
    </main>
    @include('pages.include.sidebar')
 </div>
@endsection