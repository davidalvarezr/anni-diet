<?php

namespace App\Repositories;

use App\Models\Firework;

class FireworkRepository implements FireworkRepositoryInterface {

    public function getAllFireworksNotTriggered() {
        $fireworks = Firework::whereDoesntHave('triggeredBy')->get();
        return $fireworks;
    }

}
