<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Caixa;

use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Item;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\EncomendaInterface;

class CalculoUnicoItem implements EncomendaInterface
{
    const COMPRIMENTO_MINIMO = 16;

    const ALTURA_MINIMA = 2;

    const LARGURA_MINIMA = 11;

    const PESO_MINIMO = 0.3;

    private $item;

    public function item(
        int $quantidade,
        float $peso,
        float $comprimento,
        float $altura,
        float $largura,
        float $diametro = 0
    ) : Item {
        if ($this->item || $quantidade > 1) {
            throw new \RuntimeException('Neste tipo de cálculo você só pode ter um item');
        }

        $item = new Item(
            $quantidade,
            $peso,
            $comprimento,
            $altura,
            $largura,
            $diametro
        );

        $this->item = $item;

        return $item;
    }

    public function itens() : array
    {
        return [ $this->item ];
    }

    public function peso()
    {
        return $this->item->peso() > self::PESO_MINIMO ? $this->item->peso() : self::PESO_MINIMO;
    }

    public function comprimento()
    {
        return $this->item->comprimento() > self::COMPRIMENTO_MINIMO
                ? $this->item->comprimento()
                : self::COMPRIMENTO_MINIMO;
    }

    public function altura()
    {
        return $this->item->altura() > self::ALTURA_MINIMA
                ? $this->item->altura()
                : self::ALTURA_MINIMA;
    }

    public function largura()
    {
        return $this->item->largura() > self::LARGURA_MINIMA
                ? $this->item->comprimento()
                : self::LARGURA_MINIMA;
    }

    public function diametro()
    {
        return 0;
    }
}
