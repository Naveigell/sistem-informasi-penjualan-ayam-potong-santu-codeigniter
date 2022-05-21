<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class MemberAuthController extends BaseController
{
    public function login()
    {
        return view('auth/member/login');
    }

    public function doLogin()
    {

    }
}
