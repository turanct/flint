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
     * @var string The path to the live file
     */
    protected $liveFile;

    /**
     * @var string The path to the cached file
     */
    protected $cacheFile;

    /**
     * @var bool Should we cache to disk?
     */
    protected $cacheToDisk;

    /**
     * Register method
     *
     * This method will be called by Silex\Application when it's time to register
     *
     * @param Silex\Application $app The app instance
     */
    public function register(Application $app)
    {
        $this->liveFile = $app['base_dir'] . '/app/config.yml';

        $this->cacheFile = $app['base_dir'] . '/app/Cache/config.php';
        if (!is_writable($this->cacheFile)) {
            $this->cacheFile = '/tmp/silex/cache/config.php';
        }

        $this->cacheToDisk = true;

        $configuration = $this->getConfiguration($app);

        foreach ($configuration as $key => $value) {
            $app[$key] = $value;
        }
    }

    /**
     * Get the config parameters
     *
     * @param Silex\Application $app The app instance
     *
     * @return array An array of parameters
     */
    public function getConfiguration(Application $app)
    {
        if (
            $this->cacheToDisk === true
            && file_exists($this->cacheFile)
            && filemtime($this->cacheFile) > filemtime($this->liveFile)
        ) {
            $configuration = include($this->cacheFile);
        } else {
            $configuration = $this->getYamlConfiguration($app, $this->cacheToDisk);
        }

        return $configuration;
    }

    /**
     * Get the config parameters from a yaml file
     *
     * @param Silex\Application $app         The app instance
     * @param bool              $cacheToDisk Should we cache the result to disk?
     *
     * @return array An array of parameters
     */
    public function getYamlConfiguration(Application $app, $cacheToDisk = true)
    {
        // Load YAML configs
        $yaml = file_get_contents($this->liveFile);
        $yaml = str_replace('__BASEDIR__', $app['base_dir'], $yaml);

        $configuration = Yaml::parse($yaml);

        if ($cacheToDisk === true) {
            $cache = sprintf(
                '<?php return %s;',
                var_export($configuration, true)
            );

            file_put_contents($this->cacheFile, $cache);
        }

        return $configuration;
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
