<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\ShippingHistory;
use App\Models\SubProduct;

class ShippingController extends BaseController
{
    public function finish($shippingId)
    {
        (new Shipping())->update($shippingId, [
            "finished"      => 1,
            "finished_date" => date('Y-m-d H:i:s'),
        ]);

        $orders = (new Order())->join('products', 'products.id = orders.product_id')->select('products.*, products.id AS product_id, orders.*,
                                       sub_products.price AS sub_product_price, sub_products.stock AS sub_product_stock, 
                                       sub_products.unit AS sub_product_unit,
                                       sub_products.id AS sub_product_id')->withSubProduct()->where('shipping_id', $shippingId)->get()->getResultObject();

        foreach ($orders as $order) {
            $subProduct = (new SubProduct())->where('id', $order->sub_product_id)->first();

            (new SubProduct())->update($order->sub_product_id, [
                "stock" => $subProduct['stock'] - $order->quantity,
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
