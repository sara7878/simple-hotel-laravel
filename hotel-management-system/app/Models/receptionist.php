<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class receptionist extends Model
{
    use HasFactory;


    /**
     * Get the rooms for the blog post.
     */
    public function reservations()
    {
        return $this->hasMany(reservation::class);
    }
}
