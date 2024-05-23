<?php

class Integrity
{
    /**
     * @
     */
    function Check()
    {
        /**
         * TODO:
         * check assets
         * check libs
         * check publics
         * check .htaccess
         */

        // Debug log class to log changes made  
        $debug = new DebugLogging;

        // Check if assets directory exists
        if (!file_exists("./assets")) {
            $debug->Log($_SERVER["PHP_SELF"], "missingAssetsDirectory");
        }
    }
}