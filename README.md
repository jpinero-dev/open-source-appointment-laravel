## Proyecto Laravel - Sistema de Turnos 

Este es un proyecto Laravel de código abierto y gratuito que incluye un sistema de turnos generales que puedes descargar e instalar en tu entorno de desarrollo local de forma totalmente libre y gratuita. A continuación, te guiaré a través de los pasos necesarios para configurar y ejecutar el proyecto.



### Vista previa del sistema de turnos

<img src="https://raw.githubusercontent.com/jpinero-dev/open-source-appointment-laravel/master/imagenes/turnos-1.gif" width="800" style="max-width:100%;" alt="Turno 1">
<img src="https://raw.githubusercontent.com/jpinero-dev/open-source-appointment-laravel/master/imagenes/turnos-2.png" width="800" style="max-width:100%;" alt="Turno 2">
<img src="https://raw.githubusercontent.com/jpinero-dev/open-source-appointment-laravel/master/imagenes/turnos-3.png" width="800" style="max-width:100%;" alt="Turno 3">


## Requisitos

Antes de comenzar, asegúrate de tener instalados los siguientes requisitos en tu entorno de desarrollo:

- PHP >= 8.1
- Composer (https://getcomposer.org/)
- Laravel CLI (https://laravel.com/docs/8.x/installation)

**Clonar el repositorio**:

Abre tu terminal y ejecuta el siguiente comando para clonar el repositorio desde GitHub:

```bash
git clone https://github.com/jpinero-dev/open-source-appointment-laravel.git
```

**Instalar dependencias**:

Navega hasta el directorio de tu proyecto y ejecuta el siguiente comando para instalar las dependencias de PHP con Composer:

```bash
composer install
```

**Configurar el archivo `.env`**:

Haz una copia del archivo `.env.example` y nómbrala como `.env`. Abre el archivo `.env` y completa la configuración de la base de datos con la información de tu entorno.

**Generar una clave de aplicación**:

Ejecuta el siguiente comando para generar una clave de aplicación:

```bash
php artisan key:generate
```

**Cache de Configuración**:

Para mejorar el rendimiento, genera una caché de configuración con el siguiente comando:
```bash
php artisan config:cache
```

**Ejecutar Migraciones**:

Ejecuta las migraciones para crear las tablas de la base de datos:

```bash
php artisan migrate
```
**Poblar la base de datos**:

Opcionalmente, puedes poblar la base de datos con datos de ejemplo ejecutando el siguiente comando:

```bash
php artisan db:seed
```
El usuario administrador predeterminado tiene las siguientes credenciales:

- **Email:** admin@argon.com
- **Contraseña:** secret
