<?php

namespace App\Http\Controllers;

use App\OptSchedul;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function __construct()
    {
        \App::setLocale(CoreController::getLang());

    }


    /**
     * Get scheduled data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = OptSchedul::where('userId', Auth::user()->id)->get();
        return view('schedule', compact('data'));
    }

    /**
     *
     * Add post to schedule queue
     * @param Request $re
     * @return string
     */
    public function addSchedule(Request $re)
    {

        $title = $re->title;
        $caption = $re->caption;
        $link = $re->link;
        $image = $re->image;
        $description = $re->description;
        $status = $re->status;
        $postId = $re->postId;
        $time = $re->time;
        $fb = $re->fb;
        $fbg = $re->fbg;
        $tw = $re->tw;
        $tu = $re->tu;
        $instagram = $re->instagram;
        $linkedin = $re->linkedin;
        $pageId = $re->pageId;
        $pageToken = $re->pageToken;
        $blogName = $re->blogName;
        $groupId = $re->groupId;
        $wp = $re->wp;
        $imagetype = $re->imagetype;
        $sharetype = $re->sharetype;

        if ($status == "") {
            return "Please write something";
        }
        $schedule = new OptSchedul();
        try {
            // save data to database
            $schedule->title = $title;
            $schedule->caption = $caption;
            $schedule->link = $link;
            $schedule->image = $image;
            $schedule->description = $description;
            $schedule->content = $status;
            $schedule->postId = $postId;
            $schedule->time = $time;
            $schedule->fb = $fb;
            $schedule->tw = $tw;
            $schedule->tu = $tu;
            $schedule->fbg = $fbg;
            $schedule->wp = $wp;
            $schedule->instagram = $instagram;
            $schedule->linkedin = $linkedin;
            $schedule->groupId = $groupId;
            $schedule->pageId = $pageId;
            $schedule->pageToken = $pageToken;
            $schedule->blogName = $blogName;
            $schedule->imagetype = $imagetype;
            $schedule->sharetype = $sharetype;
            $schedule->userId = Auth::user()->id;
            $schedule->date = Carbon::parse($time)->format('Y-m-d');
            $schedule->day = $re->day;
            $schedule->save();
            echo "success";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Delete schedule post
     * @param Request $re
     */
    public function sdel(Request $re)
    {

        $id = $re->id;

        try {
            OptSchedul::where('id', $id)->delete();
            echo "success";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Edit schedule post
     * @param Request $re
     * @return string
     */
    public function sedit(Request $re)
    {
        $id = $re->id;
        $title = $re->title;
        $content = $re->data;
        $type = $re->type;
        try {
            OptSchedul::where('id', $id)->update(['title' => $title, 'content' => $content, 'type' => $type]);
            return "success";

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Filter scheduled post by day
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function scheduleDay()
    {
        $startOfWeek = Carbon::now()->startOfWeek()->format('Y-m-d');
        $endOfWeek = Carbon::now()->endOfWeek()->format('Y-m-d');

        $data = $this->getDatesFromRange($startOfWeek, $endOfWeek);
        return view('scheduleFilter', compact('data'));
    }

    /**
     * Filter scheduled post by date
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filter(Request $request)
    {

        if ($request->from == "" || $request->to == "") {
            $startOfWeek = Carbon::now()->startOfWeek()->format('Y-m-d');
            $endOfWeek = Carbon::now()->endOfWeek()->format('Y-m-d');
            $data = $this->getDatesFromRange($startOfWeek, $endOfWeek);
        } else {
            $data = $this->getDatesFromRange($request->from, $request->to);
        }


        return view('scheduleFilter', compact('data', 'days'));
    }

    public function filterIndex(){
        $startOfWeek = Carbon::now()->startOfWeek()->format('Y-m-d');
        $endOfWeek = Carbon::now()->endOfWeek()->format('Y-m-d');

        $data = $this->getDatesFromRange($startOfWeek, $endOfWeek);
        return view('scheduleFilter', compact('data'));
    }

    /**
     * Show this week's scheduled post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filterThisWeek()
    {
        $startOfWeek = Carbon::now()->startOfWeek()->format('Y-m-d');
        $endOfWeek = Carbon::now()->endOfWeek()->format('Y-m-d');

        $data = $this->getDatesFromRange($startOfWeek, $endOfWeek);
        return view('scheduleFilter', compact('data'));
    }

    /**
     * Show this month's schedule post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filterThisMonth()
    {
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d');

        $data = $this->getDatesFromRange($startOfMonth, $endOfMonth);
        return view('scheduleFilter', compact('data'));
    }

    /**
     * Show all scheduled post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allDays()
    {
        $data = OptSchedul::all();
        return view('scheduleDay', compact('data'));

    }

    /**
     * Date range
     * @param $date_time_from
     * @param $date_time_to
     * @return array
     */
    public function getDatesFromRange($date_time_from, $date_time_to)
    {

        // cut hours, because not getting last day when hours of time to is less than hours of time_from
        // see while loop
        $start = Carbon::createFromFormat('Y-m-d', substr($date_time_from, 0, 10));
        $end = Carbon::createFromFormat('Y-m-d', substr($date_time_to, 0, 10));


        $dates = [];

        while ($start->lte($end)) {

            $dates[] = $start->copy()->format('Y-m-d');

            $start->addDay();
        }

        return $dates;
    }

    /**
     * Update scheduled post's time
     * @param Request $request
     * @return string
     */
    public function timeUpdate(Request $request)
    {
        try {
            OptSchedul::where('id', $request->id)->update([
                'time' => Carbon::parse($request->time)->format('Y-m-d H:i'),
                'date' => Carbon::parse($request->time)->format('Y-m-d')

            ]);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Fire scheduled post . When the cron job will hit the url then this function
     * will be executed
     */
    public function fire()
    {

        $carbon = new Carbon();
        $tasks = OptSchedul::all();

        foreach ($tasks as $task) {
            if ($carbon->parse($task->time)) {
                $postTime = $task->time;
                $currentTime = $carbon->now()->format('Y-m-d H:i');

                $timezone = User::where('id', $task->userId)->value('timezone');

                $date = Carbon::createFromFormat('Y-m-d H:i', $postTime, $timezone);
                $date->setTimezone('UTC');
                $realPostTime = $date->format('Y-m-d H:i');

//                Test block start


//                Test block end

                if ($currentTime == $realPostTime) {


                    if ($task->fb == "yes") {

                        Write::fbWriteS($task->postId, $task->pageId, $task->pageToken, $task->title, $task->caption, $task->link, $task->image, $task->description, $task->content, $task->imagetype, $task->sharetype, $realPostTime);
                    }

                    if ($task->fbg == "yes") {
                        Write::fbgWriteS($task->postId, $task->pageId, $task->title, $task->caption, $task->link, $task->image, $task->description, $task->content, $task->imagetype, $task->sharetype);

                    }

                    if ($task->tw == "yes") {
                        Write::twWriteS($task->postId, $task->image, $task->content, $realPostTime);
                    }

                    if ($task->tu == "yes") {
                        Write::tuWriteS($task->postId, $task->blogName, $task->title, $task->content, $task->image, $task->imagetype, $realPostTime);
                    }

                    if ($task->wp == "yes") {
                        Write::wpWriteS($task->postId, $task->title, $task->content);
                    }

                    if ($task->instagram == "yes") {
                        Write::inWriteS($task->postId, $task->image, $task->content);
                    }


                }
            }
        }
    }
}
