<?php

/**
 *      __              _                    
 *   /\ \ \_____  _____| |__   __ _ _ __ ___ 
 *  /  \/ / _ \ \/ / __| '_ \ / _` | '__/ _ \
 * / /\  /  __/>  <\__ \ | | | (_| | | |  __/
 * \_\ \/ \___/_/\_\___/_| |_|\__,_|_|  \___|
                                                                     
 *
 * @version 1.0.0-alpha
 * @license MIT
 * @author axtonprice
 * @link https://github.com/axtonprice/nexshare
 */

/**
 * Includes the autoloader file from the "vendor" directory, automatically loading the 
 * required classes and files in the project.
 */
require './vendor/autoload.php';

/**
 * Includes all system classes from the "library" directory, automatically loading the 
 * required functions and files in the project.
 */
foreach (glob("./library/*/*.php") as $filename) require_once $filename;

/**
 * Creates a new instance of the System class, verifying the system integrity, 
 * initialising the storage method, then rendering the webpage.
 */
new System();

?>