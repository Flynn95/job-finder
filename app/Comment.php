<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content', 
    ];

    /**
     * A comment belongs to one post
     * @return Eloquent relationship
     */
    public function post()
    {
    	return $this->belongsTo('App\Post');
    }

    /**
     * A comment belongs to one user
     * @return Eloquent relationship
     */
    public function user()
    {
    	return $this->belongsTo('App\User', 'creator_id');
    }
}
