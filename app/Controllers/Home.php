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
        $products = (object) (new Product())->where('category_id', $category->id)->get()->getResultObject();

        return view('category', compact('products', 'category'));
    }

    public function detail($categorySlug, $productSlug)
    {
        $product = (object) (new Product())->where('slug', $productSlug)->first();
        $reviews = (new Review())->where('product_id', $product->id)->withUser()->get()->getResultObject();

        $reviewsValue = $this->calculateReviews($product->id);
        $reviewsValue = floor($reviewsValue);

        return view('detail', compact('product', 'reviews', 'categorySlug', 'productSlug', 'reviewsValue'));
    }

    private function calculateReviews($productId)
    {
        $reviews = (new Review())->where('product_id', $productId)->get()->getResultObject();

        $totalReviews = array_map(function ($review) {
            return $review->star;
        }, $reviews);

        $totalReviews = array_sum($totalReviews);

        if ($totalReviews <= 0) {
            return 0;
        }

        $maxReviewsValue = count($reviews) * 5;

        return 5 - (5 * ($maxReviewsValue - $totalReviews) / $maxReviewsValue);
    }
}
