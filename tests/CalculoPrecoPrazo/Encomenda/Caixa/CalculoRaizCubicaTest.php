<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;

use BrunoViana\Correios\Tests\TestCase;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Caixa\CalculoRaizCubica;

class CalculoRaizCubicaTest extends TestCase
{
    private $caixa;

    public function setUp(): void
    {
        $this->caixa = new CalculoRaizCubica();
    }

    /**
     * @dataProvider itensProvider
     */
    public function test_Deve_Adicionar_Item_Com_Sucesso($arrayComItens)
    {
        foreach ($arrayComItens as $arrayComItem) {
            list(
                $qtd,
                $peso,
                $comprimento,
                $altura,
                $largura,
                $diametro
            ) = $arrayComItem;

            $this->caixa->item(
                $qtd,
                $peso,
                $comprimento,
                $altura,
                $largura,
                $diametro
            );
        }

        $itens = $this->caixa->itens();

        $this->assertIsArray($itens);
        $this->assertCount(count($arrayComItens), $itens);
    }

    /**
     * @dataProvider itensProvider
     */
    public function test_Caixa_Deve_Retornar_Peso_Corretamente($arrayComItens)
    {
        $pesoTotal = 0;
        foreach ($arrayComItens as $arrayComItem) {
            list(
                $qtd,
                $peso,
                $comprimento,
                $altura,
                $largura,
                $diametro
            ) = $arrayComItem;

            $this->caixa->item(
                $qtd,
                $peso,
                $comprimento,
                $altura,
                $largura,
                $diametro
            );

            $pesoTotal += $peso*$qtd;
        }

        $this->assertEquals($pesoTotal, $this->caixa->peso());
    }

    public function test_Caixa_Deve_Retornar_Peso_Minimo_Corretamente()
    {
        $this->caixa->item(1, 0.1, 1, 1, 1, 0);

        $this->assertEquals(CalculoRaizCubica::PESO_MINIMO, $this->caixa->peso());
    }

    /**
     * @dataProvider itensProvider
     */
    public function test_Caixa_Deve_Retornar_Dimensoes_Cubicas_Corretamente($arrayComItens)
    {
        $somaRaizCubica = 0;
        foreach ($arrayComItens as $arrayComItem) {
            list(
                $qtd,
                $peso,
                $comprimento,
                $altura,
                $largura,
                $diametro
            ) = $arrayComItem;

            $this->caixa->item(
                $qtd,
                $peso,
                $comprimento,
                $altura,
                $largura,
                $diametro
            );

            $centimentroCubico = ($altura * $largura * $comprimento);
            $somaRaizCubica += round(pow($centimentroCubico, 1 / 3), 2) * $qtd;
        }

        $this->assertEquals($somaRaizCubica, $this->caixa->altura());
        $this->assertEquals($somaRaizCubica, $this->caixa->largura());
        $this->assertEquals($somaRaizCubica, $this->caixa->comprimento());
    }

    public function test_Caixa_Deve_Retornar_Comprimento_Minimo_Corretamente()
    {
        $this->caixa->item(1, 0.500, 1, 1, 1, 0);

        $this->assertEquals(CalculoRaizCubica::COMPRIMENTO_MINIMO, $this->caixa->comprimento());
    }

    public function test_Caixa_Deve_Retornar_Altura_Minima_Corretamente()
    {
        $this->caixa->item(1, 0.500, 1, 1, 1, 0);

        $this->assertEquals(CalculoRaizCubica::ALTURA_MINIMA, $this->caixa->altura());
    }

    public function test_Caixa_Deve_Retornar_Largura_Minima_Corretamente()
    {
        $this->caixa->item(1, 0.500, 1, 1, 1, 0);

        $this->assertEquals(CalculoRaizCubica::LARGURA_MINIMA, $this->caixa->largura());
    }

    /**
     * @dataProvider itensProvider
     */
    public function test_Caixa_Deve_Retornar_Diametro_Sempre_Zero($arrayComItens)
    {
        foreach ($arrayComItens as $arrayComItem) {
            list(
                $qtd,
                $peso,
                $comprimento,
                $altura,
                $largura,
                $diametro
            ) = $arrayComItem;

            $this->caixa->item(
                $qtd,
                $peso,
                $comprimento,
                $altura,
                $largura,
                $diametro
            );
        }

        $this->assertEquals(0, $this->caixa->diametro());
    }

    public function itensProvider()
    {
        return [
            [
                [
                    [1, 0.500, 16, 32, 16, 0]
                ]
            ],
            [
                [
                    [1, 0.500, 16, 32, 16, 0],
                    [1, 0.500, 16, 32, 16, 0]
                ]
            ],
            [
                [
                    [2, 0.500, 16, 32, 16, 0]
                ]
            ]
        ];
    }
}
