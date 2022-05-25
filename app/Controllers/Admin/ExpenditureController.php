<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Expenditure;
use App\Models\SubExpenditure;

class ExpenditureController extends BaseController
{
    public function index()
    {
        $expenditures = (new Expenditure())->get()->getResultObject();

        return view('admin/pages/expenditure/index', compact('expenditures'));
    }

    public function create()
    {
        return view('admin/pages/expenditure/form');
    }

    public function edit($financeId)
    {
        $expenditure = (object) (new Expenditure())->where('id', $financeId)->first();

        return view('admin/pages/expenditure/form', compact('expenditure'));
    }

    public function update($expenditureId)
    {
        $validator = $this->validator();

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        $quantities   = $this->request->getVar('quantity');
        $nominals     = $this->request->getVar('nominal');
        $descriptions = $this->request->getVar('description');
        $names        = $this->request->getVar('name');

        (new Expenditure())->update($expenditureId, [
            "publish_date" => $this->request->getVar('publish_date'),
        ]);

        (new SubExpenditure())->where('expenditure_id', $expenditureId)->delete();

        $data  = [];
        $total = 0 ;

        foreach ($quantities as $index => $quantity) {
            $data[] = [
                "name"           => $names[$index],
                "quantity"       => $quantity,
                "nominal"        => $nominals[$index],
                "description"    => $descriptions[$index],
                "expenditure_id" => $expenditureId,
            ];

            $total += $quantity * $nominals[$index];
        }

        (new SubExpenditure())->insertBatch($data);
        (new Expenditure())->update($expenditureId, [
            'total' => $total,
            "publish_date" => $this->request->getVar('publish_date'),
        ]);

        return redirect()->route('admin.expenditures.index')->withInput()->with('success', 'Pengeluaran berhasil diubah');
    }

    public function store()
    {
        $validator = $this->validator();

        $quantities   = $this->request->getVar('quantity');
        $nominals     = $this->request->getVar('nominal');
        $descriptions = $this->request->getVar('description');
        $names        = $this->request->getVar('name');

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        $expenditure = (new Expenditure());
        $expenditure->insert([
            "publish_date" => $this->request->getVar('publish_date'),
            "rand_id"      => uniqid(),
        ]);

        $data  = [];
        $total = 0 ;

        foreach ($quantities as $index => $quantity) {
            $data[] = [
                "name"           => $names[$index],
                "quantity"       => $quantity,
                "nominal"        => $nominals[$index],
                "description"    => $descriptions[$index],
                "expenditure_id" => $expenditure->getInsertID(),
            ];

            $total += $quantity * $nominals[$index];
        }

        (new SubExpenditure())->insertBatch($data);
        (new Expenditure())->update($expenditure->getInsertID(), [
            'total' => $total,
        ]);

        return redirect()->route('admin.expenditures.index')->withInput()->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    public function destroy($expenditureId)
    {
        (new Expenditure())->delete($expenditureId);

        return redirect()->route('admin.expenditures.index')->withInput()->with('success', 'Pengeluaran berhasil dihapus');
    }

    private function validator()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            'publish_date' => [
                'rules' => 'required',
            ],
            'name.*' => [
                'rules' => 'required',
            ],
            'quantity.*' => [
                'rules' => 'required',
            ],
            'nominal.*' => [
                'rules' => 'required',
            ],
            'description.*' => [
                'rules' => 'required',
            ],
        ]);

        return $validator;
    }
}
