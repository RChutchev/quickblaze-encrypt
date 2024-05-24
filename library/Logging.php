<?php

/**
 * Handles system logging operations, including error and debug logs. Saves logs and log information to local files.
 */
class Logging
{
    /**
     * Appends a detailed debug/error log to the respective collection file.
     * @return boolean
     * @param string $type The type of log
     * @param array $data The array of data for the log
     */
    function Log($type, $data, $updateStatus = false)
    {
        // Import library classes
        $config = new Configuration;

        // Fetch debug mode configuration
        ($type == "debug") ? $logFile = $config->Fetch("debugging", "source") : $logFile = $config->Fetch("error", "source");

        // Check if debug mode is enabled, if the log type is debug
        if ($type == "debug" && $config->Fetch("debugging", "enabled") == false)
            return false;

        // Create log text
        if (!is_null($data["detail"])) {
            $log = "[" . strtoupper($type) . "] [" . date("Y-m-d H:i:s") . "] " . $data["source"] . " - " . $this->Interpret($data["identifier"]) . ": " . $data["detail"] . "\n";
        } else {
            $log = "[" . strtoupper($type) . "] [" . date("Y-m-d H:i:s") . "] " . $data["source"] . " - " . $this->Interpret($data["identifier"]) . "\n";
        }

        // Check if log file exists
        if (!file_exists($logFile)) {
            touch($logFile);
        }

        // Append log to log file
        file_put_contents($logFile, $log, FILE_APPEND | LOCK_EX);

        // Update error status in configuration file
        if ($updateStatus) {
            $config->Replace(array("error", "enabled"), true);
            $config->Replace(array("error", "identifier"), $data["identifier"]);
        }

        // Return valid execution output
        return true;
    }

    /**
     * Interprets a log identifier into a human readable error message.
     * @return string
     * @param string $identifier The log identifier used to convert into human readable log message
     */
    function Interpret($identifier)
    {
        // Create list of human-readable log messages
        $logMessages = array(
            // Debug messages
            "missingConfigKey" => "Missing configuration key",
            "replacedConfigKey" => "Replaced configuration key",
            "updatedEnvironmentConfiguration" => "Replaced MySQL environment variables",
            // Error messages
            "missingDirectory" => "Server is missing required directories",
            "missingFiles" => "Server is missing required files"
        );

        // Check if log message exists
        if (!array_key_exists($identifier, $logMessages)) {
            return "An internal server error occurred";
        }

        // Return identified log message
        return $logMessages[$identifier];
    }

    /**
     * Checks if the system is in an error state.
     * @return boolean
     */
    function CheckError()
    {
        // Import library classes
        $config = new Configuration;

        // Determine if system is in an error state
        if ($config->Fetch("error", "enabled")) {
            return true;
        } else {
            return false;
        }

    }
}