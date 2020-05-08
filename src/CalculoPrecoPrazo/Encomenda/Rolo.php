<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;

use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;

class Rolo extends Encomenda
{
    const PESO_MINIMO = 0.3;

    const COMPRIMENTO_MINIMO = 18;

    const DIAMETRO_MINIMO = 5;

    public function comprimento()
    {
        $comprimento = array_sum(
            array_map(
                function ($item) {
                    return $item->comprimento() * $item->quantidade();
                },
                $this->itens
            )
        );

        return $comprimento > self::COMPRIMENTO_MINIMO ? $comprimento : self::COMPRIMENTO_MINIMO;
    }

    // Cálculo de rolo/cilindro não usa largura
    public function altura()
    {
        return 0;
    }

    // Cálculo de rolo/cilindro não usa largura
    public function largura()
    {
        return 0;
    }

    public function diametro()
    {
        $diametro = max(
            array_map(
                function ($item) {
                    return $item->diametro();
                },
                $this->itens
            )
        );

        return $diametro > self::DIAMETRO_MINIMO ? $diametro : self::DIAMETRO_MINIMO;
    }
}
