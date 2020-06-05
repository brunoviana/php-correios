<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;

interface EncomendaInterface
{
    public function item(
        int $quantidade,
        float $peso,
        float $comprimento,
        float $altura,
        float $largura,
        float $diametro
    ) : Item;

    public function itens() : array;

    public function peso();

    public function altura();

    public function largura();

    public function comprimento();

    public function diametro();
}
