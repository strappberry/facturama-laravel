<?php

namespace Strappberry\FacturamaLaravel\Classes;

/**
 * Class EmisorFiscal
 *
 * @property string RegimenFiscal
 * @property string RFC
 * @property string Nombre
 * @method $this agregarRegimenFiscal(string $regimen_fiscal)
 * @method $this agregarRFC(string $rfc)
 * @method $this agregarNombre(string $nombre)
 *
 * @package Strappberry\FacturamaLaravel
 */
class EmisorFiscal extends CommonClass
{
    protected $mapaRelacionMetodosCampos = [
        'RegimenFiscal' => 'FiscalRegime',
        'RFC' => 'Rfc',
        'Nombre' => 'Name',
    ];
}
