<?php

namespace Strappberry\FacturamaLaravel;

use Illuminate\Support\Str;

abstract class CommonClass
{
    /**
     * @var array
     */
    protected $mapaRelacionMetodosCampos = [];

    /**
     * @var array
     */
    protected $datos;

    public function __construct(array $datos = [])
    {
        $this->datos = $datos;
    }

    public function __call($name, $arguments)
    {
        if (Str::startsWith($name, 'agregar')) {
            $nombre_de_dato = str_replace('agregar', '', $name);
            if (count($arguments) && key_exists($nombre_de_dato, $this->mapaRelacionMetodosCampos)) {
                self::agregarDato($this->mapaRelacionMetodosCampos[$nombre_de_dato], $arguments[0]);
            }

            return $this;
        }

        return null;
    }

    public function __get($name)
    {
        if (key_exists($name, $this->mapaRelacionMetodosCampos)) {
            $nombre_de_dato = $this->mapaRelacionMetodosCampos[$name];
            if (isset($this->datos[$nombre_de_dato])) {
                return $this->datos[$nombre_de_dato];
            }
        }

        return null;
    }

    public function __set($name, $value)
    {
        if (key_exists($name, $this->mapaRelacionMetodosCampos)) {
            self::agregarDato($this->mapaRelacionMetodosCampos[$name], $value);
        }
    }

    protected function agregarDato($nombre, $valor)
    {
        $this->datos[$nombre] = $valor;
    }

    /**
     * @return array
     */
    public function obtenerDatos()
    {
        return $this->datos;
    }
}
