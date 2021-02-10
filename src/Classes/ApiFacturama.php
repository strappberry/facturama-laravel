<?php

namespace Strappberry\FacturamaLaravel\Classes;

use Facturama\Client;
use Facturama\Exception\RequestException;
use GuzzleHttp\ClientInterface;

class ApiFacturama
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(
        $username = null,
        $password = null,
        array $requestOptions = [],
        ClientInterface $httpClient = null
    ) {
        if ($username == null) {
            $username = config('facturama-laravel.user.username');
        }
        if ($password == null) {
            $password = config('facturama-laravel.user.password');
        }
        $this->client = new Client($username, $password, $requestOptions, $httpClient);
        if (config('facturama-laravel.sandbox')) {
            $this->client->setApiUrl(config('facturama-laravel.api_endpoints.sandbox'));
        } else {
            $this->client->setApiUrl(config('facturama-laravel.api_endpoints.production'));
        }
    }

    public function web()
    {
        return new ApiWeb($this->client);
    }

    public function multiemisor()
    {
        return new ApiMultiemisor($this->client);
    }

    public function catalogos()
    {
        return new CatalogosFacturama($this->client);
    }

    /**
     * @param $rfc
     * @throws RequestException
     * @return array|\stdClass|null
     */
    public function informacionDeRFC($rfc)
    {
        return $this->client->get('client/status', [
            'rfc' => $rfc,
        ]);
    }

    /**
     * Regresa si un RFC en válido según la válidación de Facturama
     *
     * @param $rfc
     * @return bool
     */
    public function validarRFC($rfc) {
        try {
            $informacion_rfc = $this->informacionDeRFC($rfc);
            return !$informacion_rfc->Cancelado;
        } catch (RequestException $e) {
            return false;
        }
    }
}
