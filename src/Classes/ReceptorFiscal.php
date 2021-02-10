<?php

namespace Strappberry\FacturamaLaravel\Classes;

/**
 * Class ReceptorFiscal
 *
 * @property string ID
 * @property string RFC
 * @property string Nombre
 * @property string ClaveDeUso
 * @property string PaisDeResidencia
 * @property string RegistroFiscalExtranjero
 * @method $this agregarID(string $id)
 * @method $this agregarRFC(string $rfc)
 * @method $this agregarNombre(string $nombre)
 * @method $this agregarClaveDeUso(string $clave_de_uso)
 * @method $this agregarPaisDeResidencia(string $pais_de_residencia)
 * @method $this agregarRegistroFiscalExtranjero(string $registro_fiscal_extranjero)
 *
 * @package Strappberry\FacturamaLaravel
 */
class ReceptorFiscal extends CommonClass
{
    protected $mapaRelacionMetodosCampos = [
        'ID' => 'Id',
        'RFC' => 'Rfc',
        'Nombre' => 'Name',
        'ClaveDeUso' => 'CfdiUse',
        'PaisDeResidencia' => 'TaxResidence',
        'RegistroFiscalExtranjero' => 'TaxRegistrationNumber',
    ];
}
