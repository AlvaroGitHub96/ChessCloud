<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'name', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    /*protected $casts = [
        'email_verified_at' => 'datetime',
    ];*/
    public function setPasswordAttribute($password){
        $this->attributes['password'] = bcrypt($password);
    }

    public function roles()
    {
        return $this->belongsToMany('App\Rol', 'rol', 'rol_id', 'id');
    }
}
