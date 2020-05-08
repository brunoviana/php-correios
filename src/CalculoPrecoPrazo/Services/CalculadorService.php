<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Services;

use BrunoViana\Correios\CalculoPrecoPrazo\Client;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Request;
use BrunoViana\Correios\CalculoPrecoPrazo\Interfaces\ClientInterface;
use BrunoViana\Correios\CalculoPrecoPrazo\Interfaces\EncomendaInterface;
use BrunoViana\Correios\CalculoPrecoPrazo\Exceptions\ParametroNaoInformadoException;

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
        if (! $this->encomenda) {
            if (! isset($this->dados['formato']) || empty($this->dados['formato'])) {
                throw new ParametroNaoInformadoException('formato');
            }

            $this->encomenda = Encomenda::nova(
                $this->dados['formato']
            );
        }

        foreach ($this->dados['itens'] as $item) {
            $this->encomenda->item(
                $item['quantidade'],
                $item['peso'],
                isset($item['comprimento']) ? $item['comprimento'] : 0,
                isset($item['altura']) ? $item['altura'] : 0,
                isset($item['largura']) ? $item['largura'] : 0,
                isset($item['diametro']) ? $item['diametro'] : 0
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

    public function servicos(array $servicos)
    {
        $this->dados['servicos'] = $servicos;

        return $this;
    }

    public function item(array $item)
    {
        $this->dados['itens'][] = $item;

        return $this;
    }

    public function itens(array $itens)
    {
        $this->dados['itens'] = $itens;

        return $this;
    }

    public function usuario(string $usuario)
    {
        $this->dados['usuario'] = $usuario;

        return $this;
    }

    public function senha(string $senha)
    {
        $this->dados['senha'] = $senha;

        return $this;
    }

    public function origem(string $origem)
    {
        $this->dados['origem'] = $origem;

        return $this;
    }

    public function destino(string $destino)
    {
        $this->dados['destino'] = $destino;

        return $this;
    }

    public function formato(int $formato)
    {
        $this->dados['formato'] = $formato;

        return $this;
    }

    public function maoPropria($maoPropria)
    {
        $this->dados['mao_propria'] = $maoPropria;

        return $this;
    }

    public function valorDeclarado(float $valorDeclarado)
    {
        $this->dados['valor_declarado'] = $valorDeclarado;

        return $this;
    }

    public function avisoRecebimento($avisoRecebimento)
    {
        $this->dados['aviso_recebimento'] = $avisoRecebimento;

        return $this;
    }
}
