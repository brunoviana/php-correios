<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo;

use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Item;
use BrunoViana\Correios\CalculoPrecoPrazo\Encomenda\Caixa;
use BrunoViana\Correios\CalculoPrecoPrazo\Interfaces\EncomendaInterface;

abstract class Encomenda implements EncomendaInterface
{
    const CAIXA = 1;

    const ROLO = 2;

    const ENVELOPE = 3;

    protected $itens = [];

    public static function nova($formato = 0)
    {
        if (!in_array($formato, self::formatosValidos())) {
            throw new \RuntimeException('Formato de encomenda passado não é válido: ' . $formato);
        }

        switch ($formato) {
            case self::CAIXA:
                return new Caixa();
        }
    }

    private static function formatosValidos()
    {
        return [
            self::CAIXA,
            self::ROLO,
            self::ENVELOPE
        ];
    }

    public function item(
        int $quantidade,
        float $peso,
        float $comprimento,
        float $altura,
        float $largura,
        float $diametro = 0
    ) : Item {
        $item = new Item(
            $quantidade,
            $peso,
            $comprimento,
            $altura,
            $largura,
            $diametro
        );
        
        $this->itens[] = $item;

        return $item;
    }

    public function itens() : array
    {
        return $this->itens;
    }

    abstract public function peso();
    
    abstract public function altura();
    
    abstract public function largura();
    
    abstract public function comprimento();
    
    abstract public function diametro();
}
