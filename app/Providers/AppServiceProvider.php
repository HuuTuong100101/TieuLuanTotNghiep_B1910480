<?php

namespace App\Providers;
use App\Models\Rating;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\User;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\shetabit_visit;
use Carbon\Carbon; // xử lý ngày

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        $Movie_Genres = Movie_Genre::join('genres', 'genres.id', '=', 'Movie_Genre.genre_id')
            ->selectRaw('sum(genre_id) as SUM, genre_id, title')
            ->groupBy('genre_id', 'title')
            ->get();

        $data_genre_chart = "";
        foreach ($Movie_Genres as $val) {
            $data_genre_chart.="['".$val->title."',".$val->SUM."],";
        };

        $View_Genres = Movie_Genre::join('movies', 'movies.id', '=', 'Movie_Genre.movie_id')
            ->join('genres', 'genres.id', '=', 'Movie_Genre.genre_id')
            ->selectRaw('sum(views) as SUM, genre_id, genres.title')
            ->groupBy('genre_id', 'genres.title')
            ->orderBy('SUM', 'DESC')
            ->take(5)
            ->get();

        $data_genre_views_chart = "";
        foreach ($View_Genres as $val) {
            $data_genre_views_chart.="['".$val->title."',".$val->SUM."],";
        };

        $avg_rating = Rating::selectRaw('round(avg(rating)) as AVG_RATING, movie_id')
            ->groupBy('movie_id')
            ->get();

        $days30 = Carbon::today()->subDays(30);
        $data = shetabit_visit::whereDate('created_at', '>=', $days30)
                            ->selectRaw('COUNT(created_at) as count, DATE(created_at) as date')
                            ->groupBy('date')
                            ->get();

        $data30days = shetabit_visit::whereDate('created_at', '>=', $days30)
                            ->get()
                            ->count();

        $days7 = Carbon::today()->subDays(7);
        $data7days = shetabit_visit::whereDate('created_at', '>=', $days7)
                            ->get()
                            ->count();

        $today = Carbon::today();
        $datatoday = shetabit_visit::whereDate('created_at', '=', $today)
                            ->get()
                            ->count();
        $data_visit_chart = "";
        foreach ($data as $val) {
            $data_visit_chart.="['".$val->date."',".$val->count.",'#b87333'"."],";
        };

        $categories = Category::all()->where('status',1);
        $countries = Country::all()->where('status',1);
        $genres = Genre::all()->where('status',1);
        $total_User = User::all()->count();
        $total_Country = Country::all()->count();
        $total_Category = Category::all()->count();
        $total_Movie = Movie::all()->count();
        $total_Genre = Genre::all()->count();
        $hot_movies_sidebar = Movie::orderBy('views', 'DESC')->take(10)->get();
        View::share(
                    [
                        'avg_rating' => $avg_rating, 
                        'categories' => $categories,
                        'countries' => $countries,
                        'genres' => $genres,
                        'total_User' => $total_User,
                        'total_Country' => $total_Country,
                        'total_Category' => $total_Category,
                        'total_Movie' => $total_Movie,
                        'total_Genre' => $total_Genre,
                        'data_genre_chart' => $data_genre_chart,
                        'Movie_Genres' => $Movie_Genres,
                        'data_genre_views_chart' => $data_genre_views_chart,
                        'data30days' => $data30days,
                        'data7days' => $data7days,
                        'datatoday' =>$datatoday,
                        'data_visit_chart' => $data_visit_chart,
                        'hot_movies_sidebar' => $hot_movies_sidebar
                    ]
                );
    }
}
