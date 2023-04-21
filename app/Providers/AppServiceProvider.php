<?php

namespace App\Providers;
use App\Models\Rating;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;

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
        View::share(
                    [
                        'avg_rating' => $avg_rating, 
                        'categories' => $categories,
                        'countries' => $countries,
                        'genres' => $genres
                    ]
                );
    }
}
