<?php

namespace Strappberry\FacturamaLaravel\Classes;

/**
 * Class Impuesto
 *
 * @property string Nombre
 * @property string Total
 * @property string MontoBase
 * @property string Porcentaje
 * @property string EsRetencion
 * @property string EsCuota
 * @method $this agregarNombre(string $nombre)
 * @method $this agregarTotal(string $total)
 * @method $this agregarMontoBase(string $monto_base)
 * @method $this agregarPorcentaje(string $porcentaje)
 * @method $this agregarEsRetencion(string $es_retencion)
 * @method $this agregarEsCuota(string $es_cuota)
 *
 * @package Strappberry\FacturamaLaravel
 */
class Impuesto extends CommonClass
{
    protected $mapaRelacionMetodosCampos = [
        'Nombre' => 'Name',
        'Total' => 'Total',
        'MontoBase' => 'Base',
        'Porcentaje' => 'Rate',
        'EsRetencion' => 'IsRetention',
        'EsCuota' => 'IsQuota',
    ];

    public static function GenerarIVA($monto_base, $porcentaje_de_iva = 16)
    {
        $porcentaje = floatval($porcentaje_de_iva / 100);

        $iva = new Impuesto();
        $iva->agregarNombre('IVA');
        $iva->agregarMontoBase(number_format($monto_base,2,'.',''));
        $iva->agregarPorcentaje(number_format($porcentaje,6,'.',''));

        $total_de_iva = floatval($monto_base) * floatval($porcentaje);

        $iva->agregarTotal(number_format($total_de_iva, 2, '.', ''));

        return $iva;
    }

    public static function GenerarRetencionDeIVA($monto_base, $porcentaje_de_retencion_de_iva = 10.6666)
    {
        $porcentaje = floatval($porcentaje_de_retencion_de_iva / 100);

        $iva = new Impuesto();
        $iva->agregarNombre('IVA RET');
        $iva->agregarMontoBase(number_format($monto_base,2,'.',''));
        $iva->agregarPorcentaje(number_format($porcentaje,6,'.',''));

        $total_de_iva = floatval($monto_base) * floatval($porcentaje);

        $iva->agregarTotal(number_format($total_de_iva, 2, '.', ''));

        $iva->agregarEsRetencion('true');

        return $iva;
    }

    public static function GenerarRetencionISR($monto_base, $porcentaje_de_isr = 10)
    {
        $porcentaje = floatval($porcentaje_de_isr / 100);

        $iva = new Impuesto();
        $iva->agregarNombre('ISR');
        $iva->agregarMontoBase(number_format($monto_base,2,'.',''));
        $iva->agregarPorcentaje(number_format($porcentaje,6,'.',''));

        $total_de_iva = floatval($monto_base) * floatval($porcentaje);

        $iva->agregarEsRetencion('true');

        $iva->agregarTotal(number_format($total_de_iva, 2, '.', ''));

        return $iva;
    }
}
