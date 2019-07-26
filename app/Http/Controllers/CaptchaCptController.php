<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator, Redirect, Session, Captcha;

class CaptchaCptController extends Controller
{
    public function cpt(Request $request) {

        $rules = [
            "cpt" => 'required|captcha'
        ];
        $messages = [
            'cpt.required' => __('msg.input_captcha'),
            'cpt.captcha' => __('msg.captcha_err2')
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if($validator->fails()) {
        	return $validator;
        } else {
            return __('msg.captcha_ok');
        }

    }
}
