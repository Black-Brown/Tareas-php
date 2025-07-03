# Tarea 5 - Gestor de Personajes (Naruto)

## Descripción
Aplicación web en PHP para registrar, editar, eliminar, ver y descargar en PDF los perfiles de personajes de la serie **Naruto**. Incluye un instalador automático y una interfaz visual inspirada en la temática de la serie.

## Requisitos

- PHP 8.x o superior
- MySQL/MariaDB
- Extensión PHP GD (para imágenes en PDF)
- Servidor web (Apache recomendado)
- Composer (opcional, si usas autoloaders)
- Navegador web moderno

## Instalación

1. **Clona o descarga este repositorio.**
2. **Coloca la carpeta en tu servidor local** (por ejemplo, en `htdocs` si usas XAMPP).
3. **Asegúrate de que la carpeta `config/` tenga permisos de escritura** (para crear el archivo de configuración).
4. **Abre tu navegador y accede a la ruta del proyecto**  
   Ejemplo:  
   ```
   http://localhost/Tareas-php/Tarea5/
   ```
5. **Sigue el asistente de instalación**  
   - Ingresa los datos de tu base de datos MySQL.
   - El instalador creará la base de datos, la tabla y el archivo de configuración automáticamente.

## Uso

- **Inicio:** Verás la lista de personajes registrados.
- **Agregar/Editar/Eliminar:** Usa las opciones del menú para gestionar personajes.
- **Descargar PDF:** En el detalle de cada personaje, puedes descargar su ficha en PDF decorada con temática Naruto.
- **Acerca de:** Información del autor y del proyecto.

## Estructura de carpetas

```
Tarea5/
│
├── config/           # Configuración de la base de datos
├── Libs/             # Librerías externas (TCPDF, img, etc.)
├── Models/           # Modelos PHP
├── Views/            # Vistas (HTML/PHP)
├── install.php       # Instalador automático
├── index.php         # Página principal
└── README.md         # Este archivo
```

## Autor

- **Jheinel Jesus Brown Curbata**
- Correo: 20240017@itla.edu.do
- Instituto Tecnológico de las Américas (ITLA)

---

¡Gracias por usar este proyecto!  
Si tienes dudas, revisa el código fuente o contacta al autor.