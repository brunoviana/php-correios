<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Interfaces\Client;

use BrunoViana\Correios\CalculoPrecoPrazo\Client\Response;

interface AdapterInterface
{
    public function enviar(string $url, array $parametros) : Response;
}
