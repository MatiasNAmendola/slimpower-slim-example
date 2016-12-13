<?php

namespace App\Security;

use SlimPower\Authentication\AbstractError;
use SlimPower\Authentication\Interfaces\ErrorInterface;

class CustomError extends AbstractError implements ErrorInterface {
    
    protected function sendErrorResponse(\SlimPower\Authentication\Error $error) {
        $app = $this->app;
        $status = $error->getStatus();
        
        $data = array(
            'error' => TRUE,
            'code' => $error->getCode(),
            'msg' => $error->getDescription(),
        );
        
        $app->render($status, $data);
    }

}
