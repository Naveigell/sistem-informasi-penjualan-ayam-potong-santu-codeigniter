<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Review;

class Home extends BaseController
{
    public function index()
    {
        $categories = (new ProductCategory())->get()->getResultObject();

        return view('home', compact('categories'));
    }

    public function category($slug)
    {
        $category = (object) (new ProductCategory())->where('slug', $slug)->first();
        $products = (object) (new Product())->where('category_id', $category->id)->withImages()->get()->getResultObject();

        return view('category', compact('products', 'category'));
    }

    public function detail($categorySlug, $productSlug)
    {
        $product = (object) (new Product())->where('slug', $productSlug)->first();
        $reviews = (new Review())->where('product_id', $product->id)->withUser()->get()->getResultObject();

        return view('detail', compact('product', 'reviews', 'categorySlug', 'productSlug'));
    }
}
