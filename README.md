# About the project
## At a glance

Basti is a mobile and web application in Spanish language that helps pet owners to **record the health condition** of their pets and to find veterinary surgeons nearby.
As a highlight feature users can **share their pets' profiles with their vets of trust**. In this way, vets can see medical data such as weight, medicines and vaccines and do the treatment in a more efficient and secure way.

## Technical details

This app is the final project of my three-year formation as a web developer in Buenos Aires. 
It was developed in equal parts by my colleague Cristian Corbalan and me.

The backend is built with MySQL and PHP (Laravel, Eloquent ORM, Sanctum)
The frontend is built with HTML5, CSS3 (SCSS) and JavaScript (Vue.js, Vue Router, Vuetify, HEREMaps)

## Main functionalities

- Register and login as a pet owner (basic profile) or professional (for vets / dog sitters / pet shops, advanced profile with image, description, and address)

As a pet owner:
- Add / modify / delete a pet's profile with name, picture and basic information
- Add / modify / delete weight, medicine, vaccine and text note to any of his pets
- Map where the user can display, filter and search professionals close to his current location
- View the profile of every professional registered in the app
- Possibility to share one of his pets with a professional user, together with a little message and a max. duration

As a professional (vet, pet shop, dog sitter):
- View / modify / remove the own profile
- Accept / reject requests of users to share their pets
- Overview of all pets that are shared with the professional at the moment
- View profile of any pet that is shared with the professional at the moment

## Installation

In order to run the app locally you have to apply the following configuration:

### Cloning the project
Clone the project using `git clone https://github.com/VroniZinsser/mascotas`
This will create a folder named `mascotas` with two subfolders `mascotas-api` (**backend**) and `mascotas-vue` (**frontend**)

### In the folder mascotas-api
Inside the folder **"mascotas-api"** you have to do the following steps:

- Execute the command `composer update` in order to install dependencies
- Create a database in MySQL
- Make a copy of the file  `.env.example` and rename the copy to `.env`
- Execute the command `php artisan jwt:secret` in order to create a random JWT key that will be stored inside the file `.env`
- **Modify the following variables** inside the `.env` file so that they coincide with the values of your database
~~~
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
~~~
- **Modify the following variables** inside the `.env` file so that they coincide with the mail account that you want to use to send emails to the users
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
- Change the app name in the `.env` file: APP_NAME=Basti
- Change the url leading to the frontend in `AuthServiceProvider.php` in the method **ResetPassword::createUrlUsing()**
- Execute the command `php artisan migrate --seed` in order to run the database migrations and seeders
- Execute the command `php artisan storage:link` in order to recreate the `symlink`. This will create a folder "storage" inside the folder "public"
- Inside the folder "public/storage" you have to create the following folders:
    - **img/**
    - **img/pets**: Store for the pets' pictures uploaded by the users
    - **img/users/profile**: Store for the profile pictures uploaded by the users
- Execute the command `php artisan key:generate` in order to generate a key that will be stored inside the `.env` file 

### In the folder mascotas-vue
Inside the folder **"mascotas-vue"** you have to do the following steps:

- Eecute the command `npm install` in order to install the frontend dependencies
- Modify the routes in the file "constants/index.js" so that they coincide with the connection to the backend

### Run the application
Once everything is installed and setup correctly, you need to execute the command `php artisan serve` inside the folder **"mascotas-api"** in order to run the backend and `npm run serve` in the folder **"mascotas-vue"** to start the vue application


