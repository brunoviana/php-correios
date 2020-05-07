<?php

namespace BrunoViana\Correios\Tests\CalculoPrecoPrazo\Client;

use BrunoViana\Correios\Tests\TestCase;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Request;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\ValidaRequest;
use BrunoViana\Correios\CalculoPrecoPrazo\Exceptions\ParametroNaoInformadoException;
use BrunoViana\Correios\CalculoPrecoPrazo\Exceptions\ParametroInvalidoException;

class ValidaRequestTest extends TestCase
{
    public function test_Deve_Validar_Servicos_Do_Request()
    {
        $this->expectException(ParametroNaoInformadoException::class);
        $this->expectExceptionMessage('Parâmetro obrigatório não informado: "servicos"');

        (new ValidaRequest)->validar([]);
    }

    public function test_Deve_Validar_Origem_Do_Request()
    {
        $this->expectException(ParametroNaoInformadoException::class);
        $this->expectExceptionMessage('Parâmetro obrigatório não informado: "origem"');

        (new ValidaRequest)->validar([
            'servicos' => ['41106'],
        ]);
    }

    public function test_Deve_Validar_Destino_Do_Request()
    {
        $this->expectException(ParametroNaoInformadoException::class);
        $this->expectExceptionMessage('Parâmetro obrigatório não informado: "destino"');

        (new ValidaRequest)->validar([
            'servicos' => ['41106'],
            'origem' => '60842-130',
        ]);
    }

    public function test_Deve_Validar_Formato_Do_Request()
    {
        $this->expectException(ParametroNaoInformadoException::class);
        $this->expectExceptionMessage('Parâmetro obrigatório não informado: "formato"');

        (new ValidaRequest)->validar([
            'servicos' => ['41106'],
            'origem' => '60842-130',
            'destino' => '22775-051',
        ]);
    }

    public function test_Deve_Validar_Peso_Do_Request()
    {
        $this->expectException(ParametroNaoInformadoException::class);
        $this->expectExceptionMessage('Parâmetro obrigatório não informado: "peso"');

        (new ValidaRequest)->validar([
            'servicos' => ['41106'],
            'origem' => '60842-130',
            'destino' => '22775-051',
            'formato' => 1,
        ]);
    }

    public function test_Deve_Validar_Comprimento_Do_Request()
    {
        $this->expectException(ParametroNaoInformadoException::class);
        $this->expectExceptionMessage('Parâmetro obrigatório não informado: "comprimento"');

        (new ValidaRequest)->validar([
            'servicos' => ['41106'],
            'origem' => '60842-130',
            'destino' => '22775-051',
            'formato' => 1,
            'peso' => 0.500,
        ]);
    }

    public function test_Deve_Validar_Altura_Do_Request()
    {
        $this->expectException(ParametroNaoInformadoException::class);
        $this->expectExceptionMessage('Parâmetro obrigatório não informado: "altura"');

        (new ValidaRequest)->validar([
            'servicos' => ['41106'],
            'origem' => '60842-130',
            'destino' => '22775-051',
            'formato' => 1,
            'peso' => 0.500,
            'comprimento' => 20,
        ]);
    }

    public function test_Deve_Validar_Largura_Do_Request()
    {
        $this->expectException(ParametroNaoInformadoException::class);
        $this->expectExceptionMessage('Parâmetro obrigatório não informado: "largura"');

        (new ValidaRequest)->validar([
            'servicos' => ['41106'],
            'origem' => '60842-130',
            'destino' => '22775-051',
            'formato' => 1,
            'peso' => 0.500,
            'comprimento' => 20,
            'altura' => 20,
        ]);
    }

    public function test_Deve_Validar_Diametro_Do_Request()
    {
        $this->expectException(ParametroNaoInformadoException::class);
        $this->expectExceptionMessage('Parâmetro obrigatório não informado: "diametro"');

        (new ValidaRequest)->validar([
            'servicos' => ['41106'],
            'origem' => '60842-130',
            'destino' => '22775-051',
            'formato' => 1,
            'peso' => 0.500,
            'comprimento' => 20,
            'altura' => 20,
            'largura' => 20,
        ]);
    }

    public function test_Deve_Validar_Mao_Propria_Do_Request()
    {
        $this->expectException(ParametroInvalidoException::class);
        $this->expectExceptionMessage('Parâmetro passado não é válido: "mao_propria" (o valor "Q" foi informado)');

        (new ValidaRequest)->validar([
            'servicos' => ['41106'],
            'origem' => '60842-130',
            'destino' => '22775-051',
            'formato' => 1,
            'peso' => 0.500,
            'comprimento' => 20,
            'altura' => 20,
            'largura' => 20,
            'diametro' => 0,
            'mao_propria' => 'Q'
        ]);
    }

    public function test_Deve_Validar_Aviso_Recebimento_Do_Request()
    {
        $this->expectException(ParametroInvalidoException::class);
        $this->expectExceptionMessage('Parâmetro passado não é válido: "aviso_recebimento" (o valor "Q" foi informado)');

        (new ValidaRequest)->validar([
            'servicos' => ['41106'],
            'origem' => '60842-130',
            'destino' => '22775-051',
            'formato' => 1,
            'peso' => 0.500,
            'comprimento' => 20,
            'altura' => 20,
            'largura' => 20,
            'diametro' => 0,
            'aviso_recebimento' => 'Q'
        ]);
    }
}
