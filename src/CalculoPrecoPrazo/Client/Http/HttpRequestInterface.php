<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Client\Http;

interface HttpRequestInterface
{
    public function setOption($name, $value);

    public function execute();

    public function getInfo($name = null);

    public function close();

    public function reset();
}
