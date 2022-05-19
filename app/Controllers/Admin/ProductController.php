<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\ProductMedia;
use CodeIgniter\Database\BaseConnection;

class ProductController extends BaseController
{
    public function index()
    {
        $products = (new Product())->get()->getResultObject();

        return view('admin/pages/product/index', compact('products'));
    }

    public function edit($productId)
    {
        $product = (object) (new Product())->find($productId);

        return view('admin/pages/product/form', compact('product'));
    }

    public function update($productId)
    {
        dd($productId);
    }

    public function create()
    {
        return view('admin/pages/product/form');
    }

    public function store()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            'image' => [
                'rules' => 'uploaded[image]|mime_in[image,image/png,image/jpg,image/jpeg]',
            ],
            'name' => [
                'rules' => 'required',
            ],
            'weight' => [
                'rules' => 'required',
            ],
            'price' => [
                'rules' => 'required',
            ],
        ]);

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        $image     = $this->request->getFile('image');
        $imageName = str_random(40) . '.' . $image->getClientExtension();

        $image->move(ROOTPATH . 'public/uploads/images/products', $imageName);

        $product = new Product();
        $media   = new ProductMedia();

        try {

            $product->insert($this->request->getVar());
            $media->insert([
                "product_id" => $product->getInsertID(),
                "media"      => $imageName,
                "type"       => "image",
            ]);

        } catch (\ReflectionException $e) {
            var_dump($e->getMessage());
        }

    }
}
