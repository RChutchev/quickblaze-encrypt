<?php

/**
 * Handles system configuration operations such as validation, replacing, updating, reseting, etc.
 */
class Configuration
{

    /**
     * Validates the system configuration and returns a boolean output on success or failure.
     * @return boolean
     */
    function Check()
    {
        // Import library classes
        $logger = new Logging;

        // Check if config file exists
        if (!file_exists('./config.json')) {

            // Create configuration file
            touch("./config.json");

            // Replace new configuration with default config values
            $this->Reset();

            // Return true, as new configuration is valid
            return true;
        }

        // Get configuration file
        $configuration = file_get_contents('./config.json');

        // Decode configuration file
        $config = json_decode($configuration, true);

        // Check if environment configuration file is present
        if (!file_exists("./.env")) {
            touch("./.env");
        }

        // Check if MYSQL values are set in environment configuration file
        $env = parse_ini_file('./.env');
        if (is_null($env["MYSQL_HOST"]) || is_null($env["MYSQL_USERNAME"]) || is_null($env["MYSQL_PASSWORD"]) || is_null($env["MYSQL_DATABASE"]) || is_null($env["MYSQL_PORT"])) {
            file_put_contents('./.env', "MYSQL_HOST=\nMYSQL_USERNAME=\nMYSQL_PASSWORD=\nMYSQL_DATABASE=\nMYSQL_PORT=");
            $logger->log("debug", array("source" => $_SERVER["PHP_SELF"], "identifier" => "updatedEnvironmentConfiguration"));
        }

        // Check if version data is present
        if (is_null($config["version"]["major"]) || is_null($config["version"]["minor"])) {
            $this->Reset("version");
        }

        // Check if storage data is present
        if (is_null($config["storage"])) {
            $this->Reset("storage");
        }
        if (is_null($config["storage"]["type"])) {
            $this->Reset("storage", "type");
        }

        // Check if debug mode data is present
        if (is_null($config["debugging"]["enabled"]) || is_null($config["debugging"]["source"])) {
            $this->Reset("debugging");
        }

        // Check if error staus data is present
        if (is_null($config["error"]["source"])) {
            $this->Reset("error");
        }

        // Return response output
        return true;
    }

    /**
     * Returns requested JSON value from system configuration.
     * @return string|boolean|object|integer|null
     * @param string $keyX The configuration key to fetch
     * @param string $keyY The nested configuration key of $keyX to fetch
     * @param string $keyZ The nested configuration key of $keyY to fetch
     */
    function Fetch($keyX, $keyY = null, $keyZ = null)
    {
        // Get configuration file
        $configuration = file_get_contents('./config.json');

        // Decode configuration file
        $configuration = json_decode($configuration, true);

        // Return requested data
        if (!$keyX && !$keyY && !$keyZ) {
            return null;
        } else if ($keyX && $keyY && $keyZ) {
            return $configuration[$keyX][$keyY][$keyZ];
        } else if ($keyX && $keyY) {
            return $configuration[$keyX][$keyY];
        } else if ($keyX) {
            return $configuration[$keyX];
        }
    }

    /**
     * Updates specified configuration values.
     * @return void
     * @param array $keyData The configuration key to update
     * @param mixed $newData The data to set in place of $keyData
     */
    function Replace($keyData, $newData)
    {
        // Import library classes
        $logger = new Logging;

        // Get configuration file
        $configuration = file_get_contents('./config.json');

        // Decode configuration file
        $configuration = json_decode($configuration, true);

        // Determine which configuration values to update
        if ($keyData[0] && $keyData[1] && $keyData[2]) {
            $configuration[$$keyData[0]][$keyData[1]][$keyData[2]] = $newData;
            $logger->log("debug", array("source" => $_SERVER["PHP_SELF"], "identifier" => "replacedConfigKey", "detail" => $keyData[0] . " => " . $keyData[1] . " => " . $keyData[2]));
        } else if ($keyData[0] && $keyData[1]) {
            $configuration[$keyData[0]][$keyData[1]] = $newData;
            $logger->log("debug", array("source" => $_SERVER["PHP_SELF"], "identifier" => "replacedConfigKey", "detail" => $keyData[0] . " => " . $keyData[1]));
        } else if ($keyData[0]) {
            $configuration[$keyData[0]] = $newData;
            $logger->log("debug", array("source" => $_SERVER["PHP_SELF"], "identifier" => "replacedConfigKey", "detail" => $keyData[0]));
        }

        // Encode new JSON
        $configuration = json_encode($configuration);

        // Update configuration file with new JSON
        file_put_contents('./config.json', $configuration);
    }

    /**
     * Resets specific values of the system configuration to default values. Resets entire configuration if no keys are specified.
     * @return void
     * @param string $keyX The configuration item to update
     * @param string $keyY The nested configuration key of $keyX to update
     * @param string $keyZ The nested configuration key of $keyY to update
     */
    function Reset($keyX = null, $keyY = null, $keyZ = null)
    {
        // Import library classes
        $logger = new Logging;

        // Get environment variables
        $env = parse_ini_file('./.env');

        // Construct default configuration values blueprint
        $blueprint = array(
            "version" => array(
                "major" => 1,
                "minor" => 0,
                "build" => 0,
            ),
            "storage" => array(
                "type" => "local"
            ),
            "debugging" => array(
                "enabled" => true,
                "source" => "./debug.log"
            ),
            "error" => array(
                "source" => "./errors.log",
                "enabled" => false,
                "identifier" => ""
            ),
        );

        // Get configuration file
        $configuration = file_get_contents('./config.json');

        // Decode configuration file
        $configuration = json_decode($configuration, true);

        // Determine if the entire configuration should be replaced
        if (!$keyX && !$keyY && !$keyZ) {
            $configuration = $blueprint;
            $logger->log("debug", array("source" => $_SERVER["PHP_SELF"], "identifier" => "replacedConfigKey", "detail" => "{}"));
        }

        // Determine which specific keys should be replaced
        if ($keyX && $keyY && $keyX) {
            $configuration[$keyX][$keyY][$keyZ] = $blueprint[$keyX][$keyY][$keyZ];
            $logger->log("debug", array("source" => $_SERVER["PHP_SELF"], "identifier" => "replacedConfigKey", "detail" => "$keyX => $keyY => $keyZ"));
        } else if ($keyX && $keyY) {
            $configuration[$keyX][$keyY] = $blueprint[$keyX][$keyY];
            $logger->log("debug", array("source" => $_SERVER["PHP_SELF"], "identifier" => "replacedConfigKey", "detail" => "$keyX => $keyY"));
        } else if ($keyX) {
            $configuration[$keyX] = $blueprint[$keyX];
            $logger->log("debug", array("source" => $_SERVER["PHP_SELF"], "identifier" => "replacedConfigKey", "detail" => "$keyX"));
        }

        // Encode new JSON
        $configuration = json_encode($configuration);

        // Update configuration file with new JSON
        file_put_contents('./config.json', $configuration);
    }
}