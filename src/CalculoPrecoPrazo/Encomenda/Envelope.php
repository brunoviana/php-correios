<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;

class Envelope implements EncomendaInterface
{
    const COMPRIMENTO_MINIMO = 16;

    const LARGURA_MINIMA = 11;

    const PESO_MINIMO = 0.3;

    private $pesoTotal = 0;

    public function item(
        int $quantidade,
        float $peso,
        float $comprimento,
        float $altura,
        float $largura,
        float $diametro = 0
    ) : Item {
        $item = new Item(
            $quantidade,
            $peso,
            $comprimento,
            $altura,
            $largura,
            $diametro
        );

        $this->itens[] = $item;
        $this->pesoTotal += $peso*$quantidade;

        return $item;
    }

    public function itens() : array
    {
        return $this->itens;
    }

    public function peso()
    {
        return $this->pesoTotal > self::PESO_MINIMO ? $this->pesoTotal : self::PESO_MINIMO;
    }

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
