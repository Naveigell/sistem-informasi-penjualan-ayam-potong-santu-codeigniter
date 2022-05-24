<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\Shipping;
use App\Models\ShippingHistory;

class ShippingController extends BaseController
{
    public function index()
    {
        //
    }

    public function timeline($shippingId)
    {
        $shipping  = (object) (new Shipping())->where('id', $shippingId)->first();
        $histories = (new ShippingHistory())->where('shipping_id', $shippingId)->get()->getResultObject();

        return view('member/pages/shipping/timeline', compact('histories', 'shipping'));
    }
}
