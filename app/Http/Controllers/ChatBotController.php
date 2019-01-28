<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\chatbot;
use App\SlackBot;
use Illuminate\Http\Request;

class ChatBotController extends Controller
{
    public function __construct()
    {
        \App::setLocale(CoreController::getLang());
    }

    /**
     *
     * facebook chat bot index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function fb()
    {
        $data = chatbot::where('userId', Auth::user()->id)->get();

        return view('fbbot', compact('data'));
    }

    public function slack()
    {
        $data = auth()->user()->slackQuestions;

        return view('slackbot', compact('data'));
    }

    /**
     * adding question for auto reply
     * @param Request $re
     * @return string
     */
    public function addQuestion(Request $re)
    {
        /** @var string $question */
        $question = $re->question;
        /** @var string $answer */
        $answer = $re->answer;

        if ($question == "") {
            return "Write some question ";
        }

        if ($answer == "") {
            return "Write question's answer";
        }
        try {

            // saving data
            $data = new chatbot();
            $data->question = $question;
            $data->answer = $answer;
            $data->pageId = $re->pageId;
            $data->userId = Auth::user()->id;
            $data->save();
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete auto reply questions from database
     * @param Request $re
     * @return string
     */
    public function delQuestion(Request $re)
    {
        /** @var int $id */
        $id = $re->id;
        try {
            chatbot::where('id', $id)->where('userId', Auth::user()->id)->delete();
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Add slack questions for slack chat bot
     * @param Request $request
     * @return string
     */
    public function addSlackQuestion(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'answer' => 'required',
            'channel' => 'required',
        ]);

        if ($validator->fails()) {
            return 'error';
        }

        $channels = [];

        foreach ($request->all() as $field => $value) {
            if ($field === 'channel') {
                $values = preg_split("/,/", $value);

                foreach ($values as $v) {
                    $channels[] = '#' . ltrim(trim($v), '#');
                }
            }
        }

        $questions = [];

        foreach ($channels as $channel) {
            $questions[] = array_merge($request->all(), ['channel' => $channel]);
        }

        SlackBot::insert($questions);

    }

    /**
     * Delete slack bot chat questions
     * @param Request $request
     * @return string
     */
    public function deleteSlackQuestion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return 'error';
        }

        SlackBot::findOrFail($request->id)->delete();
    }

    /**
     * Update slack bot settings
     * @param Request $request
     * @return string
     */
    public function updateBotConfig(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'matchAcc' => 'required',
        ]);

        if ($validator->fails()) {
            return 'error';
        }

        Setting::where('userId', Auth::user()->id)->update([
            'slackBotMatchAcc' => $request->matchAcc
        ]);
    }

    /**
     * Logic design for facebook messenger bot reply
     * Check incoming message via webhook with saved message and reply
     * @param $inputText
     * @param $pageId
     * @return mixed|string
     */
    public static function compile($inputText, $pageId)
    {
        if ($pageId == "") {
            return Data::getExceptionMessage($pageId);
        }
        $per = 0;
        $reply = "";
        $text = chatbot::where('pageId', $pageId)->get();
        foreach ($text as $t) {
            // if input message is similar
            similar_text($t->question, $inputText, $per);
            if ($per >= Data::getMatchAcc($pageId)) {
                $reply = $t->answer;
                break;
            } else {
                $reply = Data::getExceptionMessage($pageId);
            }
        }
        return $reply;
    }
}
