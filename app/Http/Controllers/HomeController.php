<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\User;
use App\Models\Movie;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_User = User::all()->count();
        $total_Country = Country::all()->count();
        $total_Category = Category::all()->count();
        $total_Movie = Movie::all()->count();
        $total_Genre = Genre::all()->count();
        return view('home', compact('total_User', 'total_Country', 'total_Category', 'total_Movie', 'total_Genre'));
    }

}
