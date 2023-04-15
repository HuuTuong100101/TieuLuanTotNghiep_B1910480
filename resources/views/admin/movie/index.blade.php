@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('movie.create')}}" class="btn btn-success mt-3 mb-3">Thêm Phim</a>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table align-middle" id="MovieTable">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên phim</th>
                    <th class="text-center" scope="col">Ảnh</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Quốc gia</th>
                    <th scope="col">Thể loại</th>
                    <th scope="col">Phim hot</th>
                    <th scope="col">Năm PH</th>
                    <th scope="col">Tập phim</th>
                    <th scope="col">Ẩn/Hiện</th>
                    <th scope="col">Chi tiết</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($list_movie as $index => $movie)
                        <tr>
                        <th scope="row">{{$index}}</th>
                        <td>{{$movie->title}}</td>
                        <td class="text-center">
                            <img width="100" src="{{asset('uploads/movie/'.$movie->image)}}" alt="#">
                            {!! Form::label($movie->id, 'Đổi ảnh', ['class'=>'mt-3 btn btn-success w-100']) !!}
                            {!! Form::file('image',['class'=>'change-img form-control-file invisible', 'data-movie_id'=>$movie->id, 'id'=>$movie->id ,'accept'=>'image/*']) !!}
                        </td>
                        <td>
                            {!! Form::select('category', $list_category, isset($movie) ? $movie->category->id : '1', ['class'=>'form-select select-category w-auto', 'id' => $movie->id]) !!}
                        </td>
                        <td>
                            {!! Form::select('country', $list_country, isset($movie) ? $movie->country->id : '1', ['class'=>'form-select select-country w-auto', 'id' => $movie->id]) !!}
                        </td>
                        <td>
                            @foreach ($movie->movie_genre as $genre)
                                <span class="badge bg-secondary">{{$genre->title}}</span>
                            @endforeach
                        </td>
                        <td>
                            {{-- {!! From::select('hot', ['1'=>hot]) !!} --}}
                            {{-- Đếm view để xác định độ hot --}}
                            @if ($movie->hot)
                                hot
                            @else
                                không hot
                            @endif
                        </td>
                        <td>
                            {!! Form::selectYear('year',2023, 1990, $movie->year != NULL ? $movie->year : 0, ['class' => 'select-year form-select w-auto', 'id' => $movie->id]) !!}
                        </td>
                        <td>
                            {{count($movie->episodes)}} / {{$movie->episode}}
                        </td>
                        <td>
                            {!! Form::select('status', ['1'=>'hiển thị', '0'=>'ẩn'],isset($movie) ? $movie->status : '0',['class'=>'form-select select-status w-auto', 'id' => $movie->id]) !!}
                        </td>
                        <td>
                            <a href="{{route('movie.show', $movie->id)}}" class="btn btn-outline-info">Detail</a>
                        </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection