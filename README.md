# Sistema de Gestión ORM

Sistema de gestión para órdenes de compra, recepción de mercancía, bodegas, productos y proveedores.

## Tecnologías

- Laravel 10.x
- Livewire
- TailwindCSS
- Chart.js
- MySQL / PostgreSQL

## Requisitos

- PHP >= 8.1
- Composer >= 2.0
- Node.js >= 18.x
- MySQL >= 5.7

## Instalación

```bash
# Clonar repositorio
git clone https://github.com/tu-usuario/orm-system.git
cd orm-system

# Instalar dependencias PHP
composer install

# Configurar entorno
cp .env.example .env

# Configurar base de datos en .env
DB_DATABASE=nombre_db
DB_USERNAME=usuario
DB_PASSWORD=contraseña

# Generar clave
php artisan key:generate

# Instalar dependencias Node
npm install

# Compilar assets
npm run build

# Migrar base de datos
php artisan migrate

# Iniciar servidor
php artisan serve