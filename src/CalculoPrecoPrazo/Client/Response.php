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

    public function sucesso()
    {
        return $this->codigoHttp() == 200;
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
        return (float) $this->formataValor($this->dados['Valor']);
    }

    public function valorSemAdicionais()
    {
        return (float) $this->formataValor($this->dados['ValorSemAdicionais']);
    }

    public function prazoEntrega()
    {
        return (int) $this->dados['PrazoEntrega'];
    }

    public function valorMaoPropria()
    {
        return (float) $this->formataValor($this->dados['ValorMaoPropria']);
    }

    public function valorAvisoRecebimento()
    {
        return (float) $this->formataValor($this->dados['ValorAvisoRecebimento']);
    }

    public function valorValorDeclarado()
    {
        return (float) $this->formataValor($this->dados['ValorValorDeclarado']);
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
        if (!isset($this->dados['obsFim']) || is_array($this->dados['obsFim'])) {
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
        // Isso pode acontecer na conversão do retorno para array
        if (is_array($this->dados['MsgErro'])) {
            return '';
        }

        return $this->dados['MsgErro'];
    }

    private function formataValor($valor)
    {
        $valorSoDigitos = preg_replace('/\D/', '', $valor);

        return (float) $valorSoDigitos / 100;
    }

    public function emArray()
    {
        return [
            'codigo' => $this->codigo(),
            'valor' => $this->valor(),
            'valor_sem_adicional' => $this->valorSemAdicionais(),
            'prazo_entrega' => $this->prazoEntrega(),
            'valor_mao_propria' => $this->valorMaoPropria(),
            'valor_aviso_recebimento' => $this->valorAvisoRecebimento(),
            'valor_valor_declarado' => $this->valorValorDeclarado(),
            'entrega_domiciliar' => $this->entregaDomiciliar(),
            'entrega_sabado' => $this->entregaSabado(),
            'observacao' => $this->observacao(),
            'codigo_erro' => $this->erro(),
            'mensagem_erro' => $this->mensagemErro(),
            'codigo_http' => $this->codigoHttp(),
        ];
    }
}
