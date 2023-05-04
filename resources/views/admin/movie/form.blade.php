@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="title-table-admin">
                    <h2>
                        Thêm phim
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
                    
                    @if (!isset($movies))
                        {!! Form::open(['route'=>'movie.store','method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                    @else
                        {!! Form::open(['route'=>['movie.update', $movies->id],'method'=>'PUT', 'enctype'=>'multipart/form-data']) !!}
                    @endif
                            <div class="form-group">
                                {!! Form::label('title', 'Tên phim', []) !!}
                                {!! Form::text('title', isset($movies) ? $movies->title : '', ['class'=>'form-control', 'placeholder'=>'Nhập dữ liệu', 'onkeyup'=>'ChangeToSlug()']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('slug', 'Slug', ['class'=>'mt-3']) !!}
                                {!! Form::text('slug', isset($movies) ? $movies->slug : '', ['class'=>'form-control', 'placeholder'=>'Dữ liệu tự động điền, không cần nhập ở đây', 'id'=>'slug', 'type'=>'hidden']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', 'Mô tả', ['class'=>'mt-3']) !!}
                                {!! Form::textarea('description', isset($movies) ? $movies->description : '', ['style'=>'resize:none','class'=>'form-control', 'placeholder'=>'Nhập dữ liệu']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('tags', 'Tags phim', ['class'=>'mt-3']) !!}
                                {!! Form::textarea('tags', isset($movies) ? $movies->tags : '', ['style'=>'resize:none','class'=>'form-control', 'placeholder'=>'Nhập dữ liệu']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('trailer', 'Trailer phim', ['class'=>'mt-3']) !!}
                                {!! Form::text('trailer', isset($movies) ? $movies->trailer : '', ['class'=>'form-control', 'placeholder'=>'Nhập dữ liệu']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('lenght', 'Thời lượng phim (Phút)', ['class'=>'mt-3']) !!}
                                {!! Form::text('lenght', isset($movies) ? $movies->lenght : '', ['class'=>'form-control', 'placeholder'=>'Nhập dữ liệu']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('episode', 'Số tập phim', ['class'=>'mt-3']) !!}
                                {!! Form::text('episode', isset($movies) ? $movies->episode : '', ['class'=>'form-control', 'placeholder'=>'Nhập dữ liệu']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('status', 'Trạng thái', ['class'=>'mt-3']) !!}
                                {!! Form::select('status', ['1'=>'hiển thị', '0'=>'ẩn'], isset($movies) ? $movies->status : '1', ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('quality', 'Chất lượng phim', ['class'=>'mt-3']) !!}
                                {!! Form::select('quality', ['1'=>'HD', '0'=>'SD', '2'=>'Full HD'], isset($movies) ? $movies->quality : '1', ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('year', 'Năm phát hành', ['class'=>'mt-3']) !!}
                                {!! Form::selectYear('year', 2023, 2000, isset($movies) ? $movies->year : '2023', ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('subtitles', 'Subtitles', ['class'=>'mt-3']) !!}
                                {!! Form::select('subtitles', ['1'=>'Vietsub', '0'=>'Lồng tiếng', '2'=>'Engsub', '3'=>'Thuyết minh'], isset($movies) ? $movies->subtitles : '1', ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('category', 'Danh mục', ['class'=>'mt-3']) !!}
                                {!! Form::select('category_id', $list_category, isset($movies) ? $movies->category_id : '1', ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('country', 'Quốc gia', ['class'=>'mt-3']) !!}
                                {!! Form::select('country_id', $list_country, isset($movies) ? $movies->country_id : '1', ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('genre', 'Thể loại', ['class'=>'mt-3']) !!} <br>
                                @foreach ($list_genre as $key => $genre)
                                    @if (isset($movies))
                                        {!! Form::checkbox('genre[]', $genre->id, (isset($movie_genre) && $movie_genre->contains($genre->id)) ? true : false) !!}
                                    @else
                                        {!! Form::checkbox('genre[]', $genre->id, '') !!}
                                    @endif
                                    {!! Form::label('genre', $genre->title, ['class'=>'me-3']) !!}
                                @endforeach
                            </div>
                            <div class="form-group">
                                {!! Form::label('Image', 'Hình ảnh', ['class'=>'mt-3']) !!}
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
