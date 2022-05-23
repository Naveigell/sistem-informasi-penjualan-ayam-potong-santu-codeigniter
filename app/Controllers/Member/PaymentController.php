<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\Payment;
use App\Models\Shipping;

class PaymentController extends BaseController
{
    public function index()
    {
        $shippings = (new Shipping())->where('user_id', session()->get('user')->id)->get()->getResultObject();

        return view('member/pages/payments/index', compact('shippings'));
    }

    public function edit($shippingId)
    {
        $shipping = (object) (new Shipping())->where('id', $shippingId)->first();

        return view('member/pages/payments/form', compact('shipping'));
    }

    public function store($shippingId)
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            'proof' => [
                'rules' => 'uploaded[proof]|mime_in[proof,image/png,image/jpg,image/jpeg]',
            ],
            'sender_bank' => [
                'rules' => 'required',
            ],
            'sender_account_number' => [
                'rules' => 'required',
            ],
            'merchant_bank' => [
                'rules' => 'required',
            ],
            'sender_name' => [
                'rules' => 'required',
            ],
        ]);

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        $image     = $this->request->getFile('proof');
        $imageName = str_random(40) . '.' . $image->getClientExtension();

        $image->move(ROOTPATH . 'public/uploads/images/payments', $imageName);

        $payment = new Payment();
        try {

            $payment->deleteByShippingId($shippingId);
            $payment->insert(array_merge($this->request->getVar(), [
                "proof" => $imageName,
                "shipping_id" => $shippingId,
                "status" => Payment::STATUS_WAITING,
            ]));

            (new Shipping())->update($shippingId, [
                "status" => Shipping::STATUS_ON_PROGRESS,
            ]);
        } catch (\ReflectionException $e) {
            var_dump($e->getMessage());
        }

        return redirect()->route('member.payments.index')->with('success', 'Barang berhasil di bayar');
    }
}
