<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\shetabit_visit;
use Shetabit\Visitor\Traits\Visitor;

class Shetabit_visitController extends Controller
{
    public function add_log(Request $request) {
        // $check = 0;
        // $all_log_visitors = shetabit_visit::all();
        // $ip = $request->visitor()->ip();
        // $device = $request->visitor()->device();
        // $useragent = $request->visitor()->useragent();
        // foreach ($all_log_visitors as $log_visitor) {
        //     if ($log_visitor->ip == $ip && $log_visitor->device == $device && $log_visitor->useragent == $useragent) {
        //         $check = 1;
        //         break;
        //     }
        // }

        // if ($check == 0) {
            $request->visitor()->visit();
        // }

        // return response()->json($check);
    }

    // public function issonline(Request $request) {
    //     $data = $request->visitor()->visit();
    //     // $test = $request->visitor()->onlineVisitors(shetabit_visit::class); // returns collection of online users
    //     // User::online()->get(); // another way

    //     // $data->isOnline(); // determines if the given user is online
    //     // $user->isOnline(); // another way

    //     // return response()->json($data->ip);
    // }
}