<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class room extends Model
{
    use HasFactory;
    protected $fillable=[
        'name' , 'number' ,'capacity', 'price','manager_id','floor_id','status'
    ];

    public function floor()
    {
        return $this->belongsTo(floor::class);
    }
    public function manager()
    {
        return $this->belongsTo(manager::class);
    }
}
