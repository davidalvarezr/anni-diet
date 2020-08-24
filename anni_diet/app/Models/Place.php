<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $table = 'places';
    protected $fillable = ['name'];

    public function fireworks()
    {
        return $this->hasMany(Firework::class);
    }
}
