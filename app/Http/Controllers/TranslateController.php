<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\TranslateClient;

class TranslateController extends Controller
{
    public function translate(Request $request)
    {
        try {
            $text = TranslateClient::translate('en', $request->lang, $request->text);
            return response()->json([
                'status' => 'success',
                'content' => $text
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ]);
        }
    }
}
