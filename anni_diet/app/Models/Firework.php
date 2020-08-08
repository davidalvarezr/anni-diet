<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Firework extends Model
{
    protected $table = 'fireworks';

    protected $fillable = [
        'x', 'y', 'z', 'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
