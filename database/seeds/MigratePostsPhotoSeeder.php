<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\PostsPhoto;

class MigratePostsPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();

        foreach($posts as $post)
        {
            if( !is_null($post->main_photo) )
            {
                PostsPhoto::create([
                    'post_id' => $post->id,
                    'url' => $post->main_photo,
                    'is_main' => true
                ]);
            }
        }
    }
}
