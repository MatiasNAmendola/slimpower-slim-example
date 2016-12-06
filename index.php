<?php

require 'vendor/autoload.php';

$app = new \SlimPower\Slim();

$app->config('debug', false);

// Optionally register a controller with the container
$app->container->singleton('App\Home', function ($container) {
    // Retrieve any required dependencies from the container and
    // inject into the constructor of the controller
    return new \App\Controller\Home();
});

function APIrequest() {
    $app = \Slim\Slim::getInstance();
    $app->view(new \SlimPower\Middleware\jsonApi\JsonApiView());
    $app->add(new \SlimPower\Middleware\jsonApi\JsonApiMiddleware());
}

// Set up routes
//$app->get('/', 'App\Home:index');
$app->get('/', 'APIrequest', 'App\Home:index');
//$app->get('/hello(/:name)', 'App\Controller\Home:hello');


$app->get('/user/:id', function($id) use ($app) {

    //your code here

    $app->render(404, array(
        'error' => TRUE,
        'msg' => 'user not found',
    ));
});

$app->notFound(function () use ($app) {
    $app->render(404, array(
        'error' => TRUE,
        'msg' => 'not found',
    ));
});

// Default - None
$app->addRoute(array(
    'route' => null,
    'name' => null,
    'controller' => null,
    'action' => null,
    'methods' => array('GET'),
    'conditions' => array()
));

$app->addRoute(array(
    'route' => '/error',
    'name' => null,
    'controller' => 'App\Controller\Home',
    'action' => 'error',
    'methods' => array('GET'),
    'conditions' => array()
));

$app->addRoute(array(
    'route' => '/ups',
    'name' => null,
    'controller' => 'App\Controller\Home',
    'action' => 'ups',
    'methods' => array('GET'),
    'conditions' => array()
));

$app->addRoute(array(
    'route' => '/hello(/:name)',
    'name' => null,
    'controller' => 'App\Controller\Home',
    'action' => 'hello',
    'methods' => array('GET'),
    'conditions' => array()
));

$config = new \SlimPower\Config\Config("routes.json");

$routes = $config->get('routes');

foreach ($routes as $route) {
    $app->addRoute($route);
}

$app->view(new \SlimPower\Middleware\jsonApi\JsonApiView("resource", "meta"));
$app->add(new \SlimPower\Middleware\jsonApi\JsonApiMiddleware());
$app->run();
