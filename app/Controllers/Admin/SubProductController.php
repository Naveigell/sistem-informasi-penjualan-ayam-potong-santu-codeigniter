<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\SubProduct;

class SubProductController extends BaseController
{
    public function index($productId)
    {
        $product     = (object) (new Product())->where('id', $productId)->first();
        $subProducts = (new SubProduct())->where('product_id', $productId)->get()->getResultObject();

        return view('admin/pages/sub_product/index', compact('product', 'subProducts'));
    }

    public function edit($productId, $subProductId)
    {
        $subProduct = (object) (new SubProduct())->where('product_id', $productId)->where('id', $subProductId)->first();
        $product    = (object) (new Product())->where('id', $productId)->first();

        return view('admin/pages/sub_product/form', compact('product', 'subProduct'));
    }

    public function create($productId)
    {
        $product = (object) (new Product())->where('id', $productId)->first();

        return view('admin/pages/sub_product/form', compact('product'));
    }

    public function store($productId)
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        (new SubProduct())->insert(array_merge($this->request->getVar(), [
            "product_id" => $productId,
        ]));

        return redirect()->route('admin.sub-products.index', [$productId])->withInput()->with('success', 'Sub produk berhasil ditambahkan');
    }

    public function update($productId, $subProductId)
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        (new SubProduct())->update($subProductId, array_merge($this->request->getVar(), [
            "product_id" => $productId,
        ]));

        return redirect()->route('admin.sub-products.index', [$productId])->withInput()->with('success', 'Sub produk berhasil diubah');
    }

    public function destroy($productId, $subProductId)
    {
        (new SubProduct())->delete($subProductId);

        return redirect()->route('admin.sub-products.index', [$productId])->withInput()->with('success', 'Sub produk berhasil dihapus');
    }

    private function validator()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            'price' => [
                'rules' => 'required',
            ],
            'stock' => [
                'rules' => 'required',
            ],
            'unit' => [
                'rules' => 'required',
            ],
        ]);

        return $validator;
    }
}
