<?php

namespace BrunoViana\Correios;

use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda;
use BrunoViana\Correios\CalculoPrecoPrazo\Services\CalculadorDimensaoLimiteSeparado;
use BrunoViana\Correios\CalculoPrecoPrazo\Services\CalculadorTudoJunto;
use BrunoViana\Correios\CalculoPrecoPrazo\Services\CalculadorTudoSeparado;
use BrunoViana\Correios\CalculoPrecoPrazo\Client;
use BrunoViana\Correios\CalculoPrecoPrazo\Logger\ImprimeNaTelaLogger;

class CalculoPrecoPrazo
{
    const CALCULADOR_TUDO_JUNTO = 0;

    const CALCULADOR_DIMENSAO_LIMITE_SEPARADO = 1;

    const CALCULADOR_TUDO_SEPARADO = 2;

    const CAIXA = Encomenda::CAIXA;

    const ROLO = Encomenda::ROLO;

    const ENVELOPE = Encomenda::ENVELOPE;

    public function calculador(
        $opcoes = [],
        int $tipoCalculador = self::CALCULADOR_DIMENSAO_LIMITE_SEPARADO
    )
    {
        $opcoesPadrao = [
            'limite_dimensao' => 70,
            'client' => null,
            'verbose' => false,
            'logger' => null
        ];

        $opt = array_merge($opcoesPadrao, $opcoes);

        if(!$opt['logger']){
            $opt['logger'] = new ImprimeNaTelaLogger($opt['verbose']);
        }

        if(!$opt['client']){
            $opt['client'] = Client::novo($opt['logger']);
        }

        switch($tipoCalculador){
            case self::CALCULADOR_TUDO_SEPARADO:
                return new CalculadorTudoSeparado($opt['client']);

            case self::CALCULADOR_TUDO_JUNTO:
                return new CalculadorTudoJunto($opt['client']);

            case self::CALCULADOR_DIMENSAO_LIMITE_SEPARADO:
                return new CalculadorDimensaoLimiteSeparado($opt['client'], $opt['limite_dimensao']);

            default:
                throw new \RuntimeException('Calculador inválido');
        }
    }
}
