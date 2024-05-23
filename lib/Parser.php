<?php

class Parser
{
    function ParseVariables($variables, $data)
    {
        foreach ($variables as $variable) {
            $data = str_replace($variable, $data[$variable], $data);
            return $data;
        }
    }
}