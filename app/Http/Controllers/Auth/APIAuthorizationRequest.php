<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Auth;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response as ResponseClass;
use App\Models\User;

/**
 * Description of APIAuthorizationRequest
 *
 * @author mohammedzaki
 * @Middleware({"cros"})
 */
class APIAuthorizationRequest {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     * @Get("/redirect")
     */
    function redirect(Request $request) {
        $query = http_build_query([
            'client_id' => $request->client_id,
            'redirect_uri' => $request->redirect_uri,
            'response_type' => $request->response_type,
            'scope' => '',
        ]);

        return redirect('http://ihreg.localhost/oauth/authorize?' . $query);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     * @Get("/callback")
     */
    function callback(Request $request) {
        //return $this->grantToken($request);
        return $this->implicitGrant($request);
    }

    function grantToken(Request $request) {
        $http = new Client;

        $response = $http->post('http://ihreg.localhost/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => 4,
                'client_secret' => 'h46pAm7pvbRqtsLgpejObV8psd53AYMQwzbTG8HU',
                'redirect_uri' => 'http://ihreg.localhost/callback',
                'code' => $request->code,
            ],
        ]);
        return json_decode((string) $response->getBody(), true);
    }

    function implicitGrant(Request $request) {
        $guzzle = new Client;

        $response = $guzzle->post('http://ihreg.localhost/oauth/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => '4',
                'client_secret' => 'h46pAm7pvbRqtsLgpejObV8psd53AYMQwzbTG8HU',
                'scope' => '',
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     * @Post("/api/v1/apiLogin")
     */
    function apiLogin(Request $request) {
        
        $guzzle = new Client;
        $response = $guzzle->post(url('oauth/token'), [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => empty($request->clientId) ? $request->client_id : $request->clientId,
                'client_secret' => empty($request->clientSecret) ? $request->client_secret : $request->clientSecret,
                'username' => $request->username,
                'password' => $request->password
            ],
        ]);
        $user = User::where('email', $request->username)->first();
        $body = json_decode((string) $response->getBody());
        $user['access_token'] = $body->access_token;
        $user['expires_in'] = $body->expires_in;
        $user['refresh_token'] = $body->refresh_token;
        $user['token_type'] = $body->token_type;
        
        return response()->jsonSuccess(ResponseClass::HTTP_OK, $user);
    }

}
