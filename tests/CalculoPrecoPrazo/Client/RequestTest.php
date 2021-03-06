<?php

namespace BrunoViana\Correios\Tests\CalculoPrecoPrazo\Client;

use BrunoViana\Correios\Tests\TestCase;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Request;

class RequestTest extends TestCase
{
    public function test_Deve_Retornar_Url_Com_Sucesso()
    {
        $request = new Request(
            $this->dadosRequest()
        );

        $this->assertEquals(
            'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx',
            $request->url()
        );
    }

    public function test_Deve_Retornar_Usuario_Com_Sucesso()
    {
        $request = new Request(
            $this->dadosRequest([
                'usuario' => '0001'
            ])
        );

        $this->assertEquals(
            '0001',
            $request->usuario()
        );
    }

    public function test_Deve_Retornar_Vazio_Se_Usuario_Nao_For_Informado()
    {
        $request = new Request(
            $this->dadosRequest()
        );

        $this->assertEquals(
            '',
            $request->usuario()
        );
    }

    public function test_Deve_Retornar_Senha_Com_Sucesso()
    {
        $request = new Request(
            $this->dadosRequest([
                'senha' => '0002'
            ])
        );

        $this->assertEquals(
            '0002',
            $request->senha()
        );
    }

    public function test_Deve_Retornar_Vazio_Se_Senha_Nao_For_Informada()
    {
        $request = new Request(
            $this->dadosRequest()
        );

        $this->assertEquals(
            '',
            $request->senha()
        );
    }

    public function test_Deve_Retornar_Origem_Com_Sucesso()
    {
        $request = new Request(
            $this->dadosRequest()
        );

        $this->assertEquals(
            '60110528',
            $request->origem()
        );
    }

    public function test_Deve_Retornar_Origem_Sem_Hifen()
    {
        $request = new Request(
            $this->dadosRequest([
                'origem' => '60110-528'
            ])
        );

        $this->assertEquals(
            '60110528',
            $request->origem()
        );
    }

    public function test_Deve_Retornar_Origem_Completando_Zero()
    {
        $request = new Request(
            $this->dadosRequest([
                'origem' => '4538-132'
            ])
        );

        $this->assertEquals(
            '04538132',
            $request->origem()
        );
    }

    public function test_Deve_Retornar_Destino_Com_Sucesso()
    {
        $request = new Request(
            $this->dadosRequest([
                'destino' => '60110528'
            ])
        );

        $this->assertEquals(
            '60110528',
            $request->destino()
        );
    }

    public function test_Deve_Retornar_Destino_Sem_Hifen()
    {
        $request = new Request(
            $this->dadosRequest([
                'destino' => '60110-528'
            ])
        );

        $this->assertEquals(
            '60110528',
            $request->destino()
        );
    }

    public function test_Deve_Retornar_Destino_Completando_Zero()
    {
        $request = new Request(
            $this->dadosRequest([
                'destino' => '4538-132'
            ])
        );

        $this->assertEquals(
            '04538132',
            $request->destino()
        );
    }

    public function test_Deve_Retornar_Peso_Com_Sucesso()
    {
        $request = new Request(
            $this->dadosRequest()
        );

        $this->assertEquals(
            0.150,
            $request->peso()
        );
    }

    public function test_Deve_Retornar_Formato_Com_Sucesso()
    {
        $request = new Request(
            $this->dadosRequest()
        );

        $this->assertEquals(
            1,
            $request->formato()
        );
    }

    public function test_Deve_Retornar_Comprimento_Com_Sucesso()
    {
        $request = new Request(
            $this->dadosRequest()
        );

        $this->assertEquals(
            17,
            $request->comprimento()
        );
    }

    public function test_Deve_Retornar_Altura_Com_Sucesso()
    {
        $request = new Request(
            $this->dadosRequest()
        );

        $this->assertEquals(
            15,
            $request->altura()
        );
    }

    public function test_Deve_Retornar_Largura_Com_Sucesso()
    {
        $request = new Request(
            $this->dadosRequest()
        );

        $this->assertEquals(
            12,
            $request->largura()
        );
    }

    public function test_Deve_Retornar_Diametro_Com_Sucesso()
    {
        $request = new Request(
            $this->dadosRequest()
        );

        $this->assertEquals(
            4,
            $request->diametro()
        );
    }

    public function test_Deve_Retornar_Mao_Propria_Com_Sucesso()
    {
        $request = new Request(
            $this->dadosRequest()
        );

        $this->assertEquals(
            'N',
            $request->maoPropria()
        );
    }

    public function test_Deve_Retornar_Mao_Propria_Correto_Se_Passar_Booleano_Ou_Inteiro()
    {
        $requestFalse = new Request(
            $this->dadosRequest([
                'mao_propria' => false
            ])
        );

        $this->assertEquals(
            'N',
            $requestFalse->maoPropria()
        );

        $requestTrue = new Request(
            $this->dadosRequest([
                'mao_propria' => true
            ])
        );

        $this->assertEquals(
            'S',
            $requestTrue->maoPropria()
        );

        $request0 = new Request(
            $this->dadosRequest([
                'mao_propria' => 0
            ])
        );

        $this->assertEquals(
            'N',
            $request0->maoPropria()
        );

        $request1 = new Request(
            $this->dadosRequest([
                'mao_propria' => 1
            ])
        );

        $this->assertEquals(
            'S',
            $request1->maoPropria()
        );
    }

    public function test_Mao_Propria_Deve_Retornar_Nao_Se_Nao_Declarado()
    {
        $request = new Request(
            $this->dadosRequest()
        );

        $this->assertEquals(
            'N',
            $request->maoPropria()
        );
    }

    public function test_Deve_Retornar_Valor_Declarado_Com_Sucesso()
    {
        $request = new Request(
            $this->dadosRequest([
                'valor_declarado' => 9.99
            ])
        );

        $this->assertEquals(
            9.99,
            $request->valorDeclarado()
        );
    }

    public function test_Deve_Retornar_Valor_Declarado_Zero_Se_Nao_Declarado()
    {
        $request = new Request(
            $this->dadosRequest()
        );

        $this->assertEquals(
            0,
            $request->valorDeclarado()
        );
    }

    public function test_Deve_Retornar_Aviso_Recebimento_Com_Sucesso()
    {
        $request = new Request(
            $this->dadosRequest([
                'aviso_recebimento' => 'N'
            ])
        );

        $this->assertEquals(
            'N',
            $request->avisoRecebimento()
        );
    }

    public function test_Deve_Retornar_Aviso_Recebimento_Correto_Se_Passar_Booleano_Ou_Inteiro()
    {
        $requestFalse = new Request(
            $this->dadosRequest([
                'aviso_recebimento' => false
            ])
        );

        $this->assertEquals(
            'N',
            $requestFalse->avisoRecebimento()
        );

        $requestTrue = new Request(
            $this->dadosRequest([
                'aviso_recebimento' => true
            ])
        );

        $this->assertEquals(
            'S',
            $requestTrue->avisoRecebimento()
        );

        $request0 = new Request(
            $this->dadosRequest([
                'aviso_recebimento' => 0
            ])
        );

        $this->assertEquals(
            'N',
            $request0->avisoRecebimento()
        );

        $request1 = new Request(
            $this->dadosRequest([
                'aviso_recebimento' => 1
            ])
        );

        $this->assertEquals(
            'S',
            $request1->avisoRecebimento()
        );
    }

    public function test_Aviso_Recebimento_Deve_Retornar_Nao_Se_Nao_Declarado()
    {
        $request = new Request(
            $this->dadosRequest()
        );

        $this->assertEquals(
            'N',
            $request->avisoRecebimento()
        );
    }

    public function test_Deve_Retornar_Servicos_Com_Sucesso()
    {
        $request = new Request(
            $this->dadosRequest([
                'servicos' => [
                    '04014'
                ]
            ])
        );

        $this->assertEquals(
            [
                '04014'
            ],
            $request->servicos()
        );
    }

    private function dadosRequest($merge = [])
    {
        return array_merge([
            'servicos' => [
                '04014'
            ],
            'usuario' => '',
            'senha' => '',
            'origem' => '60110528',
            'destino' => '04538132',
            'formato' => 1,
            'peso' => 0.150,
            'comprimento' => 17,
            'altura' => 15,
            'largura' => 12,
            'diametro' => 4,
            'mao_propria' => 'N',
            'valor_declarado' => 0,
            'aviso_recebimento' => 'N',
        ], $merge);
    }

    // validar campos do array
}
