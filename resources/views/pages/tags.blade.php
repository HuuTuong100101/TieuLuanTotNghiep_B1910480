@extends('layout')
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs"><span>Phim theo tags » <a href="">{{$tag}}</a></span></div>
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
             <h1 class="section-title"><span>TAGS: {{$tag}}</span></h1>
          </div>
          <div class="halim_box">
            @foreach ($movies as $movie)
               <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-27021">
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
          <div class="clearfix"></div>
          <div class="text-center">
             {!! $movies->links("pagination::bootstrap-4") !!}
          </div>
       </section>
    </main>
    @include('pages.include.sidebar')
 </div>
@endsection