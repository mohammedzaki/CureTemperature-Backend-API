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
     * @Post("/api/apiLogin")
     */
    function apiLogin(Request $request)
    {

        $guzzle                = new Client;
        $response              = $guzzle->post(url('oauth/token'), [
            'form_params' => [
                'grant_type'    => 'password',
                'client_id'     => empty($request->clientId) ? $request->client_id : $request->clientId,
                'client_secret' => empty($request->clientSecret) ? $request->client_secret : $request->clientSecret,
                'username'      => $request->username,
                'password'      => $request->password
            ],
        ]);
        $user                  = User::where('email', $request->username)->first();
        $body                  = json_decode((string) $response->getBody());
        $user['access_token']  = $body->access_token;
        $user['expires_in']    = $body->expires_in;
        $user['refresh_token'] = $body->refresh_token;
        $user['token_type']    = $body->token_type;

        return response()->jsonSuccess(ResponseClass::HTTP_OK, $user);
    }

}
