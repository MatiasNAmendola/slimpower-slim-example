<?php

require 'vendor/autoload.php';
require 'App/Config/Config.php';

$logDir = dirname(LOG_FILE);

if (!file_exists($logDir)) {
    $oldmask = umask(0);
    mkdir($logDir, 0777, TRUE);
    umask($oldmask);
}

$logWriter = new \Slim\LogWriter(fopen(LOG_FILE, 'a'));

$app = new \SlimPower\Slim\Slim(array(
    'mode' => APP_ENV,
    'log.level' => \Slim\Log::DEBUG,
    //'log.level' => \Slim\Log::INFO,
    'log.writer' => $logWriter));

$authLogin = new SlimPower\Authentication\Callables\DemoAuthenticator($app);
$authToken = new \SlimPower\Authentication\Callables\TokenNullAuthenticator($app);
$error = new App\Security\CustomError($app);
$security = \App\Security\SecManager::getInstance($app, $authLogin, $authToken, $error);
$security->addTokenRelaxed(unserialize(TOKEN_RELAXED));
$security->addInsecurePaths(unserialize(INSECURE_PATH));
$security->setWarningPaths(unserialize(WARNING_PATH));
$security->setTokenSecret(TOKEN_SECRET);
$security->setTokenValidity(TOKEN_VALIDITY);
$security->start();

// Optionally register a controller with the container
$app->container->singleton('App\Home', function ($container) {
    // Retrieve any required dependencies from the container and
    // inject into the constructor of the controller.
    return new \App\Controller\Home();
});

function APIrequest() {
    $app = \SlimPower\Slim\Slim::getInstance();

    $app->add(new \SlimPower\Slim\Middleware\Json\Middleware($app, array(
        'json.status' => true,
        'json.override_error' => true,
        'json.override_notfound' => true,
        'json.debug' => (APP_ENV == 'development'),
    )));
}

// Set up routes
//$app->get('/', 'App\Home:index');
$app->get('/', 'APIrequest', 'App\Home:index');
//$app->get('/hello(/:name)', 'App\Controller\Home:hello');


$app->get('/user/:id', function($id) use ($app) {
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

//Default - None
$configR = new \App\Config\RouteConfig(array());
$routesR = $configR->get('routes');

foreach ($routesR as $route) {
    $app->addRoute($route);
}

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

$config = new \SlimPower\Config\Config("config.json");

$routes = $config->get('routes');

foreach ($routes as $route) {
    $app->addRoute($route);
}

$app->hook('slim.after', function () use ($app) {
    $request = $app->request;
    $response = $app->response;

    $app->log->debug('');
    $app->log->debug('------------- ' . date('Y-m-d H:i:s') . ' -------------');
    $app->log->debug('Request path: ' . $request->getPathInfo());
    $app->log->debug('Response status: ' . $response->getStatus());
    $app->log->debug('Method: ' . $request->getMethod());
    $app->log->debug('IP: ' . $request->getIp());
});

$app->run();
