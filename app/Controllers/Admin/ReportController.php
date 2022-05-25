<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Expenditure;
use App\Models\Shipping;

class ReportController extends BaseController
{
    public function index()
    {
        $finances = $this->calculation();

        return view('admin/pages/report/index', compact('finances'));
    }

    public function print()
    {
        $finances = $this->calculation();

        return view('admin/pages/report/print', compact('finances'));
    }

    public function calculation()
    {
        $from = $this->request->getVar('from');
        $to   = $this->request->getVar('to');

        $shippings    = (new Shipping());
        $expenditures = (new Expenditure());

        if ($from && $to) {
            $shippings->where("DATE(finished_date) BETWEEN '{$from}' AND '{$to}'");
            $expenditures->where("DATE(publish_date) BETWEEN '{$from}' AND '{$to}'");
        }

        $shippings    = $shippings->get()->getResultArray();
        $expenditures = $expenditures->get()->getResultArray();

        $finances = array_merge($shippings, $expenditures);

        usort($finances, function ($first, $second) {
            if (array_key_exists('finished_date', $first)) {
                $firstDate = $first['finished_date'];
            } else {
                $firstDate = $first['publish_date'];
            }

            if (array_key_exists('finished_date', $second)) {
                $secondDate = $second['finished_date'];
            } else {
                $secondDate = $second['publish_date'];
            }

            return strtotime($firstDate) - strtotime($secondDate);
        });

        $finances = array_map(function ($item) {

            if (array_key_exists('finished_date', $item)) {
                $item['date'] = $item['finished_date'];

                return (object) $item;
            }

            $item['date'] = $item['publish_date'];

            return (object) $item;
        }, $finances);

        return $finances;
    }
}
