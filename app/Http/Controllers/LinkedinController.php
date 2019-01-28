<?php

namespace App\Http\Controllers;

use Exception;
use App\Setting;
use Illuminate\Http\Request;
use Happyr\LinkedIn\LinkedIn;
use Illuminate\Support\Facades\Auth;

class LinkedinController extends Controller
{
    public function __construct()
    {
        \App::setLocale(CoreController::getLang());

    }
    /**
     * Linkedin callback
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function callback()
    {
        $linkedIn = new LinkedIn(Data::get('liClientId'), Data::get('liClientSecret'));

        Setting::where('userId', Auth::id())->update([
            'liAccessToken' => $linkedIn->getAccessToken()
        ]);

        return redirect('/settings');
    }

    /**
     * Get all companies.
     *
     * @param $linkedIn
     * @return mixed
     */
    public static function companies($linkedIn = '')
    {
        if ($linkedIn === '') {
            $linkedIn = app('linkedin');
        }

        return $linkedIn->get('v1/companies?format=json&is-company-admin=true');
    }

    /**
     * Get companies list with it's followers.
     *
     * @return array
     */
    public static function companiesWithDetails($linkedIn = '')
    {
        if ($linkedIn === '') {
            /** @var LinkedIn $linkedIn */
            $linkedIn = app('linkedin');
        }

        $companies = self::companies($linkedIn)['values'];

        // Getting followers for the companies and merging to the companies list array.
        return array_reduce($companies, function ($carry, $company) use ($linkedIn) {
            $carry[] = $linkedIn->get("/v1/companies/{$company['id']}:(id,name,logo-url,num-followers)?format=json");

            return $carry;
        });
    }

    /**
     * Show linkedin mass comment page.
     */
    public function massComment()
    {
        if(!Data::myPackage('ln')){
            return view('errors.404');
        }

        if (!Data::get('liAccessToken')) {
            return redirect('/settings');
        }

        $companies = self::companies()['values'];

        return view('limasscomment', compact('companies'));
    }

    /**
     * Mass comment in action.
     *
     * @param Request $request
     * @return mixed
     */
    public function fireMassComment(Request $request)
    {
        $linkedIn = app('linkedin');

        if ($request->has('to') && $request->to[0] === 'all') {
            $companies = self::companies($linkedIn);
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
            $this->sendCommentToCompanies($request, $companies, $linkedIn);

            return [
                'status' => 'success',
                'msg' => 'Mass comment successful'
            ];
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Send comment to companies in linkedin API.
     *
     * @param Request $request
     * @param $companies
     * @param LinkedIn $linkedIn
     * @return mixed
     * @throws Exception
     */
    protected function sendCommentToCompanies(Request $request, $companies, $linkedIn)
    {
        $body = $this->formatComment($request->comment);

        foreach ($companies['values'] as $company) {
            $allUpdates = $linkedIn->get("/v1/companies/{$company['id']}/updates?format=json");

            if ($allUpdates['_total'] === 0) {
                throw new Exception('No update to add comment');
            }

            if ($request->has('in_all')) {
                $updates = $allUpdates['values'];
            } elseif (is_numeric($request->in_last)) {
                $updates = array_slice($allUpdates['values'], 0, $request->in_last, true);
            }

            if (empty($updates)) {
                throw new Exception('Check in all updates or enter in last update(s) field');
            }

            foreach ($updates as $update) {
                if (!$update['isCommentable']) {
                    continue;
                }

                $this->commentOnUpdate($company['id'], $update['updateKey'], $body);
            }
        }
    }

    /**
     *
     * Fire comment functionality
     *
     * @param Request $request
     * @param $companyId
     * @param updateKey
     */
    public function fireComment(Request $request, $companyId, $updateKey)
    {
        $this->commentOnUpdate($companyId, $updateKey, $this->formatComment($request->comment));
    }

    /**
     * Comment on company updates
     * @param $companyId
     * @param $updateKey
     * @param $body
     */
    public function commentOnUpdate($companyId, $updateKey, $body)
    {
        app('linkedin')->post(
            "/v1/companies/{$companyId}/updates/key={$updateKey}/update-comments-as-company/",
            $body
        );
    }

    /**
     * Show company updates.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function updates()
    {
        if(!Data::myPackage('ln')){
            return view('errors.404');
        }


        if (Data::get('liAccessToken')=="") {
            return redirect('/settings');
        }

        $linkedIn = app('linkedin');
        $companies = self::companies($linkedIn)['values'];

        $updates = [];
        $profile = [];
        foreach ($companies as $company) {
            $updates[] = $linkedIn->get("/v1/companies/{$company['id']}/updates?format=json");
            $profile = $linkedIn->get("/v1/companies/{$company['id']}?format=json");
        }

        if($updates[0]['_total'] == 0){
            return 'No data found';
        }


        $datas = $updates[0]['values'];

        return view('lnupdates', compact('datas'));
    }

    /**
     * @return array
     */
    protected function formatComment($comment)
    {
        return [
            'json' => [
                'comment' => $comment
            ]
        ];
    }

    public function test(){
        $linkedIn = app('linkedin');
        $data = $linkedIn->get('/v1/search?q=food');
        print_r($data);

    }
}
