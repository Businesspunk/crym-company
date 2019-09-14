<?php

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

if (!function_exists('num_decline')) {

    function num_decline( $number, $titles, $param2 = '', $param3 = '' ){

        if( $param2 )
            $titles = [ $titles, $param2, $param3 ];

        if( is_string($titles) )
            $titles = preg_split( '/, */', $titles );

        if( empty($titles[2]) )
            $titles[2] = $titles[1];

        $cases = [ 2, 0, 1, 1, 1, 2 ];

        $intnum = abs( intval( strip_tags( $number ) ) );

        return "$number ". $titles[ ($intnum % 100 > 4 && $intnum % 100 < 20) ? 2 : $cases[min($intnum % 10, 5)] ];
    }
}

if (!function_exists('getPhotoSrc')) {
    function getPhotoSrc($src){
        if( !isExistsPhoto($src) ){
            return asset('img/image-notfound.jpg');
        }
        return getSavedPhoto($src);
    }
}

if (!function_exists('isExistsPhoto')) {
    function isExistsPhoto($src){
        if( $src == null || $src == '' || !Storage::exists($src) ){
            return false;
        }
        return true;
    }
}

if (!function_exists('issetCoord')) {
    function issetCoord($post){
        $x = $post->coord_x;
        $y = $post->coord_y;
        if( $x != null && $x != '' && $y != null && $y != '' ){
            return true;
        }
        return false;
    }

}

if (!function_exists('getFavorite')) {
    function getFavorite(){
        $cookie = [];
        if( isset($_COOKIE['favorite']) ){
            $cookie = json_decode($_COOKIE['favorite']);
        }
        return $cookie;
    }
}

if (!function_exists('getPhotoNames')) {
    function getPhotoNames($arr){
        $result = [];
        if( count($arr) ){
            foreach ($arr as $item) {
                $result[] = getImageName($item);
            }
        }
        
        return $result;
    }
}
if (!function_exists('getVideoId')) {
    function getVideoId( $link ){
        $r = explode('?v=', $link);
        return $r[ count($r) - 1 ];
    }
}

if (!function_exists('getCity')) {
    function getCity($y, $x){
        $geocode = file_get_contents('http://geocode-maps.yandex.ru/1.x/?kind=locality&format=json&geocode='. $y .','. $x .'&key='. env('Yandex_API_Key') );
        return mb_convert_case(json_decode($geocode)->response->GeoObjectCollection->featureMember[0]->GeoObject->name, MB_CASE_LOWER, "UTF-8");
    }
}


if (!function_exists('getVkAuthLink')) {
    function getVkAuthLink()
    {   
        $link = "https://oauth.vk.com/authorize?client_id=%d&display=page&scope=friends&redirect_uri=%s&response_type=code&v=5.101";
        
        return sprintf($link, env('VK_APP_ID'), route('authByVk') );
    }
}

if( !function_exists('getUrlForAuthVk') ){
    function getUrlForAuthVk($code){
        $link = "https://oauth.vk.com/access_token?client_id=%d&client_secret=%s&redirect_uri=%s&code=%s";
        return sprintf( $link, env('VK_APP_ID'), env('VK_SECRET'), route('authByVk'), $code );
    }
}

if( !function_exists('getFBAuthLink') ){
    function getFBAuthLink(){
        $fb = new \Facebook\Facebook([
            'app_id' => env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v2.10',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email']; // Optional permissions
        $loginUrl = $helper->getLoginUrl( route('authByFacebook') , $permissions);

        return ($loginUrl);
    }
}