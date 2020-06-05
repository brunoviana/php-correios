<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;

class Rolo implements EncomendaInterface
{
    const COMPRIMENTO_MINIMO = 18;

    const DIAMETRO_MINIMO = 5;

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
