<?php

use Symfony\Component\HttpFoundation\Request;

/**
 * Services
 */
// Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => $app['base_dir'] . '/app/Views',
));

// URL Generator
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// Session provider
$app->register(new Silex\Provider\SessionServiceProvider());

// Validator provider
$app->register(new Silex\Provider\ValidatorServiceProvider());

// Form provider
$app->register(new Silex\Provider\FormServiceProvider());

/*
// Security provider
$app->register(new Silex\Provider\SecurityServiceProvider());
$app->register(new Silex\Provider\RememberMeServiceProvider());
$app['security.firewalls'] = array(
    'public' => array(
        'pattern' => '^.*$',
    ),
);
*/

// Swift mailer provider
$app->register(new Silex\Provider\SwiftmailerServiceProvider());

// Monolog provider
$app->register(new Silex\Provider\MonologServiceProvider());

// Translation provider
$app->register(new Silex\Provider\TranslationServiceProvider());
$app['translator'] = $app->share($app->extend('translator', function($translator, $app) {
    $translator->addLoader('yaml', new Symfony\Component\Translation\Loader\YamlFileLoader());

    $translator->addResource('yaml', $app['base_dir'] . '/app/Locales/en.yml', 'en');
    $translator->addResource('yaml', $app['base_dir'] . '/app/Locales/nl.yml', 'nl');
    $translator->addResource('yaml', $app['base_dir'] . '/app/Locales/fr.yml', 'fr');
    $translator->addResource('yaml', $app['base_dir'] . '/app/Locales/de.yml', 'de');

    return $translator;
}));

/*
// Doctrine provider
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver' => 'pdo_sqlite',
        'path' => $app['base_dir'] . '/app.db',
    ),
));
*/

// Cache provider
$app->register(new Silex\Provider\HttpCacheServiceProvider());
// Trust the current host for caching
Request::setTrustedProxies(array('127.0.0.1'));

