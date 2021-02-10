<?php

namespace Strappberry\FacturamaLaravel\Classes;

use Facturama\Client;

class CatalogosFacturama
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * ApiCommon constructor.
     *
     * @param $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function obtenerCatalogoDeNombresDeCfdi()
    {
        return $this->client->get('catalogs/NameIds');
    }

    public function obtenerCatalogoProductosYServicios(string $filtro)
    {
        return $this->client->get('catalogs/ProductsOrServices', ['keyword' => $filtro]);
    }

    public function obtenerCatalogoFormasDePago()
    {
        return $this->client->get('catalogs/PaymentForms');
    }

    public function obtenerCatalogoMetodosDePago()
    {
        return $this->client->get('catalogs/PaymentMethods');
    }

    public function obtenerCatalogoMonedas()
    {
        return $this->client->get('catalogs/currencies');
    }

    public function obtenerCatalogoCodigosPostales(string $filtro)
    {
        return $this->client->get('catalogs/PostalCodes', ['keyword' => $filtro]);
    }

    public function obtenerCatalogoUsosCfdi()
    {
        return $this->client->get('catalogs/CfdiUses');
    }

    public function obtenerCatalogoRegimenesFiscales()
    {
        return $this->client->get('catalogs/FiscalRegimens');
    }
}
