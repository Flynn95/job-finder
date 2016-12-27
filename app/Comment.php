<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Comment extends Model
{
    use SearchableTrait;

    protected $fillable = [
        'content', 
    ];

    // Carbon instance fields
    protected $dates = ['created_at'];

    protected $searchable = [
        'columns' => [
            'content' => 10,
            'post' => 5,
            'user' => 5,
        ]
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
    	return $this->belongsTo('App\User');
    }
}
