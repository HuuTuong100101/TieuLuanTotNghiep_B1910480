@extends('layout')
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs"><span><a href="{{route('category', $category_slug->slug)}}">{{$category_slug->title}}</a></span></div>
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
             <h1 class="section-title"><span>{{$category_slug->title}}</span></h1>
          </div>
          <div class="halim_box">
            @foreach ($category_movies as $category_movie)
               <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-27021">
                  <div class="halim-item">
                     <a class="halim-thumb" href="{{route('movie', $category_movie->slug)}}" title="{{$category_movie->title}}">
                        <figure><img class="lazy img-responsive" src="{{asset('./uploads/movie/'.$category_movie->image)}}" alt="{{$category_movie->title}}" title="{{$category_movie->title}}"></figure>
                        <span class="status">
                           @if($category_movie->quality == 1)
                              HD
                           @elseif ($category_movie->quality == 2)
                              Full HD
                           @else
                              SD
                           @endif
                        </span>
                        <span class="episode">
                           <i class="fa fa-play" aria-hidden="true"></i>
                           @if($category_movie->subtitles == 1)
                              Vietsub
                           @elseif($category_movie->subtitles == 2)
                              Engsub
                           @else
                              L???ng ti???ng
                           @endif
                        </span> 
                        <div class="icon_overlay"></div>
                        <div class="halim-post-title-box">
                           <div class="halim-post-title ">
                              <p class="entry-title">{{$category_movie->title}}</p>
                           </div>
                        </div>
                     </a>
                  </div>
               </article>
            @endforeach
          </div>
          <div class="clearfix"></div>
          <div class="text-center">
             {{-- <ul class='page-numbers'>
                <li><span aria-current="page" class="page-numbers current">1</span></li>
                <li><a class="page-numbers" href="">2</a></li>
                <li><a class="page-numbers" href="">3</a></li>
                <li><span class="page-numbers dots">&hellip;</span></li>
                <li><a class="page-numbers" href="">55</a></li>
                <li><a class="next page-numbers" href=""><i class="hl-down-open rotate-right"></i></a></li>
             </ul> --}}
             {!! $category_movies->links("pagination::bootstrap-4") !!}
          </div>
       </section>
    </main>
    <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
       <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
          <div class="section-bar clearfix">
             <div class="section-title">
                <span>Top Views</span>
                <ul class="halim-popular-tab" role="tablist">
                   <li role="presentation" class="active">
                      <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="today">Day</a>
                   </li>
                   <li role="presentation">
                      <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="week">Week</a>
                   </li>
                   <li role="presentation">
                      <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="month">Month</a>
                   </li>
                   <li role="presentation">
                      <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="all">All</a>
                   </li>
                </ul>
             </div>
          </div>
         <section class="tab-content">
             <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                <div class="halim-ajax-popular-post-loading hidden"></div>
                <div id="halim-ajax-popular-post" class="popular-post">
                   <div class="item post-37176">
                      <a href="chitiet.php" title="CH??? M?????I BA: BA NG??Y SINH T???">
                         <div class="item-link">
                            <img src="https://ghienphim.org/uploads/GPax0JpZbqvIVyfkmDwhRCKATNtLloFQ.jpeg?v=1624801798" class="lazy post-thumb" alt="CH??? M?????I BA: BA NG??Y SINH T???" title="CH??? M?????I BA: BA NG??Y SINH T???" />
                            <span class="is_trailer">Trailer</span>
                         </div>
                         <p class="title">CH??? M?????I BA: BA NG??Y SINH T???</p>
                      </a>
                      <div class="viewsCount" style="color: #9d9d9d;">3.2K l?????t xem</div>
                      <div style="float: left;">
                         <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                         <span style="width: 0%"></span>
                         </span>
                      </div>
                   </div>
                   <div class="item post-37176">
                      <a href="chitiet.php" title="CH??? M?????I BA: BA NG??Y SINH T???">
                         <div class="item-link">
                            <img src="https://ghienphim.org/uploads/GPax0JpZbqvIVyfkmDwhRCKATNtLloFQ.jpeg?v=1624801798" class="lazy post-thumb" alt="CH??? M?????I BA: BA NG??Y SINH T???" title="CH??? M?????I BA: BA NG??Y SINH T???" />
                            <span class="is_trailer">Trailer</span>
                         </div>
                         <p class="title">CH??? M?????I BA: BA NG??Y SINH T???</p>
                      </a>
                      <div class="viewsCount" style="color: #9d9d9d;">3.2K l?????t xem</div>
                      <div style="float: left;">
                         <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                         <span style="width: 0%"></span>
                         </span>
                      </div>
                   </div>
                   <div class="item post-37176">
                      <a href="chitiet.php" title="CH??? M?????I BA: BA NG??Y SINH T???">
                         <div class="item-link">
                            <img src="https://ghienphim.org/uploads/GPax0JpZbqvIVyfkmDwhRCKATNtLloFQ.jpeg?v=1624801798" class="lazy post-thumb" alt="CH??? M?????I BA: BA NG??Y SINH T???" title="CH??? M?????I BA: BA NG??Y SINH T???" />
                            <span class="is_trailer">Trailer</span>
                         </div>
                         <p class="title">CH??? M?????I BA: BA NG??Y SINH T???</p>
                      </a>
                      <div class="viewsCount" style="color: #9d9d9d;">3.2K l?????t xem</div>
                      <div style="float: left;">
                         <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                         <span style="width: 0%"></span>
                         </span>
                      </div>
                   </div>
                   <div class="item post-37176">
                      <a href="chitiet.php" title="CH??? M?????I BA: BA NG??Y SINH T???">
                         <div class="item-link">
                            <img src="https://ghienphim.org/uploads/GPax0JpZbqvIVyfkmDwhRCKATNtLloFQ.jpeg?v=1624801798" class="lazy post-thumb" alt="CH??? M?????I BA: BA NG??Y SINH T???" title="CH??? M?????I BA: BA NG??Y SINH T???" />
                            <span class="is_trailer">Trailer</span>
                         </div>
                         <p class="title">CH??? M?????I BA: BA NG??Y SINH T???</p>
                      </a>
                      <div class="viewsCount" style="color: #9d9d9d;">3.2K l?????t xem</div>
                      <div style="float: left;">
                         <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                         <span style="width: 0%"></span>
                         </span>
                      </div>
                   </div>
                   <div class="item post-37176">
                      <a href="chitiet.php" title="CH??? M?????I BA: BA NG??Y SINH T???">
                         <div class="item-link">
                            <img src="https://ghienphim.org/uploads/GPax0JpZbqvIVyfkmDwhRCKATNtLloFQ.jpeg?v=1624801798" class="lazy post-thumb" alt="CH??? M?????I BA: BA NG??Y SINH T???" title="CH??? M?????I BA: BA NG??Y SINH T???" />
                            <span class="is_trailer">Trailer</span>
                         </div>
                         <p class="title">CH??? M?????I BA: BA NG??Y SINH T???</p>
                      </a>
                      <div class="viewsCount" style="color: #9d9d9d;">3.2K l?????t xem</div>
                      <div style="float: left;">
                         <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                         <span style="width: 0%"></span>
                         </span>
                      </div>
                   </div>
                   <div class="item post-37176">
                      <a href="chitiet.php" title="CH??? M?????I BA: BA NG??Y SINH T???">
                         <div class="item-link">
                            <img src="https://ghienphim.org/uploads/GPax0JpZbqvIVyfkmDwhRCKATNtLloFQ.jpeg?v=1624801798" class="lazy post-thumb" alt="CH??? M?????I BA: BA NG??Y SINH T???" title="CH??? M?????I BA: BA NG??Y SINH T???" />
                            <span class="is_trailer">Trailer</span>
                         </div>
                         <p class="title">CH??? M?????I BA: BA NG??Y SINH T???</p>
                      </a>
                      <div class="viewsCount" style="color: #9d9d9d;">3.2K l?????t xem</div>
                      <div style="float: left;">
                         <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                         <span style="width: 0%"></span>
                         </span>
                      </div>
                   </div>
                   <div class="item post-37176">
                      <a href="chitiet.php" title="CH??? M?????I BA: BA NG??Y SINH T???">
                         <div class="item-link">
                            <img src="https://ghienphim.org/uploads/GPax0JpZbqvIVyfkmDwhRCKATNtLloFQ.jpeg?v=1624801798" class="lazy post-thumb" alt="CH??? M?????I BA: BA NG??Y SINH T???" title="CH??? M?????I BA: BA NG??Y SINH T???" />
                            <span class="is_trailer">Trailer</span>
                         </div>
                         <p class="title">CH??? M?????I BA: BA NG??Y SINH T???</p>
                      </a>
                      <div class="viewsCount" style="color: #9d9d9d;">3.2K l?????t xem</div>
                      <div style="float: left;">
                         <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                         <span style="width: 0%"></span>
                         </span>
                      </div>
                   </div>
                  
                  
                </div>
             </div>
          </section>
          <div class="clearfix"></div>
       </div>
    </aside>
 </div>
@endsection