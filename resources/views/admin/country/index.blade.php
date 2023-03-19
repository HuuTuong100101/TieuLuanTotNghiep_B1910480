@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('country.create')}}" class="btn btn-success mt-3 mb-3">Thêm quốc gia</a>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table" id="CountryTable">
                <thead>
                  <tr>
                    <th scope="col">Index</th>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Description</th>
                    <th scope="col">Active/Inactive</th>
                    <th scope="col" style="width:95px;">Manage</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($list as $index => $country)
                        <tr>
                        <th scope="row">{{$index}}</th>
                        <td>{{$country->title}}</td>
                        <td>{{$country->slug}}</td>
                        <td>{{$country->description}}</td>
                        <td>
                            @if ($country->status)
                                hiển thị
                            @else
                                ẩn
                            @endif
                        </td>
                        <td>
                            {!! Form::open(['method'=>'DELETE', 'route'=>['country.destroy', $country->id], 'onsubmit' => 'return confirm("Bạn có muốn xóa không ?")', 'class'=>'d-inline-block']) !!}
                                {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            <a href="{{route('country.edit', $country->id)}}" class="btn btn-warning">Sửa</a>
                        </td>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection
