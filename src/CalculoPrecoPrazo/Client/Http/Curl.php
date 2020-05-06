<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Client\Http;

use BrunoViana\Correios\CalculoPrecoPrazo\Interfaces\Client\HttpRequest;

class Curl implements HttpRequest
{
    private $handle = null;

    public function __construct()
    {
        $this->handle = curl_init();
    }

    public function setOption($name, $value)
    {
        curl_setopt($this->handle, $name, $value);
    }

    public function execute()
    {
        return curl_exec($this->handle);
    }

    public function getInfo($name)
    {
        return curl_getinfo($this->handle, $name);
    }

    public function close()
    {
        curl_close($this->handle);
    }

    public function reset()
    {
        curl_reset($this->handle);
    }
}
