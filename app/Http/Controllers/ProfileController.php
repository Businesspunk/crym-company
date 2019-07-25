<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{

    public function saveSettings( Request $request )
    {   
        $user = $request->user();
        $profile = $user->profile;

        $user->update( $request->all() ); 
        $profile->update( $request->except(['user_id']) );
        
        return redirect()->back();
    }

    public function permanentUpload( Request $request ){
        $val = Validator::make( $request->all(), [
            'avatar' => 'mimes:jpeg,png'
        ]);

        if( $val->fails() ){
            return response()->json([ 'error'=> true ]);
        }

        $path = photoSaver( $request->file('avatar'), 'temp', 'avatarPermanent');

        $response = [
            'src' => getSavedPhoto( $path ),
            'error' => false
        ];

        return response()->json($response);
   }

   public function updateAvatar( Request $request ){
        $val = Validator::make( $request->all(), [
            'avatar' => 'mimes:jpeg,png'
        ]);

        if( $val->fails() ){
            return response()->json(["error" => true]);
        }
        
        $user = $request->user();
        $profile = $user->profile;
        $path = photoSaver( $request->file('avatar'), 'avatars', 'avatarUpload');

        if( $profile->photo ){
            Storage::delete( $profile->photo );
        }
        $profile->photo = $path;
        $profile->save();
        
        $response = [
            'file' => getSavedPhoto( $path ),
            'error' => false
        ];

        return response()->json($response);
   }
}
