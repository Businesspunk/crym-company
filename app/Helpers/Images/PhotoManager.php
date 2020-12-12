<?php

namespace App\Helpers\Images;
use Intervention\Image\Facades\Image;


class PhotoManager
{
    public static function  savePhoto( $photo, $folder, $solution = null, $name = null ){
        $ext = $photo->getClientOriginalExtension();
        $ext = $ext ? $ext : "png";
        $name = $name ?? uniqid();
        
        $pathForDB = $folder."/".$name.".". $ext;
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
        elseif( $solution == "lager" ){
            $image->resize(640*2, 480*2, function ($constraint) {
                $constraint->aspectRatio();
            })->save( $path, 90 );
        }
        else{
            $image->resize(640, 480, function ($constraint) {
                $constraint->aspectRatio();
            })->save( $path, 90 );

        }
        
        return $pathForDB;
    }

}
