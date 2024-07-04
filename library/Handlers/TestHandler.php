<?php

use Ramsey\Uuid\Uuid;

class TestHandler
{
    public bool $isTestingMode = false; // Should the system be in testing mode?

    public function __construct()
    {
        // Inject dark mode theme to page for development
        echo '<style>:root{color: white;font-family:\'Arial\'} body{background-color: #2b2d31;}</style>';
    }

    function runTests()
    {
        /**
         * Current test: StorageHandler
         */

        $storage = new StorageHandler();

        // $storage->insert([
        //     "table" => "user_uploads",
        //     "data" => [
        //         "request_id" => Uuid::uuid4()->toString(),
        //         "files" => json_encode(["filename" => "file.png"]),
        //         "message" => "Hello world!",
        //         "timestamp" => date("Y-m-d H:i:s")
        //     ]
        // ]);

        // $storage->deleteRecord(["table" => "user_uploads", "where" => ["upload_id" => "51"]]);

        // $dat = json_decode($storage->fetch([
        //     "table" => "user_uploads",
        //     "columns" => "*",
        //     "where" => ["where" => "1"]
        // ]));

        // print_r($dat[2]->request_id);
        // echo $dat["upload_id"];
    }
}
