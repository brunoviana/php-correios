<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Client\Adapters;

use BrunoViana\Correios\CalculoPrecoPrazo\Client\Response;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Http\Curl;
use BrunoViana\Correios\CalculoPrecoPrazo\Interfaces\Client\HttpRequestInterface;
use BrunoViana\Correios\CalculoPrecoPrazo\Interfaces\Client\AdapterInterface;

class CurlAdapter implements AdapterInterface
{
    private $http;

    public static function novo()
    {
        return new self(new Curl());
    }

    public function __construct(HttpRequestInterface $http)
    {
        $this->http = $http;
    }

    public function enviar(string $url, array $parametros) : Response
    {
        $p = [];
        foreach ($parametros as $k => $v) {
            $p[] = "{$k}={$v}";
        }

        $params = implode('&', $p);

        $this->http->reset();

        $this->http->setOption(CURLOPT_URL, $url.'?'.$params);
        $this->http->setOption(CURLOPT_RETURNTRANSFER, 1);
        $this->http->setOption(CURLOPT_TIMEOUT, 10);

        $response = $this->http->execute();

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
