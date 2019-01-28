<?php

namespace App\Http\Controllers;

use App\Capture;
use Carbon\Carbon;
use Eden\Collection\Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CaptureController extends Controller
{
    public function __construct()
    {

    }

    /**
     *
     * Capture home page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index()
    {
        // if facebook is not configured then go to settings pages

        if (Data::get('fbAppSec') == "" || Data::get('fbAppId') == "") {
            return redirect('/settings');
        }
        return view('capture.index');
    }

    /**
     *
     * get facebook page information
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function getInfo(Request $request)
    {
        $link = $request->pageLink;
        try {
            $fb = new \Facebook\Facebook([
                'app_id' => Data::get('fbAppId'),
                'app_secret' => Data::get('fbAppSec'),
                'default_graph_version' => 'v2.6',
            ]);

            $token = Data::get('fbAppToken');
            $data = $fb->get($link, $token)->getDecodedBody();

            $pageId = $data['id'];
            $pageName = $data['name'];

            return response()->json([
                'pageId' => $pageId,
                'pageName' => $pageName
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


    }

    /**
     *
     * Get facebook page feed
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFeed(Request $request)
    {
        $fb = new \Facebook\Facebook([
            'app_id' => Data::get('fbAppId'),
            'app_secret' => Data::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);

        $token = Data::get('fbAppToken');
        $data = $fb->get($request->pageId . "?fields=feed.limit(1000){link,message,created_time}", $token)->getDecodedBody();

        if (isset($data['feed'])) {
            foreach ($data['feed']['data'] as $key => $value) {
                if (isset($value['message'])) {
                    if (!Capture::where('content_id', $value['id'])->where('userId', Auth::user()->id)->exists()) {

                        // save captured data

                        $capture = new Capture();
                        $capture->content_id = $value['id'];
                        $capture->userId = Auth::user()->id;
                        $capture->pageId = $request->pageId;
                        $capture->pageName = $request->pageName;
                        $capture->content = $value['message'];
                        $capture->link = isset($value['link']) ? $value['link'] : "no";
                        $capture->date = $value['created_time'];
                        $capture->save();
                    }
                }
            }
        }

        return view('templates.feed', compact('data'));
    }

    /**
     * Get facebook page data of specific date
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFeedCustom(Request $request)
    {
        $fb = new \Facebook\Facebook([
            'app_id' => Data::get('fbAppId'),
            'app_secret' => Data::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);
        $date = $request->date;
        $limit = $request->limit;

        if ($request->date == "") {
            $date = Carbon::today()->format('Y-m-d');
        }

        if ($request->limit == "") {
            $limit = 10;
        }


        $token = Data::get('fbAppToken');

        // requesting for specific data
        $data = $fb->get($request->pageId . "?fields=feed.since(" . $date . ").limit(" . $limit . "){link,message,created_time}", $token)->getDecodedBody();

        if (isset($data['feed'])) {
            foreach ($data['feed']['data'] as $key => $value) {
                if (isset($value['message'])) {
                    if (!Capture::where('content_id', $value['id'])->where('userId', Auth::user()->id)->exists()) {
                        // save captured data
                        $capture = new Capture();
                        $capture->content_id = $value['id'];
                        $capture->userId = Auth::user()->id;
                        $capture->pageId = $request->pageId;
                        $capture->pageName = $request->pageName;
                        $capture->content = $value['message'];
                        $capture->link = $value['link'];
                        $capture->date = $value['created_time'];
                        $capture->save();
                    }

                }
            }
        }


        return view('templates.feed', compact('data'));
    }
}










