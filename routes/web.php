<?php

    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Auth;
    use App\Http\Controllers\IndexController;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\Auth\RegisterController;

    // Admin controller
    use App\Http\Controllers\CategoryController;
    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\GenreController;
    use App\Http\Controllers\MovieController;
    use App\Http\Controllers\EpisodeController;
    use App\Http\Controllers\CountryController;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    Route::get('/', [IndexController::class, 'home'])->name('homepage');
    Route::get('/danh-muc/{slug}', [IndexController::class, 'category'])->name('category');
    Route::get('/the-loai/{slug}', [IndexController::class, 'genre'])->name('genre');
    Route::get('/quoc-gia/{slug}', [IndexController::class, 'country'])->name('country');
    Route::get('/xem-phim/{slug}/tap-{number_episode}', [IndexController::class, 'watch'])->name('watch');
    Route::get('/phim/{slug}', [IndexController::class, 'movie'])->name('movie');
    Route::get('/espisode', [IndexController::class, 'espisode'])->name('espisode');
    Route::get('/number-episode', [IndexController::class, 'espisode'])->name('number-episode');
    Route::get('/tag/{tag}', [IndexController::class, 'tags_phim'])->name('tag');
    Route::get('/tim-kiem', [IndexController::class, 'search'])->name('search');
    Route::get('/new', [IndexController::class, 'new'])->name('new');
    Route::get('/subtitle/{sub}', [IndexController::class, 'subtitle'])->name('subtitle');
    Route::get('/year/{year}', [IndexController::class, 'year'])->name('year');
    Route::get('/filter', [IndexController::class, 'filter'])->name('filter');
    Route::post('/add-rating', [IndexController::class, 'add_rating'])->name('add-rating');

    
    // Route admin
    Auth::routes();
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/RegisterAdmin', [HomeController::class, 'register'])->name('RegisterAdmin');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('select-movie', [EpisodeController::class, 'select_movie'])->name('select-movie');

    Route::resource('category', CategoryController::class);
    Route::resource('movie', MovieController::class);
    Route::resource('genre', GenreController::class);
    Route::resource('country', CountryController::class);
    Route::resource('episode', EpisodeController::class);
    Route::get('/update-year', [MovieController::class, 'update_year']);
    Route::get('/update-status', [MovieController::class, 'update_status']);
    Route::get('/update-category', [MovieController::class, 'update_category']);
    Route::get('/update-country', [MovieController::class, 'update_country']);
    Route::post('/update-image-movie', [MovieController::class, 'update_image_movie'])->name('update-image-movie');
?>