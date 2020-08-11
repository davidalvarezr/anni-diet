<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class CheckApiController extends Controller
{
    // If the request returns a 200, it means user has still access to protected resources
    public function checkApiAccess(Request $r) {
        return true;
    }
}
