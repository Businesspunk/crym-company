<?php

if(!function_exists('photoSaver')){
    function photoSaver( $photo, $folder, $solution = null ){
        $ext = $photo->getClientOriginalExtension();
        $ext = $ext ? $ext : "png";
        $pathForDB = $folder."/". uniqid().".". $ext;
        $path = storage_path( 'app/public/' . $pathForDB );
        $image = Image::make( $photo );

        if( $solution == "avatarPermanent" ){
            $image->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save( $path , 85 );
        }
        elseif( $solution == "avatarUpload" ){
            $image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save( $path );
        }
        else{
            $image->fit(700, 500)->save( $path , 80 );
        }
        
        return $pathForDB;
    }
}

if(!function_exists('getSavedPhoto')){
    function getSavedPhoto( $dbPath ){        
        return asset( 'storage/'. $dbPath );
    }
}

if (!function_exists('getAvatarSrc')) {
    function getAvatarSrc( $user )
    {   
        $photo = $user->profile->photo;
        
        if( !$photo || !Storage::exists($photo) ){
            $photo = asset('img/no-photo.png');
        }else{
            $photo = asset( 'storage/' . $photo );
        }
        return $photo;
    }
}

if (!function_exists('getImageName')) {
    function getImageName( $path )
    {   
        $elements = explode( '/', $path );
        $elem = $elements[ count($elements) - 1 ];
        return $elem;
    }
}

if (!function_exists('get_price')) {
    function get_price( $number )
    {   
        return number_format( $number, 0, ',', ' ' ) . "руб.";
    }
}

if (!function_exists('get_geocode')) {
    function get_geocode( $post )
    {   
        $res = [$post->coord_y, $post->coord_x];
        return implode(',', $res);
    }
}

if (!function_exists('getNameByGeoResponse')) {
    function getNameByGeoResponse( $response )
    {   
        return json_decode($response)->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty->GeocoderMetaData->text;
    }
}


if (!function_exists('getNameByGeo')) {
    function getNameByGeo( $post )
    {   
        $geocode = file_get_contents('http://geocode-maps.yandex.ru/1.x/?format=json&geocode='. get_geocode($post) .'&key='. env('Yandex_API_Key') );
        return getNameByGeoResponse($geocode);
    }
}

if (!function_exists('getPaginatedPosts')) {
    function getPaginatedPosts( $request, $posts, $postsPerPage )
    {   
        $page = $request->page;
        
        $posts = $posts->paginate($postsPerPage, ['*'], 'page', $page);

        return response()
                ->json( 
                    ['content' => view('components/posts-ajax', compact('posts') )->render(), 
                    'hasMorePages' => $posts->hasMorePages(),
                    ] 
                );
    }
}

if (!function_exists('deletePost')) {
    function deletePost( $post)
    {   
        $result = [];
        $photos = $post->photos;

        foreach ($photos as $photo) {
            $result[] = $photo['url'];
        }
        $result[] = $post->main_photo;
        Storage::delete( $result );
        $post->delete();        
    }
}