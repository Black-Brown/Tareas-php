# Portal de Tarea 4 - Jheinel Brown

Este portal web integra varias APIs y funcionalidades usando PHP y Bootstrap. Permite consultar clima, noticias, datos de países, chistes, imágenes, Pokémon y más.

## 🚀 ¿Cómo ejecutar el portal?

1. **Requisitos previos**
   - Tener instalado [PHP](https://www.php.net/downloads.php) (versión 7.4 o superior).
   - Tener un servidor local como [XAMPP](https://www.apachefriends.org/es/index.html), [WAMP](https://www.wampserver.com/), [Laragon](https://laragon.org/) o usar el servidor embebido de PHP.
   - Conexión a Internet (para consumir las APIs).

2. **Descarga o clona el repositorio**
   - Descarga el proyecto o clónalo en tu máquina local.

3. **Ubica la carpeta del proyecto**
   - Por ejemplo:  
     `c:\Users\jhein\Documents\programing homework\Tareas-php\Tarea4`

4. **Inicia el servidor**
   - Si usas XAMPP/WAMP, coloca la carpeta dentro de `htdocs` o `www` y accede desde tu navegador:  
     ```
     http://localhost/Tarea4/
     ```
   - Si usas el servidor embebido de PHP, abre una terminal en la carpeta del proyecto y ejecuta:
     ```
     php -S localhost:8000
     ```
     Luego abre en tu navegador:  
     ```
     http://localhost:8000/
     ```

5. **¡Listo!**
   - Verás el portal principal con todas las pestañas y funcionalidades.

## 📦 Estructura del proyecto

- `index.php` — Página principal del portal.
- `libs/` — Librerías y plantilla base.
- `modulos/` — Módulos de cada funcionalidad (clima, chistes, imágenes, etc.).
- `README.md` — Este archivo.

## 🛠️ Personalización

- Si alguna API requiere una clave (API Key), revisa el archivo correspondiente en `modulos/` y reemplaza `"TU_API_KEY"` por tu clave personal.
- Puedes modificar los estilos y textos desde la plantilla en `libs/plantilla.php`.

## 📋 Notas

- El portal usa **Bootstrap** para el diseño responsivo.
- Todas las funcionalidades requieren acceso a Internet para funcionar correctamente.
- Si tienes problemas con alguna API, revisa tu conexión o si la API requiere autenticación.

---

**Autor:** Jheinel Brown  
**Matrícula:** 2024-0017
