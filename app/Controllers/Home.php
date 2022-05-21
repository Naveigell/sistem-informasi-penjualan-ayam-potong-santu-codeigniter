<?php

namespace App\Controllers;

use App\Models\Product;

class Home extends BaseController
{
    public function index()
    {
        $products = (new Product())->withImages()->get()->getResultObject();

        return view('home', compact('products'));
    }
}
