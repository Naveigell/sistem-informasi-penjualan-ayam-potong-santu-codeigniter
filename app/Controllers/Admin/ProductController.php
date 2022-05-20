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
        $products = (new Product())->withImages()->get()->getResultObject();

        return view('admin/pages/product/index', compact('products'));
    }

    public function edit($productId)
    {
        $product = (object) (new Product())->find($productId);

        return view('admin/pages/product/form', compact('product'));
    }

    public function update($productId)
    {
        $image = $this->request->getFile('image');
        $rules = [
            'name' => [
                'rules' => 'required',
            ],
            'weight' => [
                'rules' => 'required',
            ],
            'price' => [
                'rules' => 'required',
            ],
        ];

        if ($image->isFile()) {
            $rules['image'] = [
                'rules' => 'uploaded[image]|mime_in[image,image/png,image/jpg,image/jpeg]',
            ];
        }

        $validator = \Config\Services::validation();
        $validator->setRules($rules);

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        if ($image->isFile()) {
            $imageName = str_random(40) . '.' . $image->getClientExtension();

            $image->move(ROOTPATH . 'public/uploads/images/products', $imageName);

            $media = (new ProductMedia())->where('product_id', $productId)->first();
            (new ProductMedia())->update($media['id'], [
                "media" => $imageName,
            ]);
        }

        try {
            $product = (new Product())->where('id', $productId)->first();

            (new Product())->update($product['id'], array_merge($this->request->getVar(), [
                "slug" => str_slug($this->request->getVar('name')),
            ]));
        } catch (\ReflectionException $e) {
            dd($e->getMessage());
        }

        return redirect()->route('admin.products.index')->withInput()->with('success', 'Produk berhasil diubah');
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

            $product->insert(array_merge($this->request->getVar(), [
                "slug" => str_slug($this->request->getVar('name')),
            ]));

            $media->insert([
                "product_id" => $product->getInsertID(),
                "media"      => $imageName,
                "type"       => "image",
            ]);

        } catch (\ReflectionException $e) {
            var_dump($e->getMessage());
        }

        return redirect()->route('admin.products.index')->withInput()->with('success', 'Produk berhasil ditambahkan');
    }

    public function destroy($productId)
    {
        (new Product())->delete($productId);

        return redirect()->route('admin.products.index')->withInput()->with('success', 'Produk berhasil dihapus');
    }
}
