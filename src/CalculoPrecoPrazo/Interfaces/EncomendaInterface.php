<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Interfaces;

use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Item;

interface EncomendaInterface
{
    public function item(
        int $quantidade,
        float $peso,
        float $comprimento,
        float $altura,
        float $largura,
        float $diametro = 0
    ) : Item;

    public function itens() : array;

    public function peso();

    public function altura();

    public function largura();

    public function comprimento();

    public function diametro();
}
