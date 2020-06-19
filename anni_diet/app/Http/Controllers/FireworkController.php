<?php

namespace App\Http\Controllers;

use App\WebSocket\MyEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FireworkController extends Controller
{
    public function broadcast(Request $r) {

        $validator = Validator::make($r->all(), [
            'author' => 'string',
            'x' => 'regex:/^[0-9]+$/',
            'y' => 'regex:/^[0-9]+$/',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors()
            ], 422);
        }

        $validatedData = $validator->validated();

        event(new MyEvent([
            'author' => $validatedData['author'],
            'x' => $validatedData['x'],
            'y' => $validatedData['y'],
        ]));
        return "OK";
    }
}
