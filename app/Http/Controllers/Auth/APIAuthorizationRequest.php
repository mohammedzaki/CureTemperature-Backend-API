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
     * @SWG\Definition (
     *      definition="LoginData",
     *      required={""},
     *      @SWG\Property(
     *          property="client_id",
     *          description="client_id",
     *          type="string"
     *      ),
     *      @SWG\Property(
     *          property="client_secret",
     *          description="client_secret",
     *          type="string"
     *      ),
     *      @SWG\Property(
     *          property="username",
     *          description="username",
     *          type="string"
     *      ),
     *      @SWG\Property(
     *          property="password",
     *          description="password",
     *          type="string"
     *      )
     * )
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     * @Post("/api/apiLogin")
     * 
     * @SWG\Post(
     *   tags={"User"},
     *   path="/apiLogin",
     *   operationId="apiLogin",
     *   produces={"application/json"},
     *   consumes={"application/json"},
     *   @SWG\Parameter(
     *     in="body",
     *     name="userLoginData",
     *     description="user Login Data",
     *     required=true,
     *     @SWG\Schema(ref="#/definitions/LoginData")
     *   ),
     *   @SWG\Response(response="default", ref="#/responses/SuccessResponse")
     * )
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
