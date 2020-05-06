<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Client;

use BrunoViana\Correios\CalculoPrecoPrazo\Client\Request;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Response;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Http\Curl;
use BrunoViana\Correios\CalculoPrecoPrazo\Interfaces\Client\HttpRequest;

class CurlAdapter
{
    private $http;

    public static function novo()
    {
        return new self(new Curl());
    }

    public function __construct(HttpRequest $http)
    {
        $this->http = $http;
    }
    
    protected function montaParametros($request)
    {
        $parametros = [
            'nCdEmpresa' => $request->usuario(),
            'sDsSenha' => $request->senha(),
            'sCepOrigem' => $request->origem(),
            'sCepDestino' => $request->destino(),
            'nVlPeso' => $request->peso(),
            'nCdFormato' => $request->formato(),
            'nVlComprimento' => $request->comprimento(),
            'nVlAltura' => $request->altura(),
            'nVlLargura' => $request->largura(),
            'nVlDiametro' => $request->diametro(),
            'sCdMaoPropria' => $request->maoPropria(),
            'nVlValorDeclarado' => $request->valorDeclarado(),
            'sCdAvisoRecebimento' => $request->avisoRecebimento(),
            'StrRetorno' => 'XML'
        ];

        $p = [];
        foreach ($parametros as $k => $v) {
            $p[] = "{$k}={$v}";
        }

        return implode('&', $p);
    }

    public function consultar(Request $request) : ?array
    {
        $responses = array_map(function ($servico) use ($request) {
            $queryString = $this->montaParametros($request).'&nCdServico='.$servico;
            
            $response = $this->enviar($request->url().'?'.$queryString);

            return new Response($response['cServico']);
        }, $request->servicos());

        $this->http->close();

        return $responses;
    }

    private function enviar($url)
    {
        $this->http->reset();

        $this->http->setOption(CURLOPT_URL, $url);
        $this->http->setOption(CURLOPT_RETURNTRANSFER, 1);
        $this->http->setOption(CURLOPT_TIMEOUT, 10);

        $response = $this->http->execute();
        
        return $this->transformaResponse($response);
    }

    private function transformaResponse($response)
    {
        $xml = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
        $json = json_encode($xml);
        return json_decode($json, true);
    }
}
