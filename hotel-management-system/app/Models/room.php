<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class room extends Model
{
    use HasFactory;


    /**
     * Get the floor that owns the comment.
     */
    public function floor()
    {
        return $this->belongsTo(floor::class);
    }


    /**
     * Get the reservation that owns the room.
     */
    public function reservation()
    {
        return $this->belongsTo(reservation::class);
    }
}
