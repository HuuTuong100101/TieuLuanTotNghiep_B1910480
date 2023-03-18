@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Thêm tập phim</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if (!isset($episode))
                        {!! Form::open(['route'=>'episode.store','method'=>'POST']) !!}
                    @else
                        {!! Form::open(['route'=>['episode.update', $episode->id],'method'=>'PUT']) !!}
                    @endif
                            <div class="form-group">
                                @if (!isset($episode))
                                    {!! Form::label('movie', 'Movie', ['class'=>'mt-3']) !!}
                                    {!! Form::select('movie',['-1' => 'Chọn Phim','---phim---' => $movies], isset($episode) ? $episode->movie->id : '-1', ['class'=>'form-select select-movie']) !!}
                                @else
                                    {!! Form::label('movie', 'Movie', ['class'=>'mt-3']) !!}
                                    {!! Form::text('movie', $episode->movie->title, ['class'=>'form-control', 'disabled']) !!}
                                @endif 
                            </div>
                            <div class="form-group">
                                @if (!isset($episode))
                                    <label for="episode" class="mt-3">Chọn tập phim</label>
                                    <select name="episode" id="show_episode" class="form-select">

                                        {{--  --}}
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
                                {!! Form::label('status', 'Status', ['class'=>'mt-3']) !!}
                                {!! Form::select('status', ['1'=>'hiển thị', '0'=>'ẩn'], isset($episode) ? $episode->status : '1', ['class'=>'form-select']) !!}
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
