<?php

namespace BrunoViana\Correios\Tests\CalculoPrecoPrazo\Client;

use BrunoViana\Correios\Tests\TestCase;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Request;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Response;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\CurlAdapter;
use BrunoViana\Correios\CalculoPrecoPrazo\Interfaces\Client\HttpRequest;

class CurlAdapterTest extends TestCase
{
    public function test_Deve_Realizar_Consulta_Com_Sucesso()
    {
        $httpMock = $this->createStub(HttpRequest::class);
        $httpMock->method('execute')->willReturn(
            $this->xmlRetornoCorreios()
        );
        
        $request = new Request([
            'servicos' => [
                '04014'
            ],
            'usuario' => '',
            'senha' => '',
            'origem' => '30170-010',
            'destino' => '04538-132',
            'peso' => 0.150,
            'formato' => 2,
            'comprimento' => 17,
            'altura' => 15,
            'largura' => 12,
            'diametro' => 4,
            'mao_propria' => 'N',
            'valor_declarado' => 0,
            'aviso_recebimento' => 'N',
        ]);

        $client = new CurlAdapter($httpMock);
        $respostas = $client->consultar($request);

        $servico = $respostas[0];

        $this->assertInstanceOf(Response::class, $servico);
        
        $this->assertEquals('04014', $servico->codigo());
        $this->assertEquals(10.00, $servico->valor());
        $this->assertEquals(3, $servico->prazoEntrega());
        $this->assertEquals(1.9, $servico->valorSemAdicionais());
        $this->assertEquals(2.8, $servico->valorMaoPropria());
        $this->assertEquals(3.7, $servico->valorAvisoRecebimento());
        $this->assertEquals(4.6, $servico->valorValorDeclarado());
        $this->assertEquals('', $servico->entregaDomiciliar());
        $this->assertEquals('', $servico->entregaSabado());
        $this->assertEquals('', $servico->observacao());
        $this->assertEquals('-888', $servico->erro());
        $this->assertEquals('Não foi encontrada precificação.', $servico->mensagemErro());
    }

    private function xmlRetornoCorreios()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>
        <Servicos>
           <cServico>
              <Codigo>04014</Codigo>
              <Valor>10,00</Valor>
              <PrazoEntrega>3</PrazoEntrega>
              <ValorSemAdicionais>1,90</ValorSemAdicionais>
              <ValorMaoPropria>2,80</ValorMaoPropria>
              <ValorAvisoRecebimento>3,70</ValorAvisoRecebimento>
              <ValorValorDeclarado>4,60</ValorValorDeclarado>
              <EntregaDomiciliar />
              <EntregaSabado />
              <obsFim />
              <Erro>-888</Erro>
              <MsgErro><![CDATA[Não foi encontrada precificação.]]></MsgErro>
           </cServico>
        </Servicos>';
    }

    // validação de parametros
    // exception se retorna sttus != 200
}
