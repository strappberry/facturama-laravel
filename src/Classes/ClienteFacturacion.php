<?php

namespace Strappberry\FacturamaLaravel\Classes;

/**
 * Class ClienteFacturacion
 *
 * @property string Nombre
 * @property string RFC
 * @property string Email
 * @property array  Direccion
 * @method $this agregarNombre(string $nombre)
 * @method $this agregarRFC(string $rfc)
 * @method $this agregarEmail(string $email)
 *
 * @package Strappberry\FacturamaLaravel
 */
class ClienteFacturacion extends CommonClass
{
    protected $mapaRelacionMetodosCampos = [
        'Nombre' => 'Name',
        'RFC' => 'Rfc',
        'Email' => 'Email',
        'Direccion' => 'Address',
    ];

    public function __set($name, $value)
    {
        if ($name == 'Direccion') {
            self::agregarDireccion($value);
        } else {
            parent::__set($name, $value);
        }
    }

    /**
     * @param  array|DireccionCliente  $direccion
     * @return $this
     */
    public function agregarDireccion($direccion)
    {
        if (is_array($direccion)) {
            $this->datos['Address'] = $direccion;
        } elseif (is_a($direccion, DireccionCliente::class)) {
            $this->datos['Address'] = $direccion->obtenerDatos();
        }

        return $this;
    }
}
