<?php

    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Auth;
    use App\Http\Controllers\IndexController;
    use App\Http\Controllers\HomeController;

    // Admin controller
    use App\Http\Controllers\CategoryController;
    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\GenreController;
    use App\Http\Controllers\MovieController;
    use App\Http\Controllers\EpisodeController;
    use App\Http\Controllers\CountryController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\Shetabit_visitController;
    use Illuminate\Foundation\Auth\EmailVerificationRequest;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Password;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Str;
    use App\Models\User;
    use Illuminate\Auth\Events\PasswordReset;

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
    Route::get('/home', [HomeController::class, 'index'])->middleware(['auth','verified'])->name('home');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('select-movie', [EpisodeController::class, 'select_movie'])->name('select-movie');

    Route::resource('category', CategoryController::class);
    Route::resource('movie', MovieController::class);
    Route::resource('genre', GenreController::class);
    Route::resource('country', CountryController::class);
    Route::resource('episode', EpisodeController::class);
    Route::resource('user', UserController::class);
    Route::get('/update-year', [MovieController::class, 'update_year']);
    Route::get('/update-status', [MovieController::class, 'update_status']);
    Route::get('/update-category', [MovieController::class, 'update_category']);
    Route::get('/update-country', [MovieController::class, 'update_country']);

    // Xác thực email (không có cũng đc, laravel có làm sẵn)
    Route::get('/email/verify', function () {
        return view('auth.verify');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/home');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('resent', true);
    })->middleware(['auth', 'throttle:6,1'])->name('verification.resent');

    // Quên mật khẩu (không có cũng đc, laravel có sẵn)
    Route::get('/forgot-password', function () {
        return view('auth.passwords.email');
    })->middleware('guest')->name('password.request');

    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);
     
        $status = Password::sendResetLink(
            $request->only('email')
        );
     
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    })->middleware('guest')->name('password.email');

    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.passwords.reset', ['token' => $token]);
    })->middleware('guest')->name('password.reset');

    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    })->middleware('guest')->name('password.update');
?>