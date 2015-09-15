<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once '../src/bootstrap.php';

$app = new \Supervisor\Application($config);

// Register providers
$app->register(new Silex\Provider\TwigServiceProvider(), $config['twig.options']);
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// Setup controllers
$app->mount('/', new \Supervisor\Controllers\IndexController());

$app->run();