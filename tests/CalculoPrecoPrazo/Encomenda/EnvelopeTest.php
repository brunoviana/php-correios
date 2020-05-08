<?php

namespace BrunoViana\Correios\Tests\CalculoPrecoPrazo\Encomenda;

use BrunoViana\Correios\Tests\TestCase;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Item;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Envelope;

class EnvelopeTest extends TestCase
{
    public function test_Envelope_Deve_Retornar_Peso_Corretamente()
    {
        $envelope = new Envelope();
        $envelope->item(1, 0.500, 17, 0, 0, 6);

        $this->assertEquals(0.500, $envelope->peso());

        $envelope2 = new Envelope();
        $envelope2->item(1, 0.500, 17, 0, 0, 6);
        $envelope2->item(1, 0.500, 17, 0, 0, 6);

        $this->assertEquals(1, $envelope2->peso());

        $envelope3 = new Envelope();
        $envelope3->item(2, 0.500, 17, 0, 0, 6);

        $this->assertEquals(1, $envelope3->peso());
    }

    public function test_Envelope_Deve_Retornar_Peso_Minimo_Corretamente()
    {
        $envelope = new Envelope();
        $envelope->item(1, 0.1, 1, 1, 1, 0);

        $this->assertEquals(0.3, $envelope->peso());
    }

    public function test_Envelope_Deve_Retornar_Comprimento_Somado_Corretamente()
    {
        $envelope = new Envelope();
        $envelope->item(1, 0.500, 25, 0, 20, 0);

        $this->assertEquals(25, $envelope->comprimento());

        $envelope2 = new Envelope();
        $envelope2->item(1, 0.500, 25, 0, 20, 0);
        $envelope2->item(1, 0.500, 30, 0, 20, 0);

        $this->assertEquals(30, $envelope2->comprimento());

        $envelope3 = new Envelope();
        $envelope3->item(2, 0.500, 25, 0, 20, 0);

        $this->assertEquals(25, $envelope3->comprimento());
    }

    public function test_Envelope_Deve_Retornar_Comprimento_Minimo_Corretamente()
    {
        $envelope = new Envelope();
        $envelope->item(1, 0.500, 1, 1, 1, 0);

        $this->assertEquals(16, $envelope->comprimento());
    }

    public function test_Envelope_Deve_Retornar_Altura_Sempre_Zero()
    {
        $envelope = new Envelope();
        $envelope->item(1, 0.500, 25, 20, 20, 20);

        $this->assertEquals(0, $envelope->altura());
    }

    public function test_Envelope_Deve_Retornar_Largura_Somado_Corretamente()
    {
        $envelope = new Envelope();
        $envelope->item(1, 0.500, 25, 0, 20, 0);

        $this->assertEquals(20, $envelope->largura());

        $envelope2 = new Envelope();
        $envelope2->item(1, 0.500, 25, 0, 20, 0);
        $envelope2->item(1, 0.500, 25, 0, 25, 0);

        $this->assertEquals(25, $envelope2->largura());

        $envelope3 = new Envelope();
        $envelope3->item(2, 0.500, 25, 0, 20, 0);

        $this->assertEquals(20, $envelope3->largura());
    }

    public function test_Envelope_Deve_Retornar_Diametro_Minimo_Corretamente()
    {
        $envelope = new Envelope();
        $envelope->item(1, 0.500, 1, 1, 1, 0);

        $this->assertEquals(11, $envelope->largura());
    }

    public function test_Envelope_Deve_Retornar_Diametro_Sempre_Zero()
    {
        $envelope = new Envelope();
        $envelope->item(1, 0.500, 25, 20, 20, 20);

        $this->assertEquals(0, $envelope->diametro());
    }
}
