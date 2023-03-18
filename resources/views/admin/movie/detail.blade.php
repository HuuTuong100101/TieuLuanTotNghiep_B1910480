@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mt-3 mb-3">
            Chi tiết phim
        </div>
        <div class="card mb-3 mt-3">
            <div class="row g-0">
                <div class="col-md-3 align-self-center text-center border-none">
                    <div>
                        <img width="50%" src="{{asset('./uploads/movie/'.$movie->image)}}" class="img-fluid rounded-3" alt="{{$movie->title}}">
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase fs-1">{{$movie->title}}</h5>
                        <p style="height: 100px" class="card-text overflow-auto mb-0 fst-italic">{{$movie->description}}</p>
                        <p class="card-text"><span style="font-weight: bold">Danh mục: </span>{{$movie->category->title}}</p>
                        <p class="card-text"><span style="font-weight: bold">Từ khóa: </span>{{$movie->tags}}</p>
                        <p class="card-text"><span style="font-weight: bold">Quốc gia: </span>{{$movie->country->title}}</p>
                        <p class="card-text"><span style="font-weight: bold">Thời lượng: </span>{{$movie->lenght}}</p>
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
                            @else
                                Lồng tiếng
                            @endif
                        </p>
                        <p class="card-text"><span style="font-weight: bold">Ngày tạo: </span>{{$movie->DateCreated}}</p>
                        <p class="card-text"><span style="font-weight: bold">Ngày cập nhật: </span>{{$movie->DateUpdated}}</p>
                        {!! Form::open(['method'=>'DELETE', 'route'=>['movie.destroy', $movie->id], 'class'=>'d-inline-block' ,'onsubmit' => 'return confirm("Bạn có muốn xóa không ?")']) !!}
                            {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
                        {!! Form::close() !!}
                        <a href="{{route('movie.edit', $movie->id)}}" class="btn btn-warning">Sửa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection