<?php

namespace BrunoViana\Correios\Tests\CalculoPrecoPrazo\Client;

use BrunoViana\Correios\Tests\TestCase;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Response;

class ResponseTest extends TestCase
{
    public function test_Deve_Retornar_Codigo_Com_Sucesso()
    {
        $response = new Response([
            'Codigo' => '04014'
        ], 200);

        $this->assertEquals(
            '04014',
            $response->codigo()
        );
    }

    public function test_Deve_Retornar_Valor_Com_Sucesso()
    {
        $response = new Response([
            'Valor' => '9,99'
        ], 200);

        $this->assertIsFloat($response->valor());

        $this->assertEquals(
            9.99,
            $response->valor()
        );
    }

    public function test_Deve_Retornar_Prazo_Entrega_Com_Sucesso()
    {
        $response = new Response([
            'PrazoEntrega' => '3'
        ], 200);

        $this->assertEquals(
            '3',
            $response->prazoEntrega()
        );
    }

    public function test_Deve_Retornar_Valor_Sem_Adicionais_Com_Sucesso()
    {
        $response = new Response([
            'ValorSemAdicionais' => '9,99'
        ], 200);

        $this->assertIsFloat($response->valorSemAdicionais());

        $this->assertEquals(
            9.99,
            $response->valorSemAdicionais()
        );
    }

    public function test_Deve_Retornar_Valor_Mao_Propria_Com_Sucesso()
    {
        $response = new Response([
            'ValorMaoPropria' => '9,99'
        ], 200);

        $this->assertIsFloat($response->valorMaoPropria());

        $this->assertEquals(
            9.99,
            $response->valorMaoPropria()
        );
    }

    public function test_Deve_Retornar_Valor_Aviso_Recebimento_Com_Sucesso()
    {
        $response = new Response([
            'ValorAvisoRecebimento' => '9,99'
        ], 200);

        $this->assertIsFloat($response->valorAvisoRecebimento());

        $this->assertEquals(
            9.99,
            $response->valorAvisoRecebimento()
        );
    }

    public function test_Deve_Retornar_Valor_Do_Valor_Declarado_Com_Sucesso()
    {
        $response = new Response([
            'ValorValorDeclarado' => '9,99'
        ], 200);

        $this->assertIsFloat($response->valorValorDeclarado());

        $this->assertEquals(
            9.99,
            $response->valorValorDeclarado()
        );
    }

    public function test_Deve_Retornar_Entrega_Domiciliar_Com_Sucesso()
    {
        $response = new Response([
            'EntregaDomiciliar' => 'S'
        ], 200);

        $this->assertEquals(
            'S',
            $response->entregaDomiciliar()
        );

        $response2 = new Response([
            'EntregaDomiciliar' => ''
        ], 200);

        $this->assertEquals(
            '',
            $response2->entregaDomiciliar()
        );

        // pode ficar assim na conversão do array
        $response3 = new Response([
            'EntregaDomiciliar' => []
        ], 200);

        $this->assertEquals(
            '',
            $response3->entregaDomiciliar()
        );
    }

    public function test_Deve_Retornar_Entrega_Sabado_Com_Sucesso()
    {
        $response = new Response([
            'EntregaSabado' => 'S'
        ], 200);

        $this->assertEquals(
            'S',
            $response->entregaSabado()
        );

        $response2 = new Response([
            'EntregaSabado' => ''
        ], 200);

        $this->assertEquals(
            '',
            $response2->entregaSabado()
        );

        // pode ficar assim na conversão do array
        $response3 = new Response([
            'EntregaSabado' => []
        ], 200);

        $this->assertEquals(
            '',
            $response3->entregaSabado()
        );
    }

    public function test_Deve_Retornar_Observacao_Com_Sucesso()
    {
        $response = new Response([
            'obsFim' => 'Nenhuma observação'
        ], 200);

        $this->assertEquals(
            'Nenhuma observação',
            $response->observacao()
        );

        // pode ficar assim na conversão do array
        $response3 = new Response([
            'obsFim' => []
        ], 200);

        $this->assertEquals(
            '',
            $response3->observacao()
        );

        // pode acontecer de não retornar observacao
        $response3 = new Response([], 200);

        $this->assertEquals(
            '',
            $response3->observacao()
        );
    }

    public function test_Deve_Retornar_Erro_Com_Sucesso()
    {
        $response = new Response([
            'Erro' => '-888'
        ], 200);

        $this->assertEquals(
            '-888',
            $response->erro()
        );
    }

    public function test_Deve_Retornar_Mensagem_De_Erro_Com_Sucesso()
    {
        $response = new Response([
            'MsgErro' => 'Não foi encontrada precificação. ERP-008: Dimensoes nao localizadas ou ultrapassam os limites aceitos para este tipo de objeto(-1).'
        ], 200);

        $this->assertEquals(
            'Não foi encontrada precificação. ERP-008: Dimensoes nao localizadas ou ultrapassam os limites aceitos para este tipo de objeto(-1).',
            $response->mensagemErro()
        );

        $response = new Response([
            'MsgErro' => []
        ], 200);

        $this->assertEquals(
            '',
            $response->mensagemErro()
        );
    }

    public function test_Deve_Retornar_Codigo_Http_Com_Sucesso()
    {
        $response = new Response([], 200);

        $this->assertEquals(
            200,
            $response->codigoHttp()
        );

        $response2 = new Response([], 401);

        $this->assertEquals(
            401,
            $response2->codigoHttp()
        );
    }

    public function test_Deve_Retornar_Response_Em_Array()
    {
        $response = new Response([
            'Codigo' => '04014',
            'Valor' => '9,99',
            'PrazoEntrega' => '3',
            'ValorSemAdicionais' => '9,98',
            'ValorMaoPropria' => '9,97',
            'ValorAvisoRecebimento' => '9,96',
            'ValorValorDeclarado' => '9,95',
            'EntregaDomiciliar' => 'S',
            'EntregaSabado' => 'N',
            'obsFim' => 'Nenhuma observação',
            'Erro' => '-888',
            'MsgErro' => 'Não foi encontrada precificação. ERP-008: Dimensoes nao localizadas ou ultrapassam os limites aceitos para este tipo de objeto(-1).'
        ], 200);

        $this->assertEquals([
            'codigo' => '04014',
            'valor' => 9.99,
            'valor_sem_adicional' => 9.98,
            'prazo_entrega' => 3,
            'valor_mao_propria' => 9.97,
            'valor_aviso_recebimento' => 9.96,
            'valor_valor_declarado' => 9.95,
            'entrega_domiciliar' => 'S',
            'entrega_sabado' => 'N',
            'observacao' => 'Nenhuma observação',
            'codigo_erro' => '-888',
            'mensagem_erro' => 'Não foi encontrada precificação. ERP-008: Dimensoes nao localizadas ou ultrapassam os limites aceitos para este tipo de objeto(-1).',
            'codigo_http' => 200,
        ], $response->emArray());
    }
}
