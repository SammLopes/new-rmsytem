<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'slug'];
    const ADMIN = 1;
    const USER = 2;
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
