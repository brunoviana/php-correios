<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Client;

use BrunoViana\Correios\CalculoPrecoPrazo\Exceptions\ParametroNaoInformadoException;
use BrunoViana\Correios\CalculoPrecoPrazo\Exceptions\ParametroInvalidoException;

class ValidaRequest
{
    private $camposObrigatorios = [
        'servicos',
        'origem',
        'destino',
        'formato',
        'peso',
        'comprimento',
        'altura',
        'largura',
        'diametro',
    ];

    public function validar($dados)
    {
        foreach ($this->camposObrigatorios as $campo) {
            if (!isset($dados[$campo]) || (empty($dados[$campo]) && $dados[$campo] !== 0)) {
                throw new ParametroNaoInformadoException($campo);
            }
        }

        foreach (['mao_propria', 'aviso_recebimento'] as $campo) {
            if (isset($dados[$campo])) {
                if (is_bool($dados[$campo])) {
                    continue;
                }

                if (is_int($dados[$campo]) && in_array($dados[$campo], [0, 1])) {
                    continue;
                }

                if (in_array($dados[$campo], ['S', 'N'])) {
                    continue;
                }

                throw new ParametroInvalidoException([
                    $campo,
                    $dados[$campo]
                ]);
            }
        }
    }
}
