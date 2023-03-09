<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Espisode;
use App\Models\Movie;

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
    public function movie() {
        return view('pages.movie');
    }

    public function category($slug) {
        $categories = Category::all()->where('status',1);
        $countries = Country::all()->where('status',1);
        $genres = Genre::all()->where('status',1);
        // Lấy ra tên danh mục theo slug để hiển thị tên danh mục
        $category_slug = Category::where('slug',$slug)->first();
        return view('pages.category', compact('categories', 'countries', 'genres', 'category_slug'));
    }

    public function country($slug) {
        $categories = Category::all()->where('status',1);
        $countries = Country::all()->where('status',1);
        $genres = Genre::all()->where('status',1);
        // Lấy ra tên quốc gia theo slug để hiển thị tên quốc gia
        $country_slug = Country::where('slug',$slug)->first();
        return view('pages.country', compact('categories', 'countries', 'genres', 'country_slug'));
    }
    public function genre($slug) {
        $categories = Category::all()->where('status',1);
        $countries = Country::all()->where('status',1);
        $genres = Genre::all()->where('status',1);
        // Lấy ra tên thể loại theo slug để hiển thị tên thể loại
        $genre_slug = Genre::where('slug',$slug)->first();
        return view('pages.genre', compact('categories', 'countries', 'genres', 'genre_slug'));
    }
    public function watch() {
        return view('pages.watch');
    }

    public function espisode() {
        return view('pages.espisode');
    }
}
