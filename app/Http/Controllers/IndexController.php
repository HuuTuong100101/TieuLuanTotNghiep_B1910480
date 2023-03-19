<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Episode;
use App\Models\Movie;
use App\Models\Movie_Genre;

class IndexController extends Controller
{
    public function search() {
        if(isset($_GET['search'])) {
            $search = $_GET['search'];
            $categories = Category::all()->where('status',1);
            $countries = Country::all()->where('status',1);
            $genres = Genre::all()->where('status',1);
            $search_movies = Movie::orderBy('dateupdated','DESC')->where('title', 'LIKE', '%'.$search.'%')->paginate(40);
            $hot_movies_sidebar = Movie::orderBy('dateupdated', 'DESC')->where('hot', 1)->take(20)->get();
            return view('pages.search', compact('categories', 'countries', 'genres', 'search_movies', 'hot_movies_sidebar', 'search'));
        } else {
            return redirect()->to('/');
        }
    }
    public function home() {
        $hot_movies = Movie::orderBy('dateupdated', 'DESC')->where('hot', 1)->get();
        $hot_movies_sidebar = Movie::orderBy('dateupdated', 'DESC')->where('hot', 1)->take(20)->get();
        $categories = Category::all()->where('status',1);
        $countries = Country::all()->where('status',1);
        $genres = Genre::all()->where('status',1);
        $movies_categories = Category::with('movie')->orderBy('id', 'DESC')->where('status', '1')->get();
        return view('pages.home', compact('categories', 'countries', 'genres', 'movies_categories', 'hot_movies', 'hot_movies_sidebar'));
    }
    public function movie($slug) {
        $categories = Category::all()->where('status',1);
        $countries = Country::all()->where('status',1);
        $genres = Genre::all()->where('status',1);
        $movie = Movie::with('category', 'genre', 'country', 'movie_genre')->where('slug',$slug)->where('status', 1)->first();
        $movie_related = Movie::with('category', 'genre', 'country')->where('category_id', $movie->category->id)->whereNotIn('slug', [$slug])->get();
        $hot_movies_sidebar = Movie::orderBy('dateupdated', 'DESC')->where('hot', 1)->take(20)->get();
        return view('pages.movie', compact('categories', 'countries', 'genres', 'movie', 'movie_related', 'hot_movies_sidebar'));
    }

    public function category($slug) {
        $categories = Category::all()->where('status',1);
        $countries = Country::all()->where('status',1);
        $genres = Genre::all()->where('status',1);
        // Lấy ra tên danh mục theo slug để hiển thị tên danh mục
        $category_slug = Category::where('slug',$slug)->first();
        $category_movies = Movie::orderBy('dateupdated','DESC')->where('category_id', $category_slug->id)->paginate(40);
        $hot_movies_sidebar = Movie::orderBy('dateupdated', 'DESC')->where('hot', 1)->take(20)->get();
        return view('pages.category', compact('categories', 'countries', 'genres', 'category_slug', 'category_movies', 'hot_movies_sidebar'));
    }

    public function country($slug) {
        $categories = Category::all()->where('status',1);
        $countries = Country::all()->where('status',1);
        $genres = Genre::all()->where('status',1);
        // Lấy ra tên quốc gia theo slug để hiển thị tên quốc gia
        $country_slug = Country::where('slug',$slug)->first();
        $country_movies = Movie::orderBy('dateupdated','DESC')->where('country_id', $country_slug->id)->paginate(40);
        $hot_movies_sidebar = Movie::orderBy('dateupdated', 'DESC')->where('hot', 1)->take(20)->get();
        return view('pages.country', compact('categories', 'countries', 'genres', 'country_slug', 'country_movies', 'hot_movies_sidebar'));
    }
    public function genre($slug) {
        $categories = Category::all()->where('status',1);
        $countries = Country::all()->where('status',1);
        $genres = Genre::all()->where('status',1);
        // Lấy ra tên thể loại theo slug để hiển thị tên thể loại
        $genre_slug = Genre::where('slug',$slug)->first();
        $movie_genres = Movie_Genre::where('genre_id', $genre_slug->id)->get();

        $movie_ids = [];
        foreach ($movie_genres as $movie_genre) {
            $movie_ids[] = $movie_genre->movie_id;
        }

        $genre_movies = Movie::orderBy('dateupdated','DESC')->whereIn('id', $movie_ids)->paginate(40);

        $hot_movies_sidebar = Movie::orderBy('dateupdated', 'DESC')->where('hot', 1)->take(20)->get();
        return view('pages.genre', compact('categories', 'countries', 'genres', 'genre_slug', 'genre_movies', 'hot_movies_sidebar'));
    }

    public function tags_phim($tag) {
        $categories = Category::all()->where('status',1);
        $countries = Country::all()->where('status',1);
        $genres = Genre::all()->where('status',1);
        
        $movies = Movie::where('tags','LIKE','%'.$tag.'%')->orderBy('dateupdated', 'DESC')->paginate(40);
        $hot_movies_sidebar = Movie::orderBy('dateupdated', 'DESC')->where('hot', 1)->take(20)->get();
        return view('pages.tags', compact('categories', 'countries', 'genres', 'movies', 'tag', 'hot_movies_sidebar'));
    }
    public function watch($slug) {
        $categories = Category::all()->where('status',1);
        $countries = Country::all()->where('status',1);
        $genres = Genre::all()->where('status',1);
        
        $hot_movies_sidebar = Movie::orderBy('dateupdated', 'DESC')->where('hot', 1)->take(20)->get();
        $movie = Movie::with('category', 'genre', 'country', 'movie_genre', 'episodes')->where('slug',$slug)->where('status', 1)->first();
        $movie_related = Movie::with('category', 'genre', 'country')->where('category_id', $movie->category->id)->whereNotIn('slug', [$slug])->get();

        // return response()->json($movie);
        return view('pages.watch',compact('categories', 'countries', 'genres', 'hot_movies_sidebar', 'movie', 'movie_related'));
    }

    public function espisode() {
        return view('pages.espisode');
    }
}

?>