@extends('layouts.app')

@section('content')
<div class="container">
    <div class="title-table-admin">
        <h2>
            Quản lý tài khoản quản trị
        </h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table" id="CategoryTable">
                <thead>
                  <tr>
                    <th scope="col">Index</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Ngày cập nhật</th>
                    <th scope="col" style="width:105px;">Manage</th>
                  </tr>
                </thead>
                <tbody class="order_id">
                    @foreach ($users as $index => $user)
                        <tr id="{{$user->id}}">
                        <th scope="row">{{$index}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>{{$user->updated_at}}</td>
                        <td class="manage-active">
                            {!! Form::open(['method'=>'DELETE', 'route'=>['user.destroy', $user->id], 'onsubmit' => 'return confirm("Bạn có muốn xóa không ?")', 'class'=>' d-inline-block']) !!}
                                {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
