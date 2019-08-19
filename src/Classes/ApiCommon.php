<?php

namespace Strappberry\FacturamaLaravel;

use Facturama\Client;

abstract class ApiCommon
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $api_prefix = '';

    /**
     * ApiCommon constructor.
     *
     * @param $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * @param  array|Cfdi  $cfdi
     * @return array|\stdClass|null
     */
    public function emitirCfdi($cfdi)
    {
        if (is_array($cfdi)) {
            $datos = $cfdi;
        } elseif (is_a($cfdi, Cfdi::class)) {
            $datos = $cfdi->obtenerDatos();
        } else {
            return [];
        }

        return $this->client->post($this->api_prefix.'/2/cfdis', $datos);
    }

    public function descargarCfdi($id, $tipo, $formato = 'pdf')
    {
        $this->client->get('/cfdi/'.$formato.'/'.$tipo.'/'.$id);
    }
}
