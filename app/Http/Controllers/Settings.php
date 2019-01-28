<?php

namespace App\Http\Controllers;

use App\pinBoards;
use App\SoftwareSettings;
use App\User;
use App\WpSite;
use DB;
use App\Setting;
use App\TuBlogs;
use Happyr\LinkedIn\LinkedIn;
use Illuminate\Support\Facades\Auth;
use seregazhuk\PinterestBot\Factories\PinterestBot;
use Tumblr\API\Client;
use App\FacebookPages;
use Facebook\Facebook;
use App\facebookGroups;
use Illuminate\Http\Request;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class Settings extends Controller
{
    public function __construct()
    {
        \App::setLocale(CoreController::getLang());

    }

    /**
     * Settings page with essential data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        session_start();

        // Wordpress
        $wpUser = Data::get('wpUser');
        $wpPassword = Data::get('wpPassword');
        $wpUrl = Data::get('wpUrl');

        //Twitter
        $twConKey = Data::get('twConKey');
        $twConSec = Data::get('twConSec');
        $twToken = Data::get('twToken');
        $twTokenSec = Data::get('twTokenSec');
        $twUser = Data::get('twUser');

        //Tumblr
        $tuConKey = Data::get('tuConKey');
        $tuConSec = Data::get('tuConSec');
        $tuToken = Data::get('tuToken');
        $tuTokenSec = Data::get('tuTokenSec');
        $tuDefBlog = Data::get('tuDefBlog');

        //Facebook
        $fbAppId = Data::get('fbAppId');
        $fbAppSec = Data::get('fbAppSec');
        $fbToken = Data::get('fbAppToken');

        //skype
        $skypeUser = Data::get('skypeUser');
        $skypePass = Data::get('skypePass');

        //linkedin
        $liClientId = Data::get('liClientId');
        $liClientSecret = Data::get('liClientSecret');
        $liAccessToken = Data::get('liAccessToken');

        //instagram

        $inUser = Data::get('inUser');
        $inPass = Data::get('inPass');

        // Pinterest

        $pinUser = Data::get('pinUser');
        $pinPass = Data::get('pinPass');


        try {
            $fb = new Facebook([
                'app_id' => $fbAppId,
                'app_secret' => $fbAppSec,
                'default_graph_version' => 'v2.6',
            ]);
        } catch (\Exception $g) {

        }

        try {

            $permissions = ['groups_access_member_info', 'manage_pages', 'pages_messaging', 'manage_pages', 'publish_pages', 'email', 'user_likes', 'public_profile', 'user_posts', 'pages_manage_cta', 'read_page_mailboxes', 'pages_show_list', 'user_events', 'pages_manage_instant_articles', 'read_insights', 'user_status', 'user_photos']; // optional
            $helper = $fb->getRedirectLoginHelper();
            $loginUrl = $helper->getLoginUrl(secure_url('') . '/fbconnect', $permissions);
        } catch (\Exception $e) {
            $loginUrl = url('/');
        }


        try {
            $fbPages = FacebookPages::where('userId', Auth::user()->id)->get();
        } catch (\Exception $h) {
            $fbPages = "none";
        }


        // get tumblr blogs

        $tuBlogs = TuBlogs::where('userId', Auth::user()->id)->get();


        $linkedIn = new LinkedIn(Data::get('liClientId'), Data::get('liClientSecret'));

        $liLoginUrl = $linkedIn->getLoginUrl([
            'redirect_uri' => url('linkedin/callback')
        ]);

        return view('settings', compact(
            'twUser',
            'tuDefBlog',
            'wpUser',
            'wpPassword',
            'wpUrl',
            'twConKey',
            'twConSec',
            'twToken',
            'twTokenSec',
            'tuConKey',
            'tuConSec',
            'tuToken',
            'tuTokenSec',
            'fbAppId',
            'fbAppSec',
            'fbToken',
            'loginUrl',
            'fbPages',
            'tuBlogs',
            'skypeUser',
            'skypePass',
            'liClientId',
            'liClientSecret',
            'liAccessToken',
            'liLoginUrl',
            'inUser',
            'inPass',
            'pinUser',
            'pinPass'
        ));
    }

    /**
     *
     * Save wordpress settings
     * @param Request $re
     * @return string
     */
    public function wpSave(Request $request)
    {
        $url = $request->url . "/sociallit/verify";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);
        $result = json_decode($response, true);
        if (isset($result['status'])) {
            if ($result['status'] == "ok") {
                try {

                    $wp = new WpSite();
                    $wp->userId = Auth::user()->id;
                    $wp->name = $request->name;
                    $wp->url = $request->url;
                    $wp->save();
                    return "success";
                } catch (\Exception $exception) {
                    return $exception->getMessage();
                }
            }
        } else {
            return "This site is not verified";
        }

    }

    /**
     * Delete wordpress sites which one added
     * @param Request $request
     * @return string
     */
    public function wpDel(Request $request)
    {
        try {
            WpSite::where('id', $request->id)->delete();
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Save twitter settings
     * @param Request $re
     * @return string
     */
    public function twSave(Request $re)
    {
        $twConKey = $re->twConKey;
        $twConSec = $re->twConSec;
        $twToken = $re->twToken;
        $twToeknSec = $re->twTokenSec;
        $twUser = $re->twUser;

        if ($twConKey == "" || $twConSec == "" || $twToken == "" || $twToeknSec == "") {
            return "Please fill the necessary fields";
        }

        try {
            DB::table('settings')->where('userId', Auth::user()->id)->update(['twConKey' => $twConKey]);
            DB::table('settings')->where('userId', Auth::user()->id)->update(['twConSec' => $twConSec]);
            DB::table('settings')->where('userId', Auth::user()->id)->update(['twToken' => $twToken]);
            DB::table('settings')->where('userId', Auth::user()->id)->update(['twTokenSec' => $twToeknSec]);
            DB::table('settings')->where('userId', Auth::user()->id)->update(['twUser' => $twUser]);

            return "success";

        } catch (\PDOException $e) {

            return $e->getMessage();
        }
    }

    /**
     *
     * Save Tumblr settings
     *
     * @param Request $re
     * @return string
     */
    public function tuSave(Request $re)
    {
        $tuConKey = $re->tuConKey;
        $tuConSec = $re->tuConSec;
        $tuToken = $re->tuToken;
        $tuTokenSec = $re->tuTokenSec;
        $tuDefBlog = $re->tuDefBlog;

        if ($tuConKey == "" || $tuConSec == "" || $tuToken == "" || $tuTokenSec == "") {
            return "Please fill the necessary fields";
        }

        try {
            DB::table('settings')->where('userId', Auth::user()->id)->update(['tuConKey' => $tuConKey]);
            DB::table('settings')->where('userId', Auth::user()->id)->update(['tuConSec' => $tuConSec]);
            DB::table('settings')->where('userId', Auth::user()->id)->update(['tuToken' => $tuToken]);
            DB::table('settings')->where('userId', Auth::user()->id)->update(['tuTokenSec' => $tuTokenSec]);
            DB::table('settings')->where('userId', Auth::user()->id)->update(['tuDefBlog' => $tuDefBlog]);

            return "success";

        } catch (\PDOException $e) {

            return $e->getMessage();
        }
    }

    /**
     * Save facebook settings
     *
     * @param Request $re
     * @return string
     */
    public function fbSave(Request $re)
    {
        $appId = $re->fbAppId;
        $appSec = $re->fbAppSec;
        $token = $re->fbToken;
        $fbPages = $re->fbPages;
        if ($appId == "" || $appSec == "") {
            return "Please fill the necessary fields";
        }
        try {
            DB::table('settings')->where('userId', Auth::user()->id)->update(['fbAppId' => $appId]);
            DB::table('settings')->where('userId', Auth::user()->id)->update(['fbAppSec' => $appSec]);
            DB::table('settings')->where('userId', Auth::user()->id)->update(['fbAppToken' => $token]);
            DB::table('settings')->where('userId', Auth::user()->id)->update(['fbDefPage' => $fbPages]);
            return "success";
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Instagram settings save
     * @param Request $request
     * @return string
     */
    public function inSave(Request $request)
    {
        try {
            Setting::where('userId', Auth::user()->id)->update([
                'inUser' => $request->inUser,
                'inPass' => $request->inPass
            ]);
            return "success";

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Connect with facebook
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function fbConnect()
    {
        session_start();
        $fb = new Facebook([
            'app_id' => Data::get('fbAppId'),
            'app_secret' => Data::get('fbAppSec'),
            'default_graph_version' => 'v2.5',
        ]);

        $helper = $fb->getRedirectLoginHelper();
        $_SESSION['FBRLH_state'] = $_GET['state'];

        try {
            $accessToken = $helper->getAccessToken();
            $_SESSION['token'] = $accessToken;
            DB::table('settings')->where('userId', Auth::user()->id)->update(['fbAppToken' => $accessToken]); // save user access token to database
            $this->saveFbPages(); // save facebook pages and token
            $this->saveFbGroups(); // save facebook groups to database

        } catch (FacebookResponseException $e) {
            // When Graph returns an error
            return '[a] Graph returned an error: ' . $e->getMessage();

        } catch (FacebookSDKException $e) {
            // When validation fails or other local issues
            return '[a] Facebook SDK returned an error: ' . $e->getMessage();

        }


        try {

            $response = $fb->get('/me', $_SESSION['token']);
        } catch (FacebookResponseException $e) {
            return '[b] Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            return '[b] Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }


        return redirect('settings');


    }

    /**
     * Get settings value form database
     * @param $valueOf
     * @return mixed
     */
    public function config($valueOf)
    {
        return DB::table('settings')->where('userId', Auth::user()->id)->value($valueOf);
    }

    public function test()
    {

        $this->saveFbPages();

    }

    /**
     * Save facebook pages to database with access token
     * @return string
     */
    public function saveFbPages()
    {

        $fb = new Facebook([
            'app_id' => $this->config('fbAppId'),
            'app_secret' => $this->config('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);


        try {

            $response = $fb->get('me/accounts', $this->config('fbAppToken'));
            $body = $response->getBody();
            $data = json_decode($body, true);
            FacebookPages::where('userId', Auth::id())->delete();

            foreach ($data['data'] as $no => $filed) {

                $facebookPages = new FacebookPages();
                $facebookPages->pageId = $filed['id'];
                $facebookPages->pageName = $filed['name'];
                $facebookPages->pageToken = $filed['access_token'];
                $facebookPages->userId = Auth::user()->id;
                $facebookPages->save();

            }

        } catch (FacebookResponseException $e) {
            return 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            return 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

    }

    /**
     * Save facebook groups that are imported form facebook with essential data
     * @return string
     */
    public function saveFbGroups()
    {

        $fb = new Facebook([
            'app_id' => $this->config('fbAppId'),
            'app_secret' => $this->config('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);


        try {

            $response = $fb->get('me/?fields=groups.limit(1000)', $this->config('fbAppToken'));
            $body = $response->getBody();
            $data = json_decode($body, true);

            facebookGroups::where('userId', Auth::id())->delete();

            foreach ($data['groups']['data'] as $no => $field) {
                if (!isset($field['privacy'])) {
                } else {
                    $privacy = $field['privacy'];
                    $facebookGroup = new facebookGroups();
                    $facebookGroup->pageId = $field['id'];
                    $facebookGroup->pageName = $field['name'];
                    $facebookGroup->privacy = $privacy;
                    $facebookGroup->userId = Auth::user()->id;
                    $facebookGroup->save();
                }


            }

        } catch (FacebookResponseException $e) {

            return 'Graph returned an error: ' . $e->getMessage();
        } catch (FacebookSDKException $e) {

            return 'Facebook SDK returned an error: ' . $e->getMessage();
        }
    }

    /**
     * Count total likes of your facebook pages
     * @return int|string
     */
    public function total_likes()
    {
        $fb = new Facebook([
            'app_id' => $this->config('fbAppId'),
            'app_secret' => $this->config('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);

        try {

            $response = $fb->get('me/accounts', $this->config('fbAppToken'));
            $body = $response->getBody();
            $data = json_decode($body, true);
            $total_likes = 0;
            foreach ($data['data'] as $no => $content) {
                $page = $fb->get('/me?fields=fan_count', $content['access_token']);
                $fan_count = json_decode($page->getBody(), true);
                $likes = $fan_count['fan_count'];
                $total_likes += $likes;


            }

            return $total_likes;

        } catch (FacebookResponseException $e) {

            return 'Graph returned an error: ' . $e->getMessage();
        } catch (FacebookSDKException $e) {

            return 'Facebook SDK returned an error: ' . $e->getMessage();
        }
    }

    /**
     * Import blogs from Tumblr
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function tuSync()
    {
        $consumerKey = Data::get('tuConKey');
        $consumerSecret = Data::get('tuConSec');
        $token = Data::get('tuToken');
        $tokenSecret = Data::get('tuTokenSec');

        $tuClient = new Client($consumerKey, $consumerSecret, $token, $tokenSecret);

        try {
            $tuBlogName = $tuClient->getUserInfo()->user->blogs;

            foreach ($tuBlogName as $no => $de) {
                if (!TuBlogs::where('blogName', $de->name)->exists()) {
                    $blogs = new TuBlogs();
                    $blogs->blogName = $de->name;
                    $blogs->blogTitle = $de->title;
                    $blogs->userId = Auth::user()->id;
                    $blogs->save();
                }

            }


        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return redirect('settings');
    }

    /**
     * Language settings
     * @param Request $re
     * @return string
     */
    public function lang(Request $re)
    {
        $value = $re->value;
        try {
            Setting::where('userId', Auth::user()->id)->update(['lang' => $value]);
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * notifications settings
     * pusher notification
     */
    public function notifyIndex()
    {
        $appId = Data::get('notifyAppId');
        $appKey = Data::get('notifyAppKey');
        $appSec = Data::get('notifyAppSecret');
        return view('notifysettings', compact('appId', 'appKey', 'appSec'));
    }

    /**
     * Save notifications
     * @param Request $re
     * save notification settings
     * @return string
     */
    public function notifySave(Request $re)
    {
        try {
            DB::table('settings')->where('userId', Auth::user()->id)->update(['notifyAppId' => $re->appId]);
            DB::table('settings')->where('userId', Auth::user()->id)->update(['notifyAppKey' => $re->appKey]);
            DB::table('settings')->where('userId', Auth::user()->id)->update(['notifyAppSecret' => $re->appSec]);
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }


    /**
     * Save linkedin settings
     * @param Request $request
     * @return string
     */
    public function liSave(Request $request)
    {
        try {
            Setting::where('userId', Auth::user()->id)->update([
                'liClientId' => $request->clientId
            ]);

            Setting::where('userId', Auth::user()->id)->update([
                'liClientSecret' => $request->clientSecret
            ]);

            return 'success';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Save Messenger bot settings
     * @param Request $request
     * @return string
     */
    public function fbBotConfigSave(Request $request)
    {
        try {
            Setting::where('userId', Auth::user()->id)->update([
                'exMsg' => $request->exMsg,
                'matchAcc' => $request->matchAcc
            ]);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Show admin option page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function configIndex()
    {
        $path = "* * * * * php " . app_path() . "/artisan schedule:run >> /dev/null 2>&1";
        return view('config', compact('path'));
    }

    /**
     * Get settings data for specific user
     * @param $valueOf
     * @param $userId
     * @return mixed
     */
    public static function get($valueOf, $userId)
    {
        return Setting::where('userId', $userId)->value($valueOf);
    }

    /**
     * Change theme
     * @param Request $request
     * @return string
     */
    public function updateTheme(Request $request)
    {
        try {
            User::where('id', Auth::user()->id)->update([
                'theme' => $request->theme
            ]);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Get software settings
     * @param $key
     * @return mixed
     */
    public static function getSettings($key)
    {
        return SoftwareSettings::where('key', $key)->value('value');
    }

    /**
     *
     * Update software settings
     *
     * @param $key
     * @param $value
     * @return string
     */
    public static function updateSettings($key, $value)
    {
        try {
            SoftwareSettings::where('key', $key)->update([
                'value' => $value
            ]);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Get software settings
     * @param $keyName
     * @return mixed
     */
    public static function getSoftwareSettings($keyName)
    {

        return SoftwareSettings::where('key', $keyName)->value('value');
    }



    // Pinterest settings

    /**
     * Save pinterest settings
     * @param Request $request
     * @return string
     */
    public function pinSave(Request $request)
    {
        try {


            Setting::where('userId', Auth::user()->id)->update([
                'pinUser' => $request->pinUser,
                'pinPass' => $request->pinPass
            ]);


            if (Data::get('pinPass') == "") {
//                $boards = "Not available";
            } else {
                $pinterest = PinterestBot::create();
                $pinterest->auth->login(Data::get('pinUser'), Data::get('pinPass'));
                $boards = $pinterest->boards->forMe();

                pinBoards::where('userId', Auth::user()->id)->delete();

                foreach ($boards as $board) {
                    $b = new pinBoards();
                    $b->userId = Auth::user()->id;
                    $b->board_name = $board['name'];
                    $b->board_id = $board['id'];
                    $b->save();
                }


            }

            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function getInUser($id)
    {
        return Setting::where('userId', $id)->value('inUser');
    }


}
