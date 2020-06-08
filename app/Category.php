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

    static public function add_file($userId, $fileId, $catalogId)
    {
        $categoryFiles = Category::find($catalogId)->catalog;

        if(count($categoryFiles) > 0)
        {
            return $categoryFiles[0]->insert_unique($userId, $fileId, $catalogId);
        }

        return null;
    }

    static public function remove_file($userId, $fileId, $catalogId)
    {
        $categoryFiles = Category::find($catalogId)->catalog;

        if(count($categoryFiles) > 0)
        {
            return $categoryFiles[0]->remove_record($userId, $fileId, $catalogId);
        }

        return null;
    }

    public function catalog()
    {
        return $this->hasMany('App\CatalogFiles', 'id_category');
    }

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
};
