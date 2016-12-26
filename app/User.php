<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
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
     * An user has many posts
     * @return Eloquent relationship
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * An user has many comments
     * @return Eloquent relationship
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'creator_id');
    }
}
