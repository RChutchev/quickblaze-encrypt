<?php
/**
 *      __              _                    
 *   /\ \ \_____  _____| |__   __ _ _ __ ___ 
 *  /  \/ / _ \ \/ / __| '_ \ / _` | '__/ _ \
 * / /\  /  __/>  <\__ \ | | | (_| | | |  __/
 * \_\ \/ \___/_/\_\___/_| |_|\__,_|_|  \___|
 *                                                                                 
 *
 * @version 1.0.0
 * @license MIT
 * @author axtonprice
 * @link https://github.com/axtonprice/quickblaze-encrypt
 */

// Disable error messages
// error_reporting(0);

// Import library classes
include './library/Configuration.php';
include './library/Integrity.php';

// Import utility classes
include './library/Logging.php';
include './library/ErrorManager.php';

// Configuration checking
$configuration = new Configuration;
$configuration->Check();

// File & storage integrity checking
$integrity = new Integrity;
$integrity->SystemCheck();
// $integrity->StorageCheck();

// Variable parser

// File render
// if error status is enabled, render error page
require ("./public/index.php");