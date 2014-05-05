<?php
/**
 * This file is part of turanct/flint
 *
 * @author Toon Daelman <spinnewebber_toon@hotmail.com>
 */

namespace Core;

use Controllers;
use Silex\Application;

/**
 * This is where we can mount our ControllerProviders
 *
 * @author Toon Daelman <spinnewebber_toon@hotmail.com>
 */
class ControllersList
{
    /**
     * Register method
     *
     * This method will be called by Core\Application when it's time to mount
     *
     * @param Silex\Application $app The app instance
     */
    public function register(Application $app)
    {
        // Example controller provider
        $app->mount('/', new Controllers\ExampleControllerProvider());
    }
}
