<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\ShippingCost;

class CheckoutController extends BaseController
{
    public function index()
    {
        $shippingCosts = (new ShippingCost())->get()->getResultObject();
        $carts         = (new Cart())->where('user_id', session()->get('user')->id)->withProduct()->withImages()->get()->getResultObject();

        return view('member/pages/checkout/index', compact('shippingCosts', 'carts'));
    }

    public function store()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            'payment_option' => [
                'rules' => 'required',
            ],
            'name' => [
                'rules' => 'required',
            ],
            'email' => [
                'rules' => 'required',
            ],
            'address' => [
                'rules' => 'required',
            ],
            'phone' => [
                'rules' => 'required',
            ],
        ]);

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        $cart     = new Cart();
        $order    = new Order();
        $shipping = new Shipping();

        $cartData = (object) $cart->where('user_id', session()->get('user')->id)->withProduct()->withImages()->get()->getResultObject();
        $data     = [];

        foreach ($cartData as $cartDatum) {
            $data[] = [
                "user_id"    => session()->get('user')->id,
                "product_id" => $cartDatum->product_id,
                "quantity"   => $cartDatum->quantity,
                "weight"     => $cartDatum->weight,
                "price"      => $cartDatum->price,
            ];
        }

        $total = array_reduce($data, function ($initial, $cart) {
            return $initial + $cart['price'];
        }, 0);

        $weight = array_reduce($data, function ($initial, $cart) {
            return $initial + $cart['weight'];
        }, 0);

        try {
            $shipping->insert(array_merge($this->request->getVar(), [
                "user_id" => session()->get('user')->id,
                "area_id" => $this->request->getVar('area_id'),
                "status" => Shipping::STATUS_ON_PROGRESS,
                "total" => $total,
                "weight" => $weight,
            ]));

            $data = array_map(function ($cart) use ($shipping) {
                $cart['shipping_id'] = $shipping->getInsertID();

                return $cart;
            }, $data);

            $order->insertBatch($data);
            $cart->where('user_id', session()->get('user')->id)->delete();

        } catch (\ReflectionException $e) {
            var_dump($e->getMessage());
        }

        return redirect()->route('home')->with('success', 'Barang berhasil di pesan');
    }
}
