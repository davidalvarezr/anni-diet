<?php

namespace App\Http\Controllers;

use App\Http\Requests\FireworkBroadcast;
use App\Models\Firework;
use App\Models\FireworkEvent;
use App\Repositories\FireworkRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FireworkController extends Controller
{

    private FireworkRepository $fireworkRepository;

    public function __construct(FireworkRepository $fireworkRepository) {
        $this->fireworkRepository = $fireworkRepository;
    }

    public function broadcast(FireworkBroadcast $r) {

        $validatedData = $r->validated();

        // get the current user
        $user = $r->user();

        // store the firework in the database
        $firework = new Firework();
        $firework->fill([
            'x' => $validatedData['x'],
            'y' => $validatedData['y'],
            'z' => $validatedData['z'],
            'type' => $validatedData['type'],
        ]);
        $firework->user()->associate($user);
        $firework->save();
        $firework->fresh();

        event(new FireworkEvent([
            'id' => $firework->getKey(),
            'author' => $firework->user->name,
            'x' => $validatedData['x'],
            'y' => $validatedData['y'],
            'z' => $validatedData['z'],
            'type' => $validatedData['type'],
        ]));
        return "OK";
    }

    public function allFireworksNotTriggered()
    {
        $fireworks = $this->fireworkRepository->getAllFireworksNotTriggered();
        return response()->json([
            'fireworks' => $fireworks,
        ]);
    }



}
