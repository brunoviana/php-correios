<?php 

namespace BrunoViana\Correios\CalculoPrecoPrazo\Logger;

use Psr\Log\AbstractLogger;

class ImprimeNaTelaLogger extends AbstractLogger
{
    private $verbose = false;

    public function __construct($verbose = false)
    {
        $this->verbose = $verbose;
    }

    public function log($logLevel, $message, $context = [])
    {
        if($this->verbose){
            echo '<strong>'.$message.'</strong>';
            dump($context);
        }        
    }
}