<?php

require '../../vendor/autoload.php';

use BrunoViana\Correios\CalculoPrecoPrazo;
use BrunoViana\Correios\CalculoPrecoPrazo\Servico;

$calculador = CalculoPrecoPrazo::calculador();
$calculador->servicos([
    Servico::PAC_41106,
])
->itens([
    [
        'quantidade' => 1,
        'peso' => 1,
        'comprimento' => 31,
        'diametro' => 15,
    ],
])
->usuario('')
->senha('')
->origem('60842-130')
->destino('22775-051')
->formato(CalculoPrecoPrazo::ROLO)
->maoPropria('N')
->valorDeclarado(0)
->avisoRecebimento('N');

$responses = $calculador->calcular();

echo '<pre>';

// Retorna um array onde cada índice é o resultado de um serviço consultado
foreach ($responses as $response) {
    if (! $response->sucesso()) {
        echo '<p>Falha ao consultar os Correios. Status Code: ' . $response->codigoHttp() . '</p>';
        continue;
    }

    // Você pode usar os métodos ou transformar tudo em array
    print_r((array) $response->emArray());
}
