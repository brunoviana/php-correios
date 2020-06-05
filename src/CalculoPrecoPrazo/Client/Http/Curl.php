<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo\Client\Http;

/**
 * Essa classe existe porque eu precisava testar o CurlAdapter
 * e não tinha como fazer mock das funções do curl e validar
 * se as chamadas estavam corretas.
 *
 * Pelo memso motivo eu estou ignorando essa classe no coverage
 * já que as funções PHP que os métodos executam não podem ser
 * mockados e passados no teste.
 *
 * @codeCoverageIgnore
 */
class Curl implements HttpRequestInterface
{
    private $handle = null;

    public function __construct()
    {
        $this->handle = curl_init();
    }

    public function setOption($name, $value)
    {
        curl_setopt($this->handle, $name, $value);
    }

    public function execute()
    {
        return curl_exec($this->handle);
    }

    public function getInfo($name = null)
    {
        if ($name) {
            return curl_getinfo($this->handle, $name);
        }

        return curl_getinfo($this->handle);
    }

    public function close()
    {
        curl_close($this->handle);
    }

    public function reset()
    {
        curl_reset($this->handle);
    }
}
