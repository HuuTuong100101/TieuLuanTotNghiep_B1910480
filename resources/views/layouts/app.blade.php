<!DOCTYPE html>
<html>
  <head>
    <title>
        Movie-Pagoda
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta
      name="keywords"
      content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design"
    />
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
    <link
      href="{{ asset('backend/css/SidebarNav.min.css') }}"
      media="all"
      rel="stylesheet"
      type="text/css"
    />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- //side nav css file -->
    <!-- js-->
    <script src="{{ asset('backend/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('backend/js/modernizr.custom.js') }}"></script>
    <!--webfonts-->
    <link
      href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext"
      rel="stylesheet"
    />
    <!--//webfonts-->
    <!-- Metis Menu -->
    <script src="{{ asset('backend/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/js/custom.js') }}"></script>
    <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet" />
    <!--//Metis Menu -->

    <script src="//cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
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
          // backgroundColor: '#f1f1f1',
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
          // backgroundColor: '#f1f1f1',
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
              {{-- <div class="clearfix"></div> --}}
            </div>
            <div class="col-md-12">
              <div class="content-admin">
                @yield('content')
              </div>
            </div>
            <!-- for amcharts js -->
            {{-- <script src="{{ asset('backend/js/amcharts.js') }}"></script> --}}
            {{-- <script src="{{ asset('backend/js/serial.js') }}"></script> --}}
            {{-- <script src="{{ asset('backend/js/export.min.js') }}"></script> --}}
            {{-- <link
              rel="stylesheet"
              href="css/export.css"
              type="text/css"
              media="all"
            /> --}}
            {{-- <script src="{{ asset('backend/js/light.js') }}"></script> --}}
            <!-- for amcharts js -->
            {{-- <script src="{{ asset('backend/js/index1.js') }}"></script> --}}
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
    <!-- new added graphs chart js-->
    {{-- <script src="{{ asset('backend/js/Chart.bundle.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/js/utils.js') }}"></script> --}}
    <script>
      var MONTHS = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
      ];
      var color = Chart.helpers.color;
      var barChartData = {
        labels: [
          'January',
          'February',
          'March',
          'April',
          'May',
          'June',
          'July',
        ],
        datasets: [
          {
            label: 'Dataset 1',
            backgroundColor: color(window.chartColors.red)
              .alpha(0.5)
              .rgbString(),
            borderColor: window.chartColors.red,
            borderWidth: 1,
            data: [
              randomScalingFactor(),
              randomScalingFactor(),
              randomScalingFactor(),
              randomScalingFactor(),
              randomScalingFactor(),
              randomScalingFactor(),
              randomScalingFactor(),
            ],
          },
          {
            label: 'Dataset 2',
            backgroundColor: color(window.chartColors.blue)
              .alpha(0.5)
              .rgbString(),
            borderColor: window.chartColors.blue,
            borderWidth: 1,
            data: [
              randomScalingFactor(),
              randomScalingFactor(),
              randomScalingFactor(),
              randomScalingFactor(),
              randomScalingFactor(),
              randomScalingFactor(),
              randomScalingFactor(),
            ],
          },
        ],
      };

      window.onload = function () {
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myBar = new Chart(ctx, {
          type: 'bar',
          data: barChartData,
          options: {
            responsive: true,
            legend: {
              position: 'top',
            },
            title: {
              display: true,
              text: 'Chart.js Bar Chart',
            },
          },
        });
      };

      document
        .getElementById('randomizeData')
        .addEventListener('click', function () {
          var zero = Math.random() < 0.2 ? true : false;
          barChartData.datasets.forEach(function (dataset) {
            dataset.data = dataset.data.map(function () {
              return zero ? 0.0 : randomScalingFactor();
            });
          });
          window.myBar.update();
        });

      var colorNames = Object.keys(window.chartColors);
      document
        .getElementById('addDataset')
        .addEventListener('click', function () {
          var colorName =
            colorNames[barChartData.datasets.length % colorNames.length];
          var dsColor = window.chartColors[colorName];
          var newDataset = {
            label: 'Dataset ' + barChartData.datasets.length,
            backgroundColor: color(dsColor).alpha(0.5).rgbString(),
            borderColor: dsColor,
            borderWidth: 1,
            data: [],
          };

          for (var index = 0; index < barChartData.labels.length; ++index) {
            newDataset.data.push(randomScalingFactor());
          }

          barChartData.datasets.push(newDataset);
          window.myBar.update();
        });

      document.getElementById('addData').addEventListener('click', function () {
        if (barChartData.datasets.length > 0) {
          var month = MONTHS[barChartData.labels.length % MONTHS.length];
          barChartData.labels.push(month);

          for (var index = 0; index < barChartData.datasets.length; ++index) {
            //window.myBar.addData(randomScalingFactor(), index);
            barChartData.datasets[index].data.push(randomScalingFactor());
          }

          window.myBar.update();
        }
      });

      document
        .getElementById('removeDataset')
        .addEventListener('click', function () {
          barChartData.datasets.splice(0, 1);
          window.myBar.update();
        });

      document
        .getElementById('removeData')
        .addEventListener('click', function () {
          barChartData.labels.splice(-1, 1); // remove the label first

          barChartData.datasets.forEach(function (dataset, datasetIndex) {
            dataset.data.pop();
          });

          window.myBar.update();
        });
    </script>
    <!-- new added graphs chart js-->
    <!-- Classie -->
    <!-- for toggle left push menu script -->
    <script src="{{ asset('backend/js/classie.js') }}"></script>
    <script>
      var menuLeft = document.getElementById('cbp-spmenu-s1'),
        showLeftPush = document.getElementById('showLeftPush'),
        body = document.body;

      showLeftPush.onclick = function () {
        classie.toggle(this, 'active');
        classie.toggle(body, 'cbp-spmenu-push-toright');
        classie.toggle(menuLeft, 'cbp-spmenu-open');
        disableOther('showLeftPush');
      };

      function disableOther(button) {
        if (button !== 'showLeftPush') {
          classie.toggle(showLeftPush, 'disabled');
        }
      }
    </script>
    <!-- //Classie -->
    <!-- //for toggle left push menu script -->
    <!--scrolling js-->
    {{-- <script src="{{ asset('backend/js/jquery.nicescroll.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/js/scripts.js') }}"></script> --}}
    <!--//scrolling js-->
    <!-- side nav js -->
    <script src="{{ asset('backend/js/SidebarNav.min.js') }}" type="text/javascript"></script>
    <script>
      $('.sidebar-menu').SidebarNav();
    </script>
    <!-- //side nav js -->
    <!-- for index page weekly sales java script -->
    {{-- <script src="{{ asset('backend/js/SimpleChart.js') }}"></script> --}}
    {{-- <script>
      var graphdata1 = {
        linecolor: '#CCA300',
        title: 'Monday',
        values: [
          { X: '6:00', Y: 10.0 },
          { X: '7:00', Y: 20.0 },
          { X: '8:00', Y: 40.0 },
          { X: '9:00', Y: 34.0 },
          { X: '10:00', Y: 40.25 },
          { X: '11:00', Y: 28.56 },
          { X: '12:00', Y: 18.57 },
          { X: '13:00', Y: 34.0 },
          { X: '14:00', Y: 40.89 },
          { X: '15:00', Y: 12.57 },
          { X: '16:00', Y: 28.24 },
          { X: '17:00', Y: 18.0 },
          { X: '18:00', Y: 34.24 },
          { X: '19:00', Y: 40.58 },
          { X: '20:00', Y: 12.54 },
          { X: '21:00', Y: 28.0 },
          { X: '22:00', Y: 18.0 },
          { X: '23:00', Y: 34.89 },
          { X: '0:00', Y: 40.26 },
          { X: '1:00', Y: 28.89 },
          { X: '2:00', Y: 18.87 },
          { X: '3:00', Y: 34.0 },
          { X: '4:00', Y: 40.0 },
        ],
      };
      var graphdata2 = {
        linecolor: '#00CC66',
        title: 'Tuesday',
        values: [
          { X: '6:00', Y: 100.0 },
          { X: '7:00', Y: 120.0 },
          { X: '8:00', Y: 140.0 },
          { X: '9:00', Y: 134.0 },
          { X: '10:00', Y: 140.25 },
          { X: '11:00', Y: 128.56 },
          { X: '12:00', Y: 118.57 },
          { X: '13:00', Y: 134.0 },
          { X: '14:00', Y: 140.89 },
          { X: '15:00', Y: 112.57 },
          { X: '16:00', Y: 128.24 },
          { X: '17:00', Y: 118.0 },
          { X: '18:00', Y: 134.24 },
          { X: '19:00', Y: 140.58 },
          { X: '20:00', Y: 112.54 },
          { X: '21:00', Y: 128.0 },
          { X: '22:00', Y: 118.0 },
          { X: '23:00', Y: 134.89 },
          { X: '0:00', Y: 140.26 },
          { X: '1:00', Y: 128.89 },
          { X: '2:00', Y: 118.87 },
          { X: '3:00', Y: 134.0 },
          { X: '4:00', Y: 180.0 },
        ],
      };
      var graphdata3 = {
        linecolor: '#FF99CC',
        title: 'Wednesday',
        values: [
          { X: '6:00', Y: 230.0 },
          { X: '7:00', Y: 210.0 },
          { X: '8:00', Y: 214.0 },
          { X: '9:00', Y: 234.0 },
          { X: '10:00', Y: 247.25 },
          { X: '11:00', Y: 218.56 },
          { X: '12:00', Y: 268.57 },
          { X: '13:00', Y: 274.0 },
          { X: '14:00', Y: 280.89 },
          { X: '15:00', Y: 242.57 },
          { X: '16:00', Y: 298.24 },
          { X: '17:00', Y: 208.0 },
          { X: '18:00', Y: 214.24 },
          { X: '19:00', Y: 214.58 },
          { X: '20:00', Y: 211.54 },
          { X: '21:00', Y: 248.0 },
          { X: '22:00', Y: 258.0 },
          { X: '23:00', Y: 234.89 },
          { X: '0:00', Y: 210.26 },
          { X: '1:00', Y: 248.89 },
          { X: '2:00', Y: 238.87 },
          { X: '3:00', Y: 264.0 },
          { X: '4:00', Y: 270.0 },
        ],
      };
      var graphdata4 = {
        linecolor: 'Random',
        title: 'Thursday',
        values: [
          { X: '6:00', Y: 300.0 },
          { X: '7:00', Y: 410.98 },
          { X: '8:00', Y: 310.0 },
          { X: '9:00', Y: 314.0 },
          { X: '10:00', Y: 310.25 },
          { X: '11:00', Y: 318.56 },
          { X: '12:00', Y: 318.57 },
          { X: '13:00', Y: 314.0 },
          { X: '14:00', Y: 310.89 },
          { X: '15:00', Y: 512.57 },
          { X: '16:00', Y: 318.24 },
          { X: '17:00', Y: 318.0 },
          { X: '18:00', Y: 314.24 },
          { X: '19:00', Y: 310.58 },
          { X: '20:00', Y: 312.54 },
          { X: '21:00', Y: 318.0 },
          { X: '22:00', Y: 318.0 },
          { X: '23:00', Y: 314.89 },
          { X: '0:00', Y: 310.26 },
          { X: '1:00', Y: 318.89 },
          { X: '2:00', Y: 518.87 },
          { X: '3:00', Y: 314.0 },
          { X: '4:00', Y: 310.0 },
        ],
      };
      var Piedata = {
        linecolor: 'Random',
        title: 'Profit',
        values: [
          { X: 'Monday', Y: 50.0 },
          { X: 'Tuesday', Y: 110.98 },
          { X: 'Wednesday', Y: 70.0 },
          { X: 'Thursday', Y: 204.0 },
          { X: 'Friday', Y: 80.25 },
          { X: 'Saturday', Y: 38.56 },
          { X: 'Sunday', Y: 98.57 },
        ],
      };
      $(function () {
        $('#Bargraph').SimpleChart({
          ChartType: 'Bar',
          toolwidth: '50',
          toolheight: '25',
          axiscolor: '#E6E6E6',
          textcolor: '#6E6E6E',
          showlegends: true,
          data: [graphdata4, graphdata3, graphdata2, graphdata1],
          legendsize: '140',
          legendposition: 'bottom',
          xaxislabel: 'Hours',
          title: 'Weekly Profit',
          yaxislabel: 'Profit in $',
        });
        $('#sltchartype').on('change', function () {
          $('#Bargraph').SimpleChart('ChartType', $(this).val());
          $('#Bargraph').SimpleChart('reload', 'true');
        });
        $('#Hybridgraph').SimpleChart({
          ChartType: 'Hybrid',
          toolwidth: '50',
          toolheight: '25',
          axiscolor: '#E6E6E6',
          textcolor: '#6E6E6E',
          showlegends: true,
          data: [graphdata4],
          legendsize: '140',
          legendposition: 'bottom',
          xaxislabel: 'Hours',
          title: 'Weekly Profit',
          yaxislabel: 'Profit in $',
        });
        $('#Linegraph').SimpleChart({
          ChartType: 'Line',
          toolwidth: '50',
          toolheight: '25',
          axiscolor: '#E6E6E6',
          textcolor: '#6E6E6E',
          showlegends: false,
          data: [graphdata4, graphdata3, graphdata2, graphdata1],
          legendsize: '140',
          legendposition: 'bottom',
          xaxislabel: 'Hours',
          title: 'Weekly Profit',
          yaxislabel: 'Profit in $',
        });
        $('#Areagraph').SimpleChart({
          ChartType: 'Area',
          toolwidth: '50',
          toolheight: '25',
          axiscolor: '#E6E6E6',
          textcolor: '#6E6E6E',
          showlegends: true,
          data: [graphdata4, graphdata3, graphdata2, graphdata1],
          legendsize: '140',
          legendposition: 'bottom',
          xaxislabel: 'Hours',
          title: 'Weekly Profit',
          yaxislabel: 'Profit in $',
        });
        $('#Scatterredgraph').SimpleChart({
          ChartType: 'Scattered',
          toolwidth: '50',
          toolheight: '25',
          axiscolor: '#E6E6E6',
          textcolor: '#6E6E6E',
          showlegends: true,
          data: [graphdata4, graphdata3, graphdata2, graphdata1],
          legendsize: '140',
          legendposition: 'bottom',
          xaxislabel: 'Hours',
          title: 'Weekly Profit',
          yaxislabel: 'Profit in $',
        });
        $('#Piegraph').SimpleChart({
          ChartType: 'Pie',
          toolwidth: '50',
          toolheight: '25',
          axiscolor: '#E6E6E6',
          textcolor: '#6E6E6E',
          showlegends: true,
          showpielables: true,
          data: [Piedata],
          legendsize: '250',
          legendposition: 'right',
          xaxislabel: 'Hours',
          title: 'Weekly Profit',
          yaxislabel: 'Profit in $',
        });

        $('#Stackedbargraph').SimpleChart({
          ChartType: 'Stacked',
          toolwidth: '50',
          toolheight: '25',
          axiscolor: '#E6E6E6',
          textcolor: '#6E6E6E',
          showlegends: true,
          data: [graphdata3, graphdata2, graphdata1],
          legendsize: '140',
          legendposition: 'bottom',
          xaxislabel: 'Hours',
          title: 'Weekly Profit',
          yaxislabel: 'Profit in $',
        });

        $('#StackedHybridbargraph').SimpleChart({
          ChartType: 'StackedHybrid',
          toolwidth: '50',
          toolheight: '25',
          axiscolor: '#E6E6E6',
          textcolor: '#6E6E6E',
          showlegends: true,
          data: [graphdata3, graphdata2, graphdata1],
          legendsize: '140',
          legendposition: 'bottom',
          xaxislabel: 'Hours',
          title: 'Weekly Profit',
          yaxislabel: 'Profit in $',
        });
      });
    </script> --}}
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

            $(document).on('change','.change-img', function(){
                var id_phim = $(this).data('movie_id');
                var files = $("#"+id_phim)[0].files;
                // console.log(files)

                var image = document.getElementById(id_phim).files[0];
                // console.log(image)
                var form_data = new FormData();

                form_data.append("file", document.getElementById(id_phim).files[0]);
                form_data.append("id_phim",id_phim);

                $.ajax({
                        url:"{{route('update-image-movie')}}",
                        method:"POST",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:form_data,

                        contentType:false,
                        cache:false,
                        processData:false,

                        success:function(){
                            return window.location.assign("/movie")
                            // location.reload();
                            // alert('Cập nhật hình ảnh thành công !');
                        }
                });
            })
    </script>
    <!-- //for index page weekly sales java script -->
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('backend/js/bootstrap.js') }}"></script>
    <!-- //Bootstrap Core JavaScript -->
  </body>
</html>
