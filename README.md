FutPersistencia

Descripción del proyecto
FutPersistencia es un sistema web para gestionar equipos y partidos de fútbol.
Permite:

Ver todos los equipos y agregar nuevos.

Registrar partidos entre equipos.

Consultar los partidos de un equipo específico.

Guardar en sesión el último equipo consultado para mostrarlo como página principal.

El proyecto está desarrollado en PHP con persistencia en MySQL y utiliza sesiones para mejorar la experiencia del usuario.

Estructura del proyecto

app

equipos.php: lista los equipos y permite agregar nuevos.

partidos.php: lista los partidos por jornada y permite registrar nuevos partidos.

partidosEquipo.php: muestra los partidos de un equipo seleccionado.

assets

css: estilos CSS.

js: scripts JavaScript.

persistence

Connection.php: clase para conectarse a la base de datos.

credentials.json: configuración de la conexión (host, usuario, contraseña, base de datos).

EquipoDAO.php: operaciones sobre equipos.

PartidoDAO.php: operaciones sobre partidos.

templates

menu.php: menú de navegación y layout general.

index.php: página principal que redirige según la sesión

Si se ha consultado un equipo, muestra sus partidos.

Si no, muestra la lista de equipos.

Base de datos (QWERTY)

Tablas y campos

equipos

id: clave primaria, entero, autoincremental.

nombre: nombre del equipo, obligatorio y único.

estadio: nombre del estadio, puede ser nulo.

partidos

id: clave primaria, entero, autoincremental.

equipo_local_id: referencia al equipo local (FK).

equipo_visitante_id: referencia al equipo visitante (FK).

jornada: número de la jornada, puede ser nulo.

resultado: resultado del partido, puede ser nulo.

estadio_id: referencia al estadio donde se jugó (FK).

Relaciones

equipo_local_id y equipo_visitante_id apuntan a equipos.id.

estadio_id apunta a equipos.id para indicar el estadio del partido.

Instalación y uso

Copiar el proyecto a la carpeta del servidor local (XAMPP, WAMP, etc.).

Crear la base de datos futbol y las tablas equipos y partidos según la descripción anterior.

Configurar persistence/credentials.json con los datos de conexión: host, usuario, contraseña y base de datos.

Abrir en el navegador http://localhost/FutPersistencia/.

Si no hay equipo consultado en sesión, se mostrará la página de equipos.

Si se ha consultado un equipo, se mostrará automáticamente la página de sus partidos.

Seguridad y buenas prácticas

Se usa htmlspecialchars para mostrar datos de usuario y prevenir ataques XSS.

Las relaciones entre tablas aseguran la integridad referencial.

Se usan sesiones PHP para recordar la actividad del usuario.

Autor

David Martín
