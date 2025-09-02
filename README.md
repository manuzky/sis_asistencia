# Sistema de Registro y Control de Asistencias

Este proyecto fue desarrollado en **Laravel** para la gestión del personal, control de asistencias, generación de reportes y administración de roles y permisos.

---

## 📖 Manual de Usuario

### Introducción
Bienvenido al **Sistema de Registro y Control de Asistencias del Personal**.  
Este manual tiene como objetivo proporcionar una guía detallada sobre el uso del sistema, facilitando su comprensión y maximizando la eficiencia de su operación.  
Está dirigido a **usuarios finales, administradores y cualquier persona que requiera interactuar con la plataforma**.

El sistema permite:
- Gestión de usuarios  
- Control de asistencias  
- Generación de reportes  
- Notificaciones en tiempo real  

---

### 🔑 Acceso y autenticación
1. Introducir el correo electrónico  
2. Introducir la contraseña  
3. Click en **Ingresar**

> ⚠️ El administrador debe haber creado el usuario previamente.

---

### 🏠 Panel Principal
El **Panel Principal** es la interfaz inicial tras el inicio de sesión. Desde acá, los usuarios pueden acceder a diferentes secciones del sistema según su rol y permisos.

- **Menú de navegación** → acceso a todas las funcionalidades  
- **Tablero de información** → resumen en tiempo real  
- **Accesos rápidos** → Miembros, Usuarios y Asistencias registradas  

---

### ⏱️ Asistencias
La funcionalidad de asistencias permite registrar y monitorear la hora de entrada y salida de los miembros.

1. Seleccionar un miembro o ingresar cédula  
2. Indicar fecha, hora de entrada y hora de salida  
3. Confirmar el registro  

> 📝 Todas las asistencias quedan registradas con:  
> - Usuario que ingresó/modificó  
> - Fecha y hora de acción  
> - Historial de modificaciones  

---

### 👥 Miembros
Permite administrar la información personal de los miembros de la institución.

1. Registrar datos personales  
2. Asignar turno de trabajo  
3. Guardar información  

> Opcional: cargar fotografía del miembro (si no, se asigna un ícono automático según género).

---

### 🧑‍💻 Usuarios
1. Asignar un miembro existente  
2. Crear contraseña  
3. Definir roles y permisos  
4. Registrar usuario  

- **Habilitar** → acceso completo  
- **Deshabilitar** → restringe acceso sin eliminar cuenta  

---

### 🛡️ Roles y Permisos
1. Definir nombre y descripción del rol  
2. Marcar permisos permitidos  
3. Guardar configuración  

---

### 📊 Reportes
Generación de reportes personalizados en **PDF**:

- **General** → todas las asistencias  
- **Por personal** → asistencias según tipo de personal  
- **Rango de fechas** → asistencias filtradas con opción de turnos  

---

### 💾 Respaldo de Base de Datos
Un clic en la barra lateral permite realizar un respaldo automático de la base de datos.  

> ⚠️ Solo disponible para usuarios con permisos de administrador.

---

### 🔒 Seguridad y Buenas Prácticas
- Usar contraseñas seguras y renovarlas periódicamente  
- No compartir credenciales  
- Cerrar sesión tras el uso  
- Reportar actividades sospechosas  
- Capacitar al personal en el uso del sistema  

---

📌 **Nota:** Este manual corresponde al sistema de control de asistencias desarrollado como parte del proyecto en Laravel.
