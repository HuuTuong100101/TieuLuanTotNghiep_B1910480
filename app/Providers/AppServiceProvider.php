<?php

namespace App\Providers;
use App\Models\Rating;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\User;
use App\Models\Movie;

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
                        'total_Genre' => $total_Genre
                    ]
                );
    }
}
