<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Profile;
use Auth;
use Facebook\Facebook;

class SocialAuthController extends Controller
{
    public function authByVk( Request $rq )
    {
        $code = $rq->code;

        if( $rq->error ){
            return redirect()->route('main');
        }
        $token = json_decode( file_get_contents( getUrlForAuthVk($code) ), true );
        $request_params = [
            'user_id' => $token['user_id'],
            'fields' => ['first_name'],
            'v' => '5.52',
            'access_token' => $token['access_token']
        ];
        
        $get_params = http_build_query($request_params);
        $result = json_decode(file_get_contents('https://api.vk.com/method/users.get?'. $get_params));
        $data = $result->response[0];

        $login = "vk_".$data->id; $password = $login;
        $firstName = $data->first_name;
        
        $user = User::firstOrNew([ 'email' => $login, 'password' => $password ]);
        $user->name = $firstName;
        $user->save();

        $proile = Profile::firstOrNew([ 'user_id' => $user->id ]);
        $proile->save();
        
        Auth::login($user);
        return redirect()->route('main');
    }

    public function authByFB( Request $request )
    {
        debug($request);
        return 1;
    }
    
}
