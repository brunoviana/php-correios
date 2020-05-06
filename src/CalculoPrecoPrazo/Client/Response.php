<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Client;

class Response
{
    private $dados = [];

    private $codigoHttp;

    public function __construct(array $dados, int $codigoHttp)
    {
        $this->dados = $dados;
        $this->codigoHttp = $codigoHttp;
    }

    public function codigoHttp()
    {
        return $this->codigoHttp;
    }

    public function codigo()
    {
        return $this->dados['Codigo'];
    }

    public function valor()
    {
        return $this->formataValor($this->dados['Valor']);
    }

    public function valorSemAdicionais()
    {
        return $this->formataValor($this->dados['ValorSemAdicionais']);
    }

    public function prazoEntrega()
    {
        return $this->dados['PrazoEntrega'];
    }

    public function valorMaoPropria()
    {
        return $this->formataValor($this->dados['ValorMaoPropria']);
    }

    public function valorAvisoRecebimento()
    {
        return $this->formataValor($this->dados['ValorAvisoRecebimento']);
    }

    public function valorValorDeclarado()
    {
        return $this->formataValor($this->dados['ValorValorDeclarado']);
    }

    public function entregaDomiciliar()
    {
        // Isso pode acontecer na conversão do retorno para array
        if (is_array($this->dados['EntregaDomiciliar'])) {
            return '';
        }
        
        return $this->dados['EntregaDomiciliar'];
    }

    public function entregaSabado()
    {
        // Isso pode acontecer na conversão do retorno para array
        if (is_array($this->dados['EntregaSabado'])) {
            return '';
        }
        
        return $this->dados['EntregaSabado'];
    }

    public function observacao()
    {
        // Isso pode acontecer na conversão do retorno para array
        if (is_array($this->dados['obsFim'])) {
            return '';
        }

        return $this->dados['obsFim'];
    }
    
    public function erro()
    {
        return $this->dados['Erro'];
    }
    
    public function mensagemErro()
    {
        return $this->dados['MsgErro'];
    }

    private function formataValor($valor)
    {
        $valorSoDigitos = preg_replace('/\D/', '', $valor);

        return (float) $valorSoDigitos / 100;
    }
}
