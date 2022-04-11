<?php
/* Internal Script Functions */
function processData($data)
{
    $encryptionKey = generateKey(); // Create new key
    $encryptedData = encryptData($data, $encryptionKey); // Encrypt data
    insertRecord($encryptedData, $encryptionKey); // Insert new database record
    return $encryptionKey;
}
function viewMessageContent()
{
    if(getRecord("encrypted_contents", $_GET["key"]) == null) {
        header("Location: 404");
    } else{
        if (!isset($_GET["confirm"])) {
            echo '<h6>Decrypt & View Message?</h6>
        <a class="btn btn-primary submit-button" href="?confirm&key=' . $_GET["key"] . '">View Message</a>';
        } else {
            echo '<h6>This message has been destroyed!</h6><textarea type="text" class="form-control" id="floatingInput" placeholder="Secret message" required name="data">' . decryptData($_GET["key"]) . '</textarea>';
            destroyRecord($_GET["key"]);
        }
    }
}
function getSubmittedKey()
{
    if (isset($_GET['submitted'])) {
        $fullUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . str_replace("?submitted=", "view?key=", $_SERVER['REQUEST_URI']);
        echo $fullUrl;
    }
}
function determineSubmissionFooter()
{
    if (isset($_GET["submitted"])) {
        echo '<br><p class="text-muted">Share this link anywhere on the internet. The message will be automatically destroyed once viewed.</p><a class="btn btn-primary submit-button" href="./">Create New</a>';
    } else {
        echo '<br><button class="btn btn-primary submit-button" type="submit">Create One-Time Link</button>';
    }
}

/* Database Interaction Functions */
function generateKey()
{
    $length = 50;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $key = '';
    for ($i = 0; $i < $length; $i++) {
        $key .= $characters[rand(0, $charactersLength - 1)];
    }
    return $key;
}

/* Data Conversion Functions */
function encryptData($data)
{
    return base64_encode($data);
}

function decryptData($dataKey)
{
    return base64_decode(getRecord("encrypted_contents", $dataKey));
}

/* Database Interaction Functions */
function setupDatabase()
{
    $json = json_decode(file_get_contents("./Modules/InstallationStatus.json", true), true);
    if ($json["INSTALLED"] == "false") {
        $json = json_decode(file_get_contents("./Modules/Database.env", true), true);
        $mysqli = new mysqli($json["HOSTNAME"], $json["USERNAME"], $json["PASSWORD"], $json["DATABASE"]);
        if ($mysqli->connect_errno) {
            return $mysqli->connect_errno;
        }
        $tableCreateSQL = "CREATE TABLE IF NOT EXISTS `quickblaze_records` (`record_id` int(11) NOT NULL,`encrypted_contents` longtext NOT NULL,`encryption_token` varchar(128) NOT NULL,`source_ip` varchar(100) NOT NULL, `record_date` timestamp(5) NOT NULL DEFAULT current_timestamp(5)) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $addPrimaryKeySQL = "ALTER TABLE `quickblaze_records` ADD PRIMARY KEY (`record_id`);";
        $autoIncrementSQL = "ALTER TABLE `quickblaze_records` MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT;";
        if ($mysqli->query($tableCreateSQL) === TRUE) {
            if ($mysqli->query($addPrimaryKeySQL) === TRUE) {
                if ($mysqli->query($autoIncrementSQL) === TRUE) {
                    file_put_contents("./Modules/InstallationStatus.json", json_encode(array("INSTALLED" => "true")));
                    return true;
                } else {
                    die($mysqli->error);
                }
            } else {
                die($mysqli->error);
            }
        } else {
            die($mysqli->error);
        }

        $mysqli->close();
    }
}

function insertRecord($encrypted_contents, $encryption_token)
{
    $json = json_decode(file_get_contents("./Modules/Database.env", true), true);
    $mysqli = new mysqli($json["HOSTNAME"], $json["USERNAME"], $json["PASSWORD"], $json["DATABASE"]);
    if ($mysqli->connect_errno) {
        return $mysqli->connect_errno;
    }
    $source_ip = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'];
    $record_date = date("Y-m-d H:i:s");
    $insertRecordSQL = "INSERT INTO `quickblaze_records` (`encrypted_contents`, `encryption_token`, `source_ip`, `record_date`) VALUES ('$encrypted_contents', '$encryption_token', '$source_ip', '$record_date');";
    if ($mysqli->query($insertRecordSQL) === TRUE) {
        return true;
    } else {
        die($mysqli->error);
    }
    $mysqli->close();
}

function destroyRecord($token)
{
    $json = json_decode(file_get_contents("./Modules/Database.env", true), true);
    $mysqli = new mysqli($json["HOSTNAME"], $json["USERNAME"], $json["PASSWORD"], $json["DATABASE"]);
    if ($mysqli->connect_errno) {
        return $mysqli->connect_errno;
    }
    $deleteRecordSQL = "DELETE FROM `quickblaze_records` WHERE `encryption_token` = '$token';";
    if ($mysqli->query($deleteRecordSQL) === TRUE) {
        return true;
    } else {
        die($mysqli->error);
    }
    $mysqli->close();
}

function getRecord($dataToFetch, $encryption_token)
{
    $json = json_decode(file_get_contents("./Modules/Database.env", true), true);
    $mysqli = new mysqli($json["HOSTNAME"], $json["USERNAME"], $json["PASSWORD"], $json["DATABASE"]);
    if ($mysqli->connect_errno) {
        return $mysqli->connect_errno;
    }
    $getRecordSQL = "SELECT `$dataToFetch` FROM `quickblaze_records` WHERE `encryption_token` = '$encryption_token'";
    $result = $mysqli->query($getRecordSQL);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return $row[$dataToFetch];
        }
    } else {
        return false;
    }
    $mysqli->close();
}
