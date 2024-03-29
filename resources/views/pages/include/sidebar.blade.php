<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Phim hot</span>
            </div>
        </div>
        <section class="tab-content">
            <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
            <div class="halim-ajax-popular-post-loading hidden"></div>
            <div id="halim-ajax-popular-post" class="popular-post">
                @foreach ($hot_movies_sidebar as $movie)
                    <div class="item post-37176">
                        <a href="{{route('movie', $movie->slug)}}" title="{{$movie->title}}">
                            {{-- <p>{{$movie->id}} || {{$rating->movie_id}}</p> --}}
                            <div class="item-link">
                            <img src="{{asset('uploads/movie/'.$movie->image)}}" class="lazy post-thumb" alt="{{$movie->tile}}" title="{{$movie->tile}}" />
                            <span class="is_trailer">
                                @if($movie->quality == 1)
                                    HD
                                @elseif ($movie->quality == 2)
                                    Full HD
                                @else
                                    SD
                                @endif
                            </span>
                            </div>
                            <p class="title">{{$movie->title}}</p>
                        </a>
                        <div>
                            {{-- @if (is_array($avg_rating) || is_object($avg_rating) || !is_array($avg_rating) || !is_object($avg_rating)) --}}
                                {{-- @php
                                    $new = $avg_rating
                                @endphp
                                @foreach ($new as $rating)
                                    <p>{{$rating}}</p>
                                @endforeach --}}
                            {{-- @endif --}}
                        </div>
                        <div class="viewsCount" style="color: #9d9d9d;">{{$movie->views}} lượt quan tâm</div>
                        <div style="float: left;">
                            <ul class="list-inline"  title="Average Rating" style="margin-left: 0">
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
                                        style="cursor:pointer; 
                                        padding-right: 0;
                                        padding-left:0; 
                                        {{$color}} 
                                        font-size:15px;"
                                    >
                                            &#9733;
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>
</aside>
{{-- Nếu có làm đếm số view sẽ làm thêm phần này không thì bỏ --}}
{{-- Phần sidebar top-view có thời gian sẽ làm sau xem video 37, 38, 39 --}}
{{-- <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Top Views</span>
            </div>
        </div>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link btn" id="day" data-toggle="pill" data-target="#pills-day" type="button" role="tab" aria-controls="pills-day" aria-selected="true">Ngày</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link btn" id="week" data-toggle="pill" data-target="#pills-week" type="button" role="tab" aria-controls="pills-week" aria-selected="false">Tuần</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link btn" id="month" data-toggle="pill" data-target="#pills-month" type="button" role="tab" aria-controls="pills-month" aria-selected="false">Tháng</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade" id="pills-day" role="tabpanel" aria-labelledby="day">
                <div class="halim-ajax-popular-post-loading hidden"></div>
                <div id="halim-ajax-popular-post" class="popular-post">
                    <div class="item post-37176">
                        <a href="chitiet.php" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ">
                           <div class="item-link">
                              <img src="https://ghienphim.org/uploads/GPax0JpZbqvIVyfkmDwhRCKATNtLloFQ.jpeg?v=1624801798" class="lazy post-thumb" alt="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />
                              <span class="is_trailer">Trailer</span>
                           </div>
                           <p class="title">CHỊ MƯỜI BA: BA NGÀY SINH TỬ</p>
                        </a>
                        <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                        <div style="float: left;">
                           <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                           <span style="width: 0%"></span>
                           </span>
                        </div>
                     </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-week" role="tabpanel" aria-labelledby="week">
                <div class="halim-ajax-popular-post-loading hidden"></div>
                <div id="halim-ajax-popular-post" class="popular-post">
                    <div class="item post-37176">
                        <a href="chitiet.php" title="CHỊ MƯỜI BỐN: BA NGÀY SINH TỬ">
                           <div class="item-link">
                              <img src="https://ghienphim.org/uploads/GPax0JpZbqvIVyfkmDwhRCKATNtLloFQ.jpeg?v=1624801798" class="lazy post-thumb" alt="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />
                              <span class="is_trailer">Trailer</span>
                           </div>
                           <p class="title">CHỊ MƯỜI BA: BA NGÀY SINH TỬ</p>
                        </a>
                        <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                        <div style="float: left;">
                           <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                           <span style="width: 0%"></span>
                           </span>
                        </div>
                     </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-month" role="tabpanel" aria-labelledby="month">
                <div class="halim-ajax-popular-post-loading hidden"></div>
                <div id="halim-ajax-popular-post" class="popular-post">
                    <div class="item post-37176">
                        <a href="chitiet.php" title="CHỊ MƯỜI LĂM: BA NGÀY SINH TỬ">
                           <div class="item-link">
                              <img src="https://ghienphim.org/uploads/GPax0JpZbqvIVyfkmDwhRCKATNtLloFQ.jpeg?v=1624801798" class="lazy post-thumb" alt="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />
                              <span class="is_trailer">Trailer</span>
                           </div>
                           <p class="title">CHỊ MƯỜI BA: BA NGÀY SINH TỬ</p>
                        </a>
                        <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                        <div style="float: left;">
                           <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                           <span style="width: 0%"></span>
                           </span>
                        </div>
                     </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</aside> --}}