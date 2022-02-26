<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    use HasFactory;

    // protected $fillable = ['name','email','mobile','password','country','gender','status'];

    /**
     * Get the reservations of the floor.
     */
    public function reservations()
    {
        return $this->hasMany(reservation::class);
    }
}
