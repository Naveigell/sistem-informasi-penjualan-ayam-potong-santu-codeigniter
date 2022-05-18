<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Product;

class ProductController extends BaseController
{
    public function index()
    {
        $products = (new Product())->get()->getResultObject();

        return view('admin/pages/product/index', compact('products'));
    }
}
