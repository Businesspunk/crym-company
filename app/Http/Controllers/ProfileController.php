<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Helpers\Images\PhotoManager;
use Illuminate\Support\Facades\Hash;


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
            'avatar' => 'image'
        ]);
            
        if( $val->fails() ){
            $messages = $val->messages()->get('*');
            $result = [];
            foreach( $messages as $message ){
                foreach( $message as $error ){
                    $result[] = $error;
                }
            }

            return response()->json([ 'error'=> true, 'messages' => $result ]);
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
   public function changePasswordVip( Request $request ){

        $user = User::getVip();
        $new = $request->input('new');

        $this->authorize('changepassword', $user);
        $user->update([
            'password' => Hash::make( $new )
        ]);

        return redirect()->back();
   }

   public function chooseAccountType( Request $request )
   {
        $user = $request->user();
        $type = intval( $request->type );

        if( $user->type_of_account == null ){

            if( $type == 1 ){
                $free_public = 10;
            }elseif( $type == 2 ){
                $free_public = 6;
            }else{
                return redirect()->back();
            }

            $user->free_publications = $free_public;
            $user->type_of_account = $type;
            
            $user->save();

        }

        return redirect()->back();
   }
}
