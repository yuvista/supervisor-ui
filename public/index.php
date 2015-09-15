<?php

use Supervisor\Service\SupervisorClient;

require_once __DIR__.'/../vendor/autoload.php';
require_once '../src/bootstrap.php';

$app = new \Supervisor\Application($config);

// Register providers
$app->register(new Silex\Provider\TwigServiceProvider(), $config['twig.options']);
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// Register services
$app['supervisor_client'] = $app->share(function (\Silex\Application $app) {
    return new SupervisorClient($app['supervisor.options']);
});

// Setup controllers
$app->mount('/', new \Supervisor\Controller\IndexController());
$app->mount('/api', new \Supervisor\Controller\ApiController());

$app->run();