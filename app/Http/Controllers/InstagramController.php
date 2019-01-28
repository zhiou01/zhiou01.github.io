<?php

namespace App\Http\Controllers;

use Facebook\HttpClients\FacebookGuzzleHttpClient;
use Guzzle\Http\Client;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;


class InstagramController extends Controller
{
    public $instagram;

    public function __construct()
    {
        \InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;

    }

    /**
     * My feed
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (!Data::myPackage('in')) {
            return view('errors.404');
        }
        \InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;

        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;

        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }
        try {
            $data = $ig->timeline->getSelfUserFeed();
            $datas = $data->asStdClass();


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }
        return view('instagram', compact('datas'));
    }

    /**
     * Home page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        if (!Data::myPackage('in')) {
            return view('errors.404');


        }

        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;

        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }
        try {
            $data = $ig->timeline->getTimelineFeed();
            $datas = $data->asStdClass();


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }


        return view('instagramTimeline', compact('datas'));
    }


    /**
     * Popular feed according to user likes and views
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function popular()
    {
        if (!Data::myPackage('in')) {
            return view('errors.404');
        }

        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;

        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }
        try {
            $data = $ig->discover->getExploreFeed();
            $datas = $data->asArray();


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }


        return view('instagramPopular', compact('datas'));
    }


    /**
     * Get the users activity whome we follow
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFollowingUserActivity()
    {
        if (!Data::myPackage('in')) {
            return view('errors.404');
        }

        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;

        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }
        try {
            $data = $ig->people->getFollowingRecentActivity();
            $datas = $data->asStdClass();
//            print_r($datas);


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }

        return view('instagramFollowingActivity', compact('datas'));
    }


    /**
     * Write new post to instagram
     * @param Request $request
     * @return string
     */
    public function write(Request $request)
    {

        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;
        $photoFilename = public_path() . "/uploads/" . $request->image;

        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }
        try {
//            $ig->timeline->uploadPhoto(public_path() . "/uploads/" . $request->image, $request->caption);
            $photo = new \InstagramAPI\Media\Photo\InstagramPhoto($photoFilename);
            $ig->timeline->uploadPhoto($photo->getFile(), ['caption' => $request->caption]);
            return "success";


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }


//        try {
//            $this->instagram->uploadPhoto(public_path() . "/uploads/" . $request->image, $request->caption);
//            return "success";
//        } catch (\Exception $exception) {
//            return $exception->getMessage();
//        }

    }

    /**
     * Post image to instagram
     * @param $image
     * @param $caption
     * @return string
     */
    public function writef($image, $caption)
    {
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;
        $photoFilename = public_path() . "/uploads/" . $image;

        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }
        try {

            $photo = new \InstagramAPI\Media\Photo\InstagramPhoto($photoFilename);
            $ig->timeline->uploadPhoto($photo->getFile(), ['caption' => $caption]);
            return "success";


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }
    }

    /**
     * Delete a post from instagram
     * @param Request $request
     * @return string
     */
    public function delete(Request $request)
    {

        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;


        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }
        try {


            $ig->media->delete($request->id);
            return "success";


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }


    }

    /**
     *
     * Delete Media
     * @param $id
     * @return string
     */
    public function deletef($id)
    {

        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;


        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }
        try {


            $ig->media->delete($id);
            return "success";


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }

    }

    /**
     *
     * Like a post
     * @param Request $request
     * @return string
     */
    public function like(Request $request)
    {
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;


        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }
        try {


            $ig->media->like($request->id);
            return "success";


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }

    }

    /**
     * Like a media
     * @param $id
     * @return string
     */
    public function likef($id)
    {
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;


        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }
        try {

            $ig->media->like($id);
            return "success";

        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }

    }

    /**
     *
     * Comment on media on instagram
     * @param Request $request
     * @return string
     */
    public function comment(Request $request)
    {
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;


        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }
        try {


            $ig->media->comment($request->id, $request->text);
            return "success";


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }

    }

    /**
     *
     * Comment on Media on instagram
     * @param $id
     * @param $text
     * @return string
     */
    public function commentf($id, $text)
    {

        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;


        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }
        try {


            $ig->media->comment($id, $text);
            return "success";


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }

    }

    /**
     *
     * Follow user
     * @param Request $request
     * @return string
     */
    public function follow(Request $request)
    {

        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;


        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }
        try {


            $ig->people->follow($request->userId);
            return "success";


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }

    }

    /**
     *
     * Follow user for specific functionality
     * @param $userId
     * @return string
     */
    public function followf($userId)
    {
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;


        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }
        try {


            $ig->people->follow($userId);
            return "success";


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }
    }

    /**
     * Unfollow a user
     * @param Request $request
     * @return string
     */
    public function unfollow(Request $request)
    {
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;


        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }
        try {


            $ig->people->unfollow($request->userId);
            return "success";


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }

    }


    /**
     *
     * Send message to user
     *
     * @param array $ids
     * @param $messgae
     * @return string
     */
    public function messagef($ids = array(), $messgae)
    {
        if ($messgae == "") {
            return "Message can't be empty";
        }

        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;


        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }
        try {


            $ig->direct->sendText($ids, $messgae);
            return "success";


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }


    }

    /**
     *
     * Send message to user
     * @param Request $request
     * @return string
     */
    public function message(Request $request)
    {
        if ($request->messgae == "") {
            return "Message can't be empty";
        }

        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;


        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }
        try {


            $ig->direct->sendText($request->ids, $request->messgae);
            return "success";


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }

    }


    /**
     *
     * Show posts home page / index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMediaInfoIndex()
    {
        if (!Data::myPackage('in')) {
            return view('errors.404');
        }

        return view('instagramMediaInfo');
    }

    /**
     * Get media informations
     *
     */
    public function getMediaInfo($mediaId)
    {
        if (!Data::myPackage('in')) {
            return view('errors.404');
        }




        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;


        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }
        try {


            $datas = $ig->media->getInfo($mediaId);
            $d = $datas->asStdClass();


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }


        $data = $d->items[0];
//        print_r($data);

        return view('instagramMediaInfo', compact('data'));
    }

    /**
     *
     * Show users followers
     *
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function followers()
    {
        if (!Data::myPackage('in')) {
            return view('errors.404');
        }


        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;


        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }

        try {

            $rankToken = \InstagramAPI\Signatures::generateUUID();
            $data = $ig->people->getSelfFollowers($rankToken);
            $datas = $data->asStdClass();


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }
        return view('instagramFollowers', compact('datas'));


    }

    /**
     *
     * Show following
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function following()
    {
        if (!Data::myPackage('in')) {
            return view('errors.404');
        }

        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;


        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }

        try {

            $rankToken = \InstagramAPI\Signatures::generateUUID();
            $data = $ig->people->getSelfFollowing($rankToken);
            $datas = $data->asStdClass();
//            print_r($datas);


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }

        return view('instagramFollowing', compact('datas'));
    }

    /**
     *
     * Follow back to user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function followBack()
    {


        if (!Data::myPackage('in')) {
            return view('errors.404');
        }


        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;


        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }

        try {

            $rankToken = \InstagramAPI\Signatures::generateUUID();
            $data = $ig->people->getSelfFollowers($rankToken);
            $datas = $data->asStdClass();
            $count = 0;
            foreach ($datas->users as $d) {
                try {
                    $ig->people->follow($d->pk);
                    $count++;
                } catch (\Exception $exception) {

                }
            }
            return "Now you are following $count users";


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }

    }

    /**
     *
     * Follow users by tags
     *
     * @param Request $request
     * @return string
     */
    public function followByTag(Request $request)
    {
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;


        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }

        try {

            $rankToken = \InstagramAPI\Signatures::generateUUID();
            $data = $ig->hashtag->getFeed($request->tag, $rankToken);
            $datas = $data->asStdClass();
            $count = 0;
            foreach ($datas->ranked_items as $d) {
                try {
                    $ig->people->follow($d->user->pk);
                    $count++;
                } catch (\Exception $exception) {

                }
            }


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }

        return "You are following $count user";


    }

    /**
     *
     * Unfollow all users
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function unfollowAll()
    {
        if (!Data::myPackage('in')) {
            return view('errors.404');
        }


        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;


        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }

        try {

            $rankToken = \InstagramAPI\Signatures::generateUUID();
            $data = $ig->people->getSelfFollowers($rankToken);
            $datas = $data->asStdClass();
            $count = 0;
            foreach ($datas->users as $d) {
                try {
                    $ig->people->unfollow($d->user->pk);
                    $count++;
                } catch (\Exception $exception) {

                }
            }


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }

        return "Unfollowed $count users";

    }

    /**
     *
     * Auto comment to instagram post
     *
     * @param Request $request
     * @return string
     */
    public function autoComment(Request $request)
    {

        $count = 0;

        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;


        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        $rankToken = \InstagramAPI\Signatures::generateUUID();
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }


        if ($request->type == "home") {
            $data = $ig->timeline->getTimelineFeed();
            $datas = $data->asStdClass();
            foreach ($datas->feed_items as $data) {
                if (isset($data->media_or_ad)) {
                    $ig->media->comment($data->media_or_ad->id, $request->comment);
                    $count++;
                }

            }
            return "Commented on $count home posts";
        } elseif ($request->type == "popular") {
            $data = $ig->discover->getExploreFeed();
            $datas = $data->asArray();
            foreach ($datas['items'] as $data) {
                $ig->media->comment($data['id'], $request->comment);
                $count++;
            }
            return "Commented on $count popular posts";
        } elseif ($request->type == "self") {
            $data = $ig->timeline->getSelfUserFeed();
            $datas = $data->asStdClass();
            foreach ($datas->items as $data) {
                $ig->media->comment($data->id, $request->comment);
                $count++;
            }
            return "Commented on $count self posts";
        } elseif ($request->type == "hashtag") {
            $data = $ig->hashtag->getFeed($request->tag, $rankToken);
            $datas = $data->asStdClass();
            foreach ($datas->ranked_items as $data) {
                $ig->media->comment($data->id, $request->comment);
                $count++;
            }
            return "Commented on $count hashtag posts";
        }
    }

    /**
     * Instagram scraper
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function scraper(Request $request)
    {

        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;


        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        $rankToken = \InstagramAPI\Signatures::generateUUID();
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }


        if ($request->type == "tag") {
            $data = $ig->hashtag->getFeed($request->data,$rankToken);
            $datas = $data->asStdClass();
            return view('instaGetHashTagFeed', compact('datas'));
        } elseif ($request->type == "user") {
            $data = $ig->people->search($request->data);
            $datas = $data->asStdClass();
            return view('instaSearchUsers', compact('datas'));
        }
    }


    public function getTagFeed()
    {

    }

    public function test()
    {
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        $debug = false;
        $truncatedDebug = false;


        $ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        try {
            $ig->login($username, $password);
        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
            exit(0);
        }

        try {

            $rankToken = \InstagramAPI\Signatures::generateUUID();
            $data = $ig->hashtag->getFeed("food", $rankToken);
            $datas = $data->asStdClass();
//            print_r($datas);

            return view('instaGetHashTagFeed', compact('datas'));


        } catch (\Exception $e) {
            echo 'Something went wrong: ' . $e->getMessage() . "\n";
        }


//        $insta = $this->instagram;
//        $datas = $insta->getHashtagFeed($request->tag);
//        $numberOfResults = $datas->num_results;
//        $count = 0;
//        foreach ($datas->ranked_items as $data) {
//            try {
//                $insta->follow($data->user->pk);
//                $count++;
//            } catch (\Exception $exception) {
//            }
//
//
//        }
//        return "Number of top ranked results $numberOfResults and you are following $count user";
    }

}
