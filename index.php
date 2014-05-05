<?php

// Require composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Get ServiceProviders list
$serviceProvidersList = new Core\ServiceProvidersList();

// Get controllers list
$controllersList = new Core\ControllersList();

// Create silex application
$app = new Core\Application(
    $serviceProvidersList,
    $controllersList,
    array(
        'base_dir' => __DIR__,
    )
);

// Run the application
$app['http_cache']->run();
