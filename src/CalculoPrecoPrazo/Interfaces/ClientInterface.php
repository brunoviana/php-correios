<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Interfaces;

use BrunoViana\Correios\CalculoPrecoPrazo\Client\Request;

interface ClientInterface
{
    public function consultar(Request $request) : ?array;
}
