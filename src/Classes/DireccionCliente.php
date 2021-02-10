<?php

namespace Strappberry\FacturamaLaravel\Classes;

/**
 * Class DireccionCliente
 *
 * @property string Calle
 * @property string NumeroExterior
 * @property string NumeroInterior
 * @property string Colonia
 * @property string CodigoPostal
 * @property string Localidad
 * @property string Municipio
 * @property string Estado
 * @property string Pais
 * @method $this agregarCalle(string $calle)
 * @method $this agregarNumeroExterior(string $numero_exterior)
 * @method $this agregarNumeroInterior(string $numero_interior)
 * @method $this agregarColonia(string $colonia)
 * @method $this agregarCodigoPostal(string $codigo_postal)
 * @method $this agregarLocalidad(string $localidad)
 * @method $this agregarMunicipio(string $municipio)
 * @method $this agregarEstado(string $estado)
 * @method $this agregarPais(string $pais)
 *
 * @package Strappberry\FacturamaLaravel
 */
class DireccionCliente extends CommonClass
{
    protected $mapaRelacionMetodosCampos = [
        'Calle' => 'Street',
        'NumeroExterior' => 'ExteriorNumber',
        'NumeroInterior' => 'InteriorNumber',
        'Colonia' => 'Neighborhood',
        'CodigoPostal' => 'ZipCode',
        'Localidad' => 'Locality',
        'Municipio' => 'Municipality',
        'Estado' => 'State',
        'Pais' => 'Country',
    ];
}
