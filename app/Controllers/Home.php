<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('admin/pages/dashboard/index');
    }

    public function test()
    {
        return "adsfasdf";
    }
}
