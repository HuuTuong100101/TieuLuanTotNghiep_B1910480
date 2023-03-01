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
                    
                    @if (!isset($movie))
                        {!! Form::open(['route'=>'movie.store','method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                    @else
                        {!! Form::open(['route'=>['movie.update', $movie->id],'method'=>'PUT']) !!}
                    @endif
                            <div class="form-group">
                                {!! Form::label('title', 'Title', []) !!}
                                {!! Form::text('title', isset($movie) ? $movie->title : '', ['class'=>'form-control', 'placeholder'=>'Nhập dữ liệu', 'onkeyup'=>'ChangeToSlug()']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('slug', 'Slug', ['class'=>'mt-3']) !!}
                                {!! Form::text('slug', isset($movie) ? $movie->slug : '', ['class'=>'form-control', 'placeholder'=>'Dữ liệu tự động điền, không cần nhập ở đây', 'id'=>'slug', 'type'=>'hidden']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', 'Description', ['class'=>'mt-3']) !!}
                                {!! Form::textarea('description', isset($movie) ? $movie->description : '', ['style'=>'resize:none','class'=>'form-control', 'placeholder'=>'Nhập dữ liệu']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('status', 'Status', ['class'=>'mt-3']) !!}
                                {!! Form::select('status', ['1'=>'hiển thị', '0'=>'ẩn'], isset($movie) ? $movie->status : '1', ['class'=>'form-select']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('category', 'Category', ['class'=>'mt-3']) !!}
                                {!! Form::select('category_id', $list_category, isset($movie) ? $movie->category : '', ['class'=>'form-select']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('country', 'Country', ['class'=>'mt-3']) !!}
                                {!! Form::select('country_id', $list_country, isset($movie) ? $movie->country : '', ['class'=>'form-select']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('genre', 'Genre', ['class'=>'mt-3']) !!}
                                {!! Form::select('genre_id', $list_genre, isset($movie) ? $movie->genre : '', ['class'=>'form-select']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Image', 'Image', ['class'=>'mt-3']) !!}
                                {!! Form::file('image', ['class'=>'form-control-file']) !!}
                            </div>
                            @if (!isset($movie))
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
                    <th scope="col">Thứ tự</th>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Description</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Quốc gia</th>
                    <th scope="col">Thể loại</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Manage</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($list_movie as $index => $movie)
                        <tr>
                        <th scope="row">{{$index}}</th>
                        <td>{{$movie->title}}</td>
                        <td>{{$movie->slug}}</td>
                        <td>{{$movie->description}}</td>
                        <td>
                            @if ($movie->status)
                                hiển thị
                            @else
                                ẩn
                            @endif
                        </td>
                        <td>{{$movie->country_id}}</td>
                        <td>{{$movie->genre_id}}</td>
                        <td>{{$movie->category_id}}</td>
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
