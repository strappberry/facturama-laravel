<?php

namespace Strappberry\FacturamaLaravel\Classes;

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
     * Emitir factura
     * 
     * @doc https://github.com/Facturama/facturama-php-sdk/wiki/API-Web#cfdi-40
     * 
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

        return $this->client->post($this->api_prefix . '/3/cfdis', $datos);
    }

    /**
     * Descargar la factura en el formato especificado
     * 
     * @doc https://github.com/Facturama/facturama-php-sdk/wiki/API-Web#descargar-factura
     *
     * @param string $id Id de la factura
     * @param string $tipo Tipo de factura (payroll | received | issued)
     * @param string $formato Formato de la factura (pdf | xml | html)
     */
    public function descargarCfdi($id, $tipo = 'issued', $formato = 'pdf')
    {
        $this->client->get('/cfdi/' . $formato . '/' . $tipo . '/' . $id);
    }

    /**
     * Cancelar factura
     *
     * @doc https://github.com/Facturama/facturama-php-sdk/wiki/API-Web#cancelar-cfdi
     * 
     * @param string $id
     * @param array $params
     */
    public function cancelarCfdi($id, $params = [])
    {
        return $this->client->delete("Cfdi/{$id}", $params);
    }
}
