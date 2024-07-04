<?php

/**
 * Class Configuration
 * 
 * This class represents the configuration settings for the system.
 */
class Configuration
{
    public array $blueprint;

    /**
     * Configuration constructor.
     * 
     * Initializes the configuration settings with default values.
     */
    public function __construct()
    {
        $this->blueprint = [
            'environment' => [
                'status' => 'production',
            ],
            'version' => [
                'major' => 1,
                'minor' => 0,
                'build' => 0,
            ],
            'storage' => [
                'type' => 'sqlite',
            ],
            'debugging' => [
                'debug_logs_source' => './debug.log',
                'error_logs_source' => './error.log',
                'enabled' => true,
            ],
            'app_config' => [
                'max_upload_size' => 100,
                'max_upload_count' => 10
            ],
        ];
    }

    /**
     * Fetches the value from the configuration file based on the provided keys.
     *
     * @param string $key1 The first key.
     * @param string|null $key2 The second key (optional).
     * @param string|null $key3 The third key (optional).
     * @return mixed|null The value from the configuration file, or null if not found.
     */
    public function fetch(string $key1, string $key2 = null, string $key3 = null): mixed
    {
        $configuration = json_decode(file_get_contents('./config.json'), true);
        if ($key2 === null) {
            return $configuration[$key1];
        } elseif ($key3 === null) {
            return $configuration[$key1][$key2];
        } else {
            return $configuration[$key1][$key2][$key3];
        }
        return null;
    }

    /**
     * Executes the settings based on the environment status.
     *
     * If the environment status is 'production', error reporting is turned off and
     * display errors are disabled. In development environments, all errors are reported
     * and display errors are enabled.
     *
     * @return void
     */
    public function setPreferences()
    {
        $configuration = json_decode(file_get_contents('./config.json'), true);
        if ($configuration["environment"]["status"] === 'production') {
            // Turn off error reporting in production environments
            error_reporting(0);
            ini_set('display_errors', false);
        } else {
            // Report all errors in development environments
            error_reporting(E_ALL);
            ini_set('display_errors', true);
        }
    }
}
