<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * If SocialLit installed
     * @return bool
     */
    public static function isInstalled()
    {
        if (file_exists(storage_path('/installed'))) {
            return true;
        }
    }
}
