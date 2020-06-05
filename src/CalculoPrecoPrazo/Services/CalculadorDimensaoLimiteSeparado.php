<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Services;

use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Request;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Response;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\ClientInterface;

class CalculadorDimensaoLimiteSeparado extends AbstractCalculador
{
    protected $dimensaoLimite;

    public function __construct(ClientInterface $client, $dimensaoLimite=70)
    {
        parent::__construct($client);

        $this->dimensaoLimite = $dimensaoLimite;
    }

    public function calcular() : array
    {
        $calculos = [];

        $itensAcima = [];
        $itensAbaixo = [];

        foreach ($this->dados['itens'] as $item) {
            $maiorDimensao = max(
                $item['comprimento'],
                $item['altura'],
                $item['largura']
            );

            if ($maiorDimensao > $this->dimensaoLimite) {
                $itensAcima[] = $item;
            } else {
                $itensAbaixo[] = $item;
            }
        }

        foreach ($itensAcima as $item) {
            for ($i = 0; $i < $item['quantidade']; $i++) {
                $encomenda = Encomenda::nova(
                    $this->dados['formato'],
                    true
                );

                $encomenda->item(
                    1,
                    $item['peso'],
                    isset($item['comprimento']) ? $item['comprimento'] : 0,
                    isset($item['altura']) ? $item['altura'] : 0,
                    isset($item['largura']) ? $item['largura'] : 0,
                    isset($item['diametro']) ? $item['diametro'] : 0
                );

                $request = $this->criaRequest($encomenda);

                $response = $this->client->consultar($request);

                foreach ($response as $calculo) {
                    $this->adicionaCalculo($calculos, $calculo);
                }
            }
        }

        $encomenda = Encomenda::nova(
            $this->dados['formato']
        );

        foreach ($itensAbaixo as $item) {
            $encomenda->item(
                $item['quantidade'],
                $item['peso'],
                isset($item['comprimento']) ? $item['comprimento'] : 0,
                isset($item['altura']) ? $item['altura'] : 0,
                isset($item['largura']) ? $item['largura'] : 0,
                isset($item['diametro']) ? $item['diametro'] : 0
            );
        }

        $request = $this->criaRequest($encomenda);

        $response = $this->client->consultar($request);

        foreach ($response as $calculo) {
            $this->adicionaCalculo($calculos, $calculo);
        }

        $novosResponses = [];

        foreach ($calculos as $calculo) {
            $novosResponses[] = new Response($calculo, 200);
        }

        return $novosResponses;
    }

    protected function criaRequest($encomenda)
    {
        return new Request([
            'servicos' => $this->dados['servicos'],
            'usuario' => $this->dados['usuario'],
            'senha' => $this->dados['senha'],
            'origem' => $this->dados['origem'],
            'destino' => $this->dados['destino'],
            'formato' => $this->dados['formato'],
            'peso' => $encomenda->peso(),
            'comprimento' => $encomenda->comprimento(),
            'altura' => $encomenda->altura(),
            'largura' => $encomenda->largura(),
            'diametro' => $encomenda->diametro(),
            'mao_propria' => $this->dados['mao_propria'],
            'valor_declarado' => $this->dados['valor_declarado'],
            'aviso_recebimento' => $this->dados['aviso_recebimento'],
        ]);
    }

    protected function adicionaCalculo(&$calculos, $calculo)
    {
        $servico = $calculo->codigo();

        if (!isset($calculos[$servico])) {
            $calculos[$servico] = [
                'Codigo' => $calculo->codigo(),
                'Valor' => 0,
                'PrazoEntrega' => 0,
                'ValorSemAdicionais' => 0,
                'ValorMaoPropria' => 0,
                'ValorAvisoRecebimento' => 0,
                'ValorValorDeclarado' => 0,
                'EntregaDomiciliar' => $calculo->entregaDomiciliar(),
                'EntregaSabado' => $calculo->entregaSabado(),
                'obsFim' => [],
                'Erro' => [],
                'MsgErro' => [],
            ];
        }

        $calculos[$servico]['Valor'] += $calculo->valor();
        $calculos[$servico]['ValorSemAdicionais'] += $calculo->valorSemAdicionais();
        $calculos[$servico]['ValorMaoPropria'] += $calculo->valorMaoPropria();
        $calculos[$servico]['ValorAvisoRecebimento'] += $calculo->valorAvisoRecebimento();
        $calculos[$servico]['ValorValorDeclarado'] += $calculo->valorValorDeclarado();

        if ($calculo->prazoEntrega() > $calculos[$servico]['PrazoEntrega']) {
            $calculos[$servico]['PrazoEntrega'] = $calculo->prazoEntrega();
        }

        if ($calculo->observacao()) {
            $calculos[$servico]['obsFim'][] = $calculo->observacao();
        }

        if ($calculo->erro()) {
            $calculos[$servico]['Erro'][] = $calculo->erro();
        }

        if ($calculo->mensagemErro()) {
            $calculos[$servico]['MsgErro'][] = $calculo->mensagemErro();
        }
    }
}
