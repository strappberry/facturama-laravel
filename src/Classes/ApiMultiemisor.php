<?php

namespace Strappberry\FacturamaLaravel;

use Facturama\Client;

class ApiMultiemisor extends ApiCommon
{
    /**
     * Multiemisor constructor.
     *
     * @param  Client  $client
     */
    public function __construct($client)
    {
        parent::__construct($client);
        $this->api_prefix = 'api-lite';
    }

    /**
     * @param  array|CertificadoSelloDigital  $certificado_sello_digital
     * @return array|\stdClass|null
     */
    public function agregarNuevoCertificado($certificado_sello_digital)
    {
        if (is_array($certificado_sello_digital)) {
            $datos = $certificado_sello_digital;
        } elseif (is_a($certificado_sello_digital, CertificadoSelloDigital::class)) {
            $datos = $certificado_sello_digital->obtenerDatos();
        } else {
            return [];
        }

        return $this->client->post($this->api_prefix.'/csds', $datos);
    }

    /**
     * @return array|\stdClass|null
     */
    public function listarCertificados()
    {
        return $this->client->get($this->api_prefix.'/csds');
    }

    /**
     * @param $rfc
     * @return array|\stdClass|null
     */
    public function obtenerCertificado($rfc)
    {
        return $this->client->get($this->api_prefix.'/csds/'.$rfc);
    }

    public function listarCfdis()
    {
        return $this->client->get($this->api_prefix.'/cfdis');
    }
}
