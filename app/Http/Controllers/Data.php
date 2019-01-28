<?php

namespace App\Http\Controllers;

use App\Package;
use App\Setting;
use DateTime;
use DB;
use App\FacebookPages;
use Illuminate\Support\Facades\Auth;

class Data extends Controller
{

    /**
     * Get settings data form settings table
     * @param $valueOf
     * @return mixed
     * get settings value
     */
    public static function get($valueOf)
    {
        return DB::table('settings')->where('userId', Auth::id())->value($valueOf);

    }

    /**
     * Get exception message for facebook page ( Messenger bot )
     * @param $pageId
     * @return mixed
     */
    public static function getExceptionMessage($pageId)
    {
        $userId = FacebookPages::where('pageId', $pageId)->value('userId');
        $exMsg = Setting::where('userId', $userId)->value('exMsg');
        return $exMsg;
    }

    /**
     * Get accuracy settings
     * @param $pageId
     * @return mixed
     */
    public static function getMatchAcc($pageId)
    {
        $userId = FacebookPages::where('pageId', $pageId)->value('userId');
        $matchAcc = Setting::where('userId', $userId)->value('matchAcc');
        return $matchAcc;
    }

    public static function getSlackExceptionMessage()
    {

    }

    /**
     * @param int $pageId
     * @return mixed
     * get facebook page access token from database
     */
    public static function getToken($pageId)
    {
        return DB::table('facebookPages')->where('pageId', $pageId)->value('pageToken');


    }

    /**
     * @param int $pageId
     * @return string
     * get page name using page id form database
     */
    public static function getPageName($pageId)
    {
        $data = FacebookPages::where('pageId', $pageId)->value('pageName');

        return $data;
    }

    /**
     * Messenger bot button template
     * @param $userId
     * @param array $data
     * @return string
     */
    public static function botButton($userId, $data = array())
    {
        $result = "";
        foreach ($data as $d) {
            $result .= '{
                         "type":"postback",
                          "title":"' . $d['question'] . '",
                          "payload":"' . $d['question'] . '"
                          },
                        ';
        }
        $json = '{
                  "recipient":{
                    "id":"' . $userId . '"
                  },
                  "message":{
                    "attachment":{
                      "type":"template",
                      "payload":{
                        "template_type":"button",
                        "text":"Help Menu",
                        "buttons":[' . $result . ']
                      }
                    }
                  }
                }';

        return $json;
    }

    /**
     * @param $text
     * @return string
     */
    public static function shortText($text)
    {
        $small = substr($text, 0, 30);
        return $small . " ....";
    }

    /**
     * Convert time into hour ago format
     * @param $datetime
     * @param bool $full
     * @return string
     */
    public static function time($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    /**
     * Check if user has the specific package or has permission to use package
     * @param $userId
     * @param $packageName
     * @return bool
     */
    public static function hasPackage($userId, $packageName)
    {
        if (Package::where('userId', $userId)->value($packageName) == 'yes') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check valid package
     * @param $packageName
     * @return bool
     */
    public static function myPackage($packageName)
    {

        if (Package::where('userId', Auth::id())->value($packageName) == 'yes') {
            return true;
        } else {
            return false;
        }

    }
}
