@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="title-table-admin">
            <h2>
                Chi tiết phim >> {{$movie->title}}
            </h2>
        </div>
        <div class="row">
            <div class="col-md-3">
              <div style="width: 280px; height: 500px" class="thumbnail">
                <img style="object-fit: contain;" src="{{asset('./uploads/movie/'.$movie->image)}}" alt="...">
                <div class="caption">
                  <h3 class="card-title">{{$movie->title}}</h3>
                </div>
              </div>
            </div>
            <div class="col-md-9">
                <div style="height: 500px" class="thumbnail">
                    <div class="row">
                        <p><span style="font-weight: bold" class="card-text">Mô tả: </span></p>
                        <p style="height: 200px" class="card-text of-hidden">{{$movie->description}}</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="card-text"><span style="font-weight: bold">Danh mục: </span>{{$movie->category->title}}</p>
                            <p class="card-text"><span style="font-weight: bold">Từ khóa: </span>{{$movie->tags}}</p>
                            <p class="card-text"><span style="font-weight: bold">Trailer: </span>{{$movie->trailer}}</p>
                            <p class="card-text"><span style="font-weight: bold">Slugs: </span>{{$movie->slug}}</p>
                            <p class="card-text"><span style="font-weight: bold">Quốc gia: </span>{{$movie->country->title}}</p>
                            <p class="card-text"><span style="font-weight: bold">Thời lượng: </span>{{$movie->lenght}} phút/tập</p>
                        </div>
                        <div class="col-md-6">
                            <p class="card-text"><span style="font-weight: bold">Năm phát hành: </span>{{$movie->year}}</p>
                            <p class="card-text"><span style="font-weight: bold">Lượt quan tâm: </span>{{$movie->views}}</p>
                            <p class="card-text">
                                <span style="font-weight: bold">Chất lượng: </span>
                                @if($movie->quality == 1) 
                                    HD
                                @elseif($movie->quality == 2)
                                    Full HD
                                @else
                                    SD
                                @endif
                            </p>
                            <p class="card-text">
                                <span style="font-weight: bold">Subtitles: </span>
                                @if($movie->subtitles == 1) 
                                    Vietsub
                                @elseif($movie->subtitles == 2)
                                    Engsub
                                @elseif($movie->subtitles == 3)
                                    Thuyết minh
                                @else
                                    Lồng tiếng
                                @endif
                            </p>
                            <p class="card-text"><span style="font-weight: bold">Ngày tạo: </span>{{$movie->datecreated}}</p>
                            <p class="card-text"><span style="font-weight: bold">Ngày cập nhật: </span>{{$movie->dateupdated}}</p>
                        </div>
                    </div>
                    <div class="raw detail-manage">
                        {!! Form::open(['method'=>'DELETE', 'route'=>['movie.destroy', $movie->id], 'class'=>'d-inline-block' ,'onsubmit' => 'return confirm("Bạn có muốn xóa không ?")']) !!}
                            {!! Form::submit('Xóa', ['class'=>'btn btn-danger', 'style' => 'margin-right: 15px']) !!}
                        {!! Form::close() !!}
                        <a href="{{route('movie.edit', $movie->id)}}" class="btn btn-warning">Sửa</a>
                    </div>
                </div>
            </div>
          </div>
        {{-- <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                        <h5 class="card-title">{{$movie->title}}</h5>
                        <span style="font-weight: bold">Mô tả: </span>
                        <p style="height: 100px" class="card-text of-hidden">{{$movie->description}}</p>
                        <p class="card-text"><span style="font-weight: bold">Danh mục: </span>{{$movie->category->title}}</p>
                        <p class="card-text"><span style="font-weight: bold">Từ khóa: </span>{{$movie->tags}}</p>
                        <p class="card-text"><span style="font-weight: bold">Trailer: </span>{{$movie->trailer}}</p>
                        <p class="card-text"><span style="font-weight: bold">Slugs: </span>{{$movie->slug}}</p>
                        <p class="card-text"><span style="font-weight: bold">Quốc gia: </span>{{$movie->country->title}}</p>
                        <p class="card-text"><span style="font-weight: bold">Thời lượng: </span>{{$movie->lenght}} phút/tập</p>
                        <p class="card-text"><span style="font-weight: bold">Năm phát hành: </span>{{$movie->year}}</p>
                        <p class="card-text"><span style="font-weight: bold">Lượt quan tâm: </span>{{$movie->views}}</p>
                        <p class="card-text">
                            <span style="font-weight: bold">Chất lượng: </span>
                            @if($movie->quality == 1) 
                                HD
                            @elseif($movie->quality == 2)
                                Full HD
                            @else
                                SD
                            @endif
                        </p>
                        <p class="card-text">
                            <span style="font-weight: bold">Subtitles: </span>
                            @if($movie->subtitles == 1) 
                                Vietsub
                            @elseif($movie->subtitles == 2)
                                Engsub
                            @elseif($movie->subtitles == 3)
                                Thuyết minh
                            @else
                                Lồng tiếng
                            @endif
                        </p>
                        <p class="card-text"><span style="font-weight: bold">Ngày tạo: </span>{{$movie->datecreated}}</p>
                        <p class="card-text"><span style="font-weight: bold">Ngày cập nhật: </span>{{$movie->dateupdated}}</p>
                        <div class = "active-detail card-text">
                            {!! Form::open(['method'=>'DELETE', 'route'=>['movie.destroy', $movie->id], 'class'=>'d-inline-block' ,'onsubmit' => 'return confirm("Bạn có muốn xóa không ?")']) !!}
                                {!! Form::submit('Xóa', ['class'=>'btn btn-danger', 'style' => 'margin-right: 15px']) !!}
                            {!! Form::close() !!}
                            <a href="{{route('movie.edit', $movie->id)}}" class="btn btn-warning">Sửa</a>
                        </div>
                </div>
                <div class="col-md-3 img-detail">
                    <img width="70%" src="{{asset('./uploads/movie/'.$movie->image)}}" class="img-fluid rounded-3" alt="{{$movie->title}}">
                </div>
            </div>
        </div> --}}
    </div>
@endsection