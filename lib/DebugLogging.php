<?php

class DebugLogging
{
    /**
     * Appends a detailed error log to the system error collection file.
     * @return boolean
     */
    function Log($source, $identifier, $data = null)
    {
        // Fetch debug mode configuration
        $config = new Configuration;
        $debugMode = $config->Fetch("debugging", "enabled");
        $debugFile = $config->Fetch("debugging", "source");

        // Check if debug mode is enabled
        if ($debugMode == true) {

            // Create log text
            $message = $this->Interpret($identifier);
            if ($data) {
                $log = "[" . date("Y-m-d H:i:s") . "] " . $source . " - " . $message . ": " . $data . "\n";
            } else {
                $log = "[" . date("Y-m-d H:i:s") . "] " . $source . " - " . $message . "\n";
            }

            // Check if log file exists
            if (!file_exists("./errors.log")) {
                touch("./errors.log");
            }

            // Append log to log file
            file_put_contents("./errors.log", $log, FILE_APPEND | LOCK_EX);

            // Return valid execution output
            return true;
        }
    }

    /**
     * Interprets a log identifier into a human readable error message.
     * @return string
     */
    function Interpret($identifier)
    {
        // Create list of human-readable log messages
        $logMessages = array(
            "missingConfigKey" => "Missing configuration key",
            "replacedConfigKey" => "Replaced configuration key",
            "updatedEnvironmentConfiguration" => "Replaced MySQL environment variables"
        );

        // Check if log message exists
        if (is_null($logMessages[$identifier])) {
            return "Error";
        }

        // Return identified log message
        return $logMessages[$identifier];
    }
}