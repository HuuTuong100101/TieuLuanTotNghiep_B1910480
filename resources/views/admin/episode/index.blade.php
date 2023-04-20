@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <a href="{{route('episode.create')}}" class="btn btn-success mt-3 mb-3">Thêm Tập Phim</a> --}}
    <div class="title-table-admin">
        <h2>
            Quản lý tập phim
        </h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table align-middle" id="MovieTable">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Episode</th>
                    <th scope="col">Link</th>
                    <th scope="col">DateCreated</th>
                    <th scope="col">DateUpdated</th>
                    <th scope="col">Active/Inactive</th>
                    <th scope="col" style="width:105px;">Manage</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($episodes as $index => $episode)
                        <tr>
                        <th scope="row">{{$index}}</th>
                        <td>{{$episode->movie->title}}</td>
                        <th scope="row"><img width="30%" src="{{asset('/uploads/movie/'.$episode->movie->image)}}" alt="{{$episode->movie->title}}"></th>
                        <td>{{$episode->episode}}</td>
                        <td>{{$episode->link}}</td>
                        <td>{{$episode->datecreated}}</td>
                        <td>{{$episode->dateupdated}}</td>
                        <td>
                            @if ($episode->status)
                                hiển thị
                            @else
                                ẩn
                            @endif
                        </td>
                        <td class="manage-active">
                            {!! Form::open(['method'=>'DELETE', 'route'=>['episode.destroy', $episode->id], 'onsubmit' => 'return confirm("Bạn có muốn xóa không ?")',  'class'=>"d-inline-block"]) !!}
                                {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            <a href="{{route('episode.edit', $episode->id)}}" class="btn btn-warning">Sửa</a>
                        </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection