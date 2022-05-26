<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\Suggestion;

class SuggestionController extends BaseController
{
    public function index()
    {
        $suggestions = (new Suggestion())->where('user_id', session()->get('user')->id)->get()->getResultObject();

        return view('member/pages/suggestion/index', compact('suggestions'));
    }

    public function store()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            'description' => [
                'rules' => 'required',
            ],
        ]);

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        (new Suggestion())->insert([
            "user_id"     => session()->get('user')->id,
            "description" => $this->request->getVar('description'),
            "created_at"  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('member.suggestions.index')->withInput()->with('success', 'Saran Berhasil dikirim');
    }
}
