<!DOCTYPE html>
<html>
   <head>
      <title>
         Movie-Pagoda
      </title>
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design"/>
      <script type="application/x-javascript">
         addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
         function hideURLbar() { window.scrollTo(0, 1); }
      </script>
      <!-- Bootstrap Core CSS -->
      <link href="{{ asset('backend/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
      <!-- Custom CSS -->
      <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet" type="text/css" />
      <!-- font-awesome icons CSS -->
      <link href="{{ asset('backend/css/font-awesome.css') }}" rel="stylesheet" />
      <!-- //font-awesome icons CSS-->
      <!-- side nav css file -->
      <link href="{{ asset('backend/css/SidebarNav.min.css') }}" media="all" rel="stylesheet" type="text/css"/>
      <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
      <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
      <!-- //side nav css file -->
      <!-- js-->
      <!--webfonts-->
      <link
         href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext"
         rel="stylesheet"
         />
      <!--//webfonts-->
      <script src="{{ asset('backend/js/custom.js') }}"></script>
      <script src="{{ asset('backend/js/jquery-1.11.1.min.js') }}"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="{{ asset('backend/js/bootstrap.js') }}"></script>
      <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet" />
      <script type="text/javascript" src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
         google.charts.load("current", {packages:["corechart"]});
         google.charts.setOnLoadCallback(drawChart);
         function drawChart() {
           var data = google.visualization.arrayToDataTable([
             ['Task', 'Hours per Day'],
             <?php echo $data_genre_chart; ?>
           ]);
           var options = {
             title: 'Thể loại phim',
             is3D: true,
           };
           var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
           chart.draw(data, options);
         }
         
         google.charts.load('current', {'packages':['bar']});
         google.charts.setOnLoadCallback(drawStuff);
         function drawStuff() {
           var data = new google.visualization.arrayToDataTable([
             ['Genre', 'Views'],
             <?php echo $data_genre_views_chart; ?>
           ]);
         
           var options = {
             width: 550,
             legend: { position: 'none' },
             chart: {
               title: 'Top 5 thể loại phim có lượt quan tâm cao nhất',
               subtitle: 'Genre Views',
             },
             axes: {
               x: {
                 0: { side: 'top', label: 'Thể loại phim'} // Top x-axis.
               }
             },
             bar: { groupWidth: "90%" }
           };
         
           var chart = new google.charts.Bar(document.getElementById('top_x_div'));
           // Convert the Classic options to Material options.
           chart.draw(data, google.charts.Bar.convertOptions(options));
         };
      </script>
      <script type="text/javascript">
         google.charts.load("current", {packages:['corechart']});
         google.charts.setOnLoadCallback(drawChart);
         function drawChart() {
           var data = google.visualization.arrayToDataTable([
             ["Ngày", "Số lượng truy cập", { role: "style" } ],
             <?php echo $data_visit_chart; ?>
           ]);
         
           var view = new google.visualization.DataView(data);
           view.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" },
                           2]);
         
           var options = {
             title: "Số lượng truy cập trong 30 ngày gần nhất",
             width: 1120,
             height: 950,
             bar: {groupWidth: "75%"},
             legend: { position: "none" },
           };
           var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
           chart.draw(view, options);
         }
      </script>
   </head>
   <body class="cbp-spmenu-push">
      @if (Auth::check())
      <div class="main-content">
         <div
            class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left"
            id="cbp-spmenu-s1"
            >
            <!--left-fixed -navigation-->
            <aside class="sidebar-left">
               <nav class="navbar navbar-inverse">
                  <div class="navbar-header">
                     <button
                        type="button"
                        class="navbar-toggle collapsed"
                        data-toggle="collapse"
                        data-target=".collapse"
                        aria-expanded="false"
                        >
                     <span class="sr-only">Toggle navigation</span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     </button>
                     <h1>
                        <a class="navbar-brand" href="{{route('home')}}"
                           ><span class="fa fa-area-chart"></span>Movie<span
                           class="dashboard_text"
                           >Movie dashboard</span
                           ></a
                           >
                     </h1>
                  </div>
                  @php
                  $segment = Request::segment(1);
                  $segment2 = Request::segment(2);
                  @endphp
                  <div
                     class="collapse navbar-collapse"
                     id="bs-example-navbar-collapse-1"
                     >
                     <ul class="sidebar-menu">
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="treeview {{( $segment == 'home') ? 'active' : ''}}">
                           <a href="{{route('home')}}">
                           <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                           </a>
                        </li>
                        <li class="treeview {{( $segment == 'user' || $segment == 'register') ? 'active' : ''}}">
                           <a href="#">
                           <i class="fa fa-user"></i>
                           <span>Tài khoản quản trị</span>
                           <i class="fa fa-angle-left pull-right"></i>
                           </a>
                           <ul class="treeview-menu">
                              <li class="{{( $segment == 'user') ? 'active' : ''}}">
                                 <a href="{{route('user.index')}}"
                                    ><i class="fa fa-angle-right"></i>Liệt kê tài khoản</a
                                    >
                              </li>
                              <li class="{{( $segment == 'register') ? 'active' : ''}}">
                                 <a href="{{ route('register') }}">
                                 <i class="fa fa-angle-right"></i> <span>Thêm tài khoản quản trị</span>
                                 </a>
                              </li>
                           </ul>
                        </li>
                        <li class="treeview {{( $segment == 'category') ? 'active' : ''}}">
                           <a href="#">
                           <i class="fa fa-bars"></i>
                           <span>Danh mục</span>
                           <i class="fa fa-angle-left pull-right"></i>
                           </a>
                           <ul class="treeview-menu">
                              <li class="{{( $segment == 'category' && $segment2 != 'create') ? 'active' : ''}}">
                                 <a href="{{route('category.index')}}"
                                    ><i class="fa fa-angle-right"></i>Liệt kê danh mục</a
                                    >
                              </li>
                              <li class="{{( $segment == 'category' && $segment2 == 'create') ? 'active' : ''}}">
                                 <a href="{{route('category.create')}}"
                                    ><i class="fa fa-angle-right"></i>Thêm danh mục</a
                                    >
                              </li>
                           </ul>
                        </li>
                        <li class="treeview {{( $segment == 'country') ? 'active' : ''}}">
                           <a href="#">
                           <i class="fa fa-globe"></i>
                           <span>Quốc gia</span>
                           <i class="fa fa-angle-left pull-right"></i>
                           </a>
                           <ul class="treeview-menu">
                              <li class="{{( $segment == 'country' && $segment2 != 'create') ? 'active' : ''}}">
                                 <a href="{{route('country.index')}}"
                                    ><i class="fa fa-angle-right"></i>Liệt kê quốc gia</a
                                    >
                              </li>
                              <li class="{{( $segment == 'country' && $segment2 == 'create') ? 'active' : ''}}">
                                 <a href="{{route('country.create')}}"
                                    ><i class="fa fa-angle-right"></i>Thêm quốc gia</a
                                    >
                              </li>
                           </ul>
                        </li>
                        <li class="treeview {{( $segment == 'genre') ? 'active' : ''}}">
                           <a href="#">
                           <i class="fa fa-laptop"></i>
                           <span>Thể loại</span>
                           <i class="fa fa-angle-left pull-right"></i>
                           </a>
                           <ul class="treeview-menu">
                              <li class="{{( $segment == 'genre' && $segment2 != 'create') ? 'active' : ''}}">
                                 <a href="{{route('genre.index')}}"
                                    ><i class="fa fa-angle-right"></i>Liệt kê Thể loại</a
                                    >
                              </li>
                              <li class="{{( $segment == 'genre' && $segment2 == 'create') ? 'active' : ''}}">
                                 <a href="{{route('genre.create')}}"
                                    ><i class="fa fa-angle-right"></i>Thêm Thể loại</a
                                    >
                              </li>
                           </ul>
                        </li>
                        <li class="treeview {{( $segment == 'movie') ? 'active' : ''}}">
                           <a href="#">
                           <i class="fa fa-film"></i>
                           <span>Phim</span>
                           <i class="fa fa-angle-left pull-right"></i>
                           </a>
                           <ul class="treeview-menu">
                              <li class="{{( $segment == 'movie' && $segment2 != 'create') ? 'active' : ''}}">
                                 <a href="{{route('movie.index')}}"
                                    ><i class="fa fa-angle-right"></i>Liệt kê phim</a
                                    >
                              </li>
                              <li class="{{( $segment == 'movie' && $segment2 == 'create') ? 'active' : ''}}">
                                 <a href="{{route('movie.create')}}"
                                    ><i class="fa fa-angle-right"></i>Thêm phim</a
                                    >
                              </li>
                           </ul>
                        </li>
                        <li class="treeview {{( $segment == 'episode') ? 'active' : ''}}">
                           <a href="#">
                           <i class="fa fa-file-movie-o"></i>
                           <span>Tập phim</span>
                           <i class="fa fa-angle-left pull-right"></i>
                           </a>
                           <ul class="treeview-menu">
                              <li class="{{( $segment == 'episode' && $segment2 != 'create') ? 'active' : ''}}">
                                 <a href="{{route('episode.index')}}"
                                    ><i class="fa fa-angle-right"></i>Liệt kê tập phim</a
                                    >
                              </li>
                              <li class="{{( $segment == 'episode' && $segment2 == 'create') ? 'active' : ''}}">
                                 <a href="{{route('episode.create')}}"
                                    ><i class="fa fa-angle-right"></i>Thêm tập phim</a
                                    >
                              </li>
                           </ul>
                        </li>
                     </ul>
                  </div>
                  <!-- /.navbar-collapse -->
               </nav>
            </aside>
         </div>
         <!-- header-starts -->
         <div class="sticky-header header-section">
            <div class="header-right">
               <!--search-box-->
               <div class="search-box">
                  <form class="input">
                     <input
                        class="sb-search-input input__field--madoka"
                        placeholder="Search..."
                        type="search"
                        id="input-31"
                        />
                     <label class="input__label" for="input-31">
                        <svg
                           class="graphic"
                           width="100%"
                           height="100%"
                           viewBox="0 0 404 77"
                           preserveAspectRatio="none"
                           >
                           <path d="m0,0l404,0l0,77l-404,0l0,-77z" />
                        </svg>
                     </label>
                  </form>
               </div>
               <!--//end-search-box-->
               <div class="profile_details">
                  <ul>
                     <li class="dropdown profile_details_drop">
                        <a
                           href="#"
                           class="dropdown-toggle"
                           data-toggle="dropdown"
                           aria-expanded="false"
                           >
                           <div class="profile_img">
                              <div class="user-name">
                                 <p>Hi, {{Auth::user()->name}}</p>
                                 <span>Welcome to admin page</span>
                              </div>
                              <i class="fa fa-angle-down lnr"></i>
                              <i class="fa fa-angle-up lnr"></i>
                              <div class="clearfix"></div>
                           </div>
                        </a>
                        <ul class="dropdown-menu drp-mnu">
                           <li>
                              <a href="{{route('logout')}}"><i class="fa fa-sign-out"></i>Đăng xuất</a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </div>
               <div class="clearfix"></div>
            </div>
            <div class="clearfix" style="padding-bottom: 10px;"></div>
         </div>
         <!-- //header-ends -->
         <!-- main content start-->
         <div id="page-wrapper">
            <div class="main-page">
               <div class="raw" style="margin-bottom: 20px;">
                  <div class="r3_counter_box" style="box-shadow: 0px 0px 5px 0px grey;">
                     <div class="stats">
                        <div class="col-md-4" style="text-align: center">
                           <span>Số lượng truy cập trong hôm nay</span>
                           <h5><strong>{{$datatoday}}</strong></h5>
                        </div>
                        <div class="col-md-4" style="text-align: center">
                           <span>Số lượng truy cập trong 7 ngày gần nhất</span>
                           <h5><strong>{{$data7days}}</strong></h5>
                        </div>
                        <div class="col-md-4" style="text-align: center">
                           <span>Số lượng truy cập trong 30 ngày gần nhất</span>
                           <h5><strong>{{$data30days}}</strong></h5>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col_3">
                  <div class="col-md-3 widget widget1">
                     <div class="r3_counter_box">
                        <i class="pull-left fa fa-bars icon-rounded"></i>
                        <div class="stats">
                           <h5><strong>{{$total_Category}}</strong></h5>
                           <span>Danh mục phim</span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 widget widget1">
                     <div class="r3_counter_box">
                        <i class="pull-left fa fa-laptop user1 icon-rounded"></i>
                        <div class="stats">
                           <h5><strong>{{$total_Genre}}</strong></h5>
                           <span>Thể loại phim</span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 widget widget1">
                     <div class="r3_counter_box">
                        <i class="pull-left fa fa-globe user2 icon-rounded"></i>
                        <div class="stats">
                           <h5><strong>{{$total_Country}}</strong></h5>
                           <span>Quốc gia sản xuất</span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 widget widget1">
                     <div class="r3_counter_box">
                        <i class="pull-left fa fa-film dollar1 icon-rounded"></i>
                        <div class="stats">
                           <h5><strong>{{$total_Movie}}</strong></h5>
                           <span>Phim</span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 widget">
                     <div class="r3_counter_box">
                        <i class="pull-left fa fa-users dollar2 icon-rounded"></i>
                        <div class="stats">
                           <h5><strong>{{$total_User}}</strong></h5>
                           <span>Tài khoản quản trị</span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="content-admin">
                     @yield('content')
                  </div>
               </div>
               <div class="clearfix"></div>
            </div>
         </div>
         <!--footer-->
         <div class="footer">
            <p>
               &copy; 2023 Website xem phim online | Design by
               <a href="https://www.facebook.com/profile.php?id=100008592283761" target="_blank">Nguyễn Hữu Tường</a>
            </p>
         </div>
         <!--//footer-->
      </div>
      @else
      @yield('content_login')
      @endif
      <script src="{{ asset('backend/js/SidebarNav.min.js') }}" type="text/javascript"></script>
      <script type="text/javascript">
         $('.sidebar-menu').SidebarNav();
      </script>
      <script type="text/javascript">

         $(document).ready( function () {
             $('#MovieTable').DataTable();
             $('#CategoryTable').DataTable();
             $('#CountryTable').DataTable();
             $('#GenreTable').DataTable();
         } );
         
         function ChangeToSlug()
             {
                 var slug;
                 //Lấy text từ thẻ input title 
                 slug = document.getElementById("title").value;
                 slug = slug.toLowerCase();
                 //Đổi ký tự có dấu thành không dấu
                     slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                     slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                     slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                     slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                     slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                     slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                     slug = slug.replace(/đ/gi, 'd');
                     //Xóa các ký tự đặt biệt
                     slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                     //Đổi khoảng trắng thành ký tự gạch ngang
                     slug = slug.replace(/ /gi, "-");
                     //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                     //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                     slug = slug.replace(/\-\-\-\-\-/gi, '-');
                     slug = slug.replace(/\-\-\-\-/gi, '-');
                     slug = slug.replace(/\-\-\-/gi, '-');
                     slug = slug.replace(/\-\-/gi, '-');
                     //Xóa các ký tự gạch ngang ở đầu và cuối
                     slug = '@' + slug + '@';
                     slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                     //In slug ra textbox có id “slug”
                 document.getElementById('slug').value = slug;
             };
         
             $('.select-movie').change(function(){
                 var id = $(this).val();
                 // alert(id);
                 $.ajax({
                     url: "{{route('select-movie')}}",
                     mothed: "GET",
                     data: {id:id},
                     success: function(data) {
                         $('#show_episode').html(data);
                     }
                 });
             });
         
             $('.select-year').change(function(){
                 var year = $(this).val();
                 var id_phim = $(this).attr('id');
                 // alert(id_phim);
                 // alert(year);
                 $.ajax({
                     url: "{{url('/update-year')}}",
                     method: "GET",
                     data: {year:year, id_phim:id_phim},
                     success: function() {
                         return window.location.assign("/movie")
                     }
                 })
             })
         
             $('.select-status').change(function(){
                 var status = $(this).val();
                 var id_phim = $(this).attr('id');
                 // alert(id_phim);
                 // alert(status);
                 $.ajax({
                     url: "{{url('/update-status')}}",
                     method: "GET",
                     data: {status:status, id_phim:id_phim},
                     success: function() {
                         return window.location.assign("/movie")
                     }
                 })
             })
         
             $('.select-category').change(function(){
                 var category = $(this).val();
                 var id_phim = $(this).attr('id');
                 // alert(id_phim);
                 // alert(category);
                 $.ajax({
                     url: "{{url('/update-category')}}",
                     method: "GET",
                     data: {category:category, id_phim:id_phim},
                     success: function() {
                         return window.location.assign("/movie")
                     }
                 })
             })
         
             $('.select-country').change(function(){
                 var country = $(this).val();
                 var id_phim = $(this).attr('id');
                 // alert(id_phim);
                 // alert(country);
                 $.ajax({
                     url: "{{url('/update-country')}}",
                     method: "GET",
                     data: {country:country, id_phim:id_phim},
                     success: function() {
                         return window.location.assign("/movie")
                     }
                 })
             })
      </script>
   </body>
</html>