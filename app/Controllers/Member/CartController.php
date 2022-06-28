<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\Cart;

class CartController extends BaseController
{
    public function index()
    {
        $carts = (new Cart())->where('user_id', session()->get('user')->id)
                            ->join('products', 'products.id = carts.product_id')
                            ->select('products.*, products.id AS product_id, carts.*, 
                                   sub_products.price AS sub_product_price, sub_products.stock AS sub_product_stock, 
                                   sub_products.unit AS sub_product_unit,
                                   sub_products.id AS sub_product_id')->withSubProduct()->get()->getResultObject();

        return view('member/pages/cart/index', compact('carts'));
    }

    public function store($productId, $subProductId)
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            'quantity' => [
                'rules' => 'required',
            ],
        ]);

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        try {
            (new Cart())->insert([
                "product_id" => $productId,
                "sub_product_id" => $subProductId,
                "user_id" => session()->get('user')->id,
                "quantity" => $this->request->getVar('quantity')
            ]);
        } catch (\ReflectionException $e) {
            var_dump($e->getMessage());
        }

        return redirect()->route('home')->withInput()->with('success', 'Produk berhasil ditambahkan');
    }

    public function destroy($cartId)
    {
        (new Cart())->delete($cartId);

        return redirect()->back()->withInput()->with('success', 'Produk berhasil dihapus');
    }
}
