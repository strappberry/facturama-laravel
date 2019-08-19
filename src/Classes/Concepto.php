<?php


namespace Strappberry\FacturamaLaravel;

use Illuminate\Support\Str;

/**
 * Class Concepto
 *
 * @property string CodigoDeProducto
 * @property string NumeroDeIdentificacion
 * @property string Descripcion
 * @property string Unidad
 * @property string CodigoDeUnidad
 * @property string PrecioUnitario
 * @property string Cantidad
 * @property string Subtotal
 * @property string Descuento
 * @property string CuentaPredial
 * @property string NumerosDeProcedimiento
 * @property array  Impuestos
 * @property string Total
 * @method $this agregarCodigoDeProducto(string $codigo_de_producto)
 * @method $this agregarNumeroDeIdentificacion(string $numero_de_identificacion)
 * @method $this agregarDescripcion(string $descripcion)
 * @method $this agregarUnidad(string $unidad)
 * @method $this agregarCodigoDeUnidad(string $codigo_de_unidad)
 * @method $this agregarPrecioUnitario(string $precio_unitario)
 * @method $this agregarCantidad(string $cantidad)
 * @method $this agregarSubtotal(string $subtotal)
 * @method $this agregarDescuento(string $descuento)
 * @method $this agregarCuentaPredial(string $cuenta_predial)
 * @method $this agregarNumerosDeProcedimiento(string $numeros_de_procedimiento)
 * @method $this agregarTotal(string $total)
 *
 * @package Strappberry\FacturamaLaravel
 */
class Concepto extends CommonClass
{
    protected $mapaRelacionMetodosCampos = [
        'CodigoDeProducto' => 'ProductCode',
        'NumeroDeIdentificacion' => 'IdentificationNumber',
        'Descripcion' => 'Description',
        'Unidad' => 'Unit',
        'CodigoDeUnidad' => 'UnitCode',
        'PrecioUnitario' => 'UnitPrice',
        'Cantidad' => 'Quantity',
        'Subtotal' => 'Subtotal',
        'Descuento' => 'Descuento',
        'CuentaPredial' => 'CuentaPredial',
        'NumerosDeProcedimiento' => 'NumerosProcedimiento',
        'Impuestos' => 'Taxes',
        'Total' => 'Total',
    ];

    /**
     * @var bool
     */
    private $calcular_total_automaticamente = false;

    /**
     * @param  array[]|Impuesto[]  $impuestos
     * @return Concepto
     */
    public function agregarImpuestos($impuestos)
    {
        if (is_array($impuestos)) {
            $this->datos['Taxes'] = [];
            foreach ($impuestos as $impuesto) {
                self::agregarImpuesto($impuesto);
            }
        }

        return $this;
    }

    /**
     * @param  array|Impuesto  $impuesto
     * @return Concepto
     */
    public function agregarImpuesto($impuesto)
    {
        if (!isset($this->datos['Taxes'])) {
            $this->datos['Taxes'] = [];
        }
        if (is_array($impuesto)) {
            $this->datos['Taxes'][] = $impuesto;
        } elseif (is_a($impuesto, Impuesto::class)) {
            $this->datos['Taxes'][] = $impuesto->obtenerDatos();
        }

        return $this;
    }

    public function calcularTotalAutomaticamente($calcular_automaticamente = true)
    {
        $this->calcular_total_automaticamente = $calcular_automaticamente;

        return $this;
    }

    public function obtenerDatos()
    {
        if ($this->calcular_total_automaticamente && $this->Subtotal) {
            $total = floatval($this->Subtotal);
            if ($this->Impuestos) {
                $total_de_impuestos = 0;
                foreach ($this->Impuestos as $impuesto) {
                    if (!Str::contains($impuesto['Name'], 'RET') &&
                        (!isset($impuesto['IsRetention']) || $impuesto['IsRetention'] != true)) {
                        $total_de_impuestos += floatval($impuesto['Total']);
                    } else {
                        $total_de_impuestos -= floatval($impuesto['Total']);
                    }
                }
                $total = $total + $total_de_impuestos;
            }
            $this->Total = number_format($total, 2, '.', '');
        }

        return parent::obtenerDatos();
    }
}
