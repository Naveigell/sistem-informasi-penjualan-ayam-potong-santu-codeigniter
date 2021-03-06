<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Shipping;
use App\Models\ShippingHistory;

class ShippingController extends BaseController
{
    public function index()
    {
        $shippings = (object) (new Shipping())->withUser()->withPayment()->get()->getResultObject();

        return view('admin/pages/shipping/index', compact('shippings'));
    }

    public function edit($shippingId)
    {
        $orders   = (new Order())->where('shipping_id', $shippingId)
                                 ->join('products', 'products.id = orders.product_id')
                                 ->select('products.*, products.id AS product_id, orders.*, 
                                                sub_products.price AS sub_product_price, sub_products.stock AS sub_product_stock, 
                                                sub_products.unit AS sub_product_unit,
                                                sub_products.id AS sub_product_id')->withSubProduct()->get()->getResultObject();
        $shipping = (object) (new Shipping())->withArea()->withPayment()->where('shippings.id', $shippingId)->first();

        // if shipping has finished
        if ($shipping->finished_date) {
            (new Shipping())->update($shippingId, [
                "has_read" => 1,
            ]);
        }

        return view('admin/pages/shipping/form', compact('orders', 'shipping'));
    }

    public function update($shippingId)
    {
        $payment = (new Payment())->where('shipping_id', $shippingId)->first();

        (new Payment())->update($payment['id'], [
            "status" => $this->request->getVar('status'),
        ]);

        (new Shipping())->update($shippingId, [
            "status"        => Shipping::STATUS_ON_PROGRESS,
            "has_read"      => 1,
            "user_has_read" => 0,
        ]);

        return redirect()->route('admin.shippings.index')->withInput()->with('success', 'Validitas berhasil diubah');
    }

    public function status($shippingId)
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            'status' => [
                'rules' => 'required',
            ],
        ]);

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        (new ShippingHistory())->insert([
            "shipping_id"   => $shippingId,
            "description"   => $this->request->getVar('status'),
            "index_id"      => $this->request->getVar('index') ? $this->request->getVar('index') : 0,
            "progress_date" => date('Y-m-d H:i:s'),
        ]);

        (new Shipping())->update($shippingId, [
            "has_read"      => 1,
            "user_has_read" => 0,
        ]);

        return redirect()->route('admin.shippings.index')->withInput()->with('success', 'Berhasil mengubah status produk');
    }
}
