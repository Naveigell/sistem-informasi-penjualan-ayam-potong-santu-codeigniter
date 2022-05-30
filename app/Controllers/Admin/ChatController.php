<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Chat;
use App\Models\User;

class ChatController extends BaseController
{
    public function index()
    {
        $users = $this->userList();

        return view('admin/pages/chat/index', compact('users'));
    }

    public function show($userId)
    {
        $users = $this->userList();
        $chats = (new Chat())->where('user_id', $userId)->orWhere('reply_to', $userId)->get()->getResultObject();
        $user  = (object) (new User())->where('id', $userId)->first();

        return view('admin/pages/chat/form', compact('users', 'chats', 'user'));
    }

    public function store($userId)
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
            "reply_to"    => $userId,
            "description" => $this->request->getVar('description'),
            "created_at"  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('admin.chats.show', [$userId])->withInput()->with('success', 'Chat berhasil dikirim');
    }

    private function userList()
    {
        $usersId = (new Chat())->groupBy('user_id')->where('user_id IS NOT NULL')->get()->getResultObject();
        $usersId = array_map(function ($item) {
            return $item->user_id;
        }, $usersId);

        $users = (new User())->whereIn('id', count($usersId) > 0 ? $usersId : [''])->get()->getResultObject();

        return $users;
    }
}
