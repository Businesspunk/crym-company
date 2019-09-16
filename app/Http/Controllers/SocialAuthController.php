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
            $fb = new Facebook([
                'app_id' => env('FACEBOOK_APP_ID'),
                'app_secret' => env('FACEBOOK_APP_SECRET'),
                'default_graph_version' => 'v2.10',
            ]);

            $helper = $fb->getRedirectLoginHelper();

            try {
            $accessToken = $helper->getAccessToken();
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
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

            // Logged in
            echo '<h3>Access Token</h3>';
            debug($accessToken->getValue());

            // The OAuth 2.0 client handler helps us manage access tokens
            $oAuth2Client = $fb->getOAuth2Client();
            debug($oAuth2Client);
            return 1;
            // Get the access token metadata from /debug_token
            $tokenMetadata = $oAuth2Client->debugToken($accessToken);
            echo '<h3>Metadata</h3>';
            var_dump($tokenMetadata);

            // Validation (these will throw FacebookSDKException's when they fail)
            $tokenMetadata->validateAppId('{app-id}'); // Replace {app-id} with your app id
            // If you know the user ID this access token belongs to, you can validate it here
            //$tokenMetadata->validateUserId('123');
            $tokenMetadata->validateExpiration();

            return redirect()->route('main');
    }
    
}
