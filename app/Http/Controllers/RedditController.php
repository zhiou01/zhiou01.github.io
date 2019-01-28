<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class RedditController extends Controller
{
    /**
     * Reddit search page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        return view('reddit.index');


    }

    /**
     * Search reddit content
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request){
        $file = file_get_contents('https://www.reddit.com/r/php/search.json?q='.$request->keyword);
        $json = json_decode($file,true);
        $data = $json['data']['children'];

        return view('reddit.search',compact('data'));

    }
}
