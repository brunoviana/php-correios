<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;

class Item
{
    private $quantidade;

    private $peso;

    private $comprimento;

    private $altura;

    private $largura;

    private $diametro;

    public function __construct(
        int $quantidade,
        float $peso,
        float $comprimento,
        float $altura,
        float $largura,
        float $diametro = 0
    ) {
        $this->quantidade = $quantidade;
        $this->peso = $peso;
        $this->comprimento = $comprimento;
        $this->altura = $altura;
        $this->largura = $largura;
        $this->diametro = $diametro;
    }

    public function quantidade()
    {
        return $this->quantidade;
    }

    public function peso()
    {
        return $this->peso;
    }

    public function comprimento()
    {
        return $this->comprimento;
    }

    public function altura()
    {
        return $this->altura;
    }

    public function largura()
    {
        return $this->largura;
    }

    public function diametro()
    {
        return $this->diametro;
    }
}
