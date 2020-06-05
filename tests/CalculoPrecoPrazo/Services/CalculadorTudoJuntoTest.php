<?php

namespace BrunoViana\Correios\Tests\CalculoPrecoPrazo\Service;

use BrunoViana\Correios\Tests\TestCase;
use BrunoViana\Correios\CalculoPrecoPrazo\Client;
use BrunoViana\Correios\CalculoPrecoPrazo\Services\CalculadorTudoJunto;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Adapters\CurlAdapter;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Http\HttpRequestInterface;

class CalculadorTudoJuntoTest extends TestCase
{
    private $dadosService = [
        'servicos' => [
            '41106'
        ],
        'usuario' => '',
        'senha' => '',
        'origem' => '60842-130',
        'destino' => '22775-051',
        'formato' => 1,
        'maoPropria' => 'N',
        'valorDeclarado' => 0,
        'avisoRecebimento' => 'N',
    ];

    /**
     * @dataProvider itensProvider
     */
    public function test_Deve_Calcular_Caixa_Em_Uma_Unica_Encomenda($arrayComItens, $requestUrl)
    {
        $client = $this->client($requestUrl);
        $remessa = new CalculadorTudoJunto($client);

        extract($this->dadosService);

        $remessa->servicos($servicos)
                        ->usuario($usuario)
                        ->senha($senha)
                        ->origem($origem)
                        ->destino($destino)
                        ->formato($formato)
                        ->maoPropria($maoPropria)
                        ->valorDeclarado($valorDeclarado)
                        ->avisoRecebimento($avisoRecebimento);

        foreach ($arrayComItens as $arrayComItem) {
            list(
                $qtd,
                $peso,
                $comprimento,
                $altura,
                $largura,
                $diametro
            ) = $arrayComItem;

            $remessa->item(
                $qtd,
                $peso,
                $comprimento,
                $altura,
                $largura,
                $diametro
            );
        }

        $remessa->calcular();
    }

    public function itensProvider()
    {
        return [
            [
                [
                    [1, 0.71, 31, 27, 31, 0]
                ],
                $this->requestUrlUmItem()
            ],
            [
                [
                    [1, 0.71, 31, 27, 31, 0],
                    [1, 0.71, 31, 27, 31, 0]
                ],
                $this->requestUrlDoisItens()
            ],
            [
                [
                    [2, 0.71, 31, 27, 31, 0]
                ],
                $this->requestUrlDoisItens()
            ]
        ];
    }

    private function client($requestUrl)
    {
        $httpMock = $this->createMock(HttpRequestInterface::class);

        $httpMock->expects($this->once())
                    ->method('execute')
                    ->willReturn(
                        $this->xmlRetornoCorreios()
                    );

        $httpMock->expects($this->at(1))
                    ->method('setOption')
                    ->with(
                        $this->equalTo(CURLOPT_URL),
                        $this->equalTo($requestUrl)
                    );

        $httpMock->method('getInfo')
                    ->with(CURLINFO_HTTP_CODE)
                    ->willReturn(200);

        $curlAdapter = new CurlAdapter($httpMock);

        return new Client($curlAdapter);
    }

    private function xmlRetornoCorreios()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>
        <Servicos>
            <cServico>
                <Codigo>41106</Codigo>
                <Valor>31,00</Valor>
                <PrazoEntrega>15</PrazoEntrega>
                <ValorSemAdicionais>31,00</ValorSemAdicionais>
                <ValorMaoPropria>0,00</ValorMaoPropria>
                <ValorAvisoRecebimento>0,00</ValorAvisoRecebimento>
                <ValorValorDeclarado>0,00</ValorValorDeclarado>
                <EntregaDomiciliar>S</EntregaDomiciliar>
                <EntregaSabado>N</EntregaSabado>
                <obsFim></obsFim>
                <Erro>0</Erro>
                <MsgErro></MsgErro>
            </cServico>
        </Servicos>';
    }

    private function requestUrlUmItem()
    {
        return 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?'
                . 'nCdServico=41106&'
                . 'nCdEmpresa=&'
                . 'sDsSenha=&'
                . 'sCepOrigem=60842130&'
                . 'sCepDestino=22775051&'
                . 'nVlPeso=0.71&'
                . 'nCdFormato=1&'
                . 'nVlComprimento=29.6&'
                . 'nVlAltura=29.6&'
                . 'nVlLargura=29.6&'
                . 'nVlDiametro=0&'
                . 'sCdMaoPropria=N&'
                . 'nVlValorDeclarado=0&'
                . 'sCdAvisoRecebimento=N&'
                . 'StrRetorno=XML';
    }

    private function requestUrlDoisItens()
    {
        return 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?'
                . 'nCdServico=41106&'
                . 'nCdEmpresa=&'
                . 'sDsSenha=&'
                . 'sCepOrigem=60842130&'
                . 'sCepDestino=22775051&'
                . 'nVlPeso=1.42&'
                . 'nCdFormato=1&'
                . 'nVlComprimento=59.2&'
                . 'nVlAltura=59.2&'
                . 'nVlLargura=59.2&'
                . 'nVlDiametro=0&'
                . 'sCdMaoPropria=N&'
                . 'nVlValorDeclarado=0&'
                . 'sCdAvisoRecebimento=N&'
                . 'StrRetorno=XML';
    }
}
