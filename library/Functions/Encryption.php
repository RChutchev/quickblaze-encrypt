<?php

use phpseclib3\Crypt\AES;
use phpseclib3\Crypt\Random;

/**
 * Handles encryption and decryption operations for the creation 
 * and retrieval of shared content.
 */
class Encryption
{

    function Encrypt($string)
    {
        // Encrypt a string
        $cipher = new AES('ctr');
        $cipher->setIV(Random::string(16));
        $cipher->setKey(Random::string(16));

        $ciphertext = $cipher->encrypt($string);

        return base64_encode($ciphertext);
    }

    function Decrypt($ciphertext)
    {
        $cipher = new AES('ctr');
        $cipher->setIV(Random::string(16));
        $cipher->setKey(Random::string(16));

        return base64_decode($cipher->decrypt($ciphertext));

        // Must destroy once decrypted
        // $this->Destroy();
    }

    function Destroy()
    {
        // Delete a share
    }

    function Validate()
    {
        // Check if a share exists
    }
}
