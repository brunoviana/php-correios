<?php

namespace BrunoViana\Correios\Tests\CalculoPrecoPrazo;

use BrunoViana\Correios\Tests\TestCase;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Rolo;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Envelope;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Caixa\CalculoUnicoItem;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Caixa\CalculoRaizCubica;

class EncomendaTest extends TestCase
{
    public function test_Deve_Retornar_Instancia_Caixa_Corretamente()
    {
        $encomenda = Encomenda::nova(Encomenda::CAIXA);

        $this->assertInstanceOf(CalculoRaizCubica::class, $encomenda);
    }

    public function test_Deve_Retornar_Instancia_Caixa_Com_Unico_Item_Corretamente()
    {
        $encomenda = Encomenda::nova(Encomenda::CAIXA, true);

        $this->assertInstanceOf(CalculoUnicoItem::class, $encomenda);
    }

    public function test_Deve_Retornar_Instancia_Rolo_Corretamente()
    {
        $encomenda = Encomenda::nova(Encomenda::ROLO);

        $this->assertInstanceOf(Rolo::class, $encomenda);
    }

    public function test_Deve_Retornar_Instancia_Envelope_Corretamente()
    {
        $encomenda = Encomenda::nova(Encomenda::ENVELOPE);

        $this->assertInstanceOf(Envelope::class, $encomenda);
    }

    public function test_Deve_Falhar_Com_Formato_Invalido()
    {
        $this->expectException(\RuntimeException::class);

        Encomenda::nova(0);
    }
}
