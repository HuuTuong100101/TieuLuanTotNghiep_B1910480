@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('category.create')}}" class="btn btn-success mt-3 mb-3">Thêm danh mục</a>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table" id="CategoryTable">
                <thead>
                  <tr>
                    <th scope="col">Index</th>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Description</th>
                    <th scope="col">Active/Inactive</th>
                    <th scope="col">Manage</th>
                  </tr>
                </thead>
                <tbody class="order_id">
                    @foreach ($list as $index => $category)
                        <tr id="{{$category->id}}">
                        <th scope="row">{{$index}}</th>
                        <td>{{$category->title}}</td>
                        <td>{{$category->slug}}</td>
                        <td>{{$category->description}}</td>
                        <td>
                            @if ($category->status)
                                hiển thị
                            @else
                                ẩn
                            @endif
                        </td>
                        <td>
                            {!! Form::open(['method'=>'DELETE', 'route'=>['category.destroy', $category->id], 'onsubmit' => 'return confirm("Bạn có muốn xóa không ?")']) !!}
                                {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            <a href="{{route('category.edit', $category->id)}}" class="btn btn-warning">Sửa</a>
                        </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
