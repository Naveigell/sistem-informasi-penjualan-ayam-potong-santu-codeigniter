<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\ShippingHistory;

class ShippingController extends BaseController
{
    public function finish($shippingId)
    {
        (new Shipping())->update($shippingId, [
            "finished" => 1,
        ]);

        $orders = (new Order())->where('shipping_id', $shippingId)->withProduct()->get()->getResultObject();

        foreach ($orders as $order) {
            $product = (new Product())->where('id', $order->product_id)->first();

            (new Product())->update($order->product_id, [
                "stock" => $product['stock'] - $order->quantity,
            ]);
        }

        return redirect()->route('member.payments.index')->withInput()->with('success', 'Pengiriman selesai');
    }

    public function timeline($shippingId)
    {
        $shipping  = (object) (new Shipping())->where('id', $shippingId)->first();
        $histories = (new ShippingHistory())->where('shipping_id', $shippingId)->get()->getResultObject();

        return view('member/pages/shipping/timeline', compact('histories', 'shipping'));
    }
}
