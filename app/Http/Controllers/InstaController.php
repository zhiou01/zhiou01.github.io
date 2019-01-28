<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstaController extends Controller
{
    public function index(){
        \InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;
        /////// CONFIG ///////
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = true;
        $truncatedDebug = false;
//////////////////////
/////// MEDIA ////////
        $photoFilename = 'https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png';
        $captionText = 'google logo';
//////////////////////
        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
            exit(0);
        }
        try {
            print_r($ig->timeline->getSelfUserFeed());
        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
        }

    }
}
