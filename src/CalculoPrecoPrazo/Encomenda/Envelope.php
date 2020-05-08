<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;

use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;

class Envelope extends Encomenda
{
    const COMPRIMENTO_MINIMO = 16;

    const LARGURA_MINIMA = 11;

    public function comprimento()
    {
        $comprimento = max(
            array_map(
                function ($item) {
                    return $item->comprimento();
                },
                $this->itens
            )
        );

        return $comprimento > self::COMPRIMENTO_MINIMO ? $comprimento : self::COMPRIMENTO_MINIMO;
    }

    // Cálculo de envelope não usa altura
    public function altura()
    {
        return 0;
    }

    public function largura()
    {
        $largura = max(
            array_map(
                function ($item) {
                    return $item->largura();
                },
                $this->itens
            )
        );

        return $largura > self::LARGURA_MINIMA ? $largura : self::LARGURA_MINIMA;
    }

    // Cálculo de envelope não usa diâmetro
    public function diametro()
    {
        return 0;
    }
}
