<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Caixa;

use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Item;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\EncomendaInterface;

class CalculoRaizCubica implements EncomendaInterface
{
    const COMPRIMENTO_MINIMO = CalculoUnicoItem::COMPRIMENTO_MINIMO;

    const ALTURA_MINIMA = CalculoUnicoItem::ALTURA_MINIMA;

    const LARGURA_MINIMA = CalculoUnicoItem::LARGURA_MINIMA;

    const PESO_MINIMO = CalculoUnicoItem::PESO_MINIMO;

    private $raizCubicaTotal = 0;

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
        $this->pesoTotal += $this->calculaPeso($item);
        $this->raizCubicaTotal += $this->calculaRaizCubica($item);

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
        return $this->raizCubicaTotal > self::COMPRIMENTO_MINIMO ? $this->raizCubicaTotal : self::COMPRIMENTO_MINIMO;
    }

    public function altura()
    {
        return $this->raizCubicaTotal > self::ALTURA_MINIMA ? $this->raizCubicaTotal : self::ALTURA_MINIMA;
    }

    public function largura()
    {
        return $this->raizCubicaTotal > self::LARGURA_MINIMA ? $this->raizCubicaTotal : self::LARGURA_MINIMA;
    }

    public function diametro()
    {
        return 0;
    }

    protected function calculaPeso(Item $item)
    {
        return $item->peso() * $item->quantidade();
    }

    protected function calculaRaizCubica(Item $item)
    {
        $centimentroCubico = ($item->altura() * $item->largura() * $item->comprimento());

        return round(pow($centimentroCubico, 1 / 3), 2) * $item->quantidade();
    }
}
