<?php

/**
 * Verifies the integrity of the system, checking the presence of important directories
 * and files. Also checks the system's configured storage method to ensure it is 
 * correctly configured.
 */
class Integrity
{
    private Logging $logger;
    private CacheHandler $cache;
    private StorageHandler $storage;

    public function __construct()
    {
        $this->logger = new Logging();
        $this->cache = new CacheHandler();
        $this->storage = new StorageHandler();
    }

    /**
     * Validates the system file structure, including assets, libraries, public-facing 
     * views, and security files.
     * @return boolean
     */
    function validateSystem()
    {
        // Check required directories
        $requiredDirs = ['./assets', './library', './public', './api'];
        foreach ($requiredDirs as $dir) {
            if (!is_dir($dir)) {
                $this->logger->log('error', ['source' => __CLASS__, 'identifier' => 'missingDirectory']);
                $this->cache->createCache(["error", ["identifier" => "missingDirectory"]]);
                return false;
            }
            return true;
        }

        // Check if .htaccess exists
        if (!file_exists('./.htaccess')) {
            $this->cache->createCache(["error", ["identifier" => "missingFiles"]]);
            $this->logger->log('error', ['source' => __CLASS__, 'identifier' => 'missingFiles'], true);
            return false;
        }

        // Return true if all directories and files are present
        return true;
    }

    /**
     * Validates the integrity of the configured system storage method.
     * @return boolean
     */
    function validateStorage()
    {
        // Return true if connection is successful and table structure is valid
        if (!$this->storage->testIntegrity()) return false;
        return true;
    }
}
