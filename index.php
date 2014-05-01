<?php

// Require composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Create silex application
$app = new Silex\Application();

// Debug mode
$app['debug'] = true;

// Base dir
$app['base_dir'] = __DIR__;

/**
 * Providers
 */
require_once __DIR__ . '/app/ServiceProviders.php';

/**
 * Controllers
 */
require_once __DIR__ . '/app/Controllers.php';

// Run the application
$app['http_cache']->run();

