@extends('layouts.app')

@section('content')
<div class="container">
    <div class="title-table-admin">
        <h2>
            Quản lý danh mục phim
        </h2>
    </div>
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
                    <th scope="col" style="width:105px;">Manage</th>
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
                        <td class="manage-active">
                            {!! Form::open(['method'=>'DELETE', 'route'=>['category.destroy', $category->id], 'onsubmit' => 'return confirm("Bạn có muốn xóa không ?")', 'class'=>' d-inline-block']) !!}
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
