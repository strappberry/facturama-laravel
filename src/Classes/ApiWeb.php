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
}
