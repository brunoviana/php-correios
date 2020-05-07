<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Services;

use BrunoViana\Correios\CalculoPrecoPrazo\Client;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Request;
use BrunoViana\Correios\CalculoPrecoPrazo\Interfaces\ClientInterface;
use BrunoViana\Correios\CalculoPrecoPrazo\Interfaces\EncomendaInterface;

class CalculadorService
{
    protected $client;
    
    protected $encomenda;

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

    public static function novo($dados = [])
    {
        // Encomenda só é instanciado depois pois não sei se o formato já foi definido em $dados
        return new self(Client::novo(), null, $dados);
    }
    
    public function __construct(ClientInterface $client, EncomendaInterface $encomenda = null, array $dadosRequest = [])
    {
        $this->client = $client;
        
        $this->encomenda = $encomenda;
        
        $this->iniciaDados($dadosRequest);
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
        if (!$this->encomenda) {
            $this->encomenda = Encomenda::nova(
                $this->dados['formato']
            );
        }

        foreach ($this->dados['itens'] as $item) {
            $this->encomenda->item(
                $item['quantidade'],
                $item['peso'],
                $item['comprimento'],
                $item['altura'],
                $item['largura'],
                $item['diametro'] ?? 0,
            );
        }

        return $this->encomenda;
    }

    protected function request()
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
            $this->request()
        );
    }
}
