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
                                {!! Form::label('tags', 'Tags phim', ['class'=>'mt-3']) !!}
                                {!! Form::textarea('tags', isset($movies) ? $movies->tags : '', ['style'=>'resize:none','class'=>'form-control', 'placeholder'=>'Nhập dữ liệu']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('lenght', 'Lenght (Phút)', ['class'=>'mt-3']) !!}
                                {!! Form::text('lenght', isset($movies) ? $movies->lenght : '', ['class'=>'form-control', 'placeholder'=>'Nhập dữ liệu (.../Phút)']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('status', 'Status', ['class'=>'mt-3']) !!}
                                {!! Form::select('status', ['1'=>'hiển thị', '0'=>'ẩn'], isset($movies) ? $movies->status : '1', ['class'=>'form-select']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('quality', 'Quality', ['class'=>'mt-3']) !!}
                                {!! Form::select('quality', ['1'=>'HD', '0'=>'SD', '2'=>'Full HD'], isset($movies) ? $movies->quality : '1', ['class'=>'form-select']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('subtitles', 'Subtitles', ['class'=>'mt-3']) !!}
                                {!! Form::select('subtitles', ['1'=>'Vietsub', '0'=>'Lồng tiếng', '2'=>'Endsub'], isset($movies) ? $movies->subtitles : '1', ['class'=>'form-select']) !!}
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
                                {!! Form::label('Phim Hot', 'Phim Hot', ['class'=>'mt-3']) !!}
                                {!! Form::select('phim_hot', ['1'=>'hot', '0'=>'không hot'], isset($movies) ? $movies->hot : '1', ['class'=>'form-select']) !!}
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
        </div>
    </div>
</div>
@endsection
