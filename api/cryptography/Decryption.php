<?php

class Decryption extends Validation
{

    function Decrypt()
    {

        // Must destroy once decrypted
        $this->Destroy();
    }

    function Destroy()
    {
        // Delete shared object
    }

}