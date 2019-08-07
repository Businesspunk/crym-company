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