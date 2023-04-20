<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Episode;
use Carbon\Carbon; // xử lý ngày
use Exception;

use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $episodes = Episode::with('movie')->get();
        return view('admin.episode.index', compact('episodes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $movies = Movie::pluck('title','id');
        return view('admin.episode.form', compact('movies'));
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
                'movie_id' => 'required|unique:episodes|max:255',
                'episode' => 'required|numeric',
                'link' => 'required|unique:episodes|max:255',
                'status' => 'required',
            ],

            [
                'movie_id.required' => 'Bạn chưa chọn phim',
                'movie_id.unique' => 'id phim đã tồn tại',
                'episode.required' => 'Tập phim không được bỏ trống',
                'episode.numeric' => 'Tập phim phải là số',
                'link.required' => 'Link tập phim không được bỏ trống',
                'link.unique' => 'Link tập phim đã tồn tại',
            ]
        );

        $episode = new Episode();
        $episode->movie_id = $data['movie'];
        $episode->episode = $data['episode'];
        $episode->link = $data['link'];
        $episode->status = $data['status'];
        $episode->datecreated = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->dateupdated = Carbon::now('Asia/Ho_Chi_Minh');
        try {
            $episode->save();
            return redirect()->back()->with('success', 'Thêm tập phim thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Thêm tập phim không thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $movies = Movie::pluck('title','id');
        $episode = Episode::with('movie')->where('status',1)->find($id);
        return view('admin.episode.form', compact('episode', 'movies'));
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
                'link' => 'required|unique:episodes|max:255',
                'status' => 'required',
            ],

            [
                'link.required' => 'Link tập phim không được bỏ trống',
                'link.unique' => 'Link tập phim đã tồn tại',
            ]
        );
        $episode = Episode::find($id);
        $episode->link = $data['link'];
        $episode->status = $data['status'];
        $episode->dateupdated = Carbon::now('Asia/Ho_Chi_Minh');
        try {
            $episode->save();
            return redirect()->back()->with('success', 'Cập nhật tập phim thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật tập phim không thành công');
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
            $episode = Episode::find($id);
            $episode->delete();
            return redirect()->back()->with('success', 'Xóa tập phim thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Xóa tập phim không thành công');
        }
    }

    public function select_movie(){
        $id = $_GET['id'];
        $movie = Movie::find($id);
        $episodes = Episode::where('movie_id', $id)->orderBy('episode', 'DESC')->get();
        
        $arr_espisodes = [];
        for($i=1; $i<=$movie->episode; $i++) {
            array_push($arr_espisodes,$i);
        }

        foreach($arr_espisodes as $key => $arr_episode) {
            foreach($episodes as $episode) { 
                if($arr_espisodes[$key] == $episode->episode) {
                    unset($arr_espisodes[$key]);
                    break;
                }
            }
        }

        $output = '<option value="">--- Danh sách tập phim chưa có link phim ---</option>';
        foreach($arr_espisodes as $arr_espisode) {
            // $output.='<option value="'.$arr_espisode.'">';
            $output.= '<option value="'.$arr_espisode.'">'.$arr_espisode.'</option>';
        }
        echo $output;
    }

}
