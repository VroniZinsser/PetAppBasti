# Basti
## Para vos y tu mascota

Desarrolladores: Corbalan Cristian y Zinsser Veronika

Basti es una aplicación mobile y web que te permite llevar un control sobre tu mascota de una forma fácil, rápida y eficaz. También desde la misma app puedes contactar con profesionales en el rubro de las mascotas, tales como veterinarios, bañadores de mascotas, paseadores de perros y tiendas de mascotas.

## Instalación

### Clonación del proyecto
Clona el proyecto utilizando `git clone https://github.com/VroniZinsser/mascotas`
Esto te creará una carpeta `mascotas` la cual contiene dos carpetas en su interior `mascotas-api` (**backend**) y `mascotas-vue` (**frontend**)

### mascotas-api
Dentro de la carpeta **"mascotas-api"** hay que realizar los siguientes pasos:

- Ejecutar el comando `composer update` para instalar las dependencias
- Crear una base de datos de MySQL
- Realizar una copia del archivo `.env.example` con el nombre `.env`
- Ejecutar el comando `php artisan jwt:secret` para crear una "key" aleatoria que se guardará  dentro del archivo`.env`
- **modificar las siguientes variables** del archivo `.env` de modo que concuerden con los de tu base de datos
~~~
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
~~~
- Ejecutar las migrations y seeders ejecutando el comando `php artisan migrate --seed`
- Recrear el `symlink` para el storage ejecutando el comando `php artisan storage:link`. Esto te creará una carpeta "storage" dentro de la carpeta "public".
- Dentro de la carpeta "public/storage" tienes que crear las siguientes carpetas
    - **img/**
    - **img/pets**: Aquí se almacenan las fotos de las mascotas que crea el usuario
    - **img/users/profile**: Aquí se almacenan las fotos de perfil de los usuarios
- Ejecutar el comando `php artisan key:generate` para generar una clave se guardará dentro del archivo`.env`.
### mascotas-vue
Dentro de la carpeta **"mascotas-vue"** hay que realizar los siguientes pasos:
- Ejecutar el comando `npm install` para instalar las dependencias.
- Modificar las rutas del archivo "constants/index.js" para que concuerden con la conexión hacia el backend. 

## Modo de uso

Ya con todo instalado tienes que ejecutar el comando `php artisan serve` en el directorio **"mascotas-api"** para iniciar el servidor de laravel, y también ejecutar el comando `npm run serve` en el directorio **"mascotas-vue"**

## Funcionalidades principales

Las principales funciones de Basti son:

- Agenda: Un listado de todas las tareas de las mascotas del usuario. Se puede filtrar por mascota y tipo de tareas.
- Mascotas del usuario: El usuario puede agregar un perfil para cada una de sus mascotas. A este puede agregar información clínica como medicamentos, vacunas, observaciones y peso, el cual permite llevar un buen control de sus mascotas.
- Explorar: Un mapa y listado con todos los profesionales del rubro. Se puede filtrar por el tipo de profesional (veterinarios, bañadores de mascotas, paseadores de perros, tiendas de mascotas), ubicación y horarios.
- Chatear con el profesional: Se puede iniciar una conversación con un profesional a través de la aplicación. Dentro del chat se puede **enviarle el perfil de la mascota al profesional** para que pueda ver rápidamente toda la información clínica de la mascota. Además el veterinario puede **crear y enviar desde el chat una consulta al usuario dueño**, de modo que este pueda aceptarla o rechazarla. En el caso de que se acepte la consulta se agregará a la tarea en la agenda.

## Funcionalidades desarrolladas (Sin diseño)
- Formulario para crear una cuenta de usuario profesional: /usuarios/crear-profesional
    - Campos relacionados a: datos personales, presentación al público, formas de contacto
    - Comunicación con API Rest de Here Maps para facilitar el ingreso correcto de la dirección
- Mapa con todos los profesionales: /mapa
    - Comunicación con API Rest de Here Maps para mostrar el mapa
    - Mapa centrado en la ubicación actual del usuario, o en el centro de Capital si no está habilitada la geolocalización
    - Marcadores personalizados que muestran donde cada profesional está ubicado
- Agregar una mascota: /mascotas/agregar 
    - Agrega la mascota a la base de datos con el usuario con el id 1 como dueño.
- Tus mascotas: /mascotas 
    - Se muestran las mascotas del usuario 1 con el nombre, especie e imagen de cada una.¿
