<?php

namespace Strappberry\FacturamaLaravel;

/**
 * Class Cfdi
 *
 * @property string IdNombre
 * @property string Fecha
 * @property string Serie
 * @property string NumeroDeCuenta
 * @property string TipoDeCambio
 * @property string Moneda
 * @property string LugarDeExpedicion
 * @property string CondicionesDePago
 * @property string Folio
 * @property string TipoCfdi
 * @property string FormaDePago
 * @property string MetodoDePago
 * @property array Emisor
 * @property array Receptor
 * @property array Conceptos
 * @method $this agregarIdNombre(string $id_nombre)
 * @method $this agregarFecha(string $fecha)
 * @method $this agregarSerie(string $serie)
 * @method $this agregarNumeroDeCuenta(string $numero_de_cuenta)
 * @method $this agregarTipoDeCambio(string $tipo_de_cambio)
 * @method $this agregarMoneda(string $moneda)
 * @method $this agregarLugarDeExpedicion(string $lugar_de_expedicion)
 * @method $this agregarCondicionesDePago(string $condiciones_de_pago)
 * @method $this agregarFolio(string $folio)
 * @method $this agregarTipoCfdi(string $tipo_cfdi)
 * @method $this agregarFormaDePago(string $forma_de_pago)
 * @method $this agregarMetodoDePago(string $metodo_de_pago)
 *
 * @package Strappberry\FacturamaLaravel
 */
class Cfdi extends CommonClass
{
    protected $mapaRelacionMetodosCampos = [
        'IdNombre'=> 'NameId',
        'Fecha' => 'Date',
        'Serie' => 'Serie',
        'NumeroDeCuenta' => 'PaymentAccountNumber',
        'TipoDeCambio' => 'CurrencyExchangeRate',
        'Moneda' => 'Currency',
        'LugarDeExpedicion' => 'ExpeditionPlace',
        'CondicionesDePago' => 'PaymentConditions',
        'Folio' => 'Folio',
        'TipoCfdi' => 'CfdiType',
        'FormaDePago' => 'PaymentForm',
        'MetodoDePago' => 'PaymentMethod',
        'Emisor' => 'Issuer',
        'Receptor' => 'Receiver',
        'Conceptos' => 'Items',
    ];

    public function __set($name, $value)
    {
        if ($name == 'Emisor') {
            self::agregarEmisor($value);
        } elseif ($name == 'Conceptos') {
            self::agregarConceptos($value);
        } else {
            parent::__set($name, $value);
        }
    }


    /**
     * @param  array|EmisorFiscal  $emisor
     * @return Cfdi
     */
    public function agregarEmisor($emisor)
    {
        if (is_array($emisor)) {
            $this->datos['Issuer'] = $emisor;
        } elseif (is_a($emisor, EmisorFiscal::class)) {
            $this->datos['Issuer'] = $emisor->obtenerDatos();
        }

        return $this;
    }

    /**
     * @param  array|ReceptorFiscal  $receptor
     * @return Cfdi
     */
    public function agregarReceptor($receptor)
    {
        if (is_array($receptor)) {
            $this->datos['Receiver'] = $receptor;
        } elseif (is_a($receptor, ReceptorFiscal::class)) {
            $this->datos['Receiver'] = $receptor->obtenerDatos();
        }

        return $this;
    }

    /**
     * @param  array[]|Concepto[]  $conceptos
     * @return Cfdi
     */
    public function agregarConceptos($conceptos)
    {
        if (is_array($conceptos)) {
            $this->datos['Items'] = [];
            foreach ($conceptos as $concepto) {
                self::agregarConcepto($concepto);
            }
        }

        return $this;
    }

    /**
     * @param  array|Concepto  $concepto
     * @return Cfdi
     */
    public function agregarConcepto($concepto)
    {
        if (!isset($this->datos['Items'])) {
            $this->datos['Items'] = [];
        }
        if (is_array($concepto)) {
            $this->datos['Items'][] = $concepto;
        } elseif (is_a($concepto, Concepto::class)) {
            $this->datos['Items'][] = $concepto->obtenerDatos();
        }

        return $this;
    }
}
