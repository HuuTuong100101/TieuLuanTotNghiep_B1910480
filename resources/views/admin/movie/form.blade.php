@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản lý phim</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if (!isset($movies))
                        {!! Form::open(['route'=>'movie.store','method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                    @else
                        {!! Form::open(['route'=>['movie.update', $movies->id],'method'=>'PUT', 'enctype'=>'multipart/form-data']) !!}
                    @endif
                            <div class="form-group">
                                {!! Form::label('title', 'Title', []) !!}
                                {!! Form::text('title', isset($movies) ? $movies->title : '', ['class'=>'form-control', 'placeholder'=>'Nhập dữ liệu', 'onkeyup'=>'ChangeToSlug()']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('slug', 'Slug', ['class'=>'mt-3']) !!}
                                {!! Form::text('slug', isset($movies) ? $movies->slug : '', ['class'=>'form-control', 'placeholder'=>'Dữ liệu tự động điền, không cần nhập ở đây', 'id'=>'slug', 'type'=>'hidden']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', 'Description', ['class'=>'mt-3']) !!}
                                {!! Form::textarea('description', isset($movies) ? $movies->description : '', ['style'=>'resize:none','class'=>'form-control', 'placeholder'=>'Nhập dữ liệu']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('status', 'Status', ['class'=>'mt-3']) !!}
                                {!! Form::select('status', ['1'=>'hiển thị', '0'=>'ẩn'], isset($movies) ? $movies->status : '1', ['class'=>'form-select']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('category', 'Category', ['class'=>'mt-3']) !!}
                                {!! Form::select('category_id', $list_category, isset($movies) ? $movies->category_id : '1', ['class'=>'form-select']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('country', 'Country', ['class'=>'mt-3']) !!}
                                {!! Form::select('country_id', $list_country, isset($movies) ? $movies->country_id : '1', ['class'=>'form-select']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('genre', 'Genre', ['class'=>'mt-3']) !!}
                                {!! Form::select('genre_id', $list_genre, isset($movies) ? $movies->genre_id : '1', ['class'=>'form-select']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Image', 'Image', ['class'=>'mt-3']) !!}
                                {!! Form::file('image', ['class'=>'form-control']) !!}
                                @if (isset($movies))
                                    <img width="20%" src="{{asset('./uploads/movie/'.$movies->image)}}" alt="">
                                @endif
                            </div>
                            @if (!isset($movies))
                                {!! Form::submit('Thêm dữ liệu', ['class'=>'btn btn-success mt-3']) !!}
                            @else
                                {!! Form::submit('Cập nhật', ['class'=>'btn btn-success mt-3']) !!}
                            @endif
                        {!! Form::close() !!}
                </div>
            </div>

            <table class="table">
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
