<?php

class Configuration
{

    /**
     * Validates the system configuration and returns a boolean output on success or failure.
     * @return boolean
     */
    function CheckConfig()
    {
        // Debug log class to log changes made  
        $debug = new DebugLogging;

        // Check if config file exists
        if (!file_exists('./config.json')) {

            // Create configuration file
            touch("./config.json");

            // Replace new configuration with default config values
            $this->Replace();

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
            $debug->log($_SERVER["PHP_SELF"], "updatedEnvironmentConfiguration");
        }

        // Check if version data is present
        if (is_null($config["version"]["major"]) || is_null($config["version"]["minor"])) {
            $this->Replace("version");
        }

        // Check if storage data is present
        if (is_null($config["storage"])) {
            $this->Replace("storage");
        }
        if (is_null($config["storage"]["type"])) {
            $this->Replace("storage", "type");
        }
        if (is_null($config["storage"]["connection"])) {
            $this->Replace("storage", "connection");
        }
        if (is_null($config["storage"]["connection"]["host"])) {
            $this->Replace("storage", "connection", "host");
        }
        if (is_null($config["storage"]["connection"]["username"])) {
            $this->Replace("storage", "connection", "username");
        }
        if (is_null($config["storage"]["connection"]["password"])) {
            $this->Replace("storage", "connection", "password");
        }
        if (is_null($config["storage"]["connection"]["host"])) {
            $this->Replace("storage", "connection", "host");
        }
        if (is_null($config["storage"]["connection"]["port"])) {
            $this->Replace("storage", "connection", "port");
        }

        // Check if debug mode data is present
        if (is_null($config["debugging"]["enabled"]) || is_null($config["debugging"]["source"])) {
            $this->Replace("debugging");
        }

        // Return response output
        return true;
    }

    /**
     * Returns requested JSON value from system configuration.
     * @return mixed
     * @param string $keyX The configuration key to fetch
     * @param string $keyY The nested configuration key of $keyX to fetch
     * @param string $keyZ The nested configuration key of $keyY to fetch
     */
    function Fetch($keyX, $keyY = null, $keyZ = null)
    {
        // Get configuration file
        $configuration = file_get_contents('./config.json');

        // Decode configuration file
        $data = json_decode($configuration, true);

        // Return requested data
        if (!$keyX && !$keyY && !$keyZ) {
            return null;
        } else if ($keyX && $keyY && $keyZ) {
            return $data[$keyX][$keyY][$keyZ];
        } else if ($keyX && $keyY) {
            return $data[$keyX][$keyY];
        } else if ($keyX) {
            return $data[$keyX];
        }

    }

    /**
     * Replaces specific values of the system configuration. Replaces entire configuration with default values, if no keys to update are specified.
     * @return void
     * @param string $keyX The configuration item to update
     * @param string $keyY The nested configuration key of $keyX to update
     * @param string $keyZ The nested configuration key of $keyY to update
     */
    function Replace($keyX = null, $keyY = null, $keyZ = null)
    {
        // Debug log class to log changes made  
        $debug = new DebugLogging;

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
                "type" => "filetree",
                "connection" => array(
                    "host" => $env["MYSQL_HOST"],
                    "username" => $env["MYSQL_USERNAME"],
                    "password" => $env["MYSQL_PASSWORD"],
                    "database" => $env["MYSQL_DATABASE"],
                    "port" => $env["MYSQL_PORT"]
                )
            ),
            "debugging" => array(
                "enabled" => true,
                "source" => "./errors.log"
            ),
        );

        // Get configuration file
        $configuration = file_get_contents('./config.json');

        // Decode configuration file
        $data = json_decode($configuration, true);

        // Determine if the entire configuration should be replaced
        if (!$keyX && !$keyY && !$keyZ) {
            $data = $blueprint;
            $debug->log($_SERVER["PHP_SELF"], "replacedConfigKey", "{}");
        }

        // Determine which specific keys should be replaced
        if ($keyX) {
            $data[$keyX] = $blueprint[$keyX];
            $debug->log($_SERVER["PHP_SELF"], "replacedConfigKey", "$keyX");
        } else if ($keyX && $keyY) {
            $data[$keyX][$keyY] = $blueprint[$keyX][$keyY];
            $debug->log($_SERVER["PHP_SELF"], "replacedConfigKey", "$keyX => $keyY");
        } else if ($keyX && $keyY && $keyX) {
            $data[$keyX][$keyY][$keyZ] = $blueprint[$keyX][$keyY][$keyZ];
            $debug->log($_SERVER["PHP_SELF"], "replacedConfigKey", "$keyX => $keyY => $keyZ");
        }

        // Encode new JSON
        $configuration = json_encode($data);

        // Update configuration file with new JSON
        file_put_contents('./config.json', $configuration);
    }
}