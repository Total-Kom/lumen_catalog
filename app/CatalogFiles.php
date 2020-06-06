<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatalogFiles extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rating'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'id_user', 'id_file', 'id_category'
    ];

    public function files()
    {
        return $this->belongsTo('App\File', 'id_file');
    }

};
