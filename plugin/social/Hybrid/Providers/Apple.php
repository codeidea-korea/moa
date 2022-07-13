<?php
/* !
 * HybridAuth
 * http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
 * (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
 */
/**
 * Hybrid_Providers_Apple provider adapter based on OAuth2 protocol
 * Copyright (c) 2020 HanbitGaram - webmaster@hanb.jp
 * https://hanb.jp / https://hanbitgaram.com
 * reference  : thisgun <Hybrid_Providers_Payco>4
 */

use \Firebase\JWT\JWT;

class Hybrid_Providers_Apple extends Hybrid_Provider_Model_OAuth2 {

    public $scope;
    public $response_mode;
    public $auth_user_dir;
    private $client_info;
    private $api_response;
    private $api_user;

    /**
     * {@inheritdoc}
     */
    function initialize()
    {
        parent::initialize();
        $this->scope = 'name email';
        $this->api->api_base_url = 'https://appleid.apple.com/auth/';
        $this->api->authorize_url = 'https://appleid.apple.com/auth/authorize';
        $this->api->token_url = 'https://appleid.apple.com/auth/token';
        $this->response_mode = 'form_post';
        $this->auth_user_dir = 'https://appleid.apple.com';
        $this->client_info = $this->api->client_secret;
        //$this->api->redirect_uri = strtolower($this->api->redirect_uri);
    }

    /**
     * {@inheritdoc}
     */
    function loginBegin() {
        $state = md5(uniqid(mt_rand(), true));
        Hybrid_Auth::storage()->set('apple_auth_state', $state);

        $parameters = array(
            "response_type" => "code",
            "response_mode" => $this->response_mode,
            "client_id" => $this->api->client_id,
            "redirect_uri" => $this->api->redirect_uri,
            "state" => $state,
            "scope" => $this->scope,
        );

        Hybrid_Auth::redirect($this->api->authorizeUrl($parameters, "JS"));
    }

    function generateClientSecret(){
        $key = $this->client_info['key_content'];
        $payload = array(
            'iat'=>time(),
            'exp'=>time() + (86400*180),
            'iss'=> $this->client_info['team_id'],
            'aud'=>$this->auth_user_dir,
            'sub'=>$this->api->client_id
        );

        return JWT::encode(
            $payload,
            $key,
            'ES256',
            $this->client_info['key_id']
        );
        
    }

    function parseRequestResult( $result ){
        if( json_decode( $result ) ) return json_decode( $result );

        parse_str( $result, $output );

        $result = new StdClass();

        foreach( $output as $k => $v )
            $result->$k = $v;

        return $result;
    }

    function authenticate( $code )
    {
        $params = array(
            "grant_type"    => "authorization_code",
            "code"          => $code,
            "redirect_uri"  => $this->api->redirect_uri,
            "client_id"     => $this->api->client_id,
            "client_secret" => $this->api->client_secret,
            "scope"         => $this->scope
        );
        $response = $this->api->post($this->api->token_url,$params, false);
        $response = $this->parseRequestResult( $response );

        if( ! $response || ! isset( $response->access_token ) ){
            throw new Exception( "The Authorization Service has return: " . $response->error );
        }

        if( isset( $response->access_token  ) )  $this->api->access_token           = $response->access_token;
        if( isset( $response->refresh_token ) ) $this->api->refresh_token           = $response->refresh_token;
        if( isset( $response->expires_in    ) ) $this->api->access_token_expires_in = $response->expires_in;

        // calculate when the access token expire
        if( isset($response->expires_in)) {
            $this->api->access_token_expires_at = time() + $response->expires_in;
        }

        return $response;
    }

    /**
     * {@inheritdoc}
     */
    function loginFinish() {
        // state 값이 유효하지 않은 경우
        if($_POST['state'] != Hybrid_Auth::storage()->get('apple_auth_state')){
            throw new Exception("해당 서비스에 접근할수 있는 권한이 없습니다.", 4);
        }

        // try to authenicate user
        $code = (array_key_exists('code', $_REQUEST)) ? $_REQUEST['code'] : "";
        $this->api->client_secret = $this->generateClientSecret();

        try{
            $this->api_response = $this->authenticate( $code );
        }
        catch( Exception $e ){
            throw new Exception( "User profile request failed! {$this->providerId} returned an error: $e", 6 );
        }

        // check if authenticated
        if ( ! $this->api->authenticated() ){
            throw new Exception( "Authentication failed! {$this->providerId} returned an invalid access token.", 5 );
        }

        Hybrid_Auth::storage()->set('apple_auth_user', $this->api_response);

        // store tokens
        $this->token("access_token",  $this->api->access_token);
        $this->token("refresh_token", $this->api->refresh_token);
        $this->token("expires_in",    $this->api->access_token_expires_in);
        $this->token("expires_at",    $this->api->access_token_expires_at);

        $this->setUserConnected();
    }

    function getUserProfile() {
        $data = null;
        $user = null;

        $data = Hybrid_Auth::storage()->get('apple_auth_user');

        if( $data->id_token === null || $data->id_token === '' ){
            throw new Exception( "Authentication failed! {$this->providerId} returned an invalid id token.", 5 );
        }

        $user = explode('.', $data->id_token);
        $user = $user[1];
        $user = base64_decode($user);
        $user = stripslashes($user);
        $user = json_decode($user, true);

        # store the user profile.
        $this->user->profile->identifier = $user['sub'];
        $this->user->profile->sid = get_social_convert_id( $this->user->profile->identifier, $this->providerId );

        if(is_array($user['name'])){
            $this->user->profile->username = $user['lastName'].$user['firstName'];
            $this->user->profile->displayName = $user['lastName'].$user['firstName'];
        }else{
            $this->user->profile->username = $this->user->profile->sid;
            $this->user->profile->displayName = $this->user->profile->sid;
        }

        $email = $user['email'];
        $this->user->profile->email = $email;
        $this->user->profile->emailVerified = $email;

        //print_r2($user);
        return $this->user->profile;
    }

    function logout() {
        parent::logout();
    }

}