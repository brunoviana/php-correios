<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo;

use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Rolo;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Envelope;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\EncomendaInterface;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Caixa\CalculoUnicoItem;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Caixa\CalculoRaizCubica;

abstract class Encomenda
{
    const CAIXA = 1;

    const ROLO = 2;

    const ENVELOPE = 3;

    const PESO_MINIMO = 0.3;

    protected $itens = [];

    protected $pesoTotal = 0;

    public static function nova($formato = 0, $unicoItem = false) : EncomendaInterface
    {
        if (! in_array($formato, self::formatosValidos())) {
            throw new \RuntimeException('Formato de encomenda passado não é válido: ' . $formato);
        }

        switch ($formato) {
            case self::CAIXA:
                return $unicoItem ? new CalculoUnicoItem() : new CalculoRaizCubica();

            case self::ROLO:
                return new Rolo();

            case self::ENVELOPE:
                return new Envelope();
        }
    }

    private static function formatosValidos()
    {
        return [
            self::CAIXA,
            self::ROLO,
            self::ENVELOPE,
        ];
    }
}
