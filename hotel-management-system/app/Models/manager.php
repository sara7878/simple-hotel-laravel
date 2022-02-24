<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class manager extends Model
{
    use HasFactory;
    public function receptionists()
    {
        return $this->hasMany(receptionist::class);
    }
    public function floors()
    {
        return $this->hasMany(floor::class);
    }
}
