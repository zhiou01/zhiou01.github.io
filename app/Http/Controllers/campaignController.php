<?php

namespace App\Http\Controllers;

use App\campaign;
use App\campaignLog;
use App\campaignQueue;
use App\FacebookPages;
use App\scheduleCampaign;
use App\CampSenders;
use App\Sender;
use Facebook\Facebook;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class campaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');


    }

    /**
     * Campaign index page or home page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index()
    {
        if (Data::get('fbAppSec') == "" || Data::get('fbAppId') == "") {
            return redirect('/settings');
        }

        //get facebook pages
        $datas = FacebookPages::where('userId', Auth::user()->id)->get();
        return view('campaing.campShowFbPages', compact('datas'));
    }

//    get users who sent message to the page

    /**
     * @param $pageId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pageUsers($pageId)
    {
        // get facebook page access token

        $accessToken = FacebookPages::where('pageId', $pageId)->value('pageToken');


        try {
            $fb = new Facebook([
                'app_id' => Data::get('fbAppId'),
                'app_secret' => Data::get('fbAppSec'),
                'default_graph_version' => 'v2.6',
            ]);

            // get required data from facebook

            $response = $fb->get('me?fields=conversations.limit(1000){id,senders,updated_time,snippet,unread_count,can_reply,message_count,is_subscribed,link}', $accessToken)->getDecodedBody();


            foreach ($response["conversations"] as $datas) {

                foreach ($datas as $data) {
                    if (isset($data['senders'])) {
                        if ($data['can_reply']) {
                            if (!CampSenders::where('senderId', $data['senders']['data'][0]['id'])->where('pageId', $pageId)->exists()) {
                                $sender = new CampSenders();
                                $sender->userId = Auth::user()->id;
                                $sender->senderId = $data['senders']['data'][0]['id'];
                                $sender->name = $data['senders']['data'][0]['name'];
                                $sender->conId = $data['id'];
                                $sender->pageId = $pageId;
                                $sender->save();
                            }

                        }

                    }

                }
            }
            $datas = $response["conversations"];

        } catch (\Exception $exception) {
            $datas = [];
        }


        return view('campaing.showSenders', compact('datas', 'pageId'));


    }

    public function deleteCustomCampaignListUser(Request $request)
    {
        try {
            campaignQueue::where('id', $request->id)->delete();
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


    /**
     * Show customer list widget
     * @param Request $request
     */
    public function updateCustomCampaignList(Request $request)
    {
//        @HTML content for customer update

        foreach (campaignQueue::where('campId', $request->campId)->get() as $camp) {
            echo '
            <li><span class="text"> &nbsp; ' . CampSenders::where('id', $camp->senderId)->value('name') . '</span>
            <div class="tools">
            <i data-id="' . $camp->id . '" class="fa fa-trash-o"></i>
            </div>
            </li>
            ';
        }

        echo '
        <script>
        $(".fa-trash-o").click(function() {
          var id = $(this).attr("data-id");
          $.ajax({
              type:"POST",
              url:"' . url('/delete/single/user/from/customer/list') . '",
              data:{
               "id":id
              
              },
              success:function(data){
                if(data == "success"){
                    updateCcampaignList(' . $request->campId . ');
                }else{
                    alert(data)                
                }
              },
              error:function(data){
                alert("Something went wrong.");
                console.log(data.responseText);
              }
          })
        });
        </script>
        ';
    }


    /**
     * Add customer ID to the queue for campaign
     * @param Request $request
     * @return string
     */
    public function addToQueue(Request $request)
    {

        if (campaignQueue::where('campId', $request->campId)->where('senderId', $request->id)->exists()) {
            return "You already Added";
        }

        try {
            // insert data to queue table
            $queue = new campaignQueue();
            $queue->campId = $request->campId;
            $queue->senderId = $request->id;
            $queue->userId = Auth::user()->id;
            $queue->status = "pending";
            $queue->save();
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     *
     * Instant send promotion to the target customers ( facebook users )
     * @param Request $request
     * @return string
     */
    public function submitInstant(Request $request)
    {
        $accessToken = FacebookPages::where('pageId', $request->pageId)->value('pageToken');

        $fb = new Facebook([
            'app_id' => Data::get('fbAppId'),
            'app_secret' => Data::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);
        $count = 0;

        // get stored users information and send them promotion

        foreach (CampSenders::where('userId', Auth::user()->id)->where('pageId', $request->pageId)->get() as $sender) {
            try {
                $fb->post($sender->conId . '/messages', ['message' => $request->message], $accessToken);
                $count++;

            } catch (\Exception $exception) {
                ErrorLog::set(Auth::user()->id, $exception->getMessage());
            }
        }
//        log the campaign
        try {
            $log = new campaignLog();
            $log->campName = $request->campName;
            $log->campId = $request->campId;
            $log->pageId = $request->pageId;
            $log->userId = Auth::user()->id;
            $log->save();
        } catch (\Exception $exception) {
        }

        return "Sent message to " . $count . " persons";


    }

    /**
     *
     * Send campaign to Facebook users
     * @param Request $request
     * @return string
     */
    public function submitCustomInstant(Request $request)
    {
        $accessToken = FacebookPages::where('pageId', $request->pageId)->value('pageToken');

        $fb = new Facebook([
            'app_id' => Data::get('fbAppId'),
            'app_secret' => Data::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);
        $count = 0;
        foreach (campaignQueue::where('campId', $request->campId)->get() as $sender) {
            try {
                $conId = CampSenders::where('id', $sender->senderId)->value('conId');
                $fb->post($conId . '/messages', ['message' => $request->message], $accessToken);
                $count++;

            } catch (\Exception $exception) {
                ErrorLog::set(Auth::user()->id, $exception->getMessage());
            }
        }
//        log the campaign
        try {
            $log = new campaignLog();
            $log->campName = $request->campName;
            $log->campId = $request->campId;
            $log->pageId = $request->pageId;
            $log->userId = Auth::user()->id;
            $log->type = "instant";
            $log->save();
        } catch (\Exception $exception) {
        }

        return "Sent message to " . $count . " persons";
    }


    /**
     *
     * Send message to the single facebook user
     * @param Request $request
     * @return string
     */
    public function sendSingleMessage(Request $request)
    {
        $accessToken = FacebookPages::where('pageId', $request->pageId)->value('pageToken');

        $fb = new Facebook([
            'app_id' => Data::get('fbAppId'),
            'app_secret' => Data::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);

        try {
            $fb->post($request->conId . '/messages', ['message' => $request->message], $accessToken);
            return "success";

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Scheduling campaign
     * @param Request $request
     * @return string
     */
    public function campaignScheduleAll(Request $request)
    {

        try {
            // insert data to table for schedule campaign

            $schedule = new scheduleCampaign();
            $schedule->campName = $request->campName;
            $schedule->campId = $request->campId;
            $schedule->userId = Auth::user()->id;
            $schedule->pageId = $request->pageId;
            $schedule->time = $request->time;
            $schedule->status = "pending";
            $schedule->content = $request->data;

            $schedule->save();

            // Log campaign

            $log = new campaignLog();
            $log->campName = $request->campName;
            $log->campId = $request->campId;
            $log->pageId = $request->pageId;
            $log->userId = Auth::user()->id;
            $log->type = "schedule";
            $log->save();


            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


}
