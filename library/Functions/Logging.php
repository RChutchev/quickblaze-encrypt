<?php

/**
 * Handles system logging operations, including error and debug logs. Saves
 * logs and log information to local files.
 */
class Logging
{

    /**
     * Appends a detailed debug/error log to the respective collection file.
     * 
     * @param string $type The type of log (either 'debug' or 'error')
     * @param array $data The array of data for the log, including source and identifier
     * @param bool $updateStatus Optional parameter to update the error status in the configuration
     * @return void
     */
    public function Log(string $type, array $data)
    {
        try {
            // Fetch and decode configuration file
            $configuration = json_decode(file_get_contents('./config.json'), true);
        } catch (Exception $e) {
            // Log overrides
            $type = "error";
            $data = ["source" => __CLASS__, "identifier" => "badConfiguration"];
        }

        // Determine the log file path based on the log type
        $logFile = $type === 'debug'
            ? $configuration["debugging"]["debug_logs_source"]
            : $configuration["debugging"]["error_logs_source"];

        // Check if debugging is enabled, return false if it is not
        if ($type === 'debug' && !$configuration["debugging"]["enabled"]) {
            return false;
        }

        // Format the log entry
        $log = sprintf(
            '[%s] [%s] %s - %s%s' . PHP_EOL,
            strtoupper($type),
            date('Y-m-d H:i:s'),
            $data['source'],
            $this->interpret($data['identifier'], $type)['message'],
            !empty($data['detail']) ? ': ' . $data['detail'] : ''
        );

        // Ensure the log file exists, create it if it does not
        if (!file_exists($logFile)) {
            touch($logFile);
            chmod($logFile, 0600);
        }

        // Write the log entry to the log file
        file_put_contents($logFile, $log, FILE_APPEND | LOCK_EX);
    }

    /**
     * Interprets a log identifier into a human-readable error message.
     * 
     * @param string $identifier The log identifier used to convert into a human-readable log message
     * @param string $logType The type of log to be identified and interpreted
     * @return array Returns an array containing the log message and the corresponding error code
     */
    function Interpret($identifier, $logType)
    {
        // Stores messages related to successful operations and system warnings.
        $debugMessages = array(
            "successfulPreparation" => ["message" => "System prepared succesfully", "code" => 200],
            "replacedConfig" => ["message" => "Configuration reset", "code" => 200],
            "replacedConfigKey" => ["message" => "Key reset to default value", "code" => 200],
            "updatedEnvConfiguration" => ["message" => "Environment configuration has been updated", "code" => 200],
            "downloadedFilterList" => ["message" => "Downloaded MIME type filter list", "code" => 200],
            "downloadedSecurityFile" => ["message" => "Downloaded .htaccess security file", "code" => 200],
            "createdDir" => ["message" => "Created directory", "code" => 200],
        );

        // Stores messages related to system errors.
        $errorMessages = array(
            "badConfiguration" => ["message" => "Missing or invalid configuration", "code" => 500],
            "missingDirectory" => ["message" => "Required directory is missing", "code" => 500],
            "missingFiles" => ["message" => "Required file is missing", "code" => 500],
            "fileNotFound" => ["message" => "Requested resource not found", "code" => 404],
            "unexpectedError" => ["message" => "An unexpected error occurred", "code" => 500],
            "systemIntegrity" => ["message" => "bad system integrity (WIP)", "code" => 500],
            "storageIntegrity" => ["message" => "bad storage integrity (WIP)", "code" => 500],
            "downloadingFilterList" => ["message" => "Failed to update server files", "code" => 400],
            "databaseError" => ["message" => "Failed to execute database operation", "code" => 500],
        );

        // Check if log message exists, if not set a default error message
        $translations = ($logType === "error") ? $errorMessages : $debugMessages;
        if (!array_key_exists($identifier, $translations)) {
            $translations[$identifier] = 'An unexpected error occurred';
        }

        // Return identified log message and code
        return $translations[$identifier];
    }
}
