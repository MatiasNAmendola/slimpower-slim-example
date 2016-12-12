<?php

namespace App\Security;

use SlimPower\AuthenticationManager\AuthManager;
use SlimPower\AuthenticationManager\Interfaces\ManagerInterface;

class SecManager extends AuthManager implements ManagerInterface {

    private function getParams() {
        $app = $this->app;

        $auth = array(
            'user' => $app->request->params('user'),
            'password' => $app->request->params('password')
        );

        return $auth;
    }

    private function getHeader() {
        $auth = array('user' => '', 'password' => '');

        $app = $this->app;

        if ($app->request->headers->get("Authorization")) {
            $autentication = explode("&", $app->request->headers->get("Authorization"));

            foreach ($autentication as $param) {
                $paramArr = explode("=", $param);

                if (count($paramArr) > 1) {
                    $paramKey = $paramArr[0];
                    $paramVal = $paramArr[1];
                    $auth[$paramKey] = $paramVal;
                }
            }
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

    protected function sendErrorResponse(\SlimPower\Authentication\Error $error) {
        $app = $this->app;
        $status = $error->getStatus();

        $app->render($status, array(
            'code' => $error->getCode(),
            'msg' => $error->getDescription(),
        ));
    }

}
