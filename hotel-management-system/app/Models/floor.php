<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class floor extends Model
{
    use HasFactory;


    /**
     * Get the rooms of the floor.
     */
    public function rooms()
    {
        return $this->hasMany(room::class);
    }
}
