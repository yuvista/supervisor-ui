<?php
/**
 * Created by PhpStorm.
 * User: sander
 * Date: 15-09-15
 * Time: 21:54
 */

namespace Supervisor\Controllers;


use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

class ApiController implements ControllerProviderInterface {

    public function connect(Application $app) {
        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];

        $controllers->get('test/{test}', function(\Supervisor\Application $app, $test) {
            return $app->json(['test' => $test]);
        });

        return $controllers;
    }
}