# 📋 Guía de Instalación - Sistema de Gestión de Citas

Esta guía te ayudará a instalar y configurar el proyecto en tu máquina local.

## 📦 Requisitos Previos

Antes de comenzar, asegúrate de tener instalado:

- **PHP** >= 8.2
- **Composer** (Gestor de dependencias de PHP)
- **Node.js** >= 18.x y **npm**
- **MySQL** >= 8.0
- **Git**

## 🚀 Pasos de Instalación

### 1. Clonar el Repositorio

```bash
git clone https://github.com/JustinM1770/citas.git
cd citas
```

### 2. Instalar Dependencias de PHP

```bash
composer install
```

### 3. Instalar Dependencias de JavaScript

```bash
npm install
```

### 4. Configurar el Archivo de Entorno

Copia el archivo de ejemplo y genera la clave de aplicación:

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configurar la Base de Datos

Edita el archivo `.env` con tus credenciales de MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=citas
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
```

### 6. Crear la Base de Datos

Crea la base de datos manualmente en MySQL:

```sql
CREATE DATABASE citas CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

O usa phpMyAdmin, MySQL Workbench, o cualquier otra herramienta.

### 7. Ejecutar Migraciones y Seeders

Esto creará todas las tablas y datos de prueba:

```bash
php artisan migrate:fresh --seed
```

### 8. Compilar Assets Frontend

Para desarrollo (con hot-reload):
```bash
npm run dev
```

Para producción:
```bash
npm run build
```

### 9. Iniciar el Servidor de Desarrollo

```bash
php artisan serve
```

El proyecto estará disponible en: **http://127.0.0.1:8000**

## 👥 Credenciales por Defecto

El seeder crea los siguientes usuarios de prueba:

| Rol | Email | Contraseña |
|-----|-------|------------|
| **Administrador** | admin@citas.com | password |
| **Profesional** | juan@citas.com | password |
| **Profesional** | maria@citas.com | password |
| **Cliente** | pedro@citas.com | password |
| **Cliente** | ana@citas.com | password |

## 🔧 Configuración Adicional (Opcional)

### Configurar Logs de Auditoría

Los logs se guardan automáticamente en:
- `storage/logs/audit-*.log` (90 días de retención)
- `storage/logs/security-*.log` (180 días de retención)

### Permisos de Almacenamiento

Si tienes problemas de permisos en Linux/Mac:

```bash
chmod -R 775 storage bootstrap/cache
```

### Limpiar Caché

Si encuentras errores de caché:

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

## 📁 Estructura del Proyecto

```
citas/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Controladores
│   │   ├── Middleware/       # Middleware personalizado
│   │   └── Requests/         # Form Requests (validaciones)
│   ├── Models/               # Modelos Eloquent
│   ├── Policies/             # Políticas de autorización
│   └── Services/             # Servicios (AuditLogger)
├── database/
│   ├── migrations/           # Migraciones de base de datos
│   └── seeders/              # Seeders con datos de prueba
├── resources/
│   ├── views/                # Vistas Blade
│   ├── css/                  # Estilos (Tailwind)
│   └── js/                   # JavaScript (Alpine.js)
└── routes/
    ├── web.php               # Rutas web
    └── api.php               # Rutas API
```

## 🛡️ Características de Seguridad

- ✅ Autenticación con Laravel Breeze
- ✅ Autorización con Policies
- ✅ Validaciones con Form Requests
- ✅ Rate Limiting (60-100 req/min)
- ✅ Middleware de roles personalizados
- ✅ Audit logging completo
- ✅ Protección CSRF

## 🐛 Solución de Problemas

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: "SQLSTATE[HY000] [2002] Connection refused"
Verifica que MySQL esté corriendo y las credenciales en `.env` sean correctas.

### Error: "npm run dev" falla
```bash
rm -rf node_modules package-lock.json
npm install
npm run dev
```

### Error de permisos en storage/logs
```bash
chmod -R 775 storage
chown -R www-data:www-data storage  # Linux
```

## 📚 Documentación Adicional

- [INSTRUCCIONES.md](./INSTRUCCIONES.md) - Guía completa del proyecto
- [SEGURIDAD.md](./SEGURIDAD.md) - Documentación de seguridad
- [README.md](./README.md) - Descripción general

## 💡 Soporte

Si encuentras algún problema durante la instalación:

1. Revisa los logs en `storage/logs/laravel.log`
2. Verifica que todos los requisitos estén instalados
3. Asegúrate de que la versión de PHP sea >= 8.2
4. Consulta la documentación oficial de [Laravel](https://laravel.com/docs)

## 🤝 Contribuir

Si deseas contribuir al proyecto:

1. Haz un Fork del repositorio
2. Crea una rama para tu feature (`git checkout -b feature/nueva-funcionalidad`)
3. Commit tus cambios (`git commit -m 'Agregar nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Abre un Pull Request

---

**Desarrollado con ❤️ usando Laravel 11 y Tailwind CSS**
