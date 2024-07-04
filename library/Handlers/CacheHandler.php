<?php

/**
 * Class CacheHandler
 *
 * This class is responsible for managing the caching functionality.
 */
class CacheHandler
{
    private Encryption $encryption;
    private array $clientData;

    /**
     * CacheHandler constructor.
     * Initializes the CacheHandler object and sets the client data.
     */
    public function __construct()
    {
        $this->encryption = new Encryption();
        $this->clientData = [
            "REMOTE_ADDR" => (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER["REMOTE_ADDR"] : $_SERVER["HTTP_CF_CONNECTING_IP"],
            "HTTP_USER_AGENT" => (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER["HTTP_USER_AGENT"] : "",
            "HTTP_REFERER" => (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER["HTTP_REFERER"] : false,
            "HTTP_HOST" => (isset($_SERVER['HTTP_HOST'])) ? (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://" . $_SERVER["HTTP_HOST"] : "",
        ];
    }

    /**
     * Generates an identifier based on the client's IP address.
     *
     * @return string The generated identifier.
     */
    public function identify()
    {
        $id = md5(session_id());
        return $id;
    }

    /**
     * Creates a cache file with the provided cache data.
     *
     * @param array $cacheData The cache data to be stored.
     * @return void
     */
    public function createCache($cacheData)
    {
        $id = $this->identify();
        $file = "./.cache/" . $id . "/.dat";

        // Create cache directory if not exist
        if (!is_dir("./.cache")) {
            mkdir("./.cache");
            chmod("./.cache", 0644);
        }

        if (!is_dir("./.cache/" . $id)) {
            mkdir("./.cache/" . $id);
            chmod("./.cache/" . $id, 0644);
        }

        $data = array(
            "timestamp" => date("Y-m-d H:i:s"),
            "client" => [
                "REMOTE_ADDR" => $this->clientData["REMOTE_ADDR"],
                "HTTP_USER_AGENT" => $this->clientData["HTTP_USER_AGENT"],
                "HTTP_REFERER" => $this->clientData["HTTP_REFERER"],
                "HTTP_HOST" => $this->clientData["HTTP_HOST"]
            ],
            $cacheData[0] => $cacheData[1]
        );

        if (!is_file($file)) touch($file);
        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    }

    /**
     * Fetches the cache data.
     *
     * This method retrieves the cache data from the specified file path.
     *
     * @return mixed The cache data if it exists, otherwise false.
     */
    public function fetchCache()
    {
        $id = $this->identify();
        $file = "./.cache/" . $id . "/.dat";
        $data = json_decode(file_get_contents($file), true);
        return (is_null($data)) ? null : $data;
    }

    /**
     * Deletes the cache for the current instance.
     *
     * @return bool Returns true if the cache is successfully deleted, false otherwise.
     */
    public function deleteCache()
    {
        try {
            $id = $this->identify();
            $loc = "./.cache/" . $id;
            if (is_dir($loc) && file_exists($loc . "/.dat")) {
                unlink($loc . "/.dat");
                rmdir($loc);
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Cleans the cache by removing expired cache files.
     *
     * @return void
     */
    public function cleanCache()
    {
        $cacheStore = "./.cache/";
        $cacheDirs = glob($cacheStore . "*");
        $now = time();

        try {
            // Loop through each cache folder in cache store folder
            foreach ($cacheDirs as $cacheDir) {
                if (is_dir($cacheDir)) {

                    // Decode cache JSON data from file
                    $cacheFile = $cacheDir . "/.dat";
                    $cacheData = json_decode(file_get_contents($cacheFile), true);

                    // Determine time difference between now and when cache was created
                    $cacheTimestamp = strtotime($cacheData["timestamp"]);
                    $diff = $now - $cacheTimestamp;
                    $hours = $diff / (60 * 60);

                    // Check if cache is expired and delete expired cache
                    if ($hours > 24) {
                        unlink($cacheFile);
                    }
                }
            }
        } catch (Exception $e) {
            // Return error
            $this->createCache(["error", ["identifier" => "unexpectedError"]]);
            // $this->logger->log('error', ['source' => __CLASS__, 'identifier' => 'unexpectedError'], true);
            return false;
        }

        // Output successful execution
        return true;
    }
}
