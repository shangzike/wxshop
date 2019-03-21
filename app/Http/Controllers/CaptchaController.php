<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\Captcha;
class CaptchaController extends Controller
{
    public function create()
    {
        $verify=new Captcha();
        $code=$verify->getCode();
        session(['verifycode'=>$code]);
        return $verify->doimg();
    }
}
