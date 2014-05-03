<?php
/**
 * This file is part of turanct/sef
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
    public function register(Application $app)
    {
        // Load YAML configs
        $configurations = Yaml::parse(
            file_get_contents($app['base_dir'] . '/app/config.yml')
        );

        foreach ($configurations as $key => $value) {
            $app[$key] = str_replace('__BASEDIR__', $app['base_dir'], $value);
        }
    }

    public function boot(Application $app)
    {
    }
}
