@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('movie.create')}}" class="btn btn-success mt-3 mb-3">Thêm Phim</a>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table align-middle" id="MovieTable">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Category</th>
                    <th scope="col">Country</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Hot</th>
                    <th scope="col">Year</th>
                    <th scope="col">Episode</th>
                    <th scope="col">Active/Inactive</th>
                    <th scope="col">Detail</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($list_movie as $index => $movie)
                        <tr>
                        <th scope="row">{{$index}}</th>
                        <td>{{$movie->title}}</td>
                        <td><img width="50%" src="{{asset('uploads/movie/'.$movie->image)}}" alt="#"></td>
                        <td>{{$movie->category->title}}</td>
                        <td>{{$movie->country->title}}</td>
                        <td>
                            @foreach ($movie->movie_genre as $genre)
                                <span class="badge bg-secondary">{{$genre->title}}</span>
                            @endforeach
                        </td>
                        <td>
                            @if ($movie->hot)
                                hot
                            @else
                                không hot
                            @endif
                        </td>
                        <td>
                            {!! Form::selectYear('year',2023, 1990, $movie->year != NULL ? $movie->year : 0, ['class' => 'select-year', 'id' => $movie->id]) !!}
                        </td>
                        <td>{{$movie->episode}}</td>
                        {{-- <td>{{$movie->dateupdated}}</td> --}}
                        <td>
                            @if ($movie->status)
                                hiển thị
                            @else
                                ẩn
                            @endif
                        </td>
                        <td>
                            <a href="{{route('movie.show', $movie->id)}}" class="btn btn-outline-info">Detail</a>
                        </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection