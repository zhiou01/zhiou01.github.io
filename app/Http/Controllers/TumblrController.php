<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Tumblr\API\Client;

class TumblrController extends Controller
{
    public function __construct()
    {
        \App::setLocale(CoreController::getLang());

    }
    /**
     * Tumblr home page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        if(!Data::myPackage('tu')){
            return view('errors.404');
        }

        if(Data::get('tuTokenSec') == "" || Data::get('tuConSec')==""){
            return redirect('/settings');
        }

        $blogName = Data::get('tuDefBlog');
        $consumerKey = Data::get('tuConKey');
        $consumerSecret = Data::get('tuConSec');
        $token = Data::get('tuToken');
        $tokenSecret = Data::get('tuTokenSec');

        $client = new Client($consumerKey, $consumerSecret, $token, $tokenSecret);
        try {

            $post = $client->getBlogPosts($blogName);

            $dashboard = $client->getDashboardPosts();


        } catch (\Exception $e) {
            echo "error";
        }

        return view('Tumblr',compact('post','dashboard'));
    }

    /**
     * @param $field
     * @return mixed
     */

}
