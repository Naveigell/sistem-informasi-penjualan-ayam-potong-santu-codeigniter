<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\ProductCategory;
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
        $product    = (object) (new Product())->find($productId);
        $categories = (new ProductCategory())->get()->getResultObject();

        return view('admin/pages/product/form', compact('product', 'categories'));
    }

    public function update($productId)
    {
        $image = $this->request->getFile('image');
        $video = $this->request->getFile('video');
        $rules = [
            'category_id' => [
                'rules' => 'required',
            ],
            'name' => [
                'rules' => 'required',
            ],
            'description' => [
                'rules' => 'required',
            ],
        ];

        if ($image->isFile()) {
            $rules['image'] = [
                'rules' => 'uploaded[image]|mime_in[image,image/png,image/jpg,image/jpeg]',
            ];
        }

        if ($video->isFile()) {
            $rules['video'] = [
                'rules' => 'uploaded[video]',
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

            $media = (new ProductMedia())->where('product_id', $productId)->where('type', ProductMedia::TYPE_IMAGE)->first();
            (new ProductMedia())->update($media['id'], [
                "media" => $imageName,
            ]);
        }

        if ($video->isFile()) {
            $videoName = str_random(40) . '.' . $video->getClientExtension();

            $video->move(ROOTPATH . 'public/uploads/videos/products', $videoName);

            $media = (new ProductMedia())->where('product_id', $productId)->where('type', ProductMedia::TYPE_VIDEO)->first();
            (new ProductMedia())->update($media['id'], [
                "media" => $videoName,
            ]);
        }

        try {
            $product = (new Product())->where('id', $productId)->first();

            (new Product())->update($product['id'], array_merge($this->request->getVar(), [
                "slug" => str_slug($this->request->getVar('name')),
            ]));
        } catch (\ReflectionException $e) {
            var_dump($e->getMessage());
        }

        return redirect()->route('admin.products.index')->withInput()->with('success', 'Produk berhasil diubah');
    }

    public function create()
    {
        $categories = (new ProductCategory())->get()->getResultObject();

        return view('admin/pages/product/form', compact('categories'));
    }

    public function store()
    {
        $video = $this->request->getFile('video');
        $rules = [
            'category_id' => [
                'rules' => 'required',
            ],
            'image' => [
                'rules' => 'uploaded[image]|mime_in[image,image/png,image/jpg,image/jpeg]',
            ],
            'name' => [
                'rules' => 'required',
            ],
            'description' => [
                'rules' => 'required',
            ],
        ];

        if ($video->isFile()) {
            $rules['video'] = [
                'rules' => 'uploaded[video]',
            ];
        }

        $validator = \Config\Services::validation();
        $validator->setRules($rules);

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

            $videoData = [
                "product_id" => $product->getInsertID(),
                "media"      => '',
                "type"       => ProductMedia::TYPE_VIDEO,
            ];

            if ($video->isFile()) {

                $video     = $this->request->getFile('video');
                $videoName = str_random(40) . '.' . $video->getClientExtension();

                $video->move(ROOTPATH . 'public/uploads/videos/products', $videoName);

                $videoData = [
                    "product_id" => $product->getInsertID(),
                    "media"      => $videoName,
                    "type"       => ProductMedia::TYPE_VIDEO,
                ];
            }

            $media->insertBatch([
                [
                    "product_id" => $product->getInsertID(),
                    "media"      => $imageName,
                    "type"       => ProductMedia::TYPE_IMAGE,
                ],
                $videoData,
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
