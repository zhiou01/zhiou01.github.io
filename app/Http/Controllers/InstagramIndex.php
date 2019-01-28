<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class InstagramIndex extends Controller
{
    public function __construct()
    {
        \App::setLocale(CoreController::getLang());

    }

    /**
     * Auto follow page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function autoFollowIndex()
    {
        return view('instagramAutoFollow');
    }

    /**
     * Auto unfollow page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function autoUnfollowIndex()
    {
        return view('instagramAutoUnfollow');
    }

    /**
     * Auto comment page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function autoCommentsIndex()
    {
        return view('instagramAutoComments');
    }

    /**
     * Auto like page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function autoLikes()
    {
        return view('instagramAutoLikes');
    }

    /**
     * Auto message index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function autoMessageIndex()
    {
        return view('instagramAutoMessage');
    }

    /**
     * Instagram scraper page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function scraper()
    {
        return view('instagramScraper');
    }
}
