<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Client\Adapters;

use BrunoViana\Correios\CalculoPrecoPrazo\Client\Response;

interface AdapterInterface
{
    public function enviar(string $url, array $parametros) : Response;
}
