<?php

namespace App\Security;

use SlimPower\AuthenticationManager\AuthManager;
use SlimPower\AuthenticationManager\Interfaces\ManagerInterface;
use SlimPower\Authentication\Abstracts\LoginAuthMiddleware;

class SecManager extends AuthManager implements ManagerInterface {

    private function getParams() {
        $app = $this->app;

        $auth = array(
            'user' => $app->request->params(LoginAuthMiddleware::KEY_USERNAME),
            'password' => $app->request->params(LoginAuthMiddleware::KEY_PASSWORD)
        );

        return $auth;
    }

    private function getHeader() {
        $auth = array(LoginAuthMiddleware::KEY_USERNAME => '', LoginAuthMiddleware::KEY_PASSWORD => '');

        $app = $this->app;
        
        $headers = $app->request->headers;

        if ($headers->get(LoginAuthMiddleware::KEY_USERNAME) && $headers->get(LoginAuthMiddleware::KEY_PASSWORD)) {
            $auth['user'] = $headers->get(LoginAuthMiddleware::KEY_USERNAME);
            $auth['password'] = $headers->get(LoginAuthMiddleware::KEY_PASSWORD);
        }

        return $auth;
    }

    /**
     * Get login data
     * @return array Login data
     */
    protected function login() {
        if (!AUTH_IN_HEADER) {
            $auth = $this->getParams();
        } else {
            $auth = $this->getHeader();
        }

        return $auth;
    }

    protected function sendCredential($token) {
        $app = $this->app;

        $app->render(200, array(
            'token' => $token,
        ));
    }

}
