<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'deleted',
    ];

    static public function get_active()
    {
        return Category::where('deleted', false)->get();
    }

    static public function files_to($id)
    {
        $category_files = Category::find($id)->catalog;
        $result = Array();

        foreach ($category_files as $key => $value)
        {
            array_push($result, $value->files);
        }

        return $result;
    }

    public function catalog()
    {
        return $this->hasMany('App\CatalogFiles', 'id_category');
    }
};
