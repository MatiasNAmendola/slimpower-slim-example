<?php

namespace App\Security;

use SlimPower\Authentication\AbstractError;
use SlimPower\Authentication\Interfaces\ErrorInterface;

class CustomError extends AbstractError implements ErrorInterface {
    
    protected function sendErrorResponse(\SlimPower\Authentication\Error $error) {
        $app = $this->app;
        $status = $error->getStatus();

        $app->render($status, array(
            'code' => $error->getCode(),
            'msg' => $error->getDescription(),
        ));
    }

}
