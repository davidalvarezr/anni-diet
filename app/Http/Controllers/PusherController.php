<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class PusherController extends Controller
{
    private $appKey;
    private $appSecret;
    private $appId;

    public function __construct() {
        $this->appKey = env('PUSHER_APP_KEY');
        $this->appSecret = env('PUSHER_APP_SECRET');
        $this->appId = env('PUSHER_APP_ID');
    }

    public function auth(Request $r) {
        $pusher = new Pusher($this->appKey, $this->appSecret, $this->appId);
        return $pusher->socket_auth($r->channel_name, $r->socket_id);
    }
}
