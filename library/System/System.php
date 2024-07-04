<?php

/**
 * Class System
 * 
 * This class is responsible for initializing the necessary components of the system.
 */
class System
{
    private Validation $validation;
    private Configuration $config;
    private Integrity $integrity;
    private Renderer $renderer;
    private CacheHandler $cache;
    private StorageHandler $storage;
    private TestHandler $testing;
    private Object $database;

    /**
     * System prepare constructor.
     * 
     * Initializes the configuration, integrity, and renderer objects.
     * Validates the system and renders accordingly.
     */
    public function __construct()
    {
        // Start session
        session_start();

        // Import system modules
        $this->validation = new Validation();
        $this->config = new Configuration();
        $this->integrity = new Integrity();
        $this->renderer = new Renderer();
        $this->cache = new CacheHandler();
        $this->storage = new StorageHandler();
        $this->testing = new TestHandler();

        // Cleanse system cache and storage
        $this->cache->cleanCache();
        $this->storage->cleanStorage();

        // Check if the system is in testing mode
        if ($this->testing->isTestingMode) {
            $this->testing->runTests();
            return; // Prevent execution of non-testing functions
        }

        // Set system preferences
        $this->config->setPreferences();

        // Render requested files
        if (!$this->validate()) {
            echo $this->renderer->Render(true);
        } else {
            echo $this->renderer->Render(false);
        }
    }

    /**
     * Validate system configuration and integrity
     * 
     * This method checks the system configuration and file/storage integrity.
     * If any checks fail, it returns false.
     * 
     * @return bool
     */
    private function validate()
    {
        // Validate system configurations
        if (!$this->validation->validateConfiguration()) return false;
        if (!$this->validation->validateEnvironment()) return false;

        // File & storage integrity validation
        if (!$this->integrity->validateSystem()) return false;
        if (!$this->integrity->validateStorage()) return false;

        // If all checks pass, return true
        return true;
    }
}
