@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('movie.create')}}" class="btn btn-success mt-3 mb-3">Thêm Phim</a>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table" id="MovieTable">
                <thead>
                <tr>
                    <th scope="col">Index</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Category</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Country</th>
                    <th scope="col">Hot</th>
                    <th scope="col">Active/Inactive</th>
                    <th scope="col">Manage</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($list_movie as $index => $movie)
                        <tr>
                        <th scope="row">{{$index}}</th>
                        <td>{{$movie->title}}</td>
                        <td><img width="70% " src="{{asset('uploads/movie/'.$movie->image)}}" alt="#"></td>
                        <td>{{$movie->description}}</td>
                        <td>{{$movie->slug}}</td>
                        <td>{{$movie->category->title}}</td>
                        <td>{{$movie->genre->title}}</td>
                        <td>{{$movie->country->title}}</td>
                        <td>
                            @if ($movie->hot)
                                hot
                            @else
                                không hot
                            @endif
                        </td>
                        <td>
                            @if ($movie->status)
                                hiển thị
                            @else
                                ẩn
                            @endif
                        </td>
                        <td>
                            {!! Form::open(['method'=>'DELETE', 'route'=>['movie.destroy', $movie->id], 'onsubmit' => 'return confirm("Bạn có muốn xóa không ?")']) !!}
                                {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            <a href="{{route('movie.edit', $movie->id)}}" class="btn btn-warning">Sửa</a>
                        </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection