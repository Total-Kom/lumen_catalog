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
        'deleted'
    ];


    protected $appends = [
        'count_files', 'rating_files'
    ];

    public function getCountFilesAttribute()
    {
        $categoryFiles = Category::find($this->id)->catalog;
        return count($categoryFiles);
    }

    public function getRatingFilesAttribute()
    {
        $categoryFiles = Category::find($this->id)->catalog;
        $ratingFiles = 0;

        foreach ($categoryFiles as $key => $value)
        {
            $ratingFiles += $value->rating;
        }

        return $ratingFiles;
    }
    

    static public function get_active()
    {
        return Category::where('deleted', false)->get();
    }

    static public function files_to(int $id)
    {
        $categoryFiles = Category::find($id)->catalog;
        $result = Array();

        foreach ($categoryFiles as $key => $value)
        {
            $value->files->rating = $value->rating;
            array_push($result, $value->files);
        }

        return $result;
    }

    public function catalog()
    {
        return $this->hasMany('App\CatalogFiles', 'id_category');
    }
};
