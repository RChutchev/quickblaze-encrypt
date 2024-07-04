<?php

/**
 * Class StorageHandler
 * 
 * This class handles storage operations.
 */
class StorageHandler
{
    private Configuration $config;
    private Logging $logger;
    private CacheHandler $cache;
    private String $method;
    private Object $database;

    /**
     * StorageHandler constructor.
     * 
     * Initializes a new instance of the StorageHandler class.
     */
    public function __construct()
    {
        $this->config = new Configuration();
        $this->logger = new Logging();
        $this->cache = new CacheHandler();
        $this->method = $this->config->fetch("storage", "type");
        $this->database = $this->fetchConnection();
        $this->setupDatabase();
    }

    /**
     * Fetches the database connection based on the selected method.
     *
     * @return mixed The database connection object or false if an error occurs.
     */
    private function fetchConnection()
    {
        if (!is_dir("./db") && $this->method === "sqlite") {
            mkdir("./db");
            chmod("./db", 0644);
        }
        try {
            if ($this->method === "mysql") {
                // mysql implementation
                $env = parse_ini_file('./.env');
                $database = mysqli_connect(
                    $env["MYSQL_HOST"],
                    $env["MYSQL_USERNAME"],
                    $env["MYSQL_PASSWORD"],
                    $env["MYSQL_DATABASE"],
                    $env["MYSQL_PORT"]
                );
            } else {
                // sqlite implementation
                $database = new SQLite3('./db/database.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                if ($this->config->fetch("debugging", "enabled")) $database->enableExceptions(true);
            }

            // Return database object
            return $database;
        } catch (Exception $e) {
            $this->cache->createCache(["error", ["identifier" => "databaseError"]]);
            $this->logger->log('error', ['source' => __CLASS__, 'identifier' => 'databaseError', 'detail' => $e], true);
            return false;
        }
    }

    /**
     * Sets up the database by creating the necessary table for user uploads.
     *
     * @return bool Returns true if the database setup is successful, false otherwise.
     */
    private function setupDatabase()
    {
        try {
            if ($this->method === "mysql") {
                // mysql implementation
                mysqli_query($this->database, 'CREATE TABLE IF NOT EXISTS `user_uploads` (
                    `upload_id` INT AUTO_INCREMENT PRIMARY KEY,
                    `request_id` VARCHAR(255),
                    `files` VARCHAR(255),
                    `message` VARCHAR(255),
                    `timestamp` VARCHAR(255)
                )');
            } else {
                // sqlite implementation
                $this->database->query('CREATE TABLE IF NOT EXISTS "user_uploads" (
                    "upload_id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                    "request_id" VARCHAR,
                    "files" VARCHAR,
                    "message" VARCHAR,
                    "timestamp" VARCHAR
                )');
            }

            // Return successful execution
            return true;
        } catch (Exception $e) {
            $this->cache->createCache(["error", ["identifier" => "databaseError"]]);
            $this->logger->log('error', ['source' => __CLASS__, 'identifier' => 'databaseError', 'detail' => $e], true);
            return false;
        }
    }

    /**
     * Inserts data into the specified table.
     *
     * @param array $data The data to be inserted.
     * @return bool Returns true if the data was successfully inserted, false otherwise.
     */
    public function insert($data)
    {
        try {
            $columns = "";
            $values = "";
            foreach ($data["data"] as $key => $value) {
                $columns .= $key . ",";
                $values .= "'" . $value . "',";
            }
            $columns = rtrim($columns, ",");
            $values = rtrim($values, ",");
            if ($this->method === "mysql") {
                // mysql implementation
                $query = "INSERT INTO " . $data["table"] . " (" . $columns . ") VALUES (" . $values . ")";
                mysqli_query($this->database, $query);
            } else {
                // sqlite implementation
                $this->database->exec('BEGIN');
                $this->database->query("INSERT INTO " . $data["table"] . " (" . $columns . ") VALUES (" . $values . ")");
                $this->database->exec('COMMIT');
            }

            // Return successful execution
            return true;
        } catch (Exception $e) {
            $this->cache->createCache(["error", ["identifier" => "databaseError"]]);
            $this->logger->log('error', ['source' => __CLASS__, 'identifier' => 'databaseError', 'detail' => $e], true);
            return false;
        }
    }

    public function fetch($data)
    {
        /** 
         * $data structure:
         * [
         *     "table" => "user_uploads",
         *     "columns" => "message",
         *     "where" => [
         *         "request_id" => "e59c0d6e-40e6-403d-8b4e-0ae175965f51"
         *     ]
         * ]
         */
        try {
            if (empty($data["where"])) {
                if ($data["columns"] === "*") {
                    $query = "SELECT * FROM " . $data["table"];
                } else {
                    // where data is empty, column data is all
                    return json_encode(["error"]);
                }
            } else if ($data["columns"] !== "*") {
                $query = "SELECT " . $data["columns"] . " FROM " . $data["table"] . " WHERE " . key($data["where"]) . "=" . $data["where"][key($data["where"])];
            } else {
                // where data is not empty, column data is all
                // ..ignoring where data
                $query = "SELECT * FROM " . $data["table"];
            }
            $result = $this->database->query($query);

            $resArray = [];
            if ($this->method === "mysql") {
                // mysql implementation
                while ($row = $result->fetch_assoc()) {
                    $resArray[] = $row;
                }
            } else {
                // sqlite implementation
                while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                    $resArray[] = $row;
                }
            }
            // Return execution response
            return json_encode($resArray);
        } catch (Exception $e) {
            $this->cache->createCache(["error", ["identifier" => "databaseError"]]);
            $this->logger->log('error', ['source' => __CLASS__, 'identifier' => 'databaseError', 'detail' => $e], true);
            return null;
        }
    }

    /**
     * Deletes a record from the database.
     *
     * @param array $data The data containing the table name and the WHERE clause.
     * @return bool Returns true if the record is successfully deleted, false otherwise.
     */
    public function deleteRecord($data)
    {
        try {
            if ($this->method === "mysql") {
                // mysql implementation
                $this->database->query('DELETE FROM ' . $data["table"] . ' WHERE ' . key($data["where"]) . '=' . $data["where"][key($data["where"])]);
            } else {
                // sqlite implementation
                $this->database->exec('BEGIN');
                $this->database->query('DELETE FROM ' . $data["table"] . ' WHERE ' . key($data["where"]) . '=' . $data["where"][key($data["where"])]);
                $this->database->exec('COMMIT');
            }

            // Return successful execution
            return true;
        } catch (Exception $e) {
            $this->cache->createCache(["error", ["identifier" => "databaseError"]]);
            $this->logger->log('error', ['source' => __CLASS__, 'identifier' => 'databaseError', 'detail' => $e], true);
            return false;
        }
    }

    /**
     * Cleans the storage by deleting records older than 7 days.
     *
     * @return bool Returns true if the storage is cleaned successfully, false otherwise.
     */
    public function cleanStorage()
    {
        try {
            if ($this->method === "mysql") {
                // mysql implementation
                $result = $this->database->query('SELECT * FROM user_uploads');
                while ($row = $result->fetch_assoc()) {
                    $timestamp = strtotime($row['timestamp']);
                    $currentDate = strtotime(date("Y-m-d H:i:s"));
                    $differenceDays = ($currentDate - $timestamp) / 86400;
                    if ($differenceDays > 7) {
                        $this->deleteRecord(["table" => "user_uploads", "where" => ["upload_id" => $row['upload_id']]]);
                    }
                }
                mysqli_query($this->database, 'ALTER TABLE `user_uploads` AUTO_INCREMENT = 1');
            } else {
                // sqlite implementation
                $this->database->exec('BEGIN');
                $this->database->query('DELETE FROM user_uploads WHERE timestamp < DATE_SUB(NOW(), INTERVAL 7 DAY)');
            }
        } catch (Exception $e) {
            $this->cache->createCache(["error", ["identifier" => "databaseError"]]);
            $this->logger->log('error', ['source' => __CLASS__, 'identifier' => 'databaseError', 'detail' => $e], true);
            return false;
        }
    }

    /**
     * Tests the database integrity by checking the connection and performing a simple query.
     *
     * @return bool Returns true if the database integrity is okay, false otherwise.
     */
    public function testIntegrity()
    {
        try {
            if ($this->method === "mysql") {
                // mysql implementation
                if ($this->database->connect_errno) {
                    $this->cache->createCache(["error", ["identifier" => "databaseError"]]);
                    $this->logger->log('error', ['source' => __CLASS__, 'identifier' => 'databaseError', 'detail' => $this->database->connect_error], true);
                    return false;
                }

                $result = $this->database->query('SELECT 1');
                if ($result === false) {
                    $this->cache->createCache(["error", ["identifier" => "databaseError"]]);
                    $this->logger->log('error', ['source' => __CLASS__, 'identifier' => 'databaseError', 'detail' => $this->database->error], true);
                    return false;
                }
            } else {
                // sqlite implementation
                $result = $this->database->query('SELECT 1');
                if ($result === false) {
                    $this->cache->createCache(["error", ["identifier" => "databaseError"]]);
                    $this->logger->log('error', ['source' => __CLASS__, 'identifier' => 'databaseError', 'detail' => $this->database->lastErrorMsg()], true);
                    return false;
                }
            }

            // Successfully validated database integrity
            return true;
        } catch (Exception $e) {
            $this->cache->createCache(["error", ["identifier" => "databaseError"]]);
            $this->logger->log('error', ['source' => __CLASS__, 'identifier' => 'databaseError', 'detail' => $e], true);
            return false;
        }
    }
}
