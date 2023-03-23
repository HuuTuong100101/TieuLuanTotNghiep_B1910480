<!DOCTYPE html>
<html lang="vi">
   <head>
      <meta charset="utf-8" />
      <meta content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
      <meta name="theme-color" content="#234556">
      <meta http-equiv="Content-Language" content="vi" />
      <meta content="VN" name="geo.region" />
      <meta name="DC.language" scheme="utf-8" content="vi" />
      <meta name="language" content="Việt Nam">
      <title>PagodaFilms</title>
      <link rel="shortcut icon" href="/images/filmmaking.png" type="image/x-icon" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/fontawesome.min.css" integrity="sha512-cHxvm20nkjOUySu7jdwiUxgGy11vuVPE9YeK89geLMLMMEOcKFyS2i+8wo0FOwyQO/bL8Bvq1KMsqK4bbOsPnA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel='dns-prefetch' href='//s.w.org' />
      <link rel='stylesheet' id='bootstrap-css' href='{{asset('css/bootstrap.min.css')}}' media='all' />
      <link rel='stylesheet' id='style-css' href= '{{asset('css/style.css')}}' media='all' />
      <link rel='stylesheet' id='wp-block-library-css' href= '{{asset('css/style.min.css')}}' media='all' />
      <script type='text/javascript' src='{{asset('js/jquery.min.js')}}' id='halim-jquery-js'></script>
      <style type="text/css" id="wp-custom-css">
         .textwidget p a img {
         width: 100%;
      }
      </style>
      <style>
         #header .site-title {
            background: url('/images/filmmaking.png') no-repeat top center;
            background-size: contain;
            text-indent: -9999px;
         }
         .logo {
            display: block ;
            text-align: center
         }
         .text-site {
            margin-top: 5px;
            font-size: 15px
         }
         .logo:hover {
            color: #87c3f9;
         }
      </style>
   </head>
   <body class="home blog halimthemes halimmovies" data-masonry="">
      <header id="header">
         <div class="container">
            <div class="row" id="headwrap">
               <div class="col-md-3 col-sm-6 slogan">
                  <a class="logo" href="" title="phim hay">
                     <p class="site-title"></p>
                     <p class="text-site">PAGODA FILMS</p>
                  </a>
               </div>
               <div class="col-md-5 col-sm-6 halim-search-form hidden-xs">
                  <div class="header-nav">
                     <div class="col-xs-12">
                        <div class="form-group">
                           <div class="input-group col-xs-12">
                              <form action="{{route('search')}}" method="get" class="d-flex">
                                 <input id="search" type="text" name="search" class="form-control" placeholder="Tìm kiếm..." autocomplete="off" required>
                                 <button class="btn btn-primary">search</button>
                              </div>
                              </form>
                        </div>
                        <ul id="result" class="list-group" style="display: none;">

                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 hidden-xs">
                  <div id="get-bookmark" class="box-shadow"><i class="hl-bookmark"></i><span> Bookmarks</span><span class="count">0</span></div>
                  <div id="bookmark-list" class="hidden bookmark-list-on-pc">
                     <ul style="margin: 0;"></ul>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <div class="navbar-container">
         <div class="container">
            <nav class="navbar halim-navbar main-navigation" role="navigation" data-dropdown-hover="1">
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#halim" aria-expanded="false">
                  <span class="sr-only">Menu</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right expand-search-form" data-toggle="collapse" data-target="#search-form" aria-expanded="false">
                  <span class="hl-search" aria-hidden="true"></span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right get-bookmark-on-mobile">
                  Bookmarks<i class="hl-bookmark" aria-hidden="true"></i>
                  <span class="count">0</span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right get-locphim-on-mobile">
                  <a href="javascript:;" id="expand-ajax-filter" style="color: #ffed4d;">Lọc <i class="fas fa-filter"></i></a>
                  </button>
               </div>
               <div class="collapse navbar-collapse" id="halim">
                  <div class="menu-menu_1-container">
                     <ul id="menu-menu_1" class="nav navbar-nav navbar-left">
                        <li class="current-menu-item active"><a title="Trang Chủ" href="{{route('homepage')}}">Trang Chủ</a></li>
                        <li class="mega dropdown">
                           <a title="Thể Loại" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Thể Loại <span class="caret"></span></a>
                           <ul role="menu" class=" dropdown-menu">
                              @foreach ($genres as $genre)
                                 <li class="mega"><a title={{$genre->title}} href="{{route('genre', $genre->slug)}}">{{$genre->title}}</a></li>
                              @endforeach
                           </ul>
                        </li>
                        <li class="mega dropdown">
                           <a title="Quốc Gia" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Quốc Gia <span class="caret"></span></a>
                           <ul role="menu" class=" dropdown-menu">
                              @foreach ($countries as $country)
                                 <li class="mega"><a title={{$country->title}} href="{{route('country', $country->slug)}}">{{$country->title}}</a></li>
                              @endforeach
                           </ul>
                        </li>
                        <li class="mega"><a title="Phim mới" href="{{route('new')}}">Phim mới</a></li>
                        <li class="mega"><a title="Phim lồng tiếng" href="{{route('subtitle', 0)}}">Phim lồng tiếng</a></li>
                        <li class="mega"><a title="Phim thuyết minh" href="{{route('subtitle', 3)}}">Phim thuyết minh</a></li>
                        @foreach ($categories as $category)
                           <li class="mega"><a title={{$category->title}} href="{{route('category', $category->slug)}}">{{$category->title}}</a></li>
                        @endforeach
                     </ul>
                  </div>
                  <ul class="nav navbar-nav navbar-left" style="background:#000;">
                     <li><a href="#" onclick="locphim()" style="color: #ffed4d;">Lọc Phim</a></li>
                  </ul>
               </div>
            </nav>
            <div class="collapse navbar-collapse" id="search-form">
               <div id="mobile-search-form" class="halim-search-form"></div>
            </div>
            <div class="collapse navbar-collapse" id="user-info">
               <div id="mobile-user-login"></div>
            </div>
         </div>
      </div>
      </div>
      <div class="container">
         <div class="row fullwith-slider"></div>
      </div>
      <div class="container">
         @yield('content')
      </div>
      <div class="clearfix"></div>
      <footer id="footer" class="clearfix">
         <div class="container footer-columns">
            <div class="row container">
               <div class="widget about col-xs-12 col-sm-4 col-md-4">
                  <div class="footer-logo">
                     <img class="img-responsive" src="https://img.favpng.com/9/23/19/movie-logo-png-favpng-nRr1DmYq3SNYSLN8571CHQTEG.jpg" alt="Phim hay 2021- Xem phim hay nhất" />
                  </div>
                  Liên hệ QC: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="e5958d8c888d849ccb868aa58288848c89cb868a88">[email&#160;protected]</a>
               </div>
            </div>
         </div>
      </footer>
      <div id='easy-top'></div>
      <script type='text/javascript' src='{{asset('js/bootstrap.min.js')}}' id='bootstrap-js'></script>
      {{-- <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@4.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script> --}}
      <script type='text/javascript' src='{{asset('js/owl.carousel.min.js')}}' id='carousel-js'></script>
      <div id="fb-root"></div>
      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v16.0&appId=230816367401550&autoLogAppEvents=1" nonce="7R78KA0D"></script>
      <script type='text/javascript' src='{{asset('js/halimtheme-core.min.js')}}' id='halim-init-js'></script>
      <style>#overlay_mb{position:fixed;display:none;width:100%;height:100%;top:0;left:0;right:0;bottom:0;background-color:rgba(0, 0, 0, 0.7);z-index:99999;cursor:pointer}#overlay_mb .overlay_mb_content{position:relative;height:100%}.overlay_mb_block{display:inline-block;position:relative}#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:600px;height:auto;position:relative;left:50%;top:50%;transform:translate(-50%, -50%);text-align:center}#overlay_mb .overlay_mb_content .cls_ov{color:#fff;text-align:center;cursor:pointer;position:absolute;top:5px;right:5px;z-index:999999;font-size:14px;padding:4px 10px;border:1px solid #aeaeae;background-color:rgba(0, 0, 0, 0.7)}#overlay_mb img{position:relative;z-index:999}@media only screen and (max-width: 768px){#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:400px;top:3%;transform:translate(-50%, 3%)}}@media only screen and (max-width: 400px){#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:310px;top:3%;transform:translate(-50%, 3%)}}</style>
      <style>
         #overlay_pc {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 99999;
            cursor: pointer;
         }
         #overlay_pc .overlay_pc_content {
            position: relative;
            height: 100%;
         }
         .overlay_pc_block {
            display: inline-block;
            position: relative;
         }
         #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
            width: 600px;
            height: auto;
            position: relative;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
         }
         #overlay_pc .overlay_pc_content .cls_ov {
            color: #fff;
            text-align: center;
            cursor: pointer;
            position: absolute;
            top: 5px;
            right: 5px;
            z-index: 999999;
            font-size: 14px;
            padding: 4px 10px;
            border: 1px solid #aeaeae;
            background-color: rgba(0, 0, 0, 0.7);
         }
         #overlay_pc img {
            position: relative;
            z-index: 999;
         }
         @media only screen and (max-width: 768px) {
            #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
               width: 400px;
               top: 3%;
               transform: translate(-50%, 3%);
            }
         }
         @media only screen and (max-width: 400px) {
            #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
               width: 310px;
               top: 3%;
               transform: translate(-50%, 3%);
            }
         }
      </style>
      <style>
         .float-ck { position: fixed; bottom: 0px; z-index: 9}
         * html .float-ck /* IE6 position fixed Bottom */{position:absolute;bottom:auto;top:expression(eval (document.documentElement.scrollTop+document.docum entElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop,10)||0)-(parseInt(this.currentStyle.marginBottom,10)||0))) ;}
         #hide_float_left a {background: #0098D2;padding: 5px 15px 5px 15px;color: #FFF;font-weight: 700;float: left;}
         #hide_float_left_m a {background: #0098D2;padding: 5px 15px 5px 15px;color: #FFF;font-weight: 700;}
         span.bannermobi2 img {height: 70px;width: 300px;}
         #hide_float_right a { background: #01AEF0; padding: 5px 5px 1px 5px; color: #FFF;float: left;}
      </style>
      <script>
         $(document).ready(function($) {
            var owl = $('#phim_hot');
            owl.owlCarousel({
               loop: true,
               margin: 4,
               autoplay: true,
               autoplayTimeout: 4000,
               autoplayHoverPause: true,
               nav: true,
               navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],
               responsiveClass: true,
               responsive: {
                  0: {items:2},
                  480: {items:3}, 
                  600: {items:4},
                  1000: {items: 5}
               }
            })
         });

         $(".watch_trailer").click(function(e) {
            e.preventDefault();
            var aid = $(this).attr("href");
            $('html,body').animate({scrollTop: $(aid).offset().top}, 'slow');
         });

         $(document).ready(function() {
            $('#search').keyup(function (e) { 
               $('#result').html('');
               var search = $('#search').val();
               // alert(search)
               if (search!='') {
                  var expression = new RegExp(search, "i");
                  // alert(expression)
                  $.getJSON('/json/movie.json', function(data) {
                     $.each(data, function(key, value) {
                        // alert(value.title);
                        // alert(value.title.search(expression));
                        if (value.title.search(expression) != -1) {
                           var slug = value.slug;
                           $('#result').css('display','inherit');
                           $('#result').append('<li class="list-group-item link-class" style="cursor:pointer"><a href="http://127.0.0.1:8000/phim/'+value.slug+'"><img height="40" width="40" src="/uploads/movie/'+value.image+'"><span style="margin-left: 10px;">'+value.title+'</span></a></li>');
                        }
                     });
                  });
               }
            });

            // $('#result').on('click', 'li', function() {
            //    var click_text = $(this).text();
            //    $('#search').val(click_text);
            //    $('#result').html('');
            // });
         });
      </script>
      {{-- <script type="text/javascript">
          $(".watch_trailer").click(function(e) {
            e.preventDefault();
            var aid = $(this).attr("href");
            $('html,body').animate({scrollTop: $(aid).offset().top}, 'slow');
         });
      </script> --}}
   </body>
</html>