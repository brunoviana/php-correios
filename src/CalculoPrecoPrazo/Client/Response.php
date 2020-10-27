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
        return isset($this->dados['Codigo']) ? $this->dados['Codigo'] : null;
    }

    public function valor()
    {
        return (float) $this->formataValor(
            isset($this->dados['Valor']) ? $this->dados['Valor'] : 0
        );
    }

    public function valorSemAdicionais()
    {
        return (float) $this->formataValor(
            isset($this->dados['ValorSemAdicionais']) ? $this->dados['ValorSemAdicionais'] : 0
        );
    }

    public function prazoEntrega()
    {
        return (int) isset($this->dados['PrazoEntrega']) ? $this->dados['PrazoEntrega'] : 0;
    }

    public function valorMaoPropria()
    {
        return (float) $this->formataValor(
            isset($this->dados['ValorMaoPropria']) ? $this->dados['ValorMaoPropria'] : 0
        );
    }

    public function valorAvisoRecebimento()
    {
        return (float) $this->formataValor(
            isset($this->dados['ValorAvisoRecebimento']) ? $this->dados['ValorAvisoRecebimento'] : 0
        );
    }

    public function valorValorDeclarado()
    {
        return (float) $this->formataValor(
            isset($this->dados['ValorValorDeclarado']) ? $this->dados['ValorValorDeclarado'] : 0
        );
    }

    public function entregaDomiciliar()
    {
        $entregaDomiciliar = isset($this->dados['EntregaDomiciliar']) ? $this->dados['EntregaDomiciliar'] : null;

        // Isso pode acontecer na conversão do retorno para array
        if (is_array($entregaDomiciliar) && empty($entregaDomiciliar)) {
            return '';
        }

        return $entregaDomiciliar;
    }

    public function entregaSabado()
    {
        $entregaSabado = isset($this->dados['EntregaSabado']) ? $this->dados['EntregaSabado'] : 0;

        // Isso pode acontecer na conversão do retorno para array
        if (is_array($entregaSabado) && empty($entregaSabado)) {
            return '';
        }

        return $entregaSabado;
    }

    public function observacao()
    {
        $obsFim = isset($this->dados['obsFim']) ? $this->dados['obsFim'] : 0;

        // Isso pode acontecer na conversão do retorno para array
        if (!isset($this->dados['obsFim']) ||
            (is_array($obsFim) && empty($obsFim))
        ) {
            return '';
        }

        return $obsFim;
    }

    public function erro()
    {
        return isset($this->dados['Erro']) ? $this->dados['Erro'] : 0;
    }

    public function mensagemErro()
    {
        $msgErro = isset($this->dados['MsgErro']) ? $this->dados['MsgErro'] : 0;

        // Isso pode acontecer na conversão do retorno para array
        if (is_array($msgErro) && empty($msgErro)) {
            return '';
        }

        return $msgErro;
    }

    private function formataValor($valor)
    {
        if (is_string($valor)) {
            $valorSoDigitos = preg_replace('/\D/', '', $valor);

            return (float) $valorSoDigitos / 100;
        }

        return $valor;
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
