# Facturama Laravel

## Configuración
Variables que puede ajustar en el archivo de entorno __.env__

| VARIABLE                      | Default                         | Descripción |
|-------------------------------|---------------------------------|-------------|
| FACTURAMA_SANDBOX             | true                            | Indica si se encuentra en entorno de desarrollo. Valores admitidos: true, false
| FACTURAMA_PRODUCTION_ENDPOINT | https://api.facturama.mx        | Url de la api de producción de facturama
| FACTURAMA_SANDBOX_ENDPOINT    | https://apisandbox.facturama.mx | Url de la api de pruebas de facturama
| FACTURAMA_USERNAME            | pruebas                         | Usuario de pruebas de facturama ver documentació del entorno de pruebas de facturana
| FACTURAMA_PASSWORD            | pruebas2011                     | Contraseña del usuario de pruebas de facturama

### Publicar archivo de configuración
```bash
php artisan vendor:publish --tag="facturama-laravel"
```

# Referencia api
[https://apisandbox.facturama.mx](https://apisandbox.facturama.mx/docs/api/POST-2-cfdis)

#Introducción

```php
// Instancia Laravel Facturama
$api = new \Strappberry\FacturamaLaravel\Classes\ApiFacturama();
// Obtener instancia de api web
$apiWeb = $api->web();
// Obtener instancia de api multiemisor
$apiMultiemisor = $api->multiemisor();
```

# Api Web

## Emitir factura 
```php
// Ejemplo tomado de la documenctación de la api de facturama
$datosAFacturar = [
  "Serie" => "R",
  "Currency" => "MXN",
  "ExpeditionPlace" => "78116",
  "PaymentConditions" => "CREDITO A SIETE DIAS",
  "Folio" => "100",
  "CfdiType" => "I",
  "PaymentForm" => "03",
  "PaymentMethod" => "PUE",
  "Receiver" => [
    "Rfc" => "XAXX010101000",
    "Name" => "Público en general",
    "CfdiUse" => "P01",
  ],
  "Items" => [
    [
      "ProductCode" => "10101504",
      "IdentificationNumber" => "EDL",
      "Description" => "Estudios de viabilidad",
      "Unit" => "NO APLICA",
      "UnitCode" => "MTS",
      "UnitPrice" => 50.0,
      "Quantity" => 2.0,
      "Subtotal" => 100.0,
      "Taxes" => [
        [
          "Total" => 16.0,
          "Name" => "IVA",
          "Base" => 100.0,
          "Rate" => 0.16,
          "IsRetention" => false,
        ],
      ],
      "Total" => 116.0,
    ],
    [
      "ProductCode" => "10101504",
      "IdentificationNumber" => "001",
      "Description" => "SERVICIO DE COLOCACION",
      "Unit" => "NO APLICA",
      "UnitCode" => "E49",
      "UnitPrice" => 100.0,
      "Quantity" => 15.0,
      "Subtotal" => 1500.0,
      "Discount" => 0.0,
      "Taxes" => [
        [
          "Total" => 240.0,
          "Name" => "IVA",
          "Base" => 1500.0,
          "Rate" => 0.16,
          "IsRetention" => false,
        ],
      ],
      "Total" => 1740.0,
    ],
  ],
];

// Solicitamos la generación de la factura y el timbrado
$resultado = $apiWeb->emitirCfdi($datosAFacturar)
```

# Api Multiemisor

## Subir archivos CSD

```php
use Strappberry\FacturamaLaravel\Classes\CertificadoSelloDigital;

// Crear objeto con los datos del Certificado de Sello Digital
$csd = new CertificadoSelloDigital();
$csd->agregarRFC('RFC del CSD');
$csd->agregarCertificado(
    base64_encode(file_get_contents("/ruta/a/archivo.key"))
);
$csd->agregarLlavePrivada(
    base64_encode(file_get_contents("/ruta/a/archivo.key"))
);
$csd->agregarPasswordDeLlavePrivada('contraseña del csd');

$apiMultiemisor->agregarNuevoCertificado($csd);
```

## Actualizar archivos CSD

```php
use Strappberry\FacturamaLaravel\Classes\CertificadoSelloDigital;

// Crear objeto con los datos del Certificado de Sello Digital
$csd = new CertificadoSelloDigital();
$csd->agregarRFC('RFC del CSD');
$csd->agregarCertificado(
    base64_encode(file_get_contents("/ruta/a/archivo.key"))
);
$csd->agregarLlavePrivada(
    base64_encode(file_get_contents("/ruta/a/archivo.key"))
);
$csd->agregarPasswordDeLlavePrivada('contraseña del csd');

$apiMultiemisor->actualizarCertificado($csd);
```

# Emitir factura

```php
// Ejemplo tomado de la documenctación de la api de facturama
// Es importante agregar la clave Issuer
$datosAFacturar = [
  "Serie" => "R",
  "Currency" => "MXN",
  "ExpeditionPlace" => "78116",
  "PaymentConditions" => "CREDITO A SIETE DIAS",
  "Folio" => "100",
  "CfdiType" => "I",
  "PaymentForm" => "03",
  "PaymentMethod" => "PUE",
  "Issuer"=> [
        "FiscalRegime"=> "601",
        "Rfc"=> "RFC con el que desea timbrar",
        "Name"=> "Nombre del emisor"
  ],
  "Receiver" => [
    "Rfc" => "XAXX010101000",
    "Name" => "Público en general",
    "CfdiUse" => "P01",
  ],
  "Items" => [
    [
      "ProductCode" => "10101504",
      "IdentificationNumber" => "EDL",
      "Description" => "Estudios de viabilidad",
      "Unit" => "NO APLICA",
      "UnitCode" => "MTS",
      "UnitPrice" => 50.0,
      "Quantity" => 2.0,
      "Subtotal" => 100.0,
      "Taxes" => [
        [
          "Total" => 16.0,
          "Name" => "IVA",
          "Base" => 100.0,
          "Rate" => 0.16,
          "IsRetention" => false,
        ],
      ],
      "Total" => 116.0,
    ],
    [
      "ProductCode" => "10101504",
      "IdentificationNumber" => "001",
      "Description" => "SERVICIO DE COLOCACION",
      "Unit" => "NO APLICA",
      "UnitCode" => "E49",
      "UnitPrice" => 100.0,
      "Quantity" => 15.0,
      "Subtotal" => 1500.0,
      "Discount" => 0.0,
      "Taxes" => [
        [
          "Total" => 240.0,
          "Name" => "IVA",
          "Base" => 1500.0,
          "Rate" => 0.16,
          "IsRetention" => false,
        ],
      ],
      "Total" => 1740.0,
    ],
  ],
];

// Solicitamos la generación de la factura y el timbrado
$resultado = $apiMultiemisor->emitirCfdi($datosAFacturar)
```

## Consultar datos de una factura

```php
//Multiemisor
$api->multiemisor()->consultarCfdi($id, $tipo);
```

## Consultar acuse cancelación

```php
$id = '9DLXTRINxFpHGLGEDWu23g2';
$tipo='issuedLite';
$formato = 'pdf';

$api->web()->acuse($formato, $tipo, $id);
```

## Consultar vigencia cfdi

```php
  $api->web()->consultarEstadoCfdi(
    'cac0cb22-8406-4812-898a-6f6aec7c85b2',
    'EKU9003173C9',
    'CACX7605101P8',
    '1160.00'
  );
```

# Credits
Desarrollador por [Strappberry](https://strappberry.com/)
