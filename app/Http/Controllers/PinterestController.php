<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use seregazhuk\PinterestBot\Factories\PinterestBot;

class PinterestController extends Controller
{


    public function index()
    {
        $bot = PinterestBot::create();

        // Login

        $bot->auth->login('prappo.prince@gmail.com', 'prappoprincelogin', false);

        // Get lists of your boards
        $boards = $bot->boards->forMe();
        print_r($boards);


    }

    /**
     * Pinterest scraper page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function scraperIndex()
    {
        if (!Data::myPackage('pinterest')) {
            return view('errors.404');
        }

        return view('pinterest.pinScraper');
    }


    /**
     * Pinterest Home page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        if (!Data::myPackage('pinterest')) {
            return view('errors.404');
        }


        $pinterest = PinterestBot::create();
        $pinterest->auth->login(Data::get('pinUser'), Data::get('pinPass'));
        $pins = $pinterest->pins->feed();

        return view('pinterest.home', compact('pins'));


    }

    /**
     *
     * Write post to pinterest
     * @param Request $request
     * @return string
     */
    public function write(Request $request)
    {
        try {
            $pinterest = PinterestBot::create();
            $pinterest->auth->login(Data::get('pinUser'), Data::get('pinPass'));
//            $pinterest->pins->create(public_path('/uploads') . '/' . $request->image, $request->boardId, $request->message, $request->siteUrl);
            $boards = $pinterest->boards->forMe();

// Create a pin
            $pinterest->pins->create(public_path('/uploads') . '/' . $request->image, $request->boardId, $request->message);

            return "success";

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


    /**
     * Pinterest scraper
     * @param Request $request
     */
    public function scraper(Request $request)
    {
        $pinterest = PinterestBot::create();
        $pinterest->auth->login(Data::get('pinUser'), Data::get('pinPass'));

        // show pins


        if ($request->type == "pins") {
            $pins = $pinterest->pins->search($request->data)->toArray();
            foreach ($pins as $pin) {
                if (isset($pin['pinner']['image_small_url'])) {
                    $image_xlarge_url = $pin['pinner']['image_small_url'];
                } else {
                    $image_xlarge_url = "";
                }

                echo '
                <div class="row">
                <div class="col-md-6">
          <!-- Box Comment -->
          <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="' . $image_xlarge_url . '" alt="User Image">
                <span class="username"><a target="_blank" href="https://www.pinterest.com/' . $pin['pinner']['username'] . '">' . $pin['pinner']['full_name'] . '</a></span>
                <span class="description">' . Carbon::parse($pin['created_at'])->diffForHumans() . ' ( ' . Carbon::parse($pin['created_at'])->toDateTimeString() . ' ) </span>
              </div>
              <!-- /.user-block -->
              
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <a href="https://www.pinterest.com/pin/' . $pin['id'] . '" target="_blank" class="username">' . $pin['rich_summary']['display_name'] . '</a>
              <img class="img-responsive pad" src="' . $pin['images']['736x']['url'] . '" alt="Photo">

              <p>' . $pin['description'] . '</p>
              <hr>
             
              <div class="box-body">
              
              </div>
            </div>
            
              <!-- /.box-comment -->
            </div>
            
          </div>
          <!-- /.box -->
        </div></div>
                ';


            }
        } elseif ($request->type == "peoples") {
            $pins = $pinterest->pinners->search($request->data)->toArray();
            foreach ($pins as $pin) {
                echo '
                    <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-red-active">
              <h3 class="widget-user-username">' . $pin['full_name'] . '</h3>
              <h5 class="widget-user-desc">' . $pin['username'] . '</h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="' . $pin['image_medium_url'] . '" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-6 border-right">
                  <div class="description-block">
                    <h5 class="description-header">' . $pin['pin_count'] . '</h5>
                    <span class="description-text">Pins</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6 border-right">
                  <div class="description-block">
                    <h5 class="description-header">' . $pin['follower_count'] . '</h5>
                    <span class="description-text">FOLLOWERS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
               
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div align="center" class="box-footer">
              <img src="' . $pin['pin_thumbnail_urls']['1'] . '">
              <img src="' . $pin['pin_thumbnail_urls']['2'] . '">
              <img src="' . $pin['pin_thumbnail_urls']['3'] . '">
              <img src="' . $pin['pin_thumbnail_urls']['4'] . '">
              </div>
              <div align="center" class="box-footer">
              <a class="btn btn-xs btn-primary" target="_blank" href="https://www.pinterest.com/' . $pin['username'] . '"><i class="fa fa-user"></i> View Profile</a>
              </div>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <div class="col-md-3"></div>
        </div>
                ';

            }
        } elseif ($request->type == "boards") {
            $boards = $pinterest->boards->search($request->data)->toArray();
            foreach ($boards as $board) {
                echo "<div class='row'>";
                echo '
                <div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-red">
              <div class="widget-user-image">
                <img class="img-circle" src="' . $board['owner']['image_medium_url'] . '" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">' . $board['owner']['full_name'] . '</h3>
              <h5 class="widget-user-desc">@' . $board['owner']['username'] . '</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a target="_blank" href="https://www.pinterest.com' . $board['url'] . '">URL <span class="pull-right badge bg-blue">https://www.pinterest.com' . $board['url'] . '</span></a></li>
                <li>
                ' .
                    '<img style="padding:5px" src="' . $board['pin_thumbnail_urls'][0] . '">' .
                    '<img style="padding:5px" src="' . $board['pin_thumbnail_urls'][1] . '">' .
                    '<img style="padding:5px" src="' . $board['pin_thumbnail_urls'][2] . '">' .
                    '<img style="padding:5px" src="' . $board['pin_thumbnail_urls'][3] . '">' .
                    '<img style="padding:5px" src="' . $board['pin_thumbnail_urls'][4] . '">' .


                    '</li>
                
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
                
                ';
                echo "</div>";
            }
        } elseif ($request->type == "inMyPin") {

        }

    }


    /**
     * Show my pins from Pinterest account
     */
    public function myPins()
    {
        if (!Data::myPackage('pinterest')) {
            return view('errors.404');
        }
        $pinterest = PinterestBot::create();
        $pinterest->auth->login(Data::get('pinUser'), Data::get('pinPass'));
        $userName = $pinterest->user->username();

        $pins = $pinterest->pinners->pins($userName)->toArray();

        unset($pins[0]);
//        print_r($pins);
        return view('pinterest.my', compact('pins'));


    }

    public function autoPinIndex()
    {

    }


    public function autoPin(Request $request)
    {
        $blogUrl = $request->blogUrl;
        $keywords = ['cats', 'kittens', 'funny cats', 'cat pictures', 'cats art'];
        $bot = PinterestBot::create();
        $bot->auth->login(Data::get('pinUser'), Data::get('pinPass'));
        if ($bot->user->isBanned()) {
            return "Account has been banned!\n";

        }
// get board id
        $boards = $bot->boards->forUser('my_username');
        $boardId = $boards[0]['id'];
// select image for posting
        $images = glob('images/*.*');
        if (empty($images)) {
            echo "No images for posting\n";
            die();
        }
        $image = $images[0];
// select keyword
        $keyword = $keywords[array_rand($keywords)];
// create a pin
        $bot->pins->create($image, $boardId, $keyword, $blogUrl);
// remove image
        unlink($image);
    }

    public function autoCommentIndex()
    {
        if (!Data::myPackage('pinterest')) {
            return view('errors.404');
        }

        $bot = PinterestBot::create();
        $bot->auth->login(Data::get('pinUser'), Data::get('pinPass'));
        $boards = $bot->boards->forMe();

        return view('pinterest.autoComment', compact('boards'));
    }


    public function autoRepinIndex()
    {
        if (!Data::myPackage('pinterest')) {
            return view('errors.404');
        }

        $bot = PinterestBot::create();
        $bot->auth->login(Data::get('pinUser'), Data::get('pinPass'));
        $boards = $bot->boards->forMe();

        return view('pinterest.autoRepin', compact('boards'));
    }


    public function autoComment(Request $request)
    {
        $comments = explode(",", $request->keywords);
        $bot = PinterestBot::create();
        $bot->auth->login(Data::get('pinUser'), Data::get('pinPass'));

        $pins = $bot->pins->search($request->search)->toArray();
        $count = 0;
        foreach ($pins as $pin) {

            // repin to our board
            $bot->pins->repin($pin['id'], $request->boardId);
            // write a comment
            $comment = $comments[array_rand($comments)];
            $bot->comments->create($pin['id'], $comment);
            $count++;
        }

        return "{$count} Operations Done";
    }


    public function autoRepin(Request $request)
    {

        $bot = PinterestBot::create();
        $bot->auth->login(Data::get('pinUser'), Data::get('pinPass'));

        $pins = $bot->pins->search($request->search)->toArray();
        $count = 0;
        foreach ($pins as $pin) {

            // repin to our board
            $bot->pins->repin($pin['id'], $request->boardId);

            $count++;
        }

        return "{$count} Operations Done";
    }


    public function createBoard(Request $request)
    {
        $bot = PinterestBot::create();
        $bot->auth->login(Data::get('pinUser'), Data::get('pinPass'));
        try {
            $bot->boards->create($request->boardName, $request->boardDescription);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function deleteBoard(Request $request)
    {
        try {
            $bot = PinterestBot::create();
            $bot->auth->login(Data::get('pinUser'), Data::get('pinPass'));
            $bot->boards->delete($request->boardId);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function updateBoard(Request $request)
    {
        try {
            $bot = PinterestBot::create();
            $bot->auth->login(Data::get('pinUser'), Data::get('pinPass'));
            $bot->boards->update($request->boardId, ['name' => $request->boardName, 'description' => $request->boardDescription]);
            return "success";

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

    public static function saveBoards(){

    }

}
