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
     * @Get("/admin", as="admin")
     * @Middleware({"auth"})
     */
    public function admin() {
        return view('admin');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     * @Get("/home", as="home")
     * @Middleware({"auth"})
     */
    public function home() {
        return view('app-download');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     * @Get("/", as="appDownload")
     * @Middleware({"guest"})
     */
    public function appDownload() {
        return view('app-download');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     * @Get("/welcome", as="welcome")
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
    
    // https://api.thingspeak.com/update?api_key=R26E9T0CNXKEIYSB&field1=29&field2=25&field3=newSerial3
    // https://thingspeak.com/apps/thinghttp/60518
    
    // https://api.thingspeak.com/update?api_key=2ICLU5MQB2KI82MS&field1=90&field2=12&field3=AM175
    
}
