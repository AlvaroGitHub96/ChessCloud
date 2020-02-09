<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //
    protected $table = 'rol';
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany('App\User', 'rol_users', 'rol_id', 'user_id');
    }
}
