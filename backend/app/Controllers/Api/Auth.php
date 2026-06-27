<?php

namespace AppControllersApi;

use AppModelsUserModel;
use CodeIgniterRESTfulResourceController;

class Auth extends ResourceController
{
    protected $format = 'json';

    public function login()
    {
        $payload = $this->request->getJSON(true) ?: $this->request->getPost();
        $email = $payload['email'] ?? '';
        $password = $payload['password'] ?? '';
        $model = new UserModel();
        $user = $model->where('useremail', $email)->first();
        if (!$user || !(password_verify($password, $user['userpassword']) || hash_equals($user['userpassword'], $password))) {
            return $this->failUnauthorized('Email atau password salah.');
        }
        $token = bin2hex(random_bytes(32));
        $model->update($user['id'], ['token' => $token]);
        return $this->respond(['message' => 'Login berhasil.', 'token' => $token, 'user' => ['id' => $user['id'], 'username' => $user['username'], 'email' => $user['useremail']]]);
    }

    public function logout()
    {
        $header = $this->request->getHeaderLine('Authorization');
        $token = trim(str_replace('Bearer', '', $header));
        if ($token) {
            $model = new UserModel();
            $user = $model->where('token', $token)->first();
            if ($user) {
                $model->update($user['id'], ['token' => null]);
            }
        }
        return $this->respond(['message' => 'Logout berhasil.']);
    }
}
