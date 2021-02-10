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
```
php artisan vendor:publish --tag="facturama-laravel"
```

# Referencia api
[https://apisandbox.facturama.mx](https://apisandbox.facturama.mx/docs/api/POST-2-cfdis)

#Introducción

```
// Instancia Laravel Facturama
$api = new \Strappberry\FacturamaLaravel\Classes\ApiFacturama();
// Obtener instancia de api web
$apiWeb = $api->web();
// Obtener instancia de api multiemisor
$apiMultiemisor = $api->multiemisor();
```

## Emitir factura 
```
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

# Credits
Desarrollador por [Strappberry](https://strappberry.com/)