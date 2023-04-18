<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/css/style.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if (Auth::id())
                <div class="container">
                    @include('layouts.navbar')
                </div>
            @endif
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="//cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    
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
</body>
</html>
