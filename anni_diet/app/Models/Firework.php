<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Firework extends Model
{
    protected $table = 'fireworks';

    protected $fillable = [
        'x', 'y', 'z', 'type'
    ];

    /**
     * Returns a User model representing the guy who placed the firework
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns a User model representing the user who triggered the firework
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function triggeredBy()
    {
        return $this->belongsTo(User::class, 'triggered_by');
    }

    /**
     * @return bool true if th firework has already been triggered
     */
    public function triggered()
    {
        return $this->triggeredBy() !== null;
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

}
