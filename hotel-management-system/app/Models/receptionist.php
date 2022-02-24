<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class receptionist extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
     'national_id',
     'manager_id',
     'avatar_img',
    ];

    public function manager()
    {
        return $this->belongsTo(manager::class);
    }
}
