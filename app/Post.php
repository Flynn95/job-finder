<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Post extends Model
{
    use SearchableTrait;

    protected $fillable = [
        'title', 'content', 'category_id', 'location',
    ];

    // Carbon instance fields
    protected $dates = ['created_at', 'updated_at'];

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'title' => 10,
            'location' => 5,
            'content' => 5,
        ]
    ];

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
