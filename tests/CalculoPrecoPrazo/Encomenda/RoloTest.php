<?php

namespace BrunoViana\Correios\Tests\CalculoPrecoPrazo\Encomenda;

use BrunoViana\Correios\Tests\TestCase;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Rolo;

class RoloTest extends TestCase
{
    public function test_Rolo_Deve_Retornar_Peso_Corretamente()
    {
        $rolo = new Rolo();
        $rolo->item(1, 0.500, 17, 0, 0, 6);

        $this->assertEquals(0.500, $rolo->peso());

        $rolo2 = new Rolo();
        $rolo2->item(1, 0.500, 17, 0, 0, 6);
        $rolo2->item(1, 0.500, 17, 0, 0, 6);

        $this->assertEquals(1, $rolo2->peso());

        $rolo3 = new Rolo();
        $rolo3->item(2, 0.500, 17, 0, 0, 6);

        $this->assertEquals(1, $rolo3->peso());
    }

    public function test_Rolo_Deve_Retornar_Peso_Minimo_Corretamente()
    {
        $rolo = new Rolo();
        $rolo->item(1, 0.1, 1, 1, 1, 0);

        $this->assertEquals(0.3, $rolo->peso());
    }

    public function test_Rolo_Deve_Retornar_Comprimento_Somado_Corretamente()
    {
        $rolo = new Rolo();
        $rolo->item(1, 0.500, 25, 0, 0, 10);

        $this->assertEquals(25, $rolo->comprimento());

        $rolo2 = new Rolo();
        $rolo2->item(1, 0.500, 25, 0, 0, 10);
        $rolo2->item(1, 0.500, 25, 0, 0, 10);

        $this->assertEquals(50, $rolo2->comprimento());

        $rolo3 = new Rolo();
        $rolo3->item(2, 0.500, 25, 0, 0, 10);

        $this->assertEquals(50, $rolo3->comprimento());
    }

    public function test_Rolo_Deve_Retornar_Comprimento_Minimo_Corretamente()
    {
        $rolo = new Rolo();
        $rolo->item(1, 0.500, 1, 1, 1, 0);

        $this->assertEquals(18, $rolo->comprimento());
    }

    public function test_Rolo_Deve_Retornar_Altura_Sempre_Zero()
    {
        $rolo = new Rolo();
        $rolo->item(1, 0.500, 16, 32, 16, 0);

        $this->assertEquals(0, $rolo->altura());
    }

    public function test_Rolo_Deve_Retornar_Largura_Sempre_Zero()
    {
        $rolo = new Rolo();
        $rolo->item(1, 0.500, 16, 32, 16, 0);

        $this->assertEquals(0, $rolo->largura());
    }

    public function test_Rolo_Deve_Retornar_Diametro_Somado_Corretamente()
    {
        $rolo = new Rolo();
        $rolo->item(1, 0.500, 25, 0, 0, 10);

        $this->assertEquals(10, $rolo->diametro());

        $rolo2 = new Rolo();
        $rolo2->item(1, 0.500, 25, 0, 0, 10);
        $rolo2->item(1, 0.500, 25, 0, 0, 15);

        $this->assertEquals(15, $rolo2->diametro());

        $rolo3 = new Rolo();
        $rolo3->item(2, 0.500, 25, 0, 0, 10);

        $this->assertEquals(10, $rolo3->diametro());
    }

    public function test_Rolo_Deve_Retornar_Diametro_Minimo_Corretamente()
    {
        $rolo = new Rolo();
        $rolo->item(1, 0.500, 1, 1, 1, 0);

        $this->assertEquals(5, $rolo->diametro());
    }
}
