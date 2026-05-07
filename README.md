# 📦 Autocarga Automática


<div align="center">
  <img src="https://i.ibb.co/zVPsM1TB/composer-blog-irontec.webp" alt="FISC" width="200"/>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <img src="https://i.ibb.co/vC9JLg9t/meta-image.png" alt="UTP" width="200"/>
</div>

<br>

## 📝 Descripción
En este pequeño proyecto ejemplo, utilizamos la funcion de carga automatica, utilizando el estandar **PSR-4** manejando clases en **PHP** utilizando **Composer**, evitando los usos del *require* y funcionando de forma manual, mejorando la organizacion del codigo.

---

## ⚙️ Guía de Instalación utilizando el archivo github

1. Clonar el repositorio:
```bash
git clone https://github.com/tu-usuario/tu-repositorio.git
cd tu-repositorio
```
2. Instalacion del composer
```
composer install
```
3. Ejecucion del ejemplo
```
php prueba.php
```

## 🗨️ La estructura del proyecto deberia quedar de la siguiente manera:
/App
  └── User.php                → namespace App

/Database/Model
  └── ProductModel.php       → namespace Database\Model

/vendor                       → generado por Composer (NO se sube)
/composer.json
/prueba.php
/README.md

## 🧩 Relación Namespace - Carpetas
Las carpetas estan relacionadas de esta manera
| Carpeta         | Namespace       |
| --------------- | --------------- |
| App/            | App\            |
| Database/Model/ | Database\Model\ |

## 🚀 Codigo de prueba
En este codigo instanciamos ambas clases y imprimimos los datos que se retornan por medio de los metodos en cada una de estas.
```
<?php

use App\User;
use Database\Model\ProductModel;

require 'vendor/autoload.php';

$user = new User();

echo $user->getName();
echo "\n";
$products = new ProductModel();

echo $products->getId();
?>
```
## Documentación utilizada

- [Video sobre Autoload - Carga Automática.](https://www.youtube.com/watch?v=Al8WVUQMA6Y)
###

## ✅Resultados finales

#### Carpetas
![Resultados](https://i.ibb.co/kgwVPXPb/Estructura.png)
#### Instalacion del composer
![Resultados](https://i.ibb.co/Qj7jDKMK/composerinstall.png)
#### Prueba final
![Resultados](https://i.ibb.co/bMwRRHRs/prueba.png)

## 👤Información del Estudiante

<div align="center">
  <img src="https://i.ibb.co/hRsj2N6J/91-logo-5-fisc-oficial-rgb.png" alt="FISC" width="200"/>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <img src="https://i.ibb.co/sJvM549s/6-logo-utp-rgb-oficial.png" alt="UTP" width="200"/>
    &nbsp;&nbsp;&nbsp;&nbsp;
</div>

<br>

Este laboratorio ha sido desarrollado por el estudiante **Solín Antonio Rodrigúez** de la Universidad Tecnológica de Panamá:

- **Nombre:** Solín Antonio Rodrigúez
- **Correo:** solin.rodriguez@utp.ac.pa  
- **Curso:** Desarrollo de software VII (Licenciatura en desarrollo y gestión de software)
- **Instructor:** Ing. Irina Fong  

## Fecha de Ejecución del Laboratorio

- **Fecha:** 5 de mayo del 2026
