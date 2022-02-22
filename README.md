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
- **modificar las siguientes variables** del archivo `.env` de modo que concuerden con la cuenta de correo electrónica usada para enviar correos a los usuarios
~~~
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=basti.mascotas@gmail.com
MAIL_PASSWORD=El password de la cuenta
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=basti.mascotas@gmail.com
MAIL_FROM_NAME="Basti Mascotas"
~~~
- Modificar el nombre de la app en el archivo `.env`: APP_NAME=Basti
- Modificar la url que va hacía el frontend en AuthServiceProvider.php en el método ResetPassword::createUrlUsing()
- Ejecutar las migrations y seeders ejecutando el comando `php artisan migrate --seed`
- Recrear el `symlink` para el storage ejecutando el comando `php artisan storage:link`. Esto te creará una carpeta "storage" dentro de la carpeta "public".
- Dentro de la carpeta "public/storage" tienes que crear las siguientes carpetas
    - **img/**
    - **img/pets**: Aquí se almacenan las fotos de las mascotas que crea el usuario
    - **img/users/profile**: Aquí se almacenan las fotos de perfil de los usuarios
- Ejecutar el comando `php artisan key:generate` para generar una clave se guardará dentro del archivo`.env`.
- Ejecutar el comando `php artisan jwt:secret` para generar una clave para JWT que se guardará dentro del archivo`.env`.
### mascotas-vue
Dentro de la carpeta **"mascotas-vue"** hay que realizar los siguientes pasos:
- Ejecutar el comando `npm install` para instalar las dependencias.
- Modificar las rutas del archivo "constants/index.js" para que concuerden con la conexión hacia el backend. 

## Modo de uso

Ya con todo instalado tienes que ejecutar el comando `php artisan serve` en el directorio **"mascotas-api"** para iniciar el servidor de laravel, y también ejecutar el comando `npm run serve` en el directorio **"mascotas-vue"**

## Funcionalidades principales

Las principales funciones de Basti son:

- Agenda: Un listado de todas las tareas relacionadas con las mascotas del usuario en la cual se puede filtrar por tipo de tarea y/o mascota.
- Mascotas: Un perfil por cada mascota que agrega el usuario, donde se encuentra toda la historia clínica de esta.
- Explorar: una sección donde se muestra un listado de los profesionales registrados en la aplicación, y su ubicación en el mapa, de este modo el usuario dueño puede encontrar y contactar fácilmente al profesional que mejor se adapte a sus necesidades.

## Funcionalidades desarrolladas
- Autenticación
  - Autenticar a un usuario registrado
  - Registrar un nuevo usuario dueño o profesional
- Mascotas
  - Mensaje en el caso de que el usuario no tenga una mascota agregada
  - Agregar una nueva mascota, poder editarla y eliminarla
  - Agregar vacunas, medicamentos, nota y peso a la mascota
  - Listado de mascotas del usuario
  - Perfil clínico de la mascota
- Explorar
  - Listado de profesionales sin un orden especifico
  - Ver la ubicación de los profesionales en un mapa
  - Poder hacer clic sobre los marcadores en el mapa para mostrar información del profesional
