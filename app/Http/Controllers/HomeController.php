<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @Controller(prefix="/")
 * @Middleware({"web"})
 */
class HomeController extends Controller {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     * @Get("/home", as="home")
     * @Middleware({"auth"})
     */
    public function index() {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     * @Get("/", as="welcome")
     * @Middleware({"guest"})
     */
    public function welcome() {
        return view('welcome');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     * @Get("/oauth-clients", as="oauthClients")
     * @Middleware({"auth"})
     */
    public function oauthClients() {
        return view('oauth-clients');
    }
}
