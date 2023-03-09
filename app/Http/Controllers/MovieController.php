<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_movie = Movie::with('category','genre','country')->get();
        $list_category = Category::pluck('title', 'id');
        $list_genre = Genre::pluck('title', 'id');
        $list_country = Country::pluck('title', 'id');
        return view('admin.movie.index', compact('list_movie', 'list_category', 'list_genre', 'list_country'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_category = Category::pluck('title', 'id');
        $list_genre = Genre::pluck('title', 'id');
        $list_country = Country::pluck('title', 'id');
        return view('admin.movie.form', compact('list_category','list_genre','list_country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->slug = $data['slug'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->genre_id = $data['genre_id'];
        $movie->country_id = $data['country_id'];
        $movie->hot = $data['phim_hot'];

        // Xử lý file hình ảnh
        $get_img = $request->file('image');
        $path = './uploads/movie/';
        if($get_img) {
            $get_name_img = $get_img->getClientOriginalName(); // Lấy ra tên ảnh
            $name_img = current(explode('.', $get_name_img)); // Lấy tên trước phần mở rộng
            $new_img = $name_img.rand(0,99999).'.'.$get_img->getClientOriginalExtension();
            $get_img->move($path,$new_img);
            $movie->image = $new_img;
            echo $new_img;
        }
        $movie->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movies = Movie::find($id);
        $list_movie = Movie::with('category','genre','country')->get();
        $list_category = Category::pluck('title', 'id');
        $list_genre = Genre::pluck('title', 'id');
        $list_country = Country::pluck('title', 'id');
        return view('admin.movie.form', compact('list_category','list_genre','list_country','movies','list_movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->slug = $data['slug'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->genre_id = $data['genre_id'];
        $movie->country_id = $data['country_id'];
        $movie->hot = $data['phim_hot'];

        // Xử lý file hình ảnh
        $get_img = $request->file('image');
        $path = '../public/uploads/movie/';
        if($get_img) {
            if(!empty($movie->image)) {
                unlink('../public/uploads/movie/'.$movie->image);
            }
            $get_name_img = $get_img->getClientOriginalName(); // Lấy ra tên ảnh
            $name_img = current(explode('.', $get_name_img)); // Lấy tên trước phần mở rộng
            $new_img = $name_img.rand(0,99999).'.'.$get_img->getClientOriginalExtension();
            $get_img->move($path,$new_img);
            $movie->image = $new_img;
        }
        $movie->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        if($movie) {
            unlink('../public/uploads/movie/'.$movie->image);
            $movie->delete();
            return redirect()->back();
        }
    }
}
