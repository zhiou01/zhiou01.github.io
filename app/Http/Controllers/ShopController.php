<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Nwidart\Modules\Facades\Module;

class ShopController extends Controller
{
    public function __construct()
    {
        \App::setLocale(CoreController::getLang());

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function index(){
        if(Auth::user()->type != "admin"){
            return "Access denied";
        }
        $content = file_get_contents('https://trinolab.github.io/shop/optimus-prime/');

        return view('shop',compact('content'));
    }

    /**
     *
     */
    public function getPlugins(){
        $json = file_get_contents('https://trinolab.github.io/shop/shop.json');
        print_r(json_decode($json,true));

    }

    /**
     * @param Request $request
     * @return string
     */
    public function download(Request $request){
        $fileName = $request->fileName;
        $downloadLink = $request->downloadLink;
        $module = Module::find($request->name);
        try{
            file_put_contents(base_path() . '/Modules/', $fileName, fopen($downloadLink, 'r'));
            return "success";
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }
}
