<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;

use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;

class Caixa extends Encomenda
{
    const COMPRIMENTO_MINIMO = 16;

    const ALTURA_MINIMA = 2;

    const LARGURA_MINIMA = 11;

    private $raizCubicaTotal = 0;

    private $usaRaizCubica;

    /**
     * A classe tem a opção de calcular as dimensões da encomenta baseado na
     * raíz cúbica de todos os itens.
     *
     * Essa solução sugiram depois de a comunidade discutir bastante como resolver
     * discrepâncias entre o cálculo online e o calculo feito no balcão no momento do despacho.
     *
     * Uma referência dessa discussão está nesse link: https://pt.stackoverflow.com/a/278246
     *
     * Se $usaRaizCubica receber `false` será retornado os valores considerando itens empilhados,
     * ou seja, será somado a altura de todos os itens e passado como largura e comprimento
     * os valores do maior item.
     *
     * @param bool $usaRaizCubica Informa se as dimensões usarão o cálculo da raíz cúbica.
     */
    public function __construct($usaRaizCubica = true)
    {
        $this->usaRaizCubica = $usaRaizCubica;
    }

    public function item(
        int $quantidade,
        float $peso,
        float $comprimento,
        float $altura,
        float $largura,
        float $diametro = 0
    ) : Item {
        $item = parent::item(
            $quantidade,
            $peso,
            $comprimento,
            $altura,
            $largura,
            $diametro
        );

        $this->raizCubicaTotal += $this->calculaRaizCubica($item);

        return $item;
    }

    protected function calculaRaizCubica(Item $item)
    {
        $centimentroCubico = ($item->altura() * $item->largura() * $item->comprimento()) * $item->quantidade();

        return round(pow($centimentroCubico, 1 / 3), 2);
    }

    public function comprimento()
    {
        if ($this->usaRaizCubica) {
            $comprimento = $this->raizCubicaTotal;
        } else {
            $comprimento = max(
                array_map(
                    function ($item) {
                        return $item->comprimento();
                    },
                    $this->itens
                )
            );
        }

        return $comprimento > self::COMPRIMENTO_MINIMO ? $comprimento : self::COMPRIMENTO_MINIMO;
    }

    public function altura()
    {
        if ($this->usaRaizCubica) {
            $altura = $this->raizCubicaTotal;
        } else {
            $altura = array_sum(
                array_map(
                    function ($item) {
                        return $item->altura() * $item->quantidade();
                    },
                    $this->itens
                )
            );
        }

        return $altura > self::ALTURA_MINIMA ? $altura : self::ALTURA_MINIMA;
    }

    public function largura()
    {
        if ($this->usaRaizCubica) {
            $largura = $this->raizCubicaTotal;
        } else {
            $largura = max(
                array_map(
                    function ($item) {
                        return $item->largura();
                    },
                    $this->itens
                )
            );
        }

        return $largura > self::LARGURA_MINIMA ? $largura : self::LARGURA_MINIMA;
    }

    /**
     * Os Correios não usa diâmetro nesse calculo, portanto deve ser sempre zero;.
     */
    public function diametro()
    {
        return 0;
    }
}
