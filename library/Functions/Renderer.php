<?php

/**
 * Class Renderer
 * 
 * This class is responsible for rendering content.
 */
class Renderer
{
    private Configuration $config;
    private CacheHandler $cache;
    private Logging $logger;

    /**
     * Constructor for the Renderer class.
     * Initializes the Configuration, CacheHandler, and Logging objects.
     */
    public function __construct()
    {
        $this->config = new Configuration();
        $this->cache = new CacheHandler();
        $this->logger = new Logging();
    }

    /**
     * Interprets the current request URI and returns the corresponding file name.
     *
     * @return string The interpreted file name.
     */
    public function Interpret()
    {
        // remove file extension and query string
        $file = str_replace(".php", "", str_replace("/", "", $_SERVER["REQUEST_URI"]));
        $file = explode("?", $file)[0];

        // prevent direct access to error.view.php or index.view.php
        if ($file === "error" || $file === "index") return;

        // return formatted file name
        return (empty($file)) ? "index" : $file;
    }

    /**
     * Renders the file based on the error state and returns the rendered content.
     *
     * @param bool $errorState Indicates whether the system is in an error state.
     * @return string The rendered file content.
     */
    public function Render($errorState)
    {
        try {
            // Interpret the file to be rendered
            $file = ($errorState) ? "error" : $this->Interpret();

            // Determine if system is in an error state, and check if requested view file exists.
            if (file_exists("./public/" . $file . ".view.php")) {
                $errorState = false;
                $this->cache->deleteCache();
                $file = file_get_contents("./public/" . $file . ".view.php");
            } else {
                $errorState = true;
                $this->cache->createCache(["error", ["identifier" => "fileNotFound"]]);
                $file = file_get_contents("./public/error.view.php");
            }

            // Variable mappings
            $variables = $this->getVariables($errorState);

            // Parse variables into file
            foreach ($variables as $variable => $value) {
                $file = str_replace("{{" . $variable . "}}", $value, $file);
            }

            // Output determined file
            return $file;
        } catch (Exception $e) {
            // Handle exceptions and log errors
            $this->cache->createCache(["error", ["identifier" => "unexpectedError"]]);
            $this->logger->Log("error", ["source" => __CLASS__, "identifier" => "unexpectedError"], true);
        }
    }

    /**
     * Retrieves an array of variables used for rendering.
     *
     * @param bool $errorState Indicates whether the system is in an error state.
     * @return array An array of variables used for rendering.
     */
    private function getVariables($errorState)
    {
        $variables = [
            "request_identifier" => md5(date("Y-m-d H:i:s")),
            "http_host" => (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://" . $_SERVER["HTTP_HOST"],
            "system_year" => date("Y"),
            "version_label" => "v" . $this->config->fetch("version", "major") . "." . $this->config->fetch("version", "minor") . "." . $this->config->fetch("version", "build"),
            "max_upload_size" => $this->config->fetch("app_config", "max_upload_size"),
            "max_upload_count" => $this->config->fetch("app_config", "max_upload_count")
        ];

        // Inject error variables if in an error state
        if ($errorState && $this->cache->fetchCache() != null) {
            $cacheData = $this->cache->fetchCache();
            $variables["error_message"] = $this->logger->Interpret($cacheData["error"]["identifier"], "error")["message"];
            $variables["error_code"] = $this->logger->Interpret($cacheData["error"]["identifier"], "error")["code"];
        } else {
            $errorState = false;
        }

        return $variables;
    }
}
