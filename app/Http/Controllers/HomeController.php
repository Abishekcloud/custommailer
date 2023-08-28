<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
{
    if (auth()->check()) {
        if (auth()->user()->role === 'user') {
            return $this->userPage();
        } elseif (auth()->user()->role === 'admin') {
            return redirect()->route('admin.index');
        }
    }

    return view('home.index');
}


    public function userPage(){
        $user = User::all();
        return view('users.userHome',compact('user'));
    }
}
