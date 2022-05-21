<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function logout()
    {
        session()->destroy();

        return redirect()->route('home');
    }
}
