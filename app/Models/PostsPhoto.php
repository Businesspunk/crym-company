<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PostsPhoto extends Model
{
    protected $table = 'postsPhotos';
    public $timestamps = false;
    public $guarded = []; 

    public function deletePhoto()
    {
        Storage::delete([$this->url, $this->url_lager]);
        $this->delete();
    }

    public function getPhotoJson()
    {
        $data['id'] = $this->id;
        $data['type'] = 'posts';

        return json_encode($data, true);
    }
    public function getLagerPhotoUrl()
    {
        return $this->url_lager ?? $this->url;
    }
}
