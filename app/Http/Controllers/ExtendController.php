<?php

namespace App\Http\Controllers;

use App\FacebookPages;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ExtendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Extend messenger to website home page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $datas = FacebookPages::where('userId', Auth::user()->id)->get();

        return view('extend', compact('datas'));
    }

    /**
     * View for showing single page
     * @param $pageId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function page($pageId)
    {
        return view('extendSingle', compact('pageId'));
    }
}
