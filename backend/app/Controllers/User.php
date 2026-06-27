<?php

namespace AppControllers;

use AppModelsUserModel;

class User extends BaseController
{
    public function login()
    {
        helper(['form']);
        if ($this->request->getMethod() !== 'post') {
            return view('user/login', ['title' => 'Login']);
        }
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $user = (new UserModel())->where('useremail', $email)->first();
        if ($user && (password_verify($password, $user['userpassword']) || hash_equals($user['userpassword'], $password))) {
            session()->set(['user_id' => $user['id'], 'username' => $user['username'], 'logged_in' => true]);
            return redirect()->to('/admin/artikel');
        }
        return view('user/login', ['title' => 'Login', 'error' => 'Email atau password salah.']);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/user/login');
    }
}
