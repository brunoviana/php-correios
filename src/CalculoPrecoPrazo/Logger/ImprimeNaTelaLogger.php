<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Logger;

use Psr\Log\AbstractLogger;

/**
 * Estou ignorando essa classe pela dificuldade que vai ser
 * testar a saida do dump formatado pelo Symfony.
 *
 * De qualquer forma esta classe não tem importancia para
 * a regra de negócios principal, ela serve apenas para debug
 * nos exemplos.
 *
 * @codeCoverageIgnore
 */
class ImprimeNaTelaLogger extends AbstractLogger
{
    private $verbose = false;

    public function __construct($verbose = false)
    {
        $this->verbose = $verbose;
    }

    public function log($logLevel, $message, $context = [])
    {
        if ($this->verbose) {
            echo '<strong>' . $message . '</strong>';
            dump($context);
        }
    }
}
