@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản lý danh mục</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if (!isset($genre))
                        {!! Form::open(['route'=>'genre.store','method'=>'POST']) !!}
                    @else
                        {!! Form::open(['route'=>['genre.update', $genre->id],'method'=>'PUT']) !!}
                    @endif
                            <div class="form-group">
                                {!! Form::label('title', 'Title', []) !!}
                                {!! Form::text('title', isset($genre) ? $genre->title : '', ['class'=>'form-control', 'placeholder'=>'Nhập dữ liệu', 'onkeyup'=>'ChangeToSlug()']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('slug', 'Slug', ['class'=>'mt-3']) !!}
                                {!! Form::text('slug', isset($genre) ? $genre->slug : '', ['class'=>'form-control', 'placeholder'=>'Dữ liệu tự động điền, không cần nhập ở đây', 'id'=>'slug', 'type'=>'hidden']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', 'Description', ['class'=>'mt-3']) !!}
                                {!! Form::textarea('description', isset($genre) ? $genre->description : '', ['style'=>'resize:none','class'=>'form-control', 'placeholder'=>'Nhập dữ liệu']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('status', 'Status', ['class'=>'mt-3']) !!}
                                {!! Form::select('status', ['1'=>'hiển thị', '0'=>'ẩn'], isset($genre) ? $genre->status : '1', ['class'=>'form-select']) !!}
                            </div>
                            @if (!isset($genre))
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
                    <th scope="col">Manage</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($list as $index => $genre)
                        <tr>
                        <th scope="row">{{$index}}</th>
                        <td>{{$genre->title}}</td>
                        <td>{{$genre->slug}}</td>
                        <td>{{$genre->description}}</td>
                        <td>
                            @if ($genre->status)
                                hiển thị
                            @else
                                ẩn
                            @endif
                        </td>
                        <td>
                            {!! Form::open(['method'=>'DELETE', 'route'=>['genre.destroy', $genre->id], 'onsubmit' => 'return confirm("Bạn có muốn xóa không ?")']) !!}
                                {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            <a href="{{route('genre.edit', $genre->id)}}" class="btn btn-warning">Sửa</a>
                        </td>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection
