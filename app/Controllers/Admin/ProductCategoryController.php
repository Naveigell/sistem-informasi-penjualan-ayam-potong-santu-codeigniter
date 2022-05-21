<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductCategory;

class ProductCategoryController extends BaseController
{
    public function index()
    {
        $categories = (new ProductCategory())->get()->getResultObject();

        return view('admin/pages/product_category/index', compact('categories'));
    }

    public function create()
    {
        return view('admin/pages/product_category/form');
    }

    public function edit($categoryId)
    {
        $category = (object) (new ProductCategory())->find($categoryId);

        return view('admin/pages/product_category/form', compact('category'));
    }

    public function store()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            'name' => [
                'rules' => 'required',
            ],
            'image' => [
                'rules' => 'uploaded[image]|mime_in[image,image/png,image/jpg,image/jpeg]',
            ],
        ]);

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        $image     = $this->request->getFile('image');
        $imageName = str_random(40) . '.' . $image->getClientExtension();

        $image->move(ROOTPATH . 'public/uploads/images/product_categories', $imageName);

        try {
            (new ProductCategory())->insert(array_merge($this->request->getVar(), [
                "slug"  => str_slug($this->request->getVar('name')),
                "image" => $imageName,
            ]));
        } catch (\ReflectionException $e) {
            var_dump($e->getMessage());
        }

        return redirect()->route('admin.product-categories.index')->withInput()->with('success', 'Produk Kategori berhasil ditambahkan');
    }

    public function update($categoryId)
    {
        $image = $this->request->getFile('image');

        $rules = [
            'name' => [
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

            $image->move(ROOTPATH . 'public/uploads/images/product_categories', $imageName);

            $media = (new ProductCategory())->where('id', $categoryId)->first();
            (new ProductCategory())->update($media['id'], [
                "image" => $imageName,
            ]);
        }

        try {
            $category = (new ProductCategory())->where('id', $categoryId)->first();

            (new ProductCategory())->update($category['id'], array_merge($this->request->getVar(), [
                "slug" => str_slug($this->request->getVar('name')),
            ]));
        } catch (\ReflectionException $e) {
            var_dump($e->getMessage());
        }

        return redirect()->route('admin.product-categories.index')->withInput()->with('success', 'Produk Kategori berhasil diubah');
    }

    public function destroy($categoryId)
    {
        (new ProductCategory())->delete($categoryId);

        return redirect()->route('admin.product-categories.index')->withInput()->with('success', 'Produk Kategori berhasil dihapus');
    }
}
