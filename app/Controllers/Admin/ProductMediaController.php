<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductMedia;

class ProductMediaController extends BaseController
{
    public function index($productId)
    {
        $medias = (new ProductMedia())->where('product_id', $productId)->where('type', ProductMedia::TYPE_IMAGE)->get()->getResultObject();

        return view('admin/pages/product_media/index', compact('medias', 'productId'));
    }

    public function create($productId)
    {
        return view('admin/pages/product_media/form', compact('productId'));
    }

    public function store($productId)
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        $image     = $this->request->getFile('image');
        $imageName = str_random(40) . '.' . $image->getClientExtension();

        $image->move(ROOTPATH . 'public/uploads/images/products', $imageName);

        try {
            (new ProductMedia())->insert([
                "media"          => $imageName,
                "type"           => ProductMedia::TYPE_IMAGE,
                "product_id"     => $productId,
            ]);
        } catch (\ReflectionException $e) {
            var_dump($e->getMessage());
        }

        return redirect()->route('admin.product-medias.index', [$productId])->withInput()->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($productId, $mediaId)
    {
        $media = (new ProductMedia())->where('id', $mediaId)->first();

        return view('admin/pages/product_media/form', compact('productId', 'media'));
    }

    public function update($productId, $mediaId)
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        $image     = $this->request->getFile('image');
        $imageName = str_random(40) . '.' . $image->getClientExtension();

        $image->move(ROOTPATH . 'public/uploads/images/products', $imageName);

        (new ProductMedia())->update($mediaId, [
            "media"          => $imageName,
            "type"           => ProductMedia::TYPE_IMAGE,
            "product_id"     => $productId,
        ]);

        return redirect()->route('admin.product-medias.index', [$productId])->withInput()->with('success', 'Produk berhasil diubah');
    }

    public function destroy($productId, $mediaId)
    {
        (new ProductMedia())->delete($mediaId);

        return redirect()->route('admin.product-medias.index', [$productId])->withInput()->with('success', 'Produk berhasil diubah');
    }

    private function validator()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            "image" => [
                "rules" => "uploaded[image]|mime_in[image,image/png,image/jpg,image/jpeg]",
            ]
        ]);

        return $validator;
    }
}
