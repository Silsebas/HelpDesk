# HelpDesk - Gestor de Solicitudes de Soporte

Aplicación web desarrollada con Laravel y MariaDB para registrar y administrar solicitudes básicas de soporte técnico.

## Características

- Listado de solicitudes con filtros por categoría y estado
- Crear, editar y eliminar solicitudes
- Validación de datos en el servidor
- Relación uno a muchos entre categorías y solicitudes
- Interfaz ordenada y funcional con Blade
- Protección CSRF en todos los formularios

## Requisitos

- PHP 8.2+
- Composer
- MariaDB / MySQL
- Node.js (opcional, para assets)

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

## Estructura del Proyecto

### Rutas (routes/web.php)
- `GET /` -> Listado de solicitudes (index)
- `GET /requests/create` -> Formulario de creación
- `POST /requests` -> Guardar nueva solicitud (store)
- `GET /requests/{request}/edit` -> Formulario de edición
- `PUT /requests/{request}` -> Actualizar solicitud (update)
- `DELETE /requests/{request}` -> Eliminar solicitud (destroy)

### Controlador (app/Http/Controllers/RequestController.php)
Maneja toda la lógica del CRUD:
- `index`: Obtiene las solicitudes con su categoría y aplica filtros si se solicitan.
- `create`: Pasa las categorías disponibles a la vista.
- `store`: Valida los datos y crea el registro.
- `edit`: Pasa la solicitud y categorías a la vista.
- `update`: Valida los datos y actualiza el registro.
- `destroy`: Elimina el registro de forma segura.

### Vistas (resources/views/requests/)
- `layout.blade.php`: Plantilla principal con estilos básicos y estructura HTML.
- `index.blade.php`: Tabla de listado con formulario de filtros y botones de acción.
- `create.blade.php`: Formulario para registrar nuevas solicitudes con validación de errores.
- `edit.blade.php`: Formulario prellenado para modificar solicitudes existentes.

## Funcionalidades

1. **Listado de solicitudes**: Muestra todas las solicitudes con ID, título, categoría (obtenida vía relación Eloquent), estado, fecha y acciones.
2. **Crear solicitud**: Formulario con validación en servidor para registrar nuevas solicitudes.
3. **Editar solicitud**: Modificación de solicitudes existentes con validación de datos.
4. **Eliminar solicitud**: Eliminación segura mediante petición DELETE y confirmación en el frontend.
5. **Filtros**: Filtrado dinámico por categoría o estado mediante consultas Eloquent construidas condicionalmente.

## Categorías Iniciales (Seeder)

- Hardware
- Software
- Redes
- Accesos

## Detalles Técnicos Cumplidos

- Uso de migraciones para la creación del esquema de base de datos.
- Modelos Eloquent con relación `belongsTo` (Request) y `hasMany` (Category).
- Validación de formularios en el controlador (`required`, `exists:categories,id`, `in:pending,in_progress,resolved`).
- Protección CSRF en todos los formularios mediante directiva `@csrf`.
- Uso de `@method('PUT')` y `@method('DELETE')` para las peticiones de actualización y eliminación.
- Separación clara de responsabilidades entre rutas, controlador, modelos y vistas.

## Tecnologías

- Laravel 11
- MariaDB
- Blade (motor de plantillas)
- HTML/CSS básico
