<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table='users';
    protected $primaryKey = 'id';
   
    public function pets()
    {
        return $this->hasMany(Pet::class,'user_id');
    }

public function favourites()
{
        return $this->belongsToMany(Pet::class, 'favourites')->withTimestamps();
}



}
