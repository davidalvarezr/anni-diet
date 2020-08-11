<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebSocketController extends Controller
{
    public function getPage() {
        return view('websocket');
    }
}
