<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Client;

class Request
{
    private $url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';

    private $dados = [];

    public function __construct(array $dados)
    {
        $this->dados = $dados;
    }

    public function url()
    {
        return $this->url;
    }

    public function usuario()
    {
        return $this->dados['usuario'] ?? '';
    }

    public function senha()
    {
        return $this->dados['senha'] ?? '';
    }

    public function servicos()
    {
        return $this->dados['servicos'];
    }

    public function origem()
    {
        return $this->trataCep($this->dados['origem']);
    }

    public function destino()
    {
        return $this->trataCep($this->dados['destino']);
    }

    public function peso()
    {
        return (float) $this->dados['peso'];
    }

    public function formato()
    {
        return $this->dados['formato'];
    }

    public function comprimento()
    {
        return $this->dados['comprimento'];
    }

    public function altura()
    {
        return $this->dados['altura'];
    }

    public function largura()
    {
        return $this->dados['largura'];
    }

    public function diametro()
    {
        return $this->dados['diametro'];
    }

    public function maoPropria()
    {
        if (isset($this->dados['mao_propria']) && is_bool($this->dados['mao_propria'])) {
            return $this->dados['mao_propria'] === false ? 'N' : 'S';
        }

        if (isset($this->dados['mao_propria']) && is_int($this->dados['mao_propria'])) {
            return $this->dados['mao_propria'] === 0 ? 'N' : 'S';
        }
        
        return $this->dados['mao_propria'] ?? 'N';
    }

    public function valorDeclarado()
    {
        return $this->dados['valor_declarado'] ?? 0;
    }

    public function avisoRecebimento()
    {
        if (isset($this->dados['aviso_recebimento']) && is_bool($this->dados['aviso_recebimento'])) {
            return $this->dados['aviso_recebimento'] === false ? 'N' : 'S';
        }

        if (isset($this->dados['aviso_recebimento']) && is_int($this->dados['aviso_recebimento'])) {
            return $this->dados['aviso_recebimento'] === 0 ? 'N' : 'S';
        }

        return $this->dados['aviso_recebimento'] ?? 'N';
    }

    private function trataCep($cep)
    {
        return sprintf("%08s", preg_replace('/\D/', '', $cep));
    }
}
