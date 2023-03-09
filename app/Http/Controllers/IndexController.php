<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Espisode;
use App\Models\Movie;
use DB;

class IndexController extends Controller
{
    public function home() {
        $hot_movies = Movie::all()->where('hot', 1);
        $categories = Category::all()->where('status',1);
        $countries = Country::all()->where('status',1);
        $genres = Genre::all()->where('status',1);
        $movies_categories = Category::with('movie')->orderBy('id', 'DESC')->where('status', '1')->get();
        return view('pages.home', compact('categories', 'countries', 'genres', 'movies_categories', 'hot_movies'));
    }
    public function movie($slug) {
        $categories = Category::all()->where('status',1);
        $countries = Country::all()->where('status',1);
        $genres = Genre::all()->where('status',1);
        $movie = Movie::with('category', 'genre', 'country')->where('slug',$slug)->where('status', 1)->first();
        $movie_related = Movie::with('category', 'genre', 'country')->where('genre_id', $movie->genre->id)->whereNotIn('slug', [$slug])->get();
        return view('pages.movie', compact('categories', 'countries', 'genres', 'movie', 'movie_related'));
    }

    public function category($slug) {
        $categories = Category::all()->where('status',1);
        $countries = Country::all()->where('status',1);
        $genres = Genre::all()->where('status',1);
        // Lấy ra tên danh mục theo slug để hiển thị tên danh mục
        $category_slug = Category::where('slug',$slug)->first();
        $category_movies = Movie::where('category_id', $category_slug->id)->paginate(40);
        return view('pages.category', compact('categories', 'countries', 'genres', 'category_slug', 'category_movies'));
    }

    public function country($slug) {
        $categories = Category::all()->where('status',1);
        $countries = Country::all()->where('status',1);
        $genres = Genre::all()->where('status',1);
        // Lấy ra tên quốc gia theo slug để hiển thị tên quốc gia
        $country_slug = Country::where('slug',$slug)->first();
        $country_movies = Movie::where('country_id', $country_slug->id)->paginate(40);
        return view('pages.country', compact('categories', 'countries', 'genres', 'country_slug', 'country_movies'));
    }
    public function genre($slug) {
        $categories = Category::all()->where('status',1);
        $countries = Country::all()->where('status',1);
        $genres = Genre::all()->where('status',1);
        // Lấy ra tên thể loại theo slug để hiển thị tên thể loại
        $genre_slug = Genre::where('slug',$slug)->first();
        $genre_movies = Movie::where('genre_id', $genre_slug->id)->paginate(40);
        return view('pages.genre', compact('categories', 'countries', 'genres', 'genre_slug', 'genre_movies'));
    }
    public function watch() {
        return view('pages.watch');
    }

    public function espisode() {
        return view('pages.espisode');
    }
}

?>