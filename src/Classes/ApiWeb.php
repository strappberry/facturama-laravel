<?php

namespace Strappberry\FacturamaLaravel\Classes;

class ApiWeb extends ApiCommon
{
    /**
     * @param  array|ClienteFacturacion  $cliente_facturacion
     * @return array|\stdClass|null
     */
    public function crearNuevoCliente($cliente_facturacion)
    {
        if (is_array($cliente_facturacion)) {
            $datos = $cliente_facturacion;
        } elseif (is_a($cliente_facturacion, ClienteFacturacion::class)) {
            $datos = $cliente_facturacion->obtenerDatos();
        } else {
            return [];
        }

        return $this->client->post('Client', $datos);
    }

    /**
     * @return array|\stdClass|null
     */
    public function listarClientes()
    {
        return $this->client->get('Client');
    }

    /**
     * Consultar la suscripcion de la cuenta
     *
     * @return array|\stdClass|null
     */
    public function suscripcion()
    {
        return $this->client->get('SuscriptionPlan');
    }

    /**
     * Consultar los datos de una factura
     *
     * @doc https://apisandbox.facturama.mx/docs/api/GET-Cfdi-id_type 
     *
     * @param string $id
     * @param string $tipo API Web: ( payroll | received | issued ) y para API Multiemisor: ( issuedLite )
     * @return void
     */
    public function consultarCfdi($id, $tipo = 'issued')
    {
        return $this->client->get("cfdi/{$tipo}/{$id}");
    }

    /**
     * Obtener acuse
     *
     * @param string $formato Formato del archivo a obtener: ( pdf | html )
     * @param string $tipo Tipo de comprbante a obtener, puede ser: para facturas de API normal( payroll | issued ) y para API Multiemisor ( issuedLite )
     * @param string $id Identificador unico de la factura
     * @return void
     */
    public function acuse($formato, $tipo, $id)
    {
        return $this->client->get("acuse/{$formato}/{$tipo}/{$id}");
    }

    /**
     * Consultar el estado de vigencia de un cfdi
     *
     * @doc https://apisandbox.facturama.mx/guias/validaciones/cfdi-status
     *
     * @param string $uuid
     * @param string $rfcEmisor
     * @param string $rfcReceptor
     * @param string $total Total con decimales a 2 digitos
     * @return array|\stdClass|null
     */
    public function consultarEstadoCfdi($uuid, $rfcEmisor, $rfcReceptor, $total)
    {
        return $this->client->get('cfdi/status', [
            'uuid' => $uuid,
            'issuerRfc' => $rfcEmisor,
            'receiverRfc' => $rfcReceptor,
            'total' => $total,
        ]);
    }
}
