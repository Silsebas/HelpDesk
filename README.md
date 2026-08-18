# HelpDesk - Gestor de Solicitudes de Soporte

Aplicación web desarrollada con Laravel y MariaDB para registrar y administrar solicitudes básicas de soporte técnico.

## Características

- Listado de solicitudes con filtros por categoría y estado
- Crear, editar y eliminar solicitudes
- Validación de datos en el servidor
- Relación uno a muchos entre categorías y solicitudes
- Interfaz ordenada y funcional con Blade

## Requisitos

- PHP 8.2+
- Composer
- MariaDB / MySQL
- Node.js (para assets)

## Instalación

1. Clonar el repositorio:
   ```bash
   git clone https://github.com/TU_USUARIO/HelpDesk.git
   cd HelpDesk
   ```

2. Instalar dependencias:
   ```bash
   composer install
   ```

3. Configurar el archivo .env:
   ```bash
   cp .env.example .env
   ```

4. Generar la clave de aplicación:
   ```bash
   php artisan key:generate
   ```

5. Configurar la base de datos en .env:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=helpdesk
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Ejecutar migraciones y seeders:
   ```bash
   php artisan migrate:fresh --seed
   ```

7. Iniciar el servidor de desarrollo:
   ```bash
   php artisan serve
   ```

8. Acceder a la aplicación en: http://localhost:8000

## Estructura de la Base de Datos

### Tabla: categories
- id (PK)
- name
- created_at
- updated_at

### Tabla: requests
- id (PK)
- title
- description
- status (pending, in_progress, resolved)
- category_id (FK a categories.id)
- created_at
- updated_at

## Funcionalidades

1. **Listado de solicitudes**: Muestra todas las solicitudes con ID, título, categoría, estado, fecha y acciones
2. **Crear solicitud**: Formulario con validación para registrar nuevas solicitudes
3. **Editar solicitud**: Modificar solicitudes existentes
4. **Eliminar solicitud**: Eliminar solicitudes con confirmación
5. **Filtros**: Filtrar por categoría o estado

## Categorías Iniciales

- Hardware
- Software
- Redes
- Accesos

## Tecnologías

- Laravel 11
- MariaDB
- Blade (vistas)
- HTML/CSS básico

