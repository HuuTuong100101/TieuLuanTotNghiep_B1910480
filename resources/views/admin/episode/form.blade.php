@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="title-table-admin">
                    <h2>
                        Thêm tập phim
                    </h2>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if (!isset($episode))
                        {!! Form::open(['route'=>'episode.store','method'=>'POST', "autocomplete"=>"off"]) !!}
                    @else
                        {!! Form::open(['route'=>['episode.update', $episode->id],'method'=>'PUT', "autocomplete"=>"off"]) !!}
                    @endif
                            <div class="form-group">
                                @if (!isset($episode))
                                    {!! Form::label('movie', 'Movie', ['class'=>'mt-3']) !!}
                                    {!! Form::select('movie_id',['phim' => $movies, '' => '--Chọn phim--'],'', ['class'=>'form-select form-control select-movie']) !!}
                                @else
                                    {!! Form::label('movie', 'Movie', ['class'=>'mt-3']) !!}
                                    {!! Form::text('movie_id', $episode->movie->title, ['class'=>'form-control', 'disabled']) !!}
                                @endif 
                            </div>
                            <div class="form-group">
                                @if (!isset($episode))
                                    <label for="episode" class="mt-3">Chọn tập phim</label>
                                    <select name="episode" id="show_episode" class="form-select form-control selectpicker" data-live-search="true">

                                    </select>
                                @else 
                                    {!! Form::label('episode', 'episode', ['class'=>'mt-3']) !!}
                                    {!! Form::text('episode', $episode->episode, ['class'=>'form-control', 'disabled']) !!}
                                @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label('link', 'Link Phim', ['class'=>'mt-3']) !!}
                                {!! Form::text('link', isset($episode) ? $episode->link : '', ['class'=>'form-control', 'placeholder'=>'Nhập dữ liệu', 'onkeyup'=>'ChangeToSlug()']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('status', 'Trạng thái', ['class'=>'mt-3']) !!}
                                {!! Form::select('status', ['1'=>'hiển thị', '0'=>'ẩn'], isset($episode) ? $episode->status : '1', ['class'=>'form-control']) !!}
                            </div>
                            @if (!isset($episode))
                                {!! Form::submit('Thêm dữ liệu', ['class'=>'btn btn-success mt-3']) !!}
                            @else
                                {!! Form::submit('Cập nhật', ['class'=>'btn btn-success mt-3']) !!}
                            @endif
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
