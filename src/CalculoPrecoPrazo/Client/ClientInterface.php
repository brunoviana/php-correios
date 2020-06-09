<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Client;

interface ClientInterface
{
    public function consultar(Request $request) : ?array;
}
