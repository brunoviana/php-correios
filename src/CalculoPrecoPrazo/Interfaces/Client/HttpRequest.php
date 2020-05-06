<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Interfaces\Client;

interface HttpRequest
{
    public function setOption($name, $value);
    public function execute();
    public function getInfo($name);
    public function close();
    public function reset();
}
