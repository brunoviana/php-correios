<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;

use BrunoViana\Correios\Tests\TestCase;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Caixa\CalculoUnicoItem;

class CalculoUnicoItemTest extends TestCase
{
    private $caixa;

    public function setUp(): void
    {
        $this->caixa = new CalculoUnicoItem();
    }

    /**
     * @dataProvider itensProvider
     */
    public function test_Deve_Adicionar_Item_Com_Sucesso(
        $qtd,
        $peso,
        $comprimento,
        $altura,
        $largura,
        $diametro
    ) {
        $this->caixa->item(
            $qtd,
            $peso,
            $comprimento,
            $altura,
            $largura,
            $diametro
        );

        $itens = $this->caixa->itens();

        $this->assertIsArray($itens);
        $this->assertCount(1, $itens);
    }

    /**
     * @dataProvider itensProvider
     */
    public function test_Deve_Falha_Se_Adicionar_Mais_De_Um_Item(
        $qtd,
        $peso,
        $comprimento,
        $altura,
        $largura,
        $diametro
    ) {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Neste tipo de cálculo você só pode ter um item');

        $this->caixa->item(
            $qtd,
            $peso,
            $comprimento,
            $altura,
            $largura,
            $diametro
        );

        $this->caixa->item(
            $qtd,
            $peso,
            $comprimento,
            $altura,
            $largura,
            $diametro
        );
    }
    /**
     * @dataProvider itensProvider
     */
    public function test_Deve_Falha_Se_Adicionar_Um_Item_Com_Mais_De_Uma_Qtd(
        $qtd,
        $peso,
        $comprimento,
        $altura,
        $largura,
        $diametro
    ) {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Neste tipo de cálculo você só pode ter um item');

        $this->caixa->item(
            2,
            $peso,
            $comprimento,
            $altura,
            $largura,
            $diametro
        );
    }

    /**
     * @dataProvider itensProvider
     */
    public function test_Caixa_Deve_Retornar_Peso_Corretamente(
        $qtd,
        $peso,
        $comprimento,
        $altura,
        $largura,
        $diametro
    ) {
        $this->caixa->item(
            $qtd,
            $peso,
            $comprimento,
            $altura,
            $largura,
            $diametro
        );

        $this->assertEquals($peso, $this->caixa->peso());
    }

    public function test_Caixa_Deve_Retornar_Peso_Minimo_Corretamente()
    {
        $this->caixa->item(1, 0.1, 1, 1, 1, 0);

        $this->assertEquals(CalculoUnicoItem::PESO_MINIMO, $this->caixa->peso());
    }

    /**
     * @dataProvider itensProvider
     */
    public function test_Caixa_Deve_Retornar_Dimensoes_Cubicas_Corretamente(
        $qtd,
        $peso,
        $comprimento,
        $altura,
        $largura,
        $diametro
    ) {
        $this->caixa->item(
            $qtd,
            $peso,
            $comprimento,
            $altura,
            $largura,
            $diametro
        );

        $this->assertEquals($altura, $this->caixa->altura());
        $this->assertEquals($largura, $this->caixa->largura());
        $this->assertEquals($comprimento, $this->caixa->comprimento());
    }

    public function test_Caixa_Deve_Retornar_Comprimento_Minimo_Corretamente()
    {
        $this->caixa->item(1, 0.500, 1, 1, 1, 0);

        $this->assertEquals(CalculoUnicoItem::COMPRIMENTO_MINIMO, $this->caixa->comprimento());
    }

    public function test_Caixa_Deve_Retornar_Altura_Minima_Corretamente()
    {
        $this->caixa->item(1, 0.500, 1, 1, 1, 0);

        $this->assertEquals(CalculoUnicoItem::ALTURA_MINIMA, $this->caixa->altura());
    }

    public function test_Caixa_Deve_Retornar_Largura_Minima_Corretamente()
    {
        $this->caixa->item(1, 0.500, 1, 1, 1, 0);

        $this->assertEquals(CalculoUnicoItem::LARGURA_MINIMA, $this->caixa->largura());
    }

    /**
     * @dataProvider itensProvider
     */
    public function test_Caixa_Deve_Retornar_Diametro_Sempre_Zero(
        $qtd,
        $peso,
        $comprimento,
        $altura,
        $largura,
        $diametro
    ) {
        $this->caixa->item(
            $qtd,
            $peso,
            $comprimento,
            $altura,
            $largura,
            $diametro
        );

        $this->assertEquals(0, $this->caixa->diametro());
    }

    public function itensProvider()
    {
        return [
            [1, 0.500, 16, 32, 16, 0],
        ];
    }
}
