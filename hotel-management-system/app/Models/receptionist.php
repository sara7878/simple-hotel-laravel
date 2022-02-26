<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class receptionist extends Authenticatable
{
    use HasFactory , HasFactory,Notifiable;

    protected $table = 'receptionists';
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
    protected $hidden = [
        'password',
    ];
    
    public function reservations()
    {
        return $this->hasMany(reservation::class);
    }
}
