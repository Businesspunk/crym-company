<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Profile;
use Auth;
use Facebook\Facebook;

class SocialAuthController extends Controller
{
    protected function auth( $uid, $firstName ){
        
        $user = User::firstOrNew([ 'email' => $uid, 'password' => $uid ]);
        $user->name = $firstName;
        $user->save();

        $proile = Profile::firstOrCreate([ 'user_id' => $user->id ]);
        
        Auth::login($user);
        return redirect()->route('main');
    }

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

        $uid = "vk_".$data->id;
        $firstName = $data->first_name;
        
        return $this->auth($uid, $firstName);
    }

    public function authByFB( Request $request )
    {
            if( !session_id() ){
                session_start();
            }

            $fb = new Facebook([
                'app_id' => env('FACEBOOK_APP_ID'),
                'app_secret' => env('FACEBOOK_APP_SECRET'),
                'default_graph_version' => 'v2.10',
            ]);

            $helper = $fb->getRedirectLoginHelper();

            try {
            $accessToken = $helper->getAccessToken();
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
            exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
            }

            if (! isset($accessToken)) {
                if ($helper->getError()) {
                    header('HTTP/1.0 401 Unauthorized');
                    echo "Error: " . $helper->getError() . "\n";
                    echo "Error Code: " . $helper->getErrorCode() . "\n";
                    echo "Error Reason: " . $helper->getErrorReason() . "\n";
                    echo "Error Description: " . $helper->getErrorDescription() . "\n";
                } else {
                    header('HTTP/1.0 400 Bad Request');
                    echo 'Bad request';
                }
                exit;
            }

            $response = $fb->get('/me?fields=id,first_name', $accessToken);
            $user = $response->getGraphUser();
            $uid = "fb_".$user->getId();
            $firstName = $user->getFirstName();

            return $this->auth($uid, $firstName);
    }
    
}
