<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'content', 'category_id',
    ];

    // Carbon instance fields
    protected $dates = ['created_at', 'updated_at'];

    /**
     * A post has many comments
     * @return Eloquent relationship
     */
    public function comments()
    {
    	return $this->hasMany('App\Comment');
    }

    /**
     * A post belongs to one category
     * @return Eloquent relationship
     */
    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    /**
     * A post belongs to one user
     * @return Eloquent relationship
     */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
