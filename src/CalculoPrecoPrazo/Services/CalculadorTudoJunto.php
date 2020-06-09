<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Services;

use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Request;

class CalculadorTudoJunto extends AbstractCalculador
{
    public function calcular() : array
    {
        $encomenda = Encomenda::nova(
            $this->dados['formato']
        );

        foreach ($this->dados['itens'] as $item) {
            $encomenda->item(
                $item['quantidade'],
                $item['peso'],
                isset($item['comprimento']) ? $item['comprimento'] : 0,
                isset($item['altura']) ? $item['altura'] : 0,
                isset($item['largura']) ? $item['largura'] : 0,
                isset($item['diametro']) ? $item['diametro'] : 0
            );
        }

        $request = new Request([
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

        return $this->client->consultar($request);
    }
}
