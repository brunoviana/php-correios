<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Client\Adapters;

use Psr\Log\LoggerInterface;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Response;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Http\Curl;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Http\HttpRequestInterface;

class CurlAdapter implements AdapterInterface
{
    protected $http;

    protected $logger;

    public static function novo(LoggerInterface $logger)
    {
        return new self(new Curl(), $logger);
    }

    public function __construct(HttpRequestInterface $http, LoggerInterface $logger)
    {
        $this->http = $http;
        $this->logger = $logger;
    }

    public function enviar(string $url, array $parametros) : Response
    {
        $p = [];
        foreach ($parametros as $k => $v) {
            $p[] = "{$k}={$v}";
        }

        $params = implode('&', $p);

        $this->http->reset();

        $this->http->setOption(CURLOPT_URL, $url . '?' . $params);
        $this->http->setOption(CURLOPT_RETURNTRANSFER, 1);
        $this->http->setOption(CURLOPT_TIMEOUT, 30);

        $this->logger->debug('Enviando requisição aos Correios', $parametros);

        $response = $this->http->execute();

        $this->logger->debug(
            'Resposta dos Correios: ' . $response
        );

        if(!$response){
            return new Response(
                [],
                $this->http->getInfo(CURLINFO_HTTP_CODE)
            );
        }

        $responseTransformado = $this->transformaResponse($response);

        return new Response(
            $responseTransformado ? $responseTransformado['cServico'] : [],
            $this->http->getInfo(CURLINFO_HTTP_CODE)
        );
    }

    public function conexaoFalhou()
    {
        return $this->http->getInfo(CURLINFO_HTTP_CODE) != 200;
    }

    private function transformaResponse($response)
    {
        $xml = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
        $json = json_encode($xml);
        return json_decode($json, true);
    }

    public function __destruct()
    {
        $this->http->close();
    }
}
