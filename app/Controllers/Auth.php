<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController {
    public function token() {
        if (auth()->loggedIn()) {
            auth()->logout();
        }

        $credentials = [
            'email'    => $this->request->getJsonVar('email'),
            'password' => $this->request->getJsonVar('password')
        ];

        $loginAttempt = auth()->attempt($credentials);

        if (!$loginAttempt->isOK()) {
            return $this->response->setStatusCode(401)->setJSON([
                'message' => $loginAttempt->reason(),
            ]);
        }

        $user = $loginAttempt->extraInfo();

        $token = $user->generateAccessToken("Delivery Service");

        return $this->response->setJSON([
            'message' => 'Login successful',
            'data'   => [
                'token' => $token->raw_token,
            ],
        ]);
    }

    public function info() {
        if (!auth()->loggedIn()) {
            return $this->response->setStatusCode(401)->setJSON([
                'message' => 'You are not logged in',
            ]);
        }

        return $this->response->setJSON([
            'message' => 'You are logged in',
            'data'   => [
                'user' => auth()->user(),
            ],
        ]);
    }
}
