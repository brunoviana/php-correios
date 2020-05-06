<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Services;

use BrunoViana\Correios\CalculoPrecoPrazo\Client;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Request;
use BrunoViana\Correios\CalculoPrecoPrazo\Interfaces\ClientInterface;

class CalculadorService
{
    protected $client;

    protected $dados = [
        'servicos' => [],
        'itens' => [],
        'usuario' => '',
        'senha' => '',
        'origem' => '',
        'destino' => '',
        'formato' => 0,
        'mao_propria' => '',
        'valor_declarado' => '',
        'aviso_recebimento' => '',
    ];
    
    public function __construct(ClientInterface $client, array $dadosRequest = [])
    {
        $this->client = $client;
        $this->dados = $dadosRequest;
    }

    protected function iniciaDados($dadosRecebidos)
    {
        foreach ($this->dados as $indice => $valor) {
            if (isset($dadosRecebidos[$indice])) {
                $this->dados[$indice] = $dadosRecebidos[$indice];
            }
        }
    }

    protected function encomenda()
    {
        $encomenda = Encomenda::nova(
            (int) $this->dados['formato']
        );

        foreach ($this->dados['itens'] as $item) {
            $encomenda->item(
                $item['quantidade'],
                $item['peso'],
                $item['comprimento'],
                $item['altura'],
                $item['largura'],
                $item['diametro'] ?? 0,
            );
        }

        return $encomenda;
    }

    protected function montaRequest()
    {
        $encomenda = $this->encomenda();

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

    public function calcular()
    {
        return $this->client->consultar(
            $this->montaRequest()
        );
    }
}
