<?php

/**
 * Class Validation
 * 
 * This class represents the validation system of the application.
 */
class Validation
{
    public array $blueprint;
    private Configuration $config;

    public function __construct()
    {
        $this->config = new Configuration();
        $this->blueprint = $this->config->blueprint;
    }

    /**
     * Validates the configuration by checking if the required values are present in the config file.
     * If any value is missing, it updates it with the default value from the blueprint and saves the changes to the config file.
     *
     * @return bool Returns true if the configuration is valid, otherwise false.
     */
    public function validateConfiguration()
    {
        if (!is_file('./config.json')) {
            touch('./config.json');
            chmod('./config.json', 0644);
        }

        $config = json_decode(file_get_contents('./config.json'), true);

        // Loop through configuration values and check if they are present. update them to $blueprint values if they are missing using updateKey()
        foreach ($this->blueprint as $key => $value) {
            if (!isset($config[$key]) || empty($config[$key])) {
                $config[$key] = $this->blueprint[$key];
                echo $key . PHP_EOL;
                file_put_contents('./config.json', json_encode($config, JSON_PRETTY_PRINT));
            }
        }

        // Output result
        return true;
    }


    /**
     * Validates the environment configuration and updates it if necessary.
     *
     * This function checks if the storage setting is set to use the .env file.
     * If it is, it checks if the environment configuration file is present.
     * If not, it creates the file.
     * It then checks for and replaces empty environment variables with default values.
     * Finally, it updates the configuration file with the new values.
     *
     * @return bool Returns true if the environment is valid and updated successfully, false otherwise.
     */
    public function validateEnvironment()
    {
        // Check if the storage setting is set to use the .env file
        $config = json_decode(file_get_contents('./config.json'), true);
        if ($config["storage"]["type"] === "mysql") {

            // Check if environment configuration file is present
            if (!file_exists("./.env")) {
                touch("./.env");
                chmod("./.env", 0644);
            }

            // Checks for and replaces empty environment variables
            $env = parse_ini_file('./.env');
            if (empty($env['MYSQL_HOST']) || empty($env['MYSQL_USERNAME']) || empty($env['MYSQL_DATABASE']) || empty($env['MYSQL_PORT'])) {

                // Determine placeholder or pre-existing values
                $mysql_host = (empty($env['MYSQL_HOST'])) ? 'localhost' : $env['MYSQL_HOST'];
                $mysql_username = (empty($env['MYSQL_USERNAME'])) ? 'user' : $env['MYSQL_USERNAME'];
                $mysql_database = (empty($env['MYSQL_PASSWORD'])) ? 'password' : $env['MYSQL_PASSWORD'];
                $mysql_database = (empty($env['MYSQL_DATABASE'])) ? 'database' : $env['MYSQL_DATABASE'];
                $mysql_port = (empty($env['MYSQL_PORT'])) ? '3306' : $env['MYSQL_PORT'];

                // Update configuration file
                file_put_contents('./.env', "MYSQL_HOST=" . $mysql_host . "\nMYSQL_USERNAME=" . $mysql_username . "\nMYSQL_PASSWORD=" . $env['MYSQL_PASSWORD'] . "\nMYSQL_DATABASE=" . $mysql_database . "\nMYSQL_PORT=" . $mysql_port);
            }
        }

        // Output result
        return true;
    }
}
