<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Capital;

class CapitalController extends BaseController
{
    public function index()
    {
        $capitals = (new Capital())->get()->getResultObject();

        return view('admin/pages/capital/index', compact('capitals'));
    }

    public function create()
    {
        return view('admin/pages/capital/form');
    }

    public function edit($id)
    {
        $capital = (object) (new Capital())->where('id', $id)->first();

        return view('admin/pages/capital/form', compact('capital'));
    }

    public function store()
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        (new Capital())->insert($this->request->getVar());

        return redirect()->route('admin.capitals.index')->withInput()->with('success', 'Modal berhasil ditambah');
    }

    public function update($id)
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        (new Capital())->update($id, $this->request->getVar());

        return redirect()->route('admin.capitals.index')->withInput()->with('success', 'Modal berhasil diubah');
    }

    public function destroy($id)
    {
        (new Capital())->delete($id);

        return redirect()->route('admin.capitals.index')->withInput()->with('success', 'Modal berhasil dihapus');
    }

    private function validator()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            'value' => [
                'rules' => 'required',
            ],
            'publish_date' => [
                'rules' => 'required',
            ],
        ]);

        return $validator;
    }
}
