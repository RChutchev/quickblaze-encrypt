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
include './lib/Configuration.php';
include './lib/DebugLogging.php';
include './lib/Integrity.php';

// Config checking
$config = new Configuration;
$config = $config->CheckConfig();

// File integrity checking
$integrity = new Integrity;
$integrity = $integrity->Check();

// Storage integrity checking

// Variable parser

// File render
require ("./public/index.php");