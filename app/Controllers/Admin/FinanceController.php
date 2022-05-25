<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class FinanceController extends BaseController
{
    public function index()
    {
        return view('admin/pages/finance/index');
    }
}
