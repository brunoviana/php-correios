<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Exceptions;

use Exception;

class ParametroNaoInformadoException extends Exception
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        parent::__construct(
            sprintf('Parâmetro obrigatório não informado: "%s"', $message),
            $code,
            $previous
        );
    }
}
