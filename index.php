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
error_reporting(0);

// Import library classes
include './library/Configuration.php';
include './library/Integrity.php';
include './library/Renderer.php';
include './library/Logging.php';

// Configuration checking
$configuration = new Configuration;
$configuration->Check();

// File & storage integrity checking
$integrity = new Integrity;
$integrity->SystemCheck();
// $integrity->StorageCheck();

// File render
$renderer = new Renderer;
$renderer->Render("index.php");