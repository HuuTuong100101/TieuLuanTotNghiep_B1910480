<?php

namespace App\Providers;
use App\Models\Rating;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\User;
use App\Models\Movie;
use App\Models\Movie_Genre;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
    public function boot()
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
            ->get();

        $data_genre_views_chart = "";
        foreach ($View_Genres as $val) {
            $data_genre_views_chart.="['".$val->title."',".$val->SUM."],";
        };

        $avg_rating = Rating::selectRaw('round(avg(rating)) as AVG_RATING, movie_id')
            ->groupBy('movie_id')
            ->get();

        $categories = Category::all()->where('status',1);
        $countries = Country::all()->where('status',1);
        $genres = Genre::all()->where('status',1);
        $total_User = User::all()->count();
        $total_Country = Country::all()->count();
        $total_Category = Category::all()->count();
        $total_Movie = Movie::all()->count();
        $total_Genre = Genre::all()->count();
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
                        'data_genre_views_chart' => $data_genre_views_chart
                    ]
                );
    }
}
