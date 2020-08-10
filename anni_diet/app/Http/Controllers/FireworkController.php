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

    public function __construct(FireworkRepository $fireworkRepository)
    {
        $this->fireworkRepository = $fireworkRepository;
    }

    public function broadcast(FireworkBroadcast $r)
    {
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
        ], 'firework-placement'));
        return "event: firework-placement";
    }

    // TODO: check that people can only trigger their own fireworks
    public function trigger(Request $r)
    {
        $rules = [];

        if (is_array($r->firework_ids)) {    // if call from web
            $rules = [
                'firework_ids' => ['required', 'array'],
                'firework_ids.*' => ['integer'],
            ];
            $fireworkIds = $r->validate($rules)['firework_ids'];
        } else {                            // else call from unity
            $rules = ['firework_ids' => ['string', 'regex:/^[1-9]\d*(\s*,\s*[1-9]\d*)*$/']];
            $validatedData = $r->validate($rules);
            $fireworkIds = explode(',', $validatedData['firework_ids']);
        }

        // TODO: filter the id so that the user can only delete his own
        $fireworksToLaunch = Firework::whereIn('id', $fireworkIds);

        $launched = $fireworksToLaunch->get()->all();

        $fireworksToLaunch->delete();

//        // Delete it from the DB
//        Firework::destroy($fireworkIds);

        if (count($launched) > 0) {
            event(new FireworkEvent($fireworkIds, 'firework-trigger'));
        }

        return "event: firework-trigger";
    }

    public function allFireworksNotTriggered()
    {
        $fireworks = $this->fireworkRepository->getAllFireworksNotTriggered();
        return response()->json([
            'fireworks' => $fireworks,
        ]);
    }


}
