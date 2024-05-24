<?php

/**
 * Handles the rendering of files to the browser. Parses variables before output, and checks for errors for interception.
 */
class Renderer
{
    /**
     * Renders a public-facing PHP file by parsing variables and checking for error intercepts.
     * @return string
     * @param string $file The file name to render, located in the /public directory.
     */
    function Render($file)
    {
        // Import library classes
        $config = new Configuration;
        $logger = new Logging;

        // Get required file
        if ($config->Fetch("error", "enabled")) {
            $file = file_get_contents("./public/error.php");
        } else {
            $file = file_get_contents("./public/" . $file);
        }

        // Variable mappings
        $variables = array(
            "version" => "v" . $config->Fetch("version", "major") . "." . $config->Fetch("version", "minor") . "." . $config->Fetch("version", "build"),
        );

        // Add error details to mappings
        if ($config->Fetch("error", "enabled")) {
            $variables["error_identifier"] = $logger->Interpret($config->Fetch("error", "identifier"));
        }

        // Parse variables into file
        foreach ($variables as $variable => $value) {
            $file = str_replace("{{" . $variable . "}}", $value, $file);
        }

        // Determine if system is in an error state
        echo $file;

    }
}