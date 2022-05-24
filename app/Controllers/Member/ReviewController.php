<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\Shipping;

class ReviewController extends BaseController
{
    public function index($shippingId)
    {
        $orders = (new Order())->withProduct()->withImages()->where('shipping_id', $shippingId)->get()->getResultObject();

        return view('member/pages/review/index', compact('orders'));
    }

    public function edit($shippingId, $productId)
    {
        $product  = (object) (new Product())->withImages()->where('product_id', $productId)->first();
        $shipping = (object) (new Shipping())->where('id', $shippingId)->first();
        $order    = (object) (new Order())->where('shipping_id', $shipping->id)->where('product_id', $product->id)->first();

        return view('member/pages/review/form', compact('product', 'shipping', 'order'));
    }

    public function store($shippingId, $productId)
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            'star' => [
                'rules' => 'required',
            ],
            'description' => [
                'rules' => 'required',
            ],
        ]);

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        (new Review())->insert([
            "user_id"     => session()->get('user')->id,
            "product_id"  => $productId,
            "shipping_id" => $shippingId,
            "star"        => $this->request->getVar('star'),
            "description" => $this->request->getVar('description'),
        ]);

        return redirect()->to(route_to('member.reviews.index', $shippingId))->with('success', 'Barang berhasil di review');
    }
}
