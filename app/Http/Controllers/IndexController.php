<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Episode;
use App\Models\Movie;
use App\Models\Rating;
use App\Models\Movie_Genre;

class IndexController extends Controller
{

    // Trang lọc phim

    public function filter(Request $request) {
        $request->visitor()->visit();
        $data = $request->all();

        $category_data = $data['category'];
        $genre_data = $data['genre'];
        $country_data = $data['country'];
        $year_data = $data['year'];

        
        
        if ($category_data == '' && $country_data == '' && $genre_data == '' && $year_data == '') {
            return redirect()->to('/');
        } elseif ($category_data == '' && $country_data == '' && $genre_data == '') {
            $movies = Movie::with('episodes')
                            ->orderBy('dateupdated', 'DESC')
                            ->where('year', $year_data)
                            ->paginate(40);;
            return view('pages.filter', compact('movies'));
        } elseif ($country_data == '' && $genre_data == '' && $year_data == '') {
            $movies = Movie::with('episodes')
                            ->orderBy('dateupdated', 'DESC')
                            ->where('category_id', $category_data)
                            ->paginate(40);;
            return view('pages.filter', compact('movies'));
        } elseif ($category_data == '' && $country_data == '' && $year_data == '') {
            $movies = Movie::with('episodes')
                            ->join('movie_genre', 'movies.id', '=', 'movie_genre.movie_id')
                            ->where('genre_id', $genre_data)
                            ->paginate(40);;
            return view('pages.filter', compact('movies'));
        } elseif($category_data == '' && $genre_data == '' && $year_data == '') {
            $movies = Movie::with('episodes')
                            ->orderBy('dateupdated', 'DESC')
                            ->where('country_id', $country_data)
                            ->paginate(40);;
            return view('pages.filter', compact('movies'));
        } elseif ($category_data == '' && $country_data == '') {
            $movies = Movie::with('episodes')
                            ->join('movie_genre', 'movies.id', '=', 'movie_genre.movie_id')
                            ->orderBy('dateupdated', 'DESC')
                            ->where('genre_id', $genre_data)
                            ->where('year', $year_data)
                            ->paginate(40);;
            return view('pages.filter', compact('movies'));
        } elseif ($category_data == '' && $genre_data == '') {
            $movies = Movie::with('episodes')
                            ->orderBy('dateupdated', 'DESC')
                            ->where('country_id', $country_data)
                            ->where('year', $year_data)
                            ->paginate(40);;
            return view('pages.filter', compact('movies'));
        } elseif ($category_data == '' && $year_data == '') {
            $movies = Movie::with('episodes')
                            ->join('movie_genre', 'movies.id', '=', 'movie_genre.movie_id')
                            ->orderBy('dateupdated', 'DESC')
                            ->where('genre_id', $genre_data)
                            ->where('country_id', $country_data)
                            ->paginate(40);;
            return view('pages.filter', compact('movies'));
        } elseif ($country_data == '' && $genre_data == '') {
            $movies = Movie::with('episodes')
                            ->orderBy('dateupdated', 'DESC')
                            ->where('category_id', $category_data)
                            ->where('year', $year_data)
                            ->paginate(40);;
            return view('pages.filter', compact('movies'));
        } elseif ($country_data == '' && $year_data == '') {
            $movies = Movie::with('episodes')
                            ->join('movie_genre', 'movies.id', '=', 'movie_genre.movie_id')
                            ->orderBy('dateupdated', 'DESC')
                            ->where('genre_id', $genre_data)
                            ->where('category_id', $category_data)
                            ->paginate(40);;
            return view('pages.filter', compact('movies'));
        } elseif ($genre_data == '' && $year_data == '') {
            $movies = Movie::with('episodes')
                            ->orderBy('dateupdated', 'DESC')
                            ->where('category_id', $category_data)
                            ->where('country_id', $country_data)
                            ->paginate(40);;
            return view('pages.filter', compact('movies'));
        } elseif ($category_data == '') {
            $movies = Movie::with('episodes')
                            ->join('movie_genre', 'movies.id', '=', 'movie_genre.movie_id')
                            ->orderBy('dateupdated', 'DESC')
                            ->where('genre_id', $genre_data)
                            ->where('country_id', $country_data)
                            ->where('year', $year_data)
                            ->paginate(40);;
            return view('pages.filter', compact('movies'));
        } elseif ($country_data == '') {
            $movies = Movie::with('episodes')
                            ->join('movie_genre', 'movies.id', '=', 'movie_genre.movie_id')
                            ->orderBy('dateupdated', 'DESC')
                            ->where('genre_id', $genre_data)
                            ->where('category_id', $category_data)
                            ->where('year', $year_data)
                            ->paginate(40);;
            return view('pages.filter', compact('movies'));
        } elseif ($year_data == '') {
            $movies = Movie::with('episodes')
                            ->join('movie_genre', 'movies.id', '=', 'movie_genre.movie_id')
                            ->orderBy('dateupdated', 'DESC')
                            ->where('genre_id', $genre_data)
                            ->where('category_id', $category_data)
                            ->where('country_id', $country_data)
                            ->paginate(40);;
            return view('pages.filter', compact('movies'));
        } elseif ($genre_data == '') {
            $movies = Movie::with('episodes')
                            ->orderBy('dateupdated', 'DESC')
                            ->where('category_id', $category_data)
                            ->where('year', $year_data)
                            ->where('country_id', $country_data)
                            ->paginate(40);;
            return view('pages.filter', compact('movies'));
        } else {
            $movies = Movie::with('episodes')
                            ->join('movie_genre', 'movies.id', '=', 'movie_genre.movie_id')
                            ->orderBy('dateupdated', 'DESC')
                            ->where('genre_id', $genre_data)
                            ->where('category_id', $category_data)
                            ->where('country_id', $country_data)
                            ->where('year', $year_data)
                            ->paginate(40);;
            return view('pages.filter', compact('movies'));
        }
    }
    // Trang search
    public function search(Request $request) {
        $request->visitor()->visit();
        if(isset($_GET['search'])) {
            $search = $_GET['search'];
            $search_movies = Movie::orderBy('dateupdated','DESC')->where('title', 'LIKE', '%'.$search.'%')->paginate(40);

            return view('pages.search', compact('search_movies', 'search'));
        } else {
            return redirect()->to('/');
        }
    }
    // Trang home
    public function home(Request $request) {
        $request->visitor()->visit();
        $movies_categories = Category::with('movie')->orderBy('id', 'DESC')->where('status', '1')->get();
        return view('pages.home', compact('movies_categories'));
    }

    // Trang chi tiết phim
    public function movie($slug, Request $request) {
        $request->visitor()->visit();
        $movie = Movie::with('category', 'genre', 'country', 'movie_genre')->where('slug',$slug)->where('status', 1)->first();
        $new_episode = Episode::where('movie_id', $movie->id)->orderBy('id', 'DESC')->take(3)->get();
        $movie_related = Movie::with('category', 'genre', 'country')->where('category_id', $movie->category->id)->whereNotIn('slug', [$slug])->get();
        $all_episode = Episode::where('movie_id', $movie->id)->get()->count();

        $rating = Rating::where('movie_id', $movie->id)->avg('rating');
        $rating = round($rating);
        $sum_rating = Rating::where('movie_id', $movie->id)->count();

        $movie->views += 1;
        $movie->save();
        return view('pages.movie', compact('movie', 'movie_related', 'new_episode', 'all_episode', 'rating', 'sum_rating'));
    }

    // Trang danh mục
    public function category($slug, Request $request) {
        $request->visitor()->visit();
        // Lấy ra tên danh mục theo slug để hiển thị tên danh mục
        $category_slug = Category::where('slug',$slug)->first();
        $category_movies = Movie::orderBy('dateupdated','DESC')->where('category_id', $category_slug->id)->paginate(40);
        return view('pages.category', compact('category_slug', 'category_movies'));
    }

    // Trang phim theo quốc gia
    public function country($slug, Request $request) {
        $request->visitor()->visit();
        // Lấy ra tên quốc gia theo slug để hiển thị tên quốc gia
        $country_slug = Country::where('slug',$slug)->first();
        $country_movies = Movie::orderBy('dateupdated','DESC')->where('country_id', $country_slug->id)->paginate(40);
        return view('pages.country', compact('country_slug', 'country_movies'));
    }

    // Trang phim theo thể loại
    public function genre($slug, Request $request) {
        $request->visitor()->visit();
        // Lấy ra tên thể loại theo slug để hiển thị tên thể loại
        $genre_slug = Genre::where('slug',$slug)->first();
        $movie_genres = Movie_Genre::where('genre_id', $genre_slug->id)->get();

        $movie_ids = [];
        foreach ($movie_genres as $movie_genre) {
            $movie_ids[] = $movie_genre->movie_id;
        }

        $genre_movies = Movie::orderBy('dateupdated','DESC')->whereIn('id', $movie_ids)->paginate(40);

        return view('pages.genre', compact('genre_slug', 'genre_movies'));
    }

    // Trang phim theo tag
    public function tags_phim($tag, Request $request) {
        $request->visitor()->visit();
        $movies = Movie::where('tags','LIKE','%'.$tag.'%')->orderBy('dateupdated', 'DESC')->paginate(40);
        return view('pages.tags', compact('movies', 'tag'));
    }

    // Trang xem phim
    public function watch($slug, $number_episode, Request $request) {
        $request->visitor()->visit();
        $movie = Movie::with('category', 'genre', 'country', 'movie_genre', 'episodes')->where('slug',$slug)->where('status', 1)->first();
        $movie_related = Movie::with('category', 'genre', 'country')->where('category_id', $movie->category->id)->whereNotIn('slug', [$slug])->get();

        // return response()->json($movie);
        return view('pages.watch',compact('movie', 'movie_related', 'number_episode'));
    }

    // Trang phim mới
    public function new(Request $request) {
        $request->visitor()->visit();
        $new_movies = Movie::orderBy('dateupdated', 'DESC')->paginate(40);
        return view('pages.new', compact('new_movies'));
    }

    // Trang phim theo subtitle (thuyết minh/ lồng tiếng)
    public function subtitle($sub, Request $request) {
        $request->visitor()->visit();
        $sub_movies = Movie::orderBy('dateupdated', 'DESC')->where('subtitles', $sub)->paginate(40);
        return view('pages.sub', compact('sub_movies', 'sub'));
    }

    public function year($year, Request $request) {
        $request->visitor()->visit();
        $year_movies = Movie::orderBy('dateupdated', 'DESC')->where('year', $year)->paginate(40);
        return view('pages.year', compact('year_movies', 'year'));
    }

    public function add_rating(Request $request) {
        $request->visitor()->visit();
        $data = $request->all();
        $ip_address = $request->ip();
        $rating_count = Rating::where('movie_id', $data['movie_id'])->where('ip_address', $ip_address)->count();
        if($rating_count > 0) {
            echo 'exist';
        } else {
            $rating = new Rating();
            $rating->movie_id = $data['movie_id'];
            $rating->rating = $data['index'];
            $rating->ip_address = $ip_address;
            $rating->save();
            echo 'done';
        }
    }
}

?>