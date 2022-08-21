<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\Config\Services;

class AuthController extends BaseController
{
    public function logout()
    {
        session()->destroy();

        return redirect()->route('home');
    }

    public function forgetPasswordStore()
    {
        $user  = (new User())->where('email', $this->request->getVar('email'))->first();

        if (!$user) {
            return redirect()->back()->with('errors', ['email tidak ditemukan']);
        }

        $email = Services::email();
        $email->setTo($this->request->getVar('email'));
        $email->setSubject('Reset Password');
        $email->setMessage('Silakan merubah password anda melalui link berikut <a href="' . base_url(route_to('auth.password.index')) .'?token=' . md5($user['id']) . '&id=' . $user['id'] . '">Link</a>');
        $email->send();

        return redirect()->back()->with('success', 'Email berhasil terkirim.');
    }

    public function forgetPasswordIndex()
    {
        return view('auth/password/email');
    }

    public function passwordIndex () {
        return view('auth/password/password');
    }

    public function passwordStore () {

        if (empty($this->request->getVar('password'))) {
            return redirect()->back()->with('errors', ['Password tidak boleh kosong']);
        }

        if ($this->request->getVar('repeat_password') != $this->request->getVar('password')) {
            return redirect()->back()->with('errors', ['Password tidak sama']);
        }

        if (!empty($_GET['token']) && !empty($_GET['id'])) {

            if (md5($_GET['id']) != $_GET['token']) {
                return redirect()->back()->with('errors', ['Invalid Signature']);
            }

            (new User())->update($_GET['id'], [
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ]);

            return redirect()->back()->with('success', 'Password berhasil dirubah');
        } else {
            return redirect()->back()->with('errors', ['Invalid Signature']);
        }
    }
}
