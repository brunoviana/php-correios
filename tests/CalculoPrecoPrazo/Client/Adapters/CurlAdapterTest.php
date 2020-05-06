<?php

namespace BrunoViana\Correios\Tests\CalculoPrecoPrazo\Client;

use BrunoViana\Correios\Tests\TestCase;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Request;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Response;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Adapters\CurlAdapter;
use BrunoViana\Correios\CalculoPrecoPrazo\Interfaces\Client\HttpRequestInterface;

class CurlAdapterTest extends TestCase
{
    public function test_Deve_Realizar_Consulta_Com_Sucesso()
    {
        $httpMock = $this->createMock(HttpRequestInterface::class);
        $httpMock->method('execute')->willReturn(
            $this->xmlRetornoCorreios()
        );

        $httpMock->expects($this->at(1))
                    ->method('setOption')
                    ->with(
                        $this->equalTo(CURLOPT_URL),
                        $this->equalTo($this->requestUrl())
                    );

        
        $httpMock->method('getInfo')
                    ->with(CURLINFO_HTTP_CODE)
                    ->willReturn(200);

        $client = new CurlAdapter($httpMock);
        $response = $client->enviar(
            'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx',
            $this->parametros()
        );
        
        $this->assertEquals('04014', $response->codigo());
        $this->assertEquals(10.00, $response->valor());
        $this->assertEquals(3, $response->prazoEntrega());
        $this->assertEquals(1.9, $response->valorSemAdicionais());
        $this->assertEquals(2.8, $response->valorMaoPropria());
        $this->assertEquals(3.7, $response->valorAvisoRecebimento());
        $this->assertEquals(4.6, $response->valorValorDeclarado());
        $this->assertEquals('', $response->entregaDomiciliar());
        $this->assertEquals('', $response->entregaSabado());
        $this->assertEquals('', $response->observacao());
        $this->assertEquals('-888', $response->erro());
        $this->assertEquals('Não foi encontrada precificação.', $response->mensagemErro());
    }

    public function test_Deve_Retornar_Response_Com_Erro()
    {
        $httpMock = $this->createMock(HttpRequestInterface::class);
        $httpMock->method('execute')->willReturn('');
        $httpMock->method('getInfo')
                    ->with(CURLINFO_HTTP_CODE)
                    ->willReturn(false);

        $client = new CurlAdapter($httpMock);

        $response = $client->enviar(
            'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx',
            $this->parametros()
        );

        $this->assertEquals(0, $response->codigoHttp());
    }

    private function parametros()
    {
        return [
            'nCdEmpresa' => '',
            'nCdServico' => '04014',
            'sDsSenha' => '',
            'sCepOrigem' => '30170-010',
            'sCepDestino' => '04538-132',
            'nVlPeso' => 0.150,
            'nCdFormato' => 2,
            'nVlComprimento' => 17,
            'nVlAltura' => 15,
            'nVlLargura' => 12,
            'nVlDiametro' => 4,
            'sCdMaoPropria' => 'N',
            'nVlValorDeclarado' => 0,
            'sCdAvisoRecebimento' => 'N',
            'StrRetorno' => 'XML'
        ];
    }

    private function requestUrl()
    {
        return 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?'
                .'nCdEmpresa=&'
                .'nCdServico=04014&'
                .'sDsSenha=&'
                .'sCepOrigem=30170-010&'
                .'sCepDestino=04538-132&'
                .'nVlPeso=0.15&'
                .'nCdFormato=2&'
                .'nVlComprimento=17&'
                .'nVlAltura=15&'
                .'nVlLargura=12&'
                .'nVlDiametro=4&'
                .'sCdMaoPropria=N&'
                .'nVlValorDeclarado=0&'
                .'sCdAvisoRecebimento=N&'
                .'StrRetorno=XML';
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
}
