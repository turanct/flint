<?php
/**
 * This file is part of turanct/flint
 *
 * @author Toon Daelman <spinnewebber_toon@hotmail.com>
 */

namespace Core;

/**
 * The main application class
 *
 * This class extends the Silex Application class so that we can structure the
 * registering of ServiceProviders and Controllers in a more OOP way.
 * This class also allows us to create getters that allow us to typehint returns,
 * instead of using the array notation, that's the default in Pimple/Silex
 *
 * @author Toon Daelman <spinnewebber_toon@hotmail.com>
 */
class Application extends \Silex\Application
{
    /**
     * Instantiate a new Application.
     *
     * Objects and parameters can be passed as argument to the constructor.
     *
     * @param ServiceProvidersList $serviceProvidersList The controllers list
     * @param ControllersList      $controllersList      The controllers list
     * @param array                $values               The parameters or objects.
     */
    public function __construct(
        ServiceProvidersList $serviceProvidersList,
        ControllersList $controllersList,
        array $values = array()
    ) {
        parent::__construct($values);

        $app = $this;

        // ServiceProviders
        $serviceProvidersList->register($app);

        // Controllers
        $controllersList->register($app);
    }

    /**
     * Get a Silex controller factory
     *
     * @return \Silex\ControllerCollection
     */
    public function getControllersFactory()
    {
        return $this['controllers_factory'];
    }

    /**
     * Get a monolog logger instance
     *
     * @return \Monolog\Logger
     */
    public function getLogger()
    {
        return $this['monolog'];
    }

    /**
     * Get a twig instance
     *
     * @return \Twig_Environment
     */
    public function getTwig()
    {
        return $this['twig'];
    }

    /**
     * Get a translator instance
     *
     * @return \Silex\Translator
     */
    public function getTranslator()
    {
        return $this['translator'];
    }
}
