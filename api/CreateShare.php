<?php
// Import library classes
include '../library/Configuration.php';
include '../library/Logging.php';

// Check if file is specified in GET request


// Validate file(s)


// Upload file to server via configured storage method


// Add each file to files array
$ds = DIRECTORY_SEPARATOR;
$storeFolder = '../local-storage/';

// Check if storage directory exists
if (!is_dir("../local-storage/")) {
    mkdir("../local-storage/");
}

// Check if storage unique directory exists
if (!is_dir("../local-storage/" . $_GET["reqid"])) {
    mkdir("../local-storage/" . $_GET["reqid"]);
}

$tempFile = $_FILES['file']['tmp_name'];
$targetPath = dirname(__FILE__) . $ds . $storeFolder . $ds . $_GET["reqid"];
$targetFile = $targetPath . $_FILES['file']['name'];

// Move file to storage folder
move_uploaded_file($tempFile, $targetFile);

// Output result
echo json_encode(array("id" => $_GET["reqid"], "output" => array("success" => true, "files" => $_FILES['file']['name']), "timestamp" => date("Y-m-d H:i:s")), JSON_PRETTY_PRINT);
