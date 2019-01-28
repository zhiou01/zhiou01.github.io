<?php

namespace App\Http\Controllers;

use App\Wp;
use App\WpSite;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WordpressController extends Controller
{
    public function __construct()
    {
        \App::setLocale(CoreController::getLang());

    }

    /**
     * Show wordpress sites
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (!Data::myPackage('wp')) {
            return view('errors.404');
        }

        $data = Wp::where('userId', Auth::user()->id)->get();
        return view('Wordpress', compact('data'));
    }


    /**
     * Get wordpress posts
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function getPosts($id)
    {

        $baseUrl = WpSite::where('id', $id)->value('url');
        $url = $baseUrl . "/sociallit/get/post";

        $siteId = $id;
        $data = self::fire($url);

        if ($data == "") {
            return "Site not found";
        }

        return view('wordpressSite', compact('data', 'siteId', 'baseUrl'));

    }


    /**
     * Get user informations
     * @param $userId
     * @param $siteId
     * @return mixed
     */
    public static function getSingleUser($userId, $siteId)
    {
        $url = WpSite::where('id', $siteId)->value('url') . "/sociallit/get/single/user/" . $userId;
        return self::fire($url);

    }

    /**
     * @param $postId
     * @param $siteId
     * @return mixed
     */
    public static function getComment($postId, $siteId)
    {
        $url = WpSite::where('id', $siteId)->value('url') . "/sociallit/get/post/comment/" . $postId;
        return self::fire($url);
    }

    /**
     * Delete post from site
     * @param Request $request
     */
    public function delPost(Request $request)
    {
        $url = WpSite::where('id', $request->siteId)->value('url') . "/sociallit/delete/post/" . $request->postId;
        echo self::fire($url);

    }

    /**
     * Curl execution
     * @param $siteUrl
     * @return mixed
     */
    public static function fire($siteUrl)
    {
        $url = $siteUrl;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);
        $result = json_decode($response, true);
        return $result;
    }
}
