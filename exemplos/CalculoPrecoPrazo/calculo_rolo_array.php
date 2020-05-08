<?php

require '../../vendor/autoload.php';

use BrunoViana\Correios\CalculoPrecoPrazo;

$calculador = CalculoPrecoPrazo::calculador([
    'servicos' => [
        '41106'
    ],
    'itens' => [
        [
            'quantidade' => 1,
            'peso' => 1,
            'comprimento' => 31,
            'altura' => 0,
            'largura' => 0,
            'diametro' => 15,
        ]
    ],
    'usuario' => '',
    'senha' => '',
    'origem' => '60842-130',
    'destino' => '22775-051',
    'formato' => CalculoPrecoPrazo::ROLO,
    'mao_propria' => false,
    'valor_declarado' => 0,
    'aviso_recebimento' => false,
]);

$responses = $calculador->calcular();

echo '<pre>';

// Retorna um array onde cada índice é o resultado de um serviço consultado
foreach ($responses as $response) {
    if (!$response->sucesso()) {
        echo "<p>Falha ao consultar os Correios. Status Code: " . $response->codigoHttp() . "</p>";
        continue;
    }

    // Você pode usar os métodos ou transformar tudo em array
    print_r((array) $response->emArray());
}
