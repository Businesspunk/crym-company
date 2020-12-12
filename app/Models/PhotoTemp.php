<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class PhotoTemp extends Model
{
    protected $guarded = [];

    public function moveToPosts($post_id, $is_main = false )
    {
        $photo_1 = getImageName($this->url);
        $photo_2 = getImageName($this->url_lager);

        Storage::move('temp/'.$photo_1, 'posts/'.$photo_1 );
        Storage::move('temp/'.$photo_2, 'posts/'.$photo_2 );

        PostsPhoto::create([
            'url' => 'posts/'.$photo_1,
            'url_lager' => 'posts/'.$photo_2,
            'post_id' => $post_id,
            'is_main' => $is_main
        ]);
    }
}
