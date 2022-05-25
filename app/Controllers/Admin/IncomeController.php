<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Shipping;

class IncomeController extends BaseController
{
    public function index()
    {
        $shippings = (new Shipping())->where('finished', 1)->get()->getResultObject();

        return view('admin/pages/income/index', compact('shippings'));
    }
}
