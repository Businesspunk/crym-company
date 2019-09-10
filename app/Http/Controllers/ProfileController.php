<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Helpers\Images\PhotoManager;


class ProfileController extends Controller
{
    public function saveSettings( Request $request )
    {   
        $user = $request->user();
        $user->updateOne( $request );

        return redirect()->back();
    }

    public function permanentUpload( Request $request ){
        $val = Validator::make( $request->all(), [
            'avatar' => 'mimes:jpeg,png'
        ]);

        if( $val->fails() ){
            return response()->json([ 'error'=> true ]);
        }

        $path = PhotoManager::savePhoto( $request->file('avatar'), 'temp', 'avatarPermanent' );
       
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
        $path = $user->updateAvatar($request);
        
        $response = [
            'file' => getSavedPhoto( $path ),
            'error' => false
        ];

        return response()->json($response);
   }
   public function deleteUser( $id , Request $request )
   {
        $user = User::findOrFail($id);
        $this->authorize('delete', $user);
        $user->deleteOne();

        return redirect()->route('main');
   }
}
