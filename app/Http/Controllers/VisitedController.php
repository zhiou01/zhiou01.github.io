<?php

namespace App\Http\Controllers;

use App\Visited;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitedController extends Controller
{
    public static function isVisited($url)
    {
        if (Visited::where('userId', Auth::user()->id)->where('url', $url)->exists()) {
            return "yes";
        } else {
            $visited = new Visited();
            $visited->userId = Auth::user()->id;
            $visited->url = $url;
            $visited->save();
            return "no";
        }
    }
}
