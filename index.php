<?php

// Require composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Create silex application
$app = new Silex\Application();

// Load YAML configs
$configurations = Symfony\Component\Yaml\Yaml::parse(
    file_get_contents(__DIR__ . '/app/config.yml')
);
foreach ($configurations as $key => $value) {
    $app[$key] = str_replace('__BASEDIR__', __DIR__, $value);
}

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

