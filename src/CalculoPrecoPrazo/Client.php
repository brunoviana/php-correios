<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo;

use BrunoViana\Correios\CalculoPrecoPrazo\Client\Request;
use BrunoViana\Correios\CalculoPrecoPrazo\Interfaces\ClientInterface;
use BrunoViana\Correios\CalculoPrecoPrazo\Client\Adapters\CurlAdapter;
use BrunoViana\Correios\CalculoPrecoPrazo\Interfaces\Client\AdapterInterface;

class Client implements ClientInterface
{
    protected $clientAdapter;

    public static function novo()
    {
        return new self(CurlAdapter::novo());
    }

    public function __construct(AdapterInterface $clientAdapter)
    {
        $this->clientAdapter = $clientAdapter;
    }

    protected function montaParametros($request, $servico)
    {
        return [
            'nCdServico' => $servico,
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
            'StrRetorno' => 'XML',
        ];
    }

    public function consultar(Request $request) : ?array
    {
        $responses = array_map(function ($servico) use ($request) {
            $parametros = $this->montaParametros($request, $servico);

            return $this->clientAdapter->enviar($request->url(), $parametros);
        }, $request->servicos());

        return $responses;
    }
}
