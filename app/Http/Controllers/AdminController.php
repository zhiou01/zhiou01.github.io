<?php

namespace App\Http\Controllers;

use App\Lang;
use App\SoftwareUpdateLog;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use League\Flysystem\Exception;
use pcinaglia\laraUpdater\LaraUpdaterController;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function __construct()
    {
        \App::setLocale(CoreController::getLang());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * This function shows admin options
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function options()
    {
        // if user is not admin then this option will not visible
        if (Auth::user()->type != 'admin') {

            return "Access denied";
        }
        return view('adminOptions');
    }

    /**
     *
     * Add custom language option
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function addLanguageIndex()
    {
        if (Auth::user()->type != "admin") {
            return "permission denied";
        }

        return view('addLanguage');
    }

    /**
     * @param Request $request
     * @return string
     */
    public function addLanguage(Request $request)
    {
        if ($request->name == "") {
            return "Name required";
        }
        if ($request->flag == "") {
            return "Flag code required";
        }
        try {
            $language = new Lang();
            $language->name = $request->name;
            $language->flag = $request->flag;
            $language->folder = $request->folder;
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

    /**
     * Changing language
     * @param Request $request
     * @return string
     */
    public function changeLanguage(Request $request)
    {
        try {
            User::where('id', Auth::user()->id)->update([
                'lang' => $request->lang
            ]);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function softwareUpdate()
    {
        if (Auth::user()->type != 'admin') {

            return "Access denied";
        }




        return view('softwareUpdate.index');


    }

    // create logs of software update

    public static function softwareUpdateLog($version)
    {
        try {
            if (!SoftwareUpdateLog::where('userId', Auth::id())->where('version', $version)->exists()) {
                $log = new SoftwareUpdateLog();
                $log->userId = Auth::id();
                $log->version = $version;
                $log->save();
            }

        } catch (\Exception $exception) {

        }
    }
}
