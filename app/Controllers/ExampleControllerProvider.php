<?php
/**
 * This file is part of turanct/flint
 *
 * @author Toon Daelman <spinnewebber_toon@hotmail.com>
 */

namespace Controllers;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * This is an Example ControllerProvider
 *
 * @author Toon Daelman <spinnewebber_toon@hotmail.com>
 */
class ExampleControllerProvider implements ControllerProviderInterface
{
    /**
     * Connect method
     *
     * This method will be called by Silex\Application when it's time to connect
     *
     * @param Silex\Application $app The app instance
     */
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app->getControllersFactory();

        // GET /
        $controllers->get('/', function (Application $app) {
            $app->getLogger()->addInfo('Redirecting to /en');

            return $app->redirect('/en');
        });

        // GET /cached
        $controllers->get('/cached', function (Application $app) {
            $app->getLogger()->addInfo('This response is cached');

            $response = new Response(
                $app->getTwig()->render('example.twig', array(
                    'hello' => $app->getTranslator()->trans('hello', array('%name%' => 'Toon')),
                ))
            );
            $response->setTtl(20);

            return $response;
        });

        // GET /{_locale}
        $controllers->get('/{_locale}', function (Application $app) {
            return $app->getTwig()->render('example.twig', array(
                'hello' => $app->getTranslator()->trans('hello', array('%name%' => 'Toon')),
            ));
        });

        return $controllers;
    }
}
