<?php

namespace App\Http\Controllers;

use App\Setting;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        \App::setLocale(CoreController::getLang());

    }

    /**
     * User Profile page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        return view('profile', compact('name', 'email'));
    }

    /**
     * Update profile information
     * @param Request $re
     * @return string
     */
    public function update(Request $re)
    {
        $name = $re->name;
        $email = $re->email;
        $oldPass = $re->oldPass;
        $newPass = $re->newPass;
        if ($newPass == "") {
            User::where('email', Auth::user()->email)->update([
                'email' => $email,
                'name' => $name,
                'timezone' => $re->timezone,
                'timeFormat' => $re->timeFormat
            ]);

            return "success";
        } else {
            if ($oldPass == "") {
                return "Please input old password";
            } else {
                if (Hash::check($oldPass, Auth::user()->password)) {
                    User::where('email', Auth::user()->email)->update([
                        'email' => $email,
                        'name' => $name,
                        'password' => bcrypt($newPass),
                        'timezone' => $re->timezone,
                        'timeFormat' => $re->timeFormat
                    ]);
                    return "success";
                } else {
                    return "Old password didn't match";
                }
            }
        }
    }
}
