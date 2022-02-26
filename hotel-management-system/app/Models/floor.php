<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class floor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'number',
     'manager_id',

    ];

    /**
     * Get the rooms of the floor.
     */
    public function rooms()
    {
        return $this->hasMany(room::class);
    }
    public function manager()
    {
        return $this->belongsTo(manager::class);
    }
}
