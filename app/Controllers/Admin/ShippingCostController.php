<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ShippingCost;

class ShippingCostController extends BaseController
{
    public function index()
    {
        $shippingCosts = (new ShippingCost())->get()->getResultObject();

        return view('admin/pages/shipping_cost/index', compact('shippingCosts'));
    }

    public function edit($costId)
    {
        $cost = (object) (new ShippingCost())->find($costId);

        return view('admin/pages/shipping_cost/form', compact('cost'));
    }

    public function create()
    {
        return view('admin/pages/shipping_cost/form');
    }

    public function update($costId)
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        $cost = (new ShippingCost())->where('id', $costId)->first();

        try {
            (new ShippingCost())->update($cost['id'], $this->request->getVar());
        } catch (\ReflectionException $e) {
            var_dump($e->getMessage());
        }

        return redirect()->route('admin.shipping-costs.index')->withInput()->with('success', 'Harga Antar berhasil diubah');
    }

    public function store()
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        $cost = new ShippingCost();
        try {
            $cost->insert($this->request->getVar());
        } catch (\ReflectionException $e) {
            var_dump($e->getMessage());
        }

        return redirect()->route('admin.shipping-costs.index')->withInput()->with('success', 'Harga Antar berhasil ditambah');
    }

    private function validator()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            'area' => [
                'rules' => 'required',
            ],
            'cost' => [
                'rules' => 'required',
            ],
        ]);

        return $validator;
    }

    public function destroy($costId)
    {
        (new ShippingCost())->delete($costId);

        return redirect()->route('admin.shipping-costs.index')->withInput()->with('success', 'Harga Antar berhasil dihapus');
    }
}
