<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\Chat;

class ChatController extends BaseController
{
    public function index()
    {
        $chats = (new Chat())->where('user_id', session()->get('user')->id)->orWhere('reply_to', session()->get('user')->id)->get()->getResultObject();

        return view('member/pages/chat/index', compact('chats'));
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

        (new Chat())->insert([
            "user_id"     => session()->get('user')->id,
            "description" => $this->request->getVar('description'),
            "created_at"  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('member.chats.index', [session()->get('user')->id])->withInput()->with('success', 'Chat berhasil dikirim');
    }
}
