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

        $orders = (new Order())->withProduct()->withSubProduct()->withImages()->whereIn('shipping_id', count($shippingsIds) > 0 ? $shippingsIds : [''])->get()->getResultObject();

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
