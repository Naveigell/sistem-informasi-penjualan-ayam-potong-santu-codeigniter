<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Shipping;

class ShippingController extends BaseController
{
    public function index()
    {
        $shippings = (object) (new Shipping())->withUser()->withPayment()->get()->getResultObject();

        return view('admin/pages/shipping/index', compact('shippings'));
    }

    public function edit($shippingId)
    {
        $orders   = (new Order())->where('shipping_id', $shippingId)->withProduct()->withImages()->get()->getResultObject();
        $shipping = (object) (new Shipping())->withArea()->withPayment()->where('shippings.id', $shippingId)->first();

        return view('admin/pages/shipping/form', compact('orders', 'shipping'));
    }

    public function update($shippingId)
    {
        $payment = (new Payment())->where('shipping_id', $shippingId)->first();

        (new Payment())->update($payment['id'], [
            "status" => $this->request->getVar('status'),
        ]);

        (new Shipping())->update($shippingId, [
            "status" => Shipping::STATUS_ON_PROGRESS,
        ]);

        return redirect()->route('admin.shippings.index')->withInput()->with('success', 'Validitas berhasil diubah');
    }
}
