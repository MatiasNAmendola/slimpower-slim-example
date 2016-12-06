<?php

namespace App\Config;

use SlimPower\Config\AbstractConfig;

class RouteConfig extends AbstractConfig
{
    protected function getDefaults()
    {
        return array(
            'routes' => array(
                array(
                    'route' => null,
                    'name' => null,
                    'controller' => null,
                    'action' => null,
                    'methods' => array('GET'),
                    'conditions' => array()
                )
            )
        );
    }
}