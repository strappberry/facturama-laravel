<?php

namespace Strappberry\FacturamaLaravel;

/**
 * Class CertificadoSelloDigital
 *
 * @property string RFC
 * @property string Certificado
 * @property string LlavePrivada
 * @property string PasswordDeLlavePrivada
 * @method $this agregarRFC(string $rfc)
 * @method $this agregarCertificado(string $certificado)
 * @method $this agregarLlavePrivada(string $llave_privada)
 * @method $this agregarPasswordDeLlavePrivada(string $password_de_llave_privada)
 *
 * @package Strappberry\FacturamaLaravel
 */
class CertificadoSelloDigital extends CommonClass
{
    protected $mapaRelacionMetodosCampos = [
        'RFC' => 'Rfc',
        'Certificado' => 'Certificate',
        'LlavePrivada' => 'PrivateKey',
        'PasswordDeLlavePrivada' => 'PrivateKeyPassword',
    ];
}
