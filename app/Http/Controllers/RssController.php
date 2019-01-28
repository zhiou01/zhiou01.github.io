<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class RssController extends Controller
{
    /**
     * RSS page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('rss.index');
    }

    /**
     * Load RSS feed from URL
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function load(Request $request)
    {
        $rss = \Feed::loadRss($request->rssUrl);
        return view('rss.template', compact('rss'));

    }


}
