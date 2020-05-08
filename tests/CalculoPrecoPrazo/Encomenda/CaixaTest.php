<?php

namespace BrunoViana\Correios\Tests\CalculoPrecoPrazo\Encomenda;

use BrunoViana\Correios\Tests\TestCase;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Caixa;

class CaixaTest extends TestCase
{
    public function test_Caixa_Deve_Retornar_Peso_Corretamente()
    {
        $caixa = new Caixa();
        $caixa->item(1, 0.500, 17, 15, 12, 0);

        $this->assertEquals(0.500, $caixa->peso());

        $caixa2 = new Caixa();
        $caixa2->item(1, 0.500, 17, 15, 12, 0);
        $caixa2->item(1, 0.500, 17, 15, 12, 0);

        $this->assertEquals(1, $caixa2->peso());

        $caixa3 = new Caixa();
        $caixa3->item(2, 0.500, 17, 15, 12, 0);

        $this->assertEquals(1, $caixa3->peso());
    }

    public function test_Caixa_Deve_Retornar_Peso_Minimo_Corretamente()
    {
        $caixa = new Caixa();
        $caixa->item(1, 0.1, 1, 1, 1, 0);

        $this->assertEquals(0.3, $caixa->peso());
    }

    public function test_Caixa_Deve_Retornar_Comprimento_Cubico_Corretamente()
    {
        $caixa = new Caixa();
        $caixa->item(1, 0.500, 16, 32, 16, 0);

        $this->assertEquals(20.16, $caixa->comprimento());

        $caixa2 = new Caixa();
        $caixa2->item(1, 0.500, 16, 32, 16, 0);
        $caixa2->item(1, 0.500, 16, 32, 16, 0);

        $this->assertEquals(40.32, $caixa2->comprimento());

        $caixa3 = new Caixa();
        $caixa3->item(2, 0.500, 16, 32, 16, 0);

        $this->assertEquals(25.4, $caixa3->comprimento());
    }

    public function test_Caixa_Deve_Retornar_Comprimento_Somado_Corretamente()
    {
        $caixa = new Caixa(false);
        $caixa->item(1, 0.500, 16, 32, 16, 0);

        $this->assertEquals(16, $caixa->comprimento());

        $caixa2 = new Caixa(false);
        $caixa2->item(1, 0.500, 23, 32, 16, 0);
        $caixa2->item(1, 0.500, 20, 32, 16, 0);

        $this->assertEquals(23, $caixa2->comprimento());

        $caixa3 = new Caixa(false);
        $caixa3->item(2, 0.500, 16, 32, 16, 0);

        $this->assertEquals(16, $caixa3->comprimento());
    }

    public function test_Caixa_Deve_Retornar_Comprimento_Minimo_Corretamente()
    {
        $caixa = new Caixa();
        $caixa->item(1, 0.500, 1, 1, 1, 0);

        $this->assertEquals(16, $caixa->comprimento());
    }

    public function test_Caixa_Deve_Retornar_Altura_Cubica_Corretamente()
    {
        $caixa = new Caixa();
        $caixa->item(1, 0.500, 16, 32, 16, 0);

        $this->assertEquals(20.16, $caixa->altura());

        $caixa2 = new Caixa();
        $caixa2->item(1, 0.500, 16, 32, 16, 0);
        $caixa2->item(1, 0.500, 16, 32, 16, 0);

        $this->assertEquals(40.32, $caixa2->altura());

        $caixa3 = new Caixa();
        $caixa3->item(2, 0.500, 16, 32, 16, 0);

        $this->assertEquals(25.4, $caixa3->altura());
    }

    public function test_Caixa_Deve_Retornar_Altura_Somada_Corretamente()
    {
        $caixa = new Caixa(false);
        $caixa->item(1, 0.500, 16, 32, 16, 0);

        $this->assertEquals(32, $caixa->altura());

        $caixa2 = new Caixa(false);
        $caixa2->item(1, 0.500, 16, 32, 16, 0);
        $caixa2->item(1, 0.500, 16, 32, 16, 0);

        $this->assertEquals(64, $caixa2->altura());

        $caixa3 = new Caixa(false);
        $caixa3->item(2, 0.500, 16, 32, 16, 0);

        $this->assertEquals(64, $caixa3->altura());
    }

    public function test_Caixa_Deve_Retornar_Altura_Minima_Corretamente()
    {
        $caixa = new Caixa();
        $caixa->item(1, 0.500, 1, 1, 1, 0);

        $this->assertEquals(2, $caixa->altura());
    }

    public function test_Caixa_Deve_Retornar_Largura_Cubica_Corretamente()
    {
        $caixa = new Caixa();
        $caixa->item(1, 0.500, 16, 32, 16, 0);

        $this->assertEquals(20.16, $caixa->largura());

        $caixa2 = new Caixa();
        $caixa2->item(1, 0.500, 16, 32, 16, 0);
        $caixa2->item(1, 0.500, 16, 32, 16, 0);

        $this->assertEquals(40.32, $caixa2->largura());

        $caixa3 = new Caixa();
        $caixa3->item(2, 0.500, 16, 32, 16, 0);

        $this->assertEquals(25.4, $caixa3->largura());
    }

    public function test_Caixa_Deve_Retornar_Largura_Somada_Corretamente()
    {
        $caixa = new Caixa(false);
        $caixa->item(1, 0.500, 16, 32, 16, 0);

        $this->assertEquals(16, $caixa->largura());

        $caixa2 = new Caixa(false);
        $caixa2->item(1, 0.500, 16, 32, 16, 0);
        $caixa2->item(1, 0.500, 16, 32, 32, 0);

        $this->assertEquals(32, $caixa2->largura());

        $caixa3 = new Caixa(false);
        $caixa3->item(2, 0.500, 16, 32, 16, 0);

        $this->assertEquals(16, $caixa3->largura());
    }

    public function test_Caixa_Deve_Retornar_Largura_Minima_Corretamente()
    {
        $caixa = new Caixa();
        $caixa->item(1, 0.500, 1, 1, 1, 0);

        $this->assertEquals(11, $caixa->largura());
    }

    public function test_Caixa_Deve_Retornar_Diametro_Sempre_Zero()
    {
        $caixa = new Caixa();
        $caixa->item(1, 0.500, 1, 1, 1, 4);

        $this->assertEquals(0, $caixa->diametro());
    }
}
