<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    /**
     * A category has many posts
     * @return Eloquent relationship
     */
    public function posts()
    {
    	return $this->hasMany('App\Post');
    }
}
