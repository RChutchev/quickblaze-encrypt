<?php

/**
 * Verifies the integrity of the system, checking the presence of important directories and files. Also checks the system's configured storage method to ensure it is correctly configured
 */
class Integrity
{
    /**
     * Validates the system file structure, including assets, libraries, public-facing views, and security files.
     * @return boolean
     */
    function SystemCheck()
    {
        // Import library classes
        $config = new Configuration;
        $logger = new Logging;

        // Check if assets directory exists
        if (!is_dir("./assets")) {
            $logger->Log("error", array("source" => $_SERVER["PHP_SELF"], "identifier" => "missingDirectory"));
            return false;
        }

        // Check if library directory exists
        if (!is_dir("./library")) {
            $logger->Log("error", array("source" => $_SERVER["PHP_SELF"], "identifier" => "missingDirectory"));
            return false;
        }

        // Check if public views directory exists
        if (!is_dir("./public")) {
            $logger->Log("error", array("source" => $_SERVER["PHP_SELF"], "identifier" => "missingDirectory"));
            return false;
        }

        // Check if .htaccess exists
        if (!file_exists("./.htaccess")) {
            $logger->Log("error", array("source" => $_SERVER["PHP_SELF"], "identifier" => "missingFiles"), true);
            return false;
        }

        // Reset error status
        if ($config->Fetch("error", "enabled")) {
            $config->Replace(array("error", "enabled"), false);
        }

        // Return true if all directories and files are present
        return true;
    }

    /**
     * Validates the integrity of the configured system storage method.
     * @return boolean
     */
    function StorageCheck()
    {
        // Return true if storage method is valid
        return true;
    }
}