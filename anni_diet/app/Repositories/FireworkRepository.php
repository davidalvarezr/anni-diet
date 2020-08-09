<?php

namespace App\Repositories;

use App\Models\Firework;

class FireworkRepository implements FireworkRepositoryInterface {

    public function getAllFireworksNotTriggered() {
        $fireworks = Firework::whereDoesntHave('triggered_by')->get();
        return $fireworks;
    }

}
