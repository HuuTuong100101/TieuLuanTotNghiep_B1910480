<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users = User::all();
        return view('admin.account.index', compact('users'));

    }

    public function destroy($id)
    {
        try {
            $User = User::find($id);
            if ($User->email == 'tn732506@gmail.com') {
                return redirect()->back()->with('warning', 'Tài khoản này không được xóa !');
            } else {
                $User->delete();
                return redirect()->back()->with('success', 'Xóa tài khoản thành công');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Xóa tài khoản không thành công');
        }
    }
}
