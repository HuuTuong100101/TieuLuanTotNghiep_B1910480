<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
// use App\Models\Movie_Genre;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
// use App\Models\Episode;
use Carbon\Carbon; // xử lý ngày
use Illuminate\Support\Facades\File;
use Exception;
class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
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
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'title' => 'required|unique:movies',
                'slug' => 'required|unique:movies',
                'description' => 'required|unique:movies',
                'tags' => 'required|unique:movies',
                'year' => 'required',
                'lenght' => 'required|numeric',
                'episode' => 'required|numeric',
                'quality' => 'required',
                'subtitles' => 'required',
                'category_id' => 'required',
                'country_id' => 'required',
                'status' => 'required',
                'genre' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp'
            ],

            [
                'title.required' => 'Tên phim không được bỏ trống',
                'title.unique' => 'Tên phim đã tồn tại',
                'slug.required' => 'Slug phim không được bỏ trống',
                'slug.unique' => 'Slug phim đã tồn tại',
                'description.required' => 'Mô tả phim không được bỏ trống',
                'description.unique' => 'Mô tả phim đã tồn tại',
                'tags.required' => 'tags phim không được bỏ trống',
                'tags.unique' => 'tags phim đã tồn tại',
                'lenght.required' => 'Thời lượng phim không được bỏ trống',
                'quality.required' => 'Chất lượng phim lượng phim không được bỏ trống',
                'subtitles.required' => 'Ngôn ngữ trong phim không được bỏ trống',
                'category_id.required' => 'Danh mục phim không được bỏ trống',
                'country_id.required' => 'Quốc gia sản xuất phim không được bỏ trống',
                'year.required' => 'Năm sản xuất phim không được bỏ trống',
                'genre.required' => 'Thể loại phim không được bỏ trống',
                'episode.required' => 'Số tập phim không được bỏ trống',
                'image.required' => 'Bạn chưa chọn hình ảnh',
                'image.mimes' => 'File hình ảnh không đúng định dạng',
                'episode.numeric' => 'Số tập phim phải là số nguyên',
                'lenght.numeric' => 'Thời lượng phim phải là số nguyên'
            ]
        );

        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->slug = $data['slug'];
        $movie->description = $data['description'];
        if(isset($data['trailer'])) {
            $movie->trailer = $data['trailer'];
        }
        $movie->tags = $data['tags'];
        $movie->views = 0;
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
        try {
            $movie->save();
            // Thêm vào bảng movie_genre:
            $movie->movie_genre()->attach($data['genre']);
            return redirect()->back()->with('success', 'Thêm phim thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Thêm phim không thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'title' => 'required',
                'slug' => 'required',
                'description' => 'required',
                'tags' => 'required',
                'year' => 'required',
                'lenght' => 'required|numeric',
                'episode' => 'required|numeric',
                'quality' => 'required',
                'subtitles' => 'required',
                'category_id' => 'required',
                'country_id' => 'required',
                'status' => 'required',
                'genre' => 'required',
                'image' => ''
            ],

            [
                'title.required' => 'Tên phim không được bỏ trống',
                'slug.required' => 'Slug phim không được bỏ trống',
                'description.required' => 'Mô tả phim không được bỏ trống',
                'tags.required' => 'tags phim không được bỏ trống',
                'lenght.required' => 'Thời lượng phim không được bỏ trống',
                'quality.required' => 'Chất lượng phim lượng phim không được bỏ trống',
                'subtitles.required' => 'Ngôn ngữ trong phim không được bỏ trống',
                'category_id.required' => 'Danh mục phim không được bỏ trống',
                'country_id.required' => 'Quốc gia sản xuất phim không được bỏ trống',
                'year.required' => 'Năm sản xuất phim không được bỏ trống',
                'genre.required' => 'Thể loại phim không được bỏ trống',
                'episode.required' => 'Số tập phim không được bỏ trống',
                'episode.numeric' => 'Số tập phim phải là số nguyên',
                'lenght.numeric' => 'thời lượng phim phải là số nguyên'
            ]
        );

        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->slug = $data['slug'];
        $movie->description = $data['description'];
        if(isset($data['trailer'])) {
            $movie->trailer = $data['trailer'];
        }
        $movie->tags = $data['tags'];
        $movie->year = $data['year'];
        $movie->lenght = $data['lenght'];
        $movie->episode = $data['episode'];
        $movie->quality = $data['quality'];
        $movie->subtitles = $data['subtitles'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->country_id = $data['country_id'];
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
        try {
            $movie->save();
            $movie->movie_genre()->sync($data['genre']);
            return redirect()->back()->with('success', 'Cập nhật phim thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật phim không thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        try {
            $movie = Movie::find($id);
            if($movie) {
                unlink('../public/uploads/movie/'.$movie->image);
                $movie->delete();
            }
            return redirect()->to('/movie')->with('success', 'Xóa phim thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Xóa phim không thành công');
        }
    }

    public function update_year(Request $request) {
        try {
            $data = $request->all();
            $movie = Movie::find($data['id_phim']);
            $movie->year = $data['year'];
            $movie->save();
            return redirect()->back()->with('success', 'Cập nhật năm phim thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật năm phim không thành công');
        }
    }

    public function update_status(Request $request) {
        try {
            $data = $request->all();
            $movie = Movie::find($data['id_phim']);
            $movie->status = $data['status'];
            $movie->save();
            return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật trạng thái không thành công');
        }
    }

    public function update_category(Request $request) {
        try {
            $data = $request->all();
            $movie = Movie::find($data['id_phim']);
            $movie->category_id = $data['category'];
            $movie->save();
            return redirect()->back()->with('success', 'Cập nhật danh mục thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật danh mục không thành công');
        }
    }

    public function update_country(Request $request) {
        try {
            $data = $request->all();
            $movie = Movie::find($data['id_phim']);
            $movie->country_id = $data['country'];
            $movie->save();
            return redirect()->back()->with('success', 'Cập nhật quốc gia thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật quốc gia không thành công');
        }
    }

    public function update_image_movie(Request $request) {
        try {
            $get_img = $request->file('file');
            $id_phim = $request->id_phim;
            $movie = Movie::find($id_phim);
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
            return redirect()->back()->with('success', 'Cập nhật hình ảnh thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật hình ảnh không thành công');
        }
    }
}
