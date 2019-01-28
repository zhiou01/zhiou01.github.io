<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Symfony\Component\DomCrawler\Crawler;

class WebController extends Controller
{

    /**
     *
     * Web to social page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('web.index');
    }

    /**
     *
     * Load page content like text / image from website
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function load(Request $request)
    {
        $html = file_get_contents($request->link);
        $crawler = new Crawler($html);
        if ($request->type == "image") {
            $images = $crawler->filterXPath('//img')->extract(array('src'));
            return view('web.imageTemplate', compact('images'));
        } elseif ($request->type == "paragraph") {
            $output = $crawler->filter('p')->each(function ($node) {
                return strip_tags($node->html());
            });

            return view('web.contentTemplate', compact('output'));
        } else {
            if($request->element == ""){
                return "You must enter the element name";
            }
            $output = $crawler->filter($request->element)->each(function ($node) {
                return strip_tags($node->html());
            });

            return view('web.contentTemplate', compact('output'));
        }

    }

}
