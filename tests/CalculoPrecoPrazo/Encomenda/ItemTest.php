<?php

namespace BrunoViana\Correios\Tests\CalculoPrecoPrazo\Encomenda;

use BrunoViana\Correios\Tests\TestCase;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Item;

class ItemTest extends TestCase
{
    private $valoresItem = [1, 0.500, 17, 15, 12, 4];

    public function test_Item_Deve_Retornar_Quantidade_Com_Sucesso()
    {
        $this->assertEquals(1, $this->item()->quantidade());
    }

    public function test_Item_Deve_Retornar_Peso_Com_Sucesso()
    {
        $this->assertEquals(0.500, $this->item()->peso());
    }

    public function test_Item_Deve_Retornar_Comprimento_Com_Sucesso()
    {
        $this->assertEquals(17, $this->item()->comprimento());
    }

    public function test_Item_Deve_Retornar_Altura_Com_Sucesso()
    {
        $this->assertEquals(15, $this->item()->altura());
    }

    public function test_Item_Deve_Retornar_Largura_Com_Sucesso()
    {
        $this->assertEquals(12, $this->item()->largura());
    }

    public function test_Item_Deve_Retornar_Diametro_Com_Sucesso()
    {
        $this->assertEquals(4, $this->item()->diametro());
    }

    private function item()
    {
        list($quantidade, $peso, $comprimento, $altura, $largura, $diametro) = $this->valoresItem;

        return new Item(
            $quantidade,
            $peso,
            $comprimento,
            $altura,
            $largura,
            $diametro
        );
    }
}
