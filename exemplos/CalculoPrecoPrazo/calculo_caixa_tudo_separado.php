<?php

require '../../vendor/autoload.php';

use BrunoViana\Correios\CalculoPrecoPrazo;
use BrunoViana\Correios\CalculoPrecoPrazo\Servico;

$calculador = (new CalculoPrecoPrazo())->calculador(
    [
        'verbose' => true
    ],
    CalculoPrecoPrazo::CALCULADOR_TUDO_SEPARADO
);

$calculador->servicos([
    Servico::PAC_41106,
])
->item(1, 0.71, 31, 27, 31, 0)
->item(1, 0.71, 31, 27, 31, 0)
->item(1, 0.71, 90, 10, 30, 0)
->usuario('')
->senha('')
->origem('60842-130')
->destino('22775-051')
->formato(CalculoPrecoPrazo::CAIXA)
->maoPropria('N')
->valorDeclarado(0)
->avisoRecebimento('N');

$responses = $calculador->calcular();

echo '<strong>Resposta final do PHP Correios</strong>';

// Retorna um array onde cada índice é o resultado de um serviço consultado
foreach ($responses as $response) {
    if (! $response->sucesso()) {
        echo '<p>Falha ao consultar os Correios. Status Code: ' . $response->codigoHttp() . '</p>';
        continue;
    }

    // Você pode usar os métodos ou transformar tudo em array
    dump((array) $response->emArray());
}
