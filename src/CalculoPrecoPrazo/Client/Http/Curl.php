<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Client\Http;

class Curl implements HttpRequestInterface
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

    public function getInfo($name = null)
    {
        if ($name) {
            return curl_getinfo($this->handle, $name);
        }

        return curl_getinfo($this->handle);
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
