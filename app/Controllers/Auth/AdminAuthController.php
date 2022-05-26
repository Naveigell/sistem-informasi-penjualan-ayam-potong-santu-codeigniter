<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\User;

class AdminAuthController extends BaseController
{
    public function index()
    {
        return view('auth/admin/login');
    }

    public function store()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            'email' => [
                'rules' => 'required',
            ],
            'password' => [
                'rules' => 'required',
            ],
        ]);

        if (!$validator->run($this->request->getVar())) {
            return redirect()->route('admin.auth.login.index')->withInput()->with('errors', $validator->getErrors());
        }

        $user = (object) (new User())->where('email', $this->request->getVar('email'))->first();
        if (!$user) {
            $validator->setError('auth', 'User not found');

            return redirect()->route('admin.auth.login.index')->withInput()->with('errors', $validator->getErrors());
        }

        if (!password_verify($this->request->getVar('password'), $user->password)) {
            $validator->setError('auth', 'Password wrong');

            return redirect()->route('admin.auth.login.index')->withInput()->with('errors', $validator->getErrors());
        }

        session()->set('user', $user);
        session()->set('hasLoggedIn', true);

        return redirect()->route('admin.dashboard.index');
    }
}
