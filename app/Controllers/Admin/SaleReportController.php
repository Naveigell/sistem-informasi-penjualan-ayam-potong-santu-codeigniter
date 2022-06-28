<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Order;
use App\Models\Shipping;

class SaleReportController extends BaseController
{
    public function index()
    {
        $orders = $this->calculation();

        return view('admin/pages/report/sale/index', compact('orders'));
    }

    public function print()
    {
        $orders = $this->calculation();

        return view('admin/pages/report/sale/print', compact('orders'));
    }

    public function calculation()
    {
        $from = $this->request->getVar('from');
        $to   = $this->request->getVar('to');

        $shippings = (new Shipping());

        if ($from && $to) {
            $shippings->where("DATE(finished_date) BETWEEN '{$from}' AND '{$to}'");
        }

        $shippings    = $shippings->where('finished', 1)->get()->getResultArray();
        $shippingsIds = array_column($shippings, 'id');

        $temporaryOrders = [];

        $orders = (new Order())->join('products', 'products.id = orders.product_id')->select('products.*, products.id AS product_id, orders.*,
                                       sub_products.price AS sub_product_price, sub_products.stock AS sub_product_stock, 
                                       sub_products.unit AS sub_product_unit,
                                       sub_products.id AS sub_product_id')->withSubProduct()->whereIn('shipping_id', count($shippingsIds) > 0 ? $shippingsIds : [''])->get()->getResultObject();

        array_map(function ($order) use (&$temporaryOrders) {
            if (!array_key_exists($order->id, $temporaryOrders)) {
                $temporaryOrders[$order->id] = $order;
            } else {
                $temporaryOrders[$order->id]->quantity += $order->quantity;
            }
        }, $orders);

        return $temporaryOrders;
    }
}
