# Proyecto Laravel

Este es un proyecto Laravel que puedes descargar e instalar fácilmente en tu entorno de desarrollo local. A continuación, te guiaré a través de los pasos necesarios para configurar y ejecutar el proyecto.

## Requisitos

Antes de comenzar, asegúrate de tener instalados los siguientes requisitos en tu entorno de desarrollo:

- PHP >= 8.1
- Composer (https://getcomposer.org/)
- Laravel CLI (https://laravel.com/docs/8.x/installation)

## Pasos para la instalación

**Clonar el repositorio**:

Abre tu terminal y ejecuta el siguiente comando para clonar el repositorio desde GitHub:

git clone https://github.com/jpinero-dev/open-source-appointment-laravel.git

**Instalar dependencias**:

Navega hasta el directorio de tu proyecto y ejecuta el siguiente comando para instalar las dependencias de PHP con Composer:

composer install

**Configurar el archivo `.env`**:

Haz una copia del archivo `.env.example` y nómbrala como `.env`. Abre el archivo `.env` y completa la configuración de la base de datos con la información de tu entorno.

**Generar una clave de aplicación**:

Ejecuta el siguiente comando para generar una clave de aplicación:

php artisan key:generate

**Cache de Configuración**:

Para mejorar el rendimiento, genera una caché de configuración con el siguiente comando:

php artisan config:cache

**Ejecutar Migraciones**:

Ejecuta las migraciones para crear las tablas de la base de datos:

php artisan migrate

**Poblar la base de datos**:

Opcionalmente, puedes poblar la base de datos con datos de ejemplo ejecutando el siguiente comando:

php artisan db:seed

El usuario administrador predeterminado será:

'email' => 'admin@argon.com',
'password' => bcrypt('secret')
