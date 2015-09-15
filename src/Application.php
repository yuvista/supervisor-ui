<?php

namespace Supervisor;

use Silex\Application as SilexApplication;

class Application extends SilexApplication {

	use SilexApplication\UrlGeneratorTrait;
    use SilexApplication\TwigTrait;

    /**
     * @return \Supervisor\Service\SupervisorClient
     */
    public function supervisor() {
        return $this['supervisor_client'];
    }
}