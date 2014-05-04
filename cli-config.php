<?php

// Require composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Create silex application
$app = new Silex\Application();

// Base dir
$app['base_dir'] = __DIR__;

/**
 * Providers
 */
require_once __DIR__ . '/app/ServiceProviders.php';

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($app['orm.em']);

