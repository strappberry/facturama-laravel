<?php

namespace Strappberry\FacturamaLaravel\Classes;

use Facturama\Client;
use Facturama\Exception\RequestException;

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
     * @param  array|CertificadoSelloDigital  $certificado_sello_digital
     * @return array|\stdClass|null
     */
    public function actualizarCertificado($certificado_sello_digital)
    {
        if (is_array($certificado_sello_digital)) {
            $datos = $certificado_sello_digital;
            $rfc = $certificado_sello_digital['RFC'];
        } elseif (is_a($certificado_sello_digital, CertificadoSelloDigital::class)) {
            $datos = $certificado_sello_digital->obtenerDatos();
            $rfc = $certificado_sello_digital->RFC;
        } else {
            return [];
        }

        return $this->client->put($this->api_prefix.'/csds/'.$rfc, $datos);
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

    public function descargarFactura($id, $formato = 'pdf')
    {
        try {
            $respuesta = $this->client->get('cfdi/'.$formato.'/issuedLite/'.$id);
        } catch (RequestException $exception) {
            return null;
        }

        return $respuesta;
    }
}
