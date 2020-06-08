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
        'rating','id_user', 'id_file', 'id_category'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'id'
    ];

    public function files()
    {
        return $this->belongsTo('App\File', 'id_file');
    }

    public function insert_unique($userId, $fileId, $categoryId)
    {
        if(CatalogFiles::where('id_user', $userId)
                        ->where('id_file', $fileId)
                        ->where('id_category', $categoryId))
        {
            return null;
        }
        
        return CatalogFiles::create(['id_user' => $userId,
                                        'id_file' => $fileId,
                                        'id_category' => $categoryId]);
    }

    public function remove_record($userId, $fileId, $categoryId)
    {
        return CatalogFiles::where('id_user', $userId)
                        ->where('id_file', $fileId)
                        ->where('id_category', $categoryId);
    }
};
