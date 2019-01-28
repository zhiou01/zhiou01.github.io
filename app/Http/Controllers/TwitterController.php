<?php

namespace App\Http\Controllers;

use App\followers;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TwitterController extends Controller
{
    public function __construct()
    {
        \App::setLocale(CoreController::getLang());

    }

    /**
     *
     * Twitter Page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index()
    {
        if (!Data::myPackage('tw')) {
            return view('errors.404');
        }


        if (Data::get('twTokenSec') == "" || Data::get('twConKey') == "") {
            return redirect('/settings');
        }

        $consumerKey = Data::get('twConKey');
        $consumerSecret = Data::get('twConSec');
        $accessToken = Data::get('twToken');
        $tokenSecret = Data::get('twTokenSec');

        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);

        $me = $twitter->load(\Twitter::ME);
        $twRep = $twitter->load(\Twitter::REPLIES);
        $tw = $twitter->load(\Twitter::ME_AND_FRIENDS);
        return view('Twitter', compact('tw', 'twRep', 'me'));
    }


    /**
     * Retweet function
     * @param Request $re
     * @return string
     */
    public function retweet(Request $re)
    {

        $id = $re->id;

        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');

        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        try {
            $data = $twitter->request('statuses/retweet', 'POST', array(
                'id' => $id,
                'status' => 'test retweet'
            ));
            return "success";

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Retweet to specific twitter user
     * @param $id
     * @return string
     */
    public static function retweetnow($id)
    {
        if (!Data::myPackage('tw')) {
            return view('errors.404');
        }


        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');

        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        try {
            $data = $twitter->request('statuses/retweet', 'POST', array('id' => $id));
            return "success";

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Send direct message to twitter.
     * @param Request $re
     * @return string
     */
    public function twSendMsg(Request $re)
    {
        $username = $re->username;
        $text = $re->text;
        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');

        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        try {
            $data = $twitter->request('direct_messages/new', 'POST', array('screen_name' => $username, 'text' => $text));
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Send twitter message page
     * @param $user
     * @param $message
     * @return string
     */
    public static function SendMsg($user, $message)
    {

        if (!Data::myPackage('tw')) {
            return view('errors.404');
        }


        $username = $user;
        $text = $message;
        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');

        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        try {
            $data = $twitter->request('direct_messages/new', 'POST', array('screen_name' => $username, 'text' => $text));
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Twitter reply
     * @param Request $request
     * @return string
     */
    public function twReply(Request $request)
    {
        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');
        $text = $request->text;
        $statusId = $request->id;
        $username = $request->username;
        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        try {
            $data = $twitter->request('statuses/update', 'POST', array('status' => "@" . $username . " " . $text, 'in_reply_to_status_id' => $statusId), NULL);
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    /**
     *
     * Twitter reply page
     * @param $id
     * @param $user
     * @param $text
     * @return string
     */
    public static function twReplyNow($id, $user, $text)
    {

        if (!Data::myPackage('tw')) {
            return view('errors.404');
        }


        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');

        $statusId = $id;
        $username = $user;
        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        try {
            $data = $twitter->request('statuses/update', 'POST', array('status' => "@" . $username . " " . $text, 'in_reply_to_status_id' => $statusId), NULL);
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }


    /**
     * Twitter mass send page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function massSend()
    {

        if (!Data::myPackage('tw')) {
            return view('errors.404');
        }

        return view('twmasssend');
    }

    /**
     *
     * Send mass message to twitter
     * @param Request $re
     * @return string
     */
    public function massMessageSend(Request $re)
    {
        $message = $re->text;
        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');

        try {
            $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
            $followers = $twitter->request('followers/list', 'GET', []);
            $count = 0;
            echo '
                <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>                          
                                <th>User</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>';
            foreach ($followers->users as $users) {
                $msg = TwitterController::SendMsg($users->screen_name, $message);
                echo '<tr>';
                echo '<td>' . $users->screen_name . '</td>';
                echo '<td>' . $msg . '</td>';
                echo '</tr>';
                if ($msg == 'success') {
                    $count++;
                }

            }
            echo '</tbody><tfoot>
                            <tr> 
                                <th>User</th>
                                <th>Status</th>
                            </tr>
                            </tfoot>
                        </table>';
            echo '<div class="alert alert-success" role="alert">Successfully sent to ' . $count . ' users </div>';

        } catch (\TwitterException $e) {

            return "error";
        }
    }

    /**
     * Send twitter message page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sendMessage()
    {
        if (!Data::myPackage('tw')) {
            return view('errors.404');
        }

        return view('twsendmessage');
    }

    /**
     * Auto retweet page
     * @return string
     */
    public function autoRetweet()
    {

        if (!Data::myPackage('tw')) {
            return view('errors.404');
        }

        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');
        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        $count = 0;
        try {
            $mentions = $twitter->request('statuses/mentions_timeline', 'GET');
            echo '<table class="table"><thead><tr><th>User</th><th>Tweet</th><th>Status</th></tr></thead><tbody>';
            foreach ($mentions as $m) {

                echo '<tr>';
                echo '<td>' . $m->user->screen_name . "</td>";
                echo '<td>' . $m->text . "</td>";

                $msg = self::retweetnow($m->id);
                if ($msg == 'success') {
                    $count++;
                    echo '<td>' . $msg . '</td>';
                } else {
                    echo '<td>' . $msg . '</td>';
                }
                echo '</tr>';
            }
            echo '</tbody></table>';
            echo '<div class="alert alert-success" role="alert">Total ' . $count . ' retweeted</div>';


        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Auto retweet page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function autoRetweetIndex()
    {

        if (!Data::myPackage('tw')) {
            return view('errors.404');
        }

        return view('retweet');
    }

    /**
     * Twitter auto reply
     * @param Request $request
     * @return string
     */
    public function autoReply(Request $request)
    {

        if (!Data::myPackage('tw')) {
            return view('errors.404');
        }

        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');
        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        $count = 0;
        $text = $request->text;
        try {
            $mentions = $twitter->request('statuses/mentions_timeline', 'GET');
            echo '<table class="table"><thead><tr><th>User</th><th>Tweet</th><th>Status</th></tr></thead><tbody>';
            foreach ($mentions as $m) {

                echo '<tr>';
                echo '<td>' . $m->user->screen_name . "</td>";
                echo '<td>' . $m->text . "</td>";


                $msg = self::twReplyNow($m->id, $m->user->screen_name, $text);
                if ($msg == 'success') {
                    $count++;
                    echo '<td>' . $msg . '</td>';
                } else {
                    echo '<td>' . $msg . '</td>';
                }
                echo '</tr>';
            }
            echo '</tbody></table>';
            echo '<div class="alert alert-success" role="alert">Total ' . $count . ' replied</div>';


        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    /**
     * @param Request $request
     * @return string
     */
    public static function autoReplyAll(Request $request)
    {
        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');
        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        $count = 0;
        $text = $request->text;
        try {
            $mentions = $twitter->request('statuses/home_timeline', 'GET');
            echo '<table class="table"><thead><tr><th>User</th><th>Tweet</th><th>Status</th></tr></thead><tbody>';
            foreach ($mentions as $m) {

                echo '<tr>';
                echo '<td>' . $m->user->screen_name . "</td>";
                echo '<td>' . $m->text . "</td>";


                $msg = self::twReplyNow($m->id, $m->user->screen_name, $text);
                if ($msg == 'success') {
                    $count++;
                    echo '<td>' . $msg . '</td>';
                } else {
                    echo '<td>' . $msg . '</td>';
                }
                echo '</tr>';
            }
            echo '</tbody></table>';
            echo '<div class="alert alert-success" role="alert">Total ' . $count . ' replied</div>';


        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function autoReplyIndex()
    {
        if (!Data::myPackage('tw')) {
            return view('errors.404');
        }

        return view('reply');
    }

    /**
     *
     */
    public function massMegaSendIndex()
    {
        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');

        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);

        $list = $twitter->loadUserFollowersList('OfficialMrAkash');
        print_r($list);


    }


    /**
     * Page for auto retweet by hashtag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function autoRetweetHashTagIndex()
    {
        if (!Data::myPackage('tw')) {
            return view('errors.404');
        }

        return view('twitter.autoRetweetHashtag');
    }

    public function retweetHashtag(Request $request)
    {
        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');

        $query = $request->hashtag;
        $limit = 50;


        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);

        $data = $twitter->request('search/tweets', 'GET', array('q' => "#" . $query, 'count' => $limit));


        echo '<div class="box-footer box-comments">';
        foreach ($data as $no => $d) {
            foreach ($d as $i => $content) {
                if (isset($content->text)) {
                    self::retweetnow($content->id);
                    echo '
                    <div class="box-comment">
                <!-- User image -->
                <img class="img-circle img-sm" src="' . $content->user->profile_image_url . '" alt="User Image">

                <div class="comment-text">
                      <span class="username">
                        ' . $content->user->name . '
                        <sapan class="text-muted pull-right">' . Carbon::parse($content->created_at)->toDateTimeString() . '</span>
                      </span>
                      ' . $content->text . '
              </div>
              
                    ';

                }
            }
        }
        echo "</div>";
//        print_r($data->statuses);

//        return response()->json([
//            'status' => 'success',
//            'content' => $data
//        ]);
    }


}
