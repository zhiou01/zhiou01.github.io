<?php

namespace App\Http\Controllers;

use App\facebookGroups;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class Monitor extends Controller
{
    public function __construct()
    {

    }

    /**
     *
     * Facebook Page monitor index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function pageMonitorIndex()
    {
        if (Data::get('fbAppSec') == "" || Data::get('fbAppId') == "") {
            return redirect('/settings');
        }

        $groups = facebookGroups::where('userId', Auth::user()->id)->get();
        return view('monitor.pageMonitor', compact('groups'));
    }

    /**
     * Store Page information to monitor
     * @param Request $request
     * @return string
     */
    public function addForMonitor(Request $request)
    {
        try {
            $monitor = new \App\Monitor();
            $monitor->userId = Auth::user()->id;
            $monitor->type = $request->type;
            $monitor->pageId = $request->pageId;
            $monitor->pageName = $request->pageName;
            $monitor->keyWord = $request->keyWord;
            $monitor->save();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


    }

}
