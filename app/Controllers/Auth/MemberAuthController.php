<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\User;

class MemberAuthController extends BaseController
{
    public function login()
    {
        return view('auth/member/login');
    }

    public function doLogin()
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
            return redirect()->route('member.auth.login.index')->withInput()->with('errors', $validator->getErrors());
        }

        $user = (object) (new User())->where('email', $this->request->getVar('email'))->where('role', User::ROLE_USER)->first();
        if (!count((array) $user)) {
            $validator->setError('auth', 'User not found');

            return redirect()->route('member.auth.login.index')->withInput()->with('errors', $validator->getErrors());
        }

        if (!password_verify($this->request->getVar('password'), $user->password)) {
            $validator->setError('auth', 'Password wrong');

            return redirect()->route('member.auth.login.index')->withInput()->with('errors', $validator->getErrors());
        }

        session()->set('user', $user);
        session()->set('hasLoggedIn', true);

        return redirect()->route('home');
    }

    public function register()
    {
        return view('auth/member/register');
    }

    public function doRegister()
    {
        $validator = \Config\Services::validation();
        $validator->setRules([
            'name' => [
                'rules' => 'required',
            ],
            'username' => [
                'rules' => 'required',
            ],
            'email' => [
                'rules' => 'required',
            ],
            'password' => [
                'rules' => 'required',
            ],
        ]);

        if (!$validator->run($this->request->getVar())) {
            return redirect()->back()->withInput()->with('errors', $validator->getErrors());
        }

        $user = (new User())->where('email', $this->request->getVar('email'))->first();

        if ($user) {
            $validator->setError('auth', 'User already exists');

            return redirect()->route('member.auth.register.index')->withInput()->with('errors', $validator->getErrors());
        }

        try {
            (new User())->insert([
                'name'     => $this->request->getVar('name'),
                'username' => $this->request->getVar('username'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'role'     => User::ROLE_USER,
            ]);
        } catch (\ReflectionException $e) {
            var_dump($e->getMessage());
        }

        return redirect()->route('member.auth.register.index')->withInput()->with('success', 'Register berhasil, silakan melakukan login');
    }
}
