<?php

namespace BrunoViana\Correios;

use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;
use BrunoViana\Correios\CalculoPrecoPrazo\Services\CalculadorService;

class CalculoPrecoPrazo
{
    const CAIXA = Encomenda::CAIXA;

    const ROLO = Encomenda::ROLO;

    const ENVELOPE = Encomenda::ENVELOPE;

    public function calculador($dados = [])
    {
        return CalculadorService::novo($dados);
    }
}
