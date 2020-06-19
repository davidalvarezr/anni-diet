<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Session::get('user');
        $token = Session::get('token');
        return view('home', ['user' => $user, 'token' => $token]);
    }
}
