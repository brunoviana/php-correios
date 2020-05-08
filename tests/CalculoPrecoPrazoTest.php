<?php

namespace BrunoViana\Correios;

use BrunoViana\Correios\Tests\TestCase;

use BrunoViana\Correios\CalculoPrecoPrazo;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;
use BrunoViana\Correios\CalculoPrecoPrazo\Services\CalculadorService;

class CalculoPrecoPrazoTest extends TestCase
{
    public function test_Deve_Retornar_Calculador_Corretamente()
    {
        $this->assertInstanceOf(CalculadorService::class, CalculoPrecoPrazo::calculador());
    }

    public function test_Constantes_Devem_Estar_Corretas()
    {
        $this->assertEquals(CalculoPrecoPrazo::CAIXA, Encomenda::CAIXA);
        $this->assertEquals(CalculoPrecoPrazo::ROLO, Encomenda::ROLO);
        $this->assertEquals(CalculoPrecoPrazo::ENVELOPE, Encomenda::ENVELOPE);
    }
}