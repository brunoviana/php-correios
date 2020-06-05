<?php

namespace BrunoViana\Correios\Tests\CalculoPrecoPrazo\Services;

use BrunoViana\Correios\Tests\TestCase;
use BrunoViana\Correios\CalculoPrecoPrazo\Client;
use BrunoViana\Correios\CalculoPrecoPrazo\Logger\ImprimeNaTelaLogger;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Adapters\CurlAdapter;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Http\HttpRequestInterface;
use BrunoViana\Correios\CalculoPrecoPrazo\Services\CalculadorDimensaoLimiteSeparado;

class CalculadorDimensaoLimiteSeparadoTest extends TestCase
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
    public function test_Deve_Calcular_Caixa_Em_Uma_Encomendas_Acima_Do_Limite_Separadas(
        $arrayComItens,
        $expects,
        $responseEsperado
    ) {
        $client = $this->client($expects);
        $remessa = new CalculadorDimensaoLimiteSeparado($client);

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

        $response = $remessa->calcular();

        $this->assertEquals($responseEsperado['Valor'], $response[0]->valor());
        $this->assertEquals($responseEsperado['ValorSemAdicionais'], $response[0]->valorSemAdicionais());
    }

    public function itensProvider()
    {
        return [
            [
                [
                    [1, 0.71, 31, 27, 31, 0]
                ],
                1,
                [
                    'Valor' => 31,
                    'ValorSemAdicionais' => 31,
                ]
            ],
            [
                [
                    [1, 0.71, 31, 27, 31, 0],
                    [1, 0.71, 31, 27, 31, 0]
                ],
                1,
                [
                    'Valor' => 31,
                    'ValorSemAdicionais' => 31,
                ]
            ],
            [
                [
                    [2, 0.71, 31, 27, 31, 0]
                ],
                1,
                [
                    'Valor' => 31,
                    'ValorSemAdicionais' => 31,
                ]
            ],
            [
                [
                    [1, 0.71, 71, 27, 31, 0],
                    [1, 0.71, 31, 27, 31, 0]
                ],
                2,
                [
                    'Valor' => 62,
                    'ValorSemAdicionais' => 62,
                ]
            ],
            [
                [
                    [1, 0.71, 71, 27, 31, 0],
                    [1, 0.71, 31, 27, 31, 0],
                    [1, 0.71, 31, 27, 31, 0]
                ],
                2,
                [
                    'Valor' => 62,
                    'ValorSemAdicionais' => 62,
                ]
            ],
            [
                [
                    [1, 0.71, 71, 27, 31, 0],
                    [1, 0.71, 80, 27, 31, 0],
                    [1, 0.71, 31, 27, 31, 0]
                ],
                3,
                [
                    'Valor' => 93,
                    'ValorSemAdicionais' => 93,
                ]
            ],
        ];
    }

    private function client($expects)
    {
        $httpMock = $this->createMock(HttpRequestInterface::class);

        $httpMock->expects($this->exactly($expects))
                    ->method('execute')
                    ->willReturn(
                        $this->xmlRetornoCorreios()
                    );

        $httpMock->method('getInfo')
                    ->with(CURLINFO_HTTP_CODE)
                    ->willReturn(200);

        $curlAdapter = new CurlAdapter($httpMock, new ImprimeNaTelaLogger());

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
                <obsFim>Sem observacao</obsFim>
                <Erro>001</Erro>
                <MsgErro>Ocorreu um erro</MsgErro>
            </cServico>
        </Servicos>';
    }
}
