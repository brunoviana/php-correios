<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Services;

use BrunoViana\Correios\CalculoPrecoPrazo\Client\ClientInterface;

abstract class AbstractCalculador
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

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function servicos(array $servicos)
    {
        $this->dados['servicos'] = $servicos;

        return $this;
    }

    public function item(
        $quantidade,
        $peso,
        $comprimento,
        $altura,
        $largura,
        $diametro
    ) {
        $this->dados['itens'][] = [
            'quantidade' => $quantidade,
            'peso' => $peso,
            'comprimento' => $comprimento,
            'altura' => $altura,
            'largura' => $largura,
            'diametro' => $diametro,
        ];

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

    abstract public function calcular() : array;
}
