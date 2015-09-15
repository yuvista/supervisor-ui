<?php
/**
 * Created by PhpStorm.
 * User: sander
 * Date: 15-09-15
 * Time: 21:21
 */

namespace Supervisor\Controllers;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Supervisor\Application as SupervisorApplication;

class IndexController implements ControllerProviderInterface {

    public function connect(Application $app) {
        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function (SupervisorApplication $app) {
            return $app->render('index.twig');
        });

        $controllers->get('/{name}', function (SupervisorApplication $app, $name) {
            return $app->render('index.twig', ['name' => $name]);
        });

        return $controllers;
    }
}