<?php

namespace App\Http\Controllers;

use App\Models\Firework;
use App\Models\Place;
use Illuminate\Http\Request;

class WebSocketController extends Controller
{
    public function getPage() {
        $fireworks = Firework::all();
        $places = Place::all();
        return view('websocket', [
            'places' => $places,
            'fireworks' => $fireworks,
        ]);
    }
}
