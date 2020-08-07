<?php

namespace App\Http\Controllers;

use App\Models\Firework;
use App\Models\FireworkEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FireworkController extends Controller
{
    public function broadcast(Request $r) {

        $validator = Validator::make($r->all(), [
            'author' => 'string',
            'type' => 'string',
            'x' => 'regex:/^[0-9]+$/',
            'y' => 'regex:/^[0-9]+$/',
            'z' => 'regex:/^[0-9]+$/',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->errors()
            ], 422);
        }

        $validatedData = $validator->validated();


        // TODO: get the current user
        $user = $r->user();

        // TODO: store the firework in the database
        $firework = new Firework();
        $firework->fill([
            'x' => $validatedData['x'],
            'y' => $validatedData['y'],
            'z' => $validatedData['z'],
            'type' => $validatedData['type'],
        ]);
        $firework->user()->associate($user);
        $firework->save();

        // TODO: Add the id
        event(new FireworkEvent([
            'author' => $validatedData['author'],
            'x' => $validatedData['x'],
            'y' => $validatedData['y'],
            'z' => $validatedData['z'],
            'type' => $validatedData['type'],
        ]));
        return "OK";
    }
}
