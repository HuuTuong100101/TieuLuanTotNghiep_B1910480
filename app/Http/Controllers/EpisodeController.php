<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Episode;
use Carbon\Carbon; // xử lý ngày
use Facade\FlareClient\View;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $episodes = Episode::with('movie')->get();
        return view('admin.episode.index', compact('episodes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $episode = new Episode();
        $episode->movie_id = $data['movie'];
        $episode->episode = $data['episode'];
        $episode->link = $data['link'];
        $episode->status = $data['status'];
        $episode->datecreated = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->dateupdated = Carbon::now('Asia/Ho_Chi_Minh');

        $episode->save();
        return redirect()->to('/episode');
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
        $movies = Movie::pluck('title','id');
        $episode = Episode::with('movie')->where('status',1)->find($id);
        return view('admin.episode.form', compact('episode', 'movies'));
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
        $episode = Episode::find($id);
        $episode->link = $data['link'];
        $episode->status = $data['status'];
        $episode->dateupdated = Carbon::now('Asia/Ho_Chi_Minh');

        $episode->save();
        return redirect()->to('/episode');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $episode = Episode::find($id);
        $episode->delete();
        return redirect()->to('/episode');
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
            $output.='<option value="'.$arr_espisode.'">';
            // $output.= '<option value="'.$arr_espisode.'">'.$arr_espisode.'</option>';
        }
        echo $output;
    }
}
