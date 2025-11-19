# 📅 Generador de Citas - Sistema de Gestión de Citas

## ✨ Proyecto Laravel 11 con Diseño Minimalista

Este es un sistema completo de gestión de citas desarrollado en Laravel 11, con autenticación Laravel Breeze, TailwindCSS y diseño minimalista en blanco y negro con fuente Montserrat.

---

## 🚀 Instalación y Configuración

### 1. Configurar Base de Datos

Edita el archivo `.env` con tus credenciales de base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=citas_db
DB_USERNAME=root
DB_PASSWORD=
```

### 2. Ejecutar Migraciones y Seeders

```bash
php artisan migrate:fresh --seed
```

### 3. Compilar Assets

```bash
npm run build
```

### 4. Iniciar el Servidor

```bash
php artisan serve
```

El sistema estará disponible en: `http://localhost:8000`

---

## 👥 Usuarios de Prueba

El sistema incluye 3 roles diferentes:

### 🔑 Administrador
- **Email:** admin@citas.com
- **Password:** password
- **Acceso:** Dashboard completo, gestión de usuarios, profesionales, servicios, horarios y citas

### 👨‍⚕️ Profesional 1 (Juan Pérez - Medicina General)
- **Email:** juan@citas.com
- **Password:** password
- **Acceso:** Sus citas del día, próximas citas, gestión de horarios

### 👩‍⚕️ Profesional 2 (María González - Psicología)
- **Email:** maria@citas.com
- **Password:** password
- **Acceso:** Sus citas del día, próximas citas, gestión de horarios

### 👤 Cliente 1 (Pedro López)
- **Email:** pedro@citas.com
- **Password:** password
- **Acceso:** Agendar citas, ver sus citas, historial

### 👤 Cliente 2 (Ana Martínez)
- **Email:** ana@citas.com
- **Password:** password
- **Acceso:** Agendar citas, ver sus citas, historial

---

## 📊 Estructura del Proyecto

### Tablas de Base de Datos

1. **users** - Usuarios del sistema (admin, cliente, profesional)
2. **profesionales** - Información de profesionales
3. **servicios** - Catálogo de servicios disponibles
4. **horarios** - Disponibilidad de profesionales
5. **citas** - Registros de citas

### Relaciones

- Un usuario puede ser admin, cliente o profesional
- Un profesional pertenece a un usuario
- Un profesional tiene muchos horarios y citas
- Un servicio tiene muchas citas
- Una cita pertenece a un usuario (cliente), profesional y servicio

---

## 🎨 Características de Diseño

- **Tipografía:** Montserrat (Google Fonts)
- **Paleta de colores:**
  - Negro: #000000
  - Blanco: #FFFFFF
  - Gris suave: #F3F3F3
- **Estilo:** Minimalista, limpio y moderno
- **Componentes:** Botones redondeados, cards con sombras sutiles

---

## 🔐 Middleware de Roles

El sistema implementa middleware personalizado para controlar el acceso:

- **admin:** Acceso completo a todas las funcionalidades
- **profesional:** Gestión de horarios y citas propias
- **cliente:** Agendar y gestionar citas propias

---

## 🛡️ Seguridad Profesional Implementada

### Policies (Autorización Granular)
✅ **CitaPolicy** - Control de acceso a nivel de modelo para citas
- Admin puede ver/editar todas las citas
- Profesional solo puede ver/editar sus citas asignadas
- Cliente solo puede ver/editar sus propias citas pendientes

✅ **ProfesionalPolicy** - Solo admin puede gestionar profesionales
✅ **ServicioPolicy** - Solo admin puede CRUD servicios
✅ **HorarioPolicy** - Admin y profesional propietario pueden gestionar horarios

### Form Requests (Validación Centralizada)
✅ **StoreCitaRequest** - Validación completa de citas:
- Verificación de disponibilidad del profesional
- Validación de horarios configurados
- Prevención de citas duplicadas
- Solo fechas futuras permitidas

✅ **UpdateCitaRequest** - Validación de actualización con estados válidos
✅ **StoreProfesionalRequest** - Usuarios únicos por profesional
✅ **StoreServicioRequest** - Nombres únicos, rangos de duración y precio
✅ **StoreHorarioRequest** - Validación de coherencia de horarios

### Rate Limiting
✅ Protección contra spam y ataques DDoS:
- **Rutas de Citas:** 60 peticiones por minuto
- **Rutas de Admin:** 100 peticiones por minuto
- Implementado en todas las rutas críticas

### Logging y Auditoría
✅ **Sistema completo de auditoría:**
- Canal `audit.log` - Operaciones CRUD (retención 90 días)
- Canal `security.log` - Accesos no autorizados (retención 180 días)
- Registro de: user_id, IP, timestamp, cambios realizados
- Servicio personalizado `AuditLogger` en `/app/Services/AuditLogger.php`

### Archivos de Seguridad Creados
- `app/Policies/CitaPolicy.php`
- `app/Policies/ProfesionalPolicy.php`
- `app/Policies/ServicioPolicy.php`
- `app/Policies/HorarioPolicy.php`
- `app/Http/Requests/StoreCitaRequest.php`
- `app/Http/Requests/UpdateCitaRequest.php`
- `app/Http/Requests/StoreProfesionalRequest.php`
- `app/Http/Requests/UpdateProfesionalRequest.php`
- `app/Http/Requests/StoreServicioRequest.php`
- `app/Http/Requests/UpdateServicioRequest.php`
- `app/Http/Requests/StoreHorarioRequest.php`
- `app/Services/AuditLogger.php`
- Canales de logging personalizados en `config/logging.php`

---

## 📱 Funcionalidades Principales

### Para Administradores
✅ Dashboard con estadísticas completas
✅ CRUD de Profesionales
✅ CRUD de Servicios
✅ Gestión completa de Citas
✅ Visualización de todas las citas recientes

### Para Profesionales
✅ Dashboard con citas del día
✅ Visualización de próximas citas
✅ Gestión de horarios de disponibilidad
✅ Filtrado de citas propias

### Para Clientes
✅ Agendar nuevas citas
✅ Ver próximas citas
✅ Historial de citas pasadas
✅ Cancelación de citas

---

## 🛣️ Rutas Principales

### Web Routes
- `/` - Página de bienvenida
- `/login` - Inicio de sesión
- `/register` - Registro de usuarios
- `/dashboard` - Dashboard según rol
- `/citas` - Gestión de citas
- `/profesionales` - Gestión de profesionales (admin)
- `/servicios` - Gestión de servicios (admin)
- `/horarios` - Gestión de horarios (admin/profesional)

### API Routes
- `/api/citas` - Endpoint JSON con todas las citas

---

## ✨ Validaciones Implementadas

### Validaciones de Seguridad y Negocio

1. **Disponibilidad de citas:** 
   - No permite citas duplicadas en la misma hora
   - Verifica que el profesional tenga horario configurado
   - Valida disponibilidad en tiempo real
   
2. **Fechas:** 
   - No permite agendar citas en fechas pasadas
   - Validación de formato de fecha y hora
   
3. **Horarios:** 
   - Hora de fin debe ser posterior a hora de inicio
   - Validación de días de semana válidos
   - Prevención de solapamientos
   
4. **Roles y Permisos:** 
   - Middleware verifica permisos según rol de usuario
   - Policies verifican autorización en cada operación
   - Logs de intentos de acceso no autorizado

5. **Servicios:**
   - Nombres únicos en el sistema
   - Duración entre 15-480 minutos
   - Precio válido (0-999,999.99)

6. **Profesionales:**
   - Usuario único por profesional
   - Email único en el sistema
   - Validación de especialidad requerida

---

## 📦 Servicios Disponibles (Datos de Prueba)

1. **Consulta General** - 30 min - $50.00
2. **Terapia Psicológica** - 60 min - $80.00
3. **Fisioterapia** - 45 min - $60.00
4. **Nutrición** - 40 min - $55.00
5. **Odontología** - 30 min - $45.00

---

## 🕒 Horarios de Profesionales

Los profesionales tienen disponibilidad de:
- **Lunes a Viernes**
- **Turno Mañana:** 09:00 - 13:00
- **Turno Tarde:** 15:00 - 19:00

---

## 🔧 Tecnologías Utilizadas

- **Framework:** Laravel 11
- **Autenticación:** Laravel Breeze
- **Frontend:** Blade Templates + TailwindCSS + Alpine.js
- **Base de Datos:** MySQL/SQLite
- **Estilos:** TailwindCSS con configuración personalizada
- **Fuente:** Montserrat (Google Fonts)
- **Seguridad:** 
  - Policies para autorización
  - Form Requests para validación
  - Rate Limiting (Throttle)
  - Audit Logging
- **Arquitectura:**
  - MVC Pattern
  - Repository Pattern (preparado)
  - Service Layer (AuditLogger)

---

## 📝 Comandos Útiles

### Limpiar caché
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Optimizar para producción
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

### Verificar logs de auditoría
```bash
# Ver log de auditoría en tiempo real
tail -f storage/logs/audit.log

# Ver log de seguridad
tail -f storage/logs/security.log

# Buscar eventos específicos
grep "Cita creada" storage/logs/audit.log
```

### Recompilar assets en desarrollo
```bash
npm run dev
```

### Ejecutar tests (cuando estén implementados)
```bash
php artisan test
php artisan test --coverage
```

### Crear un nuevo usuario admin
```bash
php artisan tinker
```
```php
User::create([
    'name' => 'Tu Nombre',
    'email' => 'tu@email.com',
    'password' => bcrypt('tu-password'),
    'rol' => 'admin'
]);
```

### Verificar permisos y policies
```bash
# Ver todas las policies registradas
php artisan route:list --columns=uri,name,middleware,action

# Verificar middleware aplicados
php artisan route:list --path=citas
```

---

## 📧 Notificaciones por Correo (Preparado)

El sistema tiene preparada la estructura para enviar correos al:
- Crear una cita
- Cancelar una cita

**Nota:** Debes configurar el `.env` con tus credenciales SMTP para activar esta funcionalidad.

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=tu-username
MAIL_PASSWORD=tu-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@citas.com"
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 🎯 Próximas Mejoras Sugeridas

- [x] ✅ Policies para autorización granular
- [x] ✅ Form Requests para validación centralizada
- [x] ✅ Rate Limiting en rutas críticas
- [x] ✅ Sistema completo de logging y auditoría
- [x] ✅ Validaciones de negocio avanzadas
- [ ] Vista de calendario semanal para profesionales
- [ ] Select dinámico de horarios disponibles en tiempo real
- [ ] Filtros avanzados de citas por estado
- [ ] Exportación de citas en PDF
- [ ] Notificaciones en tiempo real
- [ ] Recordatorios automáticos de citas
- [ ] Panel de estadísticas avanzadas
- [ ] API REST completa con autenticación Sanctum

---

## 📊 Logs y Monitoreo

### Archivos de Log Disponibles

**storage/logs/audit.log**
- Operaciones CRUD (crear, actualizar, eliminar)
- Información: usuario, IP, timestamp, modelo afectado
- Retención: 90 días

**storage/logs/security.log**
- Intentos de acceso no autorizado
- Fallos de autenticación
- Violaciones de políticas
- Retención: 180 días

**storage/logs/laravel.log**
- Logs generales de la aplicación
- Errores y excepciones
- Debug en desarrollo

### Consultar Logs

```bash
# Ver últimas entradas del log de auditoría
tail -f storage/logs/audit.log

# Ver últimas entradas del log de seguridad
tail -f storage/logs/security.log

# Buscar eventos específicos
grep "Cita creada" storage/logs/audit.log
grep "no autorizado" storage/logs/security.log
```

---

## 📄 Licencia

Este proyecto es de código abierto y está disponible bajo la licencia MIT.

---

## 👨‍💻 Soporte

Para cualquier pregunta o problema, contacta al equipo de desarrollo.

**¡Disfruta del sistema de Generador de Citas! 🎉**
