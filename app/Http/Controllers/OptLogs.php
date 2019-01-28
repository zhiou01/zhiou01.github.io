<?php

namespace App\Http\Controllers;

use App\OptLog;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;


class OptLogs extends Controller
{
    public function __construct()
    {
        \App::setLocale(CoreController::getLang());

    }
    /**
     * Show scheduled logs
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $datas = OptLog::where('userId',Auth::user()->id)->get();
        return view('schedules_log', compact('datas'));
    }

    /**
     * Delete single log
     * @param Request $re
     * @return string
     */
    public function logDel(Request $re)
    {
        $id = $re->id;
        try {
            OptLog::where('id', $id)->delete();
            return 'success';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     *
     * Delete all logs
     * @return string
     */
    public function delAll()
    {
        try {
            OptLog::where('userId',Auth::user()->id)->truncate();
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
