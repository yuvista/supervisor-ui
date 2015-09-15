<?php

namespace Supervisor\Controller;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Supervisor\Application as SupervisorApplication;

/**
 * Class IndexController
 * @package Supervisor\Controller
 * @author Sander Krause <sanderkrause@gmail.com>
 */
class IndexController implements ControllerProviderInterface {

    /**
     * @param Application $app
     * @return ControllerCollection
     */
    public function connect(Application $app) {
        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function (SupervisorApplication $app) {
            return $app->render('index.twig', ['supervisors' => $app->supervisor()->getInstances()]);
        })->bind('index');

        return $controllers;
    }
}