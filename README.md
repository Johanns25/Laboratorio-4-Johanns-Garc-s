# 🧪 Laboratorio #4 — Autocarga de Clases en PHP con Composer (PSR-4)

> Implementación de la autocarga automática de clases utilizando Composer y el estándar PSR-4, organizando el proyecto en namespaces y directorios estructurados.

---

## 📋 Descripción

En este laboratorio se implementó la **autocarga (autoloading) de clases PHP** mediante **Composer**, eliminando la necesidad de hacer `require` o `include` manualmente para cada archivo de clase.

Se crearon dos clases distribuidas en distintos namespaces y directorios: `App\User` y `Database\Model\ProductModel`. A través de la configuración PSR-4 en el archivo `composer.json`, Composer genera automáticamente el mapa de clases que permite resolverlas al momento de instanciarlas.

---

## 💡 Conceptos Aplicados

| Concepto | Descripción |
|---|---|
| 📦 **Composer** | Gestor de dependencias y generador del autoloader para PHP |
| 🗂️ **PSR-4** | Estándar de autocarga que mapea namespaces a directorios del proyecto |
| 🔖 **Namespaces** | Organización lógica de clases para evitar colisiones de nombres |
| ⚙️ **vendor/autoload.php** | Archivo generado por Composer que registra el autoloader automáticamente |

---

## 🗁 Estructura del Proyecto

```
AutocargaEjemplo/
├── composer.json
├── composer.lock
├── prueba.php
├── App/
│   └── User.php
├── Database/
│   └── Model/
│       └── ProductModel.php
└── vendor/
    └── autoload.php  (generado)
```

---

## 💻 Código Fuente

### `composer.json`
```json
{
    "autoload": {
        "psr-4": {
            "App\\": "App/",
            "Database\\": "Database/"
        }
    }
}
```

### `App/User.php`
```php
<?php
namespace App;

class User
{
    public function getName(): string
    {
        return "Dave";
    }
}
```

### `Database/Model/ProductModel.php`
```php
<?php
namespace Database\Model;

class ProductModel
{
    public function getId(): int
    {
        return 123;
    }
}
```

### `prueba.php`
```php
<?php

use App\User;
use Database\Model\ProductModel;

require 'vendor/autoload.php';

// Se instancian las clases sin require manual
$user = new User();
echo $user->getName();   // Dave
echo "\n";

$products = new ProductModel();
echo $products->getId(); // 123
```

---

## ▶️ Pasos para Ejecutar

1. **Instalar Composer** — Verifica con `composer --version`
2. **Generar el autoloader** — Ejecuta `composer dump-autoload` en la raíz del proyecto
3. **Correr el script** — Ejecuta `php prueba.php` en la terminal
4. **Verificar la salida** — Debe mostrar `Dave` y `123`

---

## 📤 Salida Esperada

```
$ php prueba.php
Dave
123
```

---

## 📸 Captura de Ejecución

![Captura de ejecución](prueba%20de%20ejecucion.png)

---

## 👤 Autor

**Johanns Garcés**  
Cédula: 8-1000-355
