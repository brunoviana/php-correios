<?php

namespace BrunoViana\Correios;

use BrunoViana\Correios\Tests\TestCase;

use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;
use BrunoViana\Correios\CalculoPrecoPrazo\Services\CalculadorTudoJunto;
use BrunoViana\Correios\CalculoPrecoPrazo\Services\CalculadorTudoSeparado;
use BrunoViana\Correios\CalculoPrecoPrazo\Services\CalculadorDimensaoLimiteSeparado;

class CalculoPrecoPrazoTest extends TestCase
{
    public function test_Deve_Retornar_Calculador_Padrao_Corretamente()
    {
        $precoPrazo = new CalculoPrecoPrazo();
        $calculador = $precoPrazo->calculador();

        $this->assertInstanceOf(CalculadorDimensaoLimiteSeparado::class, $calculador);
    }

    public function test_Deve_Retornar_Calculador_Dimensao_Limite_Separado_Corretamente()
    {
        $precoPrazo = new CalculoPrecoPrazo();
        $calculador = $precoPrazo->calculador(
            [],
            CalculoPrecoPrazo::CALCULADOR_DIMENSAO_LIMITE_SEPARADO
        );

        $this->assertInstanceOf(CalculadorDimensaoLimiteSeparado::class, $calculador);
    }

    public function test_Deve_Retornar_Calculador_Tudo_Junto_Corretamente()
    {
        $precoPrazo = new CalculoPrecoPrazo();
        $calculador = $precoPrazo->calculador(
            [],
            CalculoPrecoPrazo::CALCULADOR_TUDO_JUNTO
        );

        $this->assertInstanceOf(CalculadorTudoJunto::class, $calculador);
    }

    public function test_Deve_Retornar_Calculador_Tudo_Separado_Corretamente()
    {
        $precoPrazo = new CalculoPrecoPrazo();
        $calculador = $precoPrazo->calculador(
            [],
            CalculoPrecoPrazo::CALCULADOR_TUDO_SEPARADO
        );

        $this->assertInstanceOf(CalculadorTudoSeparado::class, $calculador);
    }

    public function test_Deve_Falhar_Se_Calculador_Nao_Existir()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Calculador inválido');

        $precoPrazo = new CalculoPrecoPrazo();
        $calculador = $precoPrazo->calculador(
            [],
            -1
        );
    }

    // public function test_Deve_Retornar_Calculador_Corretamente()
    // {
    //     $precoPrazo = new CalculoPrecoPrazo();

    //     $this->assertInstanceOf(CalculadorService::class, $precoPrazo->calculador());
    // }

    // public function test_Constantes_Devem_Estar_Corretas()
    // {
    //     $this->assertEquals(CalculoPrecoPrazo::CAIXA, Encomenda::CAIXA);
    //     $this->assertEquals(CalculoPrecoPrazo::ROLO, Encomenda::ROLO);
    //     $this->assertEquals(CalculoPrecoPrazo::ENVELOPE, Encomenda::ENVELOPE);
    // }
}
