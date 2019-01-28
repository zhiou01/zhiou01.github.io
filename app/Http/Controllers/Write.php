<?php

namespace App\Http\Controllers;

use App\OptSchedul;
use DB;
use App\Fb;
use App\Tu;
use App\Tw;
use App\Wp;
use App\Fbgr;
use Exception;
use Illuminate\Support\Facades\Auth;
use seregazhuk\PinterestBot\Factories\PinterestBot;
use Tumblr\API;
use App\OptLog;
use App\Allpost;
use App\Setting;
use Facebook\Facebook;
use App\FacebookPages;
use App\facebookGroups;
use Illuminate\Http\Request;
use Happyr\LinkedIn\LinkedIn;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class Write extends Controller
{
    public function __construct()
    {
        \App::setLocale(CoreController::getLang());

    }

    /**
     * Get specific settings field
     * @param $field
     * @return mixed
     */
    public static function get_value($field)
    {
        return DB::table('settings')->where('userId', Auth::user()->id)->value($field);
    }

    /**
     * Writing post page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $fbPages = FacebookPages::where('userId', Auth::user()->id)->get();
        $fbGroups = facebookGroups::where('userId', Auth::user()->id)->get();
        if (Data::myPackage('pinterest')) {
            $bot = PinterestBot::create();
            $bot->auth->login(Data::get('pinUser'), Data::get('pinPass'));
            $boards = $bot->boards->forMe();
        } else {
            $boards = "Not available";
        }


        if (Data::get('liAccessToken') != "") {
            try {
                $liCompanies = LinkedinController::companies()['values'];
            } catch (Exception $exception) {
                $liCompanies = "";
            }

        } else {
            $liCompanies = "";
        }


        return view('write', compact(
            'l',
            'tuBlogName',
            'fbPages',
            'fbGroups',
            'liCompanies',
            'boards'
        ));
    }

    /**
     * Log the post
     *
     * @param Request $re
     */
    public function postWrite(Request $re)
    {

        $title = $re->title;
        $content = $re->data;
        $postId = $re->postId;
        $write = new Allpost();
        $write->title = $title;
        $write->content = $content;
        $write->postId = $postId;
        $write->userId = Auth::user()->id;
        $write->save();
        echo "success";


    }

    /**
     * Delete logged post
     *
     *
     * @param Request $re
     */
    public function delPost(Request $re)
    {
        $id = $re->id;
        try {
            Allpost::where('id', $id)->delete();
            echo "success";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    /**
     * Post to twitter
     *
     * @param Request $re
     */
    public function twWrite(Request $re)
    {
        $content = $re->data;
        $postId = $re->postId;
        $image = public_path() . '/uploads/' . $re->image;

        $consumerKey = self::get_value('twConKey');
        $consumerSecret = self::get_value('twConSec');
        $accessToken = self::get_value('twToken');
        $tokenSecret = self::get_value('twTokenSec');

        if ($re->imagepost == 'yes') {
            try {

                $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);

                $data = $twitter->request($image ? 'statuses/update_with_media' : 'statuses/update', 'POST', array('status' => $content), $image ? array('media[]' => $image) : NULL);

                echo "success";
                if (isset($postId)) {
                    $tw = new Tw();
                    $tw->postId = $postId;
                    $tw->twId = $data->id;
                    $tw->userId = Auth::user()->id;
                    $tw->save();
                }


            } catch (\TwitterException $e) {

                echo $e->getMessage();
            }
        } else {
            try {

                $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);

                $data = $twitter->send($content);

                echo "success";
                if (isset($postId)) {
                    $tw = new Tw();
                    $tw->postId = $postId;
                    $tw->twId = $data->id;
                    $tw->userId = Auth::user()->id;
                    $tw->save();
                }


            } catch (\TwitterException $e) {

                echo $e->getMessage();
            }
        }
    }


    /**
     * Write twitter schedule post
     *
     * @param $spostId
     * @param $simage
     * @param $scontent
     */
    public static function twWriteS($spostId, $simage, $scontent, $type)
    {
        $content = $scontent;
        $postId = $spostId;
        $image = public_path() . '/uploads/' . $simage;
        $userId = OptSchedul::where('postId', $postId)->value('userId');
        $consumerKey = Settings::get('twConKey', $userId);
        $consumerSecret = Settings::get('twConSec', $userId);
        $accessToken = Settings::get('twToken', $userId);
        $tokenSecret = Settings::get('twTokenSec', $userId);

        try {

            $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);

            $data = $twitter->request($image ? 'statuses/update_with_media' : 'statuses/update', 'POST', array('status' => $content), $image ? array('media[]' => $image) : NULL);

            OptSchedul::where('postId', $postId)->update([
                'published' => 'yes'
            ]);

            if (isset($postId)) {
                $tw = new Tw();
                $tw->postId = $postId;
                $tw->twId = $data->id;
                $tw->userId = $userId;
                $tw->save();

            }


        } catch (\TwitterException $e) {

            echo $e->getMessage();
        }

    }

    /**
     * Post to Tumblr
     *
     * @param Request $re
     * @return string
     */
    public function tuWrite(Request $re)
    {
        $blogName = $re->blogName;
        $title = $re->title;
        $content = $re->data;
        $pId = $re->postId;
        $image = url('') . '/uploads/' . $re->image;
        $imagepost = $re->imagepost;
        $caption = $re->caption;
        $consumerKey = self::get_value('tuConKey');
        $consumerSecret = self::get_value('tuConSec');
        $token = self::get_value('tuToken');
        $tokenSecret = self::get_value('tuTokenSec');
        $client = new API\Client($consumerKey, $consumerSecret, $token, $tokenSecret);
        if ($imagepost == 'yes') {
            $data = array(
                "type" => "photo",
                "title" => $title,
                "caption" => $content,
                "source" => $image
            );
        } else {
            $data = array(
                "type" => "text",
                "title" => $title,
                "body" => $content,

            );
        }

        try {

            $postId = $client->createPost($blogName, $data)->id;
            $tu = new Tu();
            $tu->tuId = $postId;
            $tu->postId = $pId;
            $tu->blogName = $blogName;
            $tu->userId = Auth::user()->id;
            $tu->save();
            return "success";

        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    /**
     *
     * Write Tumblr schedule post
     *
     * @param $spostId
     * @param $sblogName
     * @param $stitle
     * @param $scontent
     * @param $simage
     * @param $simagetype
     * @param $type
     */
    public static function tuWriteS($spostId, $sblogName, $stitle, $scontent, $simage, $simagetype, $type)
    {
        $blogName = $sblogName;
        $title = $stitle;
        $content = $scontent;
        $pId = $spostId;

        $userId = OptSchedul::where('postId', $spostId)->value('userId');
        $image = url('') . '/uploads/' . $simage;
        $imagepost = $simagetype;
        $consumerKey = Settings::get('tuConKey', $userId);
        $consumerSecret = Settings::get('tuConSec', $userId);
        $token = Settings::get('tuToken', $userId);
        $tokenSecret = Settings::get('tuTokenSec', $userId);
        $client = new API\Client($consumerKey, $consumerSecret, $token, $tokenSecret);

        if ($imagepost == 'yes') {
            $data = array(
                "type" => "photo",
                "title" => $title,
                "caption" => $content,
                "source" => $image
            );
        } else {
            $data = array(
                "type" => "text",
                "title" => $title,
                "body" => $content,

            );
        }

        try {

            $postId = $client->createPost($blogName, $data)->id;
            echo $postId;
            $tw = new Tw();
            $tw->twId = $postId;
            $tw->postId = $pId;
            $tw->userID = $userId;
            $tw->save();


            OptSchedul::where('postId', $postId)->update([
                'published' => 'yes'
            ]);


        } catch (Exception $e) {

        }

    }

    /**
     * Delete From Tumblr
     * @param Request $re
     */
    public function tuDelete(Request $re)
    {
        $id = $re->id;
        $blogName = $re->blogName;
        $reBlogKey = $re->reBlogKey;

        $consumerKey = self::get_value('tuConKey');
        $consumerSecret = self::get_value('tuConSec');
        $token = self::get_value('tuToken');
        $tokenSecret = self::get_value('tuTokenSec');

        $client = new API\Client($consumerKey, $consumerSecret, $token, $tokenSecret);
        try {
            $client->deletePost($blogName, $id, $reBlogKey);
            echo "success";
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }

    }

    /**
     * Delete from tumblr
     * @param $id
     * @return string
     */
    public static function tuDel($id)
    {

        if (Tu::where('postId', $id)->exists()) {


            $consumerKey = self::get_value('tuConKey');
            $consumerSecret = self::get_value('tuConSec');
            $token = self::get_value('tuToken');
            $tokenSecret = self::get_value('tuTokenSec');
            $tuId = Tu::where('postId', $id)->value('tuId');
            $blogName = Tu::where('postId', $id)->value('blogName');
            $client = new API\Client($consumerKey, $consumerSecret, $token, $tokenSecret);
            try {
                $client->deletePost($blogName, $tuId, "");
                Tu::where('postId', $id)->delete();
                return "success";
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }

    }

    /**
     * Tumblr reblog
     * @param Request $re
     */
    public function tuReblog(Request $re)
    {
        $consumerKey = self::get_value('tuConKey');
        $consumerSecret = self::get_value('tuConSec');
        $token = self::get_value('tuToken');
        $tokenSecret = self::get_value('tuTokenSec');
        $blogName = self::get_value('tuDefBlog');

        $client = new API\Client($consumerKey, $consumerSecret, $token, $tokenSecret);
        try {

            $postId = $re->postId;
            $reblogKey = $re->reblogKey;
            $client->reblogPost($blogName, $postId, $reblogKey);
            echo "success";
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * Edit Tumblr post
     *
     * @param Request $re
     */
    public function tuEdit(Request $re)
    {
        $consumerKey = self::get_value('tuConKey');
        $consumerSecret = self::get_value('tuConSec');
        $token = self::get_value('tuToken');
        $tokenSecret = self::get_value('tuTokenSec');
        $data = array(
            "type" => "text",
            "title" => $re->title,
            "body" => $re->data
        );

        $client = new API\Client($consumerKey, $consumerSecret, $token, $tokenSecret);
        try {
            $postId = $re->postId;
            $blogName = $re->blogName;
            $client->editPost($blogName, $postId, $data);
            echo "success";
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     *
     * Like Tumblr post
     *
     * @param Request $re
     */
    public function tuLike(Request $re)
    {
        $consumerKey = self::get_value('tuConKey');
        $consumerSecret = self::get_value('tuConSec');
        $token = self::get_value('tuToken');
        $tokenSecret = self::get_value('tuTokenSec');
        $client = new API\Client($consumerKey, $consumerSecret, $token, $tokenSecret);
        try {
            $postId = $re->postId;
            $reblogKey = $re->reblogKey;
            $client->like($postId, $reblogKey);
            echo "success";
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     *
     * Follow Tumblr blog
     *
     * @param Request $re
     * @return string
     */
    public function tuFollow(Request $re)
    {
        $consumerKey = self::get_value('tuConKey');
        $consumerSecret = self::get_value('tuConSec');
        $token = self::get_value('tuToken');
        $tokenSecret = self::get_value('tuTokenSec');
        $client = new API\Client($consumerKey, $consumerSecret, $token, $tokenSecret);

        try {
            $client->follow($re->blogName);
            return "success";
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

    /**
     * Post content to facebook
     * @param Request $re
     * @return string
     */
    public function fbWrite(Request $re)
    {

        $config = new Settings();
        $postId = $re->postId;
        $pageId = $re->pageId;
        $accessToken = $re->accessToken;
        $imagepost = $re->imagepost;
        $sharepost = $re->sharepost;
        $imageName = $re->image;


        $imageUrl = url('') . '/uploads/' . $imageName;


        $link = $re->link;
        $caption = $re->caption;
        $name = $re->title;
        $desciption = $re->description;

        $fb = new Facebook([
            'app_id' => $config->config('fbAppId'),
            'app_secret' => $config->config('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);


        if ($imagepost == 'yes') {
            // If user select image type post
            try {
                $content = [
                    "message" => $re->data,
                    "source" => $fb->fileToUpload(public_path() . "/uploads/" . $imageName),
                    "caption" => $caption
                ];
                $post = $fb->post($pageId . "/photos", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbPost = new Fb();
                    $fbPost->postId = $postId;
                    $fbPost->fbId = $id['id'];
                    $fbPost->pageId = $pageId;
                    $fbPost->userId = Auth::user()->id;
                    $fbPost->save();
                }
                return "success";
            } catch (FacebookSDKException $fse) {
                return $fse->getMessage();
            } catch (FacebookResponseException $fre) {
                return $fre->getMessage();
            }
        } else if ($sharepost == 'yes') {
            // if user select share type post

            try {
                $content = [
                    "message" => $re->data,
                    "link" => $link,
                    "picture" => $imageUrl,
                    "name" => $name,
                    "caption" => $caption,
                    "description" => $desciption,
                ];
                $post = $fb->post($pageId . "/feed", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbPost = new Fb();
                    $fbPost->postId = $postId;
                    $fbPost->fbId = $id['id'];
                    $fbPost->pageId = $pageId;
                    $fbPost->userId = Auth::user()->id;
                    $fbPost->save();
                }
                return "success";
            } catch (FacebookSDKException $fse) {

                return $fse->getMessage();
            }
        } else {

            // Text only post

            try {
                $content = [
                    "message" => $re->data
                ];
                $post = $fb->post($pageId . "/feed", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbPost = new Fb();
                    $fbPost->postId = $postId;
                    $fbPost->fbId = $id['id'];
                    $fbPost->pageId = $pageId;
                    $fbPost->userId = Auth::user()->id;
                    $fbPost->save();
                }
                return "success";
            } catch (FacebookSDKException $fse) {

                return $fse->getMessage();
            }
        }


    }

    /**
     * Write post to facebook group
     * @param Request $re
     * @return string
     */
    public function fbgwrite(Request $re)
    {
        $config = new Settings();
        $postId = $re->postId;
        $groupId = $re->groupId;
        $accessToken = Data::get('fbAppToken');
        $imagepost = $re->imagepost;
        $sharepost = $re->sharepost;
        $textpost = $re->textpost;
        $imageName = $re->image;
        $imageUrl = url('') . '/uploads/' . $imageName;
        $link = $re->link;
        $caption = $re->caption;
        $name = $re->title;
        $desciption = $re->description;

        $fb = new Facebook([
            'app_id' => $config->config('fbAppId'),
            'app_secret' => $config->config('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);


        if ($imagepost == 'yes') {
            try {
                $content = [
                    "message" => $re->data,
                    "source" => $fb->fileToUpload(public_path() . "/uploads/" . $imageName),
                    "caption" => $caption
                ];
                $post = $fb->post($groupId . "/photos", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbg = new Fbgr();
                    $fbg->postId = $postId;
                    $fbg->fbId = $id['id'];
                    $fbg->fbGroupId = $groupId;
                    $fbg->userId = Auth::user()->id;
                    $fbg->save();
                    return "success";
                }

            } catch (FacebookSDKException $fse) {
                return $fse->getMessage();
            } catch (Exception $e) {
                return $e->getMessage();
            }
        } else if ($sharepost == 'yes') {

            try {
                $content = [
                    "message" => $re->data,
                    "link" => $link,
                    "picture" => $imageUrl,
                    "name" => $name,
                    "caption" => $caption,
                    "description" => $desciption
                ];
                $post = $fb->post($groupId . "/feed", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbg = new Fbgr();
                    $fbg->postId = $postId;
                    $fbg->fbId = $id['id'];
                    $fbg->fbGroupId = $groupId;
                    $fbg->userId = Auth::user()->id;
                    $fbg->save();

                }
                return "success";
            } catch (FacebookSDKException $fse) {

                return $fse->getMessage();
            }

        } else {
            try {
                $content = [
                    "message" => $re->data
                ];
                $post = $fb->post($groupId . "/feed", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbg = new Fbgr();
                    $fbg->postId = $postId;
                    $fbg->fbId = $id['id'];
                    $fbg->fbGroupId = $groupId;
                    $fbg->userId = Auth::user()->id;
                    $fbg->save();
                }
                return "success";
            } catch (FacebookSDKException $fse) {

                return $fse->getMessage();
            }
        }
    }

    /**
     * Write on linkedin companies.
     *
     * @param Request $request
     * @return array
     */
    public function liWrite(Request $request)
    {
        if ($request->sharepost == 'yes') {
            $validator = validator($request->all(), [
                'linkOfContent' => 'required',
                'companies' => 'required',
            ]);
        } else {
            $validator = validator($request->all(), [
                'content' => 'required'
            ]);
        }

        if ($validator->fails()) {
            return [
                'status' => 'error',
                'error' => $validator->getMessageBag()->all()
            ];
        }

        $linkedIn = new LinkedIn(Data::get('liClientId'), Data::get('liClientSecret'));

        $linkedIn = app('linkedin');

        $request->merge([
            'to' => json_decode(stripcslashes($request->companies))
        ]);

        if ($request->has('to') && $request->to[0] === 'all') {
            $companies = LinkedinController::companies($linkedIn);
        } elseif ($request->has('to') && is_array($request->to)) {
            $companies = array_reduce($request->to, function ($carry, $to) {
                $carry['values'][]['id'] = $to;

                return $carry;
            });
        }

        if (!isset($companies)) {
            return [
                'status' => 'error',
                'error' => 'No company selected'
            ];
        }

        try {
            $this->sendUpdateToLiCompanies($request, $companies, $linkedIn);
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Send update to companies in linkedin API.
     *
     * @param $request
     * @param $companies
     * @param LinkedIn $linkedIn
     * @throws Exception
     */
    protected function sendUpdateToLiCompanies($request, $companies, $linkedIn)
    {
//        if ($request->has('image') && $request->sharepost == 'no') {
//            throw new Exception('Only image posting is not available for linkedin. Rather try Link Post');
//        }

        $body = [
            'json' => [
                'visibility' => [
                    'code' => 'anyone'
                ],
                'comment' => $request->content
            ]
        ];

        if ($request->sharepost == 'yes') {
            $body['json']['content'] = [
                'title' => $request->titleForImage,
                'description' => $request->descriptionOfLink,
                'submitted-url' => $request->linkOfContent,
                'submitted-image-url' => asset("uploads/{$request->image}")
            ];
        } elseif ($request->imagepost == "yes") {
            $body['json']['content'] = [
                'title' => "",
                'submitted-image-url' => asset("uploads/{$request->image}")
            ];
        }

        foreach ($companies['values'] as $company) {
            $linkedIn->post("/v1/companies/{$company['id']}/shares?format=json", $body);
        }
    }

    /**
     *
     * Facebook Schedule post
     *
     * @param $spostId
     * @param $spageId
     * @param $spageToken
     * @param $stitle
     * @param $scaption
     * @param $slink
     * @param $simage
     * @param $sdescription
     * @param $scontent
     * @param $simagetype
     * @param $ssharetype
     * @return string
     */
    public static function fbWriteS($spostId, $spageId, $spageToken, $stitle, $scaption, $slink, $simage, $sdescription, $scontent, $simagetype, $ssharetype, $scheduleType)
    {
        $config = new Settings();

        $postId = $spostId;
        $pageId = $spageId;
        $accessToken = $spageToken;
        $imagepost = $simagetype;
        $sharepost = $ssharetype;

        $imageName = $simage;
        $imageUrl = url('') . '/uploads/' . $imageName;
        $link = $slink;
        $caption = $scaption;
        $name = $stitle;
        $desciption = $sdescription;
        $userId = OptSchedul::where('postId', $postId)->value('userId');
        $fb = new Facebook([
            'app_id' => Settings::get('fbAppId', $userId),
            'app_secret' => Settings::get('fbAppSec', $userId),
            'default_graph_version' => 'v2.6',
        ]);


        if ($imagepost == 'yes') {
            try {
                $content = [
                    "message" => $scontent,
                    "source" => $fb->fileToUpload(public_path() . "/uploads/" . $imageName),
                    "caption" => $caption
                ];
                $post = $fb->post($pageId . "/photos", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbPost = new Fb();
                    $fbPost->postId = $postId;
                    $fbPost->pageId = $pageId;
                    $fbPost->fbId = $id['id'];
                    $fbPost->userId = $userId;
                    $fbPost->save();
                }


                OptSchedul::where('postId', $postId)->update([
                    'published' => 'yes'
                ]);

            } catch (FacebookSDKException $fse) {

            }
        } else if ($sharepost == 'yes') {

            try {
                $content = [
                    "message" => $scontent,
                    "link" => $link,
                    "picture" => $imageUrl,
                    "name" => $name,
                    "caption" => $caption,
                    "description" => $desciption
                ];
                $post = $fb->post($pageId . "/feed", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbPost = new Fb();
                    $fbPost->postId = $postId;
                    $fbPost->pageId = $pageId;
                    $fbPost->fbId = $id['id'];
                    $fbPost->userId = $userId;
                    $fbPost->save();
                }


                OptSchedul::where('postId', $postId)->update([
                    'published' => 'yes'
                ]);
            } catch (FacebookSDKException $fse) {


            }

        } else {
            try {
                $content = [
                    "message" => $scontent
                ];
                $post = $fb->post($pageId . "/feed", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbPost = new Fb();
                    $fbPost->postId = $postId;
                    $fbPost->pageId = $pageId;
                    $fbPost->fbId = $id['id'];
                    $fbPost->userId = $userId;
                    $fbPost->save();
                }


                OptSchedul::where('postId', $postId)->update([
                    'published' => 'yes'
                ]);
            } catch (FacebookSDKException $fse) {

            }
        }

    }


    /**
     *
     * Facebook group post schedule
     *
     * @param $spostId
     * @param $spageId
     * @param $stitle
     * @param $scaption
     * @param $slink
     * @param $simage
     * @param $sdescription
     * @param $scontent
     * @param $simagetype
     * @param $ssharetype
     *
     * write facebook group ( schedule )
     */
    public static function fbgWriteS($spostId, $spageId, $stitle, $scaption, $slink, $simage, $sdescription, $scontent, $simagetype, $ssharetype)
    {
        $config = new Settings();

        $postId = $spostId;
        $pageId = $spageId;
        $accessToken = Data::get('fbAppToken');
        $imagepost = $simagetype;
        $sharepost = $ssharetype;
        $userId = OptSchedul::where('postId', $postId)->value('userId');
        $imageName = $simage;
        $imageUrl = url('') . '/uploads/' . $imageName;
        $link = $slink;
        $caption = $scaption;
        $name = $stitle;
        $desciption = $sdescription;

        $fb = new Facebook([
            'app_id' => Settings::get('fbAppId', $userId),
            'app_secret' => Settings::get('fbAppSec', $userId),
            'default_graph_version' => 'v2.6',
        ]);


        if ($imagepost == 'yes') {

            // for image type post

            try {
                $content = [
                    "message" => $scontent,
                    "source" => $fb->fileToUpload(public_path() . "/uploads/" . $imageName),
                    "caption" => $caption
                ];
                $post = $fb->post($pageId . "/photos", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbPost = new Fb();
                    $fbPost->postId = $postId;
                    $fbPost->pageId = $pageId;
                    $fbPost->fbId = $id['id'];
                    $fbPost->userId = $userId;
                    $fbPost->save();
                }


                OptSchedul::where('postId', $postId)->update([
                    'published' => 'yes'
                ]);

            } catch (FacebookSDKException $fse) {

            }
        } else if ($sharepost == 'yes') {

            // For share type post

            try {
                $content = [
                    "message" => $scontent,
                    "link" => $link,
                    "picture" => $imageUrl,
                    "name" => $name,
                    "caption" => $caption,
                    "description" => $desciption
                ];
                $post = $fb->post($pageId . "/feed", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbPost = new Fb();
                    $fbPost->pageId = $pageId;
                    $fbPost->postId = $postId;
                    $fbPost->fbId = $id['id'];
                    $fbPost->userId = $userId;
                    $fbPost->save();
                }


                OptSchedul::where('postId', $postId)->update([
                    'published' => 'yes'
                ]);
            } catch (FacebookSDKException $fse) {

            }

        } else {
            try {
                $content = [
                    "message" => $scontent
                ];
                $post = $fb->post($pageId . "/feed", $content, $accessToken);
                if (isset($postId)) {
                    $id = $post->getDecodedBody();
                    $fbPost = new Fb();
                    $fbPost->pageId = $pageId;
                    $fbPost->postId = $postId;
                    $fbPost->fbId = $id['id'];
                    $fbPost->userId = $userId;
                    $fbPost->save();
                }


                OptSchedul::where('postId', $postId)->update([
                    'published' => 'yes'
                ]);

            } catch (FacebookSDKException $fse) {


            }
        }


    }


    /**
     *
     * Delete tweet from twitter
     *
     * @param Request $re
     */
    public function twDelete(Request $re)
    {
        $id = $re->id;
        $consumerKey = self::get_value('twConKey');
        $consumerSecret = self::get_value('twConSec');
        $accessToken = self::get_value('twToken');
        $tokenSecret = self::get_value('twTokenSec');

        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        try {
            $twitter->destroy($id);
            echo "success";
        } catch (\TwitterException $te) {
            echo $te->getMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    /**
     *
     * Delete tweets from twitter
     *
     * @param $id
     * @return string
     */
    public static function twDel($id)
    {
        if (Tw::where('postId', $id)->exists()) {
            $twPostId = Tw::where('postId', $id)->value('twId');
            $consumerKey = self::get_value('twConKey');
            $consumerSecret = self::get_value('twConSec');
            $accessToken = self::get_value('twToken');
            $tokenSecret = self::get_value('twTokenSec');

            $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
            try {
                $twitter->destroy($twPostId);
                Tw::where('postId', $id)->delete();
                return "Delete form twitter : success";
            } catch (\TwitterException $te) {
                return "Delete form twitter : error";

            } catch (Exception $e) {
                return "Delete form twitter : error";

            }
        } else {

        }

    }


    /**
     *
     * Get Tumblr's available blogs
     *
     * @param $consumerKey
     * @param $consumerSecret
     * @param $token
     * @param $tokenSecret
     * @return string
     */
    public function tuGetBlogName($consumerKey, $consumerSecret, $token, $tokenSecret)
    {
        $client = new API\Client($consumerKey, $consumerSecret, $token, $tokenSecret);
        $html = "";
        foreach ($client->getUserInfo()->user->blogs as $blog) {
            $html .= "<option value='$blog->name'>" . $blog->name . "</option>" . "\n";
        }
        return $html;
    }

    /**
     * Save post to database
     * @param Request $re
     * @return string
     */
    public function postSave(Request $re)
    {

        $content = $re->data;
        $title = $re->title;
        $postId = $re->postId;
        try {
            $add = new Allpost();
            $add->title = $title;
            $add->content = $content;
            $add->postId = $postId;
            $add->userId = Auth::user()->id;
            $add->save();
            return "success";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


//    instagram post

    /**
     *
     * Write post to instagram
     * @param $postId
     * @param $image
     * @param $caption
     */
    public static function inWriteS($postId, $image, $caption)
    {
        $userId = OptSchedul::where('postId', $postId)->value('userId');
        try {
            $instagram = new \InstagramAPI\Instagram();
            $username = Settings::get('inUser', $userId);
            $password = Settings::get('inPass', $userId);
            $instagram->setUser($username, $password);
            $instagram->uploadPhoto(public_path() . "/uploads/" . $image, $caption);

            OptSchedul::where('postId', $postId)->update([
                'published' => 'yes'
            ]);

        } catch (\Exception $exception) {

        }

    }


    /**
     *
     * Linkedin schedule post
     *
     * @param $postId
     * @param $title
     * @param $image
     * @param $description
     * @param $content
     * @param $imagetype
     * @param $sharepost
     * @param $link
     */
    public static function lnWriteS($postId, $title, $image, $description, $content, $imagetype, $sharepost, $link)
    {

        $linkedIn = new LinkedIn(Data::get('liClientId'), Data::get('liClientSecret'));
        $companies = LinkedinController::companies($linkedIn);
        $body = [
            'json' => [
                'visibility' => [
                    'code' => 'anyone'
                ],
                'comment' => $content
            ]
        ];

        if ($sharepost === 'yes') {
            $body['json']['content'] = [
                'title' => $title,
                'description' => $description,
                'submitted-url' => $link,
                'submitted-image-url' => asset("uploads/{$image}")
            ];
        }

        foreach ($companies['values'] as $company) {
            $linkedIn->post("/v1/companies/{$company['id']}/shares?format=json", $body);
        }
    }


}
