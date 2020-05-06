<?php

namespace BrunoViana\Correios\Tests\CalculoPrecoPrazo;

use BrunoViana\Correios\Tests\TestCase;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Caixa;

class EncomendaTest extends TestCase
{
    public function test_Deve_Retornar_Instancia_Caixa_Corretamente()
    {
        $encomenda = Encomenda::nova(Encomenda::CAIXA);

        $this->assertInstanceOf(Caixa::class, $encomenda);
    }

    public function test_Deve_Falhar_Com_Formato_Invalido()
    {
        $this->expectException(\RuntimeException::class);

        Encomenda::nova(0);
    }

    public function test_Deve_Inserir_Item_Com_Sucesso()
    {
        $encomenda = Encomenda::nova(Encomenda::CAIXA);

        $item = $encomenda->item(1, 0.500, 17, 15, 12, 0);

        $this->assertCount(1, $encomenda->itens());
        $this->assertEquals($item, $encomenda->itens()[0]);
    }
}