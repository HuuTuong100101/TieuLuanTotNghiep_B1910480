<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Episode;
use Carbon\Carbon; // xử lý ngày
use Illuminate\Support\Facades\File;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_movie = Movie::with('category','movie_genre','country', 'episodes')->orderBy('id', 'DESC')->get();
        $list_category = Category::pluck('title', 'id');
        $list_genre = Genre::pluck('title', 'id');
        $list_country = Country::pluck('title', 'id');

        // Lưu vào file json để làm chức năng search
        $path = public_path().'\\json\\';
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        // echo($path); 
        File::put($path.'movie.json', json_encode($list_movie));
        
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
        $list_genre = Genre::all();
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
        $movie->trailer = $data['trailer'];
        $movie->tags = $data['tags'];
        $movie->lenght = $data['lenght'];
        $movie->episode = $data['episode'];
        if($data['year']) {
            $movie->year = $data['year'];
        } else {
            $movie->year = '2023';
        }
        $movie->quality = $data['quality'];
        $movie->subtitles = $data['subtitles'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->country_id = $data['country_id'];
        $movie->hot = $data['phim_hot'];
        $movie->datecreated = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->dateupdated = Carbon::now('Asia/Ho_Chi_Minh');

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

        // Thêm vào bảng movie_genre:
        $movie->movie_genre()->attach($data['genre']);
        return redirect()->to('/movie');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::with('category','genre','country')->find($id);
        return view('admin.movie.detail', compact('movie'));
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
        // $list_movie = Movie::with('category','genre','country')->get();
        $list_category = Category::pluck('title', 'id');
        $list_genre = Genre::all();
        $list_country = Country::pluck('title', 'id');
        $movie_genre = $movies->movie_genre;
        return view('admin.movie.form', compact('list_category','list_genre','list_country','movies', 'movie_genre'));
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
        $movie->trailer = $data['trailer'];
        $movie->tags = $data['tags'];
        $movie->year = $data['year'];
        $movie->lenght = $data['lenght'];
        $movie->episode = $data['episode'];
        $movie->quality = $data['quality'];
        $movie->subtitles = $data['subtitles'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->country_id = $data['country_id'];
        $movie->hot = $data['phim_hot'];
        $movie->dateupdated = Carbon::now('Asia/Ho_Chi_Minh');

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
        $movie->movie_genre()->sync($data['genre']);
        return redirect()->to('/movie');
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
            // return redirect(route('movie.index'));
        }

        // Movie_Genre::where('movie_id',$id)->delete();
        return redirect()->to(route('movie.index'));
    }

    public function update_year(Request $request) {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->year = $data['year'];
        $movie->save();
    }

    public function update_status(Request $request) {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->status = $data['status'];
        $movie->save();
    }

    public function update_category(Request $request) {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->category_id = $data['category'];
        $movie->save();
    }

    public function update_country(Request $request) {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->country_id = $data['country'];
        $movie->save();
    }
}
