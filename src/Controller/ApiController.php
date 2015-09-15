<?php

namespace Supervisor\Controller;


use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

/**
 * Class ApiController
 * @package Supervisor\Controller
 * @author Sander Krause <sanderkrause@gmail.com>
 */
class ApiController implements ControllerProviderInterface {

    /**
     * @param Application $app
     * @return ControllerCollection
     */
    public function connect(Application $app) {
        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];

        $controllers->get('config', function(\Supervisor\Application $app) {
            return $app->json($app['supervisor.options']);
        })->bind('api-test-config');

        return $controllers;
    }
}