<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    private $rating;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'downloading'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'deleted', 'path'
    ];

    protected $appends = [
        'rating'
    ];

    public function setRatingAttribute($value)
    {
        $this->rating = $value;
    }

    public function getRatingAttribute()
    {
        return $this->rating;
    }

    public function catalog()
    {
        return $this->hasMany('App\CatalogFiles', 'id_category');
    }
};