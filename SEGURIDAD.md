# 📅 Sistema de Gestión de Citas

Sistema profesional de gestión de citas desarrollado con Laravel 11, implementando roles de usuario, autorización granular, y medidas de seguridad avanzadas.

## 🚀 Características

### Seguridad y Autorización
- ✅ **Autenticación Laravel Breeze** con verificación de email
- ✅ **Sistema de Roles** (Admin, Profesional, Cliente)
- ✅ **Policies** para autorización a nivel de modelo
- ✅ **Middleware personalizado** para control de acceso por roles
- ✅ **Rate Limiting** para prevenir spam y ataques
- ✅ **Logs de Auditoría** con canales separados (audit, security)
- ✅ **Form Requests** para validación centralizada
- ✅ **CSRF Protection** habilitado por defecto

### Funcionalidades por Rol

#### 👨‍💼 Administrador
- Gestión completa de profesionales
- Gestión de servicios
- Visualización de todas las citas
- Gestión de horarios de todos los profesionales
- Acceso a logs y auditoría

#### 👨‍⚕️ Profesional
- Gestión de sus propios horarios
- Visualización de sus citas asignadas
- Actualización de estado de citas
- Configuración de disponibilidad

#### 👤 Cliente
- Crear citas con profesionales disponibles
- Visualizar sus propias citas
- Cancelar citas pendientes
- Actualizar información de perfil

## 🛡️ Seguridad Implementada

### Protección de Rutas
```php
// Middleware de autenticación
Route::middleware(['auth', 'verified'])

// Middleware de roles personalizados
Route::middleware(['role:admin'])
Route::middleware(['role:admin,profesional'])

// Rate limiting por grupo de rutas
Route::middleware(['throttle:60,1'])  // Citas
Route::middleware(['throttle:100,1']) // Admin
```

### Policies
Cada modelo cuenta con su Policy correspondiente:
- `CitaPolicy` - Control granular sobre operaciones de citas
- `ProfesionalPolicy` - Restricciones para profesionales
- `ServicioPolicy` - Solo admin puede gestionar
- `HorarioPolicy` - Admin y profesionales propietarios

### Form Requests
Validación centralizada y reutilizable:
- `StoreCitaRequest` - Validación de creación con verificación de disponibilidad
- `UpdateCitaRequest` - Validación de actualización con estados permitidos
- `StoreProfesionalRequest` - Validación única de usuarios profesionales
- `StoreServicioRequest` - Validación de servicios con rangos
- `StoreHorarioRequest` - Validación de horarios sin solapamientos

### Logging y Auditoría
```php
// Logs separados por canal
Log::channel('audit')->info('Cita creada', [...]);
Log::channel('security')->warning('Acceso no autorizado', [...]);

// Servicio de auditoría personalizado
AuditLogger::created('Cita', $id, $data);
AuditLogger::updated('Profesional', $id, $changes);
AuditLogger::deleted('Servicio', $id);
```

## 📋 Requisitos

- PHP >= 8.2
- Composer
- MySQL >= 8.0 / PostgreSQL
- Node.js >= 18 (para assets)

## 🔧 Instalación

1. **Clonar repositorio**
```bash
git clone <url-repositorio>
cd citas
```

2. **Instalar dependencias**
```bash
composer install
npm install
```

3. **Configurar entorno**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configurar base de datos**
Editar `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=citas
DB_USERNAME=root
DB_PASSWORD=
```

5. **Migrar base de datos**
```bash
php artisan migrate --seed
```

6. **Compilar assets**
```bash
npm run build
```

7. **Iniciar servidor**
```bash
php artisan serve
```

## 👥 Usuarios de Prueba

Después de ejecutar seeders:

**Administrador**
- Email: admin@test.com
- Password: password

**Profesional**
- Email: profesional@test.com
- Password: password

**Cliente**
- Email: cliente@test.com
- Password: password

## 📁 Estructura del Proyecto

```
app/
├── Http/
│   ├── Controllers/          # Controladores con autorización
│   ├── Middleware/
│   │   └── CheckRole.php     # Middleware personalizado de roles
│   └── Requests/             # Form Requests con validación
├── Models/                   # Modelos Eloquent
├── Policies/                 # Policies de autorización
└── Services/
    └── AuditLogger.php       # Servicio de logging personalizado

config/
└── logging.php               # Canales audit y security configurados

database/
├── migrations/               # Migraciones con índices
└── seeders/                  # Seeders para datos de prueba

routes/
└── web.php                   # Rutas con middleware y throttling
```

## 🔐 Validaciones Implementadas

### Citas
- ✅ Fecha no puede ser anterior a hoy
- ✅ Verificación de disponibilidad del profesional
- ✅ Verificación de horarios configurados
- ✅ Prevención de citas duplicadas
- ✅ Estados válidos (pendiente, confirmada, completada, cancelada)

### Profesionales
- ✅ Usuario único por profesional
- ✅ Especialidad requerida
- ✅ Validación de teléfono

### Servicios
- ✅ Nombre único
- ✅ Duración entre 15-480 minutos
- ✅ Precio válido (0-999,999.99)

### Horarios
- ✅ Hora inicio < Hora fin
- ✅ Días de semana válidos
- ✅ Formato de hora correcto (HH:MM)

## 📊 Logs y Monitoreo

### Canales de Logging
- **audit.log** - Operaciones CRUD, retención 90 días
- **security.log** - Intentos de acceso no autorizado, retención 180 días
- **laravel.log** - Logs generales de la aplicación

### Información Registrada
- ID de usuario que realiza la acción
- IP de origen
- Timestamp
- Datos modificados
- Modelo afectado

## 🧪 Testing

```bash
# Ejecutar todos los tests
php artisan test

# Con coverage
php artisan test --coverage
```

## 🚀 Producción

### Optimizaciones
```bash
# Cachear configuración
php artisan config:cache

# Cachear rutas
php artisan route:cache

# Cachear vistas
php artisan view:cache

# Optimizar autoloader
composer install --optimize-autoloader --no-dev
```

### Variables de Entorno Recomendadas
```env
APP_ENV=production
APP_DEBUG=false
LOG_LEVEL=warning
SESSION_SECURE_COOKIE=true
```

## 📝 Licencia

Este proyecto es de código abierto.

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Por favor:
1. Fork el proyecto
2. Crea una rama para tu feature
3. Commit tus cambios
4. Push a la rama
5. Abre un Pull Request

## 📧 Soporte

Para soporte o consultas, contactar a: [tu-email@ejemplo.com]
