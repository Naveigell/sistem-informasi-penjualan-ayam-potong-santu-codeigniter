<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Capital;
use App\Models\Expenditure;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\SubExpenditure;

class ProfitLossReportController extends BaseController
{
    public function index()
    {
        $orders       = $this->calculateOrder();
        $expenditures = $this->calculateExpenditure();
        $capitals     = $this->calculateCapital();

        return view('admin/pages/report/profit_loss/index', compact('orders', 'expenditures', 'capitals'));
    }

    public function print()
    {
        $orders       = $this->calculateOrder();
        $expenditures = $this->calculateExpenditure();
        $capitals     = $this->calculateCapital();

        return view('admin/pages/report/profit_loss/print', compact('orders', 'expenditures', 'capitals'));
    }

    private function calculateCapital()
    {
        $from = $this->request->getVar('from');
        $to   = $this->request->getVar('to');

        $capitals = (new Capital());

        if ($from && $to) {
            $capitals->where("DATE(publish_date) BETWEEN '{$from}' AND '{$to}'");
        }

        return $capitals->get()->getResultObject();
    }

    private function calculateExpenditure()
    {
        $from = $this->request->getVar('from');
        $to   = $this->request->getVar('to');

        $expenditures = (new Expenditure());

        if ($from && $to) {
            $expenditures->where("DATE(publish_date) BETWEEN '{$from}' AND '{$to}'");
        }

        $expenditures    = $expenditures->get()->getResultArray();
        $expendituresIds = array_column($expenditures, 'id');

        return (new SubExpenditure())->whereIn('expenditure_id', count($expendituresIds) > 0 ? $expendituresIds : [''])->get()->getResultObject();
    }

    private function calculateOrder()
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

        $orders = (new Order())->withProduct()->whereIn('shipping_id', count($shippingsIds) > 0 ? $shippingsIds : [''])->get()->getResultObject();

        array_map(function ($order) use (&$temporaryOrders) {
            if (!array_key_exists($order->id, $temporaryOrders)) {
                $temporaryOrders[$order->id] = $order;
            } else {
                $temporaryOrders[$order->id]->quantity += $order->quantity;
            }
        }, $orders);

        return $temporaryOrders;
    }

//    public function calculation()
//    {
//        $from = $this->request->getVar('from');
//        $to   = $this->request->getVar('to');
//
//        $shippings    = (new Shipping());
//        $expenditures = (new Expenditure());
//
//        if ($from && $to) {
//            $shippings->where("DATE(finished_date) BETWEEN '{$from}' AND '{$to}'");
//            $expenditures->where("DATE(publish_date) BETWEEN '{$from}' AND '{$to}'");
//        }
//
//        $shippings    = $shippings->where('finished', 1)->get()->getResultArray();
//        $expenditures = $expenditures->get()->getResultArray();
//
//        $finances = array_merge($shippings, $expenditures);
//
//        usort($finances, function ($first, $second) {
//            if (array_key_exists('finished_date', $first)) {
//                $firstDate = $first['finished_date'];
//            } else {
//                $firstDate = $first['publish_date'];
//            }
//
//            if (array_key_exists('finished_date', $second)) {
//                $secondDate = $second['finished_date'];
//            } else {
//                $secondDate = $second['publish_date'];
//            }
//
//            return strtotime($firstDate) - strtotime($secondDate);
//        });
//
//        $finances = array_map(function ($item) {
//
//            if (array_key_exists('finished_date', $item)) {
//                $item['date'] = $item['finished_date'];
//
//                return (object) $item;
//            }
//
//            $item['date'] = $item['publish_date'];
//
//            return (object) $item;
//        }, $finances);
//
//        return $finances;
//    }
}
