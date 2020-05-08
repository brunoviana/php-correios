<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Exceptions;

use Exception;

class ParametroInvalidoException extends Exception
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        if (is_array($message)) {
            $message = sprintf(
                'Parâmetro passado não é válido: "%s" (o valor "%s" foi informado)',
                $message[0],
                $message[1]
            );
        } else {
            $message = sprintf('Parâmetro passado não é válido: "%s"', $message);
        }

        parent::__construct($message, $code, $previous);
    }
}
