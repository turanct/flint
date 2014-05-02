<?php
namespace Controllers;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Response;

class ExampleControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        // GET /
        $controllers->get('/', function (Application $app) {
            $app['monolog']->addInfo('Redirecting to /en');

            return $app->redirect('/en');
        });

        // GET /cached
        $controllers->get('/cached', function (Application $app) {
            $app['monolog']->addInfo('This response is cached');

            $response = new Response(
                $app['twig']->render('example.twig', array(
                    'hello' => $app['translator']->trans('hello', array('%name%' => 'Toon')),
                ))
            );
            $response->setTtl(20);

            return $response;
        });

        // GET /{_locale}
        $controllers->get('/{_locale}', function (Application $app) {
            return $app['twig']->render('example.twig', array(
                'hello' => $app['translator']->trans('hello', array('%name%' => 'Toon')),
            ));
        });

        return $controllers;
    }
}
