<?php
/**
 * This file is part of turanct/flint
 *
 * @author Toon Daelman <spinnewebber_toon@hotmail.com>
 */

namespace ServiceProviders;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Symfony Yaml component for loading Silex configuration details
 *
 * @author Toon Daelman <spinnewebber_toon@hotmail.com>
 */
class YamlConfigurationServiceProvider implements ServiceProviderInterface
{
    /**
     * Register method
     *
     * This method will be called by Silex\Application when it's time to register
     *
     * @param Silex\Application $app The app instance
     */
    public function register(Application $app)
    {
        // Load YAML configs
        $yaml = file_get_contents($app['base_dir'] . '/app/config.yml');
        $yaml = str_replace('__BASEDIR__', $app['base_dir'], $yaml);

        $configurations = Yaml::parse($yaml);

        foreach ($configurations as $key => $value) {
            $app[$key] = $value;
        }
    }

    /**
     * Boot method
     *
     * This method will be called by Silex\Application when it's time to boot
     *
     * @param Silex\Application $app The app instance
     */
    public function boot(Application $app)
    {
    }
}
