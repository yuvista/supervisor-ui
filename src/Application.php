<?php

namespace Supervisor;

use Silex\Application as SilexApplication;

class Application extends SilexApplication {

	use SilexApplication\UrlGeneratorTrait;
    use SilexApplication\TwigTrait;
}